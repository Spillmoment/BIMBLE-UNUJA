@extends('admin.layouts.tutor')

@section('title','Bimble - Tambah Data Siswa')
@section('content')
<div class="card">
    <div class="card-header">
        <strong>Tambah Nilai {{ $siswa->nama_siswa }}</strong>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('siswa.add', [$siswa->id]) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="col-md-4">
                <div class="form-group ">
                    <label for="nilai">Nilai Siswa</label>
                    <input type="number" class="form-control {{ $errors->first('nilai') ? 'is-invalid' : '' }}"
                        name="nilai" id="nilai" value="{{old('nilai')}}" placeholder="Nilai Siswa">
                    <div class="invalid-feedback">
                        {{$errors->first('nilai')}}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit">
                    Tambah Nilai
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
