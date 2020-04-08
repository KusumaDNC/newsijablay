<?php

namespace App\Models\Sekretariat;

use Illuminate\Database\Eloquent\Model;

class TambahPegawaiModel extends Model
{
    protected $table = 'tambah_pegawai';

    public function pangkat()
    {
        return $this->hasOne(PangkatModel::class, 'gol', 'gol');
    }

    public function iki()
    {
        return $this->hasMany(PivotName::class, 'data_asn_models_id');
    }
}
