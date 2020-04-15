<?php

namespace App\Exports;

//use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\All\KabKotaModels;
use App\Models\PDI\OssModels;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class DataOSSExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $kabkotas = KabKotaModels::all();

        return view('pdi.content.rek-oss', [
            'rek_oss' => OssModels::all()
        ], compact('kabkotas'));
    }
}
