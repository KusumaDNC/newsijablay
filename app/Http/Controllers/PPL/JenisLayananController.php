<?php

namespace App\Http\Controllers\PPL;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PPL\LayananModel;

class JenisLayananController extends Controller
{
    public function formLayanan(){

    }

    public function addLayanan(Request $request){
        $add_layanan = new LayananModel();
        $add_layanan->nama_layanan = $request->nama_layanan;
        $add_layanan->save();

        return redirect()->back()->with('success', 'Berhasil Nambah Jenis Layanan');
    }

    public function editLayanan($id){
        $edit_layanan = LayananModel::findOrFail($id);
        return view('ppl.base.edit-layanan', compact('edit_layanan'));
    }

    public function updatelayanan(Request $request, $id){
        $update_layanan = LayananModel::findOrFail($id);
        $update_layanan->nama_layanan = $request->nama_layanan;
        $update_layanan->update();

        return redirect()->route('gabung.pengaduan')->with('success', 'Data berhasil diubah');
    }

    public function deleteLayanan($id){
        $delete_layanan = LayananModel::findOrFail($id);
        $delete_layanan->delete();
        return redirect()->back()->with('success', 'Berhasil Hapus Layanan');
    }
}
