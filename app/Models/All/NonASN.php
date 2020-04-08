<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class NonASN extends Model
{
    protected $table = 'non_asn';

    public function pangkat()
    {
        return $this->hasOne(PangkatModel::class, 'gol', 'gol');
    }

    public function iki()
    {
        return $this->hasMany(PivotName::class, 'data_asn_models_id');
    }
}
