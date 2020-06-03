@extends('admin.layouts.default')

@section('title','Bimble - Edit Data Kategori')
@section('content')
    <div class="card">
      <div class="card-header">
        <strong>Edit Kategori</strong>
      </div>
      <div class="card-body card-block card-shadow">

                                    <form method="post" action="{{route('kategori.update',[$kategori->id])}}">
                                      @csrf
                                     @method('PUT')

                                        <div class="form-group ">
                                           <label for="nama_kategori">Nama Kategori</label>
                                            <input type="text" class="form-control {{ $errors->first('nama_kategori') ? 'is-invalid' : '' }}" name="nama_kategori"  id="nama_kategori" value="{{ $kategori->nama_kategori }}"  placeholder="Nama Kategori">
                                               <div class="invalid-feedback">
                                                   {{$errors->first('nama_kategori')}}
                                                </div>
                                            </div>
                                        
                                    
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control {{$errors->first('keterangan') ? "is-invalid" : ""}}">{{old('keterangan') ?
                                              old('keterangan') : $kategori->keterangan}}</textarea>
                                            <div class="invalid-feedback">
                                                {{$errors->first('keterangan')}}
                                             </div>
                                           </div>

                                           <div class="form-group">
                                            <button class="btn btn-primary btn-block" type="submit">
                                             Ubah Kategori
                                            </button>
                                          </div>
                           
                            </form>
                          </div>
                        </div>
                     
@endsection