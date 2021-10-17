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
                        @php
                            $subtotal=0;
                        @endphp
                        @foreach($carts as $key => $cart)
                        @php
                            $attributePrice=App\Models\ProductAttribute::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first();
                            $unitPrice=$attributePrice->product_price;
                        @endphp                         
                        <tr>
                            <td class="images"><img src="{{ asset('product/thumbnail/'.$cart->product->thumbnail) }}" alt="{{ $cart->product->product_title }}"></td>
                            <td class="product"><a href="{{ route('singleProduct',$cart->product->slug) }}">{{ $cart->product->product_title }}</a></td>
                            <td class="total">{{ $cart->color->color_name }}</td>
                            <td class="total">{{ $cart->size->size_name }}</td>
                            <td class="ptice unit_price{{ $cart->id }}" data-unit{{ $cart->id }}={{ $unitPrice }}>${{ $unitPrice }}</td>
                            <td class="quantity cart-plus-minus">
                                <input class="qty_quantity{{ $cart->id }}" type="text" value="{{ $cart->quantity }}" />
                                <div class="dec qtybutton qtyMinus{{ $cart->id }}">-</div>
                                <div class="inc qtybutton qtyPlus{{ $cart->id }}">+</div>
                            </td>
                            @php
                                $total=$unitPrice*$cart->quantity;
                            @endphp
                            @php
                                $subtotal+=$total;
                            @endphp
                            <td class="total"><span>$</span><span class="selectAll totalUnit{{ $cart->id }}">{{ $total }}</span></td>
                            <td class="remove"><a id="delete" href="{{ route('cartRemove',$cart->id) }}"><i class="fa fa-times"></i></a></td>
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
                                <input class="coupon" type="text" placeholder="Cupon Code">
                                <span class="coupon_check">Apply Cupon</span>
                                @if($minOrder>$subtotal)
                                    <div class="text-danger">
                                        {{ "Order $".($minOrder-$subtotal)." More To Get The Discount" }}
                                    </div>
                                @endif
                                @if(session('invalidCoupon'))
                                   <div class="text-danger">
                                      {{ session('invalidCoupon') }}    
                                   </div> 
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                        <div class="cart-total text-right">
                            <h3>Cart Totals</h3>
                            <ul>
                                <li><span class="pull-left">Subtotal </span><span>$</span><span class="sub_total_price">{{ $subtotal }}</span></li>
                                @if($discountType==1)    
                                 <li><span class="pull-left">Disount </span>
                                     <span>{{ $discountAmount }}{{ "%" }}</span>
                                 </li>
                                @elseif ($discountType==2)
                                <li><span class="pull-left">Disount </span>
                                    <span>${{ $discountAmount }}</span>
                                </li>
                                @else
                                <li><span class="pull-left">Total </span><span>$</span><span class="sub_total_price">{{ $subtotal }}</span></li> 
                                @endif
                                @if($discountType==1)
                                  <li><span class="pull-left">Total </span><span>$</span><span class="sub_total_price">{{ $subtotal-($discountAmount/100)*$subtotal }}</span></li>
                                @elseif($discountType==2)
                                 <li><span class="pull-left">Total </span><span>$</span><span class="sub_total_price">{{ $subtotal-$discountAmount }}</span></li>                                      
                                @endif
                            </ul>
                            <a href="{{ route('checkoutPage') }}">Proceed to Checkout</a>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->    
@endsection
@section('footer_js')
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
<script>
@foreach($carts as $key => $cart)
$('.qtyMinus{{ $cart->id }}').click(function(){
   let quantity = $('.qty_quantity{{ $cart->id }}').val();
   let unitPrice = $('.unit_price{{ $cart->id }}').attr('data-unit{{ $cart->id }}');
   $('.totalUnit{{ $cart->id }}').html(quantity*unitPrice);
   let c = document.querySelectorAll('.selectAll');
   let arr = Array.from(c);
   let sum=0;
      arr.map(item=>{
      sum+=parseInt(item.innerHTML);
      $('.sub_total_price').html(sum);
    });
    $.ajaxSetup({
         headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type:"POST",
        url:"{{ url('cart-update-ajax') }}",
        data:{
            "_token": "{{ csrf_token() }}",
            id:"{{ $cart->id }}",
            qty:quantity,
        }
    });   
 });

$('.qtyPlus{{ $cart->id }}').click(function(){
    let quantity = $('.qty_quantity{{ $cart->id }}').val();
    let unitPrice = $('.unit_price{{ $cart->id }}').attr('data-unit{{ $cart->id }}');
    $('.totalUnit{{ $cart->id }}').html(quantity*unitPrice);
    let c = document.querySelectorAll('.selectAll');
    let arr = Array.from(c);
    let sum=0;
      arr.map(item=>{
      sum+=parseInt(item.innerHTML);
      $('.sub_total_price').html(sum);
    });
    $.ajaxSetup({
      headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });
   $.ajax({
        type:"POST",
        url:"{{ url('cart-update-ajax') }}",
        data:{
        "_token": "{{ csrf_token() }}",
            id:"{{ $cart->id }}",                         
            qty:quantity,
        }
    });
});
@endforeach

$('.coupon_check').click(function(){
   let coupon = $('.coupon').val();
   window.location.href="{{ url('cart') }}/" +coupon;
});

</script>
<script>
    $(function(){
        // add #delete in anchore tag
        $(document).on('click','#delete',function(e){
            e.preventDefault();
            var link =$(this).attr('href');
            Swal.fire({
            title: 'Are you sure?',
            text: "Remove These Product From Cart!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href=link
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
             }
            });
        });
    });
</script>    
@endsection
