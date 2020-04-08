<?php

namespace App\Models\PD;

use App\Models\PangkatModel;
use App\Models\Sekretariat\DataAsnModel;
use App\Models\Sekretariat\RekModel;
use App\PivotName;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SptModel extends Model
{
    use SoftDeletes;
    protected $table = 'spt';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $casts = [
        'data_asn_models_id' => 'array',
        'tujuan' => 'array'
    ];

    protected $dates = ['deleted_at'];

    public function names()
    {
        return $this->belongsTo(DataAsnModel::class);
    }

    public function pivot()
    {
        return $this->hasMany(PivotName::class, 'spt_id');
    }

    public function reks()
    {
        return $this->belongsTo(RekModel::class, 'rek_id');
    }

    public function pangkat()
    {
        return $this->hasOne(PangkatModel::class, 'gol', 'gol');
    }

}
