<?php

namespace App\Console\Commands;

use App\Jobs\SendMailJob;
use App\Mail\Email;
use App\Sender;
use Carbon\Carbon;
use DateTimeZone;
use Illuminate\Console\Command;

class SendMails extends Command
{
    protected $signature = 'send:mails';
    protected $description = 'Command description';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $senders = Sender::where("sent",false)->get();
        if($senders!=null){
            foreach ($senders as $sender) {
                $zone = new DateTimeZone('Asia/Baku');
                $current_week_day =Carbon::now($zone)->dayOfWeek;
                $current_timestamp = Carbon::now($zone);
                $data_timestamp = Carbon::parse($sender->hour,$zone);
                $differ = $current_timestamp->diffInSeconds($data_timestamp);
                if($current_week_day == $sender->week_day && $differ<=60){
                    $mails = explode(',',$sender->mail_list);
                    $data = new \stdClass();
                    $data->subject = $sender->subject;
                    $data->content = $sender->content;
                    $data->sender = 'Fuad Pashayev';
                    foreach ($mails as $mail) {
                        $data->receiver = $mail;
                        dispatch(new SendMailJob(
                            $mail,
                            new Email($data)
                        ));
                    }
                    $sender->sent = true;
                    $sender->save();
                }

            }
        }
    }
}
