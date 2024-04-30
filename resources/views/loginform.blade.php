@extends('layouts.app')
@section('title', 'LOGIN PAGE')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/projectform.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection   
<script>
    function func() {
        var confirmation = confirm('Are you sure you want to reset the password?');

        if (confirmation) {
            window.location.href = '/forgetpassword';
        } else {
            window.location.href = '/loginform';
        }
    }
</script>


@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh; width: 80%;">
    <div class="border rounded p-5" style="background-color: #D3D3D3;">
 
    @if(session('message'))
<div class="alert alert-danger" style="text-align: center; font-size: 30px;">
        {{ session('message') }}
    </div>
	@endif

    @if(session('passwordchange'))
    <div class="alert alert-success" style="text-align: center; font-size: 30px;">
            {{ session('passwordchange') }}
        </div>
        @endif

    @if(session('PasswordResetstatus'))
<div class="alert alert-success" style="text-align: center; font-size: 30px;">
        {{ session('PasswordResetstatus') }}
    </div>
	@endif
        <h2 class="text-center mb-4 font-weight-bold" style="color: red;">Welcome to the login page</h2>
        <form method="POST" action="{{ route('loginform') }}">
            @csrf
            

            <div class="form-group">
                <label for="email" class="font-weight-bold">Email Address</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" required>
                @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

            <div class="form-group">
                <label for="pass" class="font-weight-bold">Password</label>
                <input type="password" class="form-control" id="pass" name="password" placeholder="Password" required>
                @error('password')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
              </div>

            <div class="form-group">
                <input type="submit" class="btn btn-success btn-block font-weight-bold" name="login" value="Login">
            </div>

            <div class="text-center">
                <h5 class="font-weight-bold" style="color: black;"><a href="signupform">Sign up</a></h5>
                <h5 class="font-weight-bold" style="color: black;"><a href="#" onclick="func()">Forgot Password?</a></h5>
            </div>
        </form>
    </div>
</div>
@endsection

