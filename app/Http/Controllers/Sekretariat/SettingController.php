<?php

namespace App\Http\Controllers\Sekretariat;

use App\Models\Admin\User;
use App\Models\PangkatModel;
use App\Models\PD\NumberModel;
use App\Models\Sekretariat\PLTModel;
use App\Models\Sekretariat\RekModel;
use App\Models\Sekretariat\RkoModel;
use App\Models\Sekretariat\SettingModels;
use App\Models\Sekretariat\TargetRealisasiModel;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function gabung(Request $request){
        $user = Auth::user()->id;
        //dd($user);
        $bidang = User::whereBetween('id', [2, 8])->get();

        $kepala = DB::table('data_asn_models')
            ->where('jabatan', 'LIKE', 'KEPALA DINAS%')
            ->get();

        //dd(count($kepala));
        $plt = PLTModel::all();
        //dd($plt);


        $kabid = DB::table('data_asn_models')
            ->where('jabatan', 'LIKE', 'KABID%')
            ->orWhere('jabatan', 'LIKE', 'SEKRETARIS')
            ->get();

        $plh = SettingModels::all();

        $rek = RekModel::all();
        $id = Auth::user();
        $nomor = NumberModel::all()->where('user_id', '=', $user);
        $today = date('Y-m');
        $target = TargetRealisasiModel::all();
        $dropdown = RkoModel::all(['nama_kegiatan', 'id']);
        $username = Auth::user()->name;
        $todays = date('F-Y');
        $rek_rko = RkoModel::all();

        $bulan = $request->input('bulan_input');
        $bulans = date('F-Y', strtotime($bulan));
        //dd($bulan);

        //$target = TargetRealisasiModel::all();
        $rko = TargetRealisasiModel::where('bulan', '=', $today)->get();

        return view('sekretariat.base.gabung', compact('user', 'rek_rko', 'bulans', 'kepala', 'plt', 'kabid', 'plh', 'rek', 'id', 'nomor', 'bidang', 'today', 'target', 'dropdown', 'username', 'todays', 'bulan', 'rko'));
    }

    public function plh()
    {

        $user = Auth::user()->id;
        //dd($user);

        $kepala = DB::table('data_asn_models')
                ->where('jabatan', '=', 'KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU')
                ->get();

        //dd(count($kepala));
        $plt = PLTModel::all();
        //dd($plt);

        $kabid = DB::table('data_asn_models')
                ->where('jabatan', 'LIKE', 'KABID%')
                ->orWhere('jabatan', 'LIKE', 'SEKRETARIS')
                ->get();

        $plh = SettingModels::all();

        return view('sekretariat.base.setting-plh', compact('kepala', 'kabid', 'plh', 'plt', 'user'));
    }

    public function plhSet()
{

    $user = Auth::user()->id;
    $kabid = DB::table('data_asn_models')
        ->where('jabatan', 'LIKE', 'KABID%')
        ->orWhere('jabatan', 'LIKE', 'SEKRETARIS')
        ->get();

    $plh = SettingModels::all();

    //dd($kabid);

    return view('sekretariat.base.add-plh', compact( 'kabid', 'plh', 'user'));
}

    public function pltSet()
    {

        $user = Auth::user()->id;
        $kabid = DB::table('data_asn_models')
            ->where('jabatan', 'LIKE', 'KABID%')
            ->orWhere('jabatan', 'LIKE', 'SEKRETARIS')
            ->get();

        $plh = SettingModels::all();

        //dd($kabid);

        return view('sekretariat.base.add-plt', compact( 'kabid', 'plh', 'user'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storePlh(Request $request)
    {
        $user = Auth::user()->id;
        $this->validate($request, [
            'plh' => 'required',
        ]);

        $id = $request->input('plh');

        $kabid = DB::table('data_asn_models')
                ->where('id', '=', $id)
                ->get();
        $pngkt = PangkatModel::all();


        foreach ($kabid as $k){
            $nama = $k->nama;
            $nip = $k->nip;
            $jbt = $k->jabatan;
            $golk = $k->gol;

        }

        $plh = new SettingModels();
        $plh->data_asn_models_id = $id;
        $plh->nama_kepala = $nama;
        $plh->nip_kepala = $nip;
        $plh->pangkat_kepala = $golk;
        $plh->jabatan_kepala = $jbt;
        //dd($plh);
        $plh->save();


        return redirect()->route('get.all', compact('user'))->with('success', 'Terganti');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storePlt(Request $request)
    {
        $user = Auth::user()->id;
        $plt = PLTModel::all();
        $this->validate($request, [
            'plt' => 'required',
        ]);

        $id = $request->input('plt');

        $kabid = DB::table('data_asn_models')
            ->where('id', '=', $id)
            ->get();
        $pngkt = PangkatModel::all();

        //dd($kabid);

        foreach ($kabid as $k){
            $nama = $k->nama;
            $nip = $k->nip;
            $jbt = $k->jabatan;
            $golk = $k->gol;

        }

        $plt = new PLTModel();
        $plt->data_asn_models_id = $id;
        $plt->gol_id = $golk;


        //dd($plt);
        $plt->save();


        return redirect()->route('get.all', compact('user', 'plt'))->with('success', 'Terganti');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPlh($id)
    {
        $user = Auth::user()->id;
        $edit = SettingModels::find($id);
        $kabid = DB::table('data_asn_models')
            ->where('jabatan', 'LIKE', 'KABID%')
            ->orWhere('jabatan', 'LIKE', 'SEKRETARIS')
            ->get();

        return view('sekretariat.base.edit-plh', compact('edit', 'kabid', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePlh(Request $request, $id)
    {
        $user = Auth::user()->id;
        $idedit = $request->input('edit');

        $kabidedit = DB::table('data_asn_models')
            ->where('id', '=', $idedit)
            ->get();

        //dd($kabidedit);

        foreach ($kabidedit as $k){
            $plh = SettingModels::find($id);
            $plh->nama_kepala = $k->nama;
            $plh->nip_kepala = $k->nip;
            $plh->pangkat_kepala = $k->gol; //GET PANGKAT
            $plh->jabatan_kepala = $k->jabatan;
            $plh->data_asn_models_id = $idedit;
            //dd($plh);
            $plh->save();
        }

        return redirect()->route('get.all', compact('user'));
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
    public function delete($id)
    {
        $user = Auth::user()->id;
        $kepala = DB::table('data_asn_models')
            ->where('jabatan', '=', 'KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU')
            ->get();

        $plh = SettingModels::findOrFail($id);
        $plh->delete();

        return redirect()->route('get.all', compact('user'));
    }
}
