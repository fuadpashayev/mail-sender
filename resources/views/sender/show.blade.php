@extends('app')
@section('title','Sender Application')

@section('content')


    <div class="body">
        <div class="actions">
            <a href="{{route('views.home')}}">
                <button class="btn btn-primary col-md-1">Back</button>
            </a>
        </div>
        <div class="senders">



            <div class="sender">
                <div>
                    <span>Subject</span>
                    <div>{{$sender->subject}}</div>
                </div>
                <div>
                    <span>Content</span>
                    <div>{{$sender->content}}</div>
                </div>
                <div>
                    <span>Week Day</span>
                    <div>{{getWeekDayName($sender->week_day-1)}}</div>
                </div>
                <div>
                    <span>Time</span>
                    <div>{{$sender->hour}}</div>
                </div>
                <div>
                    <span>Mails</span>
                    <div>
                        @foreach(explode(',',$sender->mail_list) as $mail)
                            <div>{{$mail}}</div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

