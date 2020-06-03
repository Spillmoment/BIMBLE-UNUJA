@extends('admin.layouts.default')

@section('title','Bimble - Data Gallery')
@section('content')
    <div class="orders">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="box-title">List Gallery Kursus</h4>

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
              <div class="card-body--">
              
                <a class="btn btn-primary btn-sm my-3" href="{{ route('gallery.create') }}"> <i class="fa fa-plus" aria-hidden="true"></i> </a>
                <div class="table-stats order-table ov-h">
                  <table class="table table-hover">
                     <thead>
                            <tr>
                                <th>#</th>
                                <th>Kursus</th>
                                <th>Gambar</th>
                                <th>Option</th>
                               
                            </tr>
                        </thead>
                   
                        <tbody>
                            @foreach ($gallery as $gallery)
                            <tr>
                              <td> {{$loop->iteration}} </td>
                                <td> {{ $gallery->kursus->nama_kursus }} </td>
                              <td>
                              <img src="{{ Storage::url($gallery->image) }}" alt="" srcset="" width="150px" class="img-thumbnail">
                              </td>
                              
                                <td>
                                    <a class="btn btn-warning text-white btn-sm" href="{{route('gallery.edit',
                                       [$gallery->id])}}"> <i class="fa fa-edit"></i></a>
                            <form onsubmit="return confirm('yakin untuk memasukkan ke Trash!')" class="d-inline" action="{{route('gallery.destroy', [$gallery->id])}}"   method="POST">
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