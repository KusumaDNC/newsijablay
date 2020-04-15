<?php

namespace App\Http\Controllers\SPT;

use App\Models\PangkatModel;
use App\Models\PD\NumberModel;
use App\Models\PD\SptModel;
use App\Models\Sekretariat\DataAsnModel;
use App\Models\Sekretariat\PLTModel;
use App\Models\Sekretariat\RekModel;
use App\Models\Sekretariat\SettingModels;
use App\Models\SPT\DasarHukumModel;
use App\PivotName;
use Barryvdh\DomPDF\Facade as PDF;
use Cake\Chronos\Date;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nexmo\Response;
use phpDocumentor\Reflection\Types\Null_;
use PhpOffice\PhpWord\Exception\Exception;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SPT\DasarHukumController;

class RekapSPTController extends Controller
{
    public function getSpt(){
        $user = Auth::user()->id;
        $user_name = Auth::user()->name;
        $spt = SptModel::all()->where('user_id', '=', $user)->sortByDesc('created_at');
        //dd($spt);
        if (count($spt) == 0){
            $sptnol = 'Belum Ada SPT';
        }
        else{
            foreach ($spt as $s){
                $nama = $s->data_asn_models_id;
                //dd($s->tgl_berangkat);
                $b_spt = Carbon::parse($s->tgl_spt)->formatLocalized('%A, %d %B %Y');
                $b_mgk = Carbon::parse($s->tgl_berangkat)->formatLocalized('%A, %d %B %Y');
                $b_mlh = Carbon::parse($s->tgl_pulang)->formatLocalized('%A, %d %B %Y');
            }
            //dd($b_mgk);
            $na = PivotName::all();
            $get_nama = DataAsnModel::find($s->data_asn_models_id);
            //dd($get_nama);
        }
       /* foreach ($spt as $s){
            foreach ($s as $t){
                $t->tujuan;
            }
        }
        dd($t);*/

       $dasar_hukums=DasarHukumModel::all();
        return view('spt.base.rekap-spt', compact('spt', 'nama', 'get_nama', 'user_name', 'na', 'b_mgk' ,'b_mlh', 'b_spt','dasar_hukums'));
    }
    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws Exception
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function cetakSpt($id){

        /*return view('spt.cetak_spt');*/
        $user_name = Auth::user()->name;
        $tahun = date('Y');
        $spt = SptModel::find($id);
        $spt = SptModel::find($id);
        $bidang = Auth::user()->id;
        $bidang_name = Auth::user()->name;
        $jabatan = 'KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU';
        $b_spt = Carbon::parse($spt->tgl_spt)->formatLocalized('%d %B %Y');
        $b_mgk = Carbon::parse($spt->tgl_berangkat)->formatLocalized('%d %B %Y');
        $b_mlh = Carbon::parse($spt->tgl_pulang)->formatLocalized('%d %B %Y');
        $saiki = date('Y-m-d');
        $now = Carbon::parse($saiki)->formatLocalized('%A, %d %B %Y');
        //dd($spt->pivot[2]->namad->jabatan);

        foreach ($spt->pivot as $pangkats){
            //dd($pangkat->namad);
        }
        foreach ($spt->tujuan as $dest){

        }
        $spt1 = storage_path('spt/draft_SPT-new(1).docx');

        $kepala = DB::table('data_asn_models')
            ->where('jabatan', 'LIKE', 'KEPALA DINAS%')
            ->get();

        if (count($kepala) == 1){
            foreach ($kepala as $kep){
            }
        }
        else{
            /* $plts = PLTModel::all();

             foreach ($plts as $plt) {
                 $nama_plt = $plt->plt->nama;
                 $nip_plt = $plt->plt->nip;
                 $pangkat_plt = $plt->pangkat->pangkat;
                 $jabatan_plt = $plt->plt->jabatan;

                 foreach ($plt as $p){

                 }
             }*/
        }
        $p = false;
        $pangkat_kepala = 'Pembina Utama Muda';

        if (!empty($kep)){

            $jabatan = 'KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU';

        }
        $plh = SettingModels::all();
        foreach ($plh as $gankep){
            //dd($gankep->jabatan_kepala);
        }
        //dd(count($plh));
        $strukturals = DB::table('data_asn_models')
            ->where('jabatan', 'LIKE', 'KASI%')
            ->orWhere('jabatan', 'LIKE', 'KABID%')
            ->orWhere('jabatan', 'LIKE', 'Kepala Seksi%')
            ->orWhere('jabatan', 'LIKE', 'SEKRETARIS')
            ->orWhere('jabatan', 'LIKE', 'KASUBBAG%')
            ->pluck('jabatan');
//dd($strukturals);
        foreach ($strukturals as $struktural){

        }
        //dd(stripos($d, $c) !== FALSE);
        foreach ($spt->pivot as $s){
        }
        $cek = (stripos($s->namad->jabatan, $struktural) !== FALSE);
        if ($bidang_name == 'Sekretariat'){
            $kabid = DataAsnModel::where('jabatan', 'LIKE', 'Sekretaris%')->get();
            foreach ($kabid as $sek){
            }
        }
        else{
            $kabid = DataAsnModel::where('jabatan', 'LIKE', 'Kabid '.$bidang_name.'%')->get();
            //dd($kabid);
            foreach ($kabid as $kbd){
                //dd($kbd->nama);
            }
        }
        //dd($kabid);
        //die();

        /*for ($i=0; $i<=count($struktural); $i++){
            echo "$s <br>";
            $cek = in_array($struktural[$i], $nama);
            dd($struktural[$i]);
        }*/

        foreach ($spt->pivot as $s){
            $namas = $s->namad;
            //dd(empty($namas);
        }

        $m = $spt->tgl_berangkat;
        $mul = $spt->tgl_pulang;
        $to = \Carbon\Carbon::createFromFormat('Y-m-d', $mul);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d', $m);
        $diff_in_days = $to->diffInDays($from);
        //dd($diff_in_days);
        $diff_in_days = $diff_in_days + 1;
        //dd($diff_in_days);
        $kestr = $diff_in_days;

        switch ($kestr){
            case 1:
                $kestr = 'satu';
                break;
            case 2:
                $kestr = 'dua';
                break;
            case 3:
                $kestr = 'tiga';
                break;
            case 4:
                $kestr = 'empat';
                break;
            case 5:
                $kestr = 'lima';
                break;
        }
//dd($diff_in_days);

        if (count($spt->pivot) == 1){
            if ($diff_in_days == 1){
                $templateProcessor = new TemplateProcessor('storage/spt/sehari_draft_SPT-new(1).docx');
            }
            else{
                $templateProcessor = new TemplateProcessor('storage/spt/draft_SPT-new(1).docx');
            }


            $templateProcessor->setValue('nomor_spt', $spt->nomor_spt);
            /*$templateProcessor->cloneBlock('CLONEME', $clone);*/

            if (count($dest) == 1){
                $templateProcessor->setValue('kota_tujuan', $dest[0]);
            }
            elseif (count($dest) == 2){
                $templateProcessor->setValue('kota_tujuan', $dest[0].' dan '.$dest[1]);
            }
            elseif (count($dest) == 3){
                $templateProcessor->setValue('kota_tujuan', $dest[0].', '.$dest[1].' dan '.$dest[2]);
            }
            else {
                return redirect()->back()->with('warning', 'Tujuan Anda Terlalu Banyak, Nanti Capek Hlooo');
            }



                $templateProcessor->setValue('nama', $s->namad->nama);
                $templateProcessor->setValue('nip', $s->namad->nip);
                $templateProcessor->setValue('jabatan', $s->namad->jabatan);
            if ($spt->pivot[0]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat1', '-');
            }
            else{
                $templateProcessor->setValue('pangkat1', $spt->pivot[0]->namad->pangkat->pangkat);
            }
                $templateProcessor->setValue('gol1', $spt->pivot[0]->namad->gol);

                $templateProcessor->setValue('nama', $s->namad->nama);
                $templateProcessor->setValue('nip', $s->namad->nip);
                $templateProcessor->setValue('jabatan', $s->namad->jabatan);

            //dd($s->namad->pejabat);

            $templateProcessor->setValue('dalam_rangka', $spt->perihal);
            $templateProcessor->setValue('count_hari', $diff_in_days);
            $templateProcessor->setValue('string_count', $kestr);
            $templateProcessor->setValue('tanggal_berangkat', $b_mgk);
            $templateProcessor->setValue('tanggal_pulang', $b_mlh);
            $templateProcessor->setValue('nama_bidang', $user_name);

            $templateProcessor->setValue('tanggal_spt', $b_spt);
            $templateProcessor->setValue('now', $now);

            if (count($plh) == 0){

               if ($p == false){
                    $templateProcessor->setValue('jabatan_kepala', $kep->jabatan);
                    $templateProcessor->setValue('nama_kepala', $kep->nama);
                    $templateProcessor->setValue('pangkat_kepala', $pangkat_kepala);
                    $templateProcessor->setValue('nip_kepala', $kep->nip);
               }
                else{
                    $templateProcessor->setValue('jabatan_kepala','Plt. '. $jabatan. "\r\n" . $jabatan_plt);
                    $templateProcessor->setValue('nama_kepala', $nama_plt);
                    $templateProcessor->setValue('pangkat_kepala', $pangkat_plt);
                    $templateProcessor->setValue('nip_kepala', $nip_plt);
                }

            }
            elseif ($cek == false){
                $templateProcessor->setValue('jabatan_kepala', 'a.n. '. $jabatan . "\r\n" . $kabid->jabatan_kepala);
                $templateProcessor->setValue('nama_kepala', $kabid->nama_kepala);
                $templateProcessor->setValue('pangkat_kepala', $kabid->pangkat->pangkat);
                $templateProcessor->setValue('nip_kepala', $kabid->nip_kepala);
            }
            else{
                $templateProcessor->setValue('jabatan_kepala', 'Plh. '. $jabatan . "\r\n" . $gankep->jabatan_kepala);
                $templateProcessor->setValue('nama_kepala', $gankep->nama_kepala);
                $templateProcessor->setValue('pangkat_kepala', $gankep->pangkat->pangkat);
                $templateProcessor->setValue('nip_kepala', $gankep->nip_kepala);
            }

            /**/

            $export_file = public_path('Sijablay_SPT.docx');

            $templateProcessor->saveAs($export_file);
            return response()->download($export_file)->deleteFileAfterSend(true);
        }

        elseif (count($spt->pivot) == 2){
            if ($diff_in_days == 1){
                $templateProcessor = new TemplateProcessor('storage/spt/sehari_draft_SPT-new(2).docx');
            }
            else{

                $templateProcessor = new TemplateProcessor('storage/spt/draft_SPT-new(2).docx');
            }

            $templateProcessor->setValue('nomor_spt', $spt->nomor_spt);
            /*$templateProcessor->cloneBlock('CLONEME', $clone);*/

            $templateProcessor->setValue('nama', $spt->pivot[0]->namad->nama);
            $templateProcessor->setValue('nip', $spt->pivot[0]->namad->nip);
            $templateProcessor->setValue('jabatan', $spt->pivot[0]->namad->jabatan);
            if ($spt->pivot[0]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat1', '-');
            }
            else{
                $templateProcessor->setValue('pangkat1', $spt->pivot[0]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol1', $spt->pivot[0]->namad->gol);

            $templateProcessor->setValue('nama2', $spt->pivot[1]->namad->nama);
            $templateProcessor->setValue('nip2', $spt->pivot[1]->namad->nip);
            $templateProcessor->setValue('jabatan2', $spt->pivot[1]->namad->jabatan);
            if ($spt->pivot[1]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat2', '-');
            }
            else{
                $templateProcessor->setValue('pangkat2', $spt->pivot[1]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol2', $spt->pivot[1]->namad->gol);
            //dd($s->namad->pejabat);

            if (count($dest) == 1){
                $templateProcessor->setValue('kota_tujuan', $dest[0]);
            }
            elseif (count($dest) == 2){
                $templateProcessor->setValue('kota_tujuan', $dest[0].' dan '.$dest[1]);
            }
            elseif (count($dest) == 3){
                $templateProcessor->setValue('kota_tujuan', $dest[0].', '.$dest[1].' dan '.$dest[2]);
            }
            else {
                return redirect()->back()->with('warning', 'Tujuan Anda Terlalu Banyak, Nanti Capek Hlooo');
            }

            $templateProcessor->setValue('dalam_rangka', $spt->perihal);
            $templateProcessor->setValue('count_hari', $diff_in_days);
            $templateProcessor->setValue('string_count', $kestr);
            $templateProcessor->setValue('tanggal_berangkat', $b_mgk);
            $templateProcessor->setValue('tanggal_pulang', $b_mlh);

            $templateProcessor->setValue('tanggal_spt', $b_spt);
            $templateProcessor->setValue('nama_bidang', $user_name);
            $templateProcessor->setValue('now', $now);

            if (count($plh) == 0){
                if ($p == false){
                    $templateProcessor->setValue('jabatan_kepala', $kep->jabatan);
                    $templateProcessor->setValue('nama_kepala', $kep->nama);
                    $templateProcessor->setValue('pangkat_kepala', $pangkat_kepala);
                    $templateProcessor->setValue('nip_kepala', $kep->nip);
                }
                else{
                    $templateProcessor->setValue('jabatan_kepala','Plt. '. $jabatan. "\r\n" . $jabatan_plt);
                    $templateProcessor->setValue('nama_kepala', $nama_plt);
                    $templateProcessor->setValue('pangkat_kepala', $pangkat_plt);
                    $templateProcessor->setValue('nip_kepala', $nip_plt);
                }
            }
            else{
                $templateProcessor->setValue('jabatan_kepala', 'Plh. '. $jabatan . "\r\n" . $gankep->jabatan_kepala);
                $templateProcessor->setValue('nama_kepala', $gankep->nama_kepala);
                $templateProcessor->setValue('pangkat_kepala', $gankep->pangkat->pangkat);
                $templateProcessor->setValue('nip_kepala', $gankep->nip_kepala);
            }
            $export_file = public_path('SPT_Sijablay.docx');
            //dd($export_file);
            $templateProcessor->saveAs($export_file);
            return response()->download($export_file)->deleteFileAfterSend(true);
        }

        elseif (count($spt->pivot) == 3){
            if ($diff_in_days == 1){
                $templateProcessor = new TemplateProcessor('storage/spt/sehari_draft_SPT-new(3).docx');
            }
            else{

                $templateProcessor = new TemplateProcessor('storage/spt/draft_SPT-new(3).docx');
            }

            $templateProcessor->setValue('nomor_spt', $spt->nomor_spt);
            /*$templateProcessor->cloneBlock('CLONEME', $clone);*/

            $templateProcessor->setValue('nama', $spt->pivot[0]->namad->nama);
            $templateProcessor->setValue('nip', $spt->pivot[0]->namad->nip);
            $templateProcessor->setValue('jabatan', $spt->pivot[0]->namad->jabatan);
            if ($spt->pivot[0]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat1', '-');
            }
            else{
                $templateProcessor->setValue('pangkat1', $spt->pivot[0]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol1', $spt->pivot[0]->namad->gol);

            $templateProcessor->setValue('nama2', $spt->pivot[1]->namad->nama);
            $templateProcessor->setValue('nip2', $spt->pivot[1]->namad->nip);
            $templateProcessor->setValue('jabatan2', $spt->pivot[1]->namad->jabatan);
            if ($spt->pivot[1]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat2', '-');
            }
            else{
                $templateProcessor->setValue('pangkat2', $spt->pivot[1]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol2', $spt->pivot[1]->namad->gol);

            $templateProcessor->setValue('nama3', $spt->pivot[2]->namad->nama);
            $templateProcessor->setValue('nip3', $spt->pivot[2]->namad->nip);
            $templateProcessor->setValue('jabatan3', $spt->pivot[2]->namad->jabatan);
            if ($spt->pivot[2]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat3', '-');
            }
            else{
                $templateProcessor->setValue('pangkat3', $spt->pivot[2]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol3', $spt->pivot[2]->namad->gol);


            if (count($dest) == 1){
                $templateProcessor->setValue('kota_tujuan', $dest[0]);
            }
            elseif (count($dest) == 2){
                $templateProcessor->setValue('kota_tujuan', $dest[0].' dan '.$dest[1]);
            }
            elseif (count($dest) == 3){
                $templateProcessor->setValue('kota_tujuan', $dest[0].', '.$dest[1].' dan '.$dest[2]);
            }
            else {
                return redirect()->back()->with('warning', 'Tujuan Anda Terlalu Banyak, Nanti Capek Hlooo');
            }

            $templateProcessor->setValue('dalam_rangka', $spt->perihal);
            $templateProcessor->setValue('count_hari', $diff_in_days);
            $templateProcessor->setValue('string_count', $kestr);
            $templateProcessor->setValue('tanggal_berangkat', $b_mgk);
            $templateProcessor->setValue('tanggal_pulang', $b_mlh);
            $templateProcessor->setValue('nama_bidang', $user_name);

            $templateProcessor->setValue('tanggal_spt', $b_spt);
            $templateProcessor->setValue('now', $now);
            if (count($plh) == 0){
                if ($p == false){
                    $templateProcessor->setValue('jabatan_kepala', $kep->jabatan);
                    $templateProcessor->setValue('nama_kepala', $kep->nama);
                    $templateProcessor->setValue('pangkat_kepala', $pangkat_kepala);
                    $templateProcessor->setValue('nip_kepala', $kep->nip);
                }
                else{
                    $templateProcessor->setValue('jabatan_kepala','Plt. '. $jabatan. "\r\n" . $jabatan_plt);
                    $templateProcessor->setValue('nama_kepala', $nama_plt);
                    $templateProcessor->setValue('pangkat_kepala', $pangkat_plt);
                    $templateProcessor->setValue('nip_kepala', $nip_plt);
                }
            }
            else{
                $templateProcessor->setValue('jabatan_kepala', 'Plh. '. $jabatan . "\r\n" . $gankep->jabatan_kepala);
                $templateProcessor->setValue('nama_kepala', $gankep->nama_kepala);
                $templateProcessor->setValue('pangkat_kepala', $gankep->pangkat->pangkat);
                $templateProcessor->setValue('nip_kepala', $gankep->nip_kepala);
            }



            $export_file = public_path('SPT_Sijablay.docx');
            //dd($export_file);
            $templateProcessor->saveAs($export_file);
            return response()->download($export_file)->deleteFileAfterSend(true);
        }

        elseif (count($spt->pivot) == 4){
            if ($diff_in_days == 1){
                $templateProcessor = new TemplateProcessor('storage/spt/sehari_draft_SPT-new(4).docx');
            }
            else{

                $templateProcessor = new TemplateProcessor('storage/spt/draft_SPT-new(4).docx');
            }

            $templateProcessor->setValue('nomor_spt', $spt->nomor_spt);
            /*$templateProcessor->cloneBlock('CLONEME', $clone);*/

            $templateProcessor->setValue('nama', $spt->pivot[0]->namad->nama);
            $templateProcessor->setValue('nip', $spt->pivot[0]->namad->nip);
            $templateProcessor->setValue('jabatan', $spt->pivot[0]->namad->jabatan);
            if ($spt->pivot[0]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat1', '-');
            }
            else{
                $templateProcessor->setValue('pangkat1', $spt->pivot[0]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol1', $spt->pivot[0]->namad->gol);

            $templateProcessor->setValue('nama2', $spt->pivot[1]->namad->nama);
            $templateProcessor->setValue('nip2', $spt->pivot[1]->namad->nip);
            $templateProcessor->setValue('jabatan2', $spt->pivot[1]->namad->jabatan);
            if ($spt->pivot[1]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat2', '-');
            }
            else{
                $templateProcessor->setValue('pangkat2', $spt->pivot[1]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol2', $spt->pivot[1]->namad->gol);

            $templateProcessor->setValue('nama3', $spt->pivot[2]->namad->nama);
            $templateProcessor->setValue('nip3', $spt->pivot[2]->namad->nip);
            $templateProcessor->setValue('jabatan3', $spt->pivot[2]->namad->jabatan);
            if ($spt->pivot[2]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat3', '-');
            }
            else{
                $templateProcessor->setValue('pangkat3', $spt->pivot[2]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol3', $spt->pivot[2]->namad->gol);

            $templateProcessor->setValue('nama4', $spt->pivot[3]->namad->nama);
            $templateProcessor->setValue('nip4', $spt->pivot[3]->namad->nip);
            $templateProcessor->setValue('jabatan4', $spt->pivot[3]->namad->jabatan);
            if ($spt->pivot[3]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat4', '-');
            }
            else{
                $templateProcessor->setValue('pangkat4', $spt->pivot[3]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol4', $spt->pivot[3]->namad->gol);

            if (count($dest) == 1){
                $templateProcessor->setValue('kota_tujuan', $dest[0]);
            }
            elseif (count($dest) == 2){
                $templateProcessor->setValue('kota_tujuan', $dest[0].' dan '.$dest[1]);
            }
            elseif (count($dest) == 3){
                $templateProcessor->setValue('kota_tujuan', $dest[0].', '.$dest[1].' dan '.$dest[2]);
            }
            else {
                return redirect()->back()->with('warning', 'Tujuan Anda Terlalu Banyak, Nanti Capek Hlooo');
            }

            $templateProcessor->setValue('dalam_rangka', $spt->perihal);
            $templateProcessor->setValue('count_hari', $diff_in_days);
            $templateProcessor->setValue('string_count', $kestr);
            $templateProcessor->setValue('tanggal_berangkat', $b_mgk);
            $templateProcessor->setValue('tanggal_pulang', $b_mlh);

            $templateProcessor->setValue('nama_bidang', $user_name);

            $templateProcessor->setValue('tanggal_spt', $b_spt);
            $templateProcessor->setValue('now', $now);
            if (count($plh) == 0){
                if ($p == false){
                    $templateProcessor->setValue('jabatan_kepala', $kep->jabatan);
                    $templateProcessor->setValue('nama_kepala', $kep->nama);
                    $templateProcessor->setValue('pangkat_kepala', $pangkat_kepala);
                    $templateProcessor->setValue('nip_kepala', $kep->nip);
                }
                else{
                    $templateProcessor->setValue('jabatan_kepala','Plt. '. $jabatan. "\r\n" . $jabatan_plt);
                    $templateProcessor->setValue('nama_kepala', $nama_plt);
                    $templateProcessor->setValue('pangkat_kepala', $pangkat_plt);
                    $templateProcessor->setValue('nip_kepala', $nip_plt);
                }
            }
            else{
                $templateProcessor->setValue('jabatan_kepala', 'Plh. '. $jabatan . "\r\n" . $gankep->jabatan_kepala);
                $templateProcessor->setValue('nama_kepala', $gankep->nama_kepala);
                $templateProcessor->setValue('pangkat_kepala', $gankep->pangkat->pangkat);
                $templateProcessor->setValue('nip_kepala', $gankep->nip_kepala);
            }

            $export_file = public_path('SPT_Sijablay.docx');
            //dd($export_file);
            $templateProcessor->saveAs($export_file);
            return response()->download($export_file)->deleteFileAfterSend(true);
        }

        else {
            return redirect()->back()->with('warning', 'Tidak boleh lebih dari 4 orang');
        }

    }
    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws \PhpOffice\PhpWord\Exception\CopyFileException
     * @throws \PhpOffice\PhpWord\Exception\CreateTemporaryFileException
     */
    public function cetakSppd($id){
        $tahun = date('Y');
        $spt = SptModel::find($id);
        $asn = DataAsnModel::all();
        $rek = RekModel::all();
        $bidang_id = Auth::user()->id;
        $bidang = Auth::user()->name;
        $no_sppd = NumberModel::latest()->first();
        $sppd = $no_sppd->no_sppd;
        //dd($sppd);
        foreach ($spt->tujuan as $dest){

        }
        //dd($sppd-"2");
        $b_spt = Carbon::parse($spt->tgl_spt)->formatLocalized('%d %B %Y');
        $b_mgk = Carbon::parse($spt->tgl_berangkat)->formatLocalized('%d %B %Y');
        $b_mlh = Carbon::parse($spt->tgl_pulang)->formatLocalized('%d %B %Y');

        //dd($no_sppd->no_sppd);

        /*KUDU DIGAWEKKE SETTING*/
        /*if ($bidang == 'Pengelolaan Data dan Informasi'){
            $bidang = 'Perencanaan dan Pengembangan';
        }*/

        //dd($bidang);

        /*dd(count($spt->pivot));*/
        //dd($spt->reks->no_rek);


        //dd($kpa);
        if ($bidang == 'Sekretariat'){
            $kpa = DataAsnModel::where('jabatan', 'LIKE', 'Kepala Dinas%')->get();
            foreach ($kpa as $sek){
            }
        }
        else{
            $kpa = DataAsnModel::where('jabatan', 'LIKE', 'Kabid '.$bidang.'%')->get();
            foreach ($kpa as $kbd){
                //dd($kbd->nama);
            }
        }



        //dd($kbd->nama);

        foreach ($spt->pivot as $s){
            $namas = $s->namad;
            //dd($namas);
            //dd($namas->gol == '-');

        }
        //dd($spt->pivot[0]->namad->pangkat->pangkat);

        $m = $spt->tgl_berangkat;
        $mul = $spt->tgl_pulang;
        $to = \Carbon\Carbon::createFromFormat('Y-m-d', $mul);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d', $m);
        $diff_in_days = $to->diffInDays($from);
       // dd($diff_in_days);
        $diff_in_days = $diff_in_days + 1;


        $kestr = $diff_in_days;
        switch ($kestr){
            case 1:
                $kestr = 'satu';
                break;
            case 2:
                $kestr = 'dua';
                break;
            case 3:
                $kestr = 'tiga';
                break;
            case 4:
                $kestr = 'empat';
                break;
            case 5:
                $kestr = 'lima';
                break;
        }

        //dd($kestr);
        //dd($kpa->nama);
        if (count($spt->pivot) == 1){
            $templateProcessor = new TemplateProcessor('storage/spt/draft_SPPD_1.docx');

            //dd($clone);
            if ($bidang == 'Sekretariat'){
                $templateProcessor->setValue('kabid', $sek->nama);
                $templateProcessor->setValue('nip_kabid', $sek->nip);
            }
            else{
                $templateProcessor->setValue('kabid', $kbd->nama);
                $templateProcessor->setValue('nip_kabid', $kbd->nip);
            }


            $templateProcessor->setValue('bidang', $bidang_id);
            $templateProcessor->setValue('tahun', $tahun);
            $templateProcessor->setValue('nomor_sppd', $no_sppd->no_sppd);
            /*$templateProcessor->cloneBlock('CLONEME', $clone);*/

            $templateProcessor->setValue('kabid', $kpa);
            $templateProcessor->setValue('nama_plk', $namas->nama);
            $templateProcessor->setValue('nip_plk', $namas->nip);
            if ($namas->gol == '-'){

                $templateProcessor->setValue('pangkat_plk', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk', $namas->pangkat->pangkat);
            }

            $templateProcessor->setValue('gol', $namas->gol);
            $templateProcessor->setValue('jabatan_plk', $s->namad->jabatan);

            //dd($s->namad->pejabat);

            if (count($dest) == 1){
                $templateProcessor->setValue('kota_tujuan', $dest[0]);
            }
            elseif (count($dest) == 2){
                $templateProcessor->setValue('kota_tujuan', $dest[0].' dan '.$dest[1]);
            }
            elseif (count($dest) == 3){
                $templateProcessor->setValue('kota_tujuan', $dest[0].', '.$dest[1].' dan '.$dest[2]);
            }
            else {
                return redirect()->back()->with('warning', 'Tujuan Anda Terlalu Banyak, Nanti Capek Hlooo');
            }
            $templateProcessor->setValue('kendaraan', $spt->kendaraan);
            $templateProcessor->setValue('dalam_rangka', $spt->perihal);
            $templateProcessor->setValue('count_hari', $diff_in_days);
            $templateProcessor->setValue('string_count', $kestr);
            $templateProcessor->setValue('tgl_berangkat', $b_mgk);
            $templateProcessor->setValue('tgl_pulang', $b_mlh);

            $templateProcessor->setValue('tgl_spt', $b_spt);
            $templateProcessor->setValue('no_rek', $spt->reks->no_rek);

            //dd($templateProcessor);
            $export_file = public_path('SPPD_DPMPTSP.docx');

            $templateProcessor->saveAs($export_file);
            return response()->download($export_file)->deleteFileAfterSend(true);
        }

        elseif (count($spt->pivot) == 2){
            $templateProcessor = new TemplateProcessor('storage/spt/draft_SPPD_2.docx');

            //dd($clone);
            if ($bidang == 'Sekretariat'){
                $templateProcessor->setValue('kabid', $sek->nama);
                $templateProcessor->setValue('nip_kabid', $sek->nip);
            }
            else{
                $templateProcessor->setValue('kabid', $kbd->nama);
                $templateProcessor->setValue('nip_kabid', $kbd->nip);
            }


            $templateProcessor->setValue('bidang', $bidang_id);
            $templateProcessor->setValue('tahun', $tahun);
            $templateProcessor->setValue('nomor_sppd', $sppd);
            $templateProcessor->setValue('nomor_sppd2', $sppd-1);
            /*$templateProcessor->cloneBlock('CLONEME', $clone);*/


            $templateProcessor->setValue('kabid', $kpa);
            $templateProcessor->setValue('nama_plk', $spt->pivot[0]->namad->nama);
            $templateProcessor->setValue('nip_plk', $spt->pivot[0]->namad->nip);
            if ($spt->pivot[0]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk', $spt->pivot[0]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol', $spt->pivot[0]->namad->gol);
            $templateProcessor->setValue('jabatan_plk', $spt->pivot[0]->namad->jabatan);

            $templateProcessor->setValue('nama_plk2', $spt->pivot[1]->namad->nama);
            $templateProcessor->setValue('nip_plk2', $spt->pivot[1]->namad->nip);
            if ($spt->pivot[1]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk2', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk2', $spt->pivot[1]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol2', $spt->pivot[1]->namad->gol);
            $templateProcessor->setValue('jabatan_plk2', $spt->pivot[1]->namad->jabatan);



            //dd($s->namad->pejabat);
            if (count($dest) == 1){
                $templateProcessor->setValue('kota_tujuan', $dest[0]);
            }
            elseif (count($dest) == 2){
                $templateProcessor->setValue('kota_tujuan', $dest[0].' dan '.$dest[1]);
            }
            elseif (count($dest) == 3){
                $templateProcessor->setValue('kota_tujuan', $dest[0].', '.$dest[1].' dan '.$dest[2]);
            }
            else {
                return redirect()->back()->with('warning', 'Tujuan Anda Terlalu Banyak, Nanti Capek Hlooo');
            }
            $templateProcessor->setValue('kendaraan', $spt->kendaraan);
            $templateProcessor->setValue('dalam_rangka', $spt->perihal);
            $templateProcessor->setValue('count_hari', $diff_in_days);
            $templateProcessor->setValue('string_count', $kestr);
            $templateProcessor->setValue('tgl_berangkat', $b_mgk);
            $templateProcessor->setValue('tgl_pulang', $b_mlh);

            $templateProcessor->setValue('tgl_spt', $b_spt);
            $templateProcessor->setValue('no_rek', $spt->reks->no_rek);

            //dd($templateProcessor->setValue('nomor_sppd', $sppd-1));
            $export_file = public_path('SPPD_DPMPTSP.docx');

            $templateProcessor->saveAs($export_file);
            return response()->download($export_file)->deleteFileAfterSend(true);
        }

        elseif (count($spt->pivot) == 3){
            $templateProcessor = new TemplateProcessor('storage/spt/draft_SPPD_3.docx');

            //dd($clone);
            if ($bidang == 'Sekretariat'){
                $templateProcessor->setValue('kabid', $sek->nama);
                $templateProcessor->setValue('nip_kabid', $sek->nip);
            }
            else{
                $templateProcessor->setValue('kabid', $kbd->nama);
                $templateProcessor->setValue('nip_kabid', $kbd->nip);
            }


            $templateProcessor->setValue('bidang', $bidang_id);
            $templateProcessor->setValue('tahun', $tahun);
            $templateProcessor->setValue('nomor_sppd', $no_sppd->no_sppd - 2);
            $templateProcessor->setValue('nomor_sppd2', $no_sppd->no_sppd - 1);
            $templateProcessor->setValue('nomor_sppd3', $no_sppd->no_sppd);
            /*$templateProcessor->cloneBlock('CLONEME', $clone);*/


                $templateProcessor->setValue('kabid', $kpa);
                $templateProcessor->setValue('nama_plk', $spt->pivot[0]->namad->nama);
                $templateProcessor->setValue('nip_plk', $spt->pivot[0]->namad->nip);
            if ($spt->pivot[0]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk', '-');
            }
                else{
                    $templateProcessor->setValue('pangkat_plk', $spt->pivot[0]->namad->pangkat->pangkat);
                }
                $templateProcessor->setValue('gol', $spt->pivot[0]->namad->gol);
                $templateProcessor->setValue('jabatan_plk', $spt->pivot[0]->namad->jabatan);

                $templateProcessor->setValue('nama_plk2', $spt->pivot[1]->namad->nama);
                $templateProcessor->setValue('nip_plk2', $spt->pivot[1]->namad->nip);
            if ($spt->pivot[1]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk2', '-');
            }
                else{
                    $templateProcessor->setValue('pangkat_plk2', $spt->pivot[1]->namad->pangkat->pangkat);
                }
                $templateProcessor->setValue('gol2', $spt->pivot[1]->namad->gol);
                $templateProcessor->setValue('jabatan_plk2', $spt->pivot[1]->namad->jabatan);

                $templateProcessor->setValue('nama_plk3', $spt->pivot[2]->namad->nama);
                $templateProcessor->setValue('nip_plk3', $spt->pivot[2]->namad->nip);
            if ($spt->pivot[2]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk3', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk3', $spt->pivot[2]->namad->pangkat->pangkat);
            }
                $templateProcessor->setValue('gol3', $spt->pivot[2]->namad->gol);
                $templateProcessor->setValue('jabatan_plk3', $spt->pivot[2]->namad->jabatan);


            //dd($s->namad->pejabat);
            if (count($dest) == 1){
                $templateProcessor->setValue('kota_tujuan', $dest[0]);
            }
            elseif (count($dest) == 2){
                $templateProcessor->setValue('kota_tujuan', $dest[0].' dan '.$dest[1]);
            }
            elseif (count($dest) == 3){
                $templateProcessor->setValue('kota_tujuan', $dest[0].', '.$dest[1].' dan '.$dest[2]);
            }
            else {
                return redirect()->back()->with('warning', 'Tujuan Anda Terlalu Banyak, Nanti Capek Hlooo');
            }
            $templateProcessor->setValue('kendaraan', $spt->kendaraan);
            $templateProcessor->setValue('dalam_rangka', $spt->perihal);
            $templateProcessor->setValue('count_hari', $diff_in_days);
            $templateProcessor->setValue('string_count', $kestr);
            $templateProcessor->setValue('tgl_berangkat', $b_mgk);
            $templateProcessor->setValue('tgl_pulang', $b_mlh);

            $templateProcessor->setValue('tgl_spt', $b_spt);
            $templateProcessor->setValue('no_rek', $spt->reks->no_rek);


            $export_file = public_path('SPPD_DPMPTSP.docx');

            $templateProcessor->saveAs($export_file);
            return response()->download($export_file)->deleteFileAfterSend(true);
        }

        elseif (count($spt->pivot) == 4){
            $templateProcessor = new TemplateProcessor('storage/spt/draft_SPPD_4.docx');

            //dd($clone);
            if ($bidang == 'Sekretariat'){
                $templateProcessor->setValue('kabid', $sek->nama);
                $templateProcessor->setValue('nip_kabid', $sek->nip);
            }
            else{
                $templateProcessor->setValue('kabid', $kbd->nama);
                $templateProcessor->setValue('nip_kabid', $kbd->nip);
            }


            $templateProcessor->setValue('bidang', $bidang_id);
            $templateProcessor->setValue('tahun', $tahun);
            $templateProcessor->setValue('nomor_sppd', $no_sppd->no_sppd - 3);
            $templateProcessor->setValue('nomor_sppd2', $no_sppd->no_sppd - 2);
            $templateProcessor->setValue('nomor_sppd3', $no_sppd->no_sppd - 1);
            $templateProcessor->setValue('nomor_sppd4', $no_sppd->no_sppd);
            /*$templateProcessor->cloneBlock('CLONEME', $clone);*/


            $templateProcessor->setValue('kabid', $kpa);
            $templateProcessor->setValue('nama_plk', $spt->pivot[0]->namad->nama);
            $templateProcessor->setValue('nip_plk', $spt->pivot[0]->namad->nip);
            if ($spt->pivot[0]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk', $spt->pivot[0]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol', $spt->pivot[0]->namad->gol);
            $templateProcessor->setValue('jabatan_plk', $spt->pivot[0]->namad->jabatan);

            $templateProcessor->setValue('nama_plk2', $spt->pivot[1]->namad->nama);
            $templateProcessor->setValue('nip_plk2', $spt->pivot[1]->namad->nip);
            if ($spt->pivot[1]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk2', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk2', $spt->pivot[1]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol2', $spt->pivot[1]->namad->gol);
            $templateProcessor->setValue('jabatan_plk2', $spt->pivot[1]->namad->jabatan);

            $templateProcessor->setValue('nama_plk3', $spt->pivot[2]->namad->nama);
            $templateProcessor->setValue('nip_plk3', $spt->pivot[2]->namad->nip);
            if ($spt->pivot[2]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk3', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk3', $spt->pivot[2]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol3', $spt->pivot[2]->namad->gol);
            $templateProcessor->setValue('jabatan_plk3', $spt->pivot[2]->namad->jabatan);

            $templateProcessor->setValue('nama_plk4', $spt->pivot[3]->namad->nama);
            $templateProcessor->setValue('nip_plk4', $spt->pivot[3]->namad->nip);
            if ($spt->pivot[3]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk4', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk4', $spt->pivot[3]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol4', $spt->pivot[3]->namad->gol);
            $templateProcessor->setValue('jabatan_plk4', $spt->pivot[3]->namad->jabatan);

            //dd($s->namad->pejabat);
            if (count($dest) == 1){
                $templateProcessor->setValue('kota_tujuan', $dest[0]);
            }
            elseif (count($dest) == 2){
                $templateProcessor->setValue('kota_tujuan', $dest[0].' dan '.$dest[1]);
            }
            elseif (count($dest) == 3){
                $templateProcessor->setValue('kota_tujuan', $dest[0].', '.$dest[1].' dan '.$dest[2]);
            }
            else {
                return redirect()->back()->with('warning', 'Tujuan Anda Terlalu Banyak, Nanti Capek Hlooo');
            }
            $templateProcessor->setValue('kendaraan', $spt->kendaraan);
            $templateProcessor->setValue('dalam_rangka', $spt->perihal);
            $templateProcessor->setValue('count_hari', $diff_in_days);
            $templateProcessor->setValue('string_count', $kestr);
            $templateProcessor->setValue('tgl_berangkat', $b_mgk);
            $templateProcessor->setValue('tgl_pulang', $b_mlh);

            $templateProcessor->setValue('tgl_spt', $b_spt);
            $templateProcessor->setValue('no_rek', $spt->reks->no_rek);


            $export_file = public_path('SPPD_DPMPTSP.docx');

            $templateProcessor->saveAs($export_file);
            return response()->download($export_file)->deleteFileAfterSend(true);
        }

        else {
            return redirect()->back()->with('warning', 'Tidak boleh lebih dari 4 orang');
        }

    }

    public function cetakNodin($id){
        $tahun = date('Y');
        $spt = SptModel::find($id);
        $bidang = Auth::user()->name;
        $b_spt = Carbon::parse($spt->tgl_spt)->formatLocalized('%B %Y');
        //dd($b_spt);
        $b_mgk = Carbon::parse($spt->tgl_spt)->formatLocalized('%d %B %Y');
        $b_berangkat = Carbon::parse($spt->tgl_berangkat)->formatLocalized('%d %B %Y');
        //dd($spt);

        $plh = SettingModels::all();
        foreach ($plh as $gankep){
            //dd($gankep->jabatan_kepala);
        }
        //dd(count($plh));
        foreach ($spt->pivot as $s){
            $namas = $s->namad;
            //dd($namas);
        }
        if ($bidang == 'Sekretariat'){
            $kpa = DataAsnModel::where('jabatan', '=', 'Sekretaris')->get();
            foreach ($kpa as $sek){
                //dd($sek->pangkat->pangkat);
            }
        }
        else{
            $kpa = DataAsnModel::where('jabatan', 'LIKE', 'Kabid '.$bidang.'%')->get();
            foreach ($kpa as $kbd){
                //dd($kbd->nama);
            }
        }

        if (!empty($gankep)){
            $jabatan = 'Plt KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU';
        }



        //dd($jabatan);
        $m = $spt->tgl_berangkat;
        $mul = $spt->tgl_pulang;
        $to = \Carbon\Carbon::createFromFormat('Y-m-d', $mul);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d', $m);
        $diff_in_days = $to->diffInDays($from);

        if ($diff_in_days == 0){
            $diff_in_days = $diff_in_days + 1;
        }

        $kestr = $diff_in_days;

        switch ($kestr){
            case 1:
                $kestr = 'satu';
                break;
            case 2:
                $kestr = 'dua';
                break;
            case 3:
                $kestr = 'tiga';
                break;
            case 4:
                $kestr = 'empat';
                break;
            case 5:
                $kestr = 'lima';
                break;
        }

        $templateProcessor = new TemplateProcessor('storage/spt/draft_NotaDinas.docx');
        $templateProcessor->setValue('nama_bidang', $bidang);
        $templateProcessor->setValue('tgl_spt', $b_mgk);
        $templateProcessor->setValue('bulan_tahun', $b_spt);
        $templateProcessor->setValue('program_kerja', $spt->tujuan);
        $templateProcessor->setValue('kota_tujuan', $spt->tujuan);
        $templateProcessor->setValue('hari', $diff_in_days);
        $templateProcessor->setValue('count_hari', $kestr);
        $templateProcessor->setValue('tgl_berangkat', $b_berangkat);
        $templateProcessor->setValue('perihal', $spt->perihal);


        if ($bidang == 'Sekretariat'){
            $templateProcessor->setValue('nama_kabid', $sek->nama);
            $templateProcessor->setValue('pangkat_kabid', $sek->pangkat->pangkat);
            $templateProcessor->setValue('nip_kabid', $sek->nip);
        }
        else{
            $templateProcessor->setValue('nama_kabid', $kbd->nama);
            $templateProcessor->setValue('pangkat_kabid', $kbd->pangkat->pangkat);
            $templateProcessor->setValue('nip_kabid', $kbd->nip);
        }

        $export_file = public_path('NODIN_DPMPTSP.docx');

        $templateProcessor->saveAs($export_file);
        return response()->download($export_file)->deleteFileAfterSend(true);
    }

    /**
     * @param $id
     */
    public function hapusSpt($id){
        $delete = SptModel::find($id);
        $delete->delete();
        //dd($delete);

        return redirect()->back()->with('success', 'SPT berhasil dihapus');
    }

    public function destroy($id){
        $delete = SptModel::withTrashed()->where('id',$id)->first();

        $delete->forceDelete();
        //dd($delete);
        return redirect()->back()->with('success', 'SPT berhasil dihapus');
    }
}
