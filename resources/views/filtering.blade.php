@extends('layouts.app')
@section('title', 'Filtering page')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/filtering.css') }}">
@endsection


    @section('content')
    <h1> DASHBOARD </h1>
    <form method="get" action="/filtering">
    @csrf
    <label for="users"><h2>Users</h2></label>
    <select name="UserDropdownData">
    <option value="">Select a user</option>
    @foreach($users as $user)
        <option value="{{ $user->id }}" {{ (session('selectedUser') == $user->id ? "selected":"") }}>{{ $user->name }}</option>
    @endforeach
    </select>

    <label for="projects"><h2>Projects</h2></label>
    <select name="ProjectDropdownData">
        <option value="">Select a project</option>
        @foreach($projects as $project)
            <option value="{{ $project->project_id }}" {{ (session('selectedProject') == $project->project_id ? "selected":"") }}>{{ $project->Project_name }}</option>
        @endforeach
    </select>
            <button type="submit" name="submit">Submit</button> 
            <a href="/projectform"><button type = "button" name="Back">Back </button>  </a>
        </form>


 <h1>All Tasks and Their Details</h1>
 <table>
    <tr>
        <th>SN</th>
        <th>Project</th>
        <th>Project_ID</th>
        <th>Task ID</th>
        <th>Task</th>
        <th>Task description</th>
        <th>Task priority</th>
        <th>Files</th>
        <th>Assigned User</th>
        
    </tr>
 
    @php
        $count=1;
    @endphp
    
    @if($tasks)
    @foreach($tasks as $task)
        @foreach($task->projects as $project)
            <tr>
                <td>{{$count++}}</td>
                <td>{{ $project->Project_name }}</td>
                <td>{{ $project->project_id }}</td>
                <td>{{ $task->task_id }}</td>
                <td>{{ $task->task }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->priority }}</td>
                <td>
                    @foreach($task->files as $file)
                        {{ $file->file_name }}@if(!$loop->last),@endif
                    @endforeach
                </td>
                <td>
                    @foreach($task->users as $user)
                        {{ $user->name }}@if(!$loop->last),@endif
                    @endforeach
                </td>
            </tr>
        @endforeach
    @endforeach

    @elseif($taskfilter)
    @foreach ($taskfilter as $task)
        <tr>
            <td>{{$count++}}</td>
            <td>{{ $task->projects->firstWhere('project_id', session('selectedProject'))->Project_name }}</td>
            <td>{{ session('selectedProject') }}</td>
            <td>{{ $task->task_id }}</td>
            <td>{{ $task->task }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->priority}}</td>
            <td>
                @foreach ($task->files as $file)
                    {{ $file->file_name }},
                @endforeach
            </td>
            <td>{{ $task->users->firstWhere('id', session('selectedUser'))->name }}</td>
        </tr>
    @endforeach  
    @elseif($userfilter)        
            @foreach ($userfilter->tasks as $task)
                    @foreach($task->projects as $project)
                        <tr>
                            <td>{{$count++}}</td>
                            <td>{{ $project->Project_name }}</td>
                            <td>{{ $project->project_id }}</td>
                            <td>{{ $task->task_id }}</td>
                            <td>{{ $task->task }}</td>
                            <td>{{ $task->description }}</td>
                            <td>{{ $task->priority }}</td>
                            <td>
                                @foreach($task->files as $file)
                                    {{ $file->file_name }}@if(!$loop->last),@endif
                                @endforeach
                            </td>
                            <td>{{ $userfilter->name }}</td>
                        </tr>
                    @endforeach
           
    @endforeach    
    @elseif($projectfilter)
        @foreach($projectfilter->tasks as $task)
                <tr>
                    <td>{{$count++}}</td>
                    <td>{{ $projectfilter->Project_name }}</td>
                    <td>{{ $projectfilter->project_id }}</td>
                    <td>{{ $task->task_id }}</td>
                    <td>{{ $task->task }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->priority }}</td>
                    <td>
                        @foreach($task->files as $file)
                            {{ $file->file_name }}@if(!$loop->last),@endif
                        @endforeach
                    </td>
                    <td>
                        {{$task->users->pluck('name')->implode(', ')}}
                    </td>
                </tr>
        @endforeach
    @endif
</table>
   <!-- Display error messages -->
    @if($userfilter && $userfilter->tasks->isEmpty())
        <h1>No tasks associated with this user.</h1>
    @endif

    @if($projectfilter && $projectfilter->tasks->isEmpty())
        <h1>No tasks assigned to this project.</h1>
    @endif

    @if($taskfilter && count($taskfilter) == 0)
        <h1>No records found for the selected user and project.</h1>
    @endif
    @endsection

