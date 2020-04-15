<?php

namespace App\Exports;

use App\Models\EKSTERNAL\PengeluaranPerusahaanModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengeluaranPerusahaanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        return PengeluaranPerusahaanModel::all();
    }
}
