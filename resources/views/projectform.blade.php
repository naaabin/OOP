
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
            font-weight: bold;
        }

        h1, h2 {
            text-align: center;
            color: #e50909;

        }

        h1 {
            text-align: center;
            color: #09e509;
            font-weight: bolder;
        }

        form {
            margin-top: 10px;
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input{
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
    @if(session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif

    <h1>PROJECT</h1>
    <form method="POST" action="/projectadd">
        @csrf
        <label for="project">Project:</label>
        <input type="text" name="project" id="project" required>
        <label for="Description">Description:</label>
        <input type="text" name="description" id="Description" required>
        <button type="submit" name="add" class="btn btn-success">Add</button> 
        <a href="/todolist" class="btn btn-primary">Add tasks</a>
        <a href="/taskdisplay" class="btn btn-primary">Go to tasks page</a>
        <a href="/users" class="btn btn-primary">Users</a>
        <a href="/filtering" class="btn btn-primary">Go to filter page</a>
        <a href="/changepassword" class="btn btn-primary">Change Password</a>
        <a href="/logout" class="btn btn-danger">Logout</a>
    </form>
</div>
@include('projectdisplay'); 
</body>
</html>
