@extends('layouts.app')
@section('title', 'Forget password')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/forgetpasswordform.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection


@section('content')
    <!-- Forgot Password Form -->
    @if (session('message'))
    <div class="alert alert-success" style="text-align: center; font-size: 30px;">
        {{ session('message') }}
    </div>
@endif
    <form method="post"   action="/forgetpassword">
        @csrf
        <h1> Please enter your Email Address.</h1>
        <label for="Email Address">Email Address </label>
        <input type="email" name="email" id="Email Address" required>
        @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        <input type="submit" name="submit" value="Submit"><br>
        <a href="/loginform"><button type="button" name="gobacklogin">Go back to login</button></a>
    </form>
    @endsection

