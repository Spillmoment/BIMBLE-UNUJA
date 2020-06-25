<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Eh-Bimble | Kursus</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    @include('web.layouts.style')
    {{-- crsf-token Meta --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .bd-callout {
            padding: 1.25rem;
            margin-top: 1.25rem;
            margin-bottom: 1.25rem;
            border: 1px solid #eee;
            border-left-width: .25rem;
            border-radius: .25rem;

            h2,
            h3,
            h4,
            h5 {
                margin-top: 0;
                margin-bottom: .25rem
            }

            p:last-child {
                margin-bottom: 0
            }

            code {
                border-radius: .25rem
            }
        }

        .bd-callout-primary {
            border-left-color: $primary;

            h2,
            h3,
            h4,
            h5 {
                color: $primary
            }
        }

    </style>
</head>

<body style="padding-top: 72px;">


    @include('web.layouts.header')

    <div class="container-fluid py-5 px-lg-5">
        <h4>Kursus {{ $kursus->nama_kursus }}</h4>
        <h5 class="text-muted mb-3">{{ Auth::user()->nama_pendaftar }}</h5>
        <hr>
        <div class="row">

            {{-- <div class="col-lg-9">
            <div class="row">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Komentar</label>
                        <textarea class="form-control" id="textkomen" rows="3"></textarea>
                    </div>
                    <button type="button" data-slug="{{ $kursus->slug }}" id="komen" class="btn
            btn-primary">Submit</button>
            </form>
            <a href="{{ route('front.index') }}">kehome</a>
        </div>
    </div> --}}

    <div class="col-md-12">
        <div class="row">
            <form action="/user/kursus/{{ $kursus->slug }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Komentar</label>
                    <textarea class="form-control @error('textkomen') is-invalid @enderror" name="textkomen"
                        id="textkomen" rows="3"></textarea>
                    @error('textkomen')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" data-slug="{{ $kursus->slug }}" id="komen" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>

    </div>
    </div>

    @foreach ($komentar as $komen)
    <div class="row ml-5">
        <div class="bd-callout bd-callout-primary">
            @foreach ($komen->pendaftar as $pendaftar)
            <h6>{{ $pendaftar->nama_pendaftar }}</h6>
            @endforeach
            <p class="text-muted">{{ $komen->updated_at->diffForHumans() }}</p>
            <p>{{ $komen->isi_komentar }}</p>
        </div>
    </div>
    @endforeach

    @include('web.layouts.footer')

    @include('web.layouts.script')

    <script type="text/javascript">
        // jQuery(document).ready(function(){

        //     $('#komen').click(function(e) {
        //         e.preventDefault();
        //         $.ajaxSetup({
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             }
        //         });
        //         let slug = $(this).data("slug");
        //         let komentar = $('textarea#textkomen').val();
        //         let token = $('meta[name="csrf-token"]').attr('content');
        //         let a = '/user/kursus/'+slug+'/komentar';
        //         console.log(token);

        //         $.ajax({
        //             url: "/user/kursus/"+slug+"/komentar",
        //             type: 'post',
        //             data: {
        //                 "_method": 'POST',
        //                 "_token": token,
        //                 "komen": komentar,
        //             },
        //             success: function(respons) {
        //                 // console.log(respons);
        //             },
        //             error: function(res) {
        //                 console.log(res);
        //             }
        //         });
        //     });
        // });

    </script>
</body>

</html>
