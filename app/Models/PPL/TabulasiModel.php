<?php

namespace App\Models\PPL;

use Illuminate\Database\Eloquent\Model;

class TabulasiModel extends Model
{
    protected $table = 'rekap_pengaduan_models';
    protected $fillable= ['id'];
    public $timestamps = true;

    public function media (){
        $this->belongsTo(MediaModel::class,'id');
    }

    public function layanan(){
        $this->belongsTo(LayananModel::class,'id');

    }
}
