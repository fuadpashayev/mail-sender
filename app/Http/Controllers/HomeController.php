<?php

namespace App\Http\Controllers;


use App\Sender;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware("UserMiddleware")->except(['login','register']);
    }


    function index(){
        $user = Auth::user();
        $senders = Sender::where("user_id",$user->id)->get()->all();
        return view('home',[
            'user' => $user,
            'senders' => $senders
        ]);
    }

    function login(){
        if(!Auth::user())
            return view('login');
        else
            return redirect()->route('views.home');
    }

    function register(){
        if(!Auth::user())
            return view('register');
        else
            return redirect()->route('views.home');
    }



}
