<?php

namespace App\Models\Sekretariat;

use App\Models\PangkatModel;
use Illuminate\Database\Eloquent\Model;

class PLTModel extends Model
{
    public function plt()
    {
        return $this->belongsTo(DataAsnModel::class, 'data_asn_models_id');
    }
    public function pangkat()
    {
        return $this->hasOne(PangkatModel::class, 'gol', 'gol_id');
    }
}
