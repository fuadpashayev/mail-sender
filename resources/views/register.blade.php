@extends('app')
@section('title','Sender Application')

@section('content')

    <form class="form-row col-md-6 app-form" action="{{route('user.register')}}" method="post">
        @csrf
        <h4 class="card-title text-center">Register</h4>

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
            <input class="form-control" type="text" name="name" placeholder="Full Name">
        </div>

        <div class="input-group form-group">
            <input class="form-control" type="email" name="email" placeholder="Email">
        </div>
        <div class="input-group form-group">
            <input class="form-control" type="password" name="password" placeholder="Password">
        </div>
        <div class="input-group form-group">
            <button class="btn btn-primary col-md-12">Register</button>
        </div>
        <div class="w100 text-center">
            <a class="btn btn-default col-md-12" href="{{route('views.login')}}">Login</a>
        </div>
    </form>


@endsection


