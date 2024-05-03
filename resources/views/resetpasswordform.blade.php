<html>
<title>
    Reset Password form
</title>
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/resetpasswordform.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
</body>

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


