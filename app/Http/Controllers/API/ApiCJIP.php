<?php

namespace App\Http\Controllers\API;

use App\Models\Wasdal\PMAInvestModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiCJIP extends Controller
{
    public function cjip(){
/*
        $listrik = PMAInvestModel::where('sektor', 'Listrik, Gas dan Air')->get();

        foreach ($listrik as $l){
            if ($l->no_izin == $l->no_izin){
                dump($l->no_izin);
            }
            else {
                echo "nope";
            }
        }
        die();*/
        $realisasisSektor = PMAInvestModel::groupBy('sektor')->selectRaw('count(*) as total, sektor')->get();

        $realisasiLokasi = PMAInvestModel::groupBy('kab_kota')->selectRaw('count(*) as total, kab_kota')->get();

        $realisasiNegara = PMAInvestModel::groupBy('negara')->selectRaw('count(*) as total, negara')->get();

        $realisasiPMA = PMAInvestModel::groupBy('sektor')->selectRaw('sektor, sum(total_invest) as total, pma_pmdn')->where('pma_pmdn', 'PMA')->get();

        $realisasiPMDN = PMAInvestModel::groupBy('sektor')->selectRaw('sektor, sum(total_invest) as total, pma_pmdn')->where('pma_pmdn', 'PMDN')->get();
        //dd(count($realisasiPMA));
        //dd($realisasiPDMN->toJson());

        $reins = [
            'by_sector' => $realisasisSektor,
            'by_lokasi' => $realisasiLokasi,
            'by_country' => $realisasiNegara,
            'pmdn' => $realisasiPMDN,
            'pma' => $realisasiPMA,
        ];
        //dd(json_encode($reins));
        return (json_encode($reins));
    }
}
