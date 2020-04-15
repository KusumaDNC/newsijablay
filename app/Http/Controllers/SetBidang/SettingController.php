<?php

namespace App\Http\Controllers\SetBidang;

use App\Models\Admin\User;
use App\Models\PD\NumberModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function getNo(){
        $user = Auth::user()->id;
        $nomor = NumberModel::all()->where('user_id', '=', $user);
        //dd($nomor);

        return view('setBidang.base.set-base', compact('nomor'));
    }

    /**
     * @param Request $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postNo(Request $request){
        $this->validate($request, [
            'no_spt' => 'required',
            'no_sppd' => 'required',
        ]);

        $id = Auth::user()->id;
        //dd($id);
        $post = new NumberModel();
        $post->no_spt = $request->no_spt;
        $post->no_sppd = $request->no_sppd;
        $post->user_id = $id;
        ///dd($post);
        $post->save();

        return redirect()->back()->with('success', 'Nomor SPT dan SPPD terakhir telah berhasil terekam');

    }

    public function showEditUsername(){
        $id = Auth::user();
        //dd($id);
        return view('setBidang.base.edit-user', compact('id'));
    }

    public function editUsername(Request $request, $id){
        $user = User::find($id);
        $userUpdate = $request->only(['username', 'password']);
        $userUpdate['password'] = $request->input('password')!=''?bcrypt($request->input('password')):'';

        //dd($userUpdate);
        $user->update($userUpdate);
        \DB::table('users')
            ->where('id', $user->id)
            ->update(['username' => $request->input('username'),
                    'password' => $userUpdate['password']
                ]);

        return redirect()->back();
    }
}
