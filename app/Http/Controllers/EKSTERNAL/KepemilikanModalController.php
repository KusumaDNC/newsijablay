<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\KepemilikanModalExport;
use App\Models\EKSTERNAL\KepemilikanModalModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KepemilikanModalController extends Controller
{
    public function formKepemilikanModal(){

    }

    public function addKepemilikanModal(Request $request)
    {
        //dd($request->tahun);
        $add_kepemilikan_modal = new KepemilikanModalModel();
        $add_kepemilikan_modal->kabupaten_kota = $request->kabupaten_kota;
        $add_kepemilikan_modal->tahun = $request->tahun;
        $add_kepemilikan_modal->pem_pusat = $request->pem_pusat;
        $add_kepemilikan_modal->pem_daerah = $request->pem_daerah;
        $add_kepemilikan_modal->swasta_nas = $request->swasta_nas;
        $add_kepemilikan_modal->asing = $request->asing;
        $add_kepemilikan_modal->jumlah = $request->jumlah;
        $add_kepemilikan_modal->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editKepemilikanModal($id)
    {
        $edit_kepemilikan_modal = KepemilikanModalModel::findOrFail($id);
        return view('eksternal.base.edit-kepemilikan-modal', compact('edit_kepemilikan_modal'));
    }

    public function updateKepemilikanModal(Request $request, $id)
    {
        $update_kepemilikan_modal = KepemilikanModalModel::findOrFail($id);
        $update_kepemilikan_modal->kabupaten_kota = $request->kabupaten_kota;
        $update_kepemilikan_modal->tahun = $request->tahun;
        $update_kepemilikan_modal->pem_pusat = $request->pem_pusat;
        $update_kepemilikan_modal->pem_daerah = $request->pem_daerah;
        $update_kepemilikan_modal->swasta_nas = $request->swasta_nas;
        $update_kepemilikan_modal->asing = $request->asing;
        $update_kepemilikan_modal->jumlah = $request->jumlah;
        $update_kepemilikan_modal->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deleteKepemilikanModal($id)
    {
        $delete_kepemilka_modal = KepemilikanModalModel::findOrFail($id);
        $delete_kepemilka_modal->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }

    public function KepemilikanModalExport()
    {

        return (new KepemilikanModalExport())->download('Kepemilikan Modal.xlsx');
    }
}
