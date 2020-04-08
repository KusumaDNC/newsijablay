<?php

namespace App\Models\Yanzin;

use Illuminate\Database\Eloquent\Model;

class RekapPerizinanModel extends Model
{
    protected $table = 'rekap_perizinan_models';

    protected $primaryKey = 'id';
    public $timestamps = false;

    public function sop(){
        return $this->belongsTo('App\Models\Yanzin\SOPPelayananModel');
    }
}
