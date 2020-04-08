<?php

namespace App\Models\Perencanaan;

use Illuminate\Database\Eloquent\Model;

class RekapPerencanaanModels extends Model
{
    protected $table = "rekap_perencanaan_models";
    protected $primaryKey = 'id';
    protected $fillable = ['file','keterangan'];
}
