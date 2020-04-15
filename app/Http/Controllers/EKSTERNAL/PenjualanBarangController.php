<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\PenjualanBarangExport;
use App\Models\EKSTERNAL\PenjualanBarangModalModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenjualanBarangController extends Controller
{
    public function formPenjualanBarang(){

    }

    public function addPenjualanBarang(Request $request)
    {

        $add_penjualan_barang = new PenjualanBarangModalModels();
        $add_penjualan_barang->kabupaten_kota = $request->kabupaten_kota;
        $add_penjualan_barang->tahun = $request->tahun;
        $add_penjualan_barang->jual_tanah = $request->jual_tanah;
        $add_penjualan_barang->jual_gedung = $request->jual_gedung;
        $add_penjualan_barang->jual_mesin = $request->jual_mesin;
        $add_penjualan_barang->jual_kendaraan = $request->jual_kendaraan;
        $add_penjualan_barang->jual_tetap_lainnya = $request->jual_tetap_lainnya;
        $add_penjualan_barang->jual_jumlah = $request->jual_jumlah;
        $add_penjualan_barang->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editPenjualanBarang($id)
    {
        $edit_penjualan_barang= PenjualanBarangModalModels::findOrFail($id);
        return view('eksternal.base.edit-penjualan-barang-modal', compact('edit_penjualan_barang'));
    }

    public function updatePenjualanBarang(Request $request, $id)
    {
        $update_penjualan_barang = PenjualanBarangModalModels::findOrFail($id);
        $update_penjualan_barang->kabupaten_kota = $request->kabupaten_kota;
        $update_penjualan_barang->tahun = $request->tahun;
        $update_penjualan_barang->jual_tanah = $request->jual_tanah;
        $update_penjualan_barang->jual_gedung = $request->jual_gedung;
        $update_penjualan_barang->jual_mesin = $request->jual_mesin;
        $update_penjualan_barang->jual_kendaraan = $request->jual_kendaraan;
        $update_penjualan_barang->jual_tetap_lainnya = $request->jual_tetap_lainnya;
        $update_penjualan_barang->jual_jumlah = $request->jual_jumlah;
        $update_penjualan_barang->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deletePenjualanBarang($id)
    {
        $delete_penjualan_barang = PenjualanBarangModalModels::findOrFail($id);
        $delete_penjualan_barang->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }

    public function PenjualanBarangExport()
    {

        return (new PenjualanBarangExport())->download('Penjualan Barang Modal.xlsx');
    }
}
