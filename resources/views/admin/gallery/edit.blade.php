@extends('admin.layouts.default')

@section('title','Bimble - Edit Data Gallery')
@section('content')
    <div class="card">
      <div class="card-header">
        <strong>Edit Gallery</strong>
      </div>
      <div class="card-body card-block">
                                    <form method="post" action="{{route('gallery.update',$gallery->id)}}" enctype="multipart/form-data">
                                      @csrf
                                     @method('PUT')

                                       <div class="form-group">
                                         <label for="kursus_id">Kursus</label>
                                         <select class="form-control" name="kursus_id" id="kursus_id">
                                         <option value="{{ $gallery->kursus_id }}"> Jangan Diubah</option>
                                         
                                           @foreach ($kursus as $kursus)      
                                         <option value="{{ $kursus->id }}">
                                          {{ $kursus->nama_kursus }}
                                        </option> 
                                           @endforeach
                                          
                                         </select>
                                       </div>
                                        
                                    <div class="form-group">
                                      <label for="image">Image</label>
                                      <input type="file" class="form-control-file" name="image" id="image" placeholder="" aria-describedby="fileHelpId">
                                      </div>
                                        
                                       
                                      <div class="form-group">
                                        <button class="btn btn-primary btn-block" type="submit">
                                          Edit Kursus
                                        </button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
@endsection