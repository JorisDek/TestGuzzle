<!doctype html>
<html>
    <head>
        
    </head>
    
    <body>
       <ul>
        @foreach( $projects as $project)
            <li>{!! $project !!}</li>
        @endforeach
       </ul>
    </body>
</html>