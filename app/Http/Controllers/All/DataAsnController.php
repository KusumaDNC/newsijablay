<?php

namespace App\Http\Controllers\All;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DataAsnController extends Controller
{
    public function dataasn(Request $request){

        $user = Auth::user()->id;
        $user_name = Auth::user()->name;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://simpeg.bkd.jatengprov.go.id/rest/pns/F0");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $decode = json_decode($result);
       // dd($decode->nama);

        /*foreach ($decode as $dec) {
        //            $ch = curl_init();
        //            curl_setopt($ch, CURLOPT_URL, "http://simpeg.bkd.jatengprov.go.id/webservice/identitas");
        //            curl_setopt($ch, CURLOPT_POST, 1);
        //            curl_setopt($ch, CURLOPT_POSTFIELDS, "nip=" . $dec->nip . "");
        //            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //            $result = curl_exec($ch);
        //            $decode = json_decode($result);
        //        }
        //        */
       /* foreach ($decode as $dec) {

        }
        dd($dec->nama);*/

        return view('all.base.data-asn', compact('decode', 'user', 'user_name'));
    }

    public function absensimpeg(Request $request){

        $user = Auth::user()->id;
        $user_name = Auth::user()->name;

        $now1 = Carbon::now()->format('Y');
        $now2 = Carbon::now()->format('m');
        $now = Carbon::now()->format('Y-m');

        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $tanggal = $tahun."-".$bulan;

        if ($bulan==null){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://simpeg.bkd.jatengprov.go.id/presensi_new/service/Bulanan_skpd/".$now);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            $decode = json_decode($result);
            $decode2 = $decode->item;
        }
        else{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://simpeg.bkd.jatengprov.go.id/presensi_new/service/Bulanan_skpd/".$tanggal);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            $decode = json_decode($result);
            $decode2 = $decode->item;
        }
        //dd($ch);
        return view('all.base.presensi', compact('decode2', 'user', 'user_name', 'now1', 'now2', 'now'));
    }

    public function gabungdataasn(Request $request){
        $user = Auth::user()->id;
        $user_name = Auth::user()->name;
        $now1 = Carbon::now()->format('Y');
        $now2 = Carbon::now()->format('m');
        $now = Carbon::now()->format('Y-m');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        $tanggal = $tahun."-".$bulan;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://simpeg.bkd.jatengprov.go.id/rest/pns/F0");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $decode = json_decode($result);

        if ($bulan==null){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://simpeg.bkd.jatengprov.go.id/presensi_new/service/Bulanan_skpd/".$now);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            $decodes = json_decode($result);
            //dd($decode);
            $decode2 = $decodes->item;
        }
        else{
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://simpeg.bkd.jatengprov.go.id/presensi_new/service/Bulanan_skpd/".$tanggal);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            $decodes = json_decode($result);
            $decode2 = $decodes->item;
        }
        return view('all.base.gabung-kepegawaian', compact('decode','decode2', 'user', 'user_name', 'now1', 'now2', 'now'));

    }
}
