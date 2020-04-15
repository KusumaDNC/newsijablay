<?php

namespace App\Http\Controllers\All;

use App\Models\All\Bidang;
use App\Models\Bidang\BidangModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AllBidangController extends Controller
{
    public function showForm(){
        $user = Auth::user()->name;

        return view('all.base.allbidang', compact('user'));
    }

    public function postForm(Request $request){
        $this->validate($request,[
            'nama_dok' => 'required',
            'bulan' => 'required',
            'ket' => 'required',
            'dok' => 'required',
        ]);

        if ($request->hasFile('dok')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('dok')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('dok')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('dok')->storeAs('/', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }
        $nama_dok = $request->input('nama_dok');
        $user = Auth::user()->name;
        $bulan = $request->input('bulan');
        $ket = $request->input('ket');

        $store = new BidangModel();
        $store->nama_dok = $nama_dok;
        $store->bidang = $user;
        $store->bulan = $bulan;
        $store->dok = $fileNameToStore;
        $store->ket = $ket;
        $store->save();

        return redirect()->back()->with('success', 'Data Berhasil diInput');
    }

    public function rekap(){
        $user = Auth::user()->username;
        $allbidang = BidangModel::all();
        //dd($allbidang);
        return view('all.base.rekap-allbidang', compact('user','allbidang'));
    }

    public function pdfview($id)
    {
        $allbidang = BidangModel::find($id);
        $download = $allbidang->dok;
        dd($download);

        return Storage::download($download);
    }
}
