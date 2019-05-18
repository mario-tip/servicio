<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CustomerRequest;
use Session;

class CustomerController extends Controller
{

    public function index()
    {
        if(userHasPermission("listar_catalogo_clientes")) {
            $customers = Customer::all();
            return view('catalogs.customers.index', compact('customers'));
        }
        return redirect()->back();
    }

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
            'types' => ['1' => 'Company', '2' => 'Person', '3' => 'Contract']
        ];
    }

    public function store(CustomerRequest $request)
    {
        try {
            Customer::create($request->get('customer'));
            $request->session()->flash('message', 'Customer created successfully');
            return redirect()->route('customers.index');
        } catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function edit($id)
    {
        if(userHasPermission("editar_catalogo_clientes")) {
            $customer = Customer::find($id);
            $requirements = $this->getRequirements();
            return view('catalogs.customers.edit', compact('customer', 'requirements'));
        }
        return redirect()->back();
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        try {
            $customer->fill($request->get('customer'));
            $customer->save();
            $request->session()->flash('message', 'Customer edit successfully');
            return redirect()->route('customers.index');
        } catch(\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

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
                Session::flash('message', 'Customer delete successfully');
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
