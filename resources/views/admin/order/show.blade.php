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
                            <th>ID Order</th>
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
                          

                          @if ($item->status_kursus == 'SUCCESS')
                          <tr>
                            <th>Status Order</th>
                            <td>
                              <span class="badge badge-success  badge-pill"><i class="fas fa-check-circle "></i>
                                {{ $item->status_kursus }}</span>
                              </td>
                            </tr>
                          @elseif($item->status_kursus == 'CANCEL')
                          <tr>

                            <th>Status Order</th>
                            <td>
                              <span class="badge badge-danger  badge-pill"><i class="fas fa-backspace"></i>
                                {{ $item->status_kursus }}</span>
                              </td>
                            </tr>
                              @elseif($item->status_kursus == 'FAILED')
                              <tr>
                                <th>Status Order</th>
                                <td>
                                  <span class="badge badge-danger  badge-pill"><i class="fas fa-eye-slash    "></i>
                                    {{ $item->status_kursus }}</span>
                                  </td>
                                </tr>
                              
                          @else
                          <tr>
                            <th>Status Order</th>
                            <td>
                              <span class="badge badge-warning badge-pill"><i class="fas fa-bullseye"></i>
                                {{ $item->status_kursus }}</span>
                              </td>
                            </tr>
                              @endif
                          
                          <tr>
                            <th>Pembelian</th>
                            <td>
                              <table class="table table-bordered">
                                <tr>
                                  <th>ID User</th>
                                  <th>Total Tagihan</th>
                                  <th>Tanggal Orders</th>
                                </tr>
                              
                                <tr>
                                  <td> {{ $item->order_detail->id }} </td>
                                  <td> @currency($item->total_tagihan ).00 </td>
                                  <td> {{ $item->order_detail->created_at->format('d M Y')}} </td>
                                </tr>
                               
                              </table>
                            </td>
                          </tr>
                              </table>
                      </div>
                    </div>z
                   
                </div>
            </div>
        </div>
</div>


@endsection