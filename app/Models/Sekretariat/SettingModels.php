<?php

namespace App\Models\Sekretariat;

use App\Models\PangkatModel;
use Illuminate\Database\Eloquent\Model;

class SettingModels extends Model
{
    public function pangkat()
    {
        return $this->hasOne(PangkatModel::class, 'gol', 'pangkat_kepala');
    }
}
