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
            <li><a href="{{ URL::to('tags') }}">View All</a></li>
            <li><a href="{{ URL::to('tags/create') }}">Create</a>
        </ul>
    </nav>

    <h1>Tags List: </h1>
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Actions</td>
        </tr>
        </thead>
        <tbody>
        @foreach($tags as $key => $value)
            <tr>
                <td>{{ $value->id }}</td>
                <td>{{ $value->name }}</td>
                <td>
                    <a class="btn btn-small btn-success" href="{{ URL::to('tags/' . $value->id) }}">Show</a>
                    <a class="btn btn-small btn-info" href="{{ URL::to('tags/' . $value->id . '/edit') }}">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
