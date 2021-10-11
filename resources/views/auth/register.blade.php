<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="icon" href="{{URL::asset('img/icon.png')}}">
    <title>Register</title>
</head>
<body onload="menjaj(slike)">
    <div class="meni">
        <h1 class="outline"> MyURL </h1>
        <ul class="card">
            <li><a href="/">Back</a></li>
            <li><a href="/auth/login">Log in</a></li>
        </ul>
    </div>

    <div class="kartica">
        <h2>Register</h2>
        <form method="POST" action="{{ route('auth.save')}}" class="forma">
            @if(Session::get('success'))
                <div class='alert alert-success'>
                    {{ Session::get('success') }}
                </div>
            @endif
            @if(Session::get('fail'))
                <div class='alert alert-danger'>
                    {{ Session::get('fail') }}
                </div>
            @endif
            @csrf
            <div class="reg">
                <label for='name'>Name:</label>
                <input type="text" name="name" value="{{ old('name') }}" class="box" placeholder="Enter your name">
            </div>
            <span class='text-danger'>@error('name'){{$message}} @enderror</span>
            <br>

            <div class="reg"> 
                <label for='email'>Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" class="box" placeholder="Enter your email">
            </div>
            <span class='text-danger'>@error('email'){{$message}} @enderror</span>
            <br>

            <div class="reg">
                <label for='password'>Password:</label>
                <input type="password" name="password" class="box" placeholder="Enter your password">
            </div>
            <span class='text-danger'>@error('password'){{$message}} @enderror</span>
            <br>
            <div class="dugme">
                <input type="submit" value="Register">
            </div>            
            <br>
        </form>
    </div>

    <script src="{{URL::asset('js/script.js')}}"> </script>
</body>
</html>