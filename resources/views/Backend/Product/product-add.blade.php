@extends('Backend.master')
@section('title')
    {{ 'Product Add' }}
@endsection
@section('product')
    active
@endsection
@section('addActive')
     active
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('product.index') }}">Product</a>
          <span class="breadcrumb-item active">Product Add</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="form-layout form-layout-5 bg-white">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Add Product</h6>
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- Product Name --}}
                <div class="row">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Title:</label>
                    <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                      <input type="text" name="product_title" id="product_title" value="{{ old('product_title') }}" class="form-control @error('product_title') is-invalid @enderror" placeholder="Enter firstname">
                      @error('product_title')
                          <div class="text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                {{-- Select Category --}}
                <div class="row mg-t-30">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Category:</label>
                    <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            <option value>Select Catgory</option>
                            @foreach($categories as $key => $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                      @error('category_id')
                          <div class="text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                {{-- Select Sub Category --}}
                <div class="row mg-t-30">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Sub Category:</label>
                    <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                        <select name="subcategory_id" id="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror">
                            <option value>Select Sub-Catgory</option>
                        </select>
                      @error('subcategory_id')
                          <div class="text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                {{-- Select Brand --}}
                <div class="row mg-t-30">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Select Brand :</label>
                    <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                        <select name="brand_id" id="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                            <option value>Select Brand</option>
                            @foreach($brands as $key => $brand)
                                <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                      @error('brand_id')
                          <div class="text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                {{-- Product Name --}}
                <div class="row mg-t-30">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Summary:</label>
                    <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                      <input type="text" name="summary" id="summary" value="{{ old('summary') }}" class="form-control @error('summary') is-invalid @enderror" placeholder="Enter Summary">
                      @error('summary')
                          <div class="text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                {{-- Description --}}
                <div class="row mg-t-30">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Description:</label>
                    <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Write Product Description"></textarea>
                      @error('description')
                          <div class="text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                {{-- Thumbnail --}}
                <div class="row mg-t-30">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Thumbnail:</label>
                    <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                        <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" name="thumbnail" id="thumbnail" onchange="document.getElementById('thumbnail_id').src = window.URL.createObjectURL(this.files[0])">
                        <img width="100px" id="thumbnail_id" />
                      @error('thumbnail')
                          <div class="text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                {{-- Image Gallery --}}
                <div class="row mg-t-30">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Gallery:</label>
                    <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                        <input multiple class="form-control @error('image_name') is-invalid @enderror" type="file" name="image_name[]" id="image_name">
                      @error('image_name')
                          <div class="text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                  <div id="image_preview"></div>
                {{-- Default Price --}}
                <div class="row mg-t-30">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Minimum Price:</label>
                    <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                        <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" id="price" placeholder="Minimun Price">
                      @error('thumbnail')
                          <div class="text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                  <div class="row mg-t-30">
                    <div class="col-sm-8 mg-l-auto">
                      <div class="form-layout-footer">
                        <button style="cursor: pointer" type="submit" class="btn btn-info">Submit</button>
                      </div>
                    </div>
                </div>
            </form>
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
@section('footer_js')
<script>
    // get subcategory after select category
$('#category_id').change(function() {
    var category_id = $(this).val();
    if (category_id) {
        $.ajax({
            type: "GET",
            url: "{{ url('api/get-sub-category-list') }}/" + category_id,
            success: function(res) {
                if (res) {
                    $("#subcategory_id").empty();
                    $("#subcategory_id").append('<option>Select One</option>');
                    $.each(res, function(key, value) {
                        $("#subcategory_id").append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');
                    });

                } else {
                    $("#subcategory_id").empty();
                }
            }
        });
    } else {
        $("#subcategory_id").empty();
    }
});
</script>
@endsection