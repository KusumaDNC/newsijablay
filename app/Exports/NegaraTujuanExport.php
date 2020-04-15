<?php

namespace App\Exports;

use App\Models\EKSTERNAL\NegaraTujuanModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class NegaraTujuanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        return NegaraTujuanModel::all();
    }
}
