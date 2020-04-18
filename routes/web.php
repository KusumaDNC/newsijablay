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

    /*Route::get('input-data-osses','App\Http\Controllers\Voyager\DataOssController@import')->name('import.rekoss');*/
});


/*Route::prefix('admin')->group(function () {
    Route::get('/penggunaan-nomors', 'SuperController@index')->name('indxnomor');
    Route::post('/penggunaan-nomors/store', 'SuperController@addnmrs')->name('nmr.store');*/
 //    Route::get('/penggunaan-nomors', 'Sekretariat\Nomor\SettingNomorController@showSetting')->name('show.setting-nomor');
	// Route::post('//penggunaan-nomors/add-nomor', 'Sekretariat\Nomor\SettingNomorController@addNomor')->name('add.nd');
 //        Route::get('/settings/edit-nomor/{id}', 'Sekretariat\Nomor\SettingNomorController@editNomor')->name('edit.nd');
 //        Route::patch('/settings/update-nomor/{id}', 'Sekretariat\Nomor\SettingNomorController@updateNomor')->name('update.nd');

 //    Route::post('/', 'EKSTERNAL\PelabuhanController@addPelabuhan')->name('add.pelabuhan');
 //    Route::get('/edit/{id}', 'EKSTERNAL\PelabuhanController@editPelabuhan')->name('edit.pelabuhan');
 //    Route::post('/update/{id}', 'EKSTERNAL\PelabuhanController@updatePelabuhan')->name('update.pelabuhan');
 //    Route::delete('/hapus/{id}', 'EKSTERNAL\PelabuhanController@deletePelabuhan')->name('delete.pelabuhan');
 //    Route::get ('/PelabuhanMuat','EKSTERNAL\PelabuhanController@PelabuhanMuatExport')->name('export.pelabuhan');
/*});*/


