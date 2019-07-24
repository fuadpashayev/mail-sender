<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Str;

class Auth
{
    public function __construct(){
    }



    public static function user($id=null){
        $token = session()->get("token");
        if($id) $user = User::find($id);
        else $user = User::where("token",$token);
        $user = $user->get();
        if($user->count())
            return $user[0];
        else return null;
    }

    public static function isVerified(){
        $user = Auth::user();
        return $user->verified;
    }

    public static function generateToken($id=null){
        $token = session()->get("token");
        if($id) $user = User::find($id);
        else $user = User::where("token",$token);

        $newToken = Str::random(32);
        session()->put("token",$newToken);
        $user->update(['token' => $newToken]);
    }

    public static function generateVerificationUrl($token){
        if($token==Auth::user()->token){
            return route('user.verify',['token'=>$token]);
        } return redirect()->route('views.home')->withErrors(['errors'=>['Your session has expired']]);
    }


}
