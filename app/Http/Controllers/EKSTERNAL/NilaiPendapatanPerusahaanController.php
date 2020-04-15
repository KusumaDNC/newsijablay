<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\NilaiPendapatanPerusahaanExport;
use App\Models\EKSTERNAL\NilaiPendapatanPerusahaanModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NilaiPendapatanPerusahaanController extends Controller
{
    public function formPengeluaranPerusahaan(){

    }

    public function addNilaiPendapatanPerusahaan(Request $request)
    {

        $add_nilai_pendapatan_perusahaan = new NilaiPendapatanPerusahaanModel();
        $add_nilai_pendapatan_perusahaan->kabupaten_kota = $request->kabupaten_kota;
        $add_nilai_pendapatan_perusahaan->tahun = $request->tahun;
        $add_nilai_pendapatan_perusahaan->barang_dihasilkan = $request->barang_dihasilkan;
        $add_nilai_pendapatan_perusahaan->tenaga_listrik = $request->tenaga_listrik;
        $add_nilai_pendapatan_perusahaan->jasa_industri = $request->jasa_industri;
        $add_nilai_pendapatan_perusahaan->selisih_nilai_stok = $request->selisih_nilai_stok;
        $add_nilai_pendapatan_perusahaan->penerimaan = $request->penerimaan;
        $add_nilai_pendapatan_perusahaan->jumlah = $request->jumlah;
        $add_nilai_pendapatan_perusahaan->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editNilaiPendapatanPerusahaan($id)
    {
        $edit_nilai_pendapatan_perusahaan= NilaiPendapatanPerusahaanModel::findOrFail($id);
        return view('eksternal.base.edit-nilai-pendapatan-perusahaan', compact('edit_nilai_pendapatan_perusahaan'));
    }

    public function updateNilaiPendapatanPerusahaan(Request $request, $id)
    {
        $update_nilai_pendapatan_perusahaan = NilaiPendapatanPerusahaanModel::findOrFail($id);
        $update_nilai_pendapatan_perusahaan->kabupaten_kota = $request->kabupaten_kota;
        $update_nilai_pendapatan_perusahaan->tahun = $request->tahun;
        $update_nilai_pendapatan_perusahaan->barang_dihasilkan = $request->barang_dihasilkan;
        $update_nilai_pendapatan_perusahaan->tenaga_listrik = $request->tenaga_listrik;
        $update_nilai_pendapatan_perusahaan->jasa_industri = $request->jasa_industri;
        $update_nilai_pendapatan_perusahaan->selisih_nilai_stok = $request->selisih_nilai_stok;
        $update_nilai_pendapatan_perusahaan->penerimaan = $request->penerimaan;
        $update_nilai_pendapatan_perusahaan->jumlah = $request->jumlah;
        $update_nilai_pendapatan_perusahaan->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deleteNilaiPendapatanPerusahaan($id)
    {
        $delete_nilai_pendapatan_perusahaan = NilaiPendapatanPerusahaanModel::findOrFail($id);
        $delete_nilai_pendapatan_perusahaan->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }
    public function NilaiPendapatanPerusahaanExport()
    {

        return (new NilaiPendapatanPerusahaanExport())->download('Nilai Pendapatan Perusahaan.xlsx');
    }
}
