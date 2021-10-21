@extends('Backend.master')
@section('title')
    {{ "Blog" }}
@endsection
@section('blog')
    active
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('dashboardPage') }}">Dashboard</a>
          <span class="breadcrumb-item active">Blog</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row">
            <div class="col-xl-12">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Blog({{ $blogCount }})</h6>
                    <div class="bd bd-gray-300 rounded table-responsive">
                      <table class="table mg-b-0">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>View</th>
                            <th>Category</th>
                            <th>Thumbnail</th>
                            <th>Featured</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $key => $blog)                                
                            <tr>
                              <td>{{ $blogs->firstItem()+$key }}</td>
                              <td>{{ Str::limit($blog->blog_title, '10') }}</td>
                              <td>{!! Str::limit($blog->description, '10') !!}</td>
                              <td>{{ $blog->views }}</td>
                              <td>{{ $blog->category->category_name }}</td>
                              <td>
                                  <img width="100px" src="{{ asset('Blog_Image/Thumbnail/'.$blog->thumbnail) }}" alt="{{ $blog->blog_title }}">
                              </td>
                              <td>
                                  <img width="100px" src="{{ asset('Blog_Image/Featured_Image/'.$blog->featured_image) }}" alt="{{ $blog->blog_title }}">
                              </td>
                              <td style="display: flex">
                                  <a href="{{ route('blog.edit',$blog->id) }}" class="btn btn-outline-info"><i class="fa fa-edit"></i></a>
                                  <form action="{{ route('blog.destroy',$blog->id) }}" method="POST">
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
                {{ $blogs->links() }}  
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
