@extends('admin.layouts.main')

@section('title','Admin - Data Pendaftar')

@section('content')
    
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Management Data Pendaftar </h1>
        </div>

        <nav class="breadcrumb ml-4" style="margin-top: -20px">
            <a class="breadcrumb-item" href="{{ route('dashboard.index') }}">Home</a>
        <a class="breadcrumb-item active" href="{{ route('pendaftar.index') }}">Pendaftar</a>
        </nav>
                 
        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('status')}}</strong> 
            <button type="button" class="close text-light" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         @endif
             
         <form action="{{route('pendaftar.index')}}">                
          <div class="row">

              <div class="col-md-5 ml-3">
                  <div class="form-group">
                      <input type="text" class="form-control" {{ Request::get('keyword') }} name="keyword"  placeholder="Masukkan Nama Pendaftar">
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-check" style="font-size: 17px">

                      <label class="form-check-label" for="active">Aktif  </label>
                      <span class="ml-4">
                          <input {{ Request::get('status') == 'ACTIVE' ? 'checked' : ''}} value="ACTIVE" name="status" type="radio" class="form-check-input mt-2" id="active">
                      </span>
                          
                      <label class="form-check-label" for="inactive">Nonaktif </label>
                          <span class="ml-4">
                          <input {{Request::get('status') == 'INACTIVE' ? 'checked' : ''}} value="INACTIVE" name="status" type="radio" class="form-check-input mt-2" id="inactive">
                      </span>

                      <input type="submit" value="Filter" class="btn btn-primary">
                  </div>
              </div>

              <hr>
              <div class="col-md-3 ">
                  <ul class="nav nav-pills card-header-pills">
                      <li class="nav-item">
                      <a class="nav-link active" href="
                      {{route('pendaftar.index')}}">Published</a>
                      </li>
                      <li class="nav-item">
                      <a class="nav-link" href="
                      {{route('pendaftar.trash')}}">Trash</a>
                      </li>
                      </ul>
              </div>


          </div>
          </form>


        <div class="row" style="overflow: scroll">
            <div class="col-md-12">
                <div class="container bg-white p-4"
                    style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                   

                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Pendaftar</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>


                            @if ($pendaftar->count() > 0)              
                            @foreach ($pendaftar as $regis)    
                            <tr>
                                <td scope="row">  {{$loop->iteration}}  </td>
                            <td>{{ $regis->nama_pendaftar }}</td>
                            @if ($regis->jenis_kelamin == 'L')
                            <td>Laki-Laki</td>
                                @else
                                <td>Perempuan</td>
                            @endif
                            <td>{{ $regis->alamat }}</td>
                                @if($regis->foto)
                                <td> <img src="{{ asset('storage/'.$regis->foto) }}" width="50px"> </td>
                                @else
                                Tidak Ada Gambar
                                @endif
                                <td>
                                  @if($regis->status == "ACTIVE")
                                  <span class="badge badge-success">
                                  Aktif
                                  </span>
                                  @else
                                  <span class="badge badge-danger">
                                  Nonaktif
                                  </span>
                                  @endif
                                  </td>
                                <td>
                                    <a class="badge badge-info text-white badge-pill" href="{{route('pendaftar.edit',
                                       [$regis->id])}}"> <i class="fa fa-edit"></i> Edit</a>
                                    <a class="badge badge-warning text-white badge-pill" href="{{route('pendaftar.show',
                                       [$regis->id])}}"> <i class="fa fa-eye"></i> Detail</a>
                                 
                            <form onsubmit="return confirm('yakin untuk memasukkan ke Trash!')" class="d-inline" action="{{route('pendaftar.destroy', [$regis->id])}}"   method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" value="Delete" class="badge badge-danger badge-pill">
                                    <i class="fa fa-trash"></i> Trash
                                </button>
                            </form>
                        </td>
                        
                    </tr>           
                    @endforeach
                    @else
                    <tr>
                        <td><h5>Data Kosong</h5></td>
                    </tr>
                    @endif
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