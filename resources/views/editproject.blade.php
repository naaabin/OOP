<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EDIT PROJECT</title>
    <link rel="stylesheet" href="editpagestyle.css">
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
            text-align: center;
            color: #e50909;
        }

        form {
            text-align: left;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
<div class="container">

    <h2 align="center">EDIT THE FOLLOWING DETAILS</h2>
    <form method="POST" action="/edit-project">
        @csrf
        <h1>Project</h1>
        <input type="hidden" name="new_ID" value="{{ $project->project_id }}">
        <input type="text" name="new_project" value="{{ old('new_project', $project->Project_name) }}">

        <h1>Description</h1>
        <input type="text" name="new_description" value="{{ old('new_description' , $project->Description) }}">

        <h1>Note</h1>
        <input type="text" name="note" value="">
        @error('note')
        <div class="alert alert-warning">{{ $message }} </div>
        @enderror

        <button type="submit" name="update">Update</button>
        <a href="/projectform"><button class="btn btn-primary" name="back"> Back </button></a>
    </form>
</div>
</body>
</html>
