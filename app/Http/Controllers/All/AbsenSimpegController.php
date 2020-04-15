<?php

namespace App\Http\Controllers\All;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\All\AbsensiSimpegModel;                                     
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsenSimpegController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       /* $user = Auth::user()->id;
        $user_name = Auth::user()->name;
        $absen = AbsensiSimpegModel::all()->first()->paginate(10);
        //dd($absen);
        return view('all.base.presensi', compact('absen', 'user', 'user_name'));*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
        return view('all.base.gabung-kepegawaian', compact('decode2', 'user', 'user_name', 'now1', 'now2', 'now'));
    /*    foreach ($decode2 as $d){
            $nip_to_store = $d->nip;
            $nama_to_store = $d->nama;
            $am_01_to_store = $d->am_01;
            $ap_01_to_store = $d->ap_01;
            $s_01_to_store = $d->s_01;
            $am_02_to_store = $d->am_02;
            $ap_02_to_store = $d->ap_02;
            $s_02_to_store = $d->s_02;
            $am_03_to_store = $d->am_03;
            $ap_03_to_store = $d->ap_03;
            $s_03_to_store = $d->s_03;
            $am_04_to_store = $d->am_04;
            $ap_04_to_store = $d->ap_04;
            $s_04_to_store = $d->s_04;
            $am_05_to_store = $d->am_05;
            $ap_05_to_store = $d->ap_05;
            $s_05_to_store = $d->s_05;
            $am_06_to_store = $d->am_06;
            $ap_06_to_store = $d->ap_06;
            $s_06_to_store = $d->s_06;
            $am_07_to_store = $d->am_07;
            $ap_07_to_store = $d->ap_07;
            $s_07_to_store = $d->s_07;
            $am_08_to_store = $d->am_08;
            $ap_08_to_store = $d->ap_08;
            $s_08_to_store = $d->s_08;
            $am_09_to_store = $d->am_09;
            $ap_09_to_store = $d->ap_09;
            $s_09_to_store = $d->s_09;
            $am_10_to_store = $d->am_10;
            $ap_10_to_store = $d->ap_10;
            $s_10_to_store = $d->s_10;
            $am_11_to_store = $d->am_11;
            $ap_11_to_store = $d->ap_11;
            $s_11_to_store = $d->s_11;
            $am_12_to_store = $d->am_12;
            $ap_12_to_store = $d->ap_12;
            $s_12_to_store = $d->s_12;
            $am_13_to_store = $d->am_13;
            $ap_13_to_store = $d->ap_13;
            $s_13_to_store = $d->s_13;
            $am_14_to_store = $d->am_14;
            $ap_14_to_store = $d->ap_14;
            $s_14_to_store = $d->s_14;
            $am_15_to_store = $d->am_15;
            $ap_15_to_store = $d->ap_15;
            $s_15_to_store = $d->s_15;
            $am_16_to_store = $d->am_16;
            $ap_16_to_store = $d->ap_16;
            $s_16_to_store = $d->s_16;
            $am_17_to_store = $d->am_17;
            $ap_17_to_store = $d->ap_17;
            $s_17_to_store = $d->s_17;
            $am_18_to_store = $d->am_18;
            $ap_18_to_store = $d->ap_18;
            $s_18_to_store = $d->s_18;
            $am_19_to_store = $d->am_19;
            $ap_19_to_store = $d->ap_19;
            $s_19_to_store = $d->s_19;
            $am_20_to_store = $d->am_20;
            $ap_20_to_store = $d->ap_20;
            $s_20_to_store = $d->s_20;
            $am_21_to_store = $d->am_21;
            $ap_21_to_store = $d->ap_21;
            $s_21_to_store = $d->s_21;
            $am_22_to_store = $d->am_22;
            $ap_22_to_store = $d->ap_22;
            $s_22_to_store = $d->s_22;
            $am_23_to_store = $d->am_23;
            $ap_23_to_store = $d->ap_23;
            $s_23_to_store = $d->s_23;
            $am_24_to_store = $d->am_24;
            $ap_24_to_store = $d->ap_24;
            $s_24_to_store = $d->s_24;
            $am_25_to_store = $d->am_25;
            $ap_25_to_store = $d->ap_25;
            $s_25_to_store = $d->s_25;
            $am_26_to_store = $d->am_26;
            $ap_26_to_store = $d->ap_26;
            $s_26_to_store = $d->s_26;
            $am_27_to_store = $d->am_27;
            $ap_27_to_store = $d->ap_27;
            $s_27_to_store = $d->s_27   ;
            $am_28_to_store = $d->am_28;
            $ap_28_to_store = $d->ap_28;
            $s_28_to_store = $d->s_28;
            $am_29_to_store = $d->am_29;
            $ap_29_to_store = $d->ap_29;
            $s_29_to_store = $d->s_29;
            $am_30_to_store = $d->am_30;
            $ap_30_to_store = $d->ap_30;
            $s_30_to_store = $d->s_30;
            $am_31_to_store = $d->am_31;
            $ap_31_to_store = $d->ap_31;
            $s_31_to_store = $d->s_31;
            $kwk_to_store = $d->kwk;
            $alpha_to_store = $d->alpha;

            $post = new AbsensiSimpegModel();
            $post->nip = $nip_to_store;
            $post->nama = $nama_to_store;
            $post->am_01 = $am_01_to_store;
            $post->ap_01 = $ap_01_to_store;
            $post->s_01 = $s_01_to_store;
            $post->am_02 = $am_02_to_store;
            $post->ap_02 = $ap_02_to_store;
            $post->s_02 = $s_02_to_store;
            $post->am_03 = $am_03_to_store;
            $post->ap_03 = $ap_03_to_store;
            $post->s_03 = $s_03_to_store;
            $post->am_04 = $am_04_to_store;
            $post->ap_04 = $ap_04_to_store;
            $post->s_04 = $s_04_to_store;
            $post->am_05 = $am_05_to_store;
            $post->ap_05 = $ap_05_to_store;
            $post->s_05 = $s_05_to_store;
            $post->am_06 = $am_06_to_store;
            $post->ap_06 = $ap_06_to_store;
            $post->s_06 = $s_06_to_store;
            $post->am_07 = $am_07_to_store;
            $post->ap_07 = $ap_07_to_store;
            $post->s_07 = $s_07_to_store;
            $post->am_08 = $am_08_to_store;
            $post->ap_08 = $ap_08_to_store;
            $post->s_08 = $s_08_to_store;
            $post->am_09 = $am_09_to_store;
            $post->ap_09 = $ap_09_to_store;
            $post->s_09 = $s_09_to_store;
            $post->am_10 = $am_10_to_store;
            $post->ap_10 = $ap_10_to_store;
            $post->s_10 = $s_10_to_store;
            $post->am_11 = $am_11_to_store;
            $post->ap_11 = $ap_11_to_store;
            $post->s_11 = $s_11_to_store;
            $post->am_12 = $am_12_to_store;
            $post->ap_12 = $ap_12_to_store;
            $post->s_12 = $s_12_to_store;
            $post->am_13 = $am_13_to_store;
            $post->ap_13 = $ap_13_to_store;
            $post->s_13 = $s_13_to_store;
            $post->am_14 = $am_14_to_store;
            $post->ap_14 = $ap_14_to_store;
            $post->s_14 = $s_14_to_store;
            $post->am_15 = $am_15_to_store;
            $post->ap_15 = $ap_15_to_store;
            $post->s_15 = $s_15_to_store;
            $post->am_16 = $am_16_to_store;
            $post->ap_16 = $ap_16_to_store;
            $post->s_16 = $s_16_to_store;
            $post->am_17 = $am_17_to_store;
            $post->ap_17 = $ap_17_to_store;
            $post->s_17 = $s_17_to_store;
            $post->am_18 = $am_18_to_store;
            $post->ap_18 = $ap_18_to_store;
            $post->s_18= $s_18_to_store;
            $post->am_19 = $am_19_to_store;
            $post->ap_19 = $ap_19_to_store;
            $post->s_19= $s_19_to_store;
            $post->am_20 = $am_20_to_store;
            $post->ap_20 = $ap_20_to_store;
            $post->s_20 = $s_20_to_store;
            $post->am_21 = $am_21_to_store;
            $post->ap_21 = $ap_21_to_store;
            $post->s_21 = $s_21_to_store;
            $post->am_22= $am_22_to_store;
            $post->ap_22 = $ap_22_to_store;
            $post->s_22 = $s_22_to_store;
            $post->am_23= $am_23_to_store;
            $post->ap_23 = $ap_23_to_store;
            $post->s_23 = $s_23_to_store;
            $post->am_24 = $am_24_to_store;
            $post->ap_24 = $ap_24_to_store;
            $post->s_24 = $s_24_to_store;
            $post->am_25 = $am_25_to_store;
            $post->ap_25 = $ap_25_to_store;
            $post->s_25 = $s_25_to_store;
            $post->am_26 = $am_26_to_store;
            $post->ap_26 = $ap_26_to_store;
            $post->s_26 = $s_26_to_store;
            $post->am_27 = $am_27_to_store;
            $post->ap_27 = $ap_27_to_store;
            $post->s_27 = $s_27_to_store;
            $post->am_28 = $am_28_to_store;
            $post->ap_28 = $ap_28_to_store;
            $post->s_28 = $s_28_to_store;
            $post->am_29 = $am_29_to_store;
            $post->ap_29 = $ap_29_to_store;
            $post->s_29 = $s_29_to_store;
            $post->am_30 = $am_30_to_store;
            $post->ap_30 = $ap_30_to_store;
            $post->s_30 = $s_30_to_store;
            $post->am_31 = $am_31_to_store;
            $post->ap_31 = $ap_31_to_store;
            $post->s_31 = $s_31_to_store;
            $post->kwk = $kwk_to_store;
            $post->alpha = $alpha_to_store;

            $post->save();
        }
        return ('uploaded');*/
    }

}
