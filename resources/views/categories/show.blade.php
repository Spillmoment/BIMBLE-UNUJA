@extends('layouts.app')
@section('title') Detail Category @endsection
@section('content')
<div class="col-md-8">

<h3>Detail Category</h3>
<div class="card">

    <div class="card-body">
        <label><b>Category name</b></label><br>
        {{$category->name}}
        <br><br>
        <label><b>Category slug</b></label><br>
        {{$category->slug}}
        <br><br>
        <label><b>Category image</b></label><br>
        @if($category->image)
        <img src="{{asset('storage/' . $category->image)}}"
        width="120px">
        @endif
        </div>
        </div>
        </div>
        @endsection