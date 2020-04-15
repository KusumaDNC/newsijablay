<?php

namespace App\Http\Controllers\Admin;

use App\Models\PD\SptModel;
use App\Models\Sekretariat\DataAsnModel;
use App\PivotName;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RekapController extends Controller
{
    public function showRekap(){

        $namas = DataAsnModel::pluck('id', 'nama');
        $namanya = DataAsnModel::all()->sortBy('');
        //dd($namas);
        $piv = PivotName::all();

        foreach ($piv as $p){
            //dd($p->namad);
        }

        foreach ($namanya as $nn){
            //dd($nn->iki);
        }

    return view('admin.report.base.base-spt',  compact('namanya', 'namas', 'piv'));
    }
}
