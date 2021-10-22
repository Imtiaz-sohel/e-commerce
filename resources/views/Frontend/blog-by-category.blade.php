@extends('Frontend.master')
@section('ftitle')
    {{ "Blog" }}
@endsection
@section('blog')
    active
@endsection
@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Blog Page</h2>
                    <ul>
                        <li><a href="{{ route('frontPage') }}">Home</a></li>
                        <li><span>Blog</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area ends -->
<!-- blog-area start -->
<div class="blog-area">
    <div class="container">
        <div class="col-lg-12">
            <div class="section-title  text-center">
                <h2>{{ $blogs[0]->category->category_name }}</h2>
                <img src="{{ asset('frontend/assets/images/section-title.png') }}" alt="">
            </div>
        </div>
        <div class="row">
            @foreach($blogs as $key => $blog)                
            <div class="col-lg-4  col-md-6 col-12">
                <div class="blog-wrap">
                    <div class="blog-image">
                        <img src="{{ asset('Blog_Image/Thumbnail/'.$blog->thumbnail) }}" alt="{{ $blog->thumbnail }}">
                        <ul>
                            <li>{{ $blog->created_at->format('d') }}</li>
                            <li>{{ $blog->created_at->format('M') }}</li>
                        </ul>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <ul>
                                <li><i class="fa fa-user"></i> {{ $blog->user->name }}</li>
                                <li class="pull-right"><i class="fa fa-clock-o"></i> {{ $blog->created_at->format('d/m/Y') }}</li>
                            </ul>
                        </div>
                        <h3><a href="{{ route('singleBlog',$blog->slug) }}">{{ Str::limit($blog->blog_title,'55') }}</a></h3>
                        <p>{!! Str::limit($blog->description,'195') !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <!-- Pagination part start -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                @if($blogs->onFirstPage())                    
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1"><i class="fa fa-arrow-left"></i></a>
                </li>
                @else
                <li class="page-item">
                   <a class="page-link" href="{{ $blogs->previousPageUrl() }}" tabindex="-1"><i class="fa fa-arrow-left"></i></a>
                </li> 
                @endif
              @for($i = 1; $i < $blogs->lastPage(); $i++)
                <li class="page-item"><a class="page-link {{ $blogs->currentPage()==$i?'active_2':"" }}" href="{{ $blogs->url($i) }}">{{ $i }}</a></li>
              @endfor
              @if($blogs->hasMorePages())                  
              <li class="page-item">
                <a class="page-link" href="{{ $blogs->nextPageUrl() }}"><i class="fa fa-arrow-right"></i></a>
              </li>
              @else
              <li class="page-item disabled">
                <a class="page-link" href="{{ $blogs->nextPageUrl() }}"><i class="fa fa-arrow-right"></i></a>
              </li> 
              @endif
            </ul>
          </nav>
        <!-- Pagination part ends -->
    </div>
</div> 
<!-- blog-area ends --> 
@endsection