<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('ftitle','To Honey') | Online Honey Store</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend/assets/images/favicon.png') }}">
    <!-- Place favicon.ico in the root directory -->
    <!-- all css here -->
    <!-- bootstrap v4.0.0-beta.2 css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.min.css') }}">
    <!-- font-awesome v4.6.3 css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.min.css') }}">
    <!-- flaticon.css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/flaticon.css') }}">
    <!-- jquery-ui.css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery-ui.css') }}">
    <!-- metisMenu.min.css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/metisMenu.min.css') }}">
    <!-- swiper.min.css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/swiper.min.css') }}">
    <!-- Toaster css -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    @yield('header_css')
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/styles.css') }}">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    {{-- <!--Start Preloader-->
    <div class="preloader-wrap">
        <div class="spinner"></div>
    </div> --}}
    <!-- search-form here -->
    <div class="search-area flex-style">
        <span class="closebar">Close</span>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 col-12">
                    <div class="search-form">
                        <form action="#">
                            <input type="text" placeholder="Search Here...">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search-form here -->
    <!-- header-area start -->
    <header class="header-area">
        <div class="header-top bg-2">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <ul class="d-flex header-contact">
                            <li><i class="fa fa-phone"></i> +01 123 456 789</li>
                            <li><i class="fa fa-envelope"></i> tohoney@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-12">
                        <ul class="d-flex account_login-area">
                            <li>
                                <a href="javascript:void(0);"><i class="fa fa-user"></i>My Account<i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown_style">
                                    @auth
                                      <li><a href="#">Profile</a></li>
                                      <li><a href="{{ route('wishlist') }}">wishlist</a></li>
                                    @else      
                                     <li><a href="{{ route('userRegister') }}">Register</a></li>
                                     <li><a href="{{ route('userLogin') }}">Login</a></li>
                                    @endauth
                                    <li><a href="{{ route('cartPage') }}">Cart</a></li>
                                    @auth                                        
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Sign Out') }}
                                        </a>
                                        <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                    @endauth
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-lg-3 col-md-7 col-sm-6 col-6">
                        <div class="logo">
                            <a href="{{ route('frontPage') }}">
                        <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="logo">
                        </a>
                        </div>
                    </div>
                    <div class="col-lg-7 d-none d-lg-block">
                        <nav class="mainmenu">
                            <ul class="d-flex">
                                <li class="@yield('home')"><a href="{{ route('frontPage') }}">Home</a></li>
                                <li class="@yield('about')"><a href="{{ route('aboutUs') }}">About</a></li>
                                <li class="@yield('shop')"><a href="{{ route('shopPage') }}">Shop</a></li>
                                <li class="@yield('cart')"><a href="{{ route('cartPage') }}">Cart</a></li>
                                <li class="@yield('wishlist')"><a href="{{ route('wishlist') }}">Wishlist</a></li>
                                <li class="@yield('contact')"><a href="{{ route('contacPage') }}">Contact</a></li>
                                <li class="@yield('faq')"><a href="{{ route('faq') }}">Faq</a></li>
                                <li class="@yield('blog')"><a href="{{ route('blogView') }}">Blog</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-4 col-lg-2 col-sm-5 col-4">
                        <ul class="search-cart-wrapper d-flex">
                            <li class="search-tigger"><a href="javascript:void(0);"><i class="flaticon-search"></i></a></li>
                            <li>
                                <a href="javascript:void(0);"><i class="flaticon-like"></i> <span>{{ wishCount() }}</span></a>
                                <ul class="cart-wrap dropdown_style">
                                    @foreach(wishlist() as $key => $wishlists) 
                                    <li class="cart-items">
                                        <div class="cart-img">
                                            <img width="70px" src="{{ asset('product/thumbnail/'.$wishlists->product->thumbnail) }}" alt="">
                                        </div>
                                        <div class="cart-content">
                                            <a href="{{ route('wishlist') }}">{{ $wishlists->product->product_title }}</a>
                                            <p>${{ $wishlists->product->price }}</p>
                                            <a href="{{ route('wishlistDelete',$wishlists->id) }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    </li>
                                    @endforeach
                                    <li>
                                        <a href="{{ route('wishlist') }}">Check Out</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><i class="flaticon-shop"></i> <span>{{ cartCount() }}</span></a>
                                <ul class="cart-wrap dropdown_style">
                                    @php
                                        $subtotal=0;
                                    @endphp
                                    @foreach(cart() as $key => $carts)                                   
                                    <li class="cart-items">
                                        <div class="cart-img">
                                            <img width="70px" src="{{ asset('product/thumbnail/'.$carts->product->thumbnail) }}" alt="">
                                        </div>
                                        <div class="cart-content">
                                            <a href="{{ route('singleProduct',$carts->product->slug) }}">{{ $carts->product->product_title }}</a>
                                            <span>QTY : {{ $carts->quantity }}</span>
                                            @php
                                                $attribute=App\Models\ProductAttribute::where('product_id',$carts->product_id)->where('color_id',$carts->color_id)->where('size_id',$carts->size_id)->first();
                                                 $total=$attribute->product_price*$carts->quantity;
                                            @endphp
                                            <p>${{ $total }}</p>
                                            <a href="{{ route('cartRemove',$carts->id) }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    </li>
                                    @php
                                        $subtotal+=$total;
                                    @endphp
                                    @endforeach
                                    <li>Subtotol: <span class="pull-right">${{ $subtotal }}</span></li>
                                    <li>
                                        <a href="{{ route('cartPage') }}" class="cart">Check Out</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
                        <div class="responsive-menu-tigger">
                            <a href="javascript:void(0);">
                        <span class="first"></span>
                        <span class="second"></span>
                        <span class="third"></span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
            <div class="responsive-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-block d-lg-none">
                            <ul class="metismenu">
                                <li><a href="{{ route('frontPage') }}">Home</a></li>
                                <li><a href="{{ route('aboutUs') }}">About</a></li>
                                <li><a href="{{ route('shopPage') }}">Shop Page</a></li>
                                <li><a href="{{ route('cartPage') }}">Shopping cart</a></li>
                                <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                                <li><a href="{{ route('contacPage') }}">Contact</a></li>
                                <li><a href="{{ route('faq') }}">Faq</a></li>
                                <li><a href="{{ route('blogView') }}">Blog</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
        </div>
    </header>
    <!-- header-area end -->
    @yield('content')
     <!-- .footer-area start -->
     <div class="footer-area mt-5">
        <div class="footer-top">
            <div class="container">
                <div class="footer-top-item">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="footer-top-text text-center">
                                <ul>
                                    <li><a href="home.html">home</a></li>
                                    <li><a href="#">our story</a></li>
                                    <li><a href="#">feed shop</a></li>
                                    <li><a href="blog.html">how to eat blog</a></li>
                                    <li><a href="{{ route('contacPage') }}">contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <div class="footer-icon">
                            <ul class="d-flex">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-12">
                        <div class="footer-content">
                            <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure righteous indignation and dislike</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-8 col-sm-12">
                        <div class="footer-adress">
                            <ul>
                                <li><a href="#"><span>Email:</span> domain@gmail.com</a></li>
                                <li><a href="#"><span>Tel:</span> 0131234567</a></li>
                                <li><a href="#"><span>Adress:</span> 52 Web Bangale , Adress line2 , ip:3105</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="footer-reserved">
                            <ul>
                                <li>Copyright © 2019 Tohoney All rights reserved.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .footer-area end -->
    <!-- jquery latest version -->
    <script src="{{ asset('frontend/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <!-- scrollup.js -->
    <script src="{{ asset('frontend/assets/js/scrollup.js') }}"></script>
    <!-- isotope.pkgd.min.js -->
    <script src="{{ asset('frontend/assets/js/isotope.pkgd.min.js') }}"></script>
    <!-- imagesloaded.pkgd.min.js -->
    <script src="{{ asset('frontend/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <!-- jquery.zoom.min.js -->
    <script src="{{ asset('frontend/assets/js/jquery.zoom.min.js') }}"></script>
    <!-- countdown.js -->
    <script src="{{ asset('frontend/assets/js/countdown.js') }}"></script>
    <!-- swiper.min.js -->
    <script src="{{ asset('frontend/assets/js/swiper.min.js') }}"></script>
    <!-- metisMenu.min.js -->
    <script src="{{ asset('frontend/assets/js/metisMenu.min.js') }}"></script>
    <!-- mailchimp.js -->
    <script src="{{ asset('frontend/assets/js/mailchimp.js') }}"></script>
    <!-- toaster.js -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- jquery-ui.min.js -->
    <script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>
    <!-- Sweet Alert Js -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- main js -->
    <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>
     <!-- toaster.js -->
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

            case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break; 
        }
        @endif 
    </script>
    @yield('footer_js')
</body>


<!-- Mirrored from themepresss.com/tf/html/tohoney/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Mar 2020 03:33:34 GMT -->
</html>
