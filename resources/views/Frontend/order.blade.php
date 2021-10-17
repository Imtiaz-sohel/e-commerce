@extends('Frontend.master')
@section('ftitle')
    {{ "Order" }}
@endsection
@php
    Session::forget('coupon') 
@endphp
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-12 text-center">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ $orders[0]->billing->full_name }} Thanks For Shopping With Us ..</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
        </div>
    </div>
    <div class="row m-5">
        <div class="col-md-6">
            <div class="card-box">
                <div class="order clearfix">
                    <h4>Order Information</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Order Date</td>
                                    <td>{{ $orders[0]->created_at->format('Y-m-d') }}</td>
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
        <div class="col-md-6">
            <div class="card-box">
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
                                    <td>Customer Email</td>
                                    <td>{{ $orders[0]->billing->email }}</td>
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
    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card-box">
                <h3 class="section-title">Items Ordered</h3>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $key => $order)                                
                            <tr>
                                <td><img width="100px" src="{{ asset('product/thumbnail/'.$order->product->thumbnail) }}" alt=""></td>
                                <td>{{ $order->product->product_title }}</td>
                                <td>{{ $order->color->color_name }}</td>
                                <td>{{ $order->size->size_name }}</td>
                                <td>{{ $order->product_price }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>${{ $order->quantity*$order->product_price }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="back_home text-center">
                <a href="{{ route('frontPage') }}">Back To Home</a>
            </div>
        </div>
    </div>
</div>    
@endsection