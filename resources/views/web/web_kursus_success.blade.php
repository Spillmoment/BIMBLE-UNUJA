<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Eh-Bimble</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    @include('web.layouts.style')
</head>

<body style="padding-top: 72px;">
 

  @include('web.layouts.header-simple')

    <div class="container-fluid py-5 px-lg-5">
     
        <div class="row col-lg-9">
          

            @forelse ($kursus_success as $row)
       
            @if ($row->status == "PENDING")
                
              @foreach ($row->order as $item)
                  
                @if ($item->status_kursus == "SUCCESS")
              
                <br>
                <div class="alert alert-success">
                    @foreach ($row->kursus as $success)
                   
                    <h3>SUCCESS:  {{ $success->nama_kursus }}</h3>
                    @endforeach
                </div>
             
                @elseif($item->status_kursus == "PENDING")
                <br>
                <div class="alert alert-warning">

                    @foreach ($row->kursus as $pending)
                    <h3> PENDING: {{ $pending->nama_kursus }} </h3>
                    @endforeach
                </div>

                @endif
              @endforeach

            @endif
                  
            @empty
                <div>
                    <h1>Data Kosong</h1>
                </div>
            @endforelse

                
            </div>
        </div>
    </div>
    
    @include('web.layouts.footer')
    
    @include('web.layouts.script')

</body>

<script>

    
</script>

</html>