<?php

namespace App\Exports;

use App\Models\EKSTERNAL\LokerModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataLokerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        return LokerModel::all();
    }
}
