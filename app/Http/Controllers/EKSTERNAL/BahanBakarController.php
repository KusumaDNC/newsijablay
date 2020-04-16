<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\BahanBakarExport;
use App\Models\EKSTERNAL\BahanBakarModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BahanBakarController extends Controller
{
    public function formBahanBakar(){

    }

    public function addBahanBakar(Request $request)
    {
        //dd($request->tahun);
        $add_bahan_bakar = new BahanBakarModel();
        $add_bahan_bakar->kabupaten_kota = $request->kabupaten_kota;
        $add_bahan_bakar->tahun = $request->tahun;
        $add_bahan_bakar->bensin = $request->bensin;
        $add_bahan_bakar->solar = $request->solar;
        $add_bahan_bakar->batubara = $request->batubara;
        $add_bahan_bakar->gas = $request->gas;
        $add_bahan_bakar->lpg = $request->lpg;
        $add_bahan_bakar->pelumas = $request->pelumas;
        $add_bahan_bakar->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editBahanBakar($id)
    {
        $edit_bahan_bakar= BahanBakarModel::findOrFail($id);
        return view('eksternal.base.edit-bahan-bakar', compact('edit_bahan_bakar'));
    }

    public function updateBahanBakar(Request $request, $id)
    {
        $update_bahan_bakar = BahanBakarModel::findOrFail($id);
        $update_bahan_bakar->kabupaten_kota = $request->kabupaten_kota;
        $update_bahan_bakar->tahun = $request->tahun;
        $update_bahan_bakar->bensin = $request->bensin;
        $update_bahan_bakar->solar = $request->solar;
        $update_bahan_bakar->batubara = $request->batubara;
        $update_bahan_bakar->gas = $request->gas;
        $update_bahan_bakar->lpg = $request->lpg;
        $update_bahan_bakar->pelumas = $request->pelumas;
        $update_bahan_bakar->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deleteBahanBakar($id)
    {
        $dekete_bahan_bakar = BahanBakarModel::findOrFail($id);
        $dekete_bahan_bakar->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }

    public function BahanBakarExport()
    {

        return (new BahanBakarExport())->download('Bahan Bakar.xlsx');
    }
}
