<?php

namespace App\Exports;

use App\Models\EKSTERNAL\NilaiPendapatanPerusahaanModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class NilaiPendapatanPerusahaanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        return NilaiPendapatanPerusahaanModel::all();
    }
}
