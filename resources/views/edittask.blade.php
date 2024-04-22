
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
            background-color: #f7f7f7;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            background-color: #fff;
        }
        h1 {
            margin-top: 20px;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">EDIT TASK</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="/edittask">
            @csrf
            <h2>Task</h2>
            <input type="hidden" class="form-control" name="id" value="{{ $task->task_id}}">
            <input type="text" class="form-control" name="new_task" value="{{ old('new_task', $task->task) }}">
            <h2>Description</h2>
            <input type="text" class="form-control" name="new_description" value="{{ old('new_description', $task->description) }}">
            <h2>Priority</h2>
            <input type="text" class="form-control" name="new_priority" value="{{ old('new_priority', $task->priority) }}">
            <button type="submit" class="btn btn-primary" name="update" value="Update">Update</button>
            <a href="/taskdisplay" class="btn btn-secondary">Back</a>
        </form>
    </div>
</body>
</html>
