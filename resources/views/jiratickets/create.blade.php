<!DOCTYPE html>
<html>
    <head></head>
    <body>
        {!! Form::open(['action' => 'JiraTicketsController@store']) !!}
            {!! Form::submit('Send Request') !!}
        {!! Form::close() !!}
    </body>
</html>