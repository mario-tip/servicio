<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Rutas para autenticación
Auth::routes();

// Ruta para home
Route::get('/',['as'=>'Dashboard','uses'=>'HomeController@index']);

Route::resource('/users', 'UserController');

Route::resource('/roles', 'RoleController');
// Route::get('/users/roles', 'RoleController@index');

// Route::get('/users/roles', ['as' => 'Role.index', 'uses' => 'RoleController@index']);

Route::post('searchEmail', 'UserController@searchEmail');

//Assets
Route::resource('/actives', 'AssetController');
Route::get('/get-equipment-parts', 'AssetController@getEquipmentParts');

//Firmware
Route::post('/firmwares', ['as' => 'firmwares.store', 'uses' => 'FirmwareController@store']);
Route::get('/firmwares/{asset_id}', ['as' => 'firmwares.index', 'uses' => 'FirmwareController@index']);

//Equipment
Route::resource('/equipments', 'EquipmentController');
Route::get('/get-select2-parts', 'EquipmentController@getSelect2Parts');
Route::post('/get-part', 'EquipmentController@getPart');

//Quotation
Route::resource('/quotations', 'QuotationController');
Route::get('/get-select2-incidents', 'QuotationController@getSelect2Incidents');
Route::get('/get-incident-parts', 'QuotationController@getIncidentParts');
Route::post('/change-authorization-status', 'QuotationController@changeAuthorizationStatus');

//Service orders
Route::get('/help_service', function () {
    return view('help_service.index');
});

Route::get('service-orders/create/{incident_id}', ['as' => 'service-orders.create',
    'uses' => 'ServiceOrderController@create'
]);
Route::resource('/service-orders', 'ServiceOrderController');

// analytics_incidents

Route::get('/analytics_incident', function () {
    if(userHasPermission("listar_consulta_atencion_incidencias") || userHasPermission("generar_reporte_incidencias")){
        return view('analytics_incident.index');
    }
    return redirect()->back();
});


//Reports
Route::get('/reports', function () {
    return view('reports.index');
});
//Show reports views
Route::get('/reports/technician-tickets', ['as' => 'reports.technician-tickets',
    'uses' => 'ReportController@showTechnicianTickets']);
Route::get('/reports/incidents', ['as' => 'reports.incidents', 'uses' => 'ReportController@showIncidents']);
Route::get('/reports/customer-service-orders', ['as' => 'reports.customer-service-orders',
    'uses' => 'ReportController@showCustomerServiceOrders']);
Route::get('/reports/binnacle-service-orders', ['as' => 'reports.binnacle-service-orders',
    'uses' => 'ReportController@showBinnacleServiceOrders']);

//Generate and Download reports
Route::post('/reports/generate-technician-tickets', ['as' => 'reports.generate-technician-tickets',
    'uses' => 'ReportController@generateTechnicianTickets']);
Route::post('/reports/export-technician-tickets', ['as' => 'reports.export-technician-tickets',
    'uses' => 'ReportController@exportTechnicianTickets']);
Route::post('/reports/generate-incidents', ['as' => 'reports.generate-incidents',
    'uses' => 'ReportController@generateIncidents']);
Route::post('/reports/export-incidents', ['as' => 'reports.export-incidents',
    'uses' => 'ReportController@exportIncidents']);
Route::post('/reports/generate-customer-service-orders', ['as' => 'reports.generate-customer-service-orders','uses' => 'ReportController@generateCustomerServiceOrders']);
Route::post('/reports/export-customer-service-orders', ['as' => 'reports.export-customer-service-orders',
    'uses' => 'ReportController@exportCustomerServiceOrders']);

//Binnacle service report
Route::post('/reports/generate-binnacle-service-orders', ['as' => 'reports.generate-binnacle-service-orders',
    'uses' => 'ReportController@generateBinnacleServiceOrders']);
Route::post('/reports/export-binnacle-service-orders', ['as' => 'reports.export-binnacle-service-orders',
    'uses' => 'ReportController@exportBinnacleServiceOrders']);

/**** Catalogs *****/
Route::get('/catalogs', function () {
    return view('catalogs.index');
});

//Locations
Route::resource('/catalogs/locations', 'LocationController');

//Projects
Route::resource('/catalogs/projects', 'ProjectController');

//Customers
Route::resource('/catalogs/customers', 'CustomerController');

//Providers
Route::resource('/catalogs/providers', 'ProviderController');

//Persons
Route::resource('/catalogs/persons', 'PersonController');

/**** End Catalogs *****/
// Maintenances
Route::resource('/maintenances', 'MaintenanceController');
Route::get('findTechnician', 'MaintenanceController@findTechnician');
Route::post('/maintenances/search_dates', 'MaintenanceController@search_dates');
Route::get('/assetData/{id}', ['as' => 'findAsset', 'uses' => 'MaintenanceController@assetData']);
Route::get('getDataTechnician/{id}', 'MaintenanceController@getDataTechnician');

// Problems
// Route::resource('/maintenances', 'MaintenanceController');
// Route::get('findTechnician', 'MaintenanceController@findTechnician');
// Route::post('/maintenances/search_dates', 'MaintenanceController@search_dates');
// Route::get('/assetData/{id}', ['as' => 'findAsset', 'uses' => 'MaintenanceController@assetData']);
// Route::get('getDataTechnician/{id}', 'MaintenanceController@getDataTechnician');
Route::get('/problems', function () {
    return view('problems.index');
});

// Route to manage incidents
Route::resource('/incidents', 'IncidentController');
Route::get('aid', 'IncidentController@getIncidents');
Route::get('incidents_datails/{id}', 'IncidentController@getIncidentDetails');
Route::get('customerIncidents/{id}', 'IncidentController@getCustomerIncidents');
Route::get('customerIncidentsDetails/{id}', 'IncidentController@getCustomerIncidentsDetails');
Route::get('findAsset', 'IncidentController@getAsset');
Route::get('getDataAsset/{id}', 'IncidentController@getDataAsset');
Route::get('/tags-asset/{id}', ['as' => 'tags-asset', 'uses' => 'IncidentController@tagAsset']);
Route::get('getIncidentParts','IncidentController@getIncidentParts');

// Route to manage parts
Route::resource('/parts', 'PartController');

//Ws to loginAs
Route::post('loginAs', 'APIController@loginAs');
