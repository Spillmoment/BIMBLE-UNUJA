@extends('web.layouts.main')

@section('title', 'Review Kursus - ' . $kursus->nama_kursus )
@section('content')

<div class="container py-5">

	<h5 class="text-center">Daftar Review {{  $kursus->nama_kursus  }}</h5>
	
	<div class="card">
	    <div class="card-body card-shadow">
        @foreach ($komentar as $komen)
        @foreach ($komen->pendaftar as $user)
	        <div class="row">
        	    <div class="col-md-2">
        	        <img src="{{ Storage::url('uploads/pendaftar/profile/'.$user->foto) }}" class="rounded-circle img-thumbnail img-fluid avatar avatar-lg"/>
        	        <p class="text-sm text-dark">{{ $komen->updated_at->diffForhumans() }}</p>
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
        	       
        	    </div>
          </div>
          @endforeach
          @endforeach
	     
      </div>
      <nav class="mt-5 justify-content-center">
        {{ $komentar->links() }}
      </nav>
    </div>
  
</div>

@endsection
