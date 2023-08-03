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
    <h1>Create a Game</h1>
    <div class="alert alert-success" style="display:none"></div>
    <div class="alert alert-danger" style="display:none"></div>

    <form id="gameCreateForm" name="gameCreateForm" class="form-group">
        @csrf
        <label for="nameInput">Name: </label>
        <input type="text" id="nameInput" name="name" class="form-control"/>
        <br/>
        <label for="ratingInput">Rating: </label>
        <input type="number" id="ratingInput" name="rating" class="form-control" step="0.1"/>
        <br/>
        <label for="releaseDateInput">Release Date: </label>
        <br/>
        <label for="comingSoonCheck">Coming Soon</label>
        <input type="checkbox" id="comingSoonCheck" checked>
        <input type="date" id="releaseDateInput" name="release_date" class="form-control" min="1971-01-01" max="{{date('Y-m-d')}}" disabled/>
        <br/>
        <label for="publisherInput">Publisher: </label>
        <select id="publisherInput" name="publisher_id" class="form-control form-control-sm">
            <option selected></option>
            @foreach($publishers as $publisher)
                <option value="{{$publisher->id}}">{{$publisher->name}}</option>
            @endforeach
        </select>
        <br/>
        <label for="developersInput">Developers: </label>
        <select id="developersInput" name="developers_id[]" class="form-control form-control-sm multipleSelect" multiple="multiple">
            @foreach($developers as $developer)
                <option value="{{$developer->id}}">{{$developer->name}}</option>
            @endforeach
        </select>
        <br/><br/>
        <label for="tagsInput">Tags: </label>
        <select id="tagsInput" name="tags_id[]" class="form-control form-control-sm multipleSelect" multiple="multiple">
            @foreach($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->name}}</option>
            @endforeach
        </select>
        <br/><br/>
        <input type="submit" id='submit' name="submit" value="Create Game" class="btn btn-primary">
    </form>

    <script>
        $(document).ready(function () {
            $('#submit').click(function (e) {
                e.preventDefault();
                $(this).html('Sending request..');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/games',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#gameCreateForm').serialize(),
                    success: function (result) {
                        $('#tagCreateForm').trigger('reset');
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
        });
    </script>
</div>
</body>
</html>
