@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div id="login-row" class="row justify-content-center align-items-center">
        <div id="login-column" class="col-md-6">
            <div id="login-box" class="col-md-12 bg-light p-4">
                @if ($errors->any())
                  <div class="alert alert-danger">
                       <ul class="validate_error">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                       </ul>
                </div>
                @endif  
            <form id="login-form" class="form" action="{{url('login')}}" method="post">
                @csrf
                    <h3 class="text-center text-info">{{__('Login')}}</h3>
                    <div class="form-group">
                        <label for="username" class="text-info">{{__('Username')}}:</label><br>
                    <input type="text" name="username" id="username" class="form-control" value="{{old('username')}}">
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-info">{{__('Password')}}:</label><br>
                        <input type="password" name="password" id="password" class="form-control" value="{{old('password')}}">
                    </div>
                    <div class="form-group text-center mt-4">
                        <input type="submit" name="submit" class="btn btn-info btn-md px-4" value="Sign In">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
