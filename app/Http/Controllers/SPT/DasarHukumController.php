<?php

namespace App\Http\Controllers\SPT;

use App\Models\SPT\DasarHukumModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DasarHukumController extends Controller
{
    public function formDasarHukum(){

    }

    public function addDasarHukum(Request $request){
        $add_dasar_hukum = new DasarHukumModel();
        $add_dasar_hukum->dasar_hukum = $request->dasar_hukum;
        $add_dasar_hukum->save();

        return redirect()->back()->with('success', 'Berhasil Menambah Dasar Hukum');
    }

    public function editDasarHukum($id){
        $edit_dasar_hukum = DasarHukumModel::findOrFail($id);
        return view('spt.base.edit-setting-spt', compact('edit_dasar_hukum'));
    }

    public function updateDasarHukum(Request $request, $id){
        $update_dasar_hukum = DasarHukumModel::findOrFail($id);
        $update_dasar_hukum->dasar_hukum = $request->dasar_hukum;
        $update_dasar_hukum->update();

        return redirect()->route('setting.spt')->with('success', 'Data berhasil diubah');
    }

    public function deleteDasarHukum($id){
        $delete_dasar_hukum = DasarHukumModel::findOrFail($id);
        $delete_dasar_hukum->delete();
        return redirect()->back()->with('success', 'Berhasil Hapus Dasar Hukum');
    }


    public function edit($id){
        $dasar_hukums= DasarHukumModel::findOrFail($id);
        dd($dasar_hukums);
        return view('spt.base.edit-setting-spt', compact('dasar_hukums', ));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'dasar_hukum' => 'required',
        ]);

        $dasar_hukum = $request->input('dasar_hukum');

        $post = DasarHukumModel::findOrFail($id);
        $post->dasar_hukum = $dasar_hukum;

        dd($post);
        $post->update();

        return redirect()->route('spt.base.edit-setting-spt')->with('success', 'Data berhasil diubah');
    }

    public function delete($id){
        $delete = DasarHukumModel::findOrFail($id);
        //dd($delete);
        $delete->delete();

        return redirect()->route('spt.base.edit-pengaduan')->with('success', 'Data berhasil dihapus');
    }
}
