@extends('Frontend.master')
@section('ftitle')
    {{ $sProduct->product_title }}
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
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shop Page</h2>
                    <ul>
                        <li><a href="{{ route('frontPage') }}">Home</a></li>
                        <li><span>Shop</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- single-product-area start-->
<div class="single-product-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="product-single-img">
                    <div class="product-active owl-carousel">
                        <div class="item">
                            <img src="{{ asset('product/thumbnail/'.$sProduct->thumbnail) }}" alt="{{ $sProduct->product_title }}">
                        </div>
                        @foreach($pGalleries as $key => $pGallery)                            
                        <div class="item">
                            <img src="{{ asset('product/gallery/'.$pGallery->image_name) }}" alt="{{ $pGallery->id }}">
                        </div>
                        @endforeach
                    </div>
                    <div class="product-thumbnil-active  owl-carousel">
                        <div class="item">
                            <img src="{{ asset('product/thumbnail/'.$sProduct->thumbnail) }}" alt="{{ $sProduct->product_title }}">
                        </div>
                        @foreach($pGalleries as $key => $pGallery)                            
                        <div class="item">
                            <img src="{{ asset('product/gallery/'.$pGallery->image_name) }}" alt="{{ $pGallery->id }}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-single-content">
                    <form action="{{ route('productCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" id="product_id" value="{{ $sProduct->id }}">
                        <h3>{{ $sProduct->product_title }} <span style="font-weight: 400; font-size:15px;">({{ $allReviews->count() }} Customer Review)</span> </h3>
                        <div class="rating-wrap fix">
                            <span class="pull-left price">${{ $sProduct->price }}</span>
                            <div class="star-ratings-sprite rating">
                                <span style="width:@if($allReviews->count()>0) {{ $allReviews->sum('ratting')/$allReviews->count()*20 }}% @endif" class="star-ratings-sprite-rating"></span>
                            </div>
                        </div>
                        <p>{{ $sProduct->summary }}</p>
                        <ul class="input-style">
                            <li class="quantity cart-plus-minus">
                                <input name="quantity" id="quantity" type="text" value="1" />
                                <div class="dec qtybutton">-</div>
                                <div class="inc qtybutton">+</div>
                            </li>
                            <li>
                                <button class="cart_button" type="submit">Add To Cart</button>
                            </li>
                        </ul>
                        <ul class="cetagory">
                            <li>Categories:</li>
                            {{ $sProduct->category->category_name }}
                        </ul>
                        <ul class="cetagory">
                              <li>Color:</li>
                              @foreach($groupByColors as $key => $groupByColor)
                                <li>
                                    <label for="color_id{{ $groupByColor[0]->id }}">{{ $groupByColor[0]->color->color_name }}</label>
                                    <input data-product={{ $groupByColor[0]->product_id }} class="color" type="radio" name="color_id" id="color_id{{ $groupByColor[0]->id }}" value="{{ $groupByColor[0]->color_id }}" @error('color_id') is-invalid @enderror>
                                </li>
                              @endforeach
                          @error('color_id')
                              <div class="text-danger">
                                  {{ $message }}
                              </div>
                          @enderror 
                        </ul>
                        <ul class="cetagory">
                            <li>Size:</li>
                            <li class="size_view" @error('size_id') is-invalid @enderror>
                                {{--  --}}
                            </li>
                            @error('size_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror 
                        </ul>
                        <ul class="cetagory">
                            <li>Available Quantity:</li>
                            <li class="qty">
                                {{ $sProduct->productAttribute->sum('quantity') }}
                            </li>
                        </ul>
                        <ul class="socil-icon">
                            <li>Share :</li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                      </form>
                  </div>
              </div>
          </div>
        <div class="row mt-60">
            <div class="col-12">
                <div class="single-product-menu">
                    <ul class="nav">
                        <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                        <li><a data-toggle="tab" href="#tag">Faq</a></li>
                        <li><a data-toggle="tab" href="#review">Review</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="tab-content">
                    <div class="tab-pane active" id="description">
                        <div class="description-wrap">
                            <p>{!! $sProduct->description !!}</p>
                        </div>
                    </div>
                    <div class="tab-pane" id="tag">
                        <div class="faq-wrap" id="accordion">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5><button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">General Inquiries ?</button> </h5>
                                </div>
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How To Use ?</button></h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Shipping & Delivery ?</button></h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingfour">
                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">Additional Information ?</button></h5>
                                </div>
                                <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="headingfive">
                                    <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">Return Policy ?</button></h5>
                                </div>
                                <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="review">
                        <div class="review-wrap">
                            <ul>
                                @foreach($allReviews as $key => $allReview)                                    
                                <li class="review-items">
                                    <div class="review-content">
                                        <h3>{{ $allReview->name }}</h3>
                                        <span>{{ $allReview->created_at->format('d M,Y') }}</span>
                                        <p>{{ $allReview->message }}</p>
                                        <div class="star-ratings-sprite rating">
                                            <span style="width:{{ $allReview->ratting*20 }}%" class="star-ratings-sprite-rating"></span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @php
                            $order=App\Models\Order::where('product_id',$sProduct->id)->where('user_id',Auth::id())->count();
                        @endphp
                        <div class="add-review">
                            <h4>Add A Review</h4>
                            @auth
                              @if($review>0)
                                 <h6>Already Reviewed</h6>
                              @else
                              @if($order>0)
                              <form action="{{ route('ReviewPost') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" id="product_id" value="{{ $sProduct->id }}">
                                <div class="ratting-wrap">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>task</th>
                                                <th>1 Star</th>
                                                <th>2 Star</th>
                                                <th>3 Star</th>
                                                <th>4 Star</th>
                                                <th>5 Star</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>How Many Stars?</td>
                                                @error('ratting')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                                <td>
                                                    <input type="radio" value="1" name="ratting" />
                                                </td>
                                                <td>
                                                    <input type="radio" value="2" name="ratting" />
                                                </td>
                                                <td>
                                                    <input type="radio" value="3" name="ratting" />
                                                </td>
                                                <td>
                                                    <input type="radio" value="4" name="ratting" />
                                                </td>
                                                <td>
                                                    <input type="radio" value="5" name="ratting" />
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <h4>Name:</h4>
                                        <input type="text" name="name" value="{{ Auth::user()->name }}" placeholder="Your name here..." />
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <h4>Email:</h4>
                                        <input type="email" name="email" value="{{ Auth::user()->email }}" placeholder="Your Email here..." />
                                    </div>
                                    <div class="col-12">
                                        <h4>Your Review:</h4>
                                        <textarea name="message" id="massage" cols="30" rows="10" placeholder="Your review here..." @error('message') is-invalid @enderror></textarea>
                                        @error('message')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn-style">Submit</button>
                                    </div>
                                </div>
                              </form>  
                              @endif 
                              @endif
                            @else
                             <h6>Please Login To Review</h6>    
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- single-product-area end-->
<!-- featured-product-area start -->
<div class="featured-product-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-left">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($rProducts as $key => $rProduct)                
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="featured-product-wrap">
                    <div class="featured-product-img">
                        <img src="{{ asset('product/thumbnail/'.$rProduct->thumbnail) }}" alt="{{ $rProduct->product_title }}">
                    </div>
                    <div class="featured-product-content">
                        <div class="row">
                            <div class="col-7">
                                <h3><a href="{{ route('singleProduct',$rProduct->slug) }}">{{ $rProduct->product_title }}</a></h3>
                                <p>${{ $rProduct->price }}</p>
                            </div>
                            <div class="col-5 text-right">
                                <ul>
                                    <li><a href="{{ route('singleProduct',$rProduct->slug) }}"><i class="fa fa-shopping-cart"></i></a></li>
                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
            @endforeach
        </div>
    </div>
</div>
<!-- featured-product-area end -->   
@endsection
@section('footer_js')
<script>
    $('.color').change(function(){
       let colorId = $(this).val();
       let productId = $(this).attr('data-product');
       $.ajax({
           type:"GET",
           url:"{{ url('get-product-size') }}/"+colorId+'/'+productId,
           success:function(res){
               if (res) {
                   $('.size_view').html(res);
                   $('.size_check').change(function(){
                       let productQuantity=$(this).attr('data-quantity');
                       let productPrice=$(this).attr('data-price');
                       $('.price').html('$'+productPrice);
                       $('.qty').html(productQuantity);
                   });
               }
           }
       });
    })
</script>
{{-- Quantity Button --}}
<script>
    $(".qtybutton").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.text() == "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);
    });    
</script>    
@endsection