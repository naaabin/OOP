@if(!session('user_id'))
    <script>window.location.href = '/loginform';</script>
@endif
<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>Delete Confirmation</title>
            
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        margin: 0;
                        padding: 0;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        height: 100vh;
                    }

                    .container {
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        width: 400px;
                        text-align: center;
                    }

                    h1 {
                        color: #333;
                        text-align: center;
                    }

                    .button-container {
                        margin-top: 20px;
                    }

                    button {
                        background-color: #4caf50;
                        color: #fff;
                        padding: 10px 20px;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        font-size: 16px;
                    }

                    button:hover {
                        background-color: #45a049;
                    }

                    .error {
                        color: #f00;
                    }
                    form, a
                    {
                        background-color: #4caf50;
                         color: #fff;
                        padding: 10px 10px;
                        border: none;
                        border-radius: 1px;
                        cursor: pointer;
                        font-size: 16px;
                        margin-right: 15px;
                        margin-left: 15px ;
                    }
                    }
                </style>  
            </head>
            <body>
                <h3>Are you sure you want to delete this record?</h3>
                <form method="post" action="/deletetask">
                    <input type="hidden" name="id" value="{{$task->task_id}} ">
                    <input type="submit" name="confirmDelete" value="Confirm Delete">
                </form>
                <a href="/taskdisplay"><button type="button">Go back to the Display page</button></a>
            </body>
            </html>