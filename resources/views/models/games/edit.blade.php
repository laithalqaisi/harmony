<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <h1>Edit a Game (Game ID: {{$game->id}})</h1>
    <div class="alert alert-success" style="display:none"></div>
    <div class="alert alert-danger" style="display:none"></div>

    <form id="gameUpdateForm" name="gameUpdateForm" class="form-group">
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
        <input type="submit" id="updateSubmit" name="submit" value="Update Game" class="btn btn-primary">
    </form>

    <form id="gameDeleteForm" name="gameDeleteForm" class="form-group">
        @csrf
        @method("DELETE")
        <input type="submit" id="deleteSubmit" value="Delete Game" name="submit" class="btn btn-primary"/>
    </form>

    <script>
        $(document).ready(function () {
            $('#updateSubmit').click(function (e) {
                e.preventDefault();
                $(this).html('Sending request..');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/games/{{$game->id}}',
                    type: 'PATCH',
                    dataType: 'json',
                    data: $('#gameUpdateForm').serialize(),
                    success: function (result) {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.alert-success').html(result.success);
                    },
                    error: function (result) {
                        $('.alert-success').hide();
                        $('.alert-danger').html('');
                        $('.alert-danger').show();
                        $.each(result.responseJSON.errors, function (k, v){
                            $('.alert-danger').append('<p>'+v+'</p>');
                        })
                    }
                })
            });
            $('#deleteSubmit').click(function (e) {
                e.preventDefault();
                $(this).html('Sending request..');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/games/{{$game->id}}',
                    type: 'DELETE',
                    dataType: 'json',
                    success: function (result) {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.alert-success').html(result.success);
                    },
                    error: function () {
                        $('.alert-success').hide();
                        $('.alert-danger').html('');
                        $('.alert-danger').show();
                        $('.alert-danger').html('Game Not Found');
                    }
                })
            });
        });
    </script>
</div>
</body>
</html>
