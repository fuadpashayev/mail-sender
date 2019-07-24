<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    protected $fillable = [
        'subject',
        'content',
        'week_day',
        'hour',
        'mail_list'
    ];
}
