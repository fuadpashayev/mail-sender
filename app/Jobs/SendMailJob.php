<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $email,$emailClass;
    public function __construct($email,$emailClass)
    {
        $this->email = $email;
        $this->emailClass = $emailClass;
    }

    public function handle()
    {
        Mail::to($this->email)->send($this->emailClass);
    }
}
