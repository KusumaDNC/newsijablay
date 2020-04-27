<?php

namespace App\app\Models\All;

use Illuminate\Database\Eloquent\Model;

class PokModel extends Model
{
    protected $table = 'pok_models';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public function targets()
    {
        return $this->belongsTo('App\Models\Sekretariat\TargetRealisasiModel');
    }
    public function rko()
    {
        return $this->belongsTo('App\Models\Sekretariat\RkoModel', 'rko_id');
    }
}
