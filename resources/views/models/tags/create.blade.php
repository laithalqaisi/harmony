<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('tags') }}">View All</a></li>
            <li><a href="{{ URL::to('tags/create') }}">Create</a>
        </ul>
    </nav>
    <h1>Create a Tag</h1>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    @endif
    <form action="/tags" method="POST" class="form-group">
        @csrf
        <label for="nameInput">Name: </label>
        <input type="text" id="nameInput" name="name" class="form-control"/>
        <br/>
        <input type="submit" name="submit" value="Create Tag" class="btn btn-primary">
    </form>

</div>
</body>
</html>
