<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SoftwarePieces</title>

         <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #17202a;
                font-family:Book Antiqua;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #17202a;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    	<div>
    		<div>
                <br>
    			Hi {{ $editor->name }}, 
    			<br><br>
    			User <strong>{{ $post->isCreator->name }}</strong> wrote a new blog post<br> 
                Title: <strong>{{ $post->title }}</strong><br>
                Subtitle: <strong>{{ $post->subtitle }}</strong><br>
                Body: <i>{!! $post->body !!}</i><br>
                Please check it over here <strong>{{ url('blog', $post->id) }}</strong> and approve it if possible.
                <br><br>
    		<div>
    	</div> 
    </body>
</html>
