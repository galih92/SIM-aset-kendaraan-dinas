<?php

Route::get('/', function () {
	return view('/auths/login');
});

Route::group(['middleware' => 'auth'],function(){
	
	Route::get('/petugas','PetugasController@index');
	Route::post('/petugas/create','PetugasController@create');
	Route::get('/petugas/{id}/edit','PetugasController@edit');
	Route::post('/petugas/{id}/update','PetugasController@update');
	Route::get('/petugas/{id}/delete','PetugasController@delete');

	Route::get('/kendaraan/exportpdf', 'KendaraanController@exportPdf')->name('rekappdf.kendaraan');
	Route::get('/kendaraan/exportexcel', 'KendaraanController@exportExcel');
	Route::resource('kendaraan', 'KendaraanController');
	Route::get('/kendaraan/search','KendaraanController@search');
	Route::get('/kendaraan/{id}/profile','KendaraanController@profile');
	Route::get('/kendaraan/{id}/bayar_pajak','KendaraanController@bayar_pajak');
	Route::get('/kendaraan/{id}/bayar_kir','KendaraanController@bayar_kir');
	Route::get('/kendaraan/{id}/delete','KendaraanController@delete');
	
	Route::get('/service/exportpdf', 'ServiceController@exportPdf')->name('rekappdf.service');
	Route::get('/service/exportexcel', 'ServiceController@exportExcel');
	Route::resource('service','ServiceController');
	Route::get('/service/{kendaraan_id}/delete','ServiceController@delete');
	Route::get('/service/{kendaraan_id}/update2','ServiceController@update2');
	Route::get('/service/{kendaraan_id}/terima','ServiceController@terima');
	Route::get('/service/{kendaraan_id}/selesai','ServiceController@selesai');

	Route::resource('user', 'UserController');
	Route::get('/user/{id}/delete','UserController@delete');


	//email
	Route::get('/petugas/{petugas_id}/email','PetugasController@email');
	Route::get('/email', function () {
		return view('send_email');
	});
	Route::post('/sendEmail', 'Email@sendEmail');

});
Route::get('/dashboard', 'DashboardController@index');
Route::get('/login', 'AuthController@login')->name('login');
Route::get('/kendaraan/cari','KendaraanController@cari');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');



