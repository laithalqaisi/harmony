<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('games') }}">View All</a></li>
            <li><a href="{{ URL::to('games/create') }}">Create</a>
        </ul>
    </nav>

    <h1>{{$game->name}}: </h1>
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Rating</td>
            <td>Release Date</td>
            <td>Publisher</td>
            <td>Developers</td>
            <td>Tags</td>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $game->id }}</td>
            <td>{{ $game->name }}</td>
            <td>{{ $game->rating }}</td>
            <td>@if($game->release_date) {{ date('d M, Y', strtotime($game->release_date))}} @else COMING SOON @endif</td>
            <td>{{ $game->publisher->name}}</td>
            <td>
                @foreach($game->developers as $developer)
                    @if($loop->last)
                        {{$developer->name}}
                    @else
                        {{$developer->name}},
                    @endif
                @endforeach
            </td>
            <td>
                @foreach($game->tags as $tag)
                    @if($loop->last)
                        {{$tag->name}}
                    @else
                        {{$tag->name}},
                    @endif
                @endforeach
            </td>
            <td>
                <a class="btn btn-small btn-info" href="{{ URL::to('games/' . $game->id . '/edit') }}">Edit</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
