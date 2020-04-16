<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\NilaiTambahPerusahaanExport;
use App\Models\EKSTERNAL\NilaiTambahPerusahaanModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NilaiTambahPerusahaanController extends Controller
{
    public function formPengeluaranPerusahaan(){

    }

    public function addNilaiTambahPerusahaan(Request $request)
    {

        $add_nilai_tambah_perusahaan = new NilaiTambahPerusahaanModel();
        $add_nilai_tambah_perusahaan->kabupaten_kota = $request->kabupaten_kota;
        $add_nilai_tambah_perusahaan->tahun = $request->tahun;
        $add_nilai_tambah_perusahaan->nilai_output = $request->nilai_output;
        $add_nilai_tambah_perusahaan->biaya_input = $request->biaya_input;
        $add_nilai_tambah_perusahaan->harga_pasar = $request->harga_pasar;
        $add_nilai_tambah_perusahaan->pajak_tak_langsung = $request->pajak_tak_langsung;
        $add_nilai_tambah_perusahaan->biaya_faktor_prduksi = $request->biaya_faktor_prduksi;
        $add_nilai_tambah_perusahaan->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editNilaiTambahPerusahaan($id)
    {
        $edit_nilai_tambah_perusahaan= NilaiTambahPerusahaanModel::findOrFail($id);
        return view('eksternal.base.edit-nilai-tambah-perusahaan', compact('edit_nilai_tambah_perusahaan'));
    }

    public function updateNilaiTambahPerusahaan(Request $request, $id)
    {
        $update_nilai_tambah_perusahaan = NilaiTambahPerusahaanModel::findOrFail($id);
        $update_nilai_tambah_perusahaan->kabupaten_kota = $request->kabupaten_kota;
        $update_nilai_tambah_perusahaan->tahun = $request->tahun;
        $update_nilai_tambah_perusahaan->nilai_output = $request->nilai_output;
        $update_nilai_tambah_perusahaan->biaya_input = $request->biaya_input;
        $update_nilai_tambah_perusahaan->harga_pasar = $request->harga_pasar;
        $update_nilai_tambah_perusahaan->pajak_tak_langsung = $request->pajak_tak_langsung;
        $update_nilai_tambah_perusahaan->biaya_faktor_prduksi = $request->biaya_faktor_prduksi;
        $update_nilai_tambah_perusahaan->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deleteNilaiTambahPerusahaan($id)
    {
        $delete_nilai_tambah_perusahaan = NilaiTambahPerusahaanModel::findOrFail($id);
        $delete_nilai_tambah_perusahaan->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }
    public function NilaiTambahPerusahaanExport()
    {

        return (new NilaiTambahPerusahaanExport())->download('Nilai Tambah Perusahaan.xlsx');
    }
}
