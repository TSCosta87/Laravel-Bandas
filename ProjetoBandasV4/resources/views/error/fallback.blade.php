<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Page Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .error-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .error-content {
            text-align: center;
        }
        .error-content h1 {
            font-size: 10rem;
            font-weight: 700;
        }
        .error-content h2 {
            font-size: 2rem;
            font-weight: 300;
        }
    </style>
</head>
<body>
<div class="container error-container">
    <div class="error-content">
        <img src="{{asset('img/logo.png')}}">
        <h1 class="display-1">404</h1>
        <h2>Oops! Page Not Found</h2>
        <p class="lead">The page you are looking for does not exist.</p>
        <a href="{{ url('/') }}" class="btn btn-warning">Go Back Home</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
