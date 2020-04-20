<?php

namespace App;

use App\Models\All\NonASN;
use App\Models\PD\SptModel;
use App\Models\Sekretariat\DataAsnModel;
use Illuminate\Database\Eloquent\Model;

class PivotName extends Model
{
    protected $table = 'asn_spt';

    public $timestamps = false;


    public function namad()
    {
        return $this->belongsTo(DataAsnModel::class, 'data_asn_models_id');
    }
    public function naman()
    {
        return $this->belongsTo(NonASN::class, 'non_asn_id');
    }
}
