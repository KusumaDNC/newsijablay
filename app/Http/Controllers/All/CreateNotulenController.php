<?php

namespace App\Http\Controllers\All;

use App\Models\All\NonASN;
use App\Models\All\Notulen;
use App\Models\All\Notulens;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;
use Barryvdh\DomPDF\Facade as PDF;

class CreateNotulenController extends Controller
{
    public function showForm(){

        $today = date('Y-m-d');
        $nama = DB::table('data_asn_models')->get();

        return view('all.base.add-notulen', compact('nama', 'today'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeNotulen(Request $request){

        $this->validate($request, [
            'tgl' => 'required',
            'tempat' => 'required',
            'acara' => 'required',
            'peserta' => 'required',
            'pemimpin_rpt' => 'required',
            'pengampu_keg' => 'required',
            'notulis' => 'required',
            'article-ckeditor' => 'required',
        ]);


        $tgl = $request->input('tgl');
        $pukul = $request->input('pukul');
        $pemimpin_rpt = $request->input('pemimpin_rpt');
        $pengampu = $request->input('pengampu_keg');
        $notulis = $request->input('notulis');
        $tpt = $request->input('tempat');
        $acr = $request->input('acara');
        $psrt = $request->input('peserta');
        $hasil = $request->input('article-ckeditor');
        //dd($hasil);


        $n = new Notulens();
        $n->tgl = $tgl;
        $n->pukul = $pukul;
        $n->tempat = $tpt;
        $n->acara = $acr;
        $n->peserta = $psrt;
        $n->pemimpin_rpt = $pemimpin_rpt;
        $n->pengampu_keg_id = $pengampu;
        $n->notulis_id = $notulis;
        $n->hasil_rapat = $hasil;
        $n->user_id = Auth::user()->id;
        //dd($n);
        $n->save();

        return redirect()->route('gabung.notulen')->with('success', 'Notulen berhasil disimpan');

    }

    public function editNotulen($id){
        $today = date('Y-m-d');
        $notulen = Notulens::findOrFail($id);
        //dd($notulen);
        $nama = DB::table('data_asn_models')->get();

        return view('all.base.edit-notulen', compact('nama', 'today', 'notulen'));
    }

    public function updateNotulen(Request $request,$id){
        $notulen = Notulens::findOrFail($id);
        $tgl = $request->input('tgl');
        $pukul = $request->input('pukul');
        $pemimpin_rpt = $request->input('pemimpin_rpt');
        $pengampu = $request->input('pengampu_keg');
        $notulis = $request->input('notulis');
        $tpt = $request->input('tempat');
        $acr = $request->input('acara');
        $psrt = $request->input('peserta');
        $hasil = $request->input('article-ckeditor');

        $n = Notulens::findOrFail($id);
        $n->tgl = $tgl;
        $n->pukul = $pukul;
        $n->tempat = $tpt;
        $n->acara = $acr;
        $n->peserta = $psrt;
        $n->pemimpin_rpt = $pemimpin_rpt;
        $n->pengampu_keg_id = $pengampu;
        $n->notulis_id = $notulis;
        $n->hasil_rapat = $hasil;
        //dd($n);
        $n->update();

        return redirect()->route('rekap.notulen')->with('success', 'Data Kegiatan berhasil diubah');

    }
    public function getNotulen(){
        $user = Auth::user()->id;
        $user_name = Auth::user()->name;

        $notulen = Notulens::all()->where('user_id', '=', $user)->sortByDesc('created_at');
        //dd($notulen);
        $notulennol = 'Belum ada Notulen';


        return view('all.base.rekap-notulen', compact('notulen', 'user_name', 'notulennol'));

    }

    public function cetakNotulen($id){
        $notulen = Notulens::find($id);
        $non = NonASN::where('id', $notulen->notulis_id)->get();

        //dd($non);

        $tgl = Carbon::parse($notulen->tgl)->formatLocalized('%A, %d %B %Y');
        //dd($notulen);
        //dd($notulen->pengampu->nip);


        $pdf = PDF::loadView('all.cetak',compact('notulen', 'non', 'tgl'));
        return $pdf->stream('notulen.pdf');
    }

    public function cetakNotulenAbsen(){
        $pdf = PDF::loadView('all.cetak-absen');
        return $pdf->stream('notulenabsen.pdf');
    }

    public function gabung(){
        $today = date('Y-m-d');
        $nama = DB::table('data_asn_models')->get();
        $namas = DB::select("SELECT id, nama, gol FROM data_asn_models UNION SELECT id, nama, gol FROM non_asn ORDER BY `gol` DESC");

        $user = Auth::user()->id;
        $user_name = Auth::user()->name;

        $notulen = Notulens::all()->where('user_id', '=', $user)->sortByDesc('created_at');
        //dd($notulen);

        foreach ($notulen as $n){
            //dd($n->pengampu);
        }
        $notulennol = 'Belum ada Notulen';

        return view('all.base.gabung', compact('today', 'nama', 'user', 'user_name', 'notulen', 'notulennol', 'namas'));
    }

    public function hapusNotulen($id){
        $delete = Notulens::find($id);
        $user = Auth::user()->id;
        $user_id = $delete->user_id;
        if ($user == $user_id){
            $delete->delete();
            return redirect()->back()->with('success', 'Notulen berhasil dihapus');
        }
        else{
            return redirect()->back()->with('warning', 'Bukan Notulen di Bidang Anda');
        }
    }
}
