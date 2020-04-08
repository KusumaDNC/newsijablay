<?php

namespace App\Models\Yanzin;

use Illuminate\Database\Eloquent\Model;

class JenisIzinModel extends Model
{
    protected $table = 'jenis_izin_models';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function sektor(){
        return $this->belongsTo('App\Models\Yanzin\SektorModel');
    }

    public function SOP(){
        return $this->belongsTo('App\Models\Yanzin\SOPPelayananModel');
    }
}
