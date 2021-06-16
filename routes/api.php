<?php

use Illuminate\Http\Request;


Route::group(['middleware' => ['cors']], function () {


//Clientes
Route::get('getClientes/{searchText}', 'ClienteController@getClientes');
Route::post('createCliente', 'ClienteController@createCliente');
Route::put('updateCliente/{email}', 'ClienteController@updateCliente');
Route::delete('deleteCliente/{email}', 'ClienteController@deleteCliente');

//Viajes
Route::post('createViajes', 'ViajeController@createViajes');
Route::get('getViajes', 'ViajeController@getViajes');



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

});