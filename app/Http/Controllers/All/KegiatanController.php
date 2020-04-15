<?php

namespace App\Http\Controllers\All;

use App\Exports\KegiatanExport;
use App\Models\All\KegiatanCrash;
use App\Models\All\KegiatanModels;
use App\Models\All\TempatKegModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KegiatanController extends Controller
{
    public function showKegiatan(Request $request){
        $today = date('Y-m-d');
        $todays = date('F');
        $bulan = date('m', strtotime($request->input('bulan')));

        //$user = Auth::user()->id;
        $keg = KegiatanModels::whereMonth('tanggal', '=', $bulan)->get();

//dd($keg);
        $tempat = TempatKegModels::all();
        foreach ($keg as $k){
            $cek_tmp = KegiatanModels::where('tempat', '=', $k->tempat)->exists();
            $cek_pst = KegiatanModels::where('peserta', '=', $k->peserta)->exists();
            $cek_tgl = KegiatanModels::where('tanggal', '=', $k->tanggal)->exists();
        }

        for ($i=0;$i<count($keg);$i++){
            //dd($keg[$i]->id = $k->crash);
        }
        return view('all.base.all-keg', compact('today', 'keg', 'tempat', 'todays'));
    }

    public function allKegiatan(){

        $today = date('Y-m-d');
        //dd($today);
        $user = Auth::user()->id;

        return view('all.base.show-kegiatan', compact('today'));
    }

    public function postKegiatan(Request $request){

        $this->validate($request, [
            'nama_keg' => 'required',
            'seksi' => 'required',
            'peserta' => 'required',
            'tempat' => 'required',
            'tgl_keg' => 'required',
            'pukul_mulai' => 'required',
            'pukul_selesai' => 'required',
        ]);

        $user = Auth::user()->username;
        //dd($user);

        $nama_keg = $request->input('nama_keg');
        $seksi = $request->input('seksi');
        $peserta = $request->input('peserta');
        $tempat = $request->input('tempat');
        $tgl_keg = $request->input('tgl_keg');
        $pukul_mulai = $request->input('pukul_mulai');
        $pukul_selesai = $request->input('pukul_selesai');

        $cek_tmp = KegiatanModels::where('tempat', '=', $tempat)->exists();
        $cek_pst = KegiatanModels::where('peserta', '=', $peserta)->exists();
        $cek_tgl = KegiatanModels::where('tanggal', '=', $tgl_keg)->exists();
        $p = DB::table('kegiatan_models')
            ->where('tempat', $tempat)
            ->where('peserta', $peserta)
            ->where('tanggal', $tgl_keg)
            ->first();

        if (($cek_tgl && $cek_tmp && $cek_pst) == true){

            $post = new KegiatanModels();
            $post->bidang_id = $user;
            $post->seksi = $seksi;
            $post->nama_kegiatan = $nama_keg;
            $post->peserta = $peserta;
            $post->tempat = $tempat;
            $post->tanggal = $tgl_keg;
            $post->pukul_mulai = $pukul_mulai;
            $post->pukul_selesai = $pukul_selesai;
            $post->crash = $p->id;
            $post->save();

            $add = KegiatanModels::find($post->crash);
            $add->crash = $post->crash;
            $add->update();
            // dd($add);

            return redirect()->back()->with('bad', 'Kegiatan Anda memiliki kesamaan Tanggal, Tempat dan Peserta, Silahkan Koordinasikan');
        }
        else{
            $post = new KegiatanModels();
            $post->bidang_id = $user;
            $post->seksi = $seksi;
            $post->nama_kegiatan = $nama_keg;
            $post->peserta = $peserta;
            $post->tempat = $tempat;
            $post->tanggal = $tgl_keg;
            $post->pukul_mulai = $pukul_mulai;
            $post->pukul_selesai = $pukul_selesai;

            $post->save();

            return redirect()->back()->with('success', 'Kegiatan berhasil dimasukkan');
        }
    }

    public function editKegiatan($id){
        $edit = KegiatanModels::findOrFail($id);
        $today = date('Y-m-d');
        $bidang_id = $edit->bidang_id;
        $user = Auth::user()->username;
        if ($user == $bidang_id) {
            return view('all.base.edit-kegiatan', compact('edit', 'today'));
        }
        else{
            return redirect()->back()->with('warning', 'Bukan Kegiatan di Bidang Anda');
        }
    }

    public function updateKegiatan(Request $request,$id){

        $update = KegiatanModels::findOrFail($id);
        $user = Auth::user()->username;
        //dd($update);
        $nama_keg = $request->input('nama_keg');
        $seksi = $request->input('seksi');
        $peserta = $request->input('peserta');
        $tempat = $request->input('tempat');
        $tgl_keg = $request->input('tgl_keg');
        $pukul_mulai = $request->input('pukul_mulai');
        $pukul_selesai = $request->input('pukul_selesai');

        $cek_tmp = KegiatanModels::where('tempat', '=', $tempat)->exists();
        $cek_pst = KegiatanModels::where('peserta', '=', $peserta)->exists();
        $cek_tgl = KegiatanModels::where('tanggal', '=', $tgl_keg)->exists();
        $p = DB::table('kegiatan_models')
            ->where('tempat', $tempat)
            ->where('peserta', $peserta)
            ->where('tanggal', $tgl_keg)
            ->first();
        //dd($p);

        if (($cek_tgl && $cek_tmp && $cek_pst) == true){

            $post = KegiatanModels::findOrFail($id);
            $post->bidang_id = $user;
            $post->seksi = $seksi;
            $post->nama_kegiatan = $nama_keg;
            $post->peserta = $peserta;
            $post->tempat = $tempat;
            $post->tanggal = $tgl_keg;
            $post->pukul_mulai = $pukul_mulai;
            $post->pukul_selesai = $pukul_selesai;
            $post->crash = $p->id;
            $post->update();

            //$add = KegiatanModels::find($post->crash);
            //$add->crash = $post->crash;
            //$add->update();
            //dd($add);

            return redirect()->route('get.kegiatan')->with('bad', 'Kegiatan Anda memiliki kesamaan Tanggal, Tempat dan Peserta, Silahkan Koordinasikan');
        }
        else{
            $post = KegiatanModels::findOrFail($id);
            $post->bidang_id = $user;
            $post->seksi = $seksi;
            $post->nama_kegiatan = $nama_keg;
            $post->peserta = $peserta;
            $post->tempat = $tempat;
            $post->tanggal = $tgl_keg;
            $post->pukul_mulai = $pukul_mulai;
            $post->pukul_selesai = $pukul_selesai;
            $post->crash = null;
            //dd($post);

            $post->update();

            return redirect()->route('get.kegiatan')->with('success', 'Data Kegiatan berhasil diubah');
        }
    }

    public function pilihKegiatan($id){

        $pilih = KegiatanModels::findOrFail($id);
        $sama = KegiatanModels::where('crash', $pilih->crash)->get();

        $pilih->crash = null;
        //$pilih->update();

        return view('admin.report.base.pilih-kegiatan', compact('sama','pilih'))->with('success', 'Kegiatan Sudah Terpilih');
    }

    public function tentukanKegiatan(Request $request, $id){

        $kegiatan = KegiatanModels::findOrFail($id);
        //dd($kegiatan);
        $sama = KegiatanModels::where('crash', $kegiatan->crash)
                ->where('id', '!=', $kegiatan->id)
                ->first();
        //dd($sama);
        $pesan = $request->input('pesan');

        $crash = new KegiatanCrash();
        $crash->bidang_id = $sama->bidang_id;
        $crash->pesan = $sama->bidang_id;
        $crash->kegiatan_id = $sama->id;
        //dd($crash);
        $crash->save();

        if ($crash->save()){
            $kegiatan->crash = null;
            $kegiatan->update();

            $sama->crash = 'ganti';
            $sama->update();
        }
        else{
            echo 'ERROR';
        }
        return redirect()->route('home')->with('success', 'Berhasil Update Kegiatan yang berbenturan');
        /*$kegiatan->crash = null;
        $kegiatan->update();*/

        //dd($sama);
    }

    public function hapusKegiatan($id){
        $delete = KegiatanModels::find($id);
        $user = Auth::user()->username;
        $bidang_id = $delete->bidang_id;
        if ($user == $bidang_id){
            $delete->delete();
            return redirect()->back()->with('success', 'Kegiatan berhasil dihapus');
    }
        else{
            return redirect()->back()->with('warning', 'Bukan Kegiatan di Bidang Anda');
        }
    }

    public function exportKegiatan(){
        return Excel::download(new KegiatanExport(), 'Rekap Kegiatan.xlsx');
    }

    public function showTempatKegiatan(){
        return view('all.base.show-tempat-keg');
    }

    public function addTempatKegiatan(Request $request){
        $this->validate($request, [
            'tempat_keg' => 'required',
            'status_tempat' => 'required',
        ]);

        $user = Auth::user()->username;
        //dd($user);

        $tempat_keg = $request->input('tempat_keg');
        $status_tempat = $request->input('status_tempat');

        $post = new TempatKegModels();
        $post->tempat_keg = $tempat_keg;
        $post->status_tempat = $status_tempat;
        //dd($post);
        $post->save();

        return redirect()->back()->with('success', 'Tempat Kegiatan berhasil ditambahkan');
    }

    public function gabungKegiatan(Request $request){
        $today = date('Y-m-d');
        $todays = date('F');
        $bulan = date('m', strtotime($request->input('bulan')));

        $keg = KegiatanModels::whereMonth('tanggal', '=', $bulan)->get();
        //dd($keg);
        $tempat = TempatKegModels::all();
        foreach ($keg as $k){
            $cek_tmp = KegiatanModels::where('tempat', '=', $k->tempat)->exists();
            $cek_pst = KegiatanModels::where('peserta', '=', $k->peserta)->exists();
            $cek_tgl = KegiatanModels::where('tanggal', '=', $k->tanggal)->exists();
        }
        for ($i=0;$i<count($keg);$i++){
            //dd($keg[$i]->id = $k->crash);
        }
        return view('all.base.gabung-kegiatan', compact('today', 'keg', 'tempat', 'todays'));
    }
}
