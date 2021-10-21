@extends('Frontend.master')
@section('ftitle')
    {{ "Blog" }}
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
                    <h2>Blog Page</h2>
                    <ul>
                        <li><a href="{{ route('frontPage') }}">Home</a></li>
                        <li><span>Blog</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area ends -->
<!-- blog-area start -->
<div class="blog-area">
    <div class="container">
        <div class="col-lg-12">
            <div class="section-title  text-center">
                <h2>Latest News</h2>
                <img src="{{ asset('frontend/assets/images/section-title.png') }}" alt="">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4  col-md-6 col-12">
                <div class="blog-wrap">
                    <div class="blog-image">
                        <img src="assets/images/blog/1.jpg" alt="">
                        <ul>
                            <li>20</li>
                            <li>Janu</li>
                        </ul>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <ul>
                                <li><a href="#"><i class="fa fa-user"></i> Admin</a></li>
                                <li class="pull-right"><a href="#"><i class="fa fa-clock-o"></i> 25/06/2019</a></li>
                            </ul>
                        </div>
                        <h3><a href="blog-details.html">British military courts use aginst protesters busines
                                cultural...</a></h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati nulla veniam autem
                            veritatis, adipisci officia? Tempora necessitatibus, iusto minima maxime ipsum quae
                            dolore repellat quaerat.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pagination part start -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
              <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1"><i class="fa fa-arrow-left"></i></a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#"><i class="fa fa-arrow-right"></i></a>
              </li>
            </ul>
        </nav>
        <!-- Pagination part ends -->
    </div>
</div> 
<!-- blog-area ends --> 
@endsection