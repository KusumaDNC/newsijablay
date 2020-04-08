<?php

namespace App\Models\All;

use App\Models\Admin\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KegiatanModels extends Model
{

    use SoftDeletes;
    protected $dates =['deleted_at'];
    public function bidang(){
        $this->belongsTo(User::class, 'bidang_id');
    }

    public function tempat_keg(){
        $this->belongsTo(TempatKegModels::class, 'tempat');
    }

}
