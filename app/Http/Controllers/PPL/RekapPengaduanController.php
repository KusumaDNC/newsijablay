<?php

namespace App\Http\Controllers\PPL;

use App\Exports\PengaduanExport;
use App\Models\PPL\LayananModel;
use App\Models\PPL\MediaModel;
use App\Models\PPL\RekapPengaduanModels;
use App\Models\PPL\TabulasiModel;
use App\Models\Yanzin\SektorModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use app\Http\Controllers\TabulasiController;

class RekapPengaduanController extends Controller
{
    public function gabung(Request $request){
        //dd(is_null($request->bulan));
        //dd($request->bulan);
        $bulan = $request->bulan;
        $date = Carbon::parse($bulan);
        //dd($date);
        //dd($bulan);
        if ($bulan == null){
            $rek_pengaduan = RekapPengaduanModels::whereMonth('tanggal', Carbon::now()->format('m'))->get();
            //dd($rek_pengaduan);
        }
        else {
            $rek_pengaduan = RekapPengaduanModels::with('sektorRelation')->whereMonth('tanggal', $date)->whereYear('tanggal', $date)->get();
            //dd($rek_pengaduan);

            //dd($rekap_charts);
        }
        $all_rekaps = RekapPengaduanModels::with('sektorRelation')->get();
        $get_charts = $all_rekaps->groupBy('sektorRelation.nama_sektor');
        $rekap_charts = collect();
        foreach ($get_charts as $key => $chart){
            $rekap = array(
                'sektor' => $key,
                'jumlah' => count($chart)
            );
            $rekap_charts->push($rekap);
        }
        //dd($rekap_charts);
        //dd($rek_pengaduan);
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


        return view('ppl.base.gabung', compact(
            'rek_pengaduan',
            'user_name',
            'sektors',
            'tabulasi',
            'jml_jns_layanan_pengaduan',
            'jml_jns_layanan_informasi',
            'jenis_layanan_informasi',
            'user',
            'today',
            'medias',
            'layanans',
            'bulan',
            'hasil_rekaps',
            'todays',
            'rekap_charts'
        ));
    }

    public function index(){
        $pengaduan = RekapPengaduanModels::all();

        return view('ppl.base.form-rekap-pengaduan', compact('pengaduan'));
    }

    public function store(Request $request){
        //dd($request->all());
        $this->validate($request,[
            'tanggal' => 'required',
            'nama' => 'required',
            'jenis_pengaduan' => 'required',
            'jenis_kelamin' => 'required',
            'media' => 'required',
            'layanan' => 'required',
            'sektor' => 'required',
            'rincian_aduan' => 'required',
            'penyelesaian' => 'required',
        ]);

        $tanggal = $request->input('tanggal');
        $nama = $request->input('nama');
        $jenis_pengaduan = $request->input('jenis_pengaduan');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $media = $request->input('media');
        $jenis_layanan = $request->input('layanan');
        $no_telp = $request->input('no_telp');
        $sektor = $request->input('sektor');
        $wa_email = $request->input('wa_email');
        $rincian_aduan = $request->input('rincian_aduan');
        $penyelesaian = $request->input('penyelesaian');

        $post = new RekapPengaduanModels();
        $post->tanggal = $tanggal;
        $post->nama = $nama;
        $post->jenis_pengaduan = $jenis_pengaduan;
        $post->jenis_kelamin = $jenis_kelamin;
        $post->media = $media;
        $post->jenis_layanan = $jenis_layanan;
        $post->no_telp = $no_telp;
        $post->sektor = $sektor;
        $post->wa_email = $wa_email;
        $post->rincian_aduan = $rincian_aduan;
        $post->penyelesaian = $penyelesaian;
        //dd($post);
        $post->save();

        return redirect()->back()->with('success', 'Data Berhasil DiInput');
    }

    public function rekap(){
        $rek_pengaduan = RekapPengaduanModels::all();
        $user_name = Auth::user()->name;
       // dd($rek_pengaduan);
        //foreach ($rek_pengaduan as $r) {
            //dd($r->nama);
        //}
        return view('ppl.base.rekap-pengaduan', compact('rek_pengaduan', 'user_name'));
    }

    public function edit($id){
        $rek_pengaduan = RekapPengaduanModels::findOrFail($id);
        $medias = MediaModel::all();
        $layanans = LayananModel:: all();
        $sektors = SektorModel::all();
        //dd($rek_pengaduan);
        return view('ppl.base.edit-pengaduan', compact('rek_pengaduan', 'medias','layanans','sektors'));
    }

    public function update(Request $request, $id){
       /* $this->validate($request,[
            'tanggal' => 'required',
            'nama' => 'required',
            'jenis_pengaduan' => 'required',
            'jenis_kelamin' => 'required',
            'media' => 'required',
            'no_telp' => 'required',
            'jenis_layanan' => 'required',
            'sektor' => 'required',
            'wa_email' => 'required',
            'rincian_aduan' => 'required',
            'penyelesaian' => 'required',
        ]);*/

        $tanggal = $request->input('tanggal');
        $nama = $request->input('nama');
        $jenis_pengaduan = $request->input('jenis_pengaduan');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $media = $request->input('media');
        $jenis_layanan = $request->input('jenis_layanan');
        $no_telp = $request->input('no_telp');
        $sektor = $request->input('sektor');
        $wa_email = $request->input('wa_email');
        $rincian_aduan = $request->input('rincian_aduan');
        $penyelesaian = $request->input('penyelesaian');

        $post = RekapPengaduanModels::findOrFail($id);
        $post->tanggal = $tanggal;
        $post->nama = $nama;
        $post->jenis_pengaduan = $jenis_pengaduan;
        $post->jenis_kelamin = $jenis_kelamin;
        $post->media = $media;
        $post->jenis_layanan = $jenis_layanan;
        $post->no_telp = $no_telp;
        $post->sektor = $sektor;
        $post->wa_email = $wa_email;
        $post->rincian_aduan = $rincian_aduan;
        $post->penyelesaian = $penyelesaian;
        //dd($post);
        $post->update();

        return redirect()->route('gabung.pengaduan')->with('success', 'Data berhasil diubah');
    }

    public function delete($id){
        $delete = RekapPengaduanModels::findOrFail($id);
        //dd($delete);
        $delete->delete();

        return redirect()->route('gabung.pengaduan')->with('success', 'Data berhasil dihapus');
    }

    public function export(){
        return Excel::download(new PengaduanExport(), 'Rekap Pengaduan.xlsx');
    }
}
