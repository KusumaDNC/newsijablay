<?php

namespace App\Http\Controllers\All;

use App\Models\Yanzin\SektorModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SektorController extends Controller
{
    public function formSektor(){

    }

    public function addSektor(Request $request){
        $add_sektor = new SektorModel();
        $add_sektor->nama_sektor = $request->nama_sektor;
        $add_sektor->kode_sektor = $request->kode_sektor;
        $add_sektor->save();

        return redirect()->back()->with('success', 'Berhasil Nambah Sektor');
    }

    public function editSektor($id){
        $edit_sektor = SektorModel::findOrFail($id);
        return view('ppl.base.edit-sektor', compact('edit_sektor'));
    }

    public function updateSektor(Request $request, $id){
        $update_sektor = SektorModel::findOrFail($id);
        $update_sektor->nama_sektor = $request->nama_sektor;
        $update_sektor->kode_sektor = $request->kode_sektor;
        $update_sektor->update();

        return redirect()->route('gabung.pengaduan')->with('success', 'Data berhasil diubah');
    }

    public function deleteSektor($id){
        $delete_sektor = SektorModel::findOrFail($id);
        $delete_sektor->delete();
        return redirect()->back()->with('success', 'Berhasil Hapus Sektor');
    }
}
