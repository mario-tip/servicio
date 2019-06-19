<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

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

        Route::get('get-asset-detail-by-barcode', 'APIController@getAssetDetailByBarcode');

        Route::get('logout', 'APIController@logout');

        Route::resource('area', 'AreaController');

        Route::resource('maintenance','AppCmmsController');

        Route::get('user', 'AppCmmsController@getUser');

        Route::get('getdepmaintenance','AppCmmsController@create');

        Route::post('findServices' , 'AppCmmsController@searchServices');

    });
});
