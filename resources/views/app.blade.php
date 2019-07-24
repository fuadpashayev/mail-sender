<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="/app/app.css">
</head>
<body>


@php

    use Carbon\Carbon;$zone = new DateTimeZone('Asia/Baku');
    $current_week_day =Carbon::now($zone)->dayOfWeek;
    $current_timestamp = Carbon::now($zone);
    $data_timestamp = Carbon::parse('10:51','Asia/Baku')->toDate();
    $differ = $current_timestamp->diffInSeconds($data_timestamp);









            $user = \App\Http\Controllers\Auth::user();
@endphp
    <div class="container">
        <div class="content" @if(!$user) style="border: 0;" @endif>
           @if($user)
            <div class="header">
                <span class="welcome-text">
                    Welcome, <span>{{$user->name}}</span>
                </span>
                <span class="logout">
                    <a href="{{route("user.logout")}}">Log Out</a>
                </span>
                <span class="clearfix"></span>
            </div>
            @endif
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="/app/app.js"></script>
</body>
</html>
