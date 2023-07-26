<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('publishers') }}">View All</a></li>
            <li><a href="{{ URL::to('publishers/create') }}">Create</a>
        </ul>
    </nav>
    <h1>Edit a Publisher</h1>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    @endif
    <form action="/publishers/{{$publisher->id}}" method="POST" class="form-group">
        @csrf
        @method('PATCH')
        <label for="nameInput">Name: </label>
        <input type="text" id="nameInput" name="name" class="form-control" value="{{$publisher->name}}"/>
        <br/>
        <input type="submit" name="submit" value="Update Publisher" class="btn btn-primary">
    </form>
    <form method="POST" action="/publishers/{{$publisher->id}}" class="form-group">
        @csrf
        @method("DELETE")
        <input type="submit" value="Delete Publisher" name="submit" class="btn btn-primary"/>
    </form>
</div>
</body>
</html>
