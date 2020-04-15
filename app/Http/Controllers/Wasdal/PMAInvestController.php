<?php

namespace App\Http\Controllers\Wasdal;

use App\Models\Wasdal\PMAInvestModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PMAInvestImport;

class PMAInvestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('wasdal.base.form-pma-invest');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function import(Request $request){
        //dd($request->all());
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        Excel::import(new PMAInvestImport(), request()->file('file'));

        return redirect()->back()->with('success', 'Data Berhasil di Input');
    }

    public function rekap(Request $request){
        /*$kab_kotas = DB::table('pma_invest_models')->groupBy('kab_kota')->get();*/
        $pma_pmdns = DB::table('pma_invest_models')->groupBy('pma_pmdn')->get();
        /*$kabkota = $request->input('kab_kota');*/
        $pma_pmdn = $request->input('pma_pmdn');
        $wilayah = $request->input('wilayah');
        //$wilayah = $request->input('wilayah');

        if (($pma_pmdn == 'all')/* and ($kabkota == 'all')*/ and ($wilayah == 'all')){
            $pma_invest = DB::table('pma_invest_models')->get();
        }
        elseif ($wilayah == 'kedungsapur'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=','Kabupaten Kendal')
                ->orWhere('kab_kota', '=', 'Kabupaten Demak')
                ->orWhere('kab_kota', '=', 'Kabupaten Semarang')
                ->orWhere('kab_kota', '=', 'Kabupaten Grobogan')
                ->orWhere('kab_kota', '=', 'Kota Semarang')
                ->orWhere('kab_kota', '=', 'Kota Salatiga')
                ->get();
        }
        elseif ($wilayah == 'wanarakuti'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=', 'Kabupaten Jepara')
                ->orWhere('kab_kota', '=', 'Kabupaten Kudus')
                ->orWhere('kab_kota', '=', 'Kabupaten Pati')
                ->get();
        }
        elseif ($wilayah == 'subosukowonosraten'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=', 'Kabupaten Sukoharjo')
                ->orWhere('kab_kota', '=', 'Kabupaten Boyolali')
                ->orWhere('kab_kota', '=', 'Kabupaten Wonogiri')
                ->orWhere('kab_kota', '=', 'Kabupaten Sragen')
                ->orWhere('kab_kota', '=', 'Kabupaten Klaten')
                ->orWhere('kab_kota', '=', 'Kabupaten Karanganayar')
                ->orWhere('kab_kota', '=', 'Kota Surakarta')
                ->get();
        }
        elseif ($wilayah == 'bergasmalang'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=', 'Kabupaten Brebes')
                ->orWhere('kab_kota', '=', 'Kabupaten Tegal')
                ->orWhere('kab_kota', '=', 'Kabupaten Pemalang')
                ->orWhere('kab_kota', '=', 'Kota Tegal')
                ->get();
        }
        elseif ($wilayah == 'petanglong'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=', 'Kabupaten Pekalongan')
                ->orWhere('kab_kota', '=', 'Kabupaten Batang')
                ->orWhere('kab_kota', '=', 'Kota Pekalongan')
                ->get();
        }
        elseif ($wilayah == 'barlingmascakeb'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=', 'Kabupaten Purbalingga')
                ->orWhere('kab_kota', '=', 'Kabupaten Banyumas')
                ->orWhere('kab_kota', '=', 'Kabupaten Cilacap')
                ->orWhere('kab_kota', '=', 'Kabupaten Kebumen')
                ->orWhere('kab_kota', '=', 'Kabupaten Banjarnegara')
                ->get();
        }
        elseif ($wilayah == 'purwomanggung'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=', 'Kabupaten Purworejo')
                ->orWhere('kab_kota', '=', 'Kabupaten Magelang')
                ->orWhere('kab_kota', '=', 'Kabupaten Temanggung')
                ->orWhere('kab_kota', '=', 'Kabupaten Wonosobo')
                ->orWhere('kab_kota', '=', 'Kota Magelang')
                ->get();
        }
        elseif ($wilayah == 'banglor'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=', 'Kabupaten Rembang')
                ->orWhere('kab_kota', '=', 'Kabupaten Blora')
                ->get();
        }
      /*  elseif ($pma_pmdn == 'all'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', 'LIKE', '%'.$kabkota.'%')
                ->get();
        }
        elseif ($kabkota == 'all'){
            $pma_invest = DB::table('pma_invest_models')
                ->Where('pma_pmdn', 'LIKE', '%'.$pma_pmdn.'%')
                ->get();
        }*/
        else{
            $pma_invest = DB::table('pma_invest_models')
                /*->where('kab_kota', 'LIKE', '%'.$kabkota.'%')*/
                ->Where('pma_pmdn', 'LIKE', '%'.$pma_pmdn.'%')
                ->get();
        }
        return view('wasdal.base.rekap-pma', compact('pma_invest', 'pma_pmdns', 'pma_pmdn'));
    }
    public function gabung(Request $request){
        /*$kab_kotas = DB::table('pma_invest_models')->groupBy('kab_kota')->get();*/
        $pma_pmdns = DB::table('pma_invest_models')->groupBy('pma_pmdn')->get();
        /*$kabkota = $request->input('kab_kota');*/
        $pma_pmdn = $request->input('pma_pmdn');
        $wilayah = $request->input('wilayah');
        //$wilayah = $request->input('wilayah');

        if (($pma_pmdn == 'all')/* and ($kabkota == 'all')*/ and ($wilayah == 'all')){
            $pma_invest = DB::table('pma_invest_models')->get();
        }
        elseif ($wilayah == 'kedungsapur'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=','Kabupaten Kendal')
                ->orWhere('kab_kota', '=', 'Kabupaten Demak')
                ->orWhere('kab_kota', '=', 'Kabupaten Semarang')
                ->orWhere('kab_kota', '=', 'Kabupaten Grobogan')
                ->orWhere('kab_kota', '=', 'Kota Semarang')
                ->orWhere('kab_kota', '=', 'Kota Salatiga')
                ->get();
        }
        elseif ($wilayah == 'wanarakuti'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=', 'Kabupaten Jepara')
                ->orWhere('kab_kota', '=', 'Kabupaten Kudus')
                ->orWhere('kab_kota', '=', 'Kabupaten Pati')
                ->get();
        }
        elseif ($wilayah == 'subosukowonosraten'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=', 'Kabupaten Sukoharjo')
                ->orWhere('kab_kota', '=', 'Kabupaten Boyolali')
                ->orWhere('kab_kota', '=', 'Kabupaten Wonogiri')
                ->orWhere('kab_kota', '=', 'Kabupaten Sragen')
                ->orWhere('kab_kota', '=', 'Kabupaten Klaten')
                ->orWhere('kab_kota', '=', 'Kabupaten Karanganayar')
                ->orWhere('kab_kota', '=', 'Kota Surakarta')
                ->get();
        }
        elseif ($wilayah == 'bergasmalang'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=', 'Kabupaten Brebes')
                ->orWhere('kab_kota', '=', 'Kabupaten Tegal')
                ->orWhere('kab_kota', '=', 'Kabupaten Pemalang')
                ->orWhere('kab_kota', '=', 'Kota Tegal')
                ->get();
        }
        elseif ($wilayah == 'petanglong'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=', 'Kabupaten Pekalongan')
                ->orWhere('kab_kota', '=', 'Kabupaten Batang')
                ->orWhere('kab_kota', '=', 'Kota Pekalongan')
                ->get();
        }
        elseif ($wilayah == 'barlingmascakeb'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=', 'Kabupaten Purbalingga')
                ->orWhere('kab_kota', '=', 'Kabupaten Banyumas')
                ->orWhere('kab_kota', '=', 'Kabupaten Cilacap')
                ->orWhere('kab_kota', '=', 'Kabupaten Kebumen')
                ->orWhere('kab_kota', '=', 'Kabupaten Banjarnegara')
                ->get();
        }
        elseif ($wilayah == 'purwomanggung'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=', 'Kabupaten Purworejo')
                ->orWhere('kab_kota', '=', 'Kabupaten Magelang')
                ->orWhere('kab_kota', '=', 'Kabupaten Temanggung')
                ->orWhere('kab_kota', '=', 'Kabupaten Wonosobo')
                ->orWhere('kab_kota', '=', 'Kota Magelang')
                ->get();
        }
        elseif ($wilayah == 'banglor'){
            $pma_invest = DB::table('pma_invest_models')
                ->where('kab_kota', '=', 'Kabupaten Rembang')
                ->orWhere('kab_kota', '=', 'Kabupaten Blora')
                ->get();
        }
        /*  elseif ($pma_pmdn == 'all'){
              $pma_invest = DB::table('pma_invest_models')
                  ->where('kab_kota', 'LIKE', '%'.$kabkota.'%')
                  ->get();
          }
          elseif ($kabkota == 'all'){
              $pma_invest = DB::table('pma_invest_models')
                  ->Where('pma_pmdn', 'LIKE', '%'.$pma_pmdn.'%')
                  ->get();
          }*/
        else{
            $pma_invest = DB::table('pma_invest_models')
                /*->where('kab_kota', 'LIKE', '%'.$kabkota.'%')*/
                ->Where('pma_pmdn', 'LIKE', '%'.$pma_pmdn.'%')
                ->get();
        }

        return view('wasdal.base.gabung', compact('pma_invest', 'pma_pmdns', 'pma_pmdn'));
    }
}
