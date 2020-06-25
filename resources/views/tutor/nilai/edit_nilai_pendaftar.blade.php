<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Edit Nilai Pendaftar</title>
</head>
<body>
  <ul>
      @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
      @endforeach
  </ul>
  @if ($message = Session::get('success'))
    <p>{{ $message }}</p>
  @endif
  <form action="/tutor/nilai/{{ $nilai->id }}/edit" method="post">
    @csrf
    @method('patch')
    <input type="hidden" name="id" value="{{ $nilai->id }}">
    <p>Nilai</p>
    <input type="text" name="nilai" id="nilai" value="{{ old('nilai', $nilai->nilai) }}">
    <p>Keterangan</p>
    <input type="text" name="keterangan" id="keterangan" value="{{ old('keterangan', $nilai->keterangan) }}">
    <br>
    <input type="submit" value="Edit">
  </form>
</body>
</html>