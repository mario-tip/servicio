<?php

namespace App\Http\Controllers;

use App\User;
use App\Asset;
use App\Person;
use App\Customer;
use App\Incident;
use App\Equipment;
use Carbon\Carbon;
use App\Resolution;
use App\Maintenance;
use App\ServiceOrder;
use Illuminate\Http\Request;
use App\Mail\ServiceOrderEnd;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class APIController extends Controller
{
    /**
     * ws: login
     *
     * Inicia sesion como usuario con rol tecnico en la aplicacion
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        try {
            $validator = Validator::make(Input::all(), User::$validationRules, User::$validationMessages);
            if ($validator->fails()) {
                return response()->json(array('error' => true, 'message' => $validator->messages()->first() . '.', 'code' => 401), 400);
            } else {
                if (!$token = JWTAuth::attempt(['email' => Input::get('email'), 'password' => Input::get('password')])) {
                    return response()->json(array('error' => true, 'message' => 'Credenciales incorrectas', 'code' => 401));
                } else {
                    $context = JWTAuth::setToken($token);
                    $user = $context->authenticate();
                    if ($user)
                        $data = [
                            'token' => $token
                        ];

                    unset($user);

                    return response()->json(array('error' => false, 'result' => $data, 'code' => 200));
                }
            }
        } catch (JWTException $ex) {
            return response()->json(['error' => true, 'message' => 'Acceso no autorizado', 'code' => 401]);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage(), 'code' => 500]);
        }
    }

    /**
     * ws: search-customer
     *
     * Busca una palabra clave para la busqueda de un cliente
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchCustomer()
    {
        try {
            if (Input::has('keyword')) {
                $keyword = Input::get('keyword');

                if (strlen($keyword) < 3) {
                    $customers = Customer::where('name', 'like', '%' . $keyword . '%')->get()->take(20);
                } else {
                    $customers = Customer::where('name', 'like', '%' . $keyword . '%')->get();
                }

                $data = [];
                if (!$customers) {
                    return response()->json(array('error' => false, 'result' => [], 'code' => 204));
                } else {
                    foreach ($customers as $customer) {
                        $item = [
                            'customer_id' => $customer->id,
                            'customer_name' => $customer->name,
                        ];

                        $data[] = $item;
                    }

                    unset($customers);

                    return response()->json(array('error' => false, 'result' => $data, 'code' => 200));
                }
            } else {
                return response()->json(['error' => true, 'message' => 'Algo salió mal, intente nuevamente', 'code' => 400]);
            }
        } catch (JWTException $ex) {
            return response()->json(['error' => true, 'message' => 'Acceso no autorizado', 'code' => 401]);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage(), 'code' => 500]);
        }
    }

    /**
     * ws:search-services
     *
     * Regresa el listado de servicios de hoy segun el activo que este relacionado con el cliente que mande,
     * menor a mayor, debe traer un tipo para saber si es mantenimiento o incidencia
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchServices()
    {
        try {
            if (Input::has('customer_id') && Input::has('service_order_date')) {
                $customer_id = Input::get('customer_id');
                $service_order_date = Input::get('service_order_date');

                $incidents = Incident::select('assets.id as asset_id', 'assets.asset_custom_id', 'assets.name as asset_name',
                    'service_order.date', 'service_order.time', 'service_order.status', 'service_order.folio as service_order_folio',
                    'service_order.id as service_order_id', 'persons.address', 'service_order.type',
                    DB::raw('CONCAT(persons.name, " ",persons.father_last_name, " ",persons.mother_last_name) AS name'))
                    ->join('assets', 'assets.id', '=', 'incidents.asset_id')
                    ->join('persons', 'persons.id', '=', 'assets.person_id')
                    ->join('service_order', 'service_order.type_id', '=', 'incidents.id')
                    ->where('service_order.type', 0)
                    ->where('assets.customer_id', $customer_id)
                    ->where('service_order.date', $service_order_date)
                    ->where('service_order.user_id', Auth::user()->id)
                    ->get();

                $maintenances = Maintenance::select('assets.id as asset_id', 'assets.asset_custom_id', 'assets.name as asset_name',
                    'service_order.date', 'service_order.time', 'service_order.status', 'service_order.folio as service_order_folio',
                    'service_order.id as service_order_id', 'persons.address', 'service_order.type',
                    DB::raw('CONCAT(persons.name, " ",persons.father_last_name, " ",persons.mother_last_name) AS name'))
                    ->join('assets', 'assets.id', '=', 'maintenances.asset_id')
                    ->join('persons', 'persons.id', '=', 'assets.person_id')
                    ->join('service_order', 'service_order.type_id', '=', 'maintenances.id')
                    ->where('service_order.type', 1)
                    ->where('assets.customer_id', $customer_id)
                    ->where('service_order.date', $service_order_date)
                    ->where('service_order.user_id', Auth::user()->id)
                    ->get();

                $data = [];
                if (!$incidents || !$maintenances) {
                    return response()->json(array('error' => false, 'result' => [], 'code' => 204));
                } else {
                    foreach ($incidents as $incident) {
                        $item = [
                            'asset_id' => $incident->asset_id,
                            'asset_custom_id' => $incident->asset_custom_id,
                            'asset_name' => $incident->asset_name,
                            'service_order_date' => Carbon::parse($incident->date)->format('d-m-Y'),
                            'service_order_time' => $incident->time,
                            'service_status' => ($incident->status == 1) ? 'Atendido' : 'Pendiente',
                            'service_order_id' => $incident->service_order_id,
                            'service_order_folio' => $incident->service_order_folio,
                            'address' => $incident->address,
                            'type' => ($incident->type == 1) ? 'Mantenimiento' : 'Incidencia',
                            'person_name' => $incident->name,
                        ];

                        $data[] = $item;
                    }

                    foreach ($maintenances as $maintenance) {
                        $values = [
                            'asset_id' => $maintenance->asset_id,
                            'asset_custom_id' => $maintenance->asset_custom_id,
                            'asset_name' => $maintenance->asset_name,
                            'service_order_date' => Carbon::parse($maintenance->date)->format('d-m-Y'),
                            'service_order_time' => $maintenance->time,
                            'service_status' => ($maintenance->status == 1) ? 'Atendido' : 'Pendiente',
                            'service_order_id' => $maintenance->service_order_id,
                            'service_order_folio' => $maintenance->service_order_folio,
                            'address' => $maintenance->address,
                            'type' => ($maintenance->type == 1) ? 'Mantenimiento' : 'Incidencia',
                            'person_name' => $maintenance->name,
                        ];

                        $data[] = $values;
                    }

                    unset($incidents);
                    unset($maintenances);

                    return response()->json(array('error' => false, 'result' => $data, 'code' => 200));
                }
            } else {
                return response()->json(['error' => true, 'message' => 'Algo salió mal, intente nuevamente', 'code' => 400]);
            }
        } catch (JWTException $ex) {
            return response()->json(['error' => true, 'message' => 'Acceso no autorizado', 'code' => 401]);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage(), 'code' => 500]);
        }
    }

    /**
     * ws: get-calendar
     *
     * Regresa el listado de servicios segun el mes y el año
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCalendar()
    {
        try {
            if (Input::has('year') && Input::has('month') && Input::has('customer_id')) {
                $month = Input::get('month');
                $year = Input::get('year');
                $customer_id = Input::get('customer_id');

                $incidents = Incident::select('assets.id as asset_id', 'assets.asset_custom_id', 'assets.name as asset_name',
                    'service_order.date', 'service_order.time', 'service_order.status', 'service_order.folio as service_order_folio',
                    'service_order.id as service_order_id', 'persons.address', 'service_order.type',
                    DB::raw('CONCAT(persons.name, " ",persons.father_last_name, " ",persons.mother_last_name) AS name'),
                    'customers.id as customer_id')
                    ->join('assets', 'assets.id', '=', 'incidents.asset_id')
                    ->join('persons', 'persons.id', '=', 'assets.person_id')
                    ->join('customers', 'customers.id', '=', 'assets.customer_id')
                    ->join('service_order', 'service_order.type_id', '=', 'incidents.id')
                    ->where('service_order.type', 0)
                    ->where(DB::raw('MONTH(service_order.date)'), $month)
                    ->where(DB::raw('YEAR(service_order.date)'), $year)
                    ->where('assets.customer_id', $customer_id)
                    ->where('service_order.user_id', Auth::user()->id)
                    ->get();

                $maintenances = Maintenance::select('assets.id as asset_id', 'assets.asset_custom_id', 'assets.name as asset_name',
                    'service_order.date', 'service_order.time', 'service_order.status', 'service_order.folio as service_order_folio',
                    'service_order.id as service_order_id', 'persons.address', 'service_order.type',
                    DB::raw('CONCAT(persons.name, " ",persons.father_last_name, " ",persons.mother_last_name) AS name'),
                    'customers.id as customer_id')
                    ->join('assets', 'assets.id', '=', 'maintenances.asset_id')
                    ->join('persons', 'persons.id', '=', 'assets.person_id')
                    ->join('customers', 'customers.id', '=', 'assets.customer_id')
                    ->join('service_order', 'service_order.type_id', '=', 'maintenances.id')
                    ->where('service_order.type', 1)
                    ->where(DB::raw('MONTH(service_order.date)'), $month)
                    ->where(DB::raw('YEAR(service_order.date)'), $year)
                    ->where('assets.customer_id', $customer_id)
                    ->where('service_order.user_id', Auth::user()->id)
                    ->get();

                $data = [];
                if (!$incidents || !$maintenances) {
                    return response()->json(array('error' => false, 'result' => [], 'code' => 204));
                } else {
                    foreach ($incidents as $incident) {
                        $item = [
                            'asset_id' => $incident->asset_id,
                            'asset_custom_id' => $incident->asset_custom_id,
                            'asset_name' => $incident->asset_name,
                            'service_order_date' => Carbon::parse($incident->date)->format('d-m-Y'),
                            'service_order_time' => $incident->time,
                            'service_status' => ($incident->status == 1) ? 'Atendido' : 'Pendiente',
                            'service_order_id' => $incident->service_order_id,
                            'service_order_folio' => $incident->service_order_folio,
                            'address' => $incident->address,
                            'type' => ($incident->type == 1) ? 'Mantenimiento' : 'Incidencia',
                            'person_name' => $incident->name,
                            'customer_id' => $incident->customer_id,
                        ];

                        $data[] = $item;
                    }

                    foreach ($maintenances as $maintenance) {
                        $values = [
                            'asset_id' => $maintenance->asset_id,
                            'asset_custom_id' => $maintenance->asset_custom_id,
                            'asset_name' => $maintenance->asset_name,
                            'service_order_date' => Carbon::parse($maintenance->date)->format('d-m-Y'),
                            'service_order_time' => $maintenance->time,
                            'service_status' => ($maintenance->status == 1) ? 'Atendido' : 'Pendiente',
                            'service_order_id' => $maintenance->service_order_id,
                            'service_order_folio' => $maintenance->service_order_folio,
                            'address' => $maintenance->address,
                            'type' => ($maintenance->type == 1) ? 'Mantenimiento' : 'Incidencia',
                            'person_name' => $maintenance->name,
                            'customer_id' => $maintenance->customer_id,
                        ];

                        $data[] = $values;
                    }

                    unset($incidents);
                    unset($maintenances);

                    return response()->json(array('error' => false, 'result' => $data, 'code' => 200));
                }
            } else {
                return response()->json(['error' => true, 'message' => 'Algo salió mal, intente nuevamente', 'code' => 400]);
            }
        } catch (JWTException $ex) {
            return response()->json(['error' => true, 'message' => 'Acceso no autorizado', 'code' => 401]);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage(), 'code' => 500]);
        }
    }

    /**
     * ws: get-detail
     *
     *Regresa el detalle de la incidencia
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetail()
    {
        try {
            if (Input::has('service_order_id')) {
                $service_order_id = Input::get('service_order_id');

                $incidents = Incident::select('assets.id as asset_id', 'assets.asset_custom_id', 'assets.name as asset_name',
                    'service_order.date', 'service_order.time', 'service_order.status', 'service_order.folio as service_order_folio',
                    'service_order.id as service_order_id', 'persons.address', 'service_order.type', 'persons.id as person_id',
                    DB::raw('CONCAT(persons.name, " ",persons.father_last_name, " ",persons.mother_last_name) AS name'), 'assets.barcode')
                    ->join('assets', 'assets.id', '=', 'incidents.asset_id')
                    ->join('persons', 'persons.id', '=', 'assets.person_id')
                    ->join('service_order', 'service_order.type_id', '=', 'incidents.id')
                    ->where('service_order.type', 0)
                    ->where('service_order.id', $service_order_id)
                    ->where('service_order.user_id', Auth::user()->id)
                    ->get();

                $maintenances = Maintenance::select('assets.id as asset_id', 'assets.asset_custom_id', 'assets.name as asset_name',
                    'service_order.date', 'service_order.time', 'service_order.status', 'service_order.folio as service_order_folio',
                    'service_order.id as service_order_id', 'persons.address', 'service_order.type', 'persons.id as person_id',
                    DB::raw('CONCAT(persons.name, " ",persons.father_last_name, " ",persons.mother_last_name) AS name'), 'assets.barcode')
                    ->join('assets', 'assets.id', '=', 'maintenances.asset_id')
                    ->join('persons', 'persons.id', '=', 'assets.person_id')
                    ->join('service_order', 'service_order.type_id', '=', 'maintenances.id')
                    ->where('service_order.type', 1)
                    ->where('service_order.id', $service_order_id)
                    ->where('service_order.user_id', Auth::user()->id)
                    ->get();

                $data = [];
                if (!$incidents || !$maintenances) {
                    return response()->json(['error' => true, 'message' => 'No se encuentra la órden de servicio', 'code' => 400]);
                } else {
                    foreach ($incidents as $incident) {
                        $incident->parts = $incident->asset->parts()->select('parts.name', 'parts.number')->get();
                        $incident->locations = $incident->asset->locations()->select('locations.address', 'locations.building', 'locations.floor')->get();
                        $dir = '';
                        foreach ($incident->locations as $location) {
                            $dir = $location->address . ", Edificio #" . $location->building . ", Piso #" . $location->floor;
                        }

                        foreach ($incident->parts as $part) {
                            $part->part_name = $part->name;
                            $part->part_number = $part->number;

                            unset($part->name);
                            unset($part->number);
                        }

                        $item = [
                            'asset_id' => $incident->asset_id,
                            'asset_name' => $incident->asset_name,
                            'location' => $dir,
                            'person_id' => $incident->person_id,
                            'person_name' => $incident->name,
                            'service_status' => ($incident->status == 1) ? 'Atendido' : 'Pendiente',
                            'parts' => $incident->parts,
                            'service_order_id' => $incident->service_order_id,
                            'barcode' => $incident->barcode
                        ];

                        $data[] = $item;
                    }

                    foreach ($maintenances as $maintenance) {
                        $maintenance->locations = $maintenance->asset->locations()->select('locations.address', 'locations.building', 'locations.floor')->get();
                        $dir = '';
                        foreach ($maintenance->locations as $location) {
                            $dir = $location->address . ", Edificio #" . $location->building . ", Piso #" . $location->floor;
                        }

                        $values = [
                            'asset_id' => $maintenance->asset_id,
                            'asset_name' => $maintenance->asset_name,
                            'location' => $dir,
                            'person_id' => $maintenance->person_id,
                            'person_name' => $maintenance->name,
                            'service_status' => ($maintenance->status == 1) ? 'Atendido' : 'Pendiente',
                            'parts' => [],
                            'service_order_id' => $maintenance->service_order_id,
                            'barcode' => $maintenance->barcode
                        ];

                        $data[] = $values;
                    }

                    unset($incidents);

                    return response()->json(array('error' => false, 'result' => $data, 'code' => 200));
                }
            } else {
                return response()->json(['error' => true, 'message' => 'Algo salió mal, intente nuevamente', 'code' => 400]);
            }
        } catch (JWTException $ex) {
            return response()->json(['error' => true, 'message' => 'Acceso no autorizado', 'code' => 401]);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage(), 'code' => 500]);
        }
    }

    /**
     * ws: get-asset-detail
     *
     * Regresa el detalle de un activo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAssetDetail()
    {
        try {
            if (Input::has('asset_id')) {
                $asset_id = Input::get('asset_id');

                $asset = Asset::find($asset_id);

                $data = [];
                if (!$asset) {
                    return response()->json(['error' => true, 'message' => 'No se encuentra el activo', 'code' => 400]);
                } else {
                    $asset->parts = $asset->parts()->select('parts.name', 'parts.number')->get();

                    foreach ($asset->parts as $part) {
                        $part->part_name = $part->name;
                        $part->part_number = $part->number;

                        unset($part->name);
                        unset($part->number);
                    }

                    $item = [
                        'asset_id' => $asset->id,
                        'asset_custom_id' => $asset->asset_custom_id,
                        'asset_name' => $asset->name,
                        'model' => $asset->model,
                        'serial' => $asset->serial,
                        'brand' => $asset->brand,
                        'adquisition_date' => Carbon::parse($asset->adquisition_date)->format('d-m-Y'),
                        'condition' => ($asset->condition == 1) ? 'Usado' : 'Nuevo',
                        'status' => ($asset->status == 1) ? 'Activo' : 'Inactivo',
                        'provider_name' => isset($asset->provider) ? $asset->provider->name : '',
                        'expires_date' => Carbon::parse($asset->expires_date)->format('d-m-Y'),
                        'purchase_order' => $asset->purchase_order,
                        'next_maintenance' => Carbon::parse($asset->maintenance_date)->format('d-m-Y'),
                        'assets_parts' => $asset->parts,
                    ];

                    $data[] = $item;

                    unset($asset);

                    return response()->json(array('error' => false, 'result' => $data, 'code' => 200));
                }
            } else {
                return response()->json(['error' => true, 'message' => 'Algo salió mal, intente nuevamente', 'code' => 400]);
            }
        } catch (JWTException $ex) {
            return response()->json(['error' => true, 'message' => 'Acceso no autorizado', 'code' => 401]);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage(), 'code' => 500]);
        }
    }

    /**
     * ws:get-record
     *
     * Regresa el historial de un activo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRecord()
    {
        try {
            if (Input::has('asset_id')) {
                $asset_id = Input::get('asset_id');

                $incidents = Incident::select('assets.id as asset_id', 'assets.asset_custom_id', 'assets.name as asset_name',
                    'service_order.date', 'service_order.time', 'service_order.status', 'service_order.folio as service_order_folio',
                    'service_order.resolution_date', 'service_order.resolution_time',
                    'service_order.id as service_order_id', 'persons.address', 'service_order.type',
                    DB::raw('CONCAT(persons.name, " ",persons.father_last_name, " ",persons.mother_last_name) AS name'))
                    ->join('assets', 'assets.id', '=', 'incidents.asset_id')
                    ->join('persons', 'persons.id', '=', 'assets.person_id')
                    ->join('service_order', 'service_order.type_id', '=', 'incidents.id')
                    ->where('service_order.type', 0)
                    ->where('assets.id', $asset_id)
                    ->where('service_order.user_id', Auth::user()->id)
                    ->get();

                $maintenances = Maintenance::select('assets.id as asset_id', 'assets.asset_custom_id', 'assets.asset_custom_id', 'assets.name as asset_name',
                    'service_order.date', 'service_order.time', 'service_order.status', 'service_order.folio as service_order_folio',
                    'service_order.resolution_date', 'service_order.resolution_time',
                    'service_order.id as service_order_id', 'persons.address', 'service_order.type',
                    DB::raw('CONCAT(persons.name, " ",persons.father_last_name, " ",persons.mother_last_name) AS name'))
                    ->join('assets', 'assets.id', '=', 'maintenances.asset_id')
                    ->join('persons', 'persons.id', '=', 'assets.person_id')
                    ->join('service_order', 'service_order.type_id', '=', 'maintenances.id')
                    ->where('service_order.type', 1)
                    ->where('assets.id', $asset_id)
                    ->where('service_order.user_id', Auth::user()->id)
                    ->get();

                $data = [];
                if (!$incidents || !$maintenances) {
                    return response()->json(array('error' => false, 'result' => [], 'code' => 204));
                } else {
                    foreach ($incidents as $incident) {
                        $record = [];
                        $values = [
                            'date' => isset($incident->resolution_date) ? Carbon::parse($incident->resolution_date)->format('d-m-Y') : '',
                            'time' => isset($incident->resolution_time) ? $incident->resolution_time : '',
                            'person_name' => $incident->name,
                            'service_order_type' => ($incident->type == 1) ? 'Mantenimiento' : 'Inidencia',
                        ];

                        $record[] = $values;

                        $item = [
                            'asset_id' => $incident->asset_id,
                            'asset_name' => $incident->asset_name,
                            'asset_custom_id' => $incident->asset_custom_id,
                            'record' => $record
                        ];

                        $data[] = $item;
                    }

                    foreach ($maintenances as $maintenance) {
                        $record = [];
                        $val = [
                            'date' => isset($maintenance->resolution_date) ? Carbon::parse($maintenance->resolution_date)->format('d-m-Y') : '',
                            'time' => isset($incident->resolution_time) ? $maintenance->resolution_time : '',
                            'person_name' => $maintenance->name,
                            'service_order_type' => ($maintenance->type == 1) ? 'Mantenimiento' : 'Inidencia',
                        ];

                        $record[] = $val;

                        $items = [
                            'asset_id' => $maintenance->asset_id,
                            'asset_name' => $maintenance->asset_name,
                            'asset_custom_id' => $maintenance->asset_custom_id,
                            'record' => $record
                        ];

                        $data[] = $items;
                    }

                    unset($incidents);
                    unset($maintenances);

                    return response()->json(array('error' => false, 'result' => $data, 'code' => 200));
                }
            } else {
                return response()->json(['error' => true, 'message' => 'Algo salió mal, intente nuevamente', 'code' => 400]);
            }
        } catch (JWTException $ex) {
            return response()->json(['error' => true, 'message' => 'Acceso no autorizado', 'code' => 401]);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage(), 'code' => 500]);
        }
    }

    /**
     * ws: search-person
     *
     * Busca una palabra clave para la busqueda de una persona
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchPerson()
    {
        try {
            if (Input::has('keyword')) {
                $keyword = Input::get('keyword');

                $words = explode(' ', $keyword);
                $size = sizeof($words);
                switch ($size) {
                    case 1:
                        $persons = Person::where('name', 'like', '%' . $words[0] . '%')->get();
                        break;
                    case 2:
                        $persons = Person::whereRaw("concat(name, ' ', father_last_name) like '%$keyword%' ")->get();
                        break;
                    case 3:
                        $persons = Person::whereRaw("concat(name, ' ', father_last_name, ' ', mother_last_name) like '%$keyword%' ")->get();
                        break;
                }

                if (strlen($keyword) < 3) {
                    $persons = $persons->take(20);
                }

                $data = [];
                if (!$persons) {
                    return response()->json(array('error' => false, 'result' => [], 'code' => 204));
                } else {
                    foreach ($persons as $person) {
                        $item = [
                            'person_id' => $person->id,
                            'person_name' => $person->name . ' ' . $person->father_last_name . ' ' . $person->mother_last_name,
                        ];

                        $data[] = $item;
                    }

                    unset($persons);

                    return response()->json(array('error' => false, 'result' => $data, 'code' => 200));
                }
            } else {
                return response()->json(['error' => true, 'message' => 'Algo salió mal, intente nuevamente', 'code' => 400]);
            }
        } catch (JWTException $ex) {
            return response()->json(['error' => true, 'message' => 'Acceso no autorizado', 'code' => 401]);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage(), 'code' => 500]);
        }
    }

    /**
     * ws: update-asset
     *
     * Edita la informacion de un activo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateAsset()
    {
        try {
            if (Input::has('asset_id') || Input::has('asset_name') || Input::has('model') || Input::has('serial') ||
                Input::has('brand') || Input::has('condition') || Input::has('status') || Input::has('asset_parts')
            ) {
                $asset_id = Input::get('asset_id');

                DB::beginTransaction();
                $asset = Asset::find($asset_id);

                $data = [
                    'name' => Input::get('asset_name'),
                    'model' => Input::get('model'),
                    'serial' => Input::get('serial'),
                    'brand' => Input::get('brand'),
                    'condition' => Input::get('condition'),
                    'status' => Input::get('status'),
                ];

                unset($data['asset_name']);

                $asset_parts = Input::get('asset_parts');
                if (!empty($asset_parts)) {
                    $parts = $asset->parts()->detach($asset_parts);
                }

                $asset->update($data);

                DB::commit();

                if (!$asset) {
                    DB::rollback();
                    return response()->json(['error' => true, 'message' => 'No se pudo actualizar el activo', 'code' => 400]);
                } else {
                    return response()->json(['error' => false, 'message' => 'Activo actualizado con exito', 'code' => 200]);
                }
            } else {
                return response()->json(['error' => true, 'message' => 'Algo salió mal, intente nuevamente', 'code' => 400]);
            }
        } catch (JWTException $ex) {
            return response()->json(['error' => true, 'message' => 'Acceso no autorizado', 'code' => 401]);
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['error' => true, 'message' => $ex->getMessage(), 'code' => 500]);
        }
    }

    /**
     * ws: resolution
     *
     * Envia la firma y crea un nuevo registro de visita
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function resolution(Request $request)
    {
        try {
            if (Input::has('service_order_id') || Input::has('person_id') || Input::has('parts') ||
                Input::hasFile('signature') || Input::has('comments') || Input::has('resolution_status')
            ) {
                $service_order_id = Input::get('service_order_id');
                $person_id = Input::get('person_id');
                $parts = Input::get('parts');
                $comments = Input::get('comments');
                $resolution_status = Input::get('resolution_status');
                $signature = Input::file('signature');

                DB::beginTransaction();
                $service_order = ServiceOrder::find($service_order_id);

                if (!empty($signature)) {
                    $file = $signature->getClientOriginalName();
                    $ext = $signature->getClientOriginalExtension();
                    $name = str_random(10) . "_" . time() . "_" . "signature" . "." . $ext;
                    $fileLogo = 'images/resolutions/' . $name;
                } else {
                    $fileLogo = $service_order->signature;
                }

                if (!empty($signature)) {
                    $file = $service_order->signature;
                    if ($file != '') {
                        if (file_exists(public_path() . '/' . $file)) {
                            unlink(public_path() . '/' . $file);
                        }
                    }
                }

                $service_order->status = $resolution_status;
                $service_order->signature = $fileLogo;
                $service_order->resolution_date = Carbon::now()->format('Y-m-d');
                $service_order->resolution_time = Carbon::now()->format('H:i:s');
                $service_order->comments = $comments;
                $service_order->person_id = $person_id;
                $service_order->save();


                // DB::table('log')->insert([
                //     "texto" => $service_order
                // ]);

                // dd("hola");
                //Aqui vamos a enviar el correo de que el servicio (Mantenimiento, incidencia) fue realizado con exito
                $user = $request->user();

                $users_send = DB::table('users')
                ->join('user_notification_end', 'users.id', '=', 'user_notification_end.notification_end_id')
                ->select('users.*')
                ->where('user_notification_end.user_id', '=', $user->id)
                ->get();


                if($user->active_notification_end){
                    Mail::to($user->email)->send(new ServiceOrderEnd($service_order));
                }

                foreach ($users_send as $key => $user_send) {
                    Mail::to($user_send->email)->send(new ServiceOrderEnd($service_order));
                }

                // DB::table('log')->insert([
                //     "texto" => $user
                // ]);

                // DB::table('log')->insert([
                //     "texto" => $users_send
                // ]);

                if (!empty($parts)) {
                    if ($service_order->type == 0) {
                        $incident = Incident::find($service_order->type_id);
                        $incident_parts = $incident->parts()->sync($parts);
                    }
                }

                if (!empty($signature)) {
                    $folder = public_path() . '/images/resolutions';
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                        $signature->move(public_path() . '/images/resolutions/', $fileLogo);
                    } else {
                        $signature->move(public_path() . '/images/resolutions/', $fileLogo);
                    }
                }

                DB::commit();

                if (!$person_id) {
                    DB::rollback();
                    return response()->json(['error' => true, 'message' => 'No se pudo guardar el registro', 'code' => 400]);
                } else {
                    return response()->json(['error' => false, 'message' => 'Registro guardado correctamente', 'code' => 200]);
                }
            } else {
                return response()->json(['error' => true, 'message' => 'Algo salió mal, intente nuevamente', 'code' => 400]);
            }
        } catch (JWTException $ex) {
            return response()->json(['error' => true, 'message' => 'Acceso no autorizado', 'code' => 401]);
        } catch (\Exception $ex) {
            DB::rollBack();

            return response()->json(['error' => true, 'message' => $ex->getMessage(), 'code' => 500]);
        }
    }

    /**
     * ws: get-asset-detail-by-barcode
     *
     * Regresa el detalle de un activo según el código de barras
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAssetDetailByBarcode()
    {
        try {
            if (Input::has('barcode')) {
                $barcode = Input::get('barcode');

                $asset = Asset::where('barcode', $barcode)->first();

                $data = [];
                if (!$asset) {
                    return response()->json(['error' => true, 'message' => 'No se encuentra el activo', 'code' => 400]);
                } else {
                    $asset->parts = $asset->parts()->select('parts.name', 'parts.number')->get();

                    foreach ($asset->parts as $part) {
                        $part->part_name = $part->name;
                        $part->part_number = $part->number;

                        unset($part->name);
                        unset($part->number);
                    }

                    $item = [
                        'asset_id' => $asset->id,
                        'asset_custom_id' => $asset->asset_custom_id,
                        'asset_name' => $asset->name,
                        'model' => $asset->model,
                        'serial' => $asset->serial,
                        'brand' => $asset->brand,
                        'adquisition_date' => Carbon::parse($asset->adquisition_date)->format('d-m-Y'),
                        'condition' => ($asset->condition == 1) ? 'Usado' : 'Nuevo',
                        'status' => ($asset->status == 1) ? 'Activo' : 'Inactivo',
                        'provider_name' => isset($asset->provider) ? $asset->provider->name : '',
                        'expires_date' => Carbon::parse($asset->expires_date)->format('d-m-Y'),
                        'purchase_order' => $asset->purchase_order,
                        'next_maintenance' => Carbon::parse($asset->maintenance_date)->format('d-m-Y'),
                        'assets_parts' => $asset->parts,
                    ];

                    $data[] = $item;

                    unset($asset);

                    return response()->json(array('error' => false, 'result' => $data, 'code' => 200));
                }
            } else {
                return response()->json(['error' => true, 'message' => 'Algo salió mal, intente nuevamente', 'code' => 400]);
            }
        } catch (JWTException $ex) {
            return response()->json(['error' => true, 'message' => 'Acceso no autorizado', 'code' => 401]);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage(), 'code' => 500]);
        }
    }

    /**
     * ws: logout
     *
     * Cierra sesion como usuario con rol tecnico en la aplicacion
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            if (Auth::check()) {
                Auth::logout();
                return response()->json(array('error' => false, 'message' => 'Sesión cerrada con éxito', 'code' => 200));
            } else {
                return response()->json(array('error' => true, 'message' => 'No se pudo cerrar sesión', 'code' => 400));
            }
        } catch (JWTException $e) {
            return response()->json(['error' => true, 'message' => 'Acceso no autorizado', 'code' => 401]);
        } catch (\Exception $ex) {
            return response()->json(['error' => true, 'message' => $ex->getMessage(), 'code' => 500]);
        }
    }

    /**
     * ws: loginAs
     *
     * Autentifica un usuario
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginAs()
    {
        $user_id = Input::get('user_id');
        $company_id = Input::get('company_id');
        setConnection($company_id);
        \Auth::loginUsingId($user_id);
        return Redirect('/');
    }

    //recibe el token generado y autentica al usuario
    public function getToken($token)
    {

        $context = JWTAuth::setToken($token);
        $user = $context->authenticate();
        Auth::login($user);
        if (Auth::check()) {
            return Redirect('/');
        }
    }
}
