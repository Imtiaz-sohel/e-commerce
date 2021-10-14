@extends('Frontend.master')
@section('cart')
    active
@endsection
@section('ftitle')
    {{ "Cart Page" }}
@endsection
@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shopping Cart</h2>
                    <ul>
                        <li><a href="{{ route('frontPage') }}">Home</a></li>
                        <li><span>Shopping Cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- cart-area start -->
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table-responsive cart-wrap">
                    <thead>
                        {{-- {{ $carts }} --}}
                        <tr>
                            <th class="images">Image</th>
                            <th class="product">Product</th>
                            <th class="ptice">Color</th>
                            <th class="ptice">Size</th>
                            <th class="ptice">Price</th>
                            <th class="quantity">Quantity</th>
                            <th class="total">Total</th>
                            <th class="remove">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carts as $key => $cart)
                        @php
                            $attributePrice=App\Models\ProductAttribute::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first();
                            $unitPrice=$attributePrice->product_price;
                        @endphp                         
                        <tr>
                            <td class="images"><img src="{{ asset('product/thumbnail/'.$cart->product->thumbnail) }}" alt="{{ $cart->product->product_title }}"></td>
                            <td class="product"><a href="single-product.html">{{ $cart->product->product_title }}</a></td>
                            <td class="total">{{ $cart->color->color_name }}</td>
                            <td class="total">{{ $cart->size->size_name }}</td>
                            <td class="ptice">${{ $unitPrice }}</td>
                            <td class="quantity cart-plus-minus">
                                <input type="text" value="{{ $cart->quantity }}" />
                            </td>
                            <td class="total">$539.00</td>
                            <td class="remove"><a href="{{ route('cartRemove',$cart->id) }}"><i class="fa fa-times"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row mt-60">
                    <div class="col-xl-4 col-lg-5 col-md-6 ">
                        <div class="cartcupon-wrap">
                            <h3>Cupon</h3>
                            <p>Enter Your Cupon Code if You Have One</p>
                            <div class="cupon-wrap">
                                <input type="text" placeholder="Cupon Code">
                                <button>Apply Cupon</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                        <div class="cart-total text-right">
                            <h3>Cart Totals</h3>
                            <ul>
                                <li><span class="pull-left">Subtotal </span>$380.00</li>
                                <li><span class="pull-left"> Total </span> $380.00</li>
                            </ul>
                            <a href="checkout.html">Proceed to Checkout</a>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->    
@endsection