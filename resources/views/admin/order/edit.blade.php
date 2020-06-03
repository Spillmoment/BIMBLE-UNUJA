@extends('admin.layouts.default')

@section('title','Bimble - Edit Order')

@section('content')
    <div class="card">
      <div class="card-header">
        <strong>Ubah Status Order </strong>
          <span class="badge badge-warning text-light badge-pill badge-lg">
            @foreach ($order->pendaftar as $item)
              {{ $item->nama_pendaftar }}
        @endforeach 
          </span>
      </div>
      <div class="card-body card-block">
        <form action="{{route('order.update',[$order->id])}}" method="POST">
          @method('PUT')
          @csrf
         
          <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" name="status_kursus" id="status">
              <option value="{{ $order->status_kursus }}">Jangan Diubah ({{ $order->status_kursus }})</option>
             <option value="PENDING">PENDING</option>
             <option value="SUCCESS">SUCCESS</option>
             <option value="PROCESS">PROCESS</option>
             <option value="CANCEL">CANCEL</option>
             <option value="FAILED">FAILED</option>
            </select>
          </div>
          
          <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit">
              Ubah Order
            </button>
          </div>
        </form>
      </div>
    </div>
@endsection