<?php

namespace App\Exports;

use App\Models\EKSTERNAL\NilaiTambahPerusahaanModel;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class NilaiTambahPerusahaanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        return NilaiTambahPerusahaanModel::all();
    }
}
