<?php

namespace App\Http\Controllers\API;

use App\Models\PDI\OssModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RekapOssAPI extends Controller
{
    public function index(){
        $rekoss = OssModels::all();
        return response()->json(['data'=>$rekoss]);
    }
}
