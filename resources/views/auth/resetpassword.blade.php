<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="icon" href="{{URL::asset('img/icon.png')}}">
    <title>Reset your password</title>
</head>
<body>
    <div class="meni">
        <h1 class="outline"> MyURL </h1>
        <ul class="card">
            <li><a href="/auth/register">Register</a></li>
            <li><a href="/auth/login">Login</a></li>
        </ul>
    </div>  
    
    <div class="kartica">
        <h2>Reset your password</h1>
        <form method="POST" action="/auth/resetPassword" class="forma">
            @if (Session::get('fail'))
                <div class="alert alert-fail">
                    {{ Session::get('fail') }}
                </div>
            @endif
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="reg">
                <label for="email">Email:</label>
                <input type="email" name="email" class="box" placeholder="Enter your email">
            </div>
            <span class='text-danger'>@error('email'){{$message}} @enderror</span>
            <br>

            <div class="reg">
                <label for="password1">New password:</label>
                <input type="password" name="password1" class="box" placeholder="Enter new password">
            </div>
            <br>

            <div class="reg">
                <label for="password2">Confirm your password:</label>
                <input type="password" name="password2" class="box" placeholder="Confirm password">
            </div>
            <br>

            <div class="dugme">
                <input type="submit" value="Change my password">
            </div>
            <br>

        </form>
    </div>
</body>
</html>