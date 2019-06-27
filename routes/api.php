<?php
use Illuminate\Http\Request;

Route::group(['prefix' => 'v1'], function () {
    Route::post('login','APIController@login');
    Route::post('loginAs', 'APIController@loginAs');
    Route::get('getToken/{token}', 'APIController@getToken');

    Route::group(array('middleware' => 'jwt.auth'),function(){
        Route::get('search-customer', 'APIController@searchCustomer');
        Route::get('search-services', 'APIController@searchServices');
        Route::get('get-calendar', 'APIController@getCalendar');
        Route::get('get-detail', 'APIController@getDetail');
        Route::get('get-asset-detail', 'APIController@getAssetDetail');
        Route::get('get-record', 'APIController@getRecord');
        Route::get('search-person', 'APIController@searchPerson');
        Route::post('update-asset', 'APIController@updateAsset');
        Route::post('resolution', 'APIController@resolution');
        Route::get('get-asset-detail-by-barcode','APIController@getAssetDetailByBarcode');
        Route::get('logout','APIController@logout');
        Route::resource('area','AreaController');

        // IDEA: new routes application cmms React native
        Route::resource('maintenance','AppMainController');
        Route::get('user','AppMainController@getUser');
        Route::get('getdepmaintenance','AppMainController@create');
        Route::post('findServices','AppMainController@searchServices');
        Route::post('attend','AppMainController@ResolveMain');
        Route::get('persons','AppMainController@GetPersons');

        // IDEA: Route list incidents
        Route::resource('incident','AppInciController');

    });
});
