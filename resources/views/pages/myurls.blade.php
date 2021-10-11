<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="icon" href="{{URL::asset('img/icon.png')}}">
    <title>My Urls</title>
</head>
<body onload="menjaj(slike)">
    <div class="meni">
        <h1 class="outline">MyURL</h1>
        <ul class="card">
            <li><a href='/pages/home'>Home <i class="fas fa-home"></i></a></li>
            <li><a href='/pages/profile'>My profile <i class="fas fa-user-alt"></i></a></li>
            <li><a href='/pages/settings'>Settings <i class="fas fa-cog"></i></a></li>
            <li><a href='/auth/logout'>Log out <i class="fas fa-sign-out-alt"></i></a></li>
        </ul>
    </div>

    <div class="kontent">
        <div class="kartica2 tabela-url">
            <h1>Here are all your short urls</h1>

            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if(isset($urls))
                <table class="tabela">
                    <tr>
                        <th>Long url</th>
                        <th>Short url</th>
                        <th>Options</th>
                    </tr>
                    @foreach($urls as $url)
                        <tr>
                            <td>
                                <p>{{$url->long_url}}</p>
                            </td>
                            <td>
                                <a href="{{$url->long_url}}">{{$url->short_url}}</a>
                            </td>
                            <td class="ikonice">
                                <a href='/pages/urlchange/{{$url->id}}' class="link"><i class="fas fa-pen"></i></a>
                                <a href='delete/{{$url->id}}' class="link"><i class="fas fa-trash-alt"></i></a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $urls->links() }}
            @endif
        </div>
    </div>

    

    <script src="{{URL::asset('js/script.js')}}"> </script>
    <script src="https://kit.fontawesome.com/be0e439fc6.js" crossorigin="anonymous"></script>
</body>
</html>