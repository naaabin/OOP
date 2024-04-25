<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Update Status</title>
    <style>
       .container {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            text-align: center;
        }

</style>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Task Update Details</h1>
        <div class="row">
            <div class="col">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th>Note Description</th>
                            <th>Last Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $count = 1;
                        @endphp
                        @foreach ($tasks as $task)
                            @if($task->notes->isEmpty())
                                <tr>
                                    <td colspan="3">No notes found</td>
                                </tr>
                            @else
                                @foreach ($task->notes as $note)
                                    <tr>
                                        <td>{{ $count++ }}</td>
                                        <td>{{ $note->Description }}</td>
                                        <td>{{ $note->updated_at }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
</body>
</html>
