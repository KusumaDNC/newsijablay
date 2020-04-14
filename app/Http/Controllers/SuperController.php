<?php

namespace App\Http\Controllers;

use App\Exports\PelabuhanMuat;
use App\Models\Sekretariat\ArsipNomor;
use App\Models\Sekretariat\KategoriNomorModel;
use App\Models\Sekretariat\PenggunaanNomorModel;
use App\Models\Sekretariat\SettingNomorModel;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SuperController extends Controller
{
    public function indx(){

        $kategoris = KategoriNomorModel::all();
        $settings = SettingNomorModel::all();
        $nomors = PenggunaanNomorModel::orderByDesc('updated_at')->get();
        //dd($nomors);
       /* foreach ($nomors as $nomor){

            dd($nomor->kodenomor);
        }*/
        /*$kodes_null = ArsipNomor::where('is_able', 0)->get();
        $kodes = ArsipNomor::all();*/
        $today = date('Y-m-d');
        $kodes_null = ArsipNomor::where('is_able', 0)->get();
        $kodes = ArsipNomor::where('is_able', 1)->get(); /* ambil nomor khusus */

       // $total_nomor = PenggunaanNomorModel::all()->count();
       // dd($total_nomor);
       // dd( $nomor_terakhir = PenggunaanNomorModel::latest('created_at')->limit(1)->get());
       // dd(Carbon::now());
        //dd(date('H:i:s'));

        //dd($nomor_terakhir);
        return view('vendor.voyager.penggunaan-nomors.browse', compact('kategoris', 'settings', 'nomors', 'kodes' ,'kodes_null', 'today'));
    }




    //////NOMOR//////
    public function addNomor(Request $request){

        $tanggal_nomor = Carbon::parse($request->tanggal)->format('Y-m-d').' '.$request->time;
        //dd(Carbon::today()->gt(Carbon::parse($tanggal_nomor)));
        //dd( Carbon::parse($request->tanggal)->format('Y-m-d'));
        $total_nomor = PenggunaanNomorModel::latest()->first(); //bug
        //dd($total_nomor->count);
        $nomor_terakhir = PenggunaanNomorModel::findOrFail($total_nomor); //bug on 0

        if (Carbon::today()->gt(Carbon::parse($tanggal_nomor))){
            $nomor_spare = PenggunaanNomorModel::orderBy('created_at')->where('used', 0)->whereDate('tanggal', Carbon::parse($request->tanggal)->format('Y-m-d'))->first();
            //dd($nomor_spare);
            //dd(isset($nomor_spare));
            if (isset($nomor_spare)){
                $nomor_spare->user_id = $request->user_id;
                $nomor_spare->kategori_nomor_id = $request->kategori;
                $nomor_spare->arsip_id = $request->kode;
                $nomor_spare->perihal = $request->perihal;
                $nomor_spare->used = 1;
                //dd($nomor_spare);
                $nomor_spare->update();

                return redirect()->back()->with('success', 'NOMOR ANDA ADALAH' .' '. $nomor_spare->count);
            }
            else{
                return redirect()->back()->with('success', 'BELUM ADA NOMOR DI TANGGAL'.' '.Carbon::parse($request->tanggal)->toFormattedDateString());
            }


        }
        else{
            //dd($nomor_terakhir);
            $nomor = new PenggunaanNomorModel();
            $nomor->user_id = $request->user_id;
            $nomor->kategori_nomor_id = $request->kategori;
            $nomor->arsip_id = $request->kode;
            $nomor->perihal = $request->perihal;
            $nomor->tanggal = $tanggal_nomor;
            $nomor->count = ($total_nomor->count) + 1;
            $nomor->used = 1;
            //dd($nomor);
            $nomor->save();
        }


        return redirect()->back()->with('success', 'berhasil menambahkan nomor surat');
    }

    public function editNomor($id)
    {
        $editkategori = KategoriNomorModel::findOrFail($id);
        //dd($editkategori);
        return view('sekretariat.base.penomoran.edit-kategori', compact('editkategori'));
    }

    public function updateNomor(Request $request, $id)
    {
        $update = KategoriNomorModel::findOrFail($id);
        $update->nama_kategori = $request->editkategori;
        $update->update();

        return redirect()->route('show.setting-nomor')->with('success', 'Kategori Berhasil di rubah');
    }
    //////END-NOMOR///////




















    public function formPelabuhan(){

    }

    public function addPelabuhan(Request $request)
    {
        //dd($request->tahun);
        $add_pelabuhan = new PelabuhanModel();
        $add_pelabuhan->tahun = $request->tahun;
        $add_pelabuhan->jenis_volume = $request->jenis_volume;
        $add_pelabuhan->pelabuhan_muat = $request->pelabuhan_muat;
        $add_pelabuhan->volume = $request->volume;
        $add_pelabuhan->nilai = $request->nilai;
        $add_pelabuhan->save();
        return redirect()->back()/*->with('success', 'Data Berhasil Ditambah')*/ ;
    }

    public function editPelabuhan($id)
    {
        $edit_pelabuhan = PelabuhanModel::findOrFail($id);
        return view('eksternal.base.edit-pelabuhan', compact('edit_pelabuhan'));
    }

    public function updatePelabuhan(Request $request, $id)
    {
        $update_pelabuhan = PelabuhanModel::findOrFail($id);
        $update_pelabuhan->tahun = $request->tahun;
        $update_pelabuhan->jenis_volume = $request->jenis_volume;
        $update_pelabuhan->pelabuhan_muat = $request->pelabuhan_muat;
        $update_pelabuhan->volume = $request->volume;
        $update_pelabuhan->nilai = $request->nilai;
        $update_pelabuhan->update();

        return redirect()->route('show.eksternal')->with('success', 'Data berhasil diubah');
    }

    public function deletePelabuhan($id)
    {
        $delete_pelabuhan = PelabuhanModel::findOrFail($id);
        $delete_pelabuhan->delete();
        return redirect()->back()->with('success', 'Data Berhasil di Hapus');
    }


    public function PelabuhanMuatExport()
    {
        //dd($request);
//        $tahun = EksporImporModel::groupBy('tahun')->pluck('tahun');;
//        dd($tahun);
        /* /* return Excel::download(new ExporImporExport(), 'Jenis Komoditi.xlsx');*/
        return (new PelabuhanMuat())->download('Pelabuhan Muat.xlsx');
    }



    public function filterpelabuhan(Request $request){

        DB::enableQueryLog();
        //dd($request->all());
        //dd(EksporImporModel::where('tahun', 2019)->get());
        $rek_pelabuhan = PelabuhanModel::Filter(
            $request->from_tahun,
            $request->to_tahun,
            $request->volume,
            $request->pelabuhan_muat
        )->get();

        //dd(DB::getQueryLog());
        //dd($rek_eksporimpor->groupBy('tahun'));
        $data = collect();

        foreach ($rek_pelabuhan->groupBy('tahun') as $tahun => $dt){
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
        $rek_eksporimpor= EksporImporModel::all();
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







}

