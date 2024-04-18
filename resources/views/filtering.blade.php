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

    <label for="projects"><h2>Projects</h2></label>
    <select name="user">
    <option value="">Select a user</option>
    @foreach($users as $user)
        <option value="{{ $user->id }}" {{ (old('user') == $user->id ? "selected":"") }}>{{ $user->name }}</option>
    @endforeach
</select>

<select name="project">
    <option value="">Select a project</option>
    @foreach($projects as $project)
        <option value="{{ $project->project_id }}" {{ (old('project') == $project->project_id ? "selected":"") }}>{{ $project->Project_name }}</option>
    @endforeach
</select>
        <button type="submit" name="submit">Submit</button> 
        <a href="/projectform"><button type = "button" name="Back">Back </button>  </a>
    </form>
    
      <h2>All Tasks and Their Details</h2>
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
    $counter = 1;
    @endphp
    @foreach($tasks as $task)
        @foreach($task->projects as $project)
            <tr>
                <td>{{ $counter++ }}</td>
                <td>{{ $project->Project_name }}</td>
                <td>{{ $project->project_id }}</td>
                <td>{{ $task->task_id }}</td>
                <td>{{ $task->task }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->priority }}</td>
                <td>
                    {{ $task->files->pluck('file_name')->implode(', ') }}
                </td>
                <td>
                    {{ $task->users->pluck('name')->implode(', ') }}
                </td>
            </tr>
        @endforeach
    @endforeach
</table>
</body>
</html>



