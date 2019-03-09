<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Log;

class ServiceOrder extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'service_order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'folio',
        'date',
        'time',
        'notes',
        'type',
        'status',
        'signature',
        'resolution_date',
        'resolution_time',
        'comments',
        'type_id',
        'user_id',
        'person_id'
    ];

    public function serviceable()
    {
        return $this->morphTo();
    }

    public function incident()
    {
        return $this->hasOne('App\Incident', 'id', 'type_id');

    }

    public function maintenance()
    {
        return $this->hasOne('App\Maintenance', 'id', 'type_id');
        
    }

    public function technician()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function authorizer()
    {
        return $this->hasOne('App\Person', 'id', 'person_id');
    }

    public function quotation()
    {
        return $this->hasOne('App\Quotation', 'incident_id', 'type_id');
    }

    /*Accessors*/
    public function getDateAttribute($value)
    {
        return isset($value) ? Carbon::parse($value)->format('d-m-Y') : null;
    }

    public function getIncidentTypeWord()
    {
        $incidents = [
            '0' => 'Incident',
            '1' => 'Maintenance'
        ];
        return $incidents[$this->type];
    }
    public function getStatusWord()
    {
        $incidents = [
            '0' => 'Pending',
            '1' => 'Attended'
        ];
        
        return $incidents[$this->status];
    }

    /**STAR TECHNICIAN TICKETS**/
    public static function generateTechnicianTickets($filters)
    {
        $query = self::select('service_order.folio AS folio', 'customers.name AS customer', 'persons.name AS person',
                'assets.name AS asset', DB::raw('CONCAT(service_order.resolution_date," ",service_order.resolution_time) AS resolution_date'),
                'users.name AS technician', 'locations.address AS location',
                DB::raw("(CASE WHEN service_order.status = 0 THEN 'Pending' ELSE 'Attended' END) AS status"))
                ->join('incidents', 'incidents.id', '=', 'service_order.type_id')
                ->join('assets', 'assets.id', '=', 'incidents.asset_id')
                ->leftJoin('inventory', 'assets.id', '=', 'inventory.asset_id')
                ->leftJoin('locations', 'inventory.location_id', '=', 'locations.id')
                ->join('users', 'users.id', '=', 'service_order.user_id')
                ->join('persons', 'persons.id', '=', 'incidents.person_id')
                ->leftJoin('customers', 'assets.customer_id', '=', 'customers.id');

        $query = self::addTechnicianTicketFilters($query, $filters);
        $results = $query->get();
        return $results;
    }

    /*Agrega los filtros que lleguen en el request*/
    private static function addTechnicianTicketFilters($query, $filters)
    {
        $query = self::addDateFilters($query, $filters);

        if($filters['status'] != '' && $filters['status'] != '2') {
            $query->where('service_order.status', $filters['status']);
        }
        if($filters['user_id'] != '' && $filters['user_id'] != '0') {
            $query->where('users.id', $filters['user_id']);
        }
        if($filters['project_id'] != '' && $filters['project_id'] != '0') {
            $query->where('assets.project_id', $filters['project_id']);
        }
        return $query;
    }
    /**END TECHNICIAN TICKETS**/

    /**START INCIDENTS**/
    public static function generateIncidents($filters)
    {
        $query = self::select('service_order.folio AS folio', 'assets.id AS asset_id', 'customers.name AS customer',
                'persons.name AS person', 'assets.name AS asset_name',
                DB::raw('CONCAT(service_order.resolution_date," ",service_order.resolution_time) AS resolution_date'),
                'users.name AS technician', 'locations.address AS location',
                DB::raw("(CASE WHEN service_order.status = 0 THEN 'Pending' ELSE 'Attended' END) AS status"))
                ->join('incidents', 'incidents.id', '=', 'service_order.type_id')
                ->join('assets', 'assets.id', '=', 'incidents.asset_id')
                ->leftJoin('inventory', 'assets.id', '=', 'inventory.asset_id')
                ->leftJoin('locations', 'inventory.location_id', '=', 'locations.id')
                ->join('users', 'users.id', '=', 'service_order.user_id')
                ->join('persons', 'persons.id', '=', 'incidents.person_id')
                ->leftJoin('customers', 'assets.customer_id', '=', 'customers.id');

        $query = self::addIncidentFilters($query, $filters);
        return $query->get();
    }

    private static function addIncidentFilters($query, $filters)
    {
        $query = self::addDateFilters($query, $filters);

        if($filters['type'] != '' && $filters['type'] != '2') {
            $query->where('service_order.type', $filters['type']);
        }
        return $query;
    }
    /**END INCIDENTS**/

    /**START CUSTOMER SERVICE ORDERS**/
    public static function generateCustomerServiceOrders($filters)
    {
        $query = self::select('service_order.folio AS folio',
                              'customers.name AS customer',
                              'persons.name AS person',
                              'assets.name AS asset',

                              DB::raw('incidents.created_at AS date_incident'),//Fecha de levantamiento de la incidencia

                              DB::raw('CONCAT(service_order.resolution_date," ",service_order.resolution_time) AS resolution_date'),
                              'users.name AS technician', 'locations.address AS location',

                              DB::raw("(CASE WHEN service_order.status = 0 THEN 'Pending' ELSE 'Attended' END) AS status"))
                ->join('incidents', 'incidents.id', '=', 'service_order.type_id')
                ->join('assets', 'assets.id', '=', 'incidents.asset_id')
                ->leftJoin('inventory', 'assets.id', '=', 'inventory.asset_id')
                ->leftJoin('locations', 'inventory.location_id', '=', 'locations.id')
                ->join('users', 'users.id', '=', 'service_order.user_id')
                ->join('persons', 'persons.id', '=', 'incidents.person_id')
                ->leftJoin('customers', 'assets.customer_id', '=', 'customers.id');

        $query = self::addCustomerServiceOrdersFilters($query, $filters);
        $test=$query->get();
        // dd($test);

        $queryReturn = self::calculate($test);

        return $queryReturn;
    }

    public static function calculate($query_cal)
    {

      // dd (gettype($query_cal));

      // global $query_cal; //evita array_push() expects parameter 1 to be array, object given
      foreach ($query_cal as $key => $value) {
        if ($value['resolution_date']) {

          $dateResolution = Carbon::parse($value['resolution_date']);
          $dateIncident = Carbon::parse($value['date_incident']);
          $lengthOfAd = $dateResolution->diffInHours($dateIncident);
        }else {
          $lengthOfAd= null;
        }
        $value['time_request'] = $lengthOfAd;
      }

      // $query_cal->append('cuarto');


      // $query_cal->append('cuarto');
      // $query_cal->offsetSet('grupo', array('g1', 'g2'));
      // dd($query_cal);
      return $query_cal;

    }


    /*Agrega los filtros que lleguen en el request*/
    private static function addCustomerServiceOrdersFilters($query, $filters)
    {
        $query = self::addDateFilters($query, $filters);

        if($filters['customer_id'] != '' && $filters['customer_id'] != '0') {
            $query->where('customers.id', $filters['customer_id']);
        }
        if($filters['project_id'] != '' && $filters['project_id'] != '0') {
            $query->where('assets.project_id', $filters['project_id']);
        }
        return $query;
    }
    /**END CUSTOMER SERVICE ORDERS**/
    /**START BINNACLE SERVICE ORDERS**/
    public static function generateBinnacleServiceOrders($filters)
    {
        $query = self::select('service_order.folio AS folio', 'customers.name AS customer', 'persons.name AS person',
                'assets.name AS asset', DB::raw('CONCAT(service_order.resolution_date," ",service_order.resolution_time) AS resolution_date'),
                'users.name AS technician', 'locations.address AS location',
                DB::raw("(CASE WHEN service_order.status = 0 THEN 'Pending' ELSE 'Attended' END) AS status"))
                ->join('incidents', 'incidents.id', '=', 'service_order.type_id')
                ->join('assets', 'assets.id', '=', 'incidents.asset_id')
                ->leftJoin('inventory', 'assets.id', '=', 'inventory.asset_id')
                ->leftJoin('locations', 'inventory.location_id', '=', 'locations.id')
                ->join('users', 'users.id', '=', 'service_order.user_id')
                ->join('persons', 'persons.id', '=', 'incidents.person_id')
                ->leftJoin('customers', 'assets.customer_id', '=', 'customers.id');

        $query = self::addBinnacleServiceOrdersFilters($query, $filters);
        return $query->get();
    }

    /*Agrega los filtros que lleguen en el request*/
    private static function addBinnacleServiceOrdersFilters($query, $filters)
    {
        $query = self::addDateFilters($query, $filters);
        return $query;
    }
    /**END BINNACLE SERVICE ORDERS*/

    /*Agrega filtros de fechas*/
    private static function addDateFilters($query, $filters)
    {
        if($filters['start_date'] != '' && $filters['end_date'] != '') {
            $start_date = Carbon::parse($filters['start_date'])->format('Y-m-d');
            $end_date = Carbon::parse($filters['end_date'])->format('Y-m-d');
            $end_date = $end_date . ' 23:59:59';
            $query->whereBetween('service_order.created_at', [$start_date, $end_date]);
        }

        return $query;
    }

}
