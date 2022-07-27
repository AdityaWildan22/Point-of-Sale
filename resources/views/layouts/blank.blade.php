<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SENJA CAFE | @yield('title')</title>

    @include('layouts.sc_head')
</head>
<body class="hold-transition sidebar-mini">
    {{-- @include('layouts.navbar') --}}
    {{-- @include('layouts.sidebar') --}}
    @yield('content')
    @include('layouts.sc_footer')
</body>
</html>