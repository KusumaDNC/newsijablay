<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\PengeluaranPerusahaanExport;
use App\Models\EKSTERNAL\PengeluaranPerusahaanModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PengeluaranPerusahaanController extends Controller
{
    public function formPengeluaranPerusahaan(){

    }

    public function addPengeluaranPerusahaan(Request $request)
    {
        //dd($request->tahun);
        $add_pengeluaran_perusahaan = new PengeluaranPerusahaanModel();
        $add_pengeluaran_perusahaan->kabupaten_kota = $request->kabupaten_kota;
        $add_pengeluaran_perusahaan->tahun = $request->tahun;
        $add_pengeluaran_perusahaan->bahan_baku = $request->bahan_baku;
        $add_pengeluaran_perusahaan->bahan_bakar = $request->bahan_bakar;
        $add_pengeluaran_perusahaan->pengeluaran_jasa = $request->pengeluaran_jasa;
        $add_pengeluaran_perusahaan->sewa = $request->sewa;
        $add_pengeluaran_perusahaan->pengeluaran_lain = $request->pengeluaran_lain;
        $add_pengeluaran_perusahaan->jumlah = $request->jumlah;
        $add_pengeluaran_perusahaan->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editPengeluaranPerusahaan($id)
    {
        $edit_pengeluaran_perusahaan= PengeluaranPerusahaanModel::findOrFail($id);
        return view('eksternal.base.edit-pengeluaran-perusahaan', compact('edit_pengeluaran_perusahaan'));
    }

    public function updatePengeluaranPerusahaan(Request $request, $id)
    {
        $update_pengeluaran_perusahaan = PengeluaranPerusahaanModel::findOrFail($id);
        $update_pengeluaran_perusahaan->kabupaten_kota = $request->kabupaten_kota;
        $update_pengeluaran_perusahaan->tahun = $request->tahun;
        $update_pengeluaran_perusahaan->bahan_baku = $request->bahan_baku;
        $update_pengeluaran_perusahaan->bahan_bakar = $request->bahan_bakar;
        $update_pengeluaran_perusahaan->pengeluaran_jasa = $request->pengeluaran_jasa;
        $update_pengeluaran_perusahaan->sewa = $request->sewa;
        $update_pengeluaran_perusahaan->pengeluaran_lain = $request->pengeluaran_lain;
        $update_pengeluaran_perusahaan->jumlah = $request->jumlah;
        $update_pengeluaran_perusahaan->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deletePengeluaranPerusahaan($id)
    {
        $delete_pengeluaran_perusahaan = PengeluaranPerusahaanModel::findOrFail($id);
        $delete_pengeluaran_perusahaan->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }
    public function PengeluaranPerusahaanExport()
    {

        return (new PengeluaranPerusahaanExport())->download('Pengeluaran Perusahaan.xlsx');
    }
}
