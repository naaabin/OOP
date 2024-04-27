<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            font-weight: bold;
        }

        h1 {
            color: #d7e6f7;
            text-align: center;
        }

        p {
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff2600;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #dadd1f;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Password Reset</h1>
        <p>Hello User,</p>
        <p>You have requested to reset your password. Please click on the following link to proceed with the password reset:</p>
        <a class="btn" href="{{ $resetUrl }}">Reset Password</a>
        <p>If you did not request this password reset, you can safely ignore this email. Your password will not be changed.</p>
        <p>Thank you,<br>Cybertron Technologies</p>
   
    </div>
</body>
</html>

