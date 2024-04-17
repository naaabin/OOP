<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGNUP PAGE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       

        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            width: 400px;
            padding: 20px;
            border: 2px solid #4caf50;
            border-radius: 10px;
            background-color: #D3D3D3;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-heading {
            margin-bottom: 20px;
            text-align: center;
            font-weight: bold;
            color: red;
        }

        .form-group label {
            font-weight: bold;
            color: #000;
        }

        .form-check-label {
            font-weight: bold;
            color: #000;
        }

        .btn-submit {
            background-color: #4caf50;
            color: #ADD8E6;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-back {
            color: #4caf50;
            font-weight: bold;
            text-decoration: underline;
            cursor: pointer;
        }

        .btn-submit:hover, .btn-back:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
@if(session('message'))
<div class="alert alert-success" style="text-align: center; font-size: 30px;">
        {{ session('message') }}
    </div>
	@endif
<div class="container">

    <div class="form-container">
        <form method="POST" action="{{ route('signupform') }}">
            @csrf
            <h1 class="form-heading">Welcome to the Signup page</h1>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
				@error('name')
					<div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
				@error('password')
    			     <div class="alert alert-danger">{{ $message }}</div>
				@enderror
			</div>

            <div class="form-group">
                <label class="form-check-label">Gender</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" required>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" required>
                    <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="other" value="other" required>
                    <label class="form-check-label" for="other">Other</label>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email address" required>
                @error('email')
    				<div class="alert alert-danger">{{ $message }}</div>
				@enderror
            </div>

            <button type="submit" class="btn btn-submit btn-block">Submit</button>

            <div class="text-center mt-3">
                <button type="button" class="btn btn-back" onclick="go()">Back to login</button>
            </div>
        </form>
    </div>
</div>

<script>
    function go() {
        window.location.href = "loginform";
    }
</script>

</body>
</html>
