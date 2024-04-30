@extends('layouts.app')
@section('title', 'Users Dashboard')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/users.css') }}">
@endsection


@section('content')
<h1> Users and their Details</h1> 
<table align="center">
<tr>
    <th>User ID</th>
    <th>Name</th> 
    <th>Email Address</th>
    <th>Assigned Tasks</th>
    <th>Tasks IDs</th>
</tr>

@foreach ($users as $user)
<tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
    @if($user->tasks->isNotEmpty())
            @php
                $taskNames = $user->tasks->pluck('task')->implode(', ');
            @endphp
            {{ $taskNames }}
        @endif
    </td>
    <td>
        @if($user->tasks)
            @php
                $taskIds = $user->tasks->pluck('task_id')->implode(', ');
            @endphp
            {{ $taskIds }}
        @endif
    </td>
</tr>
@endforeach
</table>
@endsection

