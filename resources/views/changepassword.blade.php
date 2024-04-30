@extends('layouts.app')
@section('title', 'Change password')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/changepassword.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection


@section('content')
@if(session('message'))
<div class="alert alert-danger" style="text-align: center; font-size: 30px;">
        {{ session('message') }}
    </div>
	@endif

    @if(session('passwordresetstatus'))
<div class="alert alert-success" style="text-align: center; font-size: 30px;">
        {{ session('passwordresetstatus') }}
    </div>
	@endif
   
    <h1>Change Password</h1>
    <form method="post" action="/changepassword">   
        @csrf   
        <label for="old_password">Old Password: </label>
        <input type="password" name="oldpassword" required><br>
        @error('oldpassword')
        <div class="alert alert-danger" style="text-align: center; font-size: 30px;">
            {{$message}}
        </div>
        @enderror
        <label for="password">New Password: </label>
        <input type="password" name="password" required><br>
        @error('password')
        <div class="alert alert-danger" style="text-align: center; font-size: 30px;">
            {{$message}}
        </div>
        @enderror
        <label for="confirm_password">Confirm Password: </label>
        <input type="password" name="password_confirmation" required><br>
        <input type="submit" name="submit">
        <a href="/projectform"><button type="button" name="goback" value="Back">Back</button></a>
    </form>
    @endsection

