@extends('Frontend.master')
@section('ftitle')
    {{ "Order" }}
@endsection
{{-- @php
    Session::forget('coupon') 
@endphp --}}
@section('content')
<div class="container">
    <div class="row mt-5">
        <div class="col-12 text-center">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ Auth::user()->name }} Thanks For Shopping With Us ..</strong>
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
                                    <td>01-May-2001</td>
                                </tr>
                                <tr>
                                    <td>Payment Method</td>
                                    <td>Card</td>
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
                                    <td>Full Name</td>
                                </tr>
                                <tr>
                                    <td>Customer Email</td>
                                    <td>Email</td>
                                </tr>
                                <tr>
                                    <td>Customer Phone</td>
                                    <td>Phone</td>
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
                                <th>Product</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection