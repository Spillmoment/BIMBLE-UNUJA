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
        @push('scripts')
        <script>
            swal({
            title: "Success",
            text: "{{session('status')}}",
            icon: "success",
            button: false,
            timer: 1500
            });
        </script>
        @endpush
         @endif

             
         

        <div class="row" style="overflow: scroll">
            <div class="col-md-12">
                <div class="container bg-white p-4"
                    style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                  
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Total Tagihan</th>
                                <th>Status Order</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                 
              
                        <tbody>
                            @forelse ($order as $row)                
                            <tr>
                                <td> {{ $row->id }} </td>
                                @foreach ($row->pendaftar as $item)
                                    <td> {{ $item->nama_pendaftar }} </td>
                                    <td>{{ $item->username }}</td>
                                @endforeach
                                <td>@currency($row->total_tagihan).00</td>

                                @if ($row->status_kursus == 'SUCCESS')
                                <td>
                                    <span class="badge badge-success  badge-pill"><i class="fas fa-check-circle "></i>
                                        {{ $row->status_kursus }}</span>
                                </td>
                                @elseif($row->status_kursus == 'CANCEL')
                                <td>
                                    <span class="badge badge-danger  badge-pill"><i class="fas fa-backspace"></i>
                                        {{ $row->status_kursus }}</span>
                                </td>
                                @elseif($row->status_kursus == 'FAILED')
                                <td>
                                    <span class="badge badge-danger  badge-pill"><i class="fas fa-eye-slash    "></i>
                                        {{ $row->status_kursus }}</span>
                                </td>
                                @else
                                <td>
                                    <span class="badge badge-warning badge-pill"><i class="fas fa-bullseye"></i>
                                        {{ $row->status_kursus }}</span>
                                </td>
                                @endif
                                
                                <td>
                                    <a class="btn btn-info text-white btn-sm" href="{{route('order.edit',
                                  [$row->id])}}"> <i class="fa fa-edit"></i> </a>
                               <a class="btn btn-warning text-white btn-sm" href="{{route('order.show',
                                  [$row->id])}}"> <i class="fa fa-eye"></i> </a>
                                          
                       <form onsubmit="return confirm('yakin untuk memasukkan ke Trash!')" class="d-inline" action="{{route('order.destroy', [$row->id])}}"   method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" value="Delete" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash"></i> 
                        </button>
                    </form>
                                </td>
                            </tr>
                            @empty
                            @endforelse
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