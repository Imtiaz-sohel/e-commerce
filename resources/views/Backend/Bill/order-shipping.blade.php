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
          <span class="breadcrumb-item active">Shipping Or Order</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card-body" style="background: #fff">
                    <h5 class="card-title">Shipping Address</h5>
                    <h5 class="card-text">{{ $shipping->s_full_name }}</h5>
                        <p>{{ $shipping->country->name }},{{ $shipping->state->name }}<br>
                         <p>{{ $shipping->city->name }}</p>
                         <span>{{ $shipping->s_address }}</span>
                        </p>
                        <p>{{ $shipping->s_phone }}</p>
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