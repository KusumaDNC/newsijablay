<?php

namespace App\Http\Controllers\EKSTERNAL;

use App\Exports\PelabuhanMuat;
use App\Models\EKSTERNAL\BahanBakarModel;
use App\Models\EKSTERNAL\BarangModalTetapModels;
use App\Models\EKSTERNAL\BayarPekerjaModel;
use App\Models\EKSTERNAL\EksporImporModel;
use App\Models\EKSTERNAL\KepemilikanModalModel;
use App\Models\EKSTERNAL\ListrikModel;
use App\Models\EKSTERNAL\NegaraTujuanModel;
use App\Models\EKSTERNAL\NilaiPendapatanPerusahaanModel;
use App\Models\EKSTERNAL\NilaiTambahPerusahaanModel;
use App\Models\EKSTERNAL\PelabuhanModel;
use App\Models\EKSTERNAL\PengeluaranPekerjaModel;
use App\Models\EKSTERNAL\PengeluaranPerusahaanModel;
use App\Models\EKSTERNAL\PenjualanBarangModalModels;
use App\Models\EKSTERNAL\SelisihStokAwalModel;
use App\Models\EKSTERNAL\StatusPenanamanModalModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PelabuhanController extends Controller
{
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

