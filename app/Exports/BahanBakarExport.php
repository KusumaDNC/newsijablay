<?php

namespace App\Exports;

use App\Models\EKSTERNAL\BahanBakarModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class BahanBakarExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;
    public function collection()
    {
        return BahanBakarModel::all();
    }
}
