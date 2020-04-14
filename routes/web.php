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

Route::get('/', function () {
    return view('home');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::prefix('admin')->group(function () {
    Route::post('/penggunaan-nomors', 'SuperController@indx')->name('indxnomor');
    Route::post('/penggunaan-nomors/add-nomor', 'SuperController@addNomor')->name('add.nd');




    Route::post('/', 'EKSTERNAL\PelabuhanController@addPelabuhan')->name('add.pelabuhan');
    Route::get('/edit/{id}', 'EKSTERNAL\PelabuhanController@editPelabuhan')->name('edit.pelabuhan');
    Route::post('/update/{id}', 'EKSTERNAL\PelabuhanController@updatePelabuhan')->name('update.pelabuhan');
    Route::delete('/hapus/{id}', 'EKSTERNAL\PelabuhanController@deletePelabuhan')->name('delete.pelabuhan');
    Route::get ('/PelabuhanMuat','EKSTERNAL\PelabuhanController@PelabuhanMuatExport')->name('export.pelabuhan');
});