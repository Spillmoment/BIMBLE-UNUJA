@extends('admin.layouts.default')

@section('title','Bimble - Data Kursus')
@section('content')
    <div class="orders">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="box-title">List Kursus</h4>

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

              <form action="{{route('kursus.index')}}">    

                <div class="row mt-2">

                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" {{ Request::get('keyword') }} name="keyword"  placeholder="Masukkan Nama kursus" autofocus>
                        </div>
                    </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-secondary"> <i class="fa fa-search" aria-hidden="true"></i> </button>
                                <a href="{{ route('kursus.index') }}" class="btn btn-warning text-light ml-2"> <i class="fa fa-refresh" aria-hidden="true"></i> </a>
                            </div>
                           
                </div>
              </form>
            </div>
            <div class="card-body--">
              
              <a class="btn btn-primary btn-sm ml-3 mb-3" href="{{ route('kursus.create') }}"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
              <div class="table-stats order-table ov-h">
                <table class="table table-hover">
                  <thead>
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
                                  <a href="{{ route('kursus.gallery', $krs->id) }}" class="btn btn-info btn-sm">
                                      <i class="fa fa-picture-o"></i>
                                    </a>
                                  <a class="btn btn-primary btn-sm" href="{{route('kursus.show',
                                     [$krs->id])}}"> <i class="fa fa-eye"></i> </a>
                                    <a class="btn btn-warning btn-sm text-light" href="{{route('kursus.edit',
                                       [$krs->id])}}"> <i class="fa fa-edit"></i></a>
                                 
                            <form onsubmit="return confirm('yakin untuk memasukkan ke Trash!')" class="d-inline" action="{{route('kursus.destroy', [$krs->id])}}"   method="POST">
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
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
@endsection

