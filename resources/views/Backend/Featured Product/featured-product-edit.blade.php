@extends('Backend.master')
@section('title')
    {{ "Featured Product Edit" }}
@endsection
@section('featuredProduct')
    active
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('featuredProduct.index') }}">Featured Product</a>
          <span class="breadcrumb-item active">Featured Product Edit</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Edit Featured Product</h6>
                    <form action="{{ route('featuredProduct.update',$featuredProductEdit->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        {{-- Product Name --}}
                        <div class="row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Product Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="product_title" id="product_title" value="{{ $featuredProductEdit->product_title ?? old('product_title') }}" class="form-control @error('product_title') is-invalid @enderror" placeholder="Enter Title">
                              @error('product_title')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                        {{-- Product Thumbnail --}}
                        <div class="row mt-4">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Product Image:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="file" name="product_image" class="form-control @error('product_image') is-invalid @enderror" onchange="document.getElementById('product_image').src = window.URL.createObjectURL(this.files[0])">
                              <img src="{{ asset('Featured_Image/'.$featuredProductEdit->product_image) }}" width="100px" id="product_image">
                              @error('product_image')
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