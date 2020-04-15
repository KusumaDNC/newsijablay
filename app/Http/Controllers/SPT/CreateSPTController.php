<?php

namespace App\Http\Controllers\SPT;

use App\Models\All\NonASN;
use App\Models\PD\NumberModel;
use App\Models\PD\SptModel;
use App\Models\Sekretariat\DataAsnModel;
use App\Models\Sekretariat\PenggunaanNomorModel;
use App\Models\Sekretariat\RekModel;
use App\Models\SPT\DasarHukumModel;
use App\PivotName;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Novay\WordTemplate\WordTemplate;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CreateSPTController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $today = date('Y-m-d');
        $nama = DB::table('data_asn_models')->get();
        $rek = RekModel::all(['jns_rek', 'id']);


        //dd($nama);

        return view('spt.base.base-spt', compact('today','nama', 'rek'));
    }

    public function gabung(){
        $today = date('Y-m-d');
        $nama = DB::table('data_asn_models')->get();
        foreach ($nama as $n){
            //dd($n);
        }
        $rek = RekModel::all(['jns_rek', 'id']);
        $user_name = Auth::user()->name;
        $user = Auth::user()->id;
        $spt = SptModel::all()->where('user_id', '=', $user)->sortByDesc('created_at');
        //dd(count($spt));

        $spt_terhapus = SptModel::onlyTrashed()->where('user_id', '=', $user)->get();
        //dd($spt_terhapus);
        $dasar_hukums=DasarHukumModel::all();

        if (count($spt) == 0){
            $sptnol = 'Belum Ada SPT';

        }
        else {
            foreach ($spt as $s) {
                $namas = $s->data_asn_models_id;
                //dd($s->tgl_berangkat);
                $b_spt = Carbon::parse($s->tgl_spt)->formatLocalized('%A, %d %B %Y');
                $b_mgk = Carbon::parse($s->tgl_berangkat)->formatLocalized('%A, %d %B %Y');
                $b_mlh = Carbon::parse($s->tgl_pulang)->formatLocalized('%A, %d %B %Y');
                $get_nama = DataAsnModel::find($s->data_asn_models_id);

                //dd($s->tujuan);

                //dd(count($s->tujuan));
            }

        }
           //dd($b_mgk);

            $na = PivotName::all();

//dd($na);

        return view('spt.base.gabung', compact('today','spt_terhapus', 'nama', 'rek' ,'user_name', 'spt', 'user',  'na','dasar_hukums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'perihal' => 'required',
            'tgl_spt' => 'required',
            'tgl_berangkat' => 'required',
            'tgl_pulang' => 'required',
            'tujuan' => 'required',
            'pelaksana' => 'required|max:4',
        ]);

        $id = Auth::user()->id;
        $year = date('Y');

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


        //GET INPUT FORM//
        $input_no_spt = $request->input('nomor_spt');
        $input_perihal = $request->input('perihal');
        $input_tgl_spt = $request->input('tgl_spt');
        $input_tgl_berangkat = $request->input('tgl_berangkat');
        $input_tgl_pulang = $request->input('tgl_pulang');
        $input_plk = $request->input('pelaksana');
        foreach ($input_plk as $item){
            $spt = DB::table('asn_spt')
                ->where('data_asn_models_id', '=', $item)
                ->where('tgl_berangkat', $input_tgl_berangkat)
                ->exists();
            //dd($spt);

            /*if ($spt == true){
                return redirect()->back()->with('error', 'Nama Anda sudah terdaftar pada Data SPT. Silahkan Hapus Salah Satu SPT');
            }*/
        }

        //dd($spt);
       /* $cek_tmp = KegiatanCrash::where('tempat', '=', $k->tempat)->exists();*/
        $jal = Input::get('pelaksana');
        //dd($input_plk);

        $input_rek = $request->input('jns_rek');
        $input_ken = $request->input('kendaraan');
        $input_tujuan = $request->input('tujuan');
        $input_pembuka = $request->input('pembuka');
        $jml_brgkt = count($input_plk);
        $get_no = NumberModel::latest()->first();
        //dd($get_no);

        $update_no = new NumberModel();
        $incno = $get_no->no_spt + 1;
        $update_no->no_spt = $nomor_terakhir->count;
        $update_no->no_sppd = $get_no->no_sppd + $jml_brgkt;
        $update_no->user_id = $id;
        $update_no->save();
        //dd($update_no);

        $post = new SptModel();
        /*094/SPT/6/2019/123412341234*/
        $format = '094/SPT/'. $id . '/' . $year . '/' . $nomor_terakhir->count;
        //dd($format);

        $post->nomor_spt = $format;
        $post->perihal = $input_perihal;
        $post->tgl_spt = $input_tgl_spt;
        $post->tgl_berangkat = $input_tgl_berangkat;
        $post->tgl_pulang = $input_tgl_pulang;
        $nama = $post->data_asn_models_id;
        $nama['nama_id'] = $input_plk;
        $post->data_asn_models_id = $nama;
        $tujuan = $post->tujuan;
        $tujuan['tujuan'] = $input_tujuan;
        $post->tujuan = $tujuan;
        $post->rek_id = $input_rek;
        $post->kendaraan = $input_ken;
        $post->pembuka = $input_pembuka;
        $post->user_id = Auth::user()->id;
        //dd($post);

        $post->save();

        foreach ($input_plk as $a){

            $pivot = new PivotName();
            $pivot->spt_id = $post->id;
            $pivot->data_asn_models_id = $a;
            $pivot->tgl_berangkat = $post->tgl_berangkat;
            //dd($pivot);
            $pivot->save();
        }


        return redirect()->back()->with('success', 'SPT berhasil ditambahkan');
    }

    public function edit($id){
        $today = date('Y-m-d');
        $nama = DB::table('data_asn_models')->get();
        $rek = RekModel::all(['jns_rek', 'id']);
        $spt = SptModel::findOrFail($id);

        return view('spt.base.edit-spt', compact('spt', 'today', 'nama', 'rek'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'perihal' => 'required',
            'tgl_spt' => 'required',
            'tgl_berangkat' => 'required',
            'tgl_pulang' => 'required',
            'tujuan' => 'required',
            'pelaksana' => 'required|max:4',
        ]);

        $ids = Auth::user()->id;
        $year = date('Y');

        //GET INPUT FORM//
        $input_no_spt = $request->input('nomor_spt');
        $input_perihal = $request->input('perihal');
        $input_tgl_spt = $request->input('tgl_spt');
        $input_tgl_berangkat = $request->input('tgl_berangkat');
        $input_tgl_pulang = $request->input('tgl_pulang');
        $input_plk = $request->input('pelaksana');
        foreach ($input_plk as $item){
            $spt = DB::table('asn_spt')
                ->where('data_asn_models_id', '=', $item)
                ->where('tgl_berangkat', $input_tgl_berangkat)
                ->exists();
            //dd($spt);

            /*if ($spt == true){
                return redirect()->back()->with('error', 'Nama Anda sudah terdaftar pada Data SPT. Silahkan Hapus Salah Satu SPT');
            }*/
        }

        //dd($spt);
        /* $cek_tmp = KegiatanCrash::where('tempat', '=', $k->tempat)->exists();*/
        $jal = Input::get('pelaksana');
        //dd($input_plk);

        $input_rek = $request->input('jns_rek');
        $input_ken = $request->input('kendaraan');
        $input_tujuan = $request->input('tujuan');
        $input_pembuka = $request->input('pembuka');
        $jml_brgkt = count($input_plk);
        $get_no = NumberModel::latest()->first();

        $post = SptModel::findOrFail($id);
        $post->perihal = $input_perihal;
        $post->tgl_spt = $input_tgl_spt;
        $post->tgl_berangkat = $input_tgl_berangkat;
        $post->tgl_pulang = $input_tgl_pulang;
        $nama = $post->data_asn_models_id;
        $nama['nama_id'] = $input_plk;
        $post->data_asn_models_id = $nama;
        $tujuan = $post->tujuan;
        $tujuan['tujuan'] = $input_tujuan;
        $post->tujuan = $tujuan;
        $post->rek_id = $input_rek;
        $post->kendaraan = $input_ken;
        $post->pembuka = $input_pembuka;
        $post->user_id = Auth::user()->id;
        //$post->update();

        $del_plk = DB::table('asn_spt')
            ->where('spt_id', '=', $post->id);
        $del_plk->delete();

        foreach ($input_plk as $a){

            $pivot = new PivotName();
            $pivot->spt_id = $post->id;
            $pivot->data_asn_models_id = $a;
            $pivot->tgl_berangkat = $post->tgl_berangkat;
            //dd($pivot);
            $pivot->save();
        }

        return redirect()->route('form.spt')->with('success', 'SPT berhasil dirubah');


    }
}
