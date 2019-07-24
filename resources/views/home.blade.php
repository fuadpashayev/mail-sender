@extends('app')
@section('title','Sender Application')

@section('content')



@if(old('message'))
    <div class="alert alert-success">
        {{old('message')}}
    </div>
@endif

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Sender</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('sender.create')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="subject" class="col-form-label">Subject:</label>
                        <input name="subject" type="text" class="form-control" id="subject" value="{{old('subject')}}">
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-form-label">Message:</label>
                        <textarea name="content" class="form-control" id="content">{{old('content')}}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="week_day" class="col-form-label">Week Days:</label>
                        <select name="week_day" class="form-control" id="week_day">
                            @for($i=0;$i<7;$i++)
                                <option @if(old('week_day')==$i) selected @endif value="{{$i+1}}">{{getWeekDayName($i)}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hour" class="col-form-label">Hours:</label>
                        <input name="hour" class="form-control" type="time" id="hour" value="{{old('hour')}}">
                    </div>
                    <div class="form-group">
                        <label for="mail_list" class="col-form-label">Mails(seperate by comma):</label>
                        <textarea name="mail_list" class="form-control" id="mail_list" placeholder="eg: someone@gmail.com, someoneelse@gmail.com">{{old('mail_list')}}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" id="addSender">Add Sender</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@if(!\App\Http\Controllers\Auth::isVerified())
    <div class="body">
        Verification url sent to your email. Please check your email to activate your account!
    </div>
@else
    <div class="body">
        @if ($errors->any())
            <div class="input-group">
                <div class="alert alert-danger col-md-12">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <div class="actions">
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Sender</button>
        </div>
        <table class="senders-table">
            <thead>
                <tr>
                    <th scope="col">Subject</th>
                    <th scope="col">Week Day</th>
                    <th scope="col">Time</th>
                    <th scope="col">Options</th>
                </tr>
            </thead>
            <tbody>
            @foreach($senders as $sender)
            @php
                $params = ['id'=>$sender->id];
            @endphp
                <tr>
                    <td>{{$sender->subject}}</td>
                    <td>{{getWeekDayName($sender->week_day-1)}}</td>
                    <td>{{$sender->hour}}</td>
                    <td>
                        <a href="{{route('sender.show',$params)}}">
                            <span class="option-button show">Show</span>
                        </a>
                        <a href="{{route('sender.edit',$params)}}">
                            <span class="option-button edit" type="edit">Edit</span>
                        </a>
                        <a href="{{route('sender.delete',$params)}}">
                            <span class="option-button delete" type="delete">Delete</span>
                        </a>
                    </td>
                </tr>

            @endforeach

            </tbody>
            @if(!$senders)
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-center">No Sender Found</td>
                    </tr>
                </tfoot>
            @endif
        </table>
    </div>
@endif


@endsection

