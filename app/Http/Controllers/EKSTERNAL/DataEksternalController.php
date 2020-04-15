<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\ExporImporExport;
use App\Models\EKSTERNAL\BahanBakarModel;
use App\Models\EKSTERNAL\BarangModalTetapModels;
use App\Models\EKSTERNAL\BayarPekerjaModel;
use App\Models\EKSTERNAL\EksporImporModel;
use App\Models\EKSTERNAL\KepemilikanModalModel;
use App\Models\EKSTERNAL\ListrikModel;
use App\Models\EKSTERNAL\LokerModel;
use App\Models\EKSTERNAL\NegaraTujuanModel;
use App\Models\EKSTERNAL\NilaiPendapatanPerusahaanModel;
use App\Models\EKSTERNAL\NilaiTambahPerusahaanModel;
use App\Models\EKSTERNAL\PelabuhanModel;
use App\Models\EKSTERNAL\PendidikanModels;
use App\Models\EKSTERNAL\PengeluaranPekerjaModel;
use App\Models\EKSTERNAL\PengeluaranPerusahaanModel;
use App\Models\EKSTERNAL\PenjualanBarangModalModels;
use App\Models\EKSTERNAL\SelisihStokAwalModel;
use App\Models\EKSTERNAL\StatusPenanamanModalModel;
use App\Models\EKSTERNAL\UmrModels;
use App\Models\PenjualanBarangModels;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DataEksternalController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user()->id;
        $user_name = Auth::user()->name;
        //dd(empty($request->all()));
        $rek_eksporimpor = EksporImporModel::Filter(
            $request->from_tahun,
            $request->to_tahun,
            $request->volume,
            $request->komoditi
        )->get();
        $tahuns = EksporImporModel::groupBy('tahun')->pluck('tahun');
        $volumes = EksporImporModel::groupBy('jenis_volume')->pluck('jenis_volume');
        $komoditis = EksporImporModel::groupBy('jenis_komoditi')->pluck('jenis_komoditi');

        $rek_pelabuhan = PelabuhanModel::Filter(
            $request->from_tahun,
            $request->to_tahun,
            $request->volume,
            $request->pelabuhan_muat
        )->get();
        $tahunpelabuhan = PelabuhanModel::groupBy('tahun')->pluck('tahun');
        $volumepelabuhan = PelabuhanModel::groupBy('jenis_volume')->pluck('jenis_volume');
        $pelabuhan = PelabuhanModel::groupBy('pelabuhan_muat')->pluck('pelabuhan_muat');

        $rek_pelabuhan = PelabuhanModel::all();
        $rek_negara = NegaraTujuanModel::all();
        $rek_statuspenanaman = StatusPenanamanModalModel::all();
        $rek_kepemilikan = KepemilikanModalModel::all();
        $rek_bayarpekerja = BayarPekerjaModel::all();
        $rek_pengeluaranpekerja = PengeluaranPekerjaModel::all();
        $rek_bahanbakar = BahanBakarModel::all();
        $rek_listrik = ListrikModel::all();
        $rek_pengeluaran_perusahaan = PengeluaranPerusahaanModel::all();
        $rek_nilaipendapatan = NilaiPendapatanPerusahaanModel::all();
        $rek_nilaitambah = NilaiTambahPerusahaanModel::all();
        $rek_stokawal = SelisihStokAwalModel::all();
        $rek_barangmodal = BarangModalTetapModels::all();
        $rek_penjualan = PenjualanBarangModalModels::all();
        $rek_umr = UmrModels::all();
        $rek_pendidikan = PendidikanModels::all();
        $rek_loker = LokerModel::all();
        //dd($rek_eksporimpor);
      /*  $user_name = Auth::user()->name;*/
        return view('eksternal.base.gabung',compact('rek_eksporimpor',
        'tahuns',
        'volumes',
        'komoditis',
        'user',
        'user_name',
        'rek_pelabuhan',
        'rek_negara',
        'rek_statuspenanaman',
        'rek_kepemilikan',
        'rek_bayarpekerja',
        'rek_pengeluaranpekerja',
        'rek_bahanbakar',
        'rek_listrik',
        'rek_pengeluaran_perusahaan',
        'rek_nilaipendapatan',
        'rek_nilaitambah',
        'rek_stokawal',
        'rek_barangmodal',
        'rek_penjualan',
        'tahunpelabuhan',
         'volumepelabuhan',
         'pelabuhan',
        'rek_umr',
        'rek_pendidikan',
        'rek_loker'));
    }

    public function filter(Request $request){

        DB::enableQueryLog();
         //dd($request->all());
        //dd(EksporImporModel::where('tahun', 2019)->get());
        $rek_eksporimpor = EksporImporModel::Filter(
            $request->from_tahun,
            $request->to_tahun,
            $request->volume,
            $request->komoditi
        )->get();

        //dd(DB::getQueryLog());
        //dd($rek_eksporimpor->groupBy('tahun'));
        $data = collect();

        foreach ($rek_eksporimpor->groupBy('tahun') as $tahun => $dt){
            $arrs = array(
                "tahun" => $tahun,
                "data" => $dt
            );
            $data->push($arrs);
        }

       /* dd($data->toArray());*/


        //dd($rek_eksporimpor->groupBy('tahun'));
        //dd($rek_eksporimpor);
        $user = Auth::user()->id;
        $user_name = Auth::user()->name;
        $tahuns = EksporImporModel::groupBy('tahun')->pluck('tahun');
        $volumes = EksporImporModel::groupBy('jenis_volume')->pluck('jenis_volume');
        $komoditis = EksporImporModel::groupBy('jenis_komoditi')->pluck('jenis_komoditi');

        $tahunpelabuhan = PelabuhanModel::groupBy('tahun')->pluck('tahun');
        $volumepelabuhan = PelabuhanModel::groupBy('jenis_volume')->pluck('jenis_volume');
        $pelabuhan = PelabuhanModel::groupBy('pelabuhan_muat')->pluck('pelabuhan_muat');

        //$rek_eksporimpor = EksporImporModel::whereBetween()->whereYear()->get();
        $rek_pelabuhan = PelabuhanModel::all();
        $rek_negara = NegaraTujuanModel::all();
        $rek_statuspenanaman = StatusPenanamanModalModel::all();
        $rek_kepemilikan = KepemilikanModalModel::all();
        $rek_bayarpekerja = BayarPekerjaModel::all();
        $rek_pengeluaranpekerja = PengeluaranPekerjaModel::all();
        $rek_bahanbakar = BahanBakarModel::all();
        $rek_listrik = ListrikModel::all();
        $rek_pengeluaran_perusahaan = PengeluaranPerusahaanModel::all();
        $rek_nilaipendapatan = NilaiPendapatanPerusahaanModel::all();
        $rek_nilaitambah = NilaiTambahPerusahaanModel::all();
        $rek_stokawal = SelisihStokAwalModel::all();
        $rek_barangmodal = BarangModalTetapModels::all();
        $rek_penjualan = PenjualanBarangModalModels::all();
        $sum_rek = DB::table('ekspor_impor_models')
                            ->whereBetween('tahun', [$request->from_tahun, $request->to_tahun])
                            ->groupBy('tahun')
                            ->sum('volume');
        //dd($sum_rek);
        return view('eksternal.base.gabung',compact('rek_eksporimpor',
            'tahuns',
            'volumes',
            'komoditis',
            'user',
            'user_name',
            'rek_pelabuhan',
            'rek_negara',
            'rek_statuspenanaman',
            'rek_kepemilikan',
            'rek_bayarpekerja',
            'rek_pengeluaranpekerja',
            'rek_bahanbakar',
            'rek_listrik',
            'rek_pengeluaran_perusahaan',
            'rek_nilaipendapatan',
            'rek_nilaitambah',
            'rek_stokawal',
            'rek_barangmodal',
            'rek_penjualan',
            'tahunpelabuhan',
            'volumepelabuhan',
            'pelabuhan'
        ));

    }


    public function rekap(){
     /*   /*$rek_eksporimpor = EksporImporModel::all();
        $user_name = Auth::user()->name;
        //dd($rek_pengaduan);

        return view('eksternal.base.gabung', compact('rek_eksporimpor', 'user_name'));*/

    }



}
