<?php
namespace App\Http\Middleware;
use App\Http\Controllers\Auth;
use App\User;
use Closure;
use Illuminate\Support\Facades\Session;


class UserMiddleware
{

    public function __construct()
    {
    }

    public function handle($request, Closure $next)
    {
        $check = Auth::user();
        if($check){
            return $next($request);
        }elseif($check && !Auth::isVerified()){
            return redirect()->route('views.home');
        } else{
            return redirect()->route('views.login');
        }
    }
}
