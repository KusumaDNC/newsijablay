<?php

namespace App\Models\Sekretariat;

use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Model;

class PenggunaanNomorModel extends Model
{
    protected $table = 'penggunaan_nomors';

    public function kodenomor(){
        return $this->belongsTo(ArsipNomor::class, 'arsip_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
