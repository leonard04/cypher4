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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', 'Api\LoginController@login');
Route::get('company' , 'Api\LoginController@getCompany');
//PO
Route::get('po/{comp_id}','Api\AssetPoController@index');
Route::get('po/detail/{comp_id}/{id}','Api\AssetPoController@getDetail');
Route::post('po/approve', 'Api\AssetPoController@approve');
//WO
Route::get('wo/{comp_id}','Api\AssetWoController@index');
Route::get('wo/detail/{comp_id}/{id}','Api\AssetWoController@getDetail');
Route::post('wo/approve', 'Api\AssetWoController@approve');
