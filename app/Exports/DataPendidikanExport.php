<?php

namespace App\Exports;

use App\Models\EKSTERNAL\PendidikanModels;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataPendidikanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        return PendidikanModels::all();
    }
}
