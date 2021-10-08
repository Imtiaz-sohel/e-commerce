@extends('Backend.master')
@section('title')
    {{ "Testimonial Edit" }}
@endsection
@section('testimonial')
    active
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('testimonial.index') }}">Testimonial</a>
          <span class="breadcrumb-item active">Testimonial Edit</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Edit Testimonial</h6>
                    <form action="{{ route('testimonial.update',$testimonialEdit->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Customer Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="c_name" id="c_name" value="{{ $testimonialEdit->c_name??old('c_name') }}" class="form-control @error('c_name') is-invalid @enderror" placeholder="Enter Customer Name">
                              @error('c_name')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                        <div class="row mt-4">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Customer Position:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="c_position" id="c_position" value="{{ $testimonialEdit->c_position??old('c_position') }}" class="form-control @error('c_position') is-invalid @enderror" placeholder="Enter Customer Position">
                              @error('')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                        <div class="row mt-4">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Customer Message:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="message" id="message" value="{{ $testimonialEdit->message??old('message') }}" class="form-control @error('message') is-invalid @enderror" placeholder="Enter Customer Message">
                              @error('message')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                        <div class="row mt-4">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Customer Image:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="file" name="c_image" class="form-control @error('c_image') is-invalid @enderror" placeholder="Enter Customer Image" onchange="document.getElementById('c_image').src = window.URL.createObjectURL(this.files[0])">
                              <img src="{{ asset('testimonial/'.$testimonialEdit->c_image) }}" width="100px" id="c_image" />
                              @error('c_image')
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