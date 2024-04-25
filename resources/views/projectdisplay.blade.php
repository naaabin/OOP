
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e7d7d7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px; /* Adjusted container width */
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: green;
            text-align: left;
        }
        h2 {
            color: red;
            text-align: left;
        }

        .task-details {
            margin-bottom: 20px;
        }

        .task-details h3 {
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }

        .comma-separated-list {
            margin-bottom: 15px;
            font-style: italic;
            color: #666;
        }

        .comma-separated-list span {
            margin-right: 5px;
        }
    </style>
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
</head>
<body>

<div class="container">
<h1>Projects and its details </h1>
@if(!empty($noprojecterror))
<div style="text-align: center; font-size: 20px; color: red;">{{ $noprojecterror }}</div>
@php
    exit(); 
@endphp
@endif
@foreach ($projects as $project)
<br>
    <h2>Project : {{ $project->Project_name }}</h2>
    <h2>Description : {{ $project->Description }} </h2>
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
</body>

</html>
