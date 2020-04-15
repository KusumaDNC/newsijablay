<?php

namespace App\Http\Controllers\Promosi;

use App\Models\Promosi\KemitraanModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\UsersExport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KemitraanController extends Controller
{
    public function showForm(){
        $mitra = KemitraanModel::all();
        //dd($mitra);
        return view('promosi.base.form-kemitraan', compact('mitra'));

    }
    public function rekap(Request $request){
        $value = $request->input('sektor_req');
        $mitra = KemitraanModel::where('sektor', '=', $value)->get();
        //dd($mitra);
        $user_name = Auth::user()->name;
        //dd($user_name);
        return view('promosi.base.rekap-kemitraan', compact('mitra', 'user_name'));
    }
    public function gabung(Request $request){
        $value = $request->input('sektor_req');
        $mitra = KemitraanModel::where('sektor', '=', $value)->get();
        $user_name = Auth::user()->name;
        //dd($user_name);

        return view('promosi.base.gabung', compact('mitra', 'user_name'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'nama_perusahaan' => 'required',
            'status_bu' => 'required',
            'alamat_bu' => 'required',
            'alamat_proyek' => 'required',
            'kab_kota' => 'required',
            'pemilik' => 'required',
            'sektor' => 'required',
        ]);

        if ($request->hasFile('file_mou')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('file_mou')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file_mou')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('file_mou')->storeAs('/', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $nama_perusahaan = $request->input('nama_perusahaan');
        $status_bu = $request->input('status_bu');
        $alamat_bu = $request->input('alamat_bu');
        $no_telp = $request->input('no_telp');
        $alamat_proyek = $request->input('alamat_proyek');
        $kab_kota = $request->input('kab_kota');
        $pemilik = $request->input('pemilik');
        $jns_produksi =$request->input('jns_produksi');
        $kbli = $request->input('kbli');
        $kapasitas = $request->input('kapasitas');
        $nilai_invest = $request->input('nilai_invest');
        $omzet = $request->input('omzet');
        $jml_pegawai = $request->input('jml_pegawai');
        $aspek_krjsm = $request->input('aspek_krjsm');
        $sektor = $request->input('sektor');

        $mitra = new KemitraanModel();
        $mitra->nama_perusahaan = $nama_perusahaan;
        $mitra->status_bu = $status_bu;
        $mitra->alamat_bu = $alamat_bu;
        $mitra->no_telp = $no_telp;
        $mitra->alamat_proyek = $alamat_proyek;
        $mitra->kab_kota = $kab_kota;
        $mitra->pemilik = $pemilik;
        $mitra->jns_produksi = $jns_produksi;
        $mitra->kbli = $kbli;
        $mitra->kapasitas = $kapasitas;
        $mitra->nilai_invest = $nilai_invest;
        $mitra->omzet = $omzet;
        $mitra->jml_pegawai = $jml_pegawai;
        $mitra->aspek_krjsm = $aspek_krjsm;
        $mitra->sektor = $sektor;
        $mitra->mou = $fileNameToStore;
        //dd($mitra);
        $mitra->save();

        return redirect()->back()->with('success', 'Data Kemitraan Berhasil DiInput');
    }
    public function edit($id){
        $mitra = KemitraanModel::findOrFail($id);

        return view('promosi.base.edit-kemitraan', compact('mitra'));
    }

    public function update(Request $request, $id){
        $this->validate($request,[
            'nama_perusahaan' => 'required',
            'status_bu' => 'required',
            'alamat_bu' => 'required',
            'alamat_proyek' => 'required',
            'kab_kota' => 'required',
            'pemilik' => 'required',
        ]);

        if ($request->hasFile('file_mou')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('file_mou')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file_mou')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('file_mou')->storeAs('/', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $nama_perusahaan = $request->input('nama_perusahaan');
        $status_bu = $request->input('status_bu');
        $alamat_bu = $request->input('alamat_bu');
        $no_telp = $request->input('no_telp');
        $alamat_proyek = $request->input('alamat_proyek');
        $kab_kota = $request->input('kab_kota');
        $pemilik = $request->input('pemilik');
        $jns_produksi =$request->input('jns_produksi');
        $kbli = $request->input('kbli');
        $kapasitas = $request->input('kapasitas');
        $nilai_invest = $request->input('nilai_invest');
        $omzet = $request->input('omzet');
        $jml_pegawai = $request->input('jml_pegawai');
        $aspek_krjsm = $request->input('aspek_krjsm');

        $mitra = KemitraanModel::findOrFail($id);
        $mitra->nama_perusahaan = $nama_perusahaan;
        $mitra->status_bu = $status_bu;
        $mitra->alamat_bu = $alamat_bu;
        $mitra->no_telp = $no_telp;
        $mitra->alamat_proyek = $alamat_proyek;
        $mitra->kab_kota = $kab_kota;
        $mitra->pemilik = $pemilik;
        $mitra->jns_produksi = $jns_produksi;
        $mitra->kbli = $kbli;
        $mitra->kapasitas = $kapasitas;
        $mitra->nilai_invest = $nilai_invest;
        $mitra->omzet = $omzet;
        $mitra->jml_pegawai = $jml_pegawai;
        $mitra->aspek_krjsm = $aspek_krjsm;
        $mitra->mou = $fileNameToStore;
        //dd($mitra);
        $mitra->update();

        return redirect()->route('rekap.mitra')->with('success', 'Data Kegiatan berhasil diubah');
    }

    public function export()
    {
        return Excel::download(new UsersExport(), 'kemitraan.xlsx');
    }

    public function pdfview($id)
    {
        $mou = KemitraanModel::find($id);
        $download = $mou->mou;
        //dd($download);
        if ($download == "noimage.jpg"){
            return redirect()->back()->with('warning', 'Data Tidak Ditemukan');
        }
        else {
            return Storage::download($download);
        }
    }
}
