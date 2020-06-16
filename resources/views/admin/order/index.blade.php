@extends('admin.layouts.manager')

@section('title','Bimble - Data Order')
@section('content')
    <div class="orders">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h4 class="box-title">Daftar Order Masuk</h4>
            </div>
            <div class="card-body--">

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


              <div class="table-stats order-table ov-h">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Total Order</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @forelse ($items as $item)
                      @if ($item->status_kursus != "CANCEL")
                          
                      <tr>
                        <td>{{ $item->id }}</td>
                        @foreach ($item->pendaftar as $user)
                            
                        <td>{{ $user->nama_pendaftar }}</td>
                        <td>{{ $user->email }}</td>
                        @endforeach
                        <td>@currency($item->total_tagihan).00</td>
                        <td>
                          @if($item->status_kursus == 'PENDING')
                            <span class="badge badge-info">
                          @elseif($item->status_kursus == 'SUCCESS')
                            <span class="badge badge-success">
                          @elseif($item->status_kursus == 'FAILED')
                            <span class="badge badge-warning">
                          @elseif($item->status_kursus == 'PROCESS')
                            <span class="badge badge-secondary">
                          @else
                            <span>
                          @endif
                            {{ $item->status_kursus }}
                            </span>
                        </td>
                        <td>
                          @if($item->status_kursus == 'PENDING')
                            <a href="{{ route('order.status', $item->id) }}?status=SUCCESS" class="btn btn-success btn-sm">
                              <i class="fa fa-check"></i>
                            </a>
                            <a href="{{ route('order.status', $item->id) }}?status=FAILED" class="btn btn-warning btn-sm">
                              <i class="fa fa-times"></i>
                            </a>
                          @endif
                          <a href="#mymodal"
                            data-remote="{{ route('order.show', $item->id) }}"
                            data-toggle="modal"
                            data-target="#mymodal"
                            data-title="Detail Order {{ $user->nama_pendaftar }}"
                            class="btn btn-info btn-sm">
                            <i class="fa fa-eye"></i>
                          </a>
                         
                          <form action="{{ route('order.destroy', $item->id) }}" 
                                method="post" 
                                class="d-inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm">
                              <i class="fa fa-trash"></i>
                            </button>
                          </form>
                        </td>
                      </tr>
                      @endif
                      
                      @empty
                        <tr>
                          <td colspan="6" class="text-center p-5">
                            Data tidak tersedia
                          </td>
                        </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
@endsection

