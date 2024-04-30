@extends('layouts.app')
@section('title', 'Edit task')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/edittask.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endsection

<body>
    @section('content')
    <div class="container">
        <h1 class="text-center">EDIT TASK</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="/edit-task">
            @csrf
            <h2>Task</h2>
            <input type="hidden" class="form-control" name="id" value="{{ $task->task_id}}">
            <input type="text" class="form-control" name="new_task" value="{{ old('new_task', $task->task) }}">
            <h2>Description</h2>
            <input type="text" class="form-control" name="new_description" value="{{ old('new_description', $task->description) }}">
            <h2>Priority</h2>
            <input type="text" class="form-control" name="new_priority" value="{{ old('new_priority', $task->priority) }}">
            <h2>Note</h2>
            <input type="text" class="form-control" name="note_content" value="">
            <button type="submit" class="btn btn-primary" name="update" value="Update">Update</button>
        
            <a href="/taskdisplay" class="btn btn-secondary">Back</a>
        </form>
    </div>
    @endsection
</body>
</html>
