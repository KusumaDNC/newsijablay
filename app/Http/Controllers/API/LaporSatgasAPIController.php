<?php

namespace App\Http\Controllers\API;

use App\Models\PPL\RekapPengaduanModels;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporSatgasAPIController extends Controller
{
    public function LaporSatgas(Request $request)
    {
        $tanggal = $request->input('tanggal');
        $nama = $request->input('nama');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $media = $request->input('media');
        $jenis_layanan = $request->input('layanan');
        $no_telp = $request->input('no_telp');
        $sektor = $request->input('sektor');
        $wa_email = $request->input('wa_email');
        $rincian_aduan = $request->input('rincian_aduan');
        $penyelesaian = $request->input('penyelesaian');

        $post = new RekapPengaduanModels();
        $post->tanggal = $tanggal;
        $post->nama = $nama;
        $post->jenis_kelamin = $jenis_kelamin;
        $post->media = $media;
        $post->jenis_layanan = $jenis_layanan;
        $post->no_telp = $no_telp;
        $post->sektor = $sektor;
        $post->wa_email = $wa_email;
        $post->rincian_aduan = $rincian_aduan;
        $post->penyelesaian = $penyelesaian;
        //dd($post);
        $post->save();
    }

}
