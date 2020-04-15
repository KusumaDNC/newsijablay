<?php

namespace App\Exports;

use App\Models\EKSTERNAL\UmrModels;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataUmrExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        return UmrModels::all();
    }
}
