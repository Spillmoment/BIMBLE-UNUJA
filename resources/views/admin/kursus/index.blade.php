@extends('admin.layouts.main')

@section('title','Admin - Data Kursus')

@section('content')
    
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Management Data Kursus </h1>
        </div>

        <nav class="breadcrumb ml-4" style="margin-top: -20px">
            <a class="breadcrumb-item" href="{{ route('dashboard.index') }}">Home</a>
        <a class="breadcrumb-item active" href="{{ route('kursus.index') }}">Kursus</a>
        </nav>
                 
        @if(session('status'))
         <div class="alert alert-success" role="alert">
        <strong>{{session('status')}}</strong>
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
                <button type="submit" value="Cari" class="btn btn-success"> <i class="fa fa-search" aria-hidden="true"></i> Cari</button>
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
                            @foreach ($kursus as $krs)
                                
                            <tr>
                                <td scope="row">  {{$loop->iteration}}  </td>
                            <td>{{ $krs->nama_kursus }}</td>
                                @if($krs->gambar_kursus)
                                <td> <img src="{{ asset('storage/'.$krs->gambar_kursus) }}" width="50px"> </td>
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