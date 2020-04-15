<?php

namespace App\Http\Controllers\Perencanaan;

use App\Models\Perencanaan\RekapPerencanaanModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RekapPerencanaanController extends Controller
{
    public function showPerencanaan(){

    }

    public function upload(){
        $pdf = RekapPerencanaanModels::get();
        return view('upload',['pdf' => $pdf]);
    }

    public function prosesUpload(Request $request){
        $this->validate($request, [
            'file' => 'required',
            'keterangan' => 'required'
        ]);
        $file = $request->file('file');
        $nama_file = time()."_".$file->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = Storage::disk('local')->put('public/upload/'.$nama_file, 'Contents');
        $nama_file = RekapPerencanaanModels::create([
            'file' => $nama_file,
            'keterangan' => $request->keterangan
        ]);
        //dd($nama_file);
        return redirect()->back();
    }

    public function download($id)
    {
        $nama_file = RekapPerencanaanModels::find($id);
        dd($nama_file);
        $download = $nama_file->file;

        return Storage::download($download);

    }

    public function delete($id)
    {
        $dekete_perencanaan = RekapPerencanaanModels::findOrFail($id);
        $dekete_perencanaan->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }

}
