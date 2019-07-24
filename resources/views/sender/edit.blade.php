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


            <form action="{{route('sender.update',['id'=>$sender->id])}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="subject" class="col-form-label">Subject:</label>
                    <input name="subject" type="text" class="form-control" id="subject" value="{{$sender->subject}}">
                </div>
                <div class="form-group">
                    <label for="content" class="col-form-label">Message:</label>
                    <textarea name="content" class="form-control" id="content">{{$sender->content}}</textarea>
                </div>

                <div class="form-group">
                    <label for="week_day" class="col-form-label">Week Days:</label>
                    <select name="week_day" class="form-control" id="week_day" >
                        @for($i=0;$i<7;$i++)
                            <option @if($sender->week_day==$i+1) selected @endif value="{{$i+1}}">{{getWeekDayName($i)}}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="hour" class="col-form-label">Hours:</label>
                    <input name="hour" class="form-control" type="time" id="hour" value="{{$sender->hour}}">
                </div>
                <div class="form-group">
                    <label for="mail_list" class="col-form-label">Mails(seperate by comma):</label>
                    <textarea name="mail_list" class="form-control" id="mail_list" placeholder="eg: someone@gmail.com, someoneelse@gmail.com">{{$sender->mail_list}}</textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary col-md-1" id="addSender">Edit</button>
                </div>
            </form>

        </div>
    </div>

@endsection

