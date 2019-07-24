Hello <b>{{ $data->receiver }}</b>,
@if(isset($data->content))
    <p>{{$data->subject}}</p>
    <p>{{$data->content}}</p>
@else
    <p>This is an account verification email</p>
    <p>Please click the url below to activate your account</p>
    <a href="{{$data->url}}">{{$data->url}}</a><br/>
@endif
Thank You,
<br/>
<i>{{ $data->sender }}</i>
