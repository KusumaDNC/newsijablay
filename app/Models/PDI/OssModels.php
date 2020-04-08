<?php

namespace App\Models\PDI;

use Illuminate\Database\Eloquent\Model;

class OssModels extends Model
{
    protected $table = 'oss_models';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['nib', 'nama_perseroan', 'alamat_pendirian', 'nama_pendaftar', 'telepon_pendaftar', 'email_pendaftar', 'nik', 'daerah', 'jumlah_tki_l', 'jumlah_tki_p', 'kbli', 'bangunan', 'mesin_peralatan', 'mesin_peralatan_impor', 'pembelian_pematangan_tanah', 'investasi_lain', 'jumlah_inventaris', 'modal_kerja', 'jumlah_investasi', 'tanggal_pengajuan_oss', 'tanggal_terbit_oss'];
}
