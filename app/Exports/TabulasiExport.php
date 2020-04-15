<?php

namespace App\Exports;

use App\Models\PPL\MediaModel;
use App\Models\PPL\RekapPengaduanModels;
use App\Models\Yanzin\SektorModel;
//use Maatwebsite\Excel\Concerns\FromCollection;
//use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\PPL\TabulasiModel;
use Carbon\Carbon;
use http\Env\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\PPL\LayananModel;


class TabulasiExport implements FromView,ShouldAutoSize
{
//    /**
//    * @return \Illuminate\Support\Collection
//    */
//    public function collection()

    private $bulan;

    public function  __construct($bulan)
    {
        $this->bulan = $bulan;
    }


    public function view(): View
       {
           //dd($request);
            $bulan = $this->bulan;
           $user_name = strtoupper(Auth::user()->name);
           $todays = date("F", strtotime($this->bulan));
           $tanggal = $todays;
           $query = "CAST(id AS int)ASC";
           $tabulasi = TabulasiModel::all();
           $sektors = SektorModel::all();
           $medias = MediaModel::all();
           $layanans = LayananModel::all();
           $rek_pengaduan = RekapPengaduanModels::all();
           $rekap = RekapPengaduanModels::all();
           $rekap_informasi = RekapPengaduanModels::where('jenis_layanan', '2')->get();
           $rekap_pengaduan = RekapPengaduanModels::where('jenis_layanan', '3')->get();


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

           return view('ppl.content.tabulasi-rekap-pengaduan', [
               'tab' => TabulasiModel::where('tanggal', '=',date('Y-m'))->orderByRaw($query)->get()],
               compact('user_name', 'todays',
                   'todays',
                   'tabulasi',
                   'sektors',
                   'rek_pengaduan',
                   'query',
                   'medias',
                   'rekap',
                   'rekap_informasi',
                   'rekap_pengaduan',
                   'hasil_rekap',
                    'tanggal',
                    'bulan',
                    'layanans'));

       }

}



