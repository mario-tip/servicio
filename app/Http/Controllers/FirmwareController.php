<?php

namespace App\Http\Controllers;

use App\Firmware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;
use App\Asset;

class FirmwareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($asset_id)
    {
        if(userHasPermission('historial_firmware')) {
            $asset = Asset::find($asset_id);
            // return $asset;
            return view("assets.firmware_history", compact("asset"));
        }
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->get('firmware');
        $validator = $this->validateInputs($form_data);

        if($validator->fails()) {
            $response = [
                'errors' => true,
                'errors_fragment' => \View::make('partials.request')->withErrors($validator)->render()
            ];
            return response()->json($response);
        }

        $form_data['date'] = AssetController::date2SQLFormat($form_data['date']);

        try {
            Firmware::create($form_data);
            $request->session()->flash('message', 'Firmware update successful');
        } catch(\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);
        }
    }

    private function validateInputs($form_data) {

        $messages = [
            'firmware.required' => 'The new version is required',
            'date.required' => 'The date is required',
            'risk.required' => 'The risk is required',
        ];

        $validator = Validator::make($form_data, [
            'firmware' => 'required',
            'date' => 'required',
            'risk' => 'required'
        ], $messages);

        return $validator;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
