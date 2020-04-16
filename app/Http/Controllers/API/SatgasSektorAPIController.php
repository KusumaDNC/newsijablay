<?php

namespace App\Http\Controllers\API;

use App\Models\Yanzin\SektorModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SatgasSektorAPIController extends Controller
{
    public function satgas(){
        $sektor = SektorModel::all();

        return $sektor->toJson();
    }
}
