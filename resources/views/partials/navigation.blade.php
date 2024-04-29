
<!doctype html>
<html lang="en">
<head>
    <style>
        h5 {
            display: inline-block;
            margin-left: 20px; /* Add some spacing between headings */
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
    <h5><a href="{{ route($routeName) }}">{{ $linkText }}</a></h5>
@endif
@endforeach

</body>
</html>


