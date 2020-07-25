@extends('web.layouts.main')

@section('title','Bimble | Review ' . $kursus->nama_kursus)
@section('content')

<div class="container-fluid py-5 px-lg-5">
 <div class="row bootstrap snippets">
    <div class="col-md-6 col-md-offset-2 col-sm-12">
        <div class="comment-wrapper">
            <div class="panel panel-info">
                <div class="panel-heading">
                   <h5 class="text-dark mb-2">Review Kursus {{ $kursus->nama_kursus }}</h5>
                </div>
                <div class="panel-body">
                    <form action="/user/kursus/{{ $kursus->slug }}" method="POST">
                        @csrf
                        <div class="form-group">
                           <textarea class="form-control @error('textkomen') is-invalid @enderror" name="textkomen"
                                id="textkomen" rows="3" placeholder="Masukkan Review Anda..."></textarea>
                            @error('textkomen')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="float-right">
                            <a href="{{ route('user.kursus.success') }}" class="btn btn-primary pull-right btn-sm">Kembali</a>
                            <button type="submit" class="btn btn-primary pull-right btn-sm">Post</button>
                        </div>
                    </form>
                 
                    <div class="clearfix"></div>
                    <hr>
                    @foreach ($komentar as $komen)
                    @foreach ($komen->pendaftar as $user)
                    <ul class="list-unstyled media-list">
                        <li class="media">
                            <a href="#" class="pull-left">
                                <img src="{{ Storage::url('uploads/pendaftar/profile/'.$user->foto) }}" width="64px" height="64px" alt="{{ $user->nama_pendaftar }}" class="rounded-circle img-thumbnail">
                            </a>
                            <div class="media-body">
                                <span class="text-muted pull-right">
                                    <small class="text-muted ml-3">{{ $komen->updated_at->diffForhumans() }}</small>
                                </span>
                                <strong class="text-success ml-1"><span>@</span>{{$user->username }}</strong>
                                @endforeach
                                <p class="ml-3">
                                    {{ $komen->isi_komentar }}
                                </p>
                            </div>
                        </li>
                      
                    </ul>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
    </div>
@endsection

<style>

.comment-wrapper .panel-body {
    max-height:650px;
    overflow:auto;
}

.comment-wrapper .media-list .media img {
    width:64px;
    height:64px;
    border:2px solid #e5e7e8;
}

.comment-wrapper .media-list .media {
    border-bottom:1px dashed #efefef;
    margin-bottom:25px;
}
</style>
