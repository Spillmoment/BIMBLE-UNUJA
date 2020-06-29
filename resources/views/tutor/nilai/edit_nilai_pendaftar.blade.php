@extends('admin.layouts.tutor')

@section('title','Bimble - Edit Nilai')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Nilai</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{ route('siswa.index') }}">Data Nilai</a></li>
                            <li class="active">Edit Nilai </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">

<div class="card">
    <div class="card-header">
        <strong>Edit Nilai @foreach ($nilai->pendaftar as $item)
          {{ $item->nama_pendaftar }}
        @endforeach</strong>
    </div>
    <div class="card-body card-block">
      <form action="/tutor/nilai/{{ $nilai->id }}/edit" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="id" value="{{ $nilai->id }}">
        <div class="form-group">
          <label for="nilai">Nilai</label>
          <input type="text" class="form-control {{ $errors->first('nilai') ? 'is-invalid' : '' }}" name="nilai" id="nilai" value="{{ old('nilai', $nilai->nilai) }}">
          <div class="invalid-feedback">
            {{ $errors->first('nilai') }}
          </div>
        </div>
       <div class="form-group">
         <label for="keterangan">Keterangan</label>
         <input type="text" class="form-control {{ $errors->first('keterangan') ? 'is-invalid' : '' }}" name="keterangan" id="keterangan" value="{{ old('keterangan', $nilai->keterangan) }}">
         <div class="invalid-feedback">
          {{ $errors->first('keterangan') }}
        </div>
        </div>
        
            <button type="submit" class="btn btn-primary btn-block">Edit Nilai</button>
        
      </form>
    </div>
</div>
</div>


@endsection