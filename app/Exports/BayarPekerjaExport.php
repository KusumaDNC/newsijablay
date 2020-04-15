<?php

namespace App\Exports;

use App\Models\EKSTERNAL\BayarPekerjaModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class BayarPekerjaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    Use Exportable;
    public function collection()
    {
        return BayarPekerjaModel::all();
    }
}
