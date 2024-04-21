
@if(!session('user_id'))
    <script>window.location.href = '/loginform';</script>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        h1 {
            text-align: center;
            color: #333;
        }

       .error_container 
       {
            text-align: center;
            color: red;
            font-size: xx-large;
            font-weight: bold;
        }

        form {
                background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px; /* Set maximum width for the form */
            margin: auto; /* Center the form horizontally */
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        button {
            background-color: #4285f4;
            color: #fff;
            cursor: pointer;
            text-decoration: none;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 10px;
        }

        button:hover {
            background-color: #3c79dd;
        }

        p {
            color: green;
            text-align: center;
        }

        p.error {
            color: red;
            text-align: center;
        }
    </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
@if(session('message'))
<div class="alert alert-danger" style="text-align: center; font-size: 30px;">
        {{ session('message') }}
    </div>
	@endif

    @if(session('passwordresetstatus'))
<div class="alert alert-success" style="text-align: center; font-size: 30px;">
        {{ session('passwordresetstatus') }}
    </div>
	@endif
   
    <h1>Change Password</h1>
    <form method="post" action="/changepassword">   
        @csrf   
        <label for="old_password">Old Password: </label>
        <input type="password" name="oldpassword" required><br>
        @error('oldpassword')
        <div class="alert alert-danger" style="text-align: center; font-size: 30px;">
            {{$message}}
        </div>
        @enderror
        <label for="password">New Password: </label>
        <input type="password" name="password" required><br>
        @error('password')
        <div class="alert alert-danger" style="text-align: center; font-size: 30px;">
            {{$message}}
        </div>
        @enderror
        

        <label for="confirm_password">Confirm Password: </label>
        <input type="password" name="password_confirmation" required><br>
       

        <input type="submit" name="submit">
        <a href="/projectform"><button type="button" name="goback" value="Back">Back</button></a>
    </form>
</body>
</html>
