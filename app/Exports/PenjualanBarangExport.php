<?php

namespace App\Exports;

use App\Models\EKSTERNAL\PenjualanBarangModalModels;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class PenjualanBarangExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        return PenjualanBarangModalModels::all();
    }
}
