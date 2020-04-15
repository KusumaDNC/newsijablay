<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\DataPendidikanExport;
use App\Models\EKSTERNAL\PendidikanModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PendidikanController extends Controller
{
    public function formPendidikan(){

    }

    public function addPendidikan(Request $request)
    {
        //dd($request->tahun);
        $add_pendidikan = new PendidikanModels();
        $add_pendidikan->pendidikan_terakhir = $request->pendidikan_terakhir;
        $add_pendidikan->tahun = $request->tahun;
        $add_pendidikan->laki = $request->laki;
        $add_pendidikan->perempuan = $request->perempuan;
        $add_pendidikan->jumlah = $request->jumlah;
        $add_pendidikan->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editPendidikan($id)
    {
        $edit_pendidikan= PendidikanModels::findOrFail($id);
        return view('eksternal.base.edit-data-pendidikan', compact('edit_pendidikan'));
    }

    public function updatePendidikan(Request $request, $id)
    {
        $update_pendidikan = PendidikanModels::findOrFail($id);
        $update_pendidikan->pendidikan_terakhir = $request->pendidikan_terakhir;
        $update_pendidikan->tahun = $request->tahun;
        $update_pendidikan->laki = $request->laki;
        $update_pendidikan->perempuan = $request->perempuan;
        $update_pendidikan->jumlah = $request->jumlah;
        $update_pendidikan->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deletePendidika($id)
    {
        $dekete_pendidikan = PendidikanModels::findOrFail($id);
        $dekete_pendidikan->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }

    public function PendidikanExport()
    {

        return (new DataPendidikanExport())->download('Tigkat Pendidikan Pencari Kerja.xlsx');
    }
}
