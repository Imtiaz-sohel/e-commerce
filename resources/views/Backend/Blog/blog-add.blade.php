@extends('Backend.master')
@section('title')
    {{ "Blog" }}
@endsection
@section('header_css')
<link href="//cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>    
@endsection
@section('blog')
    active
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('blog.index') }}">Blog</a>
          <span class="breadcrumb-item active">Blog Add</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row">
            <div class="col-xl-12">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Add New Blog</h6>
                    <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span> Blog Title:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="blog_title" id="blog_title" value="{{ old('blog_title') }}" class="form-control @error('blog_title') is-invalid @enderror" placeholder="title">
                              @error('blog_title')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                        <div class="row mt-4">
                            <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span> Blog Description:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Description">{!! old('description') !!}</textarea>
                              @error('description')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span> Blog Category:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                    <option value>Select One</option>
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
                        <div class="row mt-4">
                            <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span> Blog Thumbnail:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="file" name="thumbnail" id="thumbnail" value="{{ old('thumbnail') }}" class="form-control @error('thumbnail') is-invalid @enderror" placeholder="description" onchange="document.getElementById('thumbnail_id').src = window.URL.createObjectURL(this.files[0])">
                              <img width="100px" id="thumbnail_id" />
                              @error('thumbnail')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span> Blog Featured Image:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="file" name="featured_image" id="featured_image" value="{{ old('featured_image') }}" class="form-control @error('featured_image') is-invalid @enderror" placeholder="description" onchange="document.getElementById('featured_id').src = window.URL.createObjectURL(this.files[0])">
                              <img width="100px" id="featured_id" />
                              @error('featured_image')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                        </div>
                        <div class="row mt-4">
                            <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span> Blog Keywords:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select id="keywords" class="form-control @error('keywords') is-invalid  @enderror" multiple data-role="tagsinput" name="keywords[]" placeholder="Tags"></select>
                              @error('keywords')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                        </div>
                          <div class="row mg-t-30 justify-content-center">
                            <div class="col-sm-8 text-center">
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
          <div>Attentively and carefully made by Imtiaz Sattar Sohel.</div>
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
<script src="//cdn.ckeditor.com/4.6.2/full/ckeditor.js"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
    filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
  };
</script>
<script>
    CKEDITOR.replace('description', options);
</script>
<script src="//cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script>
    $('#keywords').tagsinput('items').split(',');
</script>    
@endsection