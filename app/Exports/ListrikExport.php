<?php

namespace App\Exports;

use App\Models\EKSTERNAL\ListrikModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class ListrikExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        return ListrikModel::all();
    }
}
