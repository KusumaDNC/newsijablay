<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAUth\Exceptions\JWTException;

class APIAuthController extends Controller
{
    public function login(Request $request){
        try{
            $credentials = $request->only('username','password');
            $token = JWTAuth::attempt($credentials);
            if(!$token){
                return response()->json(['sukses'=>false,'pesan'=>'Invalid Credentials'],404 );
            }
        }catch(Exception $e){
            return response()->json(['sukses'=>false,'pesan'=>'Gagal Login'], $e->getStatusCode());
        }
        return response()->json(['sukses'=>true,'pesan'=>'Berhasil Login','token'=>$token],200);
    }

    public function logout(Request $request){
        try{
            $this->validate($request,['token'=> 'required']);
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['sukses' => true,'pesan'=>'Berhasil Log Out']);
        }catch(Exception $e){
            return response()->json(['sukses'=>false, 'pesan'=>'Gagal Logout'], $e->getStatusCode());
        }
    }
}