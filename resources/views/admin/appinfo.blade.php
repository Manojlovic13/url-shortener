<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">
    <link rel="icon" href="{{URL::asset('img/icon.png')}}">
    <title>MyUrl App Info</title>
</head>
<body class="admin">
    <div class="admin-kontent">
        <div>
            <ul class="card"> 
                <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('admin.finduser') }}">Find user</a></li>
                <li><a href="{{ route('auth.logout') }}">Log out</a></li>
            </ul>
        </div>
        <h1>MyUrl App Info</h1>
        <div class="admin-info">
            <div>
                <h3>General info</h3>
                <p>Total users: {{ $total_users }} </p>
                <p>Total urls: {{ $total_urls }} </p>
                <p>Total active urls: {{ $total_active_urls }} </p>
                <p>Total deleted urls: {{ $total_deleted_urls }}</p>
            </div>
            
            <div>
                <h3>User with most urls</h3>
                <p>ID: {{$user_with_most_urls->id}}</p>
                <p>Name: {{$user_with_most_urls->name}}</p>
                <p>Email: {{$user_with_most_urls->email}}</p>
                <p>Total urls: {{$user_with_most_urls->total_urls}}</p>
                <p><a href="/admin/editurls/{{$user_with_most_urls->id}}">Active urls: {{$user_with_most_urls->active_urls}}</a></p>
                <p>Deleted urls: {{$user_with_most_urls->deleted_urls}}</p>
            </div>

            <div>
                <h3>User with most active urls</h3>
                <p>ID: {{$user_with_most_active_urls->id}}</p>
                <p>Name: {{$user_with_most_active_urls->name}}</p>
                <p>Email: {{$user_with_most_active_urls->email}}</p>
                <p>Total urls: {{$user_with_most_active_urls->total_urls}}</p>
                <p><a href="/admin/editurls/{{$user_with_most_active_urls->id}}">Active urls: {{$user_with_most_active_urls->active_urls}}</a></p>
                <p>Deleted urls: {{$user_with_most_active_urls->deleted_urls}}</p>
            </div>
        </div>
    </div>
    
</body>
</html>