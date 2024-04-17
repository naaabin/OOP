<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget password</title>
    <style>
        body {
            text-align: center;
        }

        h1 {
            text-align: center;
            color: red;
        }
        h2 {
            text-align: center;
            color: green;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
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

    <!-- Forgot Password Form -->
    @if (session('message'))
    <div class="alert alert-success" style="text-align: center; font-size: 30px;">
        {{ session('message') }}
    </div>
@endif
    <form method="post"   action="/forgetpassword">
        @csrf
        <h1> Please enter your Email Address.</h1>
        <label for="Email Address">Email Address </label>
        <input type="email" name="email" id="Email Address" required>
        @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                @enderror
        <input type="submit" name="submit" value="Submit"><br>
        <a href="/loginform"><button type="button" name="gobacklogin">Go back to login</button></a>
    </form>
</body>
</html>
