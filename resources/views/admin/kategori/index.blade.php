@extends('admin.layouts.main')

@section('title','Admin - Data Kategori')

@section('content')
    
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Management Data Kategori Kursus</h1>
        </div>

        <nav class="breadcrumb ml-4" style="margin-top: -20px">
            <a class="breadcrumb-item" href="{{ route('dashboard.index') }}">Home</a>
        <a class="breadcrumb-item active" href="{{ route('kategori.index') }}">Kategori</a>
        </nav>

    
        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('status')}}</strong> 
            <button type="button" class="close text-light" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         @endif
       

      
            <form action="{{route('kategori.index')}}">                
                <div class="row">

                    <div class="col-md-5 ml-3">
                        <div class="form-group">
                            <input type="text" class="form-control" {{ Request::get('keyword') }} name="keyword"  placeholder="Masukkan Nama Kategori">
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
                            {{route('kategori.index')}}">Published</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="
                            {{route('kategori.trash')}}">Trash</a>
                            </li>
                            </ul>
                    </div>


                </div>
                </form>

        <div class="row" style="overflow: scroll">
            <div class="col-md-12">
                <div class="container bg-white p-4"
                    style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
           
                    <a href="{{ route('kategori.create') }}" class="btn btn-success my-1 float-right">
                     <i class="fa fa-plus"></i> Tambah Kategori</a>
                    
                 <table class="table align-items-center table-flush mt-2">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $category)
                                
                            <tr>
                            <td scope="row">
                                {{ $loop->iteration }}
                            </td>
                            <td> 
                                {{$category->nama_kategori}} 
                            </td>
                            <td> 
                                {{$category->keterangan}} 
                            </td>
                            <td>
                                @if($category->status == "ACTIVE")
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
                                 <a class="badge badge-info text-white badge-pill" href="{{route('kategori.edit',
                                    [$category->id])}}"> <i class="fa fa-edit"></i> Edit</a>
                                <form onsubmit="return confirm('yakin untuk memasukkan ke Trash!')" class="d-inline" action="{{route('kategori.destroy', [$category->id])}}"   method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" value="Delete" class="badge badge-danger badge-pill">
                                        <i class="fa fa-trash"></i> Trash
                                    </button>
                                    </form>
                                    </td>
                            </tr>
                            
                        </tbody>
                        @endforeach
                    </table>

                    <div class="text-center">

                        {{  $kategori->appends(Request::all())->links() }}
                    </div>
                        
                </div>
            </div>
        </div>
</div>
</div>
</div>

@endsection