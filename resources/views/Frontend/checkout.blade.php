@extends('Frontend.master')
@section('ftitle')
    {{ "Checkout" }}
@endsection
@section('header_css')
<link href="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />    
@endsection
@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Checkout</h2>
                    <ul>
                        <li><a href="{{ route('frontPage') }}">Home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form form-style">
                    <h3>Billing Details</h3>
                    <form action="{{ route('checkoutPost') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <p>First Name *</p>
                                <input name="full_name" value="{{ old('full_name') }}" id="full_name" type="text" @error('full_name') is-invalid @enderror>
                                @error('full_name')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <p>Company Name</p>
                                <input name="company_name" value="{{ old('company_name') }}" id="company_name" type="text">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Email Address *</p>
                                <input name="email" value="{{ old('email') }}" id="email" type="email">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Phone No. *</p>
                                <input name="phone" value="{{ old('phone') }}" id="phone" type="text" @error('phone') is-invalid @enderror>
                              @error('phone')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                              @enderror    
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Country *</p>
                                <select name="country_id" id="country" @error('country_id') is-invalid @enderror>
                                    <option value>Select One</option>
                                    @foreach($countries as $key => $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>State *</p>
                                <select name="state_id" id="state" @error('state_id') is-invalid @enderror>

                                </select>
                                @error('state_id')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>City *</p>
                                <select name="city_id" id="city" @error('city_id') is-invalid @enderror>

                                </select>
                                @error('city_id')
                                 <div class="text-danger">
                                    {{ $message }}
                                 </div>
                               @enderror
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Postcode/ZIP</p>
                                <input name="zip_code" value="{{ old('zip_code') }}" id="zip_code" type="text" @error('zip_code') is-invalid @enderror>
                              @error('zip_code')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                              @enderror 
                            </div>
                            <div class="col-12">
                                <p>Your Address *</p>
                                <input name="address" value="{{ old('address') }}" id="address" type="text" @error('address') is-invalid @enderror>
                             @error('address')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                              @enderror 
                            </div>
                            {{-- Shipping Address --}}
                            <div class="col-12">
                                <input id="toggle2" name="different_shipping" value="1" type="checkbox">
                                <label class="fontsize" for="toggle2">Ship to a different address?</label>
                                <div class="row" id="open2">
                                    <div class="col-12">
                                        <p>Country</p>
                                        <select id="s_country" name="s_country_id">
                                            <option value>Select One</option>
                                            @foreach($countries as $key => $country)
                                              <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class=" col-12">
                                        <p>First Name</p>
                                        <input name="s_full_name" id="s_f_name" type="text" @error('s_full_name') is-invalid @enderror>
                                        @error('s_full_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <p>Company Name</p>
                                        <input name="s_company_name" id="s_c_name" type="text"/>
                                    </div>
                                    <div class="col-12">
                                        <p>Address</p>
                                        <input name="s_address" id="s_address" type="text" placeholder="Address" @error('s_address') is-invalid @enderror/>
                                    @error('s_address')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>
                                    <div class="col-12">
                                        <p>State </p>
                                        <select name="s_state_id" id="s_state">

                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <p>City</p>
                                        <select name="s_city_id" id="s_city">

                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <p>Postcode / Zip </p>
                                        <input name="s_zip_code" id="s_zip_code" type="text" placeholder="Postcode / Zip" @error('s_zip_code') is-invalid @enderror/>
                                    @error('s_zip_code')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>
                                    <div class="col-12">
                                        <p>Email Address </p>
                                        <input name="s_email" id="s_email" type="email" />
                                    </div>
                                    <div class="col-12">
                                        <p>Phone </p>
                                        <input name="s_phone" id="s_phone" type="text" placeholder="Phone Number" @error('s_phone') is-invalid @enderror/>
                                    @error('s_phone')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <p>Order Notes </p>
                                <textarea id="notes" name="notes" placeholder="Notes about Your Order, e.g.Special Note for Delivery">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                  </div>
              </div>
            <div class="col-lg-4">
                <div class="order-area">
                    <h3>Your Order</h3>
                    <ul class="total-cost">
                        @php
                            $subtotal=0;
                        @endphp
                        @foreach($carts as $key => $cart)
                        @php
                            $attribute = App\Models\ProductAttribute::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->first();
                            $unitPrice = $attribute->product_price;
                        @endphp
                        @php
                          $subtotal+=$unitPrice*$cart->quantity;
                        @endphp                        
                          <li>{{ $cart->product->product_title }} x {{ $cart->quantity }}<span class="pull-right">${{ $unitPrice*$cart->quantity }}</span></li>
                        @endforeach
                        <li>Subtotal <span class="pull-right"><strong>${{ $subtotal }}</strong></span></li>
                        <li>Shipping <span class="pull-right">Free</span></li>
                        <li>Discount <span class="pull-right">
                          @if($coupon=="")
                            {{ "N/A" }}
                          @elseif($coupon->discount_type==1)
                            {{ $coupon->discount_amount }}{{ "%" }}
                          @elseif ($coupon->discount_type==2)
                            <span>$</span>{{ $coupon->discount_amount }}   
                          @endif     
                        </span></li>
                        @if($coupon=="")
                          <li>Total<span class="pull-right">${{ $subtotal }}</span></li>
                        @elseif($coupon->discount_type==1)  
                          <li>Total<span class="pull-right">${{ $subtotal-$coupon->discount_amount/100*$subtotal }}</span></li>
                        @elseif($coupon->discount_type==2)
                          <li>Total<span class="pull-right">${{ $subtotal-$coupon->discount_amount }}</span></li>
                        @endif
                    </ul>
                    <ul class="payment-method">
                        <li>
                            <input value="bank" name="pay_type" id="bank" type="radio">
                            <label for="bank">Direct Bank Transfer</label>
                        </li>
                        <li>
                            <input value="card" name="pay_type" id="card" type="radio">
                            <label for="card">Credit Card</label>
                        </li>
                        <li>
                            <input value="delivery" name="pay_type" id="delivery" type="radio">
                            <label for="delivery">Cash on Delivery</label>
                        </li>
                    </ul>
                    <button>Place Order</button>
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end --> 
@endsection
@section('footer_js')
<script src="//cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$('#country').change(function(){
    var countryID = $(this).val();    
    if(countryID){
        $.ajax({
            type:"GET",
            url:"{{url('api/get-state-list')}}/"+countryID,
            success:function(res){               
            if(res){
                $("#state").empty();
                $("#state").append('<option>Select State</option>');
                $.each(res,function(key,value){
                    $("#state").append('<option value="'+value.id+'">'+value.name+'</option>');
                });
            
            }else{
                $("#state").empty();
            }
            }
        });
    }else{
        $("#state").empty();
        $("#city").empty();
    }      
    });
    $('#state').on('change',function(){
    var stateID = $(this).val();    
    if(stateID){
        $.ajax({
            type:"GET",
            url:"{{url('api/get-city-list')}}/"+stateID,
            success:function(res){               
            if(res){
                $("#city").empty();
                $("#city").append('<option>Select City</option>');
                $.each(res,function(key,value){
                    $("#city").append('<option value="'+value.id+'">'+value.name+'</option>');
                });
            
            }else{
                $("#city").empty();
            }
            }
        });
    }else{
        $("#city").empty();
    }   
 });  



