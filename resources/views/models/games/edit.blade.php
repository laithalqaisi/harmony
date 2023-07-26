<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.multipleSelect').select2({placeholder: 'Select an Option'});
            $('#comingSoonCheck').click(function (){
                $('#releaseDateInput').prop('disabled', function (i, v) {return !v;})
            });
        });
    </script>
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance:textfield;
        }
    </style>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('games') }}">View All</a></li>
            <li><a href="{{ URL::to('games/create') }}">Create</a>
        </ul>
    </nav>
    <h1>Edit a Game</h1>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    @endif
    <form action="/games/{{$game->id}}" method="POST" class="form-group">
        @csrf
        @method('PATCH')
        <label for="nameInput">Name: </label>
        <input type="text" id="nameInput" name="name" value="{{$game->name}}" class="form-control"/>
        <br/>
        <label for="ratingInput">Rating: </label>
        <input type="number" id="ratingInput" name="rating" value="{{$game->rating}}" class="form-control" step="0.1"/>
        <br/>
        <label for="releaseDateInput">Release Date: </label>
        <br/>
        <label for="comingSoonCheck">Coming Soon</label>
        <input type="checkbox" id="comingSoonCheck" @if($game->release_date == null) checked @endif>
        <input type="date" id="releaseDateInput" name="release_date" class="form-control" min="1971-01-01" max="{{date('Y-m-d')}}"
               @if($game->release_date == null) disabled @endif value="{{date('Y-m-d', strtotime($game->release_date))}}" />
        <br/>
        <label for="publisherInput">Publisher: </label>
        <select id="publisherInput" name="publisher_id" class="form-control form-control-sm">
            <option selected></option>
            @foreach($publishers as $publisher)
                <option value="{{$publisher->id}}" @if($publisher->id == $game->publisher_id) selected @endif>{{$publisher->name}}</option>
            @endforeach
        </select>
        <br/>
        <label for="developersInput">Developers: </label>
        <select id="developersInput" name="developers_id[]" class="form-control form-control-sm multipleSelect" multiple="multiple">
            @foreach($developers as $developer)
                <option value="{{$developer->id}}" @if($game->developers()->find($developer->id)) selected @endif>{{$developer->name}}</option>
            @endforeach
        </select>
        <br/><br/>
        <label for="tagsInput">Tags: </label>
        <select id="tagsInput" name="tags_id[]" class="form-control form-control-sm multipleSelect" multiple="multiple">
            @foreach($tags as $tag)
                <option value="{{$tag->id}}" @if($game->tags()->find($tag->id)) selected @endif>{{$tag->name}}</option>
            @endforeach
        </select>
        <br/><br/>
        <input type="submit" name="submit" value="Update Game" class="btn btn-primary">
    </form>
    <form method="POST" action="/games/{{$game->id}}" class="form-group">
        @csrf
        @method("DELETE")
        <input type="submit" value="Delete Game" name="submit" class="btn btn-primary"/>
    </form>
</div>
</body>
</html>
