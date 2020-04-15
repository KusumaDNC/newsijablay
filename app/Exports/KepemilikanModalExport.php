<?php

namespace App\Exports;

use App\Models\EKSTERNAL\KepemilikanModalModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class KepemilikanModalExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    public function collection()
    {
        return KepemilikanModalModel::all();
    }
}
