<?php

namespace App\Http\Controllers\API;

use App\Models\Yanzin\RekapPerizinanModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class RekapPerizinanAPI extends Controller
{
    public function index(){
        $t = Input::only('data');
        foreach ($t as $item){
        }
        if ($item == 'RekapPerizinan'){
            $RekapPerizinan = RekapPerizinanModel::all();
        }
        else{
            echo "Error";
        }
        return response()->json($RekapPerizinan);
    }
}
