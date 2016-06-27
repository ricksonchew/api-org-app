<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

        <meta http-equiv="content-language" content="en" />
        <meta charset="utf-8">

        <title>Yoyo Holdings - Notes and ToDo App</title>

        <meta name="csrf-token" content="{{csrf_token()}}" />

        <link rel="stylesheet" href="{{$cssUrl}}plugins.min.css" type="text/css">
        <link rel="stylesheet" href="{{$themeYoyoCssUrl}}style.min.css" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('yoyo.partials._modal-form-notes')
        @include('yoyo.partials._modal-form-todo')
        @include('yoyo.partials._modal')
        <input type="hidden" name="hfBaseUrl" id="hfBaseUrl" value="{{$baseUrl}}" />
        <script data-main="{{$themeYoyoJsUrl}}app" src="{{$jsPluginsUrl}}require.min.js"></script>
    </body>
</html>