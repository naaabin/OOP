
<!doctype html>
<html lang="en">
<head>
    <style>
        h5 {
            display: inline-block;
            margin-left: 20px; /* Add some spacing between headings */
        }
        .custom-button {
        background-color: green;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        transition-duration: 0.4s;
    }

    .custom-button:hover {
        background-color: white; 
        color: black; 
        border: 1px solid #4CAF50;
    }
    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
 
@php
$navLinks = [
    'todolist' => 'Add tasks',
    'taskdisplay' => 'Go to tasks page',
    'projectdisplay' => 'Go to Projects page',
    'users' => 'Users',
    'filtering' => 'Go to filter page',
    'changepassword' => 'Change Password',
    'logout' => 'Logout',
]
@endphp

@foreach ($navLinks as $routeName => $linkText)
    @if (!Request::is($routeName))
        <button class="btn btn-primary custom-button">
            <h5><a href="{{ route($routeName) }}" style="text-decoration: none; color: inherit;">{{ $linkText }}</a></h5>
        </button>
    @endif
@endforeach

</body>
</html>


