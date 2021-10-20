@extends('Backend.master')
@section('bill')
    active
@endsection
@section('title')
    {{ "All Bill" }}
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('allBill') }}">All Bill</a>
          <span class="breadcrumb-item active">Order By Bill</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row">
            <div class="col-6">
                <div class="card pd-20 pd-sm-40">
                    <div class="account-information">
                        <h4>Order Information</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Order Date</td>
                                        <td>{{ $orders[0]->billing->created_at->format('Y-M-d') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Status</td>
                                        <td>{{ $orders[0]->billing->payment_status==1?"Unpaid":"Paid" }}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Method</td>
                                        <td>{{ $orders[0]->billing->pay_type }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card pd-20 pd-sm-40">
                    <div class="account-information">
                        <h4>Account Information</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Customer Name</td>
                                        <td>{{ $orders[0]->billing->full_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Customer Address</td>
                                        <td>{{ $orders[0]->billing->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>Customer Phone</td>
                                        <td>{{ $orders[0]->billing->phone }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <div class="card pd-20 pd-sm-40">
                    <h6 class="card-body-title text-center">Order Table</h6>
                    <div class="table-responsive">
                      <table class="table mg-b-0">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Product Name</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php
                                $subtotal=0;
                            @endphp
                            @foreach($orders as $key => $order)                                
                            <tr>
                              <td>{{ ++$key }}</td>
                              <td>{{ $order->product->product_title }}</td>
                              <td>{{ $order->color->color_name }}</td>
                              <td>{{ $order->size->size_name }}</td>
                              <td>{{ $order->product_price }}</td>
                              <td>{{ $order->quantity }}</td>
                              <td>${{ $order->product_price*$order->quantity }}</td>
                            </tr>
                            @php
                                $subtotal+=$order->product_price*$order->quantity;
                            @endphp
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
        <div class="col-6"></div>
        <div class="col-6">
            <div class="card-box">
                <div class="table-responsive">
                    <table class="table" style="background: #fff">
                        <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td class="text-right">${{ $subtotal }}</td>
                            </tr>
                            <tr>
                                <td>Delivery Chrage</td>
                                <td class="text-right">Free</td>
                            </tr>
                            <tr>
                                <td>Discount</td>
                                <td class="text-right">{{ $order->billing->discount }}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td class="text-right">${{ $order->billing->total_amount }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <footer class="br-footer">
        <div class="footer-left">
          <div class="mg-b-2">Copyright © 2017. Bracket. All Rights Reserved.</div>
          <div>Attentively and carefully made by Imtiaz Sattar Sohel</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <span class="tx-uppercase mg-r-10">Share:</span>
          <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/bracket/intro"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Bracket,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/bracket/intro"><i class="fa fa-twitter tx-20"></i></a>
        </div>
    </footer>
</div>
@endsection