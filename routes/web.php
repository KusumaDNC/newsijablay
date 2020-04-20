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
    Route::get('/penggunaan-nomors', 'SuperController@index')->name('indxnomor');
    Route::post('/penggunaan-nomors/store', 'SuperController@addnmrs')->name('nmr.store');
	//spt
	Route::get('/spt', 'SuperController@gabung')->name('sptgabung');
    Route::post('/spt/all', 'SuperController@addspt')->name('create.spt');

        // Route::get('/spt/all', 'SPT\CreateSPTController@gabung')->name('form.spt');
        // Route::post('/spt/all', 'SPT\CreateSPTController@store')->name('create.spt');

        
        Route::get('/spt/all/edit/{id}', 'SPT\CreateSPTController@edit')->name('edit.spt');
        Route::patch('/spt/all/update/{id}', 'SPT\CreateSPTController@update')->name('update.spt');
        Route::get('/spt/rekap/spt', 'SPT\RekapSPTController@getSpt')->name('rekap.spt');

        Route::get('/spt/spt_cetak/{id}', 'SPT\RekapSPTController@cetakSpt')->name('cetak.spt');
        Route::get('/spt/sppd_cetak/{id}', 'SPT\RekapSPTController@cetakSppd')->name('cetak.sppd');
        Route::get('/spt/nodin_cetak/{id}', 'SPT\RekapSPTController@cetakNodin')->name('cetak.nodin');
        Route::delete('/spt/hapus/{id}', 'SPT\RekapSPTController@hapusSpt')->name('hapus.spt');
        Route::delete('/spt/destroy/{id}', 'SPT\RekapSPTController@destroy')->name('destroy.spt');

        Route::get('/spt/advance', 'SPT\AdvanceSPTController@formSPT')->name('adv.spt');
        Route::post('/spt/advance', 'SPT\AdvanceSPTController@postSPT')->name('adv.postSpt');
        Route::get('/spt/advance/sppd', 'SPT\AdvanceSPTController@getSPPD')->name('adv.sppd');
        Route::get('/spt/sppd_cetak-adv/{id}', 'SPT\AdvanceSPTController@cetakAdvSppd')->name('cetak-adv.sppd');

        Route::get('/spt/setting/spt', 'SPT\CreateSPTController@gabung')->name('setting.spt');
        Route::post('/spt/setting/formDasarHukum','SPT\DasarHukumController@addDasarHukum')->name('add.dasar');
        Route::get('/sptsetting/edit/{id}', 'SPT\DasarHukumController@editDasarHukum')->name('edit.dasar');
        Route::patch('/spt/setting/update/{id}', 'SPT\DasarHukumController@updateDasarHukum')->name('update.dasar');
        Route::delete('/spt/setting/detete/{id}', 'SPT\DasarHukumcontroller@deleteDasarHukum')->name('delete.dasar');


 //    Route::get('/penggunaan-nomors', 'Sekretariat\Nomor\SettingNomorController@showSetting')->name('show.setting-nomor');
	// Route::post('//penggunaan-nomors/add-nomor', 'Sekretariat\Nomor\SettingNomorController@addNomor')->name('add.nd');
 //        Route::get('/settings/edit-nomor/{id}', 'Sekretariat\Nomor\SettingNomorController@editNomor')->name('edit.nd');
 //        Route::patch('/settings/update-nomor/{id}', 'Sekretariat\Nomor\SettingNomorController@updateNomor')->name('update.nd');

 //    Route::post('/', 'EKSTERNAL\PelabuhanController@addPelabuhan')->name('add.pelabuhan');
 //    Route::get('/edit/{id}', 'EKSTERNAL\PelabuhanController@editPelabuhan')->name('edit.pelabuhan');
 //    Route::post('/update/{id}', 'EKSTERNAL\PelabuhanController@updatePelabuhan')->name('update.pelabuhan');
 //    Route::delete('/hapus/{id}', 'EKSTERNAL\PelabuhanController@deletePelabuhan')->name('delete.pelabuhan');
 //    Route::get ('/PelabuhanMuat','EKSTERNAL\PelabuhanController@PelabuhanMuatExport')->name('export.pelabuhan');
});


