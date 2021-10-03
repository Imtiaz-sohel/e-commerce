@extends('Backend.master')
@section('title')
    {{ 'Product Edit' }}
@endsection
@section('product')
    active
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('product.index') }}">Product</a>
          <span class="breadcrumb-item active">Product Edit</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="form-layout form-layout-5 bg-white">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Edit Product</h6>
            <form action="{{ route('product.update',$productEdit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- Product Name --}}
                <div class="row">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Title:</label>
                    <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                      <input type="text" name="product_title" id="product_title" value="{{ $productEdit->product_title ?? old('product_title') }}" class="form-control @error('product_title') is-invalid @enderror" placeholder="Enter Product Title">
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
                                <option @if ($productEdit->category_id==$category->id) selected @endif value="{{ $category->id }}">{{ $category->category_name }}</option>
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
                            @foreach($subcategories as $key => $subcategory)
                                <option @if ($productEdit->subcategory_id==$subcategory->id) selected @endif value="{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</option>
                            @endforeach
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
                                <option @if ($productEdit->brand_id==$brand->id) selected @endif value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                      @error('brand_id')
                          <div class="text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                {{-- Product Summary --}}
                <div class="row mg-t-30">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Summary:</label>
                    <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                      <input type="text" name="summary" id="summary" value="{{ $productEdit->summary ??old('summary') }}" class="form-control @error('summary') is-invalid @enderror" placeholder="Enter Summary">
                      @error('summary')
                          <div class="text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                {{-- Product Description --}}
                <div class="row mg-t-30">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Description:</label>
                    <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                      <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="my-editor" placeholder="Write Product Description">{{ $productEdit->description }}</textarea>
                      @error('description')
                          <div class="text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                {{-- PRODUCT ATTRIBUTE VARIATION(COLOR,SIZE,QUANTITY,PRICE) --}}
                @foreach($productEdit->productAttribute as $key => $attribute)                    
                    <div class="row mg-t-20">
                        <label class="col-sm-2 form-control-label">Product Attributes: <span class="tx-danger">*</span></label>
                        <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                            <div id="dynamic-field-1" class="form-group dynamic-field">
                                <div class="row">
                                    <input type="hidden" name="attribute_id[]" id="attribute_id" value="{{ $attribute->id }}">
                                    {{-- Product Color --}}
                                    <div class="col-3">
                                        <label for="color_id" class="font-weight-bold">Color</label>
                                        <select class="form-control @error('color_id') is-invalid @enderror"
                                            name="color_id[]" id="color_id">
                                            <option value>Select One</option>
                                            @foreach($colors as $key => $color)
                                                <option @if($attribute->color_id==$color->id) selected @endif value="{{ $color->id }}">{{ $color->color_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('color_id')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- Product Size --}}
                                    <div class="col-3">
                                        <label for="size_id" class="font-weight-bold">Size</label>
                                        <select class="form-control @error('size_id') is-invalid @enderror"
                                            name="size_id[]" id="size_id">
                                            <option value>Select One</option>
                                            @foreach($sizes as $key => $size)
                                            <option @if ($attribute->size_id==$size->id) selected @endif value="{{ $size->id }}">{{ $size->size_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- Product Quantity --}}
                                    <div class="col-3">
                                        <label for="quantity" class="font-weight-bold">Quantity</label>
                                        <input type="text"
                                            class="form-control @error('quantity') is-invalid @enderror"
                                            name="quantity[]" id="quantity" placeholder="10" value="{{ $attribute->quantity }}" />
                                        @error('quantity')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- Product Price --}}
                                    <div class="col-3">
                                        <label for="product_price" class="font-weight-bold">Product Price</label>
                                        <input type="text"
                                            class="form-control @error('product_price') is-invalid @enderror"
                                            name="product_price[]" id="product_price" placeholder="100" value="{{ $attribute->product_price }}" />
                                        @error('product_price')
                                            <div class="alert alert-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach              
                {{-- Thumbnail --}}
                <div class="row mg-t-30">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Thumbnail:</label>
                    <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                        <input class="form-control @error('thumbnail') is-invalid @enderror" type="file" name="thumbnail" id="thumbnail" onchange="document.getElementById('thumbnail_id').src = window.URL.createObjectURL(this.files[0])">
                        <img src="{{ asset('product/thumbnail/'.$productEdit->thumbnail) }}" width="100px" id="thumbnail_id" />
                      @error('thumbnail')
                          <div class="text-danger">
                              {{ $message }}
                          </div>
                      @enderror
                    </div>
                  </div>
                  <hr>
                {{-- Image Gallery --}}
                <div class="row mg-t-30">
                    <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Gallery:</label>
                    <div class="col-sm-5 mg-t-10 mg-sm-t-0">
                        @foreach($productEdit->productGallery as $key => $gallery)
                        <input type="hidden" name="pgallery[]" id="pgallery" value="{{ $gallery->id }}">                            
                            <input multiple class="form-control @error('image_name') is-invalid @enderror" type="file" name="image_name[]" id="image_name" onchange="document.getElementById('gallery_id{{ $gallery->id }}').src = window.URL.createObjectURL(this.files[0])">
                            <img src="{{ asset('product/gallery/'.$gallery->image_name) }}" width="100px" id="gallery_id{{ $gallery->id }}" />
                        @endforeach
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
                        <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" id="price" value="{{ $productEdit->price }}" placeholder="Minimun Price">
                      @error('price')
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
<script>
// ATTRIBUTE ADD REMOVE FIELD
var buttonAdd = $("#add-button");
var buttonRemove = $("#remove-button");
var className = ".dynamic-field";
var count = 0;
var field = "";
var maxFields = 5;

function totalFields() {
    return $(className).length;
}

function addNewField() {
    count = totalFields() + 1;
    field = $("#dynamic-field-1").clone();
    field.attr("id", "dynamic-field-" + count);
    field.children("label").text("Field " + count);
    field.find("input").val("");
    $(className + ":last").after($(field));
}

function removeLastField() {
    if (totalFields() > 1) {
        $(className + ":last").remove();
    }
}

function enableButtonRemove() {
    if (totalFields() === 2) {
        buttonRemove.removeAttr("disabled");
        buttonRemove.addClass("shadow-sm");
    }
}

function disableButtonRemove() {
    if (totalFields() === 1) {
        buttonRemove.attr("disabled", "disabled");
        buttonRemove.removeClass("shadow-sm");
    }
}

function disableButtonAdd() {
    if (totalFields() === maxFields) {
        buttonAdd.attr("disabled", "disabled");
        buttonAdd.removeClass("shadow-sm");
    }
}

function enableButtonAdd() {
    if (totalFields() === (maxFields - 1)) {
        buttonAdd.removeAttr("disabled");
        buttonAdd.addClass("shadow-sm");
    }
}

buttonAdd.click(function() {
    addNewField();
    enableButtonRemove();
    disableButtonAdd();
});

buttonRemove.click(function() {
    removeLastField();
    disableButtonRemove();
    enableButtonAdd();
});
</script>
{{-- Ck Editor --}}
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
        CKEDITOR.replace('my-editor', options);
</script>
@endsection