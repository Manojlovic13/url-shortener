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
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.appInfo') }}">Web site info</a></li>
                <li><a href="{{ route('auth.logout') }}">Log out</a></li>
            </ul>
        </div>

        <h1>Find user</h1>

        <form method="GET" action="{{ route('admin.finduser') }}">
            <fieldset class="admin-fieldset">    
                <legend>Find by</legend>
                <div class="admin-forma">
                    <input type="radio" name="findby" value="email" id="email" checked>
                    <label for="email">Email</a>
                    <input type="radio" name="findby" value="name" id="name">
                    <label for="name">Name</label>
                    <input type="radio" name="findby" value="id" id="id">
                    <label for="id">ID</label>
                    <input type="radio" name="findby" value="showAll" id="showAll">
                    <label for="showAll">Show all</label>
                </div>
                <div class="admin-forma">
                    <input type="text" name="searchValue" placeholder="Enter search criteria..."  class="box">
                </div>
                <span class='text-danger'>@error('searchValue'){{$message}}@enderror</span>
                <div class="alert-fail">
                    @if (Session::get('fail'))
                        {{ Session::get('fail') }}
                    @endif
                </div>
                <div class="alert-success">
                    @if (Session::get('success'))
                        {{ Session::get('success') }}
                    @endif
                </div>
                <div class="admin-forma">
                    <input type="submit" value="Search">
                </div>
            </fieldset>
        </form>

        @if(isset($users))
            <div class="admin-tabela">
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>User role</th>
                        <th>Total URLs</th>
                        <th>Active URLs</th>
                        <th>Deleted URLs</th>
                        <th>Options</th>
                    </tr>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                {{$user->id}}
                            </td>
                            <td>
                                {{$user->name}}
                            </td>
                            <td>
                                {{$user->email}}
                            </td>
                            <td>
                                @if($user->user_role == 0) Korisnik @else Admin @endif
                            </td>
                            <td>
                                {{$user->total_urls}}
                            </td>
                            <td>
                                {{$user->active_urls}}
                            </td>
                            <td>
                                {{$user->deleted_urls}}
                            </td>
                            <td>
                                <a href="/admin/finduser/delete/{{$user->id}}">Delete</a>
                                <a href="/admin/finduser/changerole/{{$user->id}}">Change role</a>
                                <a href="/admin/editurls/{{$user->id}}">Edit urls</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $users->links() }}
            </div>
        </div>
    @endif
</body>
</html>