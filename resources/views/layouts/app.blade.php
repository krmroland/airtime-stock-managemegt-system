@inject('default', 'App\Defaults')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lawma') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <script>
        var lawma={
            "csrf_token":"{!! csrf_token() !!}"
        }
    </script>
</head>
<body class="bg-grey">
    <div id="app">
        <div class="container-fluid">
            @include('layouts.header')
            @include('layouts.nav')

            <div class="bg-white p-3">
                @yield('content')
            </div>
            <flash message="{{ session('flash') }}"></flash>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>
