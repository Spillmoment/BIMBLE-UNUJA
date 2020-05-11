@extends('admin.layouts.main')

@section('title','Admin - Detail Data Kursus')

@section('content')

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Detail Data Order </h1>
    </div>


    <div class="row" style="overflow: scroll">
      <div class="col-md-12">
        <div class="container bg-white p-4" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">

          <div class="card shadow" style="width: 50rem; font-size: 15px">
            <div class="card-body">
              <h5 class="card-title">Detail Tutor {{ $tutor->nama_tutor }}
              </h5>

              <table class="table table-bordered">

                <tr>
                  <th>ID</th>
                  <td>{{ $tutor->id }}</td>
                </tr>
                <tr>
                  <th>Nama Tutor </th>
                  <td>{{ $tutor->username }}</td>
                </tr>
                <tr>
                  <th>Username</th>
                  <td>{{ $tutor->username }}</td>
                </tr>
                <tr>
                  <th>Email</th>
                  <td>{{ $tutor->email }}</td>
                </tr>

                 <tr>
                  <th>Foto</th>
                  <td>
                    <img src="{{ asset('uploads/tutor/' . $tutor->foto) }}" alt="" class="img-thumbnail mb-2" width="150px">
                    <br>
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modelId">
                     <i class="fas fa-eye    "></i> Show Images</button>
                  </td>
                </tr>

                <tr>
                  <th>Keahlian</th>
                  <td>{{ $tutor->keahlian }}</td>
                </tr>
                
                <tr>
                  <th>Status</th>
                  
                  @if ($tutor->status == 'ACTIVE')
                  <td><span class="badge badge-pill badge-success">{{ $tutor->status }}</span></td>
                  @else
                  <td><span class="badge badge-pill badge-danger">{{ $tutor->status }}</span></td>
                  @endif
                </tr>
                

         
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Foto Tutor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <img src="{{ asset('uploads/tutor/' . $tutor->foto) }}" alt="" class="img-thumbnail" >
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    
      </div>
    </div>
  </div>
</div>

@endsection