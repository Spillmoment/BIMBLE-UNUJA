@extends('web.layouts.main')

@section('title', 'Review Kursus - ' . $kursus->nama_kursus )
@section('content')

<div class="container py-5">

	<h3 class="text-center">Review Kursus {{ $kursus->nama_kursus }}</h3>
	
	<div class="card">
	    <div class="card-body card-shadow">
        @foreach ($komentar as $komen)
        @foreach ($komen->pendaftar as $user)
	        <div class="row">
        	    <div class="col-md-2">
        	        <img src="{{ Storage::url('uploads/pendaftar/profile/'.$user->foto) }}" class="rounded-circle img-thumbnail img-fluid"/>
        	        <p class="text-primary text-center">{{ $komen->updated_at->diffForhumans() }}</p>
        	    </div>
        	    <div class="col-md-10">
        	        <p>
        	            <a class="float-left" href="#"><strong>{{ $user->nama_pendaftar }}</strong></a>
        	            {{-- <span class="float-right"><i class="text-warning fa fa-star"></i></span>
                        <span class="float-right"><i class="text-warning fa fa-star"></i></span>
        	            <span class="float-right"><i class="text-warning fa fa-star"></i></span>
        	            <span class="float-right"><i class="text-warning fa fa-star"></i></span> --}}

        	       </p>
        	       <div class="clearfix"></div>
        	        <p class="text-justify">
                    {{ $komen->isi_komentar }}
                  </p>
        	        <p>
        	            <a class="float-right btn btn-outline-primary ml-2"> <i class="fa fa-reply"></i> Reply</a>
        	            <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
        	       </p>
        	    </div>
          </div>
          @endforeach
          @endforeach
	     
      </div>
      <nav class="mt-5 float-right">
        {{ $komentar->links() }}
      </nav>
    </div>
  
</div>


@endsection
