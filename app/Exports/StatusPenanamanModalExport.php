<?php

namespace App\Exports;

use App\Models\EKSTERNAL\StatusPenanamanModalModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class StatusPenanamanModalExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        return StatusPenanamanModalModel::all();
    }
}
