@extends('Backend.master')
@section('title')
    {{ "Featured Product List" }}
@endsection
@section('featuredProduct')
    active
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('featuredProduct.index') }}">Featured Product</a>
          <span class="breadcrumb-item active">Featured Product View & Add</span>
        </nav>
    </div>
    <div class="br-pagebody">
       <div class="row">
           <div class="col-7">
             <div class="br-section-wrapper">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Featured Product ({{ $FeaturedProductCount }})</h6>
                <div class="bd bd-gray-300 rounded table-responsive">
                  <table class="table mg-b-0">
                    <thead>
                      <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Thumbnail</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($FeaturedProducts as $key => $FeaturedProduct)                            
                        <tr>
                          <td>{{ $FeaturedProducts->firstItem() + $key }}</td>
                          <td>{{ $FeaturedProduct->product_title }}</td>
                          <td>
                              <img width="100px" src="{{ asset('Featured_Image/'.$FeaturedProduct->product_image) }}" alt="{{ $FeaturedProduct->product_title }}">
                          </td>
                          <td>
                              <a class="btn btn-outline-info" href="{{ route('featuredProduct.edit',$FeaturedProduct->id) }}"><i class="fa fa-edit"></i></a>
                              <form action="{{ route('featuredProduct.destroy',$FeaturedProduct->id) }}" method="POST">
                                  @csrf
                                    <button class="btn btn-outline-danger" type="submit"><i class="fa fa-trash"></i></button>
                                  @method('DELETE')
                              </form>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div><!-- bd -->
             </div>
             {{ $FeaturedProducts->links() }}
             {{-- Featured Product Trash --}}
             <div class="row mt-5">
                 <div class="col-xl-12">
                    <div class="br-section-wrapper">
                        <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Trash ()</h6>
                        <div class="bd bd-gray-300 rounded table-responsive">
                          <table class="table mg-b-0">
                            <thead>
                              <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Thumbnail</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($featureTrashes as $key => $featureTrash)                                    
                                <tr>
                                  <td>{{ $featureTrashes->firstItem() + $key }}</td>
                                  <td>{{ $featureTrash->product_title }}</td>
                                  <td>
                                      <img width="100px" src="{{ asset('Featured_Image/'.$featureTrash->product_image) }}" alt="">
                                  </td>
                                  <td>
                                      <a href="{{ route('featuredRestore',$featureTrash->id) }}" class="btn-outline-success">Restore</a>
                                      <a href="{{ route('featuredPerDelete',$featureTrash->id) }}" class="btn-outline-danger">Permanent Delete</a>
                                  </td>
                                </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div><!-- bd -->
                    </div>
                 </div>
             </div>
           </div>
           <div class="col-5">
             <div class="form-layout form-layout-5 bg-white">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Add Featured Product</h6>
                <form action="{{ route('featuredProduct.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- Product Name --}}
                    <div class="row">
                        <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Product Name:</label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                          <input type="text" name="product_title" id="product_title" value="{{ old('product_title') }}" class="form-control @error('product_title') is-invalid @enderror" placeholder="Enter Title">
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
                          <img width="100px" id="product_image">
                          @error('product_image')
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