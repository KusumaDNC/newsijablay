<?php

namespace App\Http\Controllers\Voyager;

use App\Imports\InvestOSSImport;
use Illuminate\Http\Request;
use TCG\Voyager\Http\Controllers\VoyagerBaseController as BaseVoyagerBaseController;

class VoyagerBaseController extends BaseVoyagerBaseController
{
    public function import(Request $request){
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        Excel::import(new InvestOSSImport(), request()->file('file'));

        return redirect()->back()->with('success', 'Data Berhasil di Input');
    }
}
