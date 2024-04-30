
@include('partials.navigation')
@extends('layouts.app')
@section('title', 'Task Details')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/taskdisplay.css') }}">
@endsection
<script src="https://kit.fontawesome.com/7b92c82a52.js" crossorigin="anonymous"></script>

    <script>
        function deleteTask(taskId) 
        {
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
        } 
        else 
        {
            console.log('Download cancelled by the user.');
            window.open(filePath,'_blank');
        }
        }
  </script>
      
<body>
@section('content')   
@if(session('message'))
<div style="text-align: center; font-size: 40px; color: green; font-weight: bold;">{{ session('message') }}</div>
@endif

@if(session('error'))
<div style="text-align: center; font-size: 40px; color: red; font-weight: bold;">{{ session('error') }}</div>
@endif

<h1>Tasks and their associated details</h1>

@if(!empty($notaskerror))
    <div style="text-align: center; font-size: 20px; color: red;">{{ $notaskerror }}</div>
    @php
        exit(); // or return;
    @endphp
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
    <div>
       <h3 class="task-info"><a href="/TaskUpdateDetails?task_id={{$task->task_id}}" class="btn btn-primary">Task update Details</a></h3>
    </div>
    
    <br>
    <!-- edit and delete buttons -->
    <a href="/edit-task?task_id={{$task->task_id}}" class="btn btn-primary"><i class="fas fa-edit" style="color: yellow;"></i></a>
    <button onclick="deleteTask('{{ $task->task_id }}')" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
</div>
@endforeach
<br>    

<div class="row" style="text-align: center;">
    {{ $tasks->links() }}
</div>
@endsection
</body>
</html>
