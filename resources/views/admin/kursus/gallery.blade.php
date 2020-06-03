@extends('admin.layouts.default')

@section('title','Bimble - Galeri Kursus')
@section('content')
    <div class="orders">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="box-title">Galleri Kursus
                <span class="badge badge-light badge-pill badge-lg" style="font-size: 15px;">
                  {{ $kursus->nama_kursus }}
                </span>
              </h4>
            </div>
            <div class="card-body--">
            
              <div class="row">
                @forelse ($items as $gallery)
                <div class="col-sm-4">
                  <div class="card">
                    <div class="card-body">
                      <a href="{{  Storage::url($gallery->image)  }}" target="_blank">
                        <img class="card-img-top" height="150px" src="{{  Storage::url($gallery->image)  }}" alt="Card image cap">
                      </a>
                      </div>
                  </div>
                </div>
                @empty
                @endforelse
             

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection