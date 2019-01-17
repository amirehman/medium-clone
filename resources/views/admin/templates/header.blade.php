<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ config('app.name', 'Admin Panel | GetIdea') }}</title>

<meta name="csrf-token" content="{{ csrf_token() }}">


<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

@yield('headlinks')
