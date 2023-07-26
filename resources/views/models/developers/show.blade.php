<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('developers') }}">View All</a></li>
            <li><a href="{{ URL::to('developers/create') }}">Create</a>
        </ul>
    </nav>

    <h1>{{$developer->name}}: </h1>
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
        <tr>
            <td>{{ $developer->id }}</td>
            <td>{{ $developer->name }}</td>
            <td>
                <a class="btn btn-small btn-info" href="{{ URL::to('developers/' . $developer->id . '/edit') }}">Edit</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
