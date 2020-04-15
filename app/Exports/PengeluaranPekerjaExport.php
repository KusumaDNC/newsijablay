<?php

namespace App\Exports;

use App\Models\EKSTERNAL\PengeluaranPekerjaModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengeluaranPekerjaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        return PengeluaranPekerjaModel::all();
    }
}
