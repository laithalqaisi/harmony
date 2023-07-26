<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li><a href="/">Home</a></li>
            <li><a href="{{ URL::to('games') }}">View All</a></li>
            <li><a href="{{ URL::to('games/create') }}">Create</a>
        </ul>
    </nav>

    <h1>Games List: </h1>
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
        @foreach($games as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>{{ $value->rating }}</td>
                <td>@if($value->release_date) {{ date('d M, Y', strtotime($value->release_date))}} @else COMING SOON @endif</td>
                <td>{{ $value->publisher->name}}</td>
                <td>
                    @foreach($value->developers as $developer)
                        @if($loop->last)
                            {{$developer->name}}
                        @else
                            {{$developer->name}},
                        @endif
                    @endforeach
                </td>
                <td>
                    @foreach($value->tags as $tag)
                        @if($loop->last)
                            {{$tag->name}}
                        @else
                            {{$tag->name}},
                        @endif
                    @endforeach
                </td>
                <td>
                    <a class="btn btn-small btn-success" href="{{ URL::to('games/' . $value->id) }}">Show</a>
                    <a class="btn btn-small btn-info" href="{{ URL::to('games/' . $value->id . '/edit') }}">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
