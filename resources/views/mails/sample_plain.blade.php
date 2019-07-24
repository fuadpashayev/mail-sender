Hello {{ $data->receiver }},
@if(isset($data->content))
    {{$data->subject}}
    {{$data->content}}
@else
    This is an account verification email
    Please click the url below to activate your account
    {{$data->url}}
@endif
Thank You,
{{ $data->sender }}
