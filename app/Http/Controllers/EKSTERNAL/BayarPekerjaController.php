<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\BayarPekerjaExport;
use App\Models\EKSTERNAL\BayarPekerjaModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BayarPekerjaController extends Controller
{
    public function formBayarPekerja(){

    }

    public function addBayarPekerja(Request $request)
    {
        //dd($request->tahun);
        $add_bayar_pekerja = new BayarPekerjaModel();
        $add_bayar_pekerja->kabupaten_kota = $request->kabupaten_kota;
        $add_bayar_pekerja->tahun = $request->tahun;
        $add_bayar_pekerja->banyak_perusahaan = $request->banyak_perusahaan;
        $add_bayar_pekerja->produksi_pria = $request->produksi_pria;
        $add_bayar_pekerja->produksi_wanita = $request->produksi_wanita;
        $add_bayar_pekerja->jml_produksi = $request->jml_produksi;
        $add_bayar_pekerja->lainnya_pria = $request->lainnya_pria;
        $add_bayar_pekerja->lainnya_wanita = $request->lainnya_wanita;
        $add_bayar_pekerja->jml_lainnya = $request->jml_lainnya;
        $add_bayar_pekerja->total = $request->total;
        $add_bayar_pekerja->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editBayarPekerja($id)
    {
        $edit_bayar_pekerja = BayarPekerjaModel::findOrFail($id);
        return view('eksternal.base.edit-bayar-pekerja', compact('edit_bayar_pekerja'));
    }

    public function updateBayarPekerja(Request $request, $id)
    {
        $update_bayar_pekerja = BayarPekerjaModel::findOrFail($id);
        $update_bayar_pekerja->kabupaten_kota = $request->kabupaten_kota;
        $update_bayar_pekerja->tahun = $request->tahun;
        $update_bayar_pekerja->banyak_perusahaan = $request->banyak_perusahaan;
        $update_bayar_pekerja->produksi_pria = $request->produksi_pria;
        $update_bayar_pekerja->produksi_wanita = $request->produksi_wanita;
        $update_bayar_pekerja->jml_produksi = $request->jml_produksi;
        $update_bayar_pekerja->lainnya_pria = $request->lainnya_pria;
        $update_bayar_pekerja->lainnya_wanita = $request->lainnya_wanita;
        $update_bayar_pekerja->jml_lainnya = $request->jml_lainnya;
        $update_bayar_pekerja->total = $request->total;
        $update_bayar_pekerja->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deleteBayarPekerja($id)
    {
        $delete_bayar_pekerja = BayarPekerjaModel::findOrFail($id);
        $delete_bayar_pekerja->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }

    public function BayarPekerjaExport()
    {

        return (new BayarPekerjaExport())->download('Banyaknya Pekerjaan dibayar.xlsx');
    }
}
