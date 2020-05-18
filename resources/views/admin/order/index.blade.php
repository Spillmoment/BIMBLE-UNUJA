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
             
         

        <div class="row" style="overflow: scroll">
            <div class="col-md-12">
                <div class="container bg-white p-4"
                    style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                  
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Total Tagihan</th>
                                <th>Status Order</th>
                                <th>Option</th>
                            </tr>
                        </thead>
                  
                        <tbody>
                           @forelse ($item as $order)
                               
                            <td> {{ $order->id}} </td>

                            @foreach ($order->pendaftar as $user)
                                <td>{{ $user->nama_pendaftar }}</td>
                                <td>{{ $user->email }}</td>
                            @endforeach

                            <td>@currency($order->total_tagihan).00</td>
                            <td>{{ $order->status_kursus }}</td>

                            <td>
                                <a class="badge badge-info text-white badge-pill" href="{{route('order.edit',
                                   [$order->id])}}"> <i class="fa fa-edit"></i> Edit</a>
                                <a class="badge badge-warning text-white badge-pill" href="{{route('order.show',
                                   [$order->id])}}"> <i class="fa fa-eye"></i> Detail</a>
                             
                        <form onsubmit="return confirm('yakin untuk memasukkan ke Trash!')" class="d-inline" action="{{route('order.destroy', [$order->id])}}"   method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" value="Delete" class="badge badge-danger badge-pill">
                                <i class="fa fa-trash"></i> Trash
                            </button>
                        </form>
                    </td>

                           @empty
                               Data Kosong
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