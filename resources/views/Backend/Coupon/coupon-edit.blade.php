@extends('Backend.master')
@section('coupon')
    active
@endsection
@section('title')
    {{ "Coupon" }}
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('coupon.index') }}">Coupon</a>
          <span class="breadcrumb-item active">Edit Coupon</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row m-auto">
            <div class="col-xl-8 m-auto">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Edit Coupon</h6>
                    <form action="{{ route('coupon.update',$couponEdit->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Coupon Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="coupon_name" id="coupon_name" value="{{ $couponEdit->coupon_name ?? old('coupon_name') }}" class="form-control @error('coupon_name') is-invalid @enderror" placeholder="Boishak">
                              @error('coupon_name')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Code:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="code" id="code" value="{{ $couponEdit->code?? old('code') }}" class="form-control @error('code') is-invalid @enderror" placeholder="code">
                              @error('code')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                        </div>
                        <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Type:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="discount_type" id="discount_type" class="form-control">
                                    <option @if ($couponEdit->discount_type==1) selected @endif value="1">%</option>
                                    <option @if ($couponEdit->discount_type==2) selected @endif value="2">Fixed Amount</option>
                                </select>
                            </div>
                          </div>
                          <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Amount:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="discount_amount" id="discount_amount" value="{{ $couponEdit->discount_amount ??old('discount_amount') }}" class="form-control @error('discount_amount') is-invalid @enderror" placeholder="50">
                              @error('discount_amount')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                         </div>
                          <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Start Date:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="date" name="starting_date" id="starting_date" value="{{ $couponEdit->starting_date ??old('starting_date') }}" class="form-control @error('starting_date') is-invalid @enderror">
                              @error('starting_date')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                         </div>
                          <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>End Date:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="date" name="ending_date" id="ending_date" value="{{ $couponEdit->ending_date ?? old('ending_date') }}" class="form-control @error('ending_date') is-invalid @enderror">
                              @error('ending_date')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                         </div>
                          <div class="row mg-t-20">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Min Amount:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="min_order" id="min_order" value="{{ $couponEdit->min_order??old('min_order') }}" class="form-control @error('min_order') is-invalid @enderror" placeholder="500">
                              @error('min_order')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                         </div>
                          <div class="row mg-t-30">
                            <div class="col-sm-8 mg-l-auto">
                              <div class="form-layout-footer">
                                <button style="cursor: pointer" type="submit" class="btn btn-info">Update</button>
                              </div>
                            </div>
                        </div>
                    </form>
                </div> 
            </div>
        </div>
    </div>
    <footer class="br-footer">
        <div class="footer-left">
          <div class="mg-b-2">Copyright © 2017. Bracket. All Rights Reserved.</div>
          <div>Attentively and carefully made by ThemePixels.</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <span class="tx-uppercase mg-r-10">Share:</span>
          <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/bracket/intro"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Bracket,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/bracket/intro"><i class="fa fa-twitter tx-20"></i></a>
        </div>
    </footer>
</div>
@endsection