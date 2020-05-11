@extends('admin.layouts.main')

@section('title','Admin - Detail Data Kursus')

@section('content')
    
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Data Order </h1>
        </div>

        
        <div class="row" style="overflow: scroll">
            <div class="col-md-12">
                <div class="container bg-white p-4"
                    style="border-radius:3px;box-shadow:rgba(0, 0, 0, 0.03) 0px 4px 8px 0px">
                    
                    <div class="card shadow" style="width: 50rem; font-size: 15px">
                     <div class="card-body">
                        <h5 class="card-title">Detail Order 
                          @foreach ($item->pendaftar as $user)
                              
                          {{ $user->nama_pendaftar }} 
                          @endforeach
                        </h5>
                        
                        <table class="table table-bordered">

                          <tr>
                            <th>ID</th>
                            <td>{{ $item->id }}</td>
                          </tr>
                          <tr>
                            <th>Username</th>
                            <td>{{ $user->username }}</td>
                          </tr>
                          <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                          </tr>
                          
                          @foreach ($item->kursus as $kursus)    
                          <tr>
                            <th>Paket Kursus</th>
                            <td>{{ $kursus->nama_kursus }}</td>
                          </tr>
                          <tr>
                            <th>Biaya Kursus</th>
                            <td>{{ $kursus->biaya_kursus }}</td>
                          </tr>
                          @endforeach
                          
                          <tr>
                            <th>Status Order</th>
                            <td>{{ $item->status_kursus }}</td>
                          </tr>
                          
                          <tr>
                            <th>Pembelian</th>
                            <td>
                              <table class="table table-bordered">
                                <tr>
                                  <th>ID</th>
                                  <th>No Orders</th>
                                  <th>Tanggal Orders</th>
                                </tr>
                                @foreach ($item->details as $detail)
                                <tr>
                                  <td> {{ $detail->id }} </td>
                                  <td> {{ $detail->no_orders }} </td>
                                  <td> {{ $detail->tanggal_order }} </td>
                                </tr>
                                @endforeach
                              </table>
                            </td>
                          </tr>
                              </table>
                      </div>
                    </div>
                   
                </div>
            </div>
        </div>
</div>


@endsection