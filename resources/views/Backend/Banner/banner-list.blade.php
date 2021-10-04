@extends('Backend.master')
@section('banner')
    active
@endsection
@section('title')
    {{ 'Banner' }}
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('banner.index') }}">Banner</a>
          <span class="breadcrumb-item active">Banner View & Add</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row">
            <div class="col-xl-8">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Banner ({{ $bannerCount }})</h6>
                    <div class="bd bd-gray-300 rounded table-responsive">
                      <table class="table mg-b-0">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Banner Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($banners as $key => $banner)                                
                            <tr>
                              <td>{{ $banners->firstItem() + $key }}</td>
                              <td>{{ $banner->title }}</td>
                              <td>{{ $banner->description }}</td>
                              <td>
                                  <img width='50%' src="{{ asset('banner/'.$banner->image) }}" alt="{{ $banner->title }}">
                              </td>
                              <td>
                                  @if($banner->status==1)
                                   <a href="{{ route('bannerStatus',$banner->id) }}" class="btn-outline-success">Active</a>
                                  @else
                                   <a href="{{ route('bannerStatus',$banner->id) }}" class="btn-outline-danger">Inactive</a>
                                  @endif
                              </td>
                              <td>
                                  <a href="{{ route('banner.edit',$banner->id) }}" class="btn btn-outline-info"><i class="fa fa-edit"></i></a>
                                  <form action="{{ route('banner.destroy',$banner->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"  class="btn btn-outline-danger"><i class="fa fa-trash"></i></button> 
                                  </form>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div><!-- bd -->
                </div>
                {{ $banners->links() }}
                <div class="row mt-4">
                    <div class="col-xl-12">
                        <div class="br-section-wrapper">
                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Trash ({{ $bannerTrasheCount }})</h6>
                            <div class="bd bd-gray-300 rounded table-responsive">
                              <table class="table mg-b-0">
                                <thead>
                                  <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($bannerTrashes as $key => $bannerTrash) 
                                    <tr>
                                      <td>{{ $bannerTrashes->firstItem() + $key }}</td>
                                      <td>{{ $bannerTrash->title }}</td>
                                      <td>
                                          <a href="{{ route('bannerRestore',$bannerTrash->id) }}" class="btn-outline-success">Restore</a>
                                          <a href="{{ route('bannerPerDelete',$bannerTrash->id) }}" class="btn-outline-danger">Permanent Delete</a>
                                      </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div><!-- bd -->
                        </div>
                        {{ $bannerTrashes->links() }}
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Add Banner</h6>
                    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- Title --}}
                        <div class="row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Title:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="Enter title">
                              @error('title')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                        {{-- Description --}}
                        <div class="row mt-4">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Descripton:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="description" id="description" value="{{ old("description") }}" class="form-control @error('description') is-invalid @enderror" placeholder="Enter description">
                              @error('description')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                        {{-- Banner Image --}}
                        <div class="row mt-4">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Banner Image:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])">
                              @error('image')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                              <img width="100px" id="image_id" />
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