<?php

namespace App\Http\Controllers\API;

use App\Models\Yanzin\SektorModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SatgasAPIController extends Controller
{
    public function satgas(){
        $satgas = SektorModel::all()->pluck('id','nama_sektor');

        return response($satgas, 200)->header('Content-Type', 'application/json');
    }
}
