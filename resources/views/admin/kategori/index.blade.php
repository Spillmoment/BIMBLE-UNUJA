@extends('admin.layouts.manager')

@section('title','Bimble - Data Kategori')
@section('content')
    <div class="orders">
      <div class="row">
        <div class="col-12">
          
          <div class="card">
            
            <div class="card-body">

              <h4 class="box-title">List Kategori</h4>

              @if(session('status'))
              @push('after-script')
              <script>
                  swal({
                  title: "Success",
                  text: "{{session('status')}}",
                  icon: "success",
                  button: false,
                  timer: 2000
                  });
              </script>
              @endpush
              @endif

              <form action="{{route('kategori.index')}}">    

                <div class="row mt-2">

                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" {{ Request::get('keyword') }} name="keyword"  placeholder="Masukkan Nama Kategori" autofocus>
                        </div>
                    </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-secondary"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                                <a href="{{ route('kategori.index') }}" class="btn btn-warning text-light ml-2"> <i class="fa fa-refresh" aria-hidden="true"></i> </a>
                            </div>
                           
                </div>
              </form>
            </div>
            <div class="card-body--">
              
              <a class="btn btn-primary btn-sm ml-3 mb-3" href="{{ route('kategori.create') }}"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
              <div class="table-stats order-table ov-h">
                <table class="table table-hover">
                  <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Keterangan</th>
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
                         <a class="btn btn-info text-white btn-sm" href="{{route('kategori.edit',
                            [$category->id])}}"> <i class="fa fa-edit"></i></a>
                        <form onsubmit="return confirm('yakin untuk memasukkan ke Trash!')" class="d-inline" action="{{route('kategori.destroy', [$category->id])}}"   method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" value="Delete" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                            </form>
                            </td>
                    </tr>
                    
                </tbody>
                @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
@endsection

