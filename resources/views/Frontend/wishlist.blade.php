@extends('Frontend.master')
@section('wishlist')
    active
@endsection
@section('ftitle')
    {{ "Wishlist" }}
@endsection
@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Wishlist</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Wishlist</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- wishlist-area start -->
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table-responsive cart-wrap">
                    <thead>
                        <tr>
                            <th class="images">Image</th>
                            <th class="product">Product</th>
                            <th class="ptice">Price</th>
                            <th class="addcart">View Product</th>
                            <th class="remove">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($wishlists as $key => $wishlist)                          
                        <tr>
                            <td class="images"><img src="{{ asset('product/thumbnail/'.$wishlist->product->thumbnail) }}" alt=""></td>
                            <td class="product"><a href="{{ route('singleProduct',$wishlist->product->slug) }}">{{ $wishlist->product->product_title }}</a></td>
                            <td class="ptice">${{ $wishlist->product->price }}</td>
                            <td class="addcart"><a href="{{ route('singleProduct',$wishlist->product->slug) }}">View Product</a></td>
                            <td class="remove"><a id="delete" href="{{ route('wishlistDelete',$wishlist->id) }}"><i class="fa fa-times"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- wishlist-area start -->    
@endsection
@section('footer_js')
<script>
    $(function(){
        // add #delete in anchore tag
        $(document).on('click','#delete',function(e){
            e.preventDefault();
            var link =$(this).attr('href');
            Swal.fire({
            title: 'Are you sure?',
            text: "Remove These Product From Wishlist!",
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