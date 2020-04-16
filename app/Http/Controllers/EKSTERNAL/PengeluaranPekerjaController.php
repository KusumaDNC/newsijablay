<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\PengeluaranPekerjaExport;
use App\Models\EKSTERNAL\PengeluaranPekerjaModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengeluaranPekerjaController extends Controller
{
    public function formPengeluaranPekerja(){

    }

    public function addPengeluaranPekerja(Request $request)
    {
        //dd($request->tahun);
        $add_pengeluaran_pekerja = new PengeluaranPekerjaModel();
        $add_pengeluaran_pekerja->kabupaten_kota = $request->kabupaten_kota;
        $add_pengeluaran_pekerja->tahun = $request->tahun;
        $add_pengeluaran_pekerja->banyak_perusahaan = $request->banyak_perusahaan;
        $add_pengeluaran_pekerja->produksi_upah = $request->produksi_upah;
        $add_pengeluaran_pekerja->produksi_insentif = $request->produksi_insentif;
        $add_pengeluaran_pekerja->lainnya_upah = $request->lainnya_upah;
        $add_pengeluaran_pekerja->lainnya_insentif = $request->lainnya_insentif;
        $add_pengeluaran_pekerja->jumlah = $request->jumlah;
        $add_pengeluaran_pekerja->pengeluaran_pekerja = $request->pengeluaran_pekerja;
        $add_pengeluaran_pekerja->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editPengeluaranPekerja($id)
    {
        $edit_pengeluaran_pekerja= PengeluaranPekerjaModel::findOrFail($id);
        return view('eksternal.base.edit-pengeluaran-pekerja', compact('edit_pengeluaran_pekerja'));
    }

    public function updatePengeluaranPekerja(Request $request, $id)
    {
        $update_pengeluaran_pekerja = PengeluaranPekerjaModel::findOrFail($id);
        $update_pengeluaran_pekerja->kabupaten_kota = $request->kabupaten_kota;
        $update_pengeluaran_pekerja->tahun = $request->tahun;
        $update_pengeluaran_pekerja->banyak_perusahaan = $request->banyak_perusahaan;
        $update_pengeluaran_pekerja->produksi_upah = $request->produksi_upah;
        $update_pengeluaran_pekerja->produksi_insentif = $request->produksi_insentif;
        $update_pengeluaran_pekerja->lainnya_upah = $request->lainnya_upah;
        $update_pengeluaran_pekerja->lainnya_insentif = $request->lainnya_insentif;
        $update_pengeluaran_pekerja->jumlah = $request->jumlah;
        $update_pengeluaran_pekerja->pengeluaran_pekerja = $request->pengeluaran_pekerja;
        $update_pengeluaran_pekerja->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deletePengeluaranPekerja($id)
    {
        $delete_pengeluaran_pekerja = PengeluaranPekerjaModel::findOrFail($id);
        $delete_pengeluaran_pekerja->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }

    public function PengeluaranPekerjaExport()
    {

        return (new PengeluaranPekerjaExport())->download('Pengeluaran Pekerja.xlsx');
    }
}
