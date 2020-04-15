<?php

namespace App\Imports;

use App\Models\Wasdal\PMAInvestModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PMAInvestImport implements ToModel, withStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    use Importable;

    public function model(array $row)
    {
        return new PMAInvestModel([
            'sektor' => $row[1],
            'nama_perusahaan' => $row[2],
            'cetak_bid_usaha' => $row[3],
            'provinsi' => $row[4],
            'kab_kota' => $row[5],
            'negara' => $row[6],
            'no_izin' => $row[7],
            'tambahan_invest' => $row[8],
            'total_invest' => $row[9],
            'proyek' => $row[10],
            'tki' => $row[11],
            'tka' => $row[12],
            'tahun' => $row[13],
            'pma_pmdn' =>$row[14]
        ]);
    }
    public function startRow(): int
    {
        return 3;
    }

}

