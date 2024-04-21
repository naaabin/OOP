@if(!session('user_id'))
    <script>window.location.href = '/loginform';</script>
@endif
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Filtering page</title>
    <style>
        body 
        {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 
        {
            text-align: center;
            color: green;
            margin-top: 20px;
        }

        h2 
        {
            text-align: center;
            color: red;
        }

        form 
        {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 10px;
            display: inline-flex;
            align-items: baseline;
            margin-left: 20%;
            font-size: 16px; /* Decrease font size */
        }

        select, button[type="submit"] , button[type="button"]
        {
                padding: 10px;
                font-size: 14px; /* Decrease font size */
                width: 200px; /* Adjust width as needed */
                margin: 15px 40px; /* Add space between elements */
        }

        label 
        {
            display: block;
            margin-bottom: 5px;
        }

       
        button[type="submit"] 
        {
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
        }

        button[type="button"] 
        {
            background-color: green;
            color: white;
            border: none;
            cursor: pointer;
        }

        table 
        {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td 
        {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        th 
        {
            background-color: #f2f2f2;
        }
    
    </style>


</head>
<body>
    <h1> DASHBOARD </h1>
    <form method="post" action="/processfilter">
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
        <th>Project</th>
        <th>Project_ID</th>
        <th>Task ID</th>
        <th>Task</th>
        <th>Task description</th>
        <th>Task priority</th>
        <th>Files</th>
        <th>Assigned User</th>
    </tr>
    @if($tasks)
    @foreach($tasks as $task)
        @foreach($task->projects as $project)
            <tr>
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

    @if($userfilter && !$userfilter->tasks->isEmpty() && $userfilter->tasks->first()->projects->isEmpty())
        <h1>No projects associated with this user's tasks.</h1>
    @endif

    @if($projectfilter && $projectfilter->tasks->isEmpty())
        <h1>No tasks assigned to this project.</h1>
    @endif

    @if($taskfilter && count($taskfilter) == 0)
        <h1>No records found for the selected user and project.</h1>
    @endif
</body>
</html>
