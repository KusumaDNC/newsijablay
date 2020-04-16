<?php

namespace App\Http\Controllers\EKSTERNAL;


use App\Exports\ExporImporExport;
use App\Models\EKSTERNAL\EksporImporModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
class EksporImporController extends Controller
{
    public function formEksporImpor(){

    }

    public function addEksporImpor(Request $request){
        //dd($request->tahun);

        $add_ekspor_impor = new EksporImporModel();
        $add_ekspor_impor->tahun = $request->tahun;
        $add_ekspor_impor->jenis_volume = $request->jenis_volume;
        $add_ekspor_impor->jenis_komoditi = $request->jenis_komoditi;
        $add_ekspor_impor->volume = $request->volume;
        $add_ekspor_impor->nilai =$request->nilai;
        $add_ekspor_impor->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/;
        //dd($add_ekspor_impor);
    }


    public function editEksporImpor($id){
        $edit_ekspor_impor = EksporImporModel::findOrFail($id);
        return view('eksternal.base.edit-ekspor', compact('edit_ekspor_impor'));

    }

    public function updateEksporImpor(Request $request, $id){
        $update_ekspor_impor = EksporImporModel::findOrFail($id);
        $update_ekspor_impor->tahun = $request->tahun;
        $update_ekspor_impor->jenis_volume = $request->jenis_volume;
        $update_ekspor_impor->jenis_komoditi = $request->jenis_komoditi;
        $update_ekspor_impor->volume = $request->volume;
        $update_ekspor_impor->nilai =$request->nilai;
        $update_ekspor_impor->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deleteEksporImpor($id){
        $delete_ekspor_impor = EksporImporModel::findOrFail($id);
        $delete_ekspor_impor->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }

    public function EksporImporExport()
    {
        //dd($request);
//        $tahun = EksporImporModel::groupBy('tahun')->pluck('tahun');;
//        dd($tahun);
      /* /* return Excel::download(new ExporImporExport(), 'Jenis Komoditi.xlsx');*/
        return (new ExporImporExport)->download('Jenis Komoditi.xlsx');
    }

}
