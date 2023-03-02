<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404</title>
    <link rel="stylesheet" href="{{ asset('assests/bootstrap/css/bootstrap.min.css') }}">

    <style>
        body{
            padding-top: 5%;
        }
    </style>
</head>
<body>
    <div class="container mt-5 pt-5">
        <div class="alert alert-danger text-center">
            <h2 class="display-3">404</h2>
            <p class="display-5">The page you are looking for dosen't appear</p>
        </div>
        <div class="row">
           <div class="col text-center">
            <a href="/" class="btn btn-success">Home Page</a>
           </div>
        </div>
    </div>
</body>
</html>