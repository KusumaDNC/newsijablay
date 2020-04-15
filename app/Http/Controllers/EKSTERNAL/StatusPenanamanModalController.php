<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\StatusPenanamanModalExport;
use App\Models\EKSTERNAL\StatusPenanamanModalModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusPenanamanModalController extends Controller
{
    public function formStatusPenanaman(){

    }

    public function addStatusPenanaman(Request $request)
    {
        //dd($request->tahun);
        $add_status_penanaman = new StatusPenanamanModalModel();
        $add_status_penanaman->kabupaten_kota = $request->kabupaten_kota;
        $add_status_penanaman->tahun = $request->tahun;
        $add_status_penanaman->pmdn = $request->pmdn;
        $add_status_penanaman->ppma = $request->ppma;
        $add_status_penanaman->non_fasilitas = $request->non_fasilitas;
        $add_status_penanaman->jumlah = $request->jumlah;
        $add_status_penanaman->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editStatusPenanaman($id)
    {
        $edit_status_penanaman = StatusPenanamanModalModel::findOrFail($id);
        return view('eksternal.base.edit-penanaman-modal', compact('edit_status_penanaman'));
    }

    public function updateStatusPenanaman(Request $request, $id)
    {
        $update_status_penanaman = StatusPenanamanModalModel::findOrFail($id);
        $update_status_penanaman->kabupaten_kota = $request->kabupaten_kota;
        $update_status_penanaman->tahun = $request->tahun;
        $update_status_penanaman->pmdn = $request->pmdn;
        $update_status_penanaman->ppma = $request->ppma;
        $update_status_penanaman->non_fasilitas = $request->non_fasilitas;
        $update_status_penanaman->jumlah = $request->jumlah;
        $update_status_penanaman->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deleteStatusPenanaman($id)
    {
        $delete_status_penanaman = StatusPenanamanModalModel::findOrFail($id);
        $delete_status_penanaman->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }

    public function StatusPenanamanModalExport()
    {

        return (new StatusPenanamanModalExport())->download('Status Penanaman Modal.xlsx');
    }
}
