<?php

namespace App\Models\EKSTERNAL;

use Illuminate\Database\Eloquent\Model;

class EksporImporModel extends Model
{
    protected $table = 'ekspor_impor_models';

    protected $primaryKey = 'id';


    public function scopeFilter($query, $from_tahun, $to_tahun, $volume, $komoditi){
        return $query->when(!is_null('tahun'), function ($query) use($from_tahun, $to_tahun){
           if($from_tahun != null && $to_tahun != null){
               return $query->whereBetween('tahun', [$from_tahun, $to_tahun]);
           }
        })->when(!is_null('jenis_volume'), function ($query) use($volume){
           if($volume != null){
               return $query->where('jenis_volume', $volume);
           }
        })->when(!is_null('jenis_komoditi'), function ($query) use($komoditi){
           if($komoditi != null){
               return $query->where('jenis_komoditi', $komoditi);
           }
        });
    }
}
