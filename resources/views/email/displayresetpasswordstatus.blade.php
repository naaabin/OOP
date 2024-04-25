<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
    <body>
        @if(isset($message))
    <div class="alert alert-warning" style="text-align:center; font-size: 40px;">
        {{ $message }}
    </div>
@endif

    </body>
</html>
