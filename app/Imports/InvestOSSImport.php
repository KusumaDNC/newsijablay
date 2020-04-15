<?php

namespace App\Imports;

use App\Models\PDI\OssModels;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class InvestOSSImport implements ToModel, withStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable;

    public function model(array $row)
    {
            return new OssModels([
                'nib' => $row[0],
                'nama_perseroan' => $row[1],
                'alamat_pendirian' => $row[2],
                'nama_pendaftar' => $row[3],
                'telepon_pendaftar' => $row[4],
                'email_pendaftar' => $row[5],
                'nik' => $row[6],
                'daerah' => $row[7],
                'jumlah_tki_l' => $row[8],
                'jumlah_tki_p' => $row[9],
                'kbli' => $row[10],
                'bangunan' => $row[11],
                'mesin_peralatan' => $row[12],
                'mesin_peralatan_impor' => $row[13],
                'pembelian_pematangan_tanah' => $row[14],
                'investasi_lain' => $row[15],
                'jumlah_inventaris' => $row[16],
                'modal_kerja' => $row[17],
                'jumlah_investasi' => $row[18],
                'tanggal_pengajuan_oss' => $row[19],
                'tanggal_terbit_oss' => $row[20]
            ]);
    }
    public function startRow(): int
    {
        return 2;
    }

}
