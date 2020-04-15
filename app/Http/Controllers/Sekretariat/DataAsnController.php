<?php

namespace App\Http\Controllers\Sekretariat;

use App\Models\Sekretariat\DataAsnModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function MongoDB\BSON\fromJSON;

class DataAsnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    /**
     * @param Request $request
     */
    public function simpeg(Request $request)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://simpeg.bkd.jatengprov.go.id/rest/pns/F0");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $decode = json_decode($result);

        foreach ($decode as $d){
            $nip_to_store = $d->nip;
            $nama_to_store = $d->nama;
            $tgl_lahir_to_store = $d->tgl_lahir;
            $gol_to_store = $d->gol;
            $jabatan_to_store = $d->jabatan;
            $kode_lokasi_to_store = $d->kode_lokasi;


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://simpeg.bkd.jatengprov.go.id/webservice/identitas");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "nip=".$d->nip."");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            $json = json_decode($result);


                $post = new DataAsnModel();
                $post->nip = $nip_to_store;
                $post->nama = $nama_to_store;
                $post->tgl_lahir = $tgl_lahir_to_store;
                $post->gol = $gol_to_store;
                $post->jabatan = $jabatan_to_store;
                $post->kode_lokasi = $kode_lokasi_to_store;
                $post->tmp_lahir = $json->tmp_lahir;
                $post->email = $json->email;
                $post->alamat = $json->alamat;
                $post->pendidikan = $json->pendidikan;
                $post->unit_kerja = $json->unitkerja;
                $post->hp = $json->hp;

                //dd($post);
                $post->save();
        }
        return ('uploaded');

    }

    public function updatesimpeg(Request $request, $nip)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://simpeg.bkd.jatengprov.go.id/rest/pns/F0");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        $decode = json_decode($result);

        foreach ($decode as $d){
            $nip_to_store = $d->nip;
            $nama_to_store = $d->nama;
            $tgl_lahir_to_store = $d->tgl_lahir;
            $gol_to_store = $d->gol;
            $jabatan_to_store = $d->jabatan;
            $kode_lokasi_to_store = $d->kode_lokasi;


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "http://simpeg.bkd.jatengprov.go.id/webservice/identitas");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "nip=".$d->nip."");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            $json = json_decode($result);


            $post = DataAsnModel::findOrFail($nip);
            $post->nip = $nip_to_store;
            $post->nama = $nama_to_store;
            $post->tgl_lahir = $tgl_lahir_to_store;
            $post->gol = $gol_to_store;
            $post->jabatan = $jabatan_to_store;
            $post->kode_lokasi = $kode_lokasi_to_store;
            $post->tmp_lahir = $json->tmp_lahir;
            $post->email = $json->email;
            $post->alamat = $json->alamat;
            $post->pendidikan = $json->pendidikan;
            $post->unit_kerja = $json->unitkerja;
            $post->hp = $json->hp;

            dd($post);
            //$post->update();
        }
        return ('uploaded');

    }
}
