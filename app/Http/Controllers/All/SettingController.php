<?php

namespace App\Http\Controllers\All;

use App\Models\PD\NumberModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function setting(){

        $user = Auth::user()->id;
        $id = Auth::user();
        $nomor = NumberModel::all()->where('user_id', '=', $user);

        return view('all.base.setting', compact('user', 'id', 'nomor'));
    }
}
