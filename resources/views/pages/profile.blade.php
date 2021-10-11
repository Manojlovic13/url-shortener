<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="icon" href="{{URL::asset('img/icon.png')}}">
    <title>Profile {{ $name }}</title>
</head>
<body onload="menjaj(slike)">
    <div class="meni">
        <h1 class="outline">MyURL</h1>
        <ul class="card">
            <li><a href='/pages/home'>Home <i class="fas fa-home"></i></a></li>
            <li><a href='/pages/myurls'>My short urls <i class="fas fa-link"></i></a></li>
            <li><a href='/pages/settings'>Settings <i class="fas fa-cog"></i></a></li>
            <li><a href='/auth/logout'>Log out <i class="fas fa-sign-out-alt"></i></a></li>
        </ul>
    </div>

    <div class="kontent">
        <div class="kartica2">
            <h1>Profile view</h1>

            <div class="profil-podaci top-border">
                <p>Name:</p>
                <span><b>{{ $name }}</b></span>
            </div>

            <div class="profil-podaci">
                <p>Email:</p>
                <span><b>{{ $email }}</b></span>
            </div>

            <div class="profil-podaci">
                <p>Total urls:</p>
                <span><b>{{ $total_urls }}</b></span>
            </div>

            <div class="profil-podaci">
                <p>Active urls:</p>
                <span><b>{{ $active_urls }}</b></span>
            </div>

            <div class="profil-podaci">
                <p>Deleted urls:</p>
                <span><b>{{ $deleted_urls }}</b></span>
            </div>
            <br>
        </div>
    </div>

    <script src="{{URL::asset('js/script.js')}}"> </script>
    <script src="https://kit.fontawesome.com/be0e439fc6.js" crossorigin="anonymous"></script>
</body>
</html>