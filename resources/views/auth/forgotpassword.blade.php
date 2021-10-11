<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="icon" href="{{URL::asset('img/icon.png')}}">
    <title>Forgot your password</title>
</head>
<body onload="menjaj(slike)">
    <div class="meni">
        <h1 class="outline"> MyURL </h1>
        <ul class="card">
            <li><a href="/auth/register">Register</a></li>
            <li><a href="/auth/login">Log in</a></li>
        </ul>
    </div>  

    <div class="kartica">
        <h2>Retrieve your account</h2>
        <form method="POST" action="/auth/resetlink" class="forma">
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if (Session::get('fail'))
                <div class="alert alert-fail">
                    {{ Session::get('fail') }}
                </div>
            @endif
            @csrf
            <div class="reg">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Enter your email" class="box">
            </div>
            <br>

            <div class="dugme">
                <input type="submit" value="Submit">
            </div>
            <br>
        </form>
    </div>

    <script src="{{URL::asset('js/script.js')}}"> </script>
</body>
</html>