<?php

namespace App\Http\Controllers\All;

use App\Models\All\KegiatanCrash;
use App\Models\All\KegiatanModels;
use App\Models\Sekretariat\DataAsnModel;
use App\PivotName;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(){

        $user = Auth::user()->username;
        $namas = DataAsnModel::pluck('id', 'nama');
        $namanya = DataAsnModel::paginate(15);
        //dd($namas);
        $piv = PivotName::all();
        //dd($user);

        $keg = KegiatanModels::whereNotNull('crash')->paginate(6);

        $keg_crash = KegiatanCrash::where('bidang_id', Auth::user()->username)->get();

        foreach ($keg_crash as $s){
            //dd($s->keg);
        }
        //dd($keg_crash);

        return view('home', compact('user', 'namanya', 'keg', 'keg_crash'));
    }
}
