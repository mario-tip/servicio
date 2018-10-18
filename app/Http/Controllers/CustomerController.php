<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CustomerRequest;
use Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(userHasPermission("listar_catalogo_clientes")) {
            $customers = Customer::all();
            return view('catalogs.customers.index', compact('customers'));
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
        if(userHasPermission("crear_catalogo_clientes")) {
            $customer = new Customer();
            $requirements = $this->getRequirements();
            return view('catalogs.customers.create', compact('customer', 'requirements'));
        }
        return redirect()->back();
    }

    private function getRequirements()
    {
        return [
            'types' => ['1' => 'Compañia', '2' => 'Persona', '3' => 'Contrato']
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        try {
            Customer::create($request->get('customer'));
            $request->session()->flash('message', 'Cliente creado correctamente');
            return redirect()->route('customers.index');
        } catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(userHasPermission("editar_catalogo_clientes")) {
            $customer = Customer::find($id);
            $requirements = $this->getRequirements();
            return view('catalogs.customers.edit', compact('customer', 'requirements'));
        }
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        try {
            $customer->fill($request->get('customer'));
            $customer->save();
            $request->session()->flash('message', 'Cliente actualizado correctamente');
            return redirect()->route('customers.index');
        } catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = ['errors' => false];
        $customer = Customer::find($id);

        if(count($customer->assets) > 0) {
            $response['errors'] = true;
            $response['type_error'] = 'unable';
            return response()->json($response);
        } else {
            try {
                $customer->delete();
                Session::flash('message', 'Cliente eliminado correctamente');
                return response()->json(['errors' => false]);
            }catch(\Exception $e) {
                $response['errors'] = true;
                $response['type_error'] = 'exception';
                $response['errors_fragment'] = \View::make('partials.request')
                    ->withErrors([$e->getMessage()])
                    ->render();
                return response()->json($response);
            }
        }
    }
}
