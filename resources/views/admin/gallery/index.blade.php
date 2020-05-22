@extends('admin.layouts.main')

@section('title','Admin - Data Kursus')

@section('content')
    
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Management Data Gallery </h1>
        </div>

        <nav class="breadcrumb ml-4" style="margin-top: -20px">
            <a class="breadcrumb-item" href="{{ route('manager.home') }}">Home</a>
        <a class="breadcrumb-item active" href="{{ route('gallery.index') }}">Gallery</a>
        </nav>
                 
                 
        @if(session('status'))
        @push('scripts')
        <script>
            swal({
            title: "Success",
            text: "{{session('status')}}",
            icon: "success",
            });
        </script>
        @endpush
         @endif

        <div class="row" style="overflow: scroll">
            <div class="col-md-12">
                <div class="container bg-white p-4"
                    style="bgallery-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                    
                    <a href="{{ route('gallery.create') }}" class="btn btn-primary my-1 float-right">
                      <i class="fa fa-plus"></i> Tambah Gallery</a>
                     
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Kursus</th>
                                <th>Gambar</th>
                                <th>Option</th>
                               
                            </tr>
                        </thead>
                   
                        <tbody>
                            @foreach ($gallery as $gallery)
                            <tr>
                              <td> {{$gallery->id}} </td>
                                <td> {{ $gallery->kursus->nama_kursus }} </td>
                              <td>
                              <img src="{{ Storage::url($gallery->image) }}" alt="" srcset="" width="150px" class="img-thumbnail">
                              </td>
                              
                                <td>
                                    <a class="badge badge-warning text-white badge-pill" href="{{route('gallery.edit',
                                       [$gallery->id])}}"> <i class="fa fa-edit"></i> Edit</a>
                            <form onsubmit="return confirm('yakin untuk memasukkan ke Trash!')" class="d-inline" action="{{route('gallery.destroy', [$gallery->id])}}"   method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" value="Delete" class="badge badge-danger badge-pill">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                        
                    </tr>           
                    @endforeach
                    
                        </tbody>
              
                    </table>

                    <div class="text-center">

        
                    </div>
                        
                </div>
            </div>
        </div>
</div>
</div>
</div>

@endsection