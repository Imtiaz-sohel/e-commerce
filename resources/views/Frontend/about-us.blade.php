@extends('Frontend.master')
@section('about')
    active
@endsection
@section('header_css')
<style>
    .star-ratings-sprite {
      background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
      font-size: 0;
      height: 21px;
      line-height: 0;
      overflow: hidden;
      text-indent: -999em;
      width: 110px;
      margin: 0 auto;
    }
    .star-ratings-sprite-rating {
      background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/2605/star-rating-sprite.png") repeat-x;
      background-position: 0 100%;
      float: left;
      height: 21px;
      display: block;
    }
</style>    
@endsection
@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="breadcumb-wrap text-center">
                <h2>About us</h2>
                <ul>
                    <li><a href="{{ route('frontPage') }}">Home</a></li>
                    <li><span>About</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>
<!-- .breadcumb-area end -->
<!-- about-area start -->
<div class="about-area ptb-100">
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="about-wrap text-center">
                <h3>Welcome Our Store! </h3>
                <p>{!! $aboutUs->about !!}</p>
            </div>
        </div>
    </div>
</div>
</div>
<!-- about-area end -->
<!-- product-area start -->
<div class="product-area product-area-2">
    <div class="container">
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
                        <img src="{{ asset('product/thumbnail/'.$bestSelling->product->thumbnail) }}" alt="{{ $bestSelling->product->product_title }}">
                        <div class="product-icon flex-style">
                            <ul>
                                <li><a data-toggle="modal" data-target="#exampleModalCenter{{ $bestSelling->product->id }}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                <li><a href="{{ route('addTowishlist',$bestSelling->product->id) }}"><i class="fa fa-heart"></i></a></li>
                                <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3><a href="single-product.html">{{ $bestSelling->product->product_title }}</a></h3>
                        <p class="pull-left">${{ $bestSelling->product->price }} </p>
                        <div class="star-ratings-sprite rating">
                            <span style="width:@if($bestSelling->product->review->count()>0) {{ $bestSelling->product->review->sum('ratting')/$bestSelling->product->review->count()*20 }}% @endif" class="star-ratings-sprite-rating"></span>
                        </div>
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
                                <img src="{{ asset('product/thumbnail/'.$bestSelling->product->thumbnail) }}" alt="">
                            </div>
                            <div class="product-single-content w-50">
                                <h3>{{ $bestSelling->product->product_title }}</h3>
                                <div class="rating-wrap fix">
                                    <span class="pull-left">${{ $bestSelling->product->price }}</span>
                                    <ul class="rating pull-right">
                                        <li>
                                            <div class="star-ratings-sprite rating">
                                                <span style="width:@if($bestSelling->product->review->count()>0) {{ $bestSelling->product->review->sum('ratting')/$bestSelling->product->review->count()*20 }}% @endif" class="star-ratings-sprite-rating"></span>
                                            </div>  
                                        </li>
                                        <li>({{ $bestSelling->product->review->count() }} Customer Reviewed)</li>
                                    </ul>
                                </div>
                                <p>{{ $bestSelling->product->summary }}</p>
                                <ul class="cetagory">
                                    <li>Categories:</li>
                                    <li><a href="#">{{ $bestSelling->product->category->category_name }}</a></li>
                                </ul>
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
            <!-- Modal area start -->
            @endforeach
        </ul>
    </div>
</div>
<!-- product-area end -->    
@endsection
