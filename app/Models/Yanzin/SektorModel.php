<?php

namespace App\Models\Yanzin;

use Illuminate\Database\Eloquent\Model;

class SektorModel extends Model
{
    protected $table = 'sektor_models';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function jenis(){
        return $this->belongsTo('App\Models\Yanzin\JenisIzinModel');
    }
}
