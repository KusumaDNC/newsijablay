<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\DataLokerExport;
use App\Models\EKSTERNAL\LokerModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LokerController extends Controller
{
    public function formLoker(){

    }

    public function addLoker(Request $request)
    {
        //dd($request->tahun);
        $add_loker = new LokerModel();
        $add_loker->kabupaten_kota = $request->kabupaten_kota;
        $add_loker->tahun = $request->tahun;
        $add_loker->pencari_laki = $request->pencari_laki;
        $add_loker->pencari_perempuan = $request->pencari_perempuan;
        $add_loker->pencari_jumlah = $request->pencari_jumlah;
        $add_loker->lowongan_laki = $request->lowongan_laki;
        $add_loker->lowongan_perempuan = $request->lowongan_perempuan;
        $add_loker->lowongan_jumlah = $request->lowongan_jumlah;
        $add_loker->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editLoker($id)
    {
        $edit_loker= LokerModel::findOrFail($id);
        return view('eksternal.base.edit-data-loker', compact('edit_loker'));
    }

    public function updateLoker(Request $request, $id)
    {
        $update_loker = LokerModel::findOrFail($id);
        $update_loker->kabupaten_kota = $request->kabupaten_kota;
        $update_loker->tahun = $request->tahun;
        $update_loker->pencari_laki = $request->pencari_laki;
        $update_loker->pencari_perempuan = $request->pencari_perempuan;
        $update_loker->pencari_jumlah = $request->lowongan_laki;
        $update_loker->lowongan_laki = $request->lowongan_laki;
        $update_loker->lowongan_perempuan = $request->lowongan_perempuan;
        $update_loker->lowongan_jumlah = $request->lowongan_jumlah;
        $update_loker->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deleteLoker($id)
    {
        $dekete_loker = LokerModel::findOrFail($id);
        $dekete_loker->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }

    public function LokerExport()
    {

        return (new DataLokerExport())->download('Pencari Kerja dan Lowongan Kerja.xlsx');
    }
}
