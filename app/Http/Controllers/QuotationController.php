<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Quotation;
use App\Incident;
use Validator;
use Storage;
use Session;
use File;

class QuotationController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        if(userHasPermission("listar_cotizacion_servicios")) {
            $quotations = Quotation::all();
            return view('quotations.index', compact('quotations'));
        }
        return redirect()->back();
    }

    public function create(){
        if(userHasPermission("crear_cotizacion_servicios")) {
            $quotation = new Quotation;
            return view('quotations.create', compact('quotation'));
        }
        return redirect()->back();
    }

    public function store(Request $request){
        $response = [
            'errors' => false,
            'errors_fragment' => ''
        ];

        $form_data = $request->all();
        $validator = $this->validateInputs($form_data, 'POST');

        if($validator->fails()) {
            $response['errors'] = true;
            $response['errors_fragment'] = \View::make('partials.request')->withErrors($validator)->render();

            return response()->json($response);
        }

        $file = $request->file('quotation_file');
        $file_extension = File::extension($file->getClientOriginalName());
        $random_name = substr(round(microtime(true) * 1000), 5, 14) . random_int(10, 99);
        $filename = $random_name . '.' . $file_extension;

        $form_data['quotation']['quotation_file'] = '/images/quotations/' . $filename;
        $form_data['quotation']['authorization'] = '0';

        if(isset($form_data['incident_parts'])) {
            $incident_parts = $this->formatPartsData($form_data['incident_parts']);
            if($incident_parts == false) {
                $response['errors'] = true;
                $response['errors_fragment'] = \View::make('partials.request')
                    ->withErrors(['msg' => 'Specify a price for each selected part'])->render();
                return $response;
            }

        } else {$incident_parts = [];}

        try {
            $quotation = Quotation::create($form_data['quotation']);
            $quotation->parts()->attach($incident_parts);
            if($request->file('quotation_file') != null) {
                $this->saveFile($file, $filename);
            }
            // $request->session()->flash('message', 'Cotización de servicio guardada exitosamente');
            $request->session()->flash('message', 'Service budget saved successfully');
            return response()->json($response);
        } catch (\Exception $e) {
            $response = [
                'errors' => true,
                'errors_fragment' => \View::make('partials.request')->withErrors([$e->getMessage()])->render()
            ];
            return $response;
        }
    }

    /*formateando algunos datos del form para guardarlos en la db*/
    private function formatPartsData($incident_parts) {
        foreach($incident_parts as $k=>$part) {
            if($part['price'] == '') return false;
            $incident_parts[$k]['price'] =  str_replace(',', '', $part['price']);
        }

        return $incident_parts;
    }

    private function saveFile($file, $filename) {
        if(!is_dir(public_path('images/quotations/'))) {
            File::makeDirectory('images/quotations',  0775, true, true);
        }

        $file->move(public_path('images/quotations/'), $filename);
    }


    private function validateInputs($form_data, $method) {
        $messages = [

            'quotation.incident_id.required' => 'The incident is required',
            'quotation.name.required' => 'The name is required',
            'quotation.description.required' => 'The description is required',
            'quotation_file.required' => 'The file quotation is required'
        ];

        $validations = [
          'quotation.incident_id' => 'required',
            'quotation.name' => 'required',
            'quotation.description' => 'required',
        ];

        if($method == 'POST') $validations['quotation_file'] = 'required';

        $validator = Validator::make($form_data, $validations, $messages);

        return $validator;
    }

    public function show($id){
        if(userHasPermission("mostrar_cotizacion_servicios")) {
            $quotation = Quotation::find($id);
            return view('quotations.show', compact('quotation'));
        }
        return redirect()->back();
    }

    public function edit($id){
        if(userHasPermission("editar_cotizacion_servicios")) {
            $quotation = Quotation::find($id);
            // dd($quotation);
            return view('quotations.edit', compact('quotation'));
        }
        return redirect()->back();
    }

    public function update(Request $request, $id){
        $response = [
            'errors' => false,
            'errors_fragment' => ''
        ];

        $form_data = $request->all();
        $validator = $this->validateInputs($form_data, 'PUT');

        if($validator->fails()) {
            $response['errors'] = true;
            $response['errors_fragment'] = \View::make('partials.request')->withErrors($validator)->render();

            return response()->json($response);
        }

        if(isset($form_data['incident_parts'])) {
            $incident_parts = $this->formatPartsData($form_data['incident_parts']);
            if($incident_parts == false) {
                $response['errors'] = true;
                $response['errors_fragment'] = \View::make('partials.request')
                    ->withErrors(['msg' => 'Enter a price for each selected part'])->render();
                return $response;
            }

        } else {$incident_parts = [];}
        // dd($form_data);
        $quotation = Quotation::find($id);
        $current_quotation_file = $quotation->quotation_file;

        if($request->hasFile('quotation_file')) {
            $file = $request->file('quotation_file');
            $file_extension = File::extension($file->getClientOriginalName());
            $random_name = substr(round(microtime(true) * 1000), 5, 14) . random_int(10, 99);
            $filename = $random_name . '.' . $file_extension;
            $form_data['quotation']['quotation_file'] = '/images/quotations/' . $filename;
        }

        try {
            $quotation->fill($form_data['quotation']);
            $quotation->parts()->sync($incident_parts);
            $quotation->save();

            if($request->hasFile('quotation_file')) {
                if($current_quotation_file != null) {
                    $current_quotation_file = array_slice(
                        explode( "/", $current_quotation_file), -1)[0];
                    File::delete("images/quotations/" . $current_quotation_file);
                }
                $this->saveFile($file, $filename);
            }

            $request->session()->flash('message', 'Service quote updated successfully ');
            return response()->json($response);
        } catch (\Exception $e) {
            $response['errors'] = true;
            $response['errors_fragment'] = \View::make('partials.request')->withErrors([$e->getMessage()])->render();
            return $response;
        }
    }

    /*Actualiza la cotización con el nuevo status datos de autorización*/
    public function changeAuthorizationStatus(Request $request){
        if(userHasPermission("cambiar_estatus_cotizacion_servicios")):
            $response = [
                'errors' => false,
                'errors_fragment' => ''
            ];

            if($request->ajax()) {
                $quotation_data = $request->get('quotation');
                $validator = $this->validateAuthorizationInputs($quotation_data);

                if($validator->fails()) {
                    $response['errors'] = true;
                    $response['errors_fragment'] = \View::make('partials.request')->withErrors($validator)->render();
                    return response()->json($response);
                }

                $quotation = Quotation::find($request->get('quotation_id'));
                $current_authorization_file = $quotation->authorization_file;

                if($request->hasFile('authorization_file')) {
                    $file = $request->file('authorization_file');
                    $file_extension = File::extension($file->getClientOriginalName());
                    $random_name = substr(round(microtime(true) * 1000), 5, 14) . random_int(10, 99);
                    $filename = $random_name . '.' . $file_extension;
                    $quotation_data['authorization_file'] = '/images/quotations/' . $filename;
                }

                try {
                    $quotation->fill($quotation_data);
                    $quotation->save();

                    if($request->hasFile('authorization_file')) {
                        if($current_authorization_file != null) {
                            $current_authorization_file = array_slice(
                                explode( "/", $current_authorization_file), -1)[0];
                            File::delete("images/quotations/" . $current_authorization_file);
                        }
                        $this->saveFile($file, $filename);
                    }
                    $request->session()->flash('message', 'Change status successfully');
                    return response()->json($response);
                } catch(\Exception $e) {
                    $response['errors'] = true;
                    $response['errors_fragment'] = \View::make('partials.request')->withErrors([$e->getMessage()])->render();
                    return $response;
                }

            }

            return $this->onlyAjaxAllowed();
        endif;
    }

    /*Valida los inputs del formulario del modal de authorización*/
    private function validateAuthorizationInputs($form_data) {

        if($form_data['authorization'] == '0') $form_data['authorization'] =  '';

        $messages = [
            'authorization.required' => 'The authorization should not be left pending',
        ];

        $validations = [
            'authorization' => 'required',
        ];

        $validator = Validator::make($form_data, $validations, $messages);

        return $validator;
    }

    /*Cancelación de cotización*/
    public function destroy(Request $request, $id){
        if($request->ajax()) {
            $response = [
                'errors' => false,
                'errors_fragment' => ''
            ];
            $canceled_status = '3';
            $quotation = Quotation::find($id);

            try {
                $quotation->authorization = $canceled_status;
                $quotation->save();
                Session::flash('message', 'Quote successfully canceled');
                return response()->json(['errors' => false]);
            }catch(\Exception $e){
                $response['errors'] = true;
                $response['errors_fragment'] =  \View::make('partials.request')->withErrors([$e->getMessage()])->render();
                return $response;
            }
        }
        return $this->onlyAjaxAllowed();
    }

    /*Obtiene las incidencias para el select2*/
    public function getSelect2Incidents(Request $request) {

        if($request->ajax()) {
            $query = $request->get('q');

            $parts = Incident::select('id', 'folio as text')
                ->where('folio', 'like', '%' . $query . '%')
                ->get()->toArray();

            $response = ["results" => $parts];

            return response()->json($response);
        }
        return $this->onlyAjaxAllowed();
    }

    public function getIncidentParts(Request $request) {
        if($request->ajax()) {
            $incident = Incident::find($request->get('incident_id'));
            $asset_name = $incident->asset->name;
            $incident_parts = $incident->parts;

            $quotation_edit = false;
            $check_all_status = false;

            if(null != $request->get('quotation_id')) {
                $quotation_parts = Quotation::find($request->get('quotation_id'))->parts;
                $quotation_parts_ids = $quotation_parts->pluck('id')->toArray();
                $check_all_status = (count($quotation_parts) == count($incident_parts)) ? true : false;
                $quotation_edit = true;
                foreach($incident_parts as $k=>$incident_part) {
                    if(in_array($incident_part->id, $quotation_parts_ids)) {
                        $incident_parts[$k]->checkbox_status = 'checked';
                        $incident_parts[$k]->price = $quotation_parts->find($incident_part->id)->pivot->price;
                    } else {
                        $incident_parts[$k]->checkbox_status = '';
                        $incident_parts[$k]->price = '';
                    }
                }
            }

            $response = [
                'incident_parts_table_view' => \View::make('quotations.forms.incident_parts_table')
                    ->with([
                        'incident_parts' => $incident_parts,
                        'quotation_edit' => $quotation_edit,
                        'check_all_status' => $check_all_status])
                    ->render(),
                'asset_name' => $asset_name
            ];

            return response()->json($response);
        }
        return response()->json([
            'error' => '400',
            'message' => 'Only ajax requests are allowed'
        ]);
    }

    /*Retorna response cuando no es ajax request*/
    private function onlyAjaxAllowed() {
        return response()->json([
            'error' => '400',
            'message' => 'Only ajax requests are allowed'
        ]);
    }
}
