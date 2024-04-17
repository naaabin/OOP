<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            padding: 20px;
        }
        
        .task-container {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 15px;
            width: 70%;
         
        }
        
        .task-info {
            margin-bottom: 10px;
        }
        
        .task-info span {
            font-weight: bold;
        }
        
        .user-info,
        .file-info,
        .project-info {
            margin-left: 20px;
        }

        h2
        {
            color : red;
        }

        h1
        {
            color:green;
        }
    </style>
</head>
<body>
<h1>Tasks and its associated details</h1>

@foreach ($tasks as $task)
    <div class="task-container">
    <h2>Task ID - {{ $task->task_id }}</h2>
        <h2>{{ $task->task }}</h2>
        <h3>Description: {{ $task->description }}</h3>
        <h3>Priority: {{ $task->priority }}</h3>
        
            @php
                $users = $task->task_user->pluck('users.name')->implode(', ');
            @endphp
            <h3>Users: {{ $users }}</h3>
          
            @php
                $fileNames = $task->task_files->pluck('files.file_name')->implode(', ');
                $Numfiles= $task->task_files->count(); 
            @endphp
            <h3>File Names: {{ $fileNames }}</h3>
            <h3>No of files : {{ $Numfiles }}</h3>
        
            @php
                $projectNames = $task->projects->pluck('Project_name')->implode(', ');
                $Numprojects= $task->projects->pluck('Project_name')->count();
            @endphp
            <h3>Project Names: {{ $projectNames }}</h3>
            <h3>Number of Projects : {{ $Numprojects }}</h3>
     
    </div>
@endforeach

</body>
</html>
