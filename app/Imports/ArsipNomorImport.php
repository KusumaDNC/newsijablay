<?php

namespace App\Imports;

use App\Models\Sekretariat\ArsipNomor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ArsipNomorImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row){
            $arsep = ArsipNomor::where('kode', $row[0])->first();
            //dd($rows[1]);
            if (!isset($arsep)){
                ArsipNomor::create([
                    'kode' => $row[0],
                    'desc' => $row[1]
                ]);
            }
        }

    }

    /**
     * @return int
     */
    public function batchSize(): int
    {
        return 5;
    }
}
