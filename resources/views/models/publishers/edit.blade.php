<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div class="container">
    <nav class="navbar navbar-inverse">
        <ul class="nav navbar-nav">
            <li><a href="{{ URL::to('publishers') }}">View All</a></li>
            <li><a href="{{ URL::to('publishers/create') }}">Create</a>
        </ul>
    </nav>
    <h1>Edit a Publisher (Publisher ID: {{$publisher->id}})</h1>
    <div class="alert alert-success" style="display:none"></div>
    <div class="alert alert-danger" style="display:none"></div>

    <form id='publisherUpdateForm' name='publisherUpdateForm' class="form-group">
        @csrf
        @method('PATCH')
        <label for="nameInput">Name: </label>
        <input type="text" id="nameInput" name="name" class="form-control" value="{{$publisher->name}}"/>
        <br/>
        <input type="submit" id="updateSubmit" name="submit" value="Update Publisher" class="btn btn-primary">
    </form>

    <form id='publisherDeleteForm' name='publisherDeleteForm' class="form-group">
        @csrf
        @method("DELETE")
        <input type="submit" value="Delete Publisher" id="deleteSubmit" name="submit" class="btn btn-primary"/>
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
                    url: '/publishers/{{$publisher->id}}',
                    type: 'PATCH',
                    dataType: 'json',
                    data: $('#publisherUpdateForm').serialize(),
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
                    url: '/publishers/{{$publisher->id}}',
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
                        $('.alert-danger').html('Publisher Not Found');
                    }
                })
            });
        });
    </script>
</div>
</body>
</html>
