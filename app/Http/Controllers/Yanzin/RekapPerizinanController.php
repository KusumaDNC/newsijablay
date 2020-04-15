<?php

namespace App\Http\Controllers\Yanzin;

use Illuminate\Support\Facades\DB;
use App\Exports\PerizinanExport;
use App\Models\PD\NumberModel;
use App\Models\Sekretariat\RekModel;
use App\Models\Yanzin\JenisIzinModel;
use App\Models\Yanzin\RekapPerizinanModel;
use App\Models\Yanzin\SektorModel;
use App\Models\Yanzin\SOPPelayananModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class RekapPerizinanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $bulan =$request->input('bulan');
        $izins = $request->izins;
        foreach ($izins as $item){
            $store = new RekapPerizinanModel();
            if ($item['izin'] == null){
                $item['izin'] = 0;
            }else{
                $item['izin'];
            }
            if ($item['non_izin'] == null){
                $item['non_izin'] = 0;
            }else{
                $item['non_izin'];
            }
            if ($item['waktu_selesai'] == null){
                $item['waktu_selesai'] = 0;
            }else{
                $item['waktu_selesai'];
            }
            if (($item['sop'] == 0) or ($item['waktu_selesai'] == 0)){
                $persen_sop = 0;
            }
            else{
                $persen_sop = ($item['waktu_selesai'] / $item['sop'])  * 100;
            };
            $jml_izin = $item['izin'] +  $item['non_izin'];
            $store->izin_id = $item['jns_izin'];
            $store->sop = $item['sop'];
            $store->jumlah_izin = $jml_izin;
            $store->bulan = $bulan;
            $store->izin = $item['izin'];
            $store->nonizin = $item['non_izin'];
            $store->waktu_selesai = $item['waktu_selesai'];
            $store->persen_sop = $persen_sop;
            $store->save();
        }
        return redirect()->back()->with('success', 'Data Rekap Perizinan Berhasil di Input');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $soppelayanan = SOPPelayananModel::all();
        $today = date("Y-m");
        /*foreach ($soppelayanan as $sp){
            $sop = $sp->sop;
            $jenis_izin = $sp->jenis_izin_id;
        }*/
        //dd($jenis_izin);

        return view('yanzin.base.showrekap', compact('soppelayanan',  'today'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function  showrekap(Request $request){
        $user = Auth::user();
        $bulan = $request->input('bulan');
        $rekap = DB::table('rekap_perizinan_models')->where('bulan', '=', $bulan)->get();
        $today = date('Y-m');
        $todays = date("F", strtotime($bulan));


        return view('yanzin.base.rekap-perizinan', compact('user', 'rekap', 'today', 'todays'));
    }

    public function export()
    {
        return Excel::download(new PerizinanExport(), 'Rekap Izin.xlsx');
    }

    public function gabungsetting()
    {
        $user = Auth::user()->id;
        $soppelayanan = SOPPelayananModel::all();
        $today = date("Y-m");
        $dropdown = JenisIzinModel::all();
        $rekap_sop = SOPPelayananModel::all();
        $rek = RekModel::all();
        $id = Auth::user();
        $nomor = NumberModel::all()->where('user_id', '=', $user);

        return view('yanzin.base.gabung-setting', compact('user', 'soppelayanan', 'today', 'nomor', 'dropdown', 'rekap_sop', 'rek', 'id'));
    }

    public function gabung()
    {
        $user = Auth::user()->id;
        $soppelayanan = SOPPelayananModel::all();
        $today = date("Y-m");
        $dropdown = JenisIzinModel::all();
        $rekap_sop = SOPPelayananModel::all();
        $todays = date("F", strtotime($today));
        $rekap = RekapPerizinanModel::all();

        return view('yanzin.base.gabung', compact('user', 'soppelayanan', 'today', 'todays', 'dropdown', 'rekap_sop', 'rekap'));
    }
}
