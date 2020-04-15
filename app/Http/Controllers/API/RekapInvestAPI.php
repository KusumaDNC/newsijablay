<?php

namespace App\Http\Controllers\API;

use App\Models\Wasdal\PMAInvestModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class RekapInvestAPI extends Controller
{
    public function index(){
        $t = Input::only('data');
        foreach ($t as $item){
        }
        if ($item == 'RekapInvest'){
            $RekapInvest = PMAInvestModel::all();
        }
        else{
            echo "Error";
        }
        return response()->json($RekapInvest);
    }
}
