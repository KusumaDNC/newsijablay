<?php

namespace App\Models\Sekretariat;

use App\Models\PangkatModel;
use App\PivotName;
use Illuminate\Database\Eloquent\Model;

class DataAsnModel extends Model
{
    protected $table = 'data_asn_models';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public function pangkat()
    {
        return $this->hasOne(PangkatModel::class, 'gol', 'gol');
    }

    public function iki()
    {
        return $this->hasMany(PivotName::class, 'data_asn_models_id');
    }
}
