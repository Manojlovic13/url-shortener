<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="icon" href="{{URL::asset('img/icon.png')}}">
    <title>Dashboard</title>
</head>
<body class="admin">
    <div class="admin-kontent">
        <div>
            <ul class="card">
                <li><a href="{{ route('admin.finduser') }}">Find user</a></li>
                <li><a href="{{ route('admin.appInfo') }}">Web site info</a></li>
                <li><a href="{{ route('auth.logout') }}">Log out</a></li>
            </ul>
        </div>
        <h1 class="welcome">Welcome to admin dashboard</h1>
        @if (Session::get('fail'))
            <div class="alert-fail">
                {{ Session::get('fail') }}
            </div>
        @endif
    </div>
    
</body>
</html>