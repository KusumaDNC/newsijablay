<?php

namespace App\Models\Sekretariat;

use App\app\Models\All\PokModel;
use Illuminate\Database\Eloquent\Model;

class SubMenuKegiatanModels extends Model
{
    protected $table = 'sub_menu_kegiatan_models_baru';

    protected $primaryKey = 'id';

    public function pok()
    {
        return $this->belongsTo(RkoModel::class,'rko_id');
    }
}
