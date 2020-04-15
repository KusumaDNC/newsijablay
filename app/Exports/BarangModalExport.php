<?php

namespace App\Exports;

use App\Models\EKSTERNAL\BarangModalTetapModels;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class BarangModalExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        return BarangModalTetapModels::all();
    }
}
