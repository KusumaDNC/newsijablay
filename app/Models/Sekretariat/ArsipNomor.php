<?php

namespace App\Models\Sekretariat;

use Illuminate\Database\Eloquent\Model;

class ArsipNomor extends Model
{
    protected $table = 'arsip_nomors';

    public $timestamps = false;

    protected $fillable = ['kode', 'desc'];
}
