<?php

namespace App\Models\Yanzin;

use Illuminate\Database\Eloquent\Model;

class SOPPelayananModel extends Model
{
    protected $table = 'sop_pelayanan_models';

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function rekap(){
        return $this->belongsTo('App\Models\Yanzin\RekapPerizinanModel');
    }
}
