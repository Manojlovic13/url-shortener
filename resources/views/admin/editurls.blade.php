<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="icon" href="{{URL::asset('img/icon.png')}}">
    <title>Edit urls</title>
</head>
<body class="admin">
    <div class="admin-kontent">
        <div>
            <ul class="card">
                <li><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li><a href="{{ route('admin.finduser') }}">Find user</a></li>
                <li><a href="{{ route('admin.appInfo') }}">Web site info</a></li>
                <li><a href="{{ route('auth.logout') }}">Log out</a></li>
            </ul>
        </div>
        <h1>Edit urls</h1>
        <div class="alert-success">
            @if(Session::get('success'))
                {{ Session::get('success') }}
            @endif
        </div>
        <div class="admin-tabela">

            @if(isset($urls))
                <p>{{ $user->email }} 's URLs</p>
                <table>
                    <tr>
                        <th>
                            Url ID
                        </th>
                        <th>
                            Long URL
                        </th>
                        <th>
                            Short URL
                        </th>
                        <th>
                            Options
                        </th>
                    </tr>
                    @foreach($urls as $url)
                        <tr>
                            <td>
                                {{$url->id}}
                            </td>
                            <td>
                                {{$url->long_url}}
                            </td>
                            <td>
                                <a href="{{$url->long_url}}">{{$url->short_url}}</a>
                            </td>
                            <td>
                                <a href="/admin/deleteurl/{{$url->id}}">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $urls->links() }}
                @else
                    <p>No urls to show!</p>
            @endif
        </div>
    </div>
    
    
</body>
</html>