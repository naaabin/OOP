
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your To-Do List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/7b92c82a52.js" crossorigin="anonymous"></script>
    <script>
        function downloadFile(filePath, fileName) {
            // Show a confirmation dialog
            var userConfirmation = confirm("Do you want to download this file?");

            // If the user confirms, trigger the download
            if (userConfirmation) {
                // Create an invisible link and simulate a click
                var link = document.createElement('a');
                link.href = filePath + '?name=' + fileName;
                link.download = fileName;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } else {
                // If the user cancels, do nothing or provide feedback
                console.log('Download cancelled by the user.');
            }
        }
    </script>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #e7d7d7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            color: #e50909;
        }

        form {
            margin-top: 20px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, button {
            margin-bottom: 10px;
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .alert {
            text-align: center;
            font-size: 24px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>To-Do List</h1>

    <form method="POST" enctype="multipart/form-data" action="/addtask">
        @csrf
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="form-group">
            <label for="task">New Task:</label>
            <input type="text" class="form-control" name="task" id="task" required>
        </div>

        <div class="form-group">
            <label for="Description">Description:</label>
            <input type="text" class="form-control" name="description" id="Description" required>
        </div>

        <div class="form-group">
            <label for="fileInput">Upload File(s):</label>
            <input type="file" class="form-control-file" name="FILE[]" id="fileInput" multiple>
        </div>

        <div class="form-group">
            <label>Priority:</label>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="priority" value="Yes"> YES
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="priority" value="No" checked required> NO
            </div>
        </div>

        <div class="form-group">
            <label>Projects:</label>
            @foreach ($projects as $project)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="selectedProjects[]" value="{{ $project['Project_name'] }}">
                    <label class="form-check-label">{{ $project['Project_name'] }}</label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label>Users:</label>
            @foreach ($users as $user)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="selectedUsers[]" value="{{ $user['name'] }}">
                    <label class="form-check-label">{{ $user['name'] }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary" name="addtask">Add Task</button>
        <a href="/projectform" class="btn btn-secondary">Go to Projects Page</a>
        <a href="/taskdisplay" class="btn btn-secondary">Go to Tasks Page</a>
        <a href="/users" class="btn btn-secondary">Users</a>
        <a href="/logout" class="btn btn-secondary" name="logout" value="Logout">Logout</a>
    </form>
</div>

</body>
</html>
