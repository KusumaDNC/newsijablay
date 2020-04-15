<?php

namespace App\Exports;

//use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\PPL\LayananModel;
use App\Models\PPL\MediaModel;
use App\Models\PPL\RekapPengaduanModels;
use App\Models\Yanzin\SektorModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromView;

class PengaduanExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $user_name = Auth::user()->name;
        $medias = MediaModel::all();
        $layanans = LayananModel::all();
        $sektors = SektorModel::all();
        return view('ppl.content.rekap-pengaduan', [
            'rek_pengaduan' => RekapPengaduanModels::all()
        ], compact('user_name','medias','layanans','sektors'));
    }
}
