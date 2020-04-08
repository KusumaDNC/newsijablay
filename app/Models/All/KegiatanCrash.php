<?php

namespace App\Models\All;

use Illuminate\Database\Eloquent\Model;

class KegiatanCrash extends Model
{
    protected $table = 'kegiatan_crashes';
    public $timestamps = true;

    public function keg(){
        return $this->belongsTo(KegiatanModels::class, 'kegiatan_id');
    }

}
