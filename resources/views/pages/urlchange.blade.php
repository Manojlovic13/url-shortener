<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="icon" href="{{URL::asset('img/icon.png')}}">
    <title>Change url</title>
</head>
<body>
    <div class="meni">
        <h1 class="outline">MyURL</h1>
        <ul class="card">
            <li><a href='/pages/home'>Home <i class="fas fa-home"></i></a></li>
            <li><a href='/pages/profile'>My profile <i class="fas fa-user-alt"></i></a></li>
            <li><a href='/pages/myurls'>My short urls <i class="fas fa-link"></i></a></li>
            <li><a href='/pages/settings'>Settings <i class="fas fa-cog"></i></a></li>
            <li><a href='/auth/logout'>Log out <i class="fas fa-sign-out-alt"></i></a></li>
        </ul>
    </div>

    <div class="kontent">
        <div class="kartica2">
            <h1>Change this url shortcut</h1>

            @if (Session::get('fail'))
                <div class="alert alert-fail">
                    {{ Session::get('fail') }}
                </div>
            @endif
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            
            <form method="POST" action="/pages/change/{{$urlid}}" class="forma2">
                @csrf
                <div class="reg">
                    <label>Long url:</label>
                    <input type="text" name="long_url" value="{{ $long_url }}" class="box box2">
                </div>
                <br>
                <div class="reg">
                    <label>Short url:</label>
                    <input type="text" name="short_url" value="{{ $short_url }}" class="box box2">
                </div>
                <br>
                <div class="dugme">
                     <input type="submit" value="Change">
                </div>
            </form>
            <p>If you don't want to change one of two urls, leave input field blank or don't change it at all!</p>
            <br>
        </div>
    </div>

    <script src="{{URL::asset('js/script.js')}}"> </script>
    <script src="https://kit.fontawesome.com/be0e439fc6.js" crossorigin="anonymous"></script>
</body>
</html>