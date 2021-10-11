<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="icon" href="{{URL::asset('img/icon.png')}}">
    <title>MyURL</title>
</head>
<body onload="menjaj(slike)">
    <div class="meni">
        <h1 class="outline"> MyURL </h1>
        <ul class="card">
            <li><a href="/auth/register">Register</a></li>
            <li><a href="/auth/login">Login</a></li>
        </ul>
    </div>

    <script src="{{URL::asset('js/script.js')}}"> </script>
</body>
</html>