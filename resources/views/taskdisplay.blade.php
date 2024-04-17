
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
            padding: 10px; /* Reduced padding */
        }
        
        .task-container {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px; /* Reduced padding */
            margin-bottom: 15px;
            max-width: 100%;
            font-size: 6px; /* Reduced font size */
        }
        
        .task-info {
            margin-bottom: 5px; /* Reduced margin */
        }
        
        .task-info span {
            font-weight: bold;
        }

        h2 {
            color: red;
            font-size: 8px; /* Adjusted font size */
        }

        h1 {
            color: green;
            font-size: 10px; /* Adjusted font size */
            margin-bottom: 20px; /* Increased margin */
        }
    </style>
        <script src="https://kit.fontawesome.com/7b92c82a52.js" crossorigin="anonymous"></script>
        <script>
                                    function downloadFile(fileName) 
                                    {

                                        var userConfirmation = confirm("Do you want to download this file?");
                                        if (userConfirmation) 
                                        {    
                                            var filePath = 'uploads/' + fileName;
                                            var link = document.createElement('a');
                                            link.href = filePath + '?name=' + fileName;
                                            link.download = fileName;
                                            document.body.appendChild(link);
                                            link.click();
                                            document.body.removeChild(link);
                                        } 
                                        else 
                                        {
                                            console.log('Download cancelled by the user.');
                                        }
                                    }
                                </script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>


@if(session('message'))
<div class="alert alert-success" style="text-align: center; font-size: 20px;"> {{session('message')}} </div>
@endif

@if(session('error'))
<div class="alert alert-danger" style="text-align: center; font-size: 20px;">
    {{ session('error') }}
</div>
@endif

<div class="container-fluid">
    <h1 class="text-center">Tasks and its associated details</h1>
    @if(!empty($notaskerror))
<div class="alert alert-danger" style="text-align: center; font-size: 20px;"> {{$notaskerror}} </div>
@endif
    @foreach ($tasks as $task)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="task-container">
                <h2>Task ID - {{ $task->task_id }}</h2>
                <h2>{{ $task->task }}</h2>
                <h3 class="task-info">Description: {{ $task->description }}</h3>
                <h3 class="task-info">Priority: {{ $task->priority }}</h3>
                
                @php
                    $users = $task->task_user->pluck('users.name')->implode(', ');
                @endphp
                <h3 class="task-info">Users: {{ $users }}</h3>
                
                @php
                    $fileNames = $task->task_files->pluck('files.file_name')->implode(', ');
                    $Numfiles= $task->task_files->count(); 
                @endphp
                <h3 class="task-info">File Names: {{ $fileNames }}</h3>
                <h3 class="task-info">No of files : {{ $Numfiles }}</h3>
                @php
                    $projectNames = $task->projects->pluck('Project_name')->implode(', ');
                    $Numprojects= $task->projects->pluck('Project_name')->count();
                @endphp
                <h3 class="task-info">Project Names: {{ $projectNames }}</h3>
                <h3 class="task-info">Number of Projects : {{ $Numprojects }}</h3>
                
                <!-- edit and delete buttons -->
               
                    <a href="/edit-task?task_id={{$task->task_id}}" class="btn btn-primary"><i class="fas fa-edit" style="color: yellow;"></i></a>
                    <button onclick="deleteTask('{{ $task->task_id }}')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                <!-- Add this block for download links -->
  
            </div>
        </div>
    </div>
    @endforeach
    <div class="text-center">
    {{ $tasks->links() }} <!-- for creating pagination -->
    </div>
</div>

<script>
    function deleteTask(taskId) {
        var userConfirmation = confirm("Are you sure you want to delete this task?");
        if (userConfirmation) {
            // Assuming you have a delete route where you pass the task ID via query string
            window.location.href = '/delete-task?task_id=' + taskId;
        } else {
            console.log('Deletion cancelled by the user.');
        }
    }
</script>

</body>
</html>
