<?php

namespace App\Exports;

use App\Models\EKSTERNAL\BahanBakarModel;
use App\Models\EKSTERNAL\BayarPekerjaModel;
use App\Models\EKSTERNAL\EksporImporModel;
use App\Models\EKSTERNAL\KepemilikanModalModel;
use App\Models\EKSTERNAL\ListrikModel;
use App\Models\EKSTERNAL\NegaraTujuanModel;
use App\Models\EKSTERNAL\PelabuhanModel;
use App\Models\EKSTERNAL\PengeluaranPekerjaModel;
use App\Models\EKSTERNAL\PengeluaranPerusahaanModel;
use App\Models\EKSTERNAL\StatusPenanamanModalModel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class  ExporImporExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */


    use Exportable;
    public function collection()
    {
        return EksporImporModel::all();
    }



}
