<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\NegaraTujuanExport;
use App\Models\EKSTERNAL\NegaraTujuanModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NegaraTujuanController extends Controller
{
    public function formNegara(){

    }

    public function addNegara(Request $request){
        $add_negara = new NegaraTujuanModel();
        $add_negara->tahun = $request->tahun;
        $add_negara->jenis_volume = $request->jenis_volume;
        $add_negara->negara_tujuan = $request->negara_tujuan;
        $add_negara->volume = $request->volume;
        $add_negara->nilai = $request->nilai;
        $add_negara->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/;
    }

    public function editNegara($id){
        $edit_negara = NegaraTujuanModel::findOrFail($id);
        return view('eksternal.base.edit-negara', compact('edit_negara'));
    }

    public function updateNegara(Request $request,$id){
        $update_negara = NegaraTujuanModel::findOrFail($id);
        $update_negara->tahun = $request->tahun;
        $update_negara->jenis_volume = $request->jenis_volume;
        $update_negara->negara_tujuan = $request->negara_tujuan;
        $update_negara->volume = $request->volume;
        $update_negara->nilai = $request->nilai;
        $update_negara->update();
        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deleteNegara($id){
        $delete_negara = NegaraTujuanModel::findOrFail($id);
        $delete_negara->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }

    public function NegaraTujuanExport()
    {

        return (new NegaraTujuanExport())->download('Negara Tujuan.xlsx');
    }
}
