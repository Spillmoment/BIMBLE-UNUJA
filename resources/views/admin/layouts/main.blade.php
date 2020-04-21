<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

  
</head>
<body>
    
    {{-- include css --}}
    @include('admin.layouts.style')

    {{-- include sidenav --}}
    @include('admin.layouts.sidenav')

    {{-- include content --}}
    @yield('content')

    {{-- include footer --}}
    @include('admin.layouts.footer')

    {{-- include scripts --}}
    @include('admin.layouts.script')

    @stack('footer-scripts')


</body>
</html>