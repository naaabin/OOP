<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #e9ecef);
        }

        .container {
            max-width: 600px;
            margin: 100px auto;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background-color: #007bff;
            border-radius: 15px 15px 0 0;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 1.5em;
        }

        .card-body {
            padding: 30px;
        }

        .btn-primary {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            font-size: 1.2em;
        }

        .btn-secondary {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            font-size: 1.2em;
        }

        .btn-secondary:hover {
            background-color: #6c757d;
        }

        h1{
            text-align: center;
            color:rgb(240, 16, 16);
            margin-bottom: 40px;
            font-size: 2.5em;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to the Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3><a href="/loginform" style="color: #fff; text-decoration: none;">Login</a></h3>
                </div>
            
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3><a href="/signupform" style="color: #fff; text-decoration: none;">Sign Up</a></h3>
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
