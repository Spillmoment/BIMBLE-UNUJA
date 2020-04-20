
<div id="app">
    <div class="main-wrapper">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class=" navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown"><a href="#" data-toggle="dropdown"
                        class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                        <img alt="image" style="margin-bottom:4px !important;"
                            src="./assets/stisla-assets/img/avatar/avatar-2.png"
                            class="rounded-circle mr-1 my-auto">
                        <div class="d-sm-none d-lg-inline-block" style="font-size:15px;">Hello,</div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-title">Admin - Bimble</div>
                        <a href="#" class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar">
            <aside id="sidebar-wrapper">
                <div class="sidebar-brand text-danger">
                    <div>
                        <a href="#"
                            style="font-size: 35px;font-weight:900;font-family: 'Poppins', sans-serif;"
                            class="text-success text-center"><i style="font-size: 30px;"
                                class="fas fa-home "></i> |
                            BIMBLE</a>
                    </div>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="#">LY</a>
                </div>

                <ul class="sidebar-menu">
                    <li class="menu-header ">Dashboard</li>
                    <li class="nav-item dropdown   {{ (Request::route()->getName() == 'dashboard.index') ? 'active' : '' }}">
                    <a href="{{ route('dashboard.index') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                    </li>

                    <li class="menu-header">Management User</li>
                <li class="nav-item dropdown ">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-user"></i>
                            <span>User</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="#">Data User</a></li>
                            <li><a class="nav-link" href="#">Tambah Data User</a></li>
                        </ul>
                    </li>

                    <li class="menu-header">Management Kategori</li>
                    <li class="nav-item dropdown  {{ (Request::route()->getName() == 'kategori.index') ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-cart-plus"></i>
                            <span>Kategori</span></a>
                        <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('kategori.index') }}">Data Kategori</a>
                            </li>
                        <li><a class="nav-link" href="{{route('kategori.create')}}">Tambah Kategori</a>
                            </li>

                        </ul>
                    </li>
                    <li class="menu-header">Management Kursus</li>
                    <li class="nav-item dropdown  {{ (Request::route()->getName() == 'kursus.index') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-chalkboard-teacher"></i>
                            <span>Kursus</span></a>
                        <ul class="dropdown-menu">
                        <li><a class="nav-link " href="{{route('kursus.index')}}">Data Kursus</a>
                            </li>
                        <li><a class="nav-link" href="{{route('kursus.create')}}">Tambah Kursus</a>
                            </li>

                        </ul>
                    </li>

                    <li class="menu-header">Management Pendaftar</li>
                    <li class="nav-item dropdown {{ (Request::route()->getName() == 'pendaftar.index') ? 'active' : '' }}">
                        <a href="#" class="nav-link has-dropdown"><i class="fas fa-book"></i>
                            <span>Pendaftar</span></a>
                        <ul class="dropdown-menu">
                        <li><a class="nav-link" href="{{ route('pendaftar.index') }}">Data Pendaftar</a>
                            </li>

                        </ul>
                    </li>
            </aside>
        </div>