<?php

namespace App\Exports;

use App\app\Models\All\PokModel;
use App\Models\Promosi\KemitraanModel;
use App\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $user_name = Auth::user()->name;

        return view('promosi.content.rekap-kemitraan', [
            'mitra' => KemitraanModel::all()
        ], compact('user_name'));
    }
}