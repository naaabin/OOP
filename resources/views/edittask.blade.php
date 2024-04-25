
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #e7d7d7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
         
            color: black;
            font-weight: bold;
        }

        form {
            text-align: left;
        }

        h1 {
            font-size: 35px;
            margin-bottom: 10px;
            color: green;
            font-weight: bold; /* This will make the text bold */
        }


        input {
            margin-bottom: 15px;
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 16px;
        }

        a {
            text-decoration: none;
            color: #333;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
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
</body>
</html>
