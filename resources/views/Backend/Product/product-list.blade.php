@extends('Backend.master')
@section('product')
    active
@endsection
@section('listActive')
    active
@endsection
@section('title')
    {{ "Product List" }}
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('product.index') }}">Product List</a>
          <span class="breadcrumb-item active">Product View</span>
        </nav>
    </div>
    <style>
        .secPading{
            padding: 20px 0;
        }
    </style>
    <div class="br-pagebody">
        <div class="br-section-wrapper secPading">
            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Product ({{ $productCount }})</h6>
            <a style="float: right" href="{{ route('product.create') }}"> <i class="fa fa-plus"></i> ADD </a>
            <div class="bd bd-gray-300 rounded table-responsive">
              <table class="table mg-b-0">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Product</th>
                    <th>Cat.</th>
                    <th>SubCat.</th>
                    <th>Brand</th>
                    <th>Color</th>
                    <th>Size</th>
                    <th>Quan.</th>
                    <th>Price</th>
                    <th>Sum.</th>
                    <th>Des.</th>
                    <th>Thumb.</th>
                    <th>Gallery</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)                        
                    <tr>
                      <td>{{ $products->firstItem() + $key }}</td>
                      <td>{{ $product->product_title }}</td>
                      <td>{{ $product->category->category_name }}</td>
                      <td>{{ $product->subcategory->subcategory_name }}</td>
                      <td>{{ $product->brand->brand_name }}</td>
                      <td>
                          <ul>
                              @foreach($product->productAttribute as $key => $colors)
                                <li>{{ $colors->color->color_name }}</li>
                              @endforeach
                          </ul>
                      </td>
                      <td>
                          <ul>
                              @foreach($product->productAttribute as $key => $sizes)
                                <li>{{ $sizes->size->size_name }}</li>
                              @endforeach
                          </ul>
                      </td>
                      <td>
                          <ul>
                              @foreach($product->productAttribute as $key => $quantity)
                                <li>{{ $quantity->quantity }}</li>
                              @endforeach
                          </ul>
                      </td>
                      <td>
                          <ul>
                              @foreach($product->productAttribute as $key => $productPrice)
                                <li>{{ $productPrice->product_price }}</li>
                              @endforeach
                          </ul>
                      </td>
                      <td>{{ Str::limit($product->summary,'10') }}</td>
                      <td>{!! Str::limit($product->description,'20') !!}</td>
                      <td>
                          <img width="50%" src="{{ asset('product/thumbnail/'.$product->thumbnail) }}" alt="{{ $product->product_title }}">
                      </td>
                      <td>
                          @foreach($product->productGallery as $key => $gallery)
                             <img  width="50%" src="{{ asset('product/gallery/'.$gallery->image_name) }}" alt="">
                          @endforeach
                      </td>
                      <td>
                          <a class="btn btn-outline-success" href="{{ route('product.edit',$product->id) }}"><i class="fa fa-edit"></i></a>
                          <form action="" method="post">
                              <button class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                          </form>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            {{ $products->links() }}
        </div>
    </div>
    <footer class="br-footer">
        <div class="footer-left">
          <div class="mg-b-2">Copyright © 2017. Bracket. All Rights Reserved.</div>
          <div>Attentively and carefully made by ThemePixels.</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <span class="tx-uppercase mg-r-10">Share:</span>
          <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/bracket/intro"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Bracket,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/bracket/intro"><i class="fa fa-twitter tx-20"></i></a>
        </div>
    </footer>
</div>
@endsection