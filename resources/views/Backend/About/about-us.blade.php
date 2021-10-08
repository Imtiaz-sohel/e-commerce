@extends('Backend.master')
@section('title')
    {{ 'About-Us' }}
@endsection
@section('about')
    active
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('about.index') }}">About Us</a>
          <span class="breadcrumb-item active">About View & Add</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row">
            <div class="col-xl-6">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">About Us ({{ $aboutCount }})</h6>
                    <div class="bd bd-gray-300 rounded table-responsive">
                      <table class="table mg-b-0">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>About Us</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($abouts as $key => $about)                                
                            <tr>
                              <td>{{ $abouts->firstItem()+$key }}</td>
                              <td>{!! Str::limit($about->about,'100') !!}</td>
                              <td>
                                  <a href="{{ route('about.edit',$about->id) }}" class="btn btn-outline-success"><i class="fa fa-edit"></i></a>
                                  <form action="{{ route('about.destroy',$about) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                                  </form>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
                {{ $abouts->links() }}
                <div class="row mt-3">
                    <div class="col-xl-12">
                        <div class="br-section-wrapper">
                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">About Trashed ({{ $aboutTrashCount }})</h6>
                            <div class="bd bd-gray-300 rounded table-responsive">
                              <table class="table mg-b-0">
                                <thead>
                                  <tr>
                                    <th>SL</th>
                                    <th>About Us</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($aboutTrashes as $key => $aboutTrash)
                                    <tr>
                                      <td>{{ $aboutTrashes->firstItem() + $key }}</td>
                                      <td>{!! Str::limit($aboutTrash->about,'100') !!}</td>
                                      <td>
                                          <a href="{{ route('aboutRestore',$aboutTrash->id) }}" class="btn-outline-success">Restore</a>
                                          <a href="{{ route('aboutPerDelete',$aboutTrash->id) }}" class="btn-outline-danger">Permanent Delete</a>
                                      </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div>
                        </div>
                        {{ $aboutTrashes->links() }}
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Add About Us</h6>
                    <form action="{{ route('about.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> About Us:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <textarea name="about" id="about" class="form-control @error('about') is-invalid @enderror" placeholder="About To Honey"></textarea>
                              @error('about')
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
@section('footer_js')
 {{-- file manager --}}
 <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
 <script>
    var options = {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
    };
    CKEDITOR.replace('about', options);
  </script> 
@endsection