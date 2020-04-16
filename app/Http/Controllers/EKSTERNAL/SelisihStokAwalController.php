<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\SelisihStokExport;
use App\Models\EKSTERNAL\SelisihStokAwalModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SelisihStokAwalController extends Controller
{
    public function formSelisihStokAwal(){

    }

    public function addSelisihStokAwal(Request $request)
    {

        $add_selisih_stok_awal = new SelisihStokAwalModel();
        $add_selisih_stok_awal->kabupaten_kota = $request->kabupaten_kota;
        $add_selisih_stok_awal->tahun = $request->tahun;
        $add_selisih_stok_awal->bahan_baku = $request->bahan_baku;
        $add_selisih_stok_awal->setengah_jadi = $request->setengah_jadi;
        $add_selisih_stok_awal->barang_jadi = $request->barang_jadi;
        $add_selisih_stok_awal->jumlah_selisih = $request->jumlah_selisih;
        $add_selisih_stok_awal->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editSelisihStokAwal($id)
    {
        $edit_selisih_stok_awal= SelisihStokAwalModel::findOrFail($id);
        return view('eksternal.base.edit-selisih-stok-awal', compact('edit_selisih_stok_awal'));
    }

    public function updateSelisihStokAwal(Request $request, $id)
    {
        $update_selisih_stok_awal = SelisihStokAwalModel::findOrFail($id);
        $update_selisih_stok_awal->kabupaten_kota = $request->kabupaten_kota;
        $update_selisih_stok_awal->tahun = $request->tahun;
        $update_selisih_stok_awal->bahan_baku = $request->bahan_baku;
        $update_selisih_stok_awal->setengah_jadi = $request->setengah_jadi;
        $update_selisih_stok_awal->barang_jadi = $request->barang_jadi;
        $update_selisih_stok_awal->jumlah_selisih = $request->jumlah_selisih;
        $update_selisih_stok_awal->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deleteSelisihStokAwal($id)
    {
        $delete_selisih_stok_awal = SelisihStokAwalModel::findOrFail($id);
        $delete_selisih_stok_awal->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }

    public function SelisihStokAwalExport()
    {

        return (new SelisihStokExport())->download('Selisih Stok Awal.xlsx');
    }
}
