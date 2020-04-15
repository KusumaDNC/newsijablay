<?php

namespace App\Exports;

use App\Models\EKSTERNAL\SelisihStokAwalModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class SelisihStokExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    Use Exportable;
    public function collection()
    {
        return SelisihStokAwalModel::all();
    }
}
