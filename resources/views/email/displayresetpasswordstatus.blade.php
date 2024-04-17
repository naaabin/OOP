<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
    <body>
        @if (session('message'))
        <div class="alert alert-warning" style="text-align: center; font-size: 30px;">
            {{ session('message') }}
        </div>
        @endif
        test
    </body>
</html>
