<?php

namespace App\Models\Sekretariat;

use Illuminate\Database\Eloquent\Model;

class TargetRealisasiModel extends Model
{
    protected $table = 'target_realisasi_models';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public function rko()
    {
        return $this->belongsTo('App\Models\Sekretariat\RkoModel', 'rko_id');
    }
    public function pok()
    {
        return $this->belongsTo('App\Models\All\PokModel');
    }
    public function rkos()
    {
        return $this->hasOne(RkoModel::class);
    }
}
