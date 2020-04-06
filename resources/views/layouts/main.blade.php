<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

  
</head>
<body>
    
    {{-- include css --}}
    @include('layouts.style')

    {{-- include sidenav --}}
    @include('layouts.sidenav')

    {{-- include content --}}
    @yield('content')

    {{-- include footer --}}
    @include('layouts.footer')

    {{-- include scripts --}}
    @include('layouts.script')


</body>
</html>