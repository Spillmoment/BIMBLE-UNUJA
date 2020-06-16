@extends('admin.layouts.manager')

@section('title','Bimble - Data Tutor')
@section('content')
    <div class="orders">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="box-title">List Tutor</h4>

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

              <form action="{{route('tutor.index')}}">    

                <div class="row mt-2">

                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" {{ Request::get('keyword') }} name="keyword"  placeholder="Masukkan Nama Tutor" autofocus>
                        </div>
                    </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-secondary"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                                <a href="{{ route('tutor.index') }}" class="btn btn-warning text-light ml-2"> <i class="fa fa-refresh" aria-hidden="true"></i> </a>
                            </div>
                           
                </div>
              </form>
            </div>
            <div class="card-body--">
              
              <a class="btn btn-primary btn-sm ml-3 mb-3" href="{{ route('tutor.create') }}"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
              <div class="table-stats order-table ov-h">
                <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Tutor</th>
                                <th>Username</th>
                                <th>Alamat</th>
                                <th>Foto</th>
                                <th>Status</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tutor as $sensei)
                                
                            <tr>
                            <td scope="row">  {{$loop->iteration}}  </td>
                            <td>{{ $sensei->nama_tutor }}</td>
                            <td> {{ $sensei->username }} </td>
                            <td> {{ $sensei->alamat }} </td>
                          
                            <td> <img class="img-thumbnail rounded-circle" src="{{ asset('uploads/tutor/'. $sensei->foto) }}" width="50px"> </td>

                            @if ($sensei->status == 1)
                            <td><span class="badge badge-pill badge-success">Aktif</span></td>
                            @else
                            <td><span class="badge badge-pill badge-danger">Nonaktif</span></td>
                            @endif
                            
                            <td>
                                    <a class="btn btn-info text-white btn-sm" href="{{route('tutor.show',
                                       [$sensei->id])}}"> <i class="fa fa-eye"></i></a>
                                       <a class="btn btn-warning text-white btn-sm" href="{{route('tutor.edit',
                                          [$sensei->id])}}"> <i class="fa fa-edit"></i> </a>
                                   <form onsubmit="return confirm('yakin untuk memasukkan ke Trash!')" class="d-inline" action="{{route('tutor.destroy', [$sensei->id])}}"   method="POST">
                                       @method('DELETE')
                                       @csrf
                                       <button type="submit" value="Delete" class="btn btn-danger btn-sm">
                                           <i class="fa fa-trash"></i> 
                                       </button>
                                       </form>
                                       </td>
                              
                            </tr>           
                                @endforeach
                        </tbody>
                        
                    </table>
                            
                            <div class="text-center">
                                {{ $tutor->links() }}
                            </div>

                    
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection