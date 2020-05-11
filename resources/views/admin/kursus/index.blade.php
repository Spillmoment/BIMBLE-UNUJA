@extends('admin.layouts.main')

@section('title','Admin - Data Kursus')

@section('content')
    
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Management Data Kursus </h1>
        </div>

        <nav class="breadcrumb ml-4" style="margin-top: -20px">
            <a class="breadcrumb-item" href="{{ route('manager.home') }}">Home</a>
        <a class="breadcrumb-item active" href="{{ route('kursus.index') }}">Kursus</a>
        </nav>
                 
        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('status')}}</strong> 
            <button type="button" class="close text-light" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         @endif
             
         
         <form action="{{route('kursus.index')}}">                
         <div class="row">
             
             <div class="col-md-5 ml-3">
                <div class="form-group">
                    <input type="text" class="form-control" {{ Request::get('keyword') }} name="keyword"  placeholder="Masukkan Nama Kursus">
                  
                </div>
            </div>

            <div class="col-md-1">
                <button type="submit" class="btn btn-success"> <i class="fas fa-search" aria-hidden="true"></i></button>
            </div>

            <div class="col-md-3">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                    <a class="nav-link active" href="
                    {{route('kursus.index')}}">Published</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="
                    {{route('kursus.trash')}}">Trash</a>
                    </li>
                    </ul>
            </div>
        </div>
        </form>

    <form action="{{route('kursus.index')}}">                
        <div class="row">
            
            <div class="col-md-5 ml-3">
            <div class="form-group">
               
                <select class="custom-select" name="nama_kategori" id="nama_kategori">
                    <option selected> --- Pilih Kategori --- </option>
                    @foreach ($kategori as $row)
                    <option value="{{$row->id}}">{{ $row->nama_kategori }}</option>
                        @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-1">
            <button type="submit" class="btn btn-success"> <i class="fas fa-filter" aria-hidden="true"></i></button>
        </div>
    </div>


    </form>
     
        <div class="row" style="overflow: scroll">
            <div class="col-md-12">
                <div class="container bg-white p-4"
                    style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                   
                    
                    <a href="{{ route('kursus.create') }}" class="btn btn-success my-1 float-right">
                        <i class="fa fa-plus"></i> Tambah Kursus</a>

                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Kursus</th>
                                <th>Gambar Kursus</th>
                                <th>Kategori Kursus</th>
                                <th>Tutor Kursus</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>


                            @if ($kursus->count() > 0)
                                
                            @foreach ($kursus as $krs)    
                            <tr>
                                <td scope="row">  {{$loop->iteration}}  </td>
                            <td>{{ $krs->nama_kursus }}</td>
                                @if($krs->gambar_kursus)
                                <td> <img src="{{ asset('uploads/kursus/'.$krs->gambar_kursus) }}" width="50px"> </td>
                                @else
                                Tidak Ada Gambar
                                @endif
                                <td>
                                    @foreach ($krs->kategori as $item)
                                        {{$item->nama_kategori}}
                                        @endforeach
                                </td>
                                <td>
                                    @foreach ($krs->tutor as $sensei)
                                        {{$sensei->nama_tutor}}
                                        @endforeach
                                </td>
                                <td>
                                    <a class="badge badge-info text-white badge-pill" href="{{route('kursus.edit',
                                       [$krs->id])}}"> <i class="fa fa-edit"></i> Edit</a>
                                    <a class="badge badge-warning text-white badge-pill" href="{{route('kursus.show',
                                       [$krs->id])}}"> <i class="fa fa-eye"></i> Detail</a>
                                 
                            <form onsubmit="return confirm('yakin untuk memasukkan ke Trash!')" class="d-inline" action="{{route('kursus.destroy', [$krs->id])}}"   method="POST">
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