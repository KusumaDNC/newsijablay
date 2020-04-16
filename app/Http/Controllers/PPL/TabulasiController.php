<?php

namespace App\Http\Controllers\PPL;

use App\Exports\TabulasiExport;
use App\Models\PPL\MediaModel;
use App\Models\PPL\RekapPengaduanModels;
use App\Models\PPL\TabulasiModel;
use App\Models\Yanzin\SektorModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\View\View;

class TabulasiController extends Controller
{


    public function index(Request $request)
    {
        $user = Auth::user()->id;
        $user_name = Auth::user()->name;
        $bulan = $request->input('bulan');
        $today = date("Y-m");
        $todays = date("F", strtotime());

        $query = "CAST(rko_id AS int)ASC";
        $tab = TabulasiModel::where('bulan', '=', $bulan)
            ->orderByRaw($query)
            /*->where('user_id', '=', $user)*/
            ->get();
       // dd($tab);
        return view('ppl.base.tabulasi-rekap-pengaduan', compact('user', 'user_name', 'todays', 'tab', 'today','bulan'));
    }

        public function showTabulasi(Request $request)
    {
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
        $rek_pengaduan = RekapPengaduanModels::whereMonth('tanggal', $request->bulan)->get();
        $today = date('Y-m');
        //dd($jenis_layanan_pengaduan);
        return view('ppl.base.gabung',
            compact('today',
            'user',
            'jml_jns_layanan_pengaduan',
                'jml_jns_layanan_informasi',
                'jenis_layanan_informasi',
                'rek_pengaduan'));
    }


    public function countRekap(){

        $rekap = RekapPengaduanModels::all();
        //dd($rekap);
        $rekap_informasi = RekapPengaduanModels::where('jenis_layanan', '2')->get();
        $rekap_pengaduan = RekapPengaduanModels::where('jenis_layanan', '3')->get();
        //dd($rekap_informasi->isEmpty());\\

        if ($rekap_informasi->isEmpty() or $rekap_pengaduan->isEmpty ()){
            $hasil_rekap = array(
                'total_aduan_informasi' => 0,
                'sektor_aduan_informasi' => 0,
                'total_aduan_pengaduan' => 0,
                'sektor_aduan_pengaduan' => 0,
            );
            //dd($groupCountInformasi);
            //dd($hasil_rekap);
            return $hasil_rekap;
        }
        else{
            $groupedInformasi = $rekap_informasi->groupBy(function ($item, $key) {
                return $item['sektor'];
            });
            //dd($grouped);
            //dd($groupedInformasi);
            $groupCountInformasi = $groupedInformasi->map(function ($item, $key) {
                return collect($item)->count();
            });
            //dd($groupCountInformasi);
            /////////////////////////////////////////////////////////////////////// BY SECTOR - Informasi
            ///
            ///
            /// /////////////////////////////////////////////////////////////////// BY SECTOR - PENGADUAN
            $groupedPengaduan = $rekap_pengaduan->groupBy(function ($item, $key) {
                return $item['sektor'];
            });
            //dd($grouped);

            $groupCountPengaduan = $groupedPengaduan->map(function ($item, $key) {
                return collect($item)->count();
            });

            //////////////////////////////////////////////////////////
            ///
            ///
            /// //////////////////////////////////////////////////////COUNT BY JENIS LAYANAN

            $grouped = $rekap->groupBy(function ($item, $key) {
                //dd($item);
                return $item['jenis_layanan'];
            });

            //dd($grouped);

            $groupCount = $grouped->map(function ($item, $key) {
                return collect($item)->count();
            });
            //dd($groupCount);
            ///////////////////////////////////////////////////////////

            //dd($groupCount);

            $hasil_rekap = array(
                'total_aduan_informasi' => $groupCount['2'],
                'sektor_aduan_informasi' => $groupCountInformasi,
                'total_aduan_pengaduan' => $groupCount['3'],
                'sektor_aduan_pengaduan' => $groupCountPengaduan,
            );
            //dd($groupCountInformasi);
            //dd($hasil_rekap);
            return $hasil_rekap;
        }
        ////////////////////////////////////////////////////////////////////////


    }

    public function ExportTabulasi(Request $request)
    {
        //dd($request);
        $bulan = $request->bulanExport;
        //dd($bulan);
        return Excel::download(new TabulasiExport($bulan), 'Tabulasi.xlsx');
    }



}
