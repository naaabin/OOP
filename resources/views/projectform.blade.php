@extends('layouts.app')
@section('title', 'Project page')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/editproject.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection

<body>                
@section('content')
<div class="container">

    @if(session()->has('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
    @endif
    <h1>PROJECT</h1>
    <form method="POST" action="/projectadd">
        @csrf
        <label for="project">Project:</label>
        <input type="text" name="project" id="project" required>
        <label for="Description">Description:</label>
        <input type="text" name="description" id="Description" required>
        <button type="submit" name="add" class="btn btn-success">Add</button> 
        <a href="/todolist" class="btn btn-primary">Add tasks</a>
        <a href="/taskdisplay" class="btn btn-primary">Go to tasks page</a>
        <a href="/users" class="btn btn-primary">Users</a>
        <a href="/filtering" class="btn btn-primary">Go to filter page</a>
        <a href="/changepassword" class="btn btn-primary">Change Password</a>
        <a href="/logout" class="btn btn-danger">Logout</a>
    </form>
</div>
@include('projectdisplay')
@endsection
</body>
</html>
