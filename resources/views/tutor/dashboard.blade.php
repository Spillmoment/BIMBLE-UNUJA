@extends('admin.layouts.tutor')

@section('title','Bimble - Dashboard')
    
@section('content')
  <!-- Animated -->
  <div class="animated fadeIn">
    <!-- Widgets  -->
    <div class="jumbotron">
      <h1 class="display-4">Hello, {{ Auth::user()->nama_tutor }}</h1>
      <p class="lead">Selamat datang di admin bimble</p>
      <hr class="my-4">
      <a class="btn btn-primary btn-md" href="#" role="button">Lihat Profil</a>
    </div>
   
    </div>
   
 
    <!-- /.orders -->
  <!-- /#add-category -->
  </div>
  <!-- .animated -->
@endsection

