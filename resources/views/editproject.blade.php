@extends('layouts.app')
@section('title', 'Project page')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/edittask.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection

    @section('content')
<div class="container">

    <h2 align="center">EDIT THE FOLLOWING DETAILS</h2>
    <form method="POST" action="/edit-project">
        @csrf
        <h1>Project</h1>
        <input type="hidden" name="new_ID" value="{{ $project->project_id }}">
        <input type="text" name="new_project" value="{{ old('new_project', $project->Project_name) }}">

        <h1>Description</h1>
        <input type="text" name="new_description" value="{{ old('new_description' , $project->Description) }}">

        <h1>Note</h1>
        <input type="text" name="note" value="">
        @error('note')
        <div class="alert alert-warning">{{ $message }} </div>
        @enderror
        <button type="submit" name="update">Update</button>
        <a href="/projectform"><button class="btn btn-primary" name="back"> Back </button></a>
    </form>
</div>
@endsection

