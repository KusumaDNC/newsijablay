<?php

namespace App\Http\Controllers\PDI;

use App\app\Models\PDI\JenisFileOss;
use App\Exports\DataOSSExport;
use App\Imports\InvestOSSImport;
use App\Models\All\KabKotaModels;
use App\Models\PDI\OssModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class RekapOSSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$jenis_file = JenisFileOss::all();
        //$kab_kota = KabKotaModels::all();
        //dd($jenis_file);
        return view('pdi.base.form-rek-oss');
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
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        Excel::import(new InvestOSSImport(), request()->file('file'));

        return redirect()->back()->with('success', 'Data Berhasil di Input');
    }

    public function rekap(Request $request){
        $kabkotas = KabKotaModels::all();
        $kabkota = $request->input('kab_kota');
        $status = $request->input('status');
        if ($kabkota == 'all' and $status == 'all'){
            $rek_oss = DB::table('oss_models')->paginate(10);
        }
        elseif ($kabkota == 'all' and $status == 'perorangan'){
            $rek_oss = DB::table('oss_models')
                ->where('nama_perseroan', '=', DB::raw('nama_pendaftar'))
                ->get();
        }
        elseif ($kabkota == 'all' and $status == 'perusahaan'){
            $rek_oss = DB::table('oss_models')
                ->where('nama_perseroan', '!=', DB::raw('nama_pendaftar'))
                ->get();
        }
        else{
            $rek_oss = DB::table('oss_models')
                ->where('daerah', 'LIKE', '%'.$kabkota.'%')
                ->get();
        }


        return view('pdi.base.rek-oss', compact('kabkotas', 'rek_oss'));
    }

    public function export(Request $request){
        return Excel::download(new DataOSSExport(), 'Rekap Data OSS.xlsx');
    }

    public function gabung(Request $request){
        $kabkotas = KabKotaModels::all();
        $kabkota = $request->input('kab_kota');
        if ($kabkota == 'all'){
            $rek_oss = DB::table('oss_models')->paginate(10);
        }
        else{
            $rek_oss = DB::table('oss_models')
                ->where('daerah', 'LIKE', '%'.$kabkota.'%')
                ->get();
        }

        return view('pdi.base.gabung', compact('kabkotas', 'rek_oss'));
    }
}
