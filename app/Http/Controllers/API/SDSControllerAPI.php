<?php

namespace App\Http\Controllers\API;

use App\Models\Yanzin\RekapPerizinanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class SDSControllerAPI extends Controller
{
    public function index(){
        $t = Input::only('data');
        //dd($t);
        foreach ($t as $item){
        }
        if ($item == 'RekapInvestasi'){
            $Respon = DB::table('pma_invest_models')->select('id', 'sektor', 'nama_perusahaan', 'cetak_bid_usaha', 'provinsi', 'kab_kota', 'negara', 'tambahan_invest', 'total_invest', 'tahun', 'pma_pmdn')->get();
        }
        elseif ($item == 'RekapPerizinan'){
            $Respon = RekapPerizinanModel::all();
        }
        else{
            echo "Error";
        }
        return response()->json($Respon);
    }
}
