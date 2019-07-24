<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    function login(Request $request){
        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        return $this->loginWithCredentials($validator);
    }


    function loginWithCredentials($credentials){

        $user = User::where([
            'email' => $credentials['email']
        ])->first();
        $password = Hash::check($credentials['password'], $user->password);
        if($user && $password){
            Auth::generateToken($user->id);
            return redirect()->route("views.home");
        }else{
            $errors = [
                'User did not found or Email and password is incorrect'
            ];
            return redirect()->route('views.login')->withErrors(['errors'=>$errors]);
        }
    }



    function register(Request $request){
        $validator = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'name' => 'required'
        ]);

        return $this->registerWithCredentials($validator);
    }


    function registerWithCredentials($credentials){
        $token = Str::random(32);
        session()->put("token",$token);

        $user = new User();
        $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->token = $token;
        $user->save();
        MailController::sendVerificationMail();
        return redirect()->route("views.home");

    }


    function logout(){
        session()->forget("token");
        return redirect()->route("views.home");
    }


    function verification($token){
        $user = Auth::user();
        if($token == $user->token){
            $userTarget = User::find($user->id);
            $userTarget->update(['verified'=>true]);
            return redirect()->route('views.home')->withInput(['message'=>'Your account successfully activated']);
        }else return redirect()->route('views.home')->withErrors(['errors'=>['Your session has expired']]);
    }








}
