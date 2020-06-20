@extends('admin.layouts.tutor')

@section('title','Bimble - Tambah Data Siswa')
@section('content')
<div class="card">
    <div class="card-header">
        <strong>Tambah Nilai {{ $siswa->nama_siswa }}</strong>
    </div>
    <div class="card-body card-block">
        <form action="{{ route('siswa.add') }}" method="POST">
            @csrf
            @method('PUT')

            @if (Auth::check())
            <input type="hidden" name="id_tutor" value="{{ Auth::user()->id }}" contextmenu="">
            @endif

            <input type="hidden" name="nama_siswa" value="{{ $siswa->nama_siswa }}" contextmenu="">
            <input type="hidden" name="jenis_kelamin" value="{{ $siswa->jenis_kelamin }}" contextmenu="">
            <input type="hidden" name="alamat" value="{{ $siswa->alamat }}" contextmenu="">
            <input type="hidden" name="username" value="{{ $siswa->username }}" contextmenu="">
            <input type="hidden" name="password" value="{{ $siswa->password }}" contextmenu="">
            <input type="hidden" name="konfirmasi_password" value="{{ $siswa->password }}" contextmenu="">
            <input type="hidden" name="keterangan" value="{{ $siswa->keterangan }}" contextmenu="">

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
