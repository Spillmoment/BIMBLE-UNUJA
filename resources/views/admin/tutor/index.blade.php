@extends('admin.layouts.main')

@section('title','Admin - Data Tutor')

@section('content')
    
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Management Data Tutor </h1>
        </div>


        @if(session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('status')}}</strong> 
            <button type="button" class="close text-light" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         @endif
      
    
        <div class="section-header">
        <a href="{{ route('tutor.create') }}" class="btn btn-primary">
           <i class="fa fa-plus"></i> <big>Tambah Data Tutor</big></a>
        </div>
        <div class="row" style="overflow: scroll">
            <div class="col-md-12">
                <div class="container bg-white p-4"
                    style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Tutor</th>
                                <th>Alamat</th>
                                <th>Email</th>
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
                            <td> {{ $sensei->alamat }} </td>
                           <td> {{ $sensei->email }} </td>
                          
                            <td> <img src="{{ asset('storage/'. $sensei->foto) }}" width="50px"> </td>
                            <td>{{ $sensei->status }}</td>
                                <td>
                                    <a class="badge badge-info text-white badge-pill" href="{{route('tutor.edit',
                                       [$sensei->id])}}"> <i class="fa fa-edit"></i> Edit</a>
                                    <a class="badge badge-warning text-white badge-pill" href="{{route('tutor.show',
                                       [$sensei->id])}}"> <i class="fa fa-eye"></i> Detail</a>
                                   <form onsubmit="return confirm('yakin untuk memasukkan ke Trash!')" class="d-inline" action="{{route('tutor.destroy', [$sensei->id])}}"   method="POST">
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