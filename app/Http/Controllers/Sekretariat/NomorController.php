<?php

namespace App\Http\Controllers\Sekretariat;

use App\Imports\ArsipNomorImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;


class NomorController extends Controller
{
    public function importArsipNomor(){
        //dd(public_path('import/klasifikasi2019.xlsx'));
        return view('import');
    }

    public function postimportArsipNomor(Request $request){
        //dd($request->all());
       // dd($request->import);
        $file = $request->import;
        //dd($file);
        Excel::import(new ArsipNomorImport, $file);

        return 'done';
    }
}
