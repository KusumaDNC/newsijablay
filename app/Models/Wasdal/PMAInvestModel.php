<?php

namespace App\Models\Wasdal;

use Illuminate\Database\Eloquent\Model;

class PMAInvestModel extends Model
{
    protected $table = 'pma_invest_models';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['sektor', 'nama_perusahaan', 'cetak_bid_usaha', 'provinsi', 'kab_kota', 'negara', 'no_izin', 'tambahan_invest', 'total_invest', 'proyek', 'tki', 'tka', 'tahun', 'pma_pmdn'];
}