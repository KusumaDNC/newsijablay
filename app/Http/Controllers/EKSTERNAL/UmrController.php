<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\DataUmrExport;
use App\Models\EKSTERNAL\UmrModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UmrController extends Controller
{
    public function formUmr(){

    }

    public function addUmr(Request $request)
    {
        //dd($request->tahun);
        $add_umr = new UmrModels();
        $add_umr->kabupaten_kota = $request->kabupaten_kota;
        $add_umr->tahun = $request->tahun;
        $add_umr->umr = $request->umr;
        $add_umr->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editUmr($id)
    {
        $edit_umr= UmrModels::findOrFail($id);
        return view('eksternal.base.edit-data-umr', compact('edit_umr'));
    }

    public function updateUmr(Request $request, $id)
    {
        $update_umr = UmrModels::findOrFail($id);
        $update_umr->kabupaten_kota = $request->kabupaten_kota;
        $update_umr->tahun = $request->tahun;
        $update_umr->umr = $request->umr;
        $update_umr->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deleteUmr($id)
    {
        $dekete_umr = UmrModels::findOrFail($id);
        $dekete_umr->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }

    public function UmrExport()
    {

        return (new DataUmrExport())->download('Upah minimum Kabupaten Kota.xlsx');
    }
}
