<?php

namespace App\Models\All;

use App\Models\Sekretariat\DataAsnModel;
use Illuminate\Database\Eloquent\Model;

class Notulens extends Model
{
    public function pengampu()
    {
        return $this->belongsTo(DataAsnModel::class, 'pengampu_keg_id');
    }

    public function pemimpin()
    {
        return $this->belongsTo(DataAsnModel::class, 'pemimpin_rpt');
    }
    public function notulis()
    {
        return $this->belongsTo(DataAsnModel::class, 'notulis_id');
    }
    public function notulisnon()
    {
        return $this->belongsTo(NonASN::class, 'notulis_id');
    }
}
