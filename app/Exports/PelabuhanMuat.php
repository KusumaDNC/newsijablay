<?php

namespace App\Exports;

use App\Models\EKSTERNAL\PelabuhanModel;
use App\pelabuhan_models;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class PelabuhanMuat implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    public function collection()
    {
        return PelabuhanModel::all();
    }
}
