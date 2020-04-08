<?php

namespace App\Models\PD;

use Illuminate\Database\Eloquent\Model;

class AdvanceSpt extends Model
{
    protected $table = 'advance_spt';

    public $timestamps = true;

    protected $casts = ['pelaksana' => 'array'];


}
