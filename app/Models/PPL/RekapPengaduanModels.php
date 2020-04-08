<?php

namespace App\Models\PPL;

use App\Models\PPL\MediaModel;
use App\Models\Yanzin\SektorModel;
use Illuminate\Database\Eloquent\Model;

class RekapPengaduanModels extends Model
{
    public function sektorRelation(){
        return $this->belongsTo(SektorModel::class, 'sektor');
    }

    public function layananRelation(){
        return $this->belongsTo(LayananModel::class, 'jenis_layanan');
    }

    public function mediaRelation(){
        return $this->belongsTo(MediaModel::class, 'media');
    }

}
