@extends('app')
@section('title','Sender Application')

@section('content')

    <form class="form-row col-md-6 app-form" action="{{route('user.login')}}" method="post">
        @csrf
        <h4 class="card-title text-center">Sign In</h4>

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

        <div class="input-group form-group">
            <input class="form-control" type="email" name="email" placeholder="Email">
        </div>
        <div class="input-group form-group">
            <input class="form-control" type="password" name="password" placeholder="Password">
        </div>
        <div class="input-group form-group">
            <button class="btn btn-primary col-md-12">Log In</button>
        </div>
        <div class="w100 text-center">
            <a class="btn btn-default col-md-12" href="{{route('views.register')}}">Register</a>
        </div>
    </form>


@endsection


