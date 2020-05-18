@extends('admin.layouts.main')

@section('title','Admin - Edit Data Order')

@section('content')

  <div class="main-content">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">

                    <div class="card card-primary">
                        <div class="col-md-12 text-center">
                            <p class="registration-title font-weight-bold display-4 mt-4" style="font-size: 50px;">
                               Edit Order</p>
                            <p style="line-height:-30px;margin-top:-20px;">Silahkan ubah data data yang diperlukan
                                dibawah </p>
                            <hr>
                        </div>

                        <div class="card-body">
                                <div class="col-md-12 bg-white" style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                                    <form method="post" action="{{route('order.update',[$order->id])}}">
                                      @csrf
                                     @method('PUT')      

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
                                       <br>
                                        <button type="submit" class="btn btn-block btn-primary">
                                          <big>Ubah Order</big></button>
                                </div>

                              </div>
                            </form>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
  </div>
@endsection