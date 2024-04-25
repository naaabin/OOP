<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>

        body {
            margin: 0;
            padding: 0;
            background-color: #ADD8E6;
        }

        .container {
            width: 400px;
            height: 400px;
            margin: 100px auto;
            background-color: #D3D3D3;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            text-align: center;
            width: 50%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4caf50;
            color: #ADD8E6;
            padding: 20px 15px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        form {
            width: 800px;
            height: 700px;
            border-radius: 8px;
            font-size: XX-LARGE;
        }
   
    </style>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>

    <div class="container">
        
        
        @if(session('message'))
            <div class="alert alert-danger" style="text-align: center; font-size: 30px;">
                {{session('message')}}
        </div>
        @endif
        <h1>Reset Password</h1>
        <form method="POST" action="/resetpassword">
            @csrf
            <div class="form-group">
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
                <label for="password">New Password: </label>
                <input type="password" name="password" required><br>
                @error('password')
                  <div class="alert alert-danger" style="text-align: center; font-size: 30px;">
                        {{$message}}
                    </div>   
                @enderror
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password: </label>
                <input type="password" name="password_confirmation" required><br>
            </div>

            <input type="submit" name="submit" value="Reset Password">
        </form>
    </div>
</body>
</html>
