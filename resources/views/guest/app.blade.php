<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>

    @include ('admin.templates.header')


</head>

<body>

    <div id="app">
            @yield('content')
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>

</html>
