
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Users Dashboard</title>
     <style>
        table 
        {
            border-collapse: collapse;
            width: 70%;
            margin: 0 auto; /* Center the table */
        }

        th, td 
        {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 10px; /* Adjusted padding */
            font-size: large; /* Adjusted font size */
        }

        th 
        {
            background-color: #f2f2f2;
        }

        h1
        {
            text-align: center;
            color: green;
        }

        a
        {
            display: block; /* Use display: block; to make margin properties work */
            text-align: center;
            color: green;
            font-size: large;
            margin-top: 20px; /* Adjusted margin */
        }
    </style>
</head>
<body>
<h1> Users and their Details</h1> 
<table>
<tr>
    <th>User ID</th>
    <th>Name</th> 
    <th>Email Address</th>
    <th>Assigned Tasks</th>
    <th>Tasks IDs</th>
</tr>

@foreach ($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
    @if($user->tasks->isNotEmpty())
            @php
                $taskNames = $user->tasks->pluck('task')->implode(', ');
            @endphp
            {{ $taskNames }}
        @endif
    </td>
    <td>
        @if($user->tasks)
            @php
                $taskIds = $user->tasks->pluck('task_id')->implode(', ');
            @endphp
            {{ $taskIds }}
        @endif
    </td>
</tr>
@endforeach
</table>
<a href="/projectform"><button type="button">Back to projects</button></a>
</body>
</html>
