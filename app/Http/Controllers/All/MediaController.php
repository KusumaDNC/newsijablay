<?php

namespace App\Http\Controllers\All;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PPL\MediaModel;

class MediaController extends Controller
{
    public function formMedia(){

    }

    public function addMedia(Request $request){
        $add_media = new MediaModel();
        $add_media->nama_media = $request->nama_media;
        $add_media->save();

        return redirect()->back()->with('success', 'Berhasil Nambah Media');
    }

    public function editMedia($id){
        $edit_media = MediaModel::findOrFail($id);
        return view('ppl.base.edit-media', compact('edit_media'));
    }

    public function updateMedia(Request $request, $id){
        $update_media = MediaModel::findOrFail($id);
        $update_media->nama_media = $request->nama_media;
        $update_media->update();

        return redirect()->route('gabung.pengaduan')->with('success', 'Data berhasil diubah');
    }

    public function deleteMedia($id){
        $delete_media = MediaModel::findOrFail($id);
        $delete_media->delete();
        return redirect()->back()->with('success', 'Berhasil Hapus Media');
    }
}
