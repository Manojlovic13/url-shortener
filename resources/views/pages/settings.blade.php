<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="icon" href="{{URL::asset('img/icon.png')}}">
    <title>Settings</title>
</head>
<body onload="menjaj(slike)">
    <div class="meni">
        <h1 class="outline">MyURL</h1>
        <ul class="card">
            <li><a href='/pages/home'>Home <i class="fas fa-home"></i></a></li>
            <li><a href='/pages/profile'>My profile <i class="fas fa-user-alt"></i></a></li>
            <li><a href='/pages/myurls'>My short urls <i class="fas fa-link"></i></a></li>
            <li><a href='/auth/logout'>Log out <i class="fas fa-sign-out-alt"></i></a></li>
        </ul>
    </div>

    <div class="kontent">
        <div class="settings">
            <h2> Change your username </h2>

            @if (Session::get('nameSuccess'))
                <div class='alert alert-success'>
                    {{ Session::get('nameSuccess') }}
                </div>
            @endif
            @if (Session::get('nameFail'))
                <div class="alert alert-fail">
                    {{ Session::get('nameFail') }}
                </div>
            @endif
            
            <form method="POST" action="settings/name" class="forma3">
            @csrf
                <div class="reg">
                    <label for="name">Your name is {{ session('UserName') }}, change it to:</label>
                    <input type="text" name="name" class="box" placeholder="New username">
                </div>
                <br>
                <div class="dugme">
                    <input type="submit" value="Change name">
                </div>
                <br>
            </form>
        </div>

        <div class="settings">
            <h2> Change your email </h2>

            @if (Session::get('emailSuccess'))
            <div class="alert alert-success">
                {{ Session::get('emailSuccess') }}
            </div>
            @endif
            @if (Session::get('emailFail'))
                <div class="alert alert-fail">
                    {{ Session::get('emailFail') }}
                </div>
            @endif

            <form method="POST" action="settings/email" class="forma3">
            @csrf
                <div class="reg">
                    <label for="oldEmail">Enter your old email:</label>
                    <input type="email" name="oldEmail" class="box" placeholder="Old email">
                </div>
                <br>
                <div class="reg">
                    <label for="newEmail">Enter your new email:</label>
                    <input type="email" name="newEmail" class="box" placeholder="New email">
                </div>
                <br>
                <div class="dugme">
                    <input type="submit" value="Change email">
                </div>
                <br>
            </form>
        </div>

        <div class="settings">
            <h2> Change your password </h2>

            @if (Session::get('passwordFail'))
            <div class="alert alert-fail">
                {{ Session::get('passwordFail') }}
            </div>
            @endif
            @if (Session::get('passwordSuccess'))
                <div class="alert alert-success">
                    {{ Session::get('passwordSuccess') }}
                </div>
            @endif

            <form method="POST" action="settings/password" class="forma3">
            @csrf
                <div class="reg">
                    <label for="oldPassword">Enter your old password:</label>
                    <input type="password" name="oldPassword" class="box" placeholder="Old password">
                </div>
                <br>
                <div class="reg">
                    <label for="newPassword1">Enter your new password:</label>
                    <input type="password" name="newPassword1" class="box" placeholder="New password">
                </div>
                <br>
                <div class="reg">
                    <label for="newPassword2">Type again the new password:</label>
                    <input type="password" name="newPassword2" class="box" placeholder="New password">
                </div>
                <br>
                <div class="dugme">
                    <input type="submit" value="Change password">
                </div>
                <br>
            </form>
        </div>
    </div>

    <script src="{{URL::asset('js/script.js')}}"> </script>
    <script src="https://kit.fontawesome.com/be0e439fc6.js" crossorigin="anonymous"></script>
</body>
</html>