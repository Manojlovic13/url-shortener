<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="icon" href="{{URL::asset('img/icon.png')}}">
    <title>Log in</title>
</head>
<body onload="menjaj(slike)">
    <div class="meni">
        <h1 class="outline"> MyURL </h1>
        <ul class="card">
            <li><a href="/">Back</a></li>
            <li><a href="/auth/register">Register</a></li>
        </ul>
    </div>

    <div class="kartica">
        <h2>Log in</h2>
        <form method="POST" action="{{ route('auth.check') }}" class="forma">
            @if(Session::get('fail'))
                <div class="alert alert-fail">
                    {{ Session::get('fail') }}
                </div>
            @endif
            @if(Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            @csrf
            <div class="reg">
                <label for="email">Email:</label>
                <input type="email"  name='email' value="{{ old('email') }}" class="box" placeholder="Enter your email">
            </div>
            <span class='text-danger'>@error('email'){{$message}} @enderror</span>
            <br>

            <div class="reg">
                <label for="password">Password:</label>
                <input type="password" name='password' class="box" placeholder="Enter your password">
            </div>
            <span class='text-danger'>@error('password'){{$message}} @enderror</span>
            <br>

            <div class="forgot reg">
                <a href="/auth/forgotpassword">Forgot your password?</a>
            </div>
            <br>

            <div class="dugme">
                <input type="submit" value="Log in">
            </div>
            <br>
        </form>
    </div>

    <script src="{{URL::asset('js/script.js')}}"> </script>
</body>
</html>