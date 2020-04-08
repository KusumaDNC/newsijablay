<?php

namespace App\Models\Sekretariat;

use App\Models\PD\SptModel;
use Illuminate\Database\Eloquent\Model;

class RekModel extends Model
{
    public function reks()
    {
        return $this->belongsTo(SptModel::class, 'rek_id');
    }

}
