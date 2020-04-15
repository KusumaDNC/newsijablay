<?php

namespace App\Exports;

use App\Models\Yanzin\RekapPerizinanModel;
use App\User;
//use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PerizinanExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        //$user_name = strtoupper(Auth::user()->name);
        $todays = strtoupper(date("F"));
        $today = date("Y-m");
        //$query = "CAST(rko_id AS int)ASC";

        return view('yanzin.content.rekap-perizinan', [
            'rekap' => RekapPerizinanModel::all()
        ], compact('todays', 'today'));
    }
}