$('#s_country').change(function(){
    var countryID = $(this).val();    
    if(countryID){
        $.ajax({
            type:"GET",
            url:"{{url('api/get-state-list')}}/"+countryID,
            success:function(res){               
            if(res){
                $("#s_state").empty();
                $("#s_state").append('<option>Select State</option>');
                $.each(res,function(key,value){
                    $("#s_state").append('<option value="'+value.id+'">'+value.name+'</option>');
                });
            
            }else{
                $("#s_state").empty();
            }
            }
        });
    }else{
        $("#s_state").empty();
        $("#s_city").empty();
    }      
    });
    $('#s_state').on('change',function(){
    var stateID = $(this).val();    
    if(stateID){
        $.ajax({
            type:"GET",
            url:"{{url('api/get-city-list')}}/"+stateID,
            success:function(res){               
            if(res){
                $("#s_city").empty();
                $("#s_city").append('<option>Select City</option>');
                $.each(res,function(key,value){
                    $("#s_city").append('<option value="'+value.id+'">'+value.name+'</option>');
                });
            
            }else{
                $("#s_city").empty();
            }
            }
        });
    }else{
        $("#s_city").empty();
    }   
 });  


    
$(document).ready(function() {
   $('#country,#state,#city').select2();
}); 
</script>

@endsection