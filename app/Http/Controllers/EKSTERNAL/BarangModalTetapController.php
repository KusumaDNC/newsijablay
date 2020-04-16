<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\BarangModalExport;
use App\Models\EKSTERNAL\BarangModalTetapModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BarangModalTetapController extends Controller
{
    public function formBarangModalTetap(){

    }

    public function addBarangModalTetap(Request $request)
    {

        $add_barang_modal_tetap = new BarangModalTetapModels();
        $add_barang_modal_tetap->kabupaten_kota = $request->kabupaten_kota;
        $add_barang_modal_tetap->tahun = $request->tahun;
        $add_barang_modal_tetap->tanah = $request->tanah;
        $add_barang_modal_tetap->gedung = $request->gedung;
        $add_barang_modal_tetap->mesin = $request->mesin;
        $add_barang_modal_tetap->kendaraan = $request->kendaraan;
        $add_barang_modal_tetap->tetap_lainnya = $request->tetap_lainnya;
        $add_barang_modal_tetap->jumlah = $request->jumlah;
        $add_barang_modal_tetap->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editBarangModalTetap($id)
    {
        $edit_barang_modal_tetap= BarangModalTetapModels::findOrFail($id);
        return view('eksternal.base.edit-barang-modal', compact('edit_barang_modal_tetap'));
    }

    public function updateBarangModalTetap(Request $request, $id)
    {
        $update_barang_modal_tetap = BarangModalTetapModels::findOrFail($id);
        $update_barang_modal_tetap->kabupaten_kota = $request->kabupaten_kota;
        $update_barang_modal_tetap->tahun = $request->tahun;
        $update_barang_modal_tetap->tanah = $request->tanah;
        $update_barang_modal_tetap->gedung = $request->gedung;
        $update_barang_modal_tetap->mesin = $request->mesin;
        $update_barang_modal_tetap->kendaraan = $request->kendaraan;
        $update_barang_modal_tetap->tetap_lainnya = $request->tetap_lainnya;
        $update_barang_modal_tetap->jumlah = $request->jumlah;
        $update_barang_modal_tetap->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deleteBarangModalTetap($id)
    {
        $delete_barang_modal_tetap = BarangModalTetapModels::findOrFail($id);
        $delete_barang_modal_tetap->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }

    public function BarangModalTetapExport()
    {

        return (new BarangModalExport())->download('Penambahan Barang Modal.xlsx');
    }
}
