<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="ShaynaAdmin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Style --}}
    @stack('before-style')
    @include('admin.includes.style')
    @stack('after-style')

</head>


<body>

    {{-- main manager --}}
    @auth('manager')
    {{-- Sidebar --}}
    @include('admin.includes.sidebar-manager')
    
    <div id="right-panel" class="right-panel">
        {{-- Navbar --}}
        @include('admin.includes.navbar-manager')
        
        <div class="content">
            {{-- Content --}}
            @yield('content')
        </div>
        <div class="clearfix"></div>
    </div>
    
    {{-- Script --}}
    @stack('before-script')
    @include('admin.includes.script')
    @stack('after-script')
    
    @endauth
    {{-- end main manager --}}



</body>


</html>
