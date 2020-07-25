<div class="card card-shadow">

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card-body">
        <div class="card-header mb-3">
            <div class="clearfix">
                <h4 class="card-title mb-4">Profile {{ Auth::user()->nama_pendaftar }}</h4>
                <img src="{{ Storage::url('uploads/pendaftar/profile/'.Auth::user()->foto) }}" class="img-sm rounded-circle
                border" width="100px" height="100px">
            </div>
        </div>

        <form action="{{ route('profile.update', Auth::id() ) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="col form-group">
                    <label for="nama_lengkap" class="form-label"> Nama Lengkap </label>
                    <input name="nama_pendaftar" id="nama_lengkap" type="text" placeholder="Masukan Nama Lengkap"
                        class="form-control {{ $errors->first('nama_pendaftar') ? 'is-invalid' : '' }}"
                        value="{{old('nama_pendaftar', Auth::user()->nama_pendaftar) }}">
                    <div class="invalid-feedback">
                        {{$errors->first('nama_pendaftar')}}
                    </div>
                </div>

                <div class="col form-group">
                    <label for="email" class="form-label"> Email</label>
                    <input name="email" id="email" type="email" placeholder="Masukkan Email"
                        class="form-control {{ $errors->first('email') ? 'is-invalid' : '' }}"
                        value="{{old('email',  Auth::user()->email) }}">
                    <div class="invalid-feedback">
                        {{$errors->first('email')}}
                    </div>
                </div>
            </div> <!-- form-row.// -->

            <div class="form-row">

                <div class="col form-group">
                    <label for="jenis_kelamin" class="form-label"> Jenis Kelamin</label>
                    <div class="form-check {{ $errors->first('jenis_kelamin') ? 'is-invalid' : '' }}"
                        value="{{old('jenis_kelamin') }}">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="laki-laki" name="jenis_kelamin" class="custom-control-input "
                                value="L" required {{ Auth::user()->jenis_kelamin == 'L' ? 'checked' : ''}}>
                            <label for="laki-laki" class="custom-control-label">Laki-laki</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="perempuan" name="jenis_kelamin" class="custom-control-input"
                                value="P" required {{ Auth::user()->jenis_kelamin == 'P' ? 'checked' : ''}}>

                            <label for="perempuan" class="custom-control-label">Perempuan</label>
                        </div>

                    </div>
                </div>

                <div class="col form-group">
                    <label for="username" class="form-label"> Username</label>
                    <input name="username" id="username" type="text" placeholder="Masukkan Username"
                        class="form-control {{ $errors->first('username') ? 'is-invalid' : '' }}"
                        value="{{old('username',  Auth::user()->username) }}">
                    <div class="invalid-feedback">
                        {{$errors->first('username')}}
                    </div>
                </div>

            </div>
            <div class="form-row">

                <div class="col form-group">
                    <label for="foto" class="form-label">Foto</label>
                    <input type="file" class="form-control-file {{ $errors->first('foto') ? 'is-invalid' : '' }}"
                        name="foto" id="foto">
                    <div class="mt-3">
                        <img class="img-target" width="200px">
                    </div>
                    <div class="invalid-feedback">
                        {{$errors->first('foto')}}
                    </div>
                </div>

                <div class="col form-group">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea rows="4" name="alamat" id="alamat" placeholder="Masukkan Alamat"
                        class="form-control {{ $errors->first('alamat') ? 'is-invalid' : '' }}">
                                         {{old('alamat',Auth::user()->alamat) }}
                    </textarea>

                    <div class="invalid-feedback">
                        {{$errors->first('alamat')}}
                    </div>
                </div>

            </div>
            <button class="btn btn-primary btn-block" type="submit">Simpan</button>
        </form>
    </div> <!-- card-body.// -->

</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        var readURL = function (input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.img-target').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".form-control-file").on('change', function () {
            readURL(this);
        });
    });

</script>
@endpush
