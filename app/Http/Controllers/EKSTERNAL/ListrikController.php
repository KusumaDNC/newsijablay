<?php

namespace App\Http\Controllers\Eksternal;

use App\Exports\ListrikExport;
use App\Models\EKSTERNAL\ListrikModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListrikController extends Controller
{
    public function formListrik(){

    }

    public function addListrik(Request $request)
    {
        //dd($request->tahun);
        $add_listrik = new ListrikModel();
        $add_listrik->kabupaten_kota = $request->kabupaten_kota;
        $add_listrik->tahun = $request->tahun;
        $add_listrik->produksi_sendiri = $request->produksi_sendiri;
        $add_listrik->dibeli_banyaknya = $request->dibeli_banyaknya;
        $add_listrik->dibeli_nilai = $request->dibeli_nilai;
        $add_listrik->dijual_banyaknya = $request->dijual_banyaknya;
        $add_listrik->dijual_nilai = $request->dijual_nilai;
        $add_listrik->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editListrik($id)
    {
        $edit_listrik= ListrikModel::findOrFail($id);
        return view('eksternal.base.edit-listrik', compact('edit_listrik'));
    }

    public function updateListrik(Request $request, $id)
    {
        $update_listrik = ListrikModel::findOrFail($id);
        $update_listrik->kabupaten_kota = $request->kabupaten_kota;
        $update_listrik->tahun = $request->tahun;
        $update_listrik->produksi_sendiri = $request->produksi_sendiri;
        $update_listrik->dibeli_banyaknya = $request->dibeli_banyaknya;
        $update_listrik->dibeli_nilai = $request->dibeli_nilai;
        $update_listrik->dijual_banyaknya = $request->dijual_banyaknya;
        $update_listrik->dijual_nilai = $request->dijual_nilai;
        $update_listrik->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deleteListrik($id)
    {
        $delete_listrik = ListrikModel::findOrFail($id);
        $delete_listrik->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }
    public function ListrikExport()
    {

        return (new ListrikExport())->download('Tenaga Listrik yang diproduksi.xlsx');
    }
}
