
@extends('layouts.app')
@section('title', 'Project page')
@section('css')
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 <link rel="stylesheet" type="text/css" href="{{ asset('css/signupform.css') }}">
 @endsection

<body>
@section('content')

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
@endsection
</body>
</html>
