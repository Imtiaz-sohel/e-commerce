@extends('Frontend.master')
@section('ftitle')
    {{ "Blog Details" }}
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
                    <h2>Blog Details</h2>
                    <ul>
                        <li><a href="{{ route('blogView') }}">Blog</a></li>
                        <li><span>Blog Details</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- blog-details-area start-->
<div class="blog-details-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="blog-details-wrap">
                    <img src="{{ asset('Blog_Image/Featured_Image/'.$blog->featured_image) }}" alt="{{ $blog->blog_title }}">
                    <h3>{{ $blog->blog_title }}</h3>
                    <ul class="meta">
                        <li>{{ $blog->created_at->format('d M Y') }}</li>
                        <li>By {{ $blog->user->name }}</li>
                    </ul>
                    <p>{!! $blog->description !!}</p>
                    <div class="tag" style="display: flex">
                        <h6>Tags : </h6>
                        @foreach($blog->keyword as $key => $value)
                          <p>{{ $value->keywords }} {{ ',' }}</p>
                        @endforeach
                    </div>
                    <div class="share-wrap">
                        <div class="row">
                            <div class="col-sm-7 ">
                                <ul class="socil-icon d-flex">
                                    <li>share it on :</li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment-form-area">
                    <div class="comment-main">
                        <h3 class="blog-title"><span>({{ $blogCommentCount }})</span>Comments:</h3>
                        <ol class="comments">
                            @foreach($blogComments as $key => $blogComment)                                
                            <li class="comment even thread-even depth-1">
                                <div class="comment-wrap">
                                    <div class="comment-main-area">
                                        <div class="comment-wrapper">
                                            <div class="sewl-comments-meta">
                                                <h4>{{ $blogComment->name }}</h4>
                                                <span>{{ $blogComment->created_at->format('d M Y') }} at {{ $blogComment->created_at->format('H:m') }}</span>
                                            </div>
                                            <div class="comment-area">
                                                <p>{{ $blogComment->message }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ol>
                    </div>
                    <div id="respond" class="sewl-comment-form comment-respond form-style">
                        <h3 id="reply-title" class="blog-title">Leave a <span>comment</span></h3>
                        <form method="POST" id="commentform" class="comment-form" action="{{ route('blogComment') }}"> @csrf
                            <div class="row">
                                <div class="col-12">
                                    <input type="hidden" name="blog_id" id="blog_id" value="{{ $blog->id }}">
                                    <div class="sewl-form-inputs no-padding-left">
                                        <div class="row">
                                            <div class="col-sm-6 col-12">
                                                <input id="name" name="name" value="{{ old('name') }}" tabindex="2" placeholder="Name" type="text" @error('name') is-valid @enderror>
                                                @error('name')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <input id="email" name="email" value="{{ old('email') }}" tabindex="3" placeholder="Email" type="email" @error('email') is-valid @enderror>
                                                @error('email')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="sewl-form-textarea no-padding-right">
                                        <textarea id="comment" name="message" tabindex="4" rows="3" cols="30" placeholder="Write Your Comments..." @error('message') is-invalid @enderror></textarea>
                                        @error('message')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-submit">
                                        <input id="submit" type="submit">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <aside class="sidebar-area">
                    <div class="widget widget_categories">
                        <h4 class="widget-title">Categories</h4>
                        <ul>
                            @foreach($categories as $key => $category)
                              <li><a href=" @if($category->blog->count()>0) {{ route('blogByCategory',$category->id) }} @endif">{{ $category->category_name }} ({{ $category->blog->count() }})</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget widget_recent_entries recent_post">
                        <h4 class="widget-title">Recent Post</h4>
                        <ul>
                            @foreach($lBlogs as $key => $lBlog)                                
                            <li>
                                <div class="post-img">
                                    <img width="100px" src="{{ asset('Blog_Image/Thumbnail/'.$lBlog->thumbnail) }}" alt="{{ $lBlog->blog_title }}">
                                </div>
                                <div class="post-content">
                                    <a href="{{ route('singleBlog',$lBlog->slug) }}">{{ $lBlog->blog_title }}</a>
                                    <p>{{ $lBlog->created_at->format('d M Y') }}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<!-- blog-details-area end -->
@endsection
