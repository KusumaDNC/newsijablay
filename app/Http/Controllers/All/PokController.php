<?php

namespace App\Http\Controllers\All;

use App\app\Models\All\PokModel;
use App\Exports\PokExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Sekretariat\RkoModel;
use App\Models\Sekretariat\TargetRealisasiModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rekapPOK(Request $request)
    {
        $user = Auth::user()->id;
        $user_name = Auth::user()->name;
        $bulan = $request->input('bulan');
        $today = date("Y-m");
        $todays = date("F", strtotime($bulan));
        //dd($todays);



        $query = "CAST(rko_id AS int)ASC";
        //dd($query);
        $pok = PokModel::where('bulan', '=', $bulan)
            ->orderByRaw($query)
           /*->where('user_id', '=', $user)*/
            ->get();
            //dd($pok);

        return view ('all.base.rekap-pok-bidang', compact('user', 'user_name', 'todays', 'pok', 'today'));
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


    public function storePOK(Request $request)
    {
        $user = Auth::user();
        $user_id = Auth::user()->id;

        $this->validate($request, [
            'realisasi_fisik_sebelum' => 'required', /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            'realisasi_keu_sebelum' => 'required',
            'realisasi_fisik' => 'required',
            'realisasi_keu' => 'required',
            'rko_id' => 'required',
            'bulan' => 'required',
        ]);

        $realisasi_fisiks_sebelum = $request->input('realisasi_fisik_sebelum');
        $realisasi_fisik_sebelum = str_replace('.','', $realisasi_fisiks_sebelum);
        $realisasi_keus_sebelum = $request->input('realisasi_keu_sebelum');
        $realisasi_keu_sebelum = str_replace('.','', $realisasi_keus_sebelum);
        $realisasi_fisiks = $request->input('realisasi_fisik');
        $realisasi_fisik = str_replace('.','', $realisasi_fisiks);
        $realisasi_keus = $request->input('realisasi_keu');
        $realisasi_keu = str_replace('.','', $realisasi_keus);
        $rko_id = $request->input('rko_id');
        $bulan = $request->input('bulan');
        $ket = $request->input('ket');
        $target_realisasi = TargetRealisasiModel::where('rko_id', '=', $rko_id)
            ->where('bulan', '=', $bulan)->get();
        //dd($target_realisasi);
        foreach ($target_realisasi as $tr){
            $tr->target;
        }
        //dd($target_realisasi);
        $targets = str_replace(',', '.',($tr->target));
        $jml_anggaran = RkoModel::where('id', '=', $rko_id)->get();
        foreach ($jml_anggaran as $jml){
            $jml->jml_anggaran;
        }
        $jml_anggarans = str_replace('.','', ($jml->jml_anggaran));
        /*$pok_sblm = PokModel::where('bulan', '<', $bulan)->where('user_id', '=', $user_id)->get();
        $sum_reafis_sblm = 0;
        foreach ($pok_sblm as $reafis_sebelum){
            if ($reafis_sebelum->rko_id == $rko_id){
                $sum_reafis_sblm = $reafis_sebelum->fisik_smp_skrg;
            }
            else{

            }
        }
        $sum_reakeu_sblm = 0;
        foreach ($pok_sblm as $reakeu_sebelum){
            if ($reakeu_sebelum->rko_id == $rko_id){
                $sum_reakeu_sblm = $reakeu_sebelum->keu_smp_skrg;
            }
            else{
            }
        }*/
        $sum_reafis_skrg = $realisasi_fisik_sebelum + $realisasi_fisik;
        $sum_reakeu_skrg = $realisasi_keu_sebelum + $realisasi_keu;
        $persen_reafis_skrg = round((((str_replace('.','',$sum_reafis_skrg))/$jml_anggarans)*100),2);
        $deviasi = round(($persen_reafis_skrg - $targets),2);
        //dd($deviasi);

        $in = new PokModel();
        $in->realisasi_fisik = $realisasi_fisik;
        $in->realisasi_keu = $realisasi_keu;
        $in->user_id = Auth::user()->id;
        $in->bulan = $bulan;
        $in->target = $targets;
        $in->rko_id = $rko_id;
        $in->fisik_sblm_bln = $realisasi_fisiks_sebelum;
        $in->keu_sblm_bln = $realisasi_keu_sebelum;
        $in->fisik_smp_skrg = $sum_reafis_skrg;
        $in->keu_smp_skrg = $sum_reakeu_skrg;
        $in->deviasi = $deviasi;
        $in->ket = $ket;
        //dd($in);
        $in->save();
        return redirect()->route('rekap.pok')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPOK()
    {
        $user = Auth::user()->id;
        $dropdown = RkoModel::where('bidang', '=', $user)->get(['nama_kegiatan', 'id']);
        $today = date('Y-m');
        //dd($dropdown);
        return view('all.base.show-pok', compact('dropdown','today'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pok = PokModel::findOrFail($id);
        $dropdown = RkoModel::all(['nama_kegiatan', 'id']);
        $user = Auth::user()->username;

        return view('all.base.edit-pok', compact('pok', 'dropdown', 'user'));
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
        $user_id = Auth::user()->id;
        $this->validate($request, [
            'realisasi_fisik' => 'required',
            'realisasi_keu' => 'required',
            'rko_id' => 'required',
            'bulan' => 'required',
            'ket' => 'required',
        ]);

        $realisasi_fisiks_sebelum = $request->input('realisasi_fisik_sebelum');
        $realisasi_fisik_sebelum = str_replace('.','', $realisasi_fisiks_sebelum);
        $realisasi_keus_sebelum = $request->input('realisasi_keu_sebelum');
        $realisasi_keu_sebelum = str_replace('.','', $realisasi_keus_sebelum);
        $realisasi_fisiks = $request->input('realisasi_fisik');
        $realisasi_fisik = str_replace('.','', $realisasi_fisiks);
        $realisasi_keus = $request->input('realisasi_keu');
        $realisasi_keu = str_replace('.','', $realisasi_keus);
        $rko_id = $request->input('rko_id');
        $bulan = $request->input('bulan');
        $ket = $request->input('ket');
        $target_realisasi = TargetRealisasiModel::where('rko_id', '=', $rko_id)
            ->where('bulan', '=', $bulan)->get();
        //dd($target_realisasi);
        foreach ($target_realisasi as $tr){
            $tr->target;
        }
        //dd($target_realisasi);
        $targets = str_replace(',', '.',($tr->target));
        $jml_anggaran = RkoModel::where('id', '=', $rko_id)->get();
        foreach ($jml_anggaran as $jml){
            $jml->jml_anggaran;
        }
        $jml_anggarans = str_replace('.','', ($jml->jml_anggaran));
        /*$pok_sblm = PokModel::where('bulan', '<', $bulan)->where('user_id', '=', $user_id)->get();
        $sum_reafis_sblm = 0;
        foreach ($pok_sblm as $reafis_sebelum){
            if ($reafis_sebelum->rko_id == $rko_id){
                $sum_reafis_sblm = $reafis_sebelum->fisik_smp_skrg;
            }
            else{

            }
        }
        $sum_reakeu_sblm = 0;
        foreach ($pok_sblm as $reakeu_sebelum){
            if ($reakeu_sebelum->rko_id == $rko_id){
                $sum_reakeu_sblm = $reakeu_sebelum->keu_smp_skrg;
            }
            else{
            }
        }*/
        $sum_reafis_skrg = $realisasi_fisik_sebelum + $realisasi_fisik;
        $sum_reakeu_skrg = $realisasi_keu_sebelum + $realisasi_keu;
        $persen_reafis_skrg = round((((str_replace('.','',$sum_reafis_skrg))/$jml_anggarans)*100),2);
        $deviasi = round(($persen_reafis_skrg - $targets),2);
        //dd($deviasi);

        $in = PokModel::findOrFail($id);
        $in->realisasi_fisik = $realisasi_fisik;
        $in->realisasi_keu = $realisasi_keu;
        $in->user_id = Auth::user()->id;
        $in->bulan = $bulan;
        $in->target = $targets;
        $in->rko_id = $rko_id;
        $in->fisik_sblm_bln = $realisasi_fisiks_sebelum;
        $in->keu_sblm_bln = $realisasi_keu_sebelum;
        $in->fisik_smp_skrg = $sum_reafis_skrg;
        $in->keu_smp_skrg = $sum_reakeu_skrg;
        $in->deviasi = $deviasi;
        $in->ket = $ket;
        //dd($in);
        $in->update();

        return redirect()->route('rekap.pok')->with('success', 'Data berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pok = PokModel::findOrFail($id);
        dd($pok);
        $pok->delete();
    }
    //
    public function export()
    {
        return Excel::download(new PokExport(), 'pok.xlsx');
    }

    public function gabungPOK(Request $request)
    {
        $user = Auth::user()->id;
        $dropdown = RkoModel::where('bidang', '=', $user)->get(['nama_kegiatan', 'id']);
        $today = date('Y-m');
        $user = Auth::user()->id;
        $user_name = Auth::user()->name;
        $bulan = $request->input('bulan');
        $todays = date("F", strtotime($bulan));
        $query = "CAST(rko_id AS int)ASC";
        $pok = PokModel::where('bulan', '=', $bulan)
            ->orderByRaw($query)
            ->get();

        return view('all.base.gabung-pok', compact('dropdown','today', 'user', 'user_name', 'todays', 'pok'));
    }
}
