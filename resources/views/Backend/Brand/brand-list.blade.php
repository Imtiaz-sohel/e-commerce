@extends('Backend.master')
@section('title')
    {{ "Brand List" }}
@endsection
@section('brand')
    active
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{ route('brand.index') }}">Brand</a>
            <span class="breadcrumb-item active">Brand View & Create</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row">
            <div class="col-xl-6">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL BRAND ({{ $brandCount }})</h6>
                    <div class="bd bd-gray-300 rounded table-responsive">
                      <table class="table mg-b-0">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Brand Name</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $key => $brand)                                
                            <tr>
                              <td>{{ $brands->firstItem() + $key }}</td>
                              <td>{{ $brand->brand_name }}</td>
                              <td>
                                  @if($brand->status==1)
                                      <a class="btn btn-outline-success" href="{{ route('brandStatus',$brand->id) }}">Active</a>
                                  @else
                                       <a class="btn btn-outline-danger" href="{{ route('brandStatus',$brand->id) }}">Inactive</a>    
                                  @endif
                              </td>
                              <td>
                                  @if($brand->status==1)                                      
                                    <a href="{{ route('brand.edit',$brand->id) }}" class="btn btn-outline-success"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('brand.destroy',$brand->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button style="cursor: pointer" class="btn btn-outline-danger" type="submit"><i class="fa fa-trash"></i></button>
                                    </form>
                                  @else
                                  {{ "NOT ALLOWED" }}  
                                  @endif
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div><!-- bd -->
                </div>
                {{ $brands->links() }}
                <div class="row mt-5">
                    <div class="col-xl-12">
                        <div class="br-section-wrapper">
                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Trashed ({{ $trashCount }})</h6>
                            <div class="bd bd-gray-300 rounded table-responsive">
                              <table class="table mg-b-0">
                                <thead>
                                  <tr>
                                    <th>SL</th>
                                    <th>Brand Name</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($brandTrashes as $key => $brandTrash)     
                                    <tr>
                                      <td>{{ $brandTrashes->firstItem() + $key }}</td>
                                      <td>{{ $brandTrash->brand_name }}</td>
                                      <td>
                                          <a class="btn-outline-success" href="{{ route('brandRestore',$brandTrash->id) }}">Restore</a>
                                          <a class="btn-outline-danger" href="{{ route('brandPermanent',$brandTrash->id) }}">Permanent Delete</a>
                                      </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div>
                        </div>
                        {{ $brandTrashes->links() }}
                    </div>
                </div>
              </div>
            <div class="col-xl-6">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Add BRAND</h6>
                    <form action="{{ route('brand.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Brand Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="brand_name" id="brand_name" value="{{ old('brand_name') }}" class="form-control @error('brand_name') is-invalid @enderror" placeholder="Enter bradname">
                              @error('brand_name')
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