<?php

namespace App\Http\Controllers\SPT;

use App\Models\PD\NumberModel;
use App\Models\PD\SptModel;
use App\Models\PD\AdvanceSpt;
use App\Models\Sekretariat\DataAsnModel;
use App\Models\Sekretariat\PenggunaanNomorModel;
use App\Models\Sekretariat\RekModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;
use function Sodium\increment;

class AdvanceSPTController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function formSPT(){
        $today = date('Y-m-d');
        $nama = DB::table('data_asn_models')->get();
        $rek = RekModel::all(['jns_rek', 'id']);
        $id = Auth::user()->id;
        $spt = SptModel::where('user_id', $id)->latest()->first();

        $try = AdvanceSpt::where('user_id', $id)->latest()->first();


        //$array = json_decode($try->pelaksana, true);






        //dd($spt->pivot);

        return view('spt.base.advance-spt', compact('today', 'nama', 'rek', 'spt' ));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postSpt(Request $request){
        $this->validate($request, [
            /*'perihal' => 'required',
            'tgl_spt' => 'required',
            'tgl_berangkat' => 'required',
            'tgl_pulang' => 'required',
            'tujuan' => 'required',
            'pelaksana' => 'required|max:4',*/
        ]);
        $id = Auth::user()->id;
        $spt = SptModel::where('user_id', $id)->latest()->first();

        $total_nomor = PenggunaanNomorModel::latest()->first();
        $nomor_terakhir = new PenggunaanNomorModel();
        $nomor_terakhir->user_id = $id;
        $nomor_terakhir->kategori_nomor_id = 2;
        $nomor_terakhir->arsip_id = 12524;
        $nomor_terakhir->perihal = 'Permohonan Surat Perintah Tugas dalam tangka' .' '.$request->perihal;
        $nomor_terakhir->tanggal = Carbon::now();
        $nomor_terakhir->count = ($total_nomor->count) + 1;
        $nomor_terakhir->used = 1;
        $nomor_terakhir->save();


        $adv = new AdvanceSpt();
        $pelaksanas = $adv->pelaksana;
        //$pelaksanas['data'] = $request->all();
        $pelaksanas['data'] = $request->all();
        $adv->pelaksana = json_encode($pelaksanas);
        $adv->nomor_spt  = $nomor_terakhir->count;
        $adv->perihal = $spt->perihal;
        $adv->tgl_spt = $spt->tgl_spt;
        $adv->user_id = $spt->user_id;
        $adv->spt_id = $spt->id;

        //dd($adv);

        $adv->save();



        return redirect()->route('adv.sppd')->with('success', 'YEEEEAAAAY !!!!!');

    }


    public function getSPPD(){
        $id = Auth::user()->id;
        $spt = SptModel::where('user_id', $id)->latest()->first();

        $try = AdvanceSpt::where('user_id', $id)->latest()->first();

        //dd($spt);
        $array = json_decode($try->pelaksana, true);

        foreach ($spt->pivot as $n){
            //dd($kend_nama);
            foreach ($array as $rr){
                foreach ($rr as $kend_nama => $value){
                    $kend_nama = 'nama_'.str_replace(' ', '_', $n->namad->nama);

                    $x = array_key_exists($kend_nama, $rr);
                    //dd($request);
                }


            }
        }
        foreach ($spt->tujuan as $t){

        }

        foreach ($spt->tujuan as $t){
            //dd(count($t));
        }

        return view('spt.base.advance-sppd', compact('id','spt', 'try', 'array'));
    }


