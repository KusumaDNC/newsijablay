<?php

namespace App\Http\Controllers\All;

use App\Models\All\KabKotaModels;
use App\Models\Perencanaan\RekapPerencanaanModels;
use App\Models\PPL\LayananModel;
use App\Models\PPL\MediaModel;
use App\Models\PPL\RekapPengaduanModels;
use App\Models\PPL\TabulasiModel;
use App\Models\Yanzin\JenisIzinModel;
use App\Models\Yanzin\RekapPerizinanModel;
use App\Models\Yanzin\SektorModel;
use App\Models\Yanzin\SOPPelayananModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Promosi\KemitraanModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DataBidangController extends Controller
{
    public function gabungbidang(Request $request){
        $mitra = KemitraanModel::all();
        $user = Auth::user()->id;
        $user_name = Auth::user()->name;
        $soppelayanan = SOPPelayananModel::all();
        $today = date("Y-m");
        $dropdown = JenisIzinModel::all();
        $rekap_sop = SOPPelayananModel::all();
        $todays = date("F", strtotime($today));
        $rekap = RekapPerizinanModel::all();
        $kabkota = $request->input('kab_kota');
        $kabkotas = KabKotaModels::all();
        $rek_oss = DB::table('oss_models')
            ->where('daerah', 'LIKE', '%'.$kabkota.'%')
            ->get();
        $kab_kotas = DB::table('pma_invest_models')->groupBy('kab_kota')->get();
        $pma_pmdns = DB::table('pma_invest_models')->groupBy('pma_pmdn')->get();
        $sektors = DB::table('pma_invest_models')->groupBy('sektor')->get();
        $kab_kota = $request->input('kab_kota');
        $pma_pmdn = $request->input('pma_pmdn');
        $sektor = $request->input('sektor');
        $rek_perencanaan = RekapPerencanaanModels::all();
        if ($pma_pmdn == 'all'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', 'LIKE', '%'.$kabkota.'%')
                ->where('sektor', 'LIKE', '%'.$sektor.'%')
                ->get();
        }
        elseif ($kabkota == 'all'){
            $pma_invest = DB::table('pma_invest_models')
                ->Where('pma_pmdn', 'LIKE', '%'.$pma_pmdn.'%')
                ->Where('sektor', 'LIKE', '%'.$sektor.'%')
                ->get();
        }
        elseif ($sektor == 'all'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('pma_pmdn', 'LIKE', '%'.$pma_pmdn.'%')
                ->where('kab_kota', 'LIKE', '%'.$kabkota.'%')
                ->get();
        }
        elseif (($kab_kota == 'all') and ($sektor == 'all')){
            $pma_invest = DB::table('pma_invest_models')
                ->where('pma_pmdn', 'LIKE', '%'.$pma_pmdn.'%')
                ->get();
        }
        elseif (($pma_pmdn == 'all') and ($kabkota == 'all') and ($sektor == 'all')){
            $pma_invest = DB::table('pma_invest_models')->get();
        }
        else{
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', 'LIKE', '%'.$kabkota.'%')
                ->Where('pma_pmdn', 'LIKE', '%'.$pma_pmdn.'%')
                ->Where('sektor', 'LIKE', '%'.$sektor.'%')
                ->get();
        }
        $rek_pengaduan = RekapPengaduanModels::all();

////////////////////////////////////////////////////////////////////////update/////////////////////////////////////////////////////////
        $bulan = $request->bulan;
        $date = Carbon::parse($bulan);
        //dd($date);
        //dd($bulan);
        if ($bulan == null){
            $rek_pengaduan = RekapPengaduanModels::whereMonth('tanggal', Carbon::now()->format('m'))->get();
            //dd($rek_pengaduan);
        }
        else {
            $rek_pengaduan = RekapPengaduanModels::whereMonth('tanggal', $date)->whereYear('tanggal', $date)->get();
            //dd($rek_pengaduan);
        }
        $user_name = Auth::user()->name;
        $sektors = SektorModel::all();
        $tabulasi = TabulasiModel::all();
        //

        $medias = MediaModel::all();
        $layanans = LayananModel::all();
//        //dd(count($sektors->where('sektor', 'ESDM')));
        $hasil_rekaps = app('App\Http\Controllers\PPL\TabulasiController')->countRekap();

        //dd($test);
        // dd($hasil_rekaps);
        $tanggal = Carbon::parse($request->tanggal)->format('m');
        //dd($tanggal);
        $user = Auth::user()->id;
        $jenis_layanan_pengaduan = TabulasiModel::where('jenis_layanan','=','Pengaduan')
            ->whereMonth('tanggal','=',$tanggal)
            ->get();
        $jenis_layanan_informasi = TabulasiModel::where('jenis_layanan','=','Informasi')

            ->whereMonth('tanggal','=',$tanggal)
            ->get();
        $jml_jns_layanan_pengaduan = count($jenis_layanan_pengaduan);
        $jml_jns_layanan_informasi = count($jenis_layanan_informasi);
        $today = date('Y-m');
        $todays = date("F", strtotime($bulan));

/////////////////////////////////////////////////////////////////////////////////////////////////////////////


        return view('all.base.gabung-bidang', compact('mitra',
            'kabkota',
            'kabkotas',
            'rek_oss',
            'user',
            'user_name',
            'soppelayanan',
            'today',
            'todays',
            'dropdown',
            'rekap_sop',
            'rekap',
            'pma_invest',
            'kab_kotas',
            'pma_pmdns',
            'pma_pmdn',
            'sektors',
            'kab_kota',
            'rek_pengaduan',
            'medias',
            'layanans',
            'tabulasi',
            'hasil_rekaps',
            'jml_jns_layanan_informasi',
            'jml_jns_layanan_pengaduan',
            'rek_perencanaan'

        ));



    //////////////////////////////////////////////////////////////////////////////////////////////////////

    }
}
