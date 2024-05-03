@extends('layouts.app')
@section('title', 'Project Display page')
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('css/projectdisplay.css') }}">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection

    <script src="https://kit.fontawesome.com/7b92c82a52.js" crossorigin="anonymous"></script>
    <script>
    function deleteProject(projectId) 
    {
        var userConfirmation = confirm("Are you sure you want to delete this project?");
        if (userConfirmation) {
            window.location.href = '/delete-project?project_id=' + projectId;
        } else {
            console.log('Deletion cancelled by the user.');
        }
    }
</script>

@section('content')
<div class="container">
    @if(session()->has('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif

    @if(session()->has('error'))
    <div class="alert alert-warning" role="alert">
        {{ session('error') }}
    </div>
    @endif
<h1>Projects and its details </h1>
@if($projects->isEmpty())
<div style="text-align: center; font-size: 30px; color: red;"> Projects not found, please add projects first!! </div>
@endif
@foreach ($projects as $project)
<br>
    <h2>Project : {{ $project->project_name }}</h2>
    <h2>Description : {{ $project->description }} </h2>
    <div class="task-details">
    
        @php
            $allUsers = [];
            $allFiles = [];
            $alltasks = [];

            foreach ($project->tasks as $task) 
            {
                $allUsers = array_merge($allUsers, $task->users->pluck('name')->toArray());
                $allFiles = array_merge($allFiles, $task->files->pluck('file_name')->toArray());
                $alltasks[] = $task->task;
            }
            $allUsers = array_unique($allUsers);
            $allFiles = array_unique($allFiles);
        @endphp

        <h3>Tasks:</h3>
        <p class="comma-separated-list">
            {{ implode(', ', $alltasks) }}
        </p>

        <h3>Users:</h3>
        <p class="comma-separated-list">
            {{ implode(', ', $allUsers) }}
        </p>

        <h3>Files:</h3>
        <p class="comma-separated-list">
            {{ implode(', ', $allFiles) }}
        </p>
    </div>
    <a href="/ProjectUpdateDetails?project_id={{ $project->project_id }}" class="btn btn-primary">Project Update history</a> 
    <br><br>
    <!-- edit and delete buttons -->               
<a href="/edit-project?project_id={{ $project->project_id }}" class="btn btn-primary"><i class="fas fa-edit" style="color: yellow;"></i></a>
<button onclick="deleteProject('{{ $project->project_id }}')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
<br>  
@endforeach
<br>
<div class="row" style="text-align: center; margin-left: 30%;">
    {{ $projects->links() }}
  </div>
@endsection