    public function cetakAdvSppd($id){
        $tahun = date('Y');
        $spt = SptModel::find($id);
        $asn = DataAsnModel::all();
        $rek = RekModel::all();
        $bidang_id = Auth::user()->id;
        $bidang = Auth::user()->name;
        $no_sppd = NumberModel::latest()->first();
        $sppd = $no_sppd->no_sppd;
        $sppd_back = AdvanceSpt::where('spt_id', $id)->get();



        foreach ($sppd_back as $r){
            $json = json_decode($r->pelaksana);
            foreach ($json as $son){
                $mburi = $son;
            }
        }
        //dd($son);

        foreach ($spt->tujuan as $dest){

        }
        //dd($dest[0]);


        $b_spt = Carbon::parse($spt->tgl_spt)->formatLocalized('%d %B %Y');
        $b_mgk = Carbon::parse($spt->tgl_berangkat)->formatLocalized('%d %B %Y');
        $b_mlh = Carbon::parse($spt->tgl_pulang)->formatLocalized('%d %B %Y');

        /*KUDU DIGAWEKKE SETTING*/
        if ($bidang == 'Pengelolaan Data dan Informasi'){
            $bidang = 'Perencanaan dan Pengembangan';
        }

        if ($bidang == 'Sekretariat'){
            $kpa = DataAsnModel::where('jabatan', '=', 'Sekretaris')->get();
            foreach ($kpa as $sek){
                //dd($sek);
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
            //dd($namas->gol == '-');

        }
        //dd($spt->pivot[0]->namad->pangkat->pangkat);

        $m = $spt->tgl_berangkat;
        $mul = $spt->tgl_pulang;
        $to = \Carbon\Carbon::createFromFormat('Y-m-d', $mul);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d', $m);
        $diff_in_days = $to->diffInDays($from);
        //dd($diff_in_days);

      // if ($diff_in_days == 0){
            $diff_in_days = $diff_in_days + 1;
 //   }
        $kestr = $diff_in_days;
        //dd($kestr);

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


        //==================================================================//
        if(count($spt->pivot) == 1){
            $templateProcessor = new TemplateProcessor('storage/spt/SPPD_1.docx');
            //==================================================
            $templateProcessor->setValue('nama_plk', $spt->pivot[0]->namad->nama);
            $templateProcessor->setValue('nip_plk', $spt->pivot[0]->namad->nip);
            if ($spt->pivot[0]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk', $spt->pivot[0]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol', $spt->pivot[0]->namad->nip);
            $templateProcessor->setValue('jabatan_plk', $spt->pivot[0]->namad->nip);

            //==================================================

            $templateProcessor->setValue('kendaraan_1', $son->kendaraan_1);
            $templateProcessor->setValue('tgl_tb_1_1', Carbon::parse($son->tgl_tb_1_1)->formatLocalized('%d %B %Y'));
            //-------------------------------------------------------------//
            $templateProcessor->setValue('awal_1', $son->awal_1);
            $templateProcessor->setValue('tujuan_tb_1_1', $son->tujuan_tb_1_1);
            $templateProcessor->setValue('tgl_berangkat_1', Carbon::parse($son->tgl_berangkat_1)->formatLocalized('%d %B %Y'));

            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('tgl_tb_1_1', Carbon::parse($son->tgl_tb_1_1)->formatLocalized('%d %B %Y'));

            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//

            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('kota__brkt_1_1', $son->kota__brkt_1_1);
            $templateProcessor->setValue('tujuan_tb_1_2', $son->tujuan_tb_1_2);
            $templateProcessor->setValue('tgl_brkt_1_1', Carbon::parse($son->tgl_brkt_1_1)->formatLocalized('%d %B %Y'));
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('kota__brkt_1_2', $son->kota__brkt_1_2);
            $templateProcessor->setValue('tujuan_tb_1_3', $son->tujuan_tb_1_3);
            $templateProcessor->setValue('tgl_brkt_1_2', Carbon::parse($son->tgl_brkt_1_2)->formatLocalized('%d %B %Y'));
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('kota__brkt_1_3', $son->kota__brkt_1_3);
            $templateProcessor->setValue('pulang', 'Semarang');
            $templateProcessor->setValue('tgl_brkt_1_3', Carbon::parse($son->tgl_brkt_1_3)->formatLocalized('%d %B %Y'));

        }
        elseif (count($spt->pivot) == 2){
            $templateProcessor = new TemplateProcessor('storage/spt/SPPD_2.docx');
            //==================================================
            $templateProcessor->setValue('nama_plk', $spt->pivot[0]->namad->nama);
            $templateProcessor->setValue('nip_plk', $spt->pivot[0]->namad->nip);
            if ($spt->pivot[0]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk', $spt->pivot[0]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol', $spt->pivot[0]->namad->nip);
            $templateProcessor->setValue('jabatan_plk', $spt->pivot[0]->namad->nip);

            //==================================================
            $templateProcessor->setValue('nama_plk2', $spt->pivot[1]->namad->nama);
            $templateProcessor->setValue('nip_plk2', $spt->pivot[1]->namad->nip);
            if ($spt->pivot[1]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk2', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk2', $spt->pivot[1]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol2', $spt->pivot[1]->namad->nip);
            $templateProcessor->setValue('jabatan_plk2', $spt->pivot[1]->namad->nip);

            //==================================================

            $templateProcessor->setValue('kendaraan_1', $son->kendaraan_1);
            $templateProcessor->setValue('kendaraan_2', $son->kendaraan_2);
            //-------------------------------------------------------------//
            $templateProcessor->setValue('awal_1', $son->awal_1);
            $templateProcessor->setValue('tujuan_tb_1_1', $son->tujuan_tb_1_1);
            $templateProcessor->setValue('tgl_berangkat_1', Carbon::parse($son->tgl_berangkat_1)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('awal_2', $son->awal_2);
            $templateProcessor->setValue('tujuan_tb_2_1', $son->tujuan_tb_2_1);
            $templateProcessor->setValue('tgl_berangkat_2', Carbon::parse($son->tgl_berangkat_1)->formatLocalized('%d %B %Y'));

            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('tgl_tb_1_1', Carbon::parse($son->tgl_tb_1_1)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_1_2', Carbon::parse($son->tgl_tb_1_2)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_2_1', Carbon::parse($son->tgl_tb_2_1)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_2_2', Carbon::parse($son->tgl_tb_2_2)->formatLocalized('%d %B %Y'));

            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('kota__brkt_1_1', $son->kota__brkt_1_1);
            $templateProcessor->setValue('tujuan_tb_1_2', $son->tujuan_tb_1_2);
            $templateProcessor->setValue('tgl_brkt_1_1', Carbon::parse($son->tgl_brkt_1_1)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_2_1', $son->kota__brkt_2_1);
            $templateProcessor->setValue('tujuan_tb_2_2', $son->tujuan_tb_2_2);
            $templateProcessor->setValue('tgl_brkt_2_1', Carbon::parse($son->tgl_brkt_2_1)->formatLocalized('%d %B %Y'));

            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('kota__brkt_1_2', $son->kota__brkt_1_2);
            $templateProcessor->setValue('tujuan_tb_1_3', $son->tujuan_tb_1_3);
            $templateProcessor->setValue('tgl_brkt_1_2', Carbon::parse($son->tgl_brkt_1_2)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_2_2', $son->kota__brkt_2_2);
            $templateProcessor->setValue('tujuan_tb_2_3', $son->tujuan_tb_2_3);
            $templateProcessor->setValue('tgl_brkt_2_2', Carbon::parse($son->tgl_brkt_2_2)->formatLocalized('%d %B %Y'));

            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('kota__brkt_1_3', $son->kota__brkt_1_3);
            $templateProcessor->setValue('pulang', 'Semarang');
            $templateProcessor->setValue('tgl_brkt_1_3', Carbon::parse($son->tgl_brkt_1_3)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_2_3', $son->kota__brkt_2_3);
            $templateProcessor->setValue('pulang', 'Semarang');
            $templateProcessor->setValue('tgl_brkt_2_3', Carbon::parse($son->tgl_brkt_2_3)->formatLocalized('%d %B %Y'));


        }
        elseif (count($spt->pivot) == 3){
            $templateProcessor = new TemplateProcessor('storage/spt/SPPD_3.docx');
            //==================================================
            $templateProcessor->setValue('nama_plk', $spt->pivot[0]->namad->nama);
            $templateProcessor->setValue('nip_plk', $spt->pivot[0]->namad->nip);
            if ($spt->pivot[0]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk', $spt->pivot[0]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol', $spt->pivot[0]->namad->nip);
            $templateProcessor->setValue('jabatan_plk', $spt->pivot[0]->namad->nip);

            //==================================================
            $templateProcessor->setValue('nama_plk2', $spt->pivot[1]->namad->nama);
            $templateProcessor->setValue('nip_plk2', $spt->pivot[1]->namad->nip);
            if ($spt->pivot[1]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk2', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk2', $spt->pivot[1]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol2', $spt->pivot[1]->namad->nip);
            $templateProcessor->setValue('jabatan_plk2', $spt->pivot[1]->namad->nip);

            //==================================================
            $templateProcessor->setValue('nama_plk3', $spt->pivot[2]->namad->nama);
            $templateProcessor->setValue('nip_plk3', $spt->pivot[2]->namad->nip);
            if ($spt->pivot[2]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk3', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk3', $spt->pivot[2]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol3', $spt->pivot[2]->namad->nip);
            $templateProcessor->setValue('jabatan_plk3', $spt->pivot[2]->namad->nip);

            //==================================================
            $templateProcessor->setValue('kendaraan_1', $son->kendaraan_1);
            $templateProcessor->setValue('kendaraan_2', $son->kendaraan_2);
            $templateProcessor->setValue('kendaraan_3', $son->kendaraan_3);
            //-------------------------------------------------------------//
            $templateProcessor->setValue('awal_1', $son->awal_1);
            $templateProcessor->setValue('tujuan_tb_1_1', $son->tujuan_tb_1_1);
            $templateProcessor->setValue('tgl_berangkat_1', Carbon::parse($son->tgl_berangkat_1)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('awal_2', $son->awal_2);
            $templateProcessor->setValue('tujuan_tb_2_1', $son->tujuan_tb_2_1);
            $templateProcessor->setValue('tgl_berangkat_2', Carbon::parse($son->tgl_berangkat_1)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('awal_3', $son->awal_1);
            $templateProcessor->setValue('tujuan_tb_3_1', $son->tujuan_tb_3_1);
            $templateProcessor->setValue('tgl_berangkat_3', Carbon::parse($son->tgl_berangkat_3)->formatLocalized('%d %B %Y'));

            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('tgl_tb_1_1', Carbon::parse($son->tgl_tb_1_1)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_1_2', Carbon::parse($son->tgl_tb_1_2)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_1_3', Carbon::parse($son->tgl_tb_1_3)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_2_1', Carbon::parse($son->tgl_tb_2_1)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_2_2', Carbon::parse($son->tgl_tb_2_2)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_2_3', Carbon::parse($son->tgl_tb_2_3)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_3_1', Carbon::parse($son->tgl_tb_3_1)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_3_2', Carbon::parse($son->tgl_tb_3_2)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_3_3', Carbon::parse($son->tgl_tb_3_3)->formatLocalized('%d %B %Y'));

            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('kota__brkt_1_1', $son->kota__brkt_1_1);
            $templateProcessor->setValue('tujuan_tb_1_2', $son->tujuan_tb_1_2);
            $templateProcessor->setValue('tgl_brkt_1_1', Carbon::parse($son->tgl_brkt_1_1)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_2_1', $son->kota__brkt_2_1);
            $templateProcessor->setValue('tujuan_tb_2_2', $son->tujuan_tb_2_2);
            $templateProcessor->setValue('tgl_brkt_2_1', Carbon::parse($son->tgl_brkt_2_1)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_3_1', $son->kota__brkt_3_1);
            $templateProcessor->setValue('tujuan_tb_3_2', $son->tujuan_tb_3_2);
            $templateProcessor->setValue('tgl_brkt_3_1', Carbon::parse($son->tgl_brkt_3_1)->formatLocalized('%d %B %Y'));

            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('kota__brkt_1_2', $son->kota__brkt_1_2);
            $templateProcessor->setValue('tujuan_tb_1_3', $son->tujuan_tb_1_3);
            $templateProcessor->setValue('tgl_brkt_1_2', Carbon::parse($son->tgl_brkt_1_2)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_2_2', $son->kota__brkt_2_2);
            $templateProcessor->setValue('tujuan_tb_2_3', $son->tujuan_tb_2_3);
            $templateProcessor->setValue('tgl_brkt_2_2', Carbon::parse($son->tgl_brkt_2_2)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_3_2', $son->kota__brkt_3_2);
            $templateProcessor->setValue('tujuan_tb_3_3', $son->tujuan_tb_3_3);
            $templateProcessor->setValue('tgl_brkt_3_2', Carbon::parse($son->tgl_brkt_3_2)->formatLocalized('%d %B %Y'));

            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('kota__brkt_1_3', $son->kota__brkt_1_3);
            $templateProcessor->setValue('pulang', 'Semarang');
            $templateProcessor->setValue('tgl_brkt_1_3', Carbon::parse($son->tgl_brkt_1_3)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_2_3', $son->kota__brkt_2_3);
            $templateProcessor->setValue('pulang', 'Semarang');
            $templateProcessor->setValue('tgl_brkt_2_3', Carbon::parse($son->tgl_brkt_2_3)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_3_3', $son->kota__brkt_3_3);
            $templateProcessor->setValue('pulang', 'Semarang');
            $templateProcessor->setValue('tgl_brkt_3_3', Carbon::parse($son->tgl_brkt_3_3)->formatLocalized('%d %B %Y'));

        }
        elseif (count($spt->pivot) == 4){
            $templateProcessor = new TemplateProcessor('storage/spt/SPPD_4.docx');
            //==================================================
            $templateProcessor->setValue('nama_plk', $spt->pivot[0]->namad->nama);
            $templateProcessor->setValue('nip_plk', $spt->pivot[0]->namad->nip);
            if ($spt->pivot[0]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk', $spt->pivot[0]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol', $spt->pivot[0]->namad->nip);
            $templateProcessor->setValue('jabatan_plk', $spt->pivot[0]->namad->nip);

            //==================================================
            $templateProcessor->setValue('nama_plk2', $spt->pivot[1]->namad->nama);
            $templateProcessor->setValue('nip_plk2', $spt->pivot[1]->namad->nip);
            if ($spt->pivot[1]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk2', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk2', $spt->pivot[1]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol2', $spt->pivot[1]->namad->nip);
            $templateProcessor->setValue('jabatan_plk2', $spt->pivot[1]->namad->nip);

            //==================================================
            $templateProcessor->setValue('nama_plk3', $spt->pivot[2]->namad->nama);
            $templateProcessor->setValue('nip_plk3', $spt->pivot[2]->namad->nip);
            if ($spt->pivot[2]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk3', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk3', $spt->pivot[2]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol3', $spt->pivot[2]->namad->nip);
            $templateProcessor->setValue('jabatan_plk3', $spt->pivot[2]->namad->nip);

            //==================================================
            $templateProcessor->setValue('nama_plk4', $spt->pivot[3]->namad->nama);
            $templateProcessor->setValue('nip_plk4', $spt->pivot[3]->namad->nip);
            if ($spt->pivot[3]->namad->gol == '-'){
                $templateProcessor->setValue('pangkat_plk4', '-');
            }
            else{
                $templateProcessor->setValue('pangkat_plk4', $spt->pivot[3]->namad->pangkat->pangkat);
            }
            $templateProcessor->setValue('gol4', $spt->pivot[3]->namad->nip);
            $templateProcessor->setValue('jabatan_plk4', $spt->pivot[3]->namad->nip);

            //==================================================
            $templateProcessor->setValue('kendaraan_1', $son->kendaraan_1);
            $templateProcessor->setValue('kendaraan_2', $son->kendaraan_2);
            $templateProcessor->setValue('kendaraan_3', $son->kendaraan_3);
            $templateProcessor->setValue('kendaraan_4', $son->kendaraan_4);


            //-------------------------------------------------------------//
            $templateProcessor->setValue('awal_1', $son->awal_1);
            $templateProcessor->setValue('tujuan_tb_1_1', $son->tujuan_tb_1_1);
            $templateProcessor->setValue('tgl_berangkat_1', Carbon::parse($son->tgl_berangkat_1)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('awal_2', $son->awal_2);
            $templateProcessor->setValue('tujuan_tb_2_1', $son->tujuan_tb_2_1);
            $templateProcessor->setValue('tgl_berangkat_2', Carbon::parse($son->tgl_berangkat_1)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('awal_3', $son->awal_1);
            $templateProcessor->setValue('tujuan_tb_3_1', $son->tujuan_tb_3_1);
            $templateProcessor->setValue('tgl_berangkat_3', Carbon::parse($son->tgl_berangkat_3)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('awal_4', $son->awal_1);
            $templateProcessor->setValue('tujuan_tb_4_1', $son->tujuan_tb_4_1);
            $templateProcessor->setValue('tgl_berangkat_4', Carbon::parse($son->tgl_berangkat_4)->formatLocalized('%d %B %Y'));

            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('tgl_tb_1_1', Carbon::parse($son->tgl_tb_1_1)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_1_2', Carbon::parse($son->tgl_tb_1_2)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_1_3', Carbon::parse($son->tgl_tb_1_3)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_1_4', Carbon::parse($son->tgl_tb_1_4)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('tgl_tb_2_1', Carbon::parse($son->tgl_tb_2_1)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_2_2', Carbon::parse($son->tgl_tb_2_2)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_2_3', Carbon::parse($son->tgl_tb_2_3)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_2_4', Carbon::parse($son->tgl_tb_2_4)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('tgl_tb_3_1', Carbon::parse($son->tgl_tb_3_1)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_3_2', Carbon::parse($son->tgl_tb_3_2)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_3_3', Carbon::parse($son->tgl_tb_3_3)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_3_4', Carbon::parse($son->tgl_tb_3_4)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('tgl_tb_4_1', Carbon::parse($son->tgl_tb_4_1)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_4_2', Carbon::parse($son->tgl_tb_4_2)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_4_3', Carbon::parse($son->tgl_tb_4_3)->formatLocalized('%d %B %Y'));
            $templateProcessor->setValue('tgl_tb_4_4', Carbon::parse($son->tgl_tb_4_4)->formatLocalized('%d %B %Y'));

            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('kota__brkt_1_1', $son->kota__brkt_1_1);
            $templateProcessor->setValue('tujuan_tb_1_2', $son->tujuan_tb_1_2);
            $templateProcessor->setValue('tgl_brkt_1_1', Carbon::parse($son->tgl_brkt_1_1)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_2_1', $son->kota__brkt_2_1);
            $templateProcessor->setValue('tujuan_tb_2_2', $son->tujuan_tb_2_2);
            $templateProcessor->setValue('tgl_brkt_2_1', Carbon::parse($son->tgl_brkt_2_1)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_3_1', $son->kota__brkt_3_1);
            $templateProcessor->setValue('tujuan_tb_3_2', $son->tujuan_tb_3_2);
            $templateProcessor->setValue('tgl_brkt_3_1', Carbon::parse($son->tgl_brkt_3_1)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_4_1', $son->kota__brkt_4_1);
            $templateProcessor->setValue('tujuan_tb_4_2', $son->tujuan_tb_4_2);
            $templateProcessor->setValue('tgl_brkt_4_1', Carbon::parse($son->tgl_brkt_4_1)->formatLocalized('%d %B %Y'));
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('kota__brkt_1_2', $son->kota__brkt_1_2);
            $templateProcessor->setValue('tujuan_tb_1_3', $son->tujuan_tb_1_3);
            $templateProcessor->setValue('tgl_brkt_1_2', Carbon::parse($son->tgl_brkt_1_2)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_2_2', $son->kota__brkt_2_2);
            $templateProcessor->setValue('tujuan_tb_2_3', $son->tujuan_tb_2_3);
            $templateProcessor->setValue('tgl_brkt_2_2', Carbon::parse($son->tgl_brkt_2_2)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_3_2', $son->kota__brkt_3_2);
            $templateProcessor->setValue('tujuan_tb_3_3', $son->tujuan_tb_3_3);
            $templateProcessor->setValue('tgl_brkt_3_2', Carbon::parse($son->tgl_brkt_3_2)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_4_2', $son->kota__brkt_4_2);
            $templateProcessor->setValue('tujuan_tb_4_3', $son->tujuan_tb_4_3);
            $templateProcessor->setValue('tgl_brkt_4_2', Carbon::parse($son->tgl_brkt_4_2)->formatLocalized('%d %B %Y'));
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            $templateProcessor->setValue('kota__brkt_1_3', $son->kota__brkt_1_3);
            $templateProcessor->setValue('pulang', 'Semarang');
            $templateProcessor->setValue('tgl_brkt_1_3', Carbon::parse($son->tgl_brkt_1_3)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_2_3', $son->kota__brkt_2_3);
            $templateProcessor->setValue('pulang', 'Semarang');
            $templateProcessor->setValue('tgl_brkt_2_3', Carbon::parse($son->tgl_brkt_2_3)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_3_3', $son->kota__brkt_3_3);
            $templateProcessor->setValue('pulang', 'Semarang');
            $templateProcessor->setValue('tgl_brkt_3_3', Carbon::parse($son->tgl_brkt_3_3)->formatLocalized('%d %B %Y'));

            $templateProcessor->setValue('kota__brkt_4_3', $son->kota__brkt_4_3);
            $templateProcessor->setValue('pulang', 'Semarang');
            $templateProcessor->setValue('tgl_brkt_4_3', Carbon::parse($son->tgl_brkt_4_3)->formatLocalized('%d %B %Y'));
            //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
            //-------------------------------------------------------------//


        }
        else{
            return redirect()->back()->with('warning', 'Tidak boleh lebih dari 4 orang');
        }

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






}
