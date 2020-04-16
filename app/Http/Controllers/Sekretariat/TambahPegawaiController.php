<?php

namespace App\Http\Controllers\Sekretariat;

use App\Models\Sekretariat\TambahPegawaiModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TambahPegawaiController extends Controller
{
    public function showForm(){
        return view('sekretariat.base.tambah-pegawai');
    }

    public function addpegawai(Request $request){

        $this->validate($request, [
            'nama' => 'required',
            'ttl' => 'required',
            'alamat' => 'required',
            'unit_kerja' => 'required',
            'nip' => 'required',
            'gol' => 'required',
            'jabatan' => 'required',
        ]);

        $nama = $request->input('nama');
        $ttl = $request->input('ttl');
        $alamat = $request->input('alamat');
        $unit_kerja = $request->input('unit_kerja');
        $nip = $request->input('nip');
        $gol = $request->input('gol');
        $jabatan = $request->input('jabatan');

        $t = new TambahPegawaiModel();
        $t->nama = $nama;
        $t->ttl = $ttl;
        $t->alamat = $alamat;
        $t->unit_kerja = $unit_kerja;
        $t->nip = $nip;
        $t->gol = $gol;
        $t->jabatan = $jabatan;

       // dd($t);
        return view('sekretariat.base.tambah-pegawai', compact('t'));
    }
}
