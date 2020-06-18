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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/loginAndroid', 'APIcontroller@loginAndroid');
Route::post('/profilAndroid', 'APIcontroller@profilAndroid');
Route::post('/kendaraanAndroid', 'APIcontroller@kendaraanAndroid');
Route::post('/insertService', 'APIcontroller@insertService');
Route::post('/kirimbukti', 'APIcontroller@kirimbukti');

Route::post('/maxbayar', 'APIcontroller@maxbayar');
Route::get('/pilihkendaraan={id}', 'APIcontroller@pilihkendaraan');
Route::get('/riwayatservice={id}', 'APIcontroller@riwayatservice');