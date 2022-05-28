<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=0">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="{{ asset( mix('js/app.js')) }}" type="text/javascript" defer></script>
    <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}"/>
    
    @if (Auth::check())
        <script>
            window.auth_user = @json(Auth::user());
        </script>
    @else
        @if (Auth::guard('company')->check())
        <script>
            window.auth_user = @json(Auth::guard('company')->user());
        </script>
        @else
            <script>
                window.auth_user = null;
            </script>
        @endif
    @endif
</head>

<!-- DESIGN INSPIRED BY https://dribbble.com/shots/15369006-HuntJobs-Job-Search-Dashboard -->

<body id="app">
    <router-view></router-view>
</body>

</html>