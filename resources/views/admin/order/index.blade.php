@extends('admin.layouts.main')

@section('title','Admin - Data Kursus')

@section('content')
    
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Management Data Order </h1>
        </div>

        <nav class="breadcrumb ml-4" style="margin-top: -20px">
            <a class="breadcrumb-item" href="{{ route('manager.home') }}">Home</a>
        <a class="breadcrumb-item active" href="{{ route('order.index') }}">Order</a>
        </nav>
                 
        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('status')}}</strong> 
            <button type="button" class="close text-light" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         @endif
             
{{--          
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
        </form> --}}

    {{-- <form action="{{route('kursus.index')}}">                
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
      --}}
        <div class="row" style="overflow: scroll">
            <div class="col-md-12">
                <div class="container bg-white p-4"
                    style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                  
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Kursus</th>
                                <th>Biaya</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                  
                        <tbody>
                            @foreach ($items as $item)
                                <td> {{ $item->id }} </td>

                                @foreach ($item->pendaftar as $pendaftar)
                                <td> {{ $pendaftar->nama_pendaftar }} </td>
                                @endforeach

                                @foreach ($item->kursus as $kursus)
                                <td> {{ $kursus->nama_kursus }} </td>
                                <td>{{ $kursus->biaya_kursus }}</td>
                                @endforeach
                                
                                <td> {{ $item->status_kursus }} </td>
                                <td>
                                    <a class="badge badge-info text-white badge-pill" href="{{route('order.edit',
                                       [$item->id])}}"> <i class="fa fa-edit"></i> Edit</a>
                                    <a class="badge badge-warning text-white badge-pill" href="{{route('order.show',
                                       [$item->id])}}"> <i class="fa fa-eye"></i> Detail</a>
                                 
                            <form onsubmit="return confirm('yakin untuk memasukkan ke Trash!')" class="d-inline" action="{{route('order.destroy', [$item->id])}}"   method="POST">
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