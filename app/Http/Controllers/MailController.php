<?php

namespace App\Http\Controllers;


use App\Mail\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function sendVerificationMail(){
        $user = Auth::user();
        $mail = new \stdClass();
        $mail->url = Auth::generateVerificationUrl($user->token);
        $mail->sender = 'Fuad Pashayev';
        $mail->receiver = $user->name;

        Mail::to($user->email)->send(new Email($mail));
    }

    public static function sendMail(Request $request){



    }
}
