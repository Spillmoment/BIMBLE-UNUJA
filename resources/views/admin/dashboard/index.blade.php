@extends('admin.layouts.main')

@section('title','Admin Dashboard - Bimble')

@section('content')
    
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1 style="font-size: 28px;">Dashboard</h1>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-primary">
                                    <i class="far fa-user"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Pendaftar</h4>
                                    </div>
                                    <div class="card-body">
                                        {{ $pendaftar }}
                                    </div>
                                </div>
                            </div>
                        </div>
                 
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-warning">
                                    <i class="fas fa-book"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                    <h4><a href="{{ route('kursus.index') }}" style="color: #98a6ad">Kursus</a></h4>
                                    </div>
                                    <div class="card-body">
                                    {{ $kursus }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                            <div class="card card-statistic-1">
                                <div class="card-icon bg-success">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="card-wrap">
                                    <div class="card-header">
                                        <h4>Tutor</h4>
                                    </div>
                                    <div class="card-body">
                                        3
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-4">
                        <div class="hero text-white hero-bg-image" data-background="#">
                            <div class=" hero-inner">
                            <h1>Selamat Datang,{{ Auth::user()->nama }}</h1>
                                <p class="lead">Di halaman Admin Bimble - Web Bimble
                                    Probolinggo<br></p>
                                <div class="mt-4">
                                    <a href="#" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="far fa-user"></i>
                                        Data Siswa</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            @endsection
