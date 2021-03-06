@extends('Frontend.master')
@section('home')
    active
@endsection
@section('header_css')
<style>
    .star-ratings-sprite {
      background: url("//s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
      font-size: 0;
      height: 21px;
      line-height: 0;
      overflow: hidden;
      text-indent: -999em;
      width: 110px;
      margin: 0 auto;
    }
    .star-ratings-sprite-rating {
      background: url("//s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
      background-position: 0 100%;
      float: left;
      height: 21px;
      display: block;
    }
</style>    
@endsection
@section('content')
    <!-- slider-area start -->
    <div class="slider-area">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach($banners as $key => $banner)
                <div class="swiper-slide overlay">                 
                    <div class="single-slider slide-inner" style="background: url('{{ asset('banner/'.$banner->image)}}')">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">{{ $banner->title }}</h2>
                                            <p data-swiper-parallax="-400">{{ $banner->description }}</p>
                                            <a href="{{ route('shopPage') }}" data-swiper-parallax="-300">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <!-- slider-area end -->
    <!-- featured-area start -->
    <div class="featured-area featured-area2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="featured-active2 owl-carousel next-prev-style">
                        @foreach($fProducts as $key => $fProduct)                            
                            <div class="featured-wrap">
                                <div class="featured-img">
                                    <img src="{{ asset('Featured_Image/'.$fProduct->product_image) }}" alt="{{ $fProduct->product_title }}">
                                    <div class="featured-content">
                                        <a href="#">{{ $fProduct->product_title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- featured-area end -->
    <!-- start count-down-section -->
    <div class="count-down-area count-down-area-sub">
        <section class="count-down-section section-padding parallax" data-speed="7">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12 text-center">
                        <h2 class="big">Deal Of the Day <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</span></h2>
                    </div>
                    <div class="col-12 col-lg-12 text-center">
                        <div class="count-down-clock text-center">
                            <div id="clock">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
    </div>
    <!-- end count-down-section -->
    <!-- product-area start -->
    <div class="product-area product-area-2">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Best Seller</h2>
                        <img src="{{ asset('frontend/assets/images/section-title.png') }}" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">
                @foreach($bestSellings as $key => $bestSelling)                    
                <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <div class="product-wrap">
                        <div class="product-img">
                            <img src="{{ asset('product/thumbnail/'.$bestSelling->product->thumbnail) }}" alt="">
                            <div class="product-icon flex-style">
                                <ul>
                                    <li><a data-toggle="modal" data-target="#exampleModalCenter{{ $bestSelling->product->id }}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="{{ route('addTowishlist',$bestSelling->product->id) }}"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="{{ route('singleProduct',$bestSelling->product->slug) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{ route('singleProduct',$bestSelling->product->slug) }}">{{ $bestSelling->product->product_title }}</a></h3>
                            <p class="pull-left">${{ $bestSelling->product->price }}</p>
                            <ul class="pull-right d-flex">
                                <div class="star-ratings-sprite rating">
                                    <span style="width:@if($bestSelling->product->review->count()>0){{ $bestSelling->product->review->sum('ratting')/$bestSelling->product->review->count()*20 }}% @endif" class="star-ratings-sprite-rating"></span>
                                </div>
                            </ul>
                        </div>
                    </div>
                </li>
                <!-- Modal area start -->
                <div class="modal fade" id="exampleModalCenter{{ $bestSelling->product->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-body d-flex">
                                <div class="product-single-img w-50">
                                    <img src="{{ asset('product/thumbnail/'.$bestSelling->product->thumbnail) }}" alt="{{ $bestSelling->product->product_title }}">
                                </div>
                                <div class="product-single-content w-50">
                                    <h3>{{ $bestSelling->product->product_title }}</h3>
                                    <div class="rating-wrap fix">
                                        <span class="pull-left">${{ $bestSelling->product->price }}</span>
                                        <ul class="rating pull-right">
                                            <div class="star-ratings-sprite rating">
                                                <span style="width:@if($bestSelling->product->review->count()>0) {{ $bestSelling->product->review->sum('ratting')/$bestSelling->product->review->count()*20 }}% @endif" class="star-ratings-sprite-rating"></span>
                                              </div>
                                            <li>({{ $bestSelling->product->review->count() }} Customer Reviewed)</li>
                                        </ul>
                                    </div>
                                    <p>{{ $bestSelling->product->summary }}</p>
                                    <ul class="socil-icon">
                                        <li>Share :</li>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal area ends -->
                @endforeach
            </ul>
        </div>
    </div>
    <!-- product-area end -->
    <!-- product-area start -->
    <div class="product-area">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Our Latest Product</h2>
                        <img src="{{ asset('frontend/assets/images/section-title.png') }}" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">
                @foreach($products as $key => $product)                    
                <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <div class="product-wrap">
                        <div class="product-img">
                            <span>Sale</span>
                            <img src="{{ asset('product/thumbnail/'.$product->thumbnail) }}" alt="{{ $product->product_title }}">
                            <div class="product-icon flex-style">
                                <ul>
                                    <li><a data-toggle="modal" data-target="#exampleModalCenter{{ $product->id }}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="{{ route('addTowishlist',$product->id) }}"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="{{ route('singleProduct',$product->slug) }}"><i class="fa fa-shopping-bag"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{ route('singleProduct',$product->slug) }}">{{ $product->product_title }}</a></h3>
                            <p class="pull-left">${{ $product->price }}</p>
                            <ul class="pull-right d-flex">
                                <div class="star-ratings-sprite rating">
                                    <span style="width:@if($product->review->count()>0){{ $product->review->sum('ratting')/$product->review->count()*20 }}% @endif" class="star-ratings-sprite-rating"></span>
                                </div>
                            </ul>
                        </div>
                    </div>
                </li>
                <!-- Modal area start -->
                <div class="modal fade" id="exampleModalCenter{{ $product->id }}" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-body d-flex">
                                <div class="product-single-img w-50">
                                    <img src="{{ asset('product/thumbnail/'.$product->thumbnail) }}" alt="{{ $product->product_title }}">
                                </div>
                                <div class="product-single-content w-50">
                                    <h3>{{ $product->product_title }}</h3>
                                    <div class="rating-wrap fix">
                                        <span class="pull-left">${{ $product->price }}</span>
                                        <ul class="rating pull-right">
                                            <div class="star-ratings-sprite rating">
                                                <span style="width: @if($product->review->count()>0) {{ $product->review->sum('ratting')/$product->review->count()*20 }}% @endif" class="star-ratings-sprite-rating"></span>
                                            </div>
                                            <li>({{ $product->review->sum('ratting') }} Customar Review)</li>
                                        </ul>
                                    </div>
                                    <p>{{ $product->summary }}</p>
                                    <ul class="socil-icon">
                                        <li>Share :</li>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal area ends -->
                @endforeach
            </ul>
        </div>
    </div>
    <!-- product-area end -->
    <!-- testmonial-area start -->
    <div class="testmonial-area testmonial-area2 bg-img-2 black-opacity" style="margin-bottom: -48px">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="test-title text-center">
                        <h2>What Our client Says</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 col-12">
                    <div class="testmonial-active owl-carousel">
                        @foreach($testimonials as $key => $testimonial)                            
                        <div class="test-items test-items2">
                            <div class="test-content">
                                <p>{{ $testimonial->message }}</p>
                                <h2>{{ $testimonial->c_name }}</h2>
                                <p>{{ $testimonial->c_position }}</p>
                            </div>
                            <div class="test-img2">
                                <img src="{{ asset('testimonial/'.$testimonial->c_image) }}" alt="">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testmonial-area end -->
@endsection