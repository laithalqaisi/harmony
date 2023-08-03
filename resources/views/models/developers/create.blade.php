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
            <li><a href="{{ URL::to('developers') }}">View All</a></li>
            <li><a href="{{ URL::to('developers/create') }}">Create</a>
        </ul>
    </nav>
    <h1>Create a Developer</h1>
    <div class="alert alert-success" style="display:none"></div>
    <div class="alert alert-danger" style="display:none"></div>

    <form id='developerCreateForm' name='developerCreateForm' class="form-group">
        <label for="nameInput">Name: </label>
        <input type="text" id="nameInput" name="name" class="form-control"/>
        <br/>
        <input type="submit" id="submit" name="submit" value="Create Developer" class="btn btn-primary">
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
                    url: '/developers',
                    type: 'POST',
                    dataType: 'json',
                    data: $('#developerCreateForm').serialize(),
                    success: function (result) {
                        $('#developerCreateForm').trigger('reset');
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
