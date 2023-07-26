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
    <h1>Edit a Developer</h1>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    @endif
    <form action="/developers/{{$developer->id}}" method="POST" class="form-group">
        @csrf
        @method('PATCH')
        <label for="nameInput">Name: </label>
        <input type="text" id="nameInput" name="name" class="form-control" value="{{$developer->name}}"/>
        <br/>
        <input type="submit" name="submit" value="Update Developer" class="btn btn-primary">
    </form>
    <form method="POST" action="/developers/{{$developer->id}}" class="form-group">
        @csrf
        @method("DELETE")
        <input type="submit" value="Delete Developer" name="submit" class="btn btn-primary"/>
    </form>

</div>
</body>
</html>
