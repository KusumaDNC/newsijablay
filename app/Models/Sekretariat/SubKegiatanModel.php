<?php

namespace App\Models\Sekretariat;

use Illuminate\Database\Eloquent\Model;

class SubKegiatanModel extends Model
{
    public $table = "sub_kegiatan_models";
    public $fillable = ['nama_sub_keg', 'jml_anggaran_sub', 'rko_id'];
}
