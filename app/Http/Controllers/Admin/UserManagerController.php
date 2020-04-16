<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\User;
use App\Models\Admin\Role;
use App\Http\Controllers\Controller;
use App\LogActivity as LogActivityModel;

class UserManagerController extends Controller
{
    public function index()
    {
    	$users=User::all();
		return view('admin.user_manager')->with('users', $users);
    }
     public function ShowAddUser()
    {
        $roles = Role::all();
        //dd($roles);
    	return view('admin.add_user', compact('roles'));
    }
    public function store(Request $request){

        //dd($request->all());
        $user = new User();
        $user->name=$request->input('name');
        $user->username=$request->input('username');
        $user->password=$user->password=$request->input('password')!=''?bcrypt($request->input('password')):'';

        $user->save();
        $user->roles()->attach($request->input('role_id'));

        //dd($user);
        //LogActivity::addToLog('Menambah User Baru');

        // if($user->save()){
        //     $kategori='success';
        //     $pesan="Tersimpan";
        // }else{
        //     $kategori='error';
        //     $pesan="Gagal";
        // }
        return redirect()->back()->with('data', ['some kind of data']);
    }

    public function edit($id)
    {
        $users = User::find($id);
        $roles = Role::all()->pluck('name', 'id');
        return view('admin.edit', compact('users', 'roles'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());

        $user = User::find($id);
        $userUpdate = $request->only(['name', 'username', 'password']);
        $userUpdate['password'] = $request->input('password')!=''?bcrypt($request->input('password')):'';

        //dd($userUpdate);
        $user->update($userUpdate);
        \DB::table('role_users')
            ->where('user_id', User::find($id)->id)
            ->update(['role_id' => $request->role_id]);

        return redirect('users')->with('status', 'Profile updated!');

    }

    public function destroy($id)
    {
        $users = User::find($id);
        $users->delete();
        \LogActivity::addToLog('Menghapus User');
        return redirect('users');



    }



}
