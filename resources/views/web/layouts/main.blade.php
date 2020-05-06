<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>

<body style="padding-top: 72px;">

    @include('web.layouts.style')

    @yield('content')

    @include('web.layouts.footer')
    
    @include('web.layouts.script')


    @stack('scripts')
</body>
</html>