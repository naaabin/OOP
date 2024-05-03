@extends('layouts.app')
@section('title', 'Your To-Do List')
@section('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
@endsection
<script src="https://kit.fontawesome.com/7b92c82a52.js" crossorigin="anonymous"></script>
    <script>
        function downloadFile(filePath, fileName) {
            // Show a confirmation dialog
            var userConfirmation = confirm("Do you want to download this file?");

            // If the user confirms, trigger the download
            if (userConfirmation) {
                // Create an invisible link and simulate a click
                var link = document.createElement('a');
                link.href = filePath + '?name=' + fileName;
                link.download = fileName;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } else {
                // If the user cancels, do nothing or provide feedback
                console.log('Download cancelled by the user.');
            }
        }
    </script>


@section('content')
<div class="container">
    <h1>To-Do List</h1>
    <form method="POST" enctype="multipart/form-data" action="/addtask">
        @csrf
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="form-group">
            <label for="task">New Task:</label>
            <input type="text" class="form-control" name="task" id="task" required>
        </div>

        <div class="form-group">
            <label for="Description">Description:</label>
            <input type="text" class="form-control" name="description" id="Description" required>
        </div>

        <div class="form-group">
            <label for="fileInput">Upload File(s):</label>
            <input type="file" class="form-control-file" name="FILE[]" id="fileInput" multiple>
        </div>

        <div class="form-group">
            <label>Priority:</label>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="priority" value="Yes"> YES
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="priority" value="No" checked required> NO
            </div>
        </div>

        <div class="form-group">
            <label>Projects:</label>
            @foreach ($projects as $project)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="selectedProjects[]" value="{{ $project['project_name'] }}">
                    <label class="form-check-label">{{ $project['project_name'] }}</label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label>Users:</label>
            @foreach ($users as $user)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="selectedUsers[]" value="{{ $user['name'] }}">
                    <label class="form-check-label">{{ $user['name'] }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary" name="addtask">Add Task</button>
    </form>
</div>
@endsection

