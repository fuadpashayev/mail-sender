<?php

namespace App\Http\Controllers;

use App\Sender;
use Illuminate\Http\Request;

class SenderController extends Controller
{

    public function show($id){
        $sender = Sender::findOrFail($id);
        return view('sender.show',['sender'=>$sender]);
    }

    public function edit($id){
        $sender = Sender::findOrFail($id);
        return view('sender.edit',['sender'=>$sender]);
    }

    public function create(Request $request)
    {
        $validator = $request->validate([
            'subject' => 'required',
            'content' => 'required',
            'week_day' => 'required',
            'hour' => 'required',
            'mail_list' => 'required'
        ]);

        $mail_list = $validator['mail_list'];
        $mail_list_array = explode(',',$mail_list);
        $new_mail_list = [];
        foreach($mail_list_array as $mail){
            $check = preg_match('/^[a-zA-Z0-9.!#$%&\'*+\=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/im',$mail);
            if($check)
                $new_mail_list[] = $mail;
        }

        if(count($new_mail_list)==0){
            $errors = [
                'You must enter at least one valid email'
            ];
            return back()->withErrors(['errors'=>$errors])->withInput();
        }

        $validator['mail_list'] = implode(',',$new_mail_list);


        $sender = new Sender($validator);
        $sender->user_id = Auth::user()->id;
        $sender->save();
        if($sender){
            return redirect()->route('views.home');
        }


    }


    public function update(Request $request, $id)
    {
        $validator = $request->validate([
            'subject' => 'required',
            'content' => 'required',
            'week_day' => 'required',
            'hour' => 'required',
            'mail_list' => 'required'
        ]);

        $sender = Sender::findOrFail($id);
        $sender->update($validator);
        if($sender){
            return redirect()->route('views.home');
        }

    }

    public function delete($id)
    {
        $sender = Sender::findOrFail($id);
        $sender->delete();
        return redirect()->route('views.home');
    }
}
