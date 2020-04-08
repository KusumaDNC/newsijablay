<?php

namespace App\Models\Sekretariat;

use Illuminate\Database\Eloquent\Model;

class RkoModel extends Model
{
    protected $table = 'rko_models_baru';

    protected $primaryKey = 'id';

    public $timestamps = true;

    public function targets()
    {
        return $this->hasOne(TargetRealisasiModel::class, 'rko_id');
    }
    public function pok()
    {
        return $this->belongsTo('App\Models\All\PokModel');
    }
}
