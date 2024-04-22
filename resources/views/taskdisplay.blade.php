
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
            padding: 10px;
        }
        
        .task-container {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
            max-width: 100%;
            font-size: 14px;
        }
        
        .task-info {
            margin-bottom: 5px;
        }
        
        .task-info span {
            font-weight: bold;
        }

        h2 {
            color: red;
            font-size: 18px;
        }

        h1 {
            color: green;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .btn {
            margin-right: 10px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 8px 12px;
            text-decoration: none;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-primary {
            background-color: #0174f0;
        }

        .thumbnail-image {
              width: 15px;
               height: 15px;
                        }

    </style>
    <script src="https://kit.fontawesome.com/7b92c82a52.js" crossorigin="anonymous"></script>
    <script>
        function deleteTask(taskId) {
            var userConfirmation = confirm("Are you sure you want to delete this task?");
            if (userConfirmation) {
                window.location.href = '/delete-task?task_id=' + taskId;
            } else {
                console.log('Deletion cancelled by the user.');
            }
        }

        function downloadFile(filePath, fileName) 
        {
        var userConfirmation = confirm("Do you want to download this file?");
        if (userConfirmation) {
            var link = document.createElement('a');
            link.href = filePath;
            link.download = fileName;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } else {
            console.log('Download cancelled by the user.');
            window.open(filePath,'_blank');
        }
}
  </script>
</head>
<body>

@if(session('message'))
<div style="text-align: center; font-size: 40px; color: green; font-weight: bold;">{{ session('message') }}</div>
@endif

@if(session('error'))
<div style="text-align: center; font-size: 40px; color: red; font-weight: bold;">{{ session('error') }}</div>
@endif

<div>
    <h1>Tasks and their associated details</h1>
    <a href="/todolist" class="btn">Add new task to the project</a>
    <a href="/users" class="btn">Users</a>
    <a href="/logout" class="btn">Logout</a>
</div>

@if(!empty($notaskerror))
<div style="text-align: center; font-size: 20px; color: red;">{{ $notaskerror }}</div>
@endif

@foreach ($tasks as $task)
<div class="task-container">
    <h2>Task ID - {{ $task->task_id }}</h2>
    <h2>{{ $task->task }}</h2>
    <h3 class="task-info">Description: {{ $task->description }}</h3>
    <h3 class="task-info">Priority: {{ $task->priority }}</h3>
    
    @php
        $users = $task->users->pluck('name')->implode(', ');
    @endphp
    <h3 class="task-info">Users: {{ $users }}</h3>
    <h3 class="task-info">Files</h3>
    @foreach ($task->files as $file)
        @php
            $filePath = $file->file_loc;  // assuming each file has a 'file_path' attribute
            $fileName = $file->file_name;
            $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
            $icon = '';
            $thumbnailClass = 'thumbnail-image';
            switch ($fileExtension) {
                case 'pdf':
                    $icon = '<i class="fas fa-file-pdf" style="color: orange;"></i>';  // FontAwesome icon for PDF

                    break;
                case 'csv':
                    $icon = '<i class="fas fa-file-csv"></i>';  // FontAwesome icon for CSV
                    break;
                case 'jpg':
                case 'jpeg':
                    $icon = '<img src="' . $filePath . '" alt="' . $fileName . '" class="' . $thumbnailClass . '">';  // Thumbnail for image
        
            }
        @endphp
        <a href="#" onclick="downloadFile('{{ $filePath }}', '{{ $fileName }}')">{!! $icon !!} {{ $fileName }}</a>
        <br>
    @endforeach
    
    @php
        $Numfiles= $task->files->count(); 
    @endphp
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
</div>
@endforeach
<div class="row">
{{ $tasks->links() }}
</div>



</body>
</html>
