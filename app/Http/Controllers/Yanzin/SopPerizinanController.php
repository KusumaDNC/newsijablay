<?php

namespace App\Http\Controllers\Yanzin;

use App\Models\Yanzin\JenisIzinModel;
use App\Models\Yanzin\SOPPelayananModel;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\PD\NumberModel;

class SopPerizinanController extends Controller
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
    public function store(Request $request){
        $user = Auth::user()->id;
        $sops = $request->sops;

        foreach ($sops as $item){
            $store = new SOPPelayananModel();
            $store->jenis_izin_id = $item['jenis_izin'];
            $store->sop = $item['sop'];
            $store->save();
        }

        return redirect()->back()->with('success', 'Data SOP Berhasil di Input');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(){
        //$dropdown = JenisIzinModel::all();
        $rekap_sop = SOPPelayananModel::all();

        return view('yanzin.base.set-sop', compact( 'rekap_sop'));
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
    public function update(Request $request)
    {
        $sops = $request->sops;

        foreach ($sops as $item){
            $store = SOPPelayananModel::findOrFail($item['id']);
            $store->jenis_izin_id = $item['jenis_izin'];
            $store->sop = $item['sop'];
            $store->update();
        }
        //dd($store);

        return redirect()->back()->with('success', 'Data SOP Berhasil di Input');
        /*foreach ($request->sops as $key => $sop){
            $store = SOPPelayananModel::get();
            $store->jenis_izin_id = $request->jenis_izin[$key];
            $store->sop = $request->sop[$key];
            //$store->update(['jenis_izin' => $request->jenis_izin[$key], 'sop' => $request->sop[$key]]);
            echo "$store";
            //$store->update();
        }*/
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

    public function gabung(){
        $dropdown = JenisIzinModel::all();
        $user = Auth::user()->id;
        $id = Auth::user();
        $nomor = NumberModel::all()->where('user_id', '=', $user);

        return view('yanzin.base.gabung', compact('dropdown', 'user', 'id', 'nomor'));
    }
}
