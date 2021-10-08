@extends('Backend.master')
@section('title')
    {{ "Testimonial List" }}
@endsection
@section('testimonial')
    active
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('testimonial.index') }}">Testimonial</a>
          <span class="breadcrumb-item active">Testimonial Add & View</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row">
            <div class="col-7">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">All Testimonial ({{ $testimonialCount }})</h6>
                    <div class="bd bd-gray-300 rounded table-responsive">
                      <table class="table mg-b-0">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Customer Name</th>
                            <th>Customer Position</th>
                            <th>Customer Image</th>
                            <th>Message</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($testimonials as $key => $testimonial)                                
                            <tr>
                              <td>{{ $testimonials->firstItem () + $key }}</td>
                              <td>{{ $testimonial->c_name }}</td>
                              <td>{{ $testimonial->c_position }}</td>
                              <td>
                                  <img width="100px" src="{{ asset('testimonial/'.$testimonial->c_image) }}" alt="">
                              </td>
                              <td>{{ $testimonial->message }}</td>
                              <td>
                                  <a class="btn btn-outline-success" href="{{ route('testimonial.edit',$testimonial->id) }}"><i class="fa fa-edit"></i></a>
                                  <form action="{{ route('testimonial.destroy',$testimonial->id) }}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                   <button class="btn btn-outline-danger" type="submit"><i class="fa fa-trash"></i></button>
                                 </form>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div><!-- bd -->
                </div>
                {{ $testimonials->links() }}
                <div class="row mt-4">
                    <div class="col-xl-12">
                        <div class="br-section-wrapper">
                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Trash ({{ $testTrashCount }})</h6>
                            <div class="bd bd-gray-300 rounded table-responsive">
                              <table class="table mg-b-0">
                                <thead>
                                  <tr>
                                    <th>SL</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($testimonialTrashes as $key => $testimonialTrash)       
                                    <tr>
                                      <td>{{ $testimonialTrashes->firstItem() + $key }}</td>
                                      <td>{{ $testimonialTrash->c_name }}</td>
                                      <td>
                                          <img width="100px" src="{{ asset('testimonial/'.$testimonialTrash->c_image) }}" alt="{{ $testimonialTrash->c_name }}">
                                      </td>
                                      <td>
                                          <a href="{{ route('testimonialRestore',$testimonialTrash->id) }}" class="btn-outline-success">Restore</a>
                                          <a href="{{ route('testimonialPermanentDelete',   $testimonialTrash->id) }}" class="btn-outline-danger">Permanent Delete</a>
                                      </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                    {{ $testimonialTrashes->links() }}
                </div>
              </div>
              <div class="col-5">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Add Testimonial</h6>
                    <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Customer Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="c_name" id="c_name" value="{{ old('c_name') }}" class="form-control @error('c_name') is-invalid @enderror" placeholder="Enter Customer Name">
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
                              <input type="text" name="c_position" id="c_position" value="{{ old('c_position') }}" class="form-control @error('c_position') is-invalid @enderror" placeholder="Enter Customer Position">
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
                              <input type="text" name="message" id="message" value="{{ old('message') }}" class="form-control @error('message') is-invalid @enderror" placeholder="Enter Customer Message">
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
                              <img width="100px" id="c_image" />
                              @error('c_image')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                          <div class="row mg-t-30">
                            <div class="col-sm-8 mg-l-auto text-center">
                              <div class="form-layout-footer">
                                <button style="cursor: pointer" type="submit" class="btn btn-info">Submit</button>
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