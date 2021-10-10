@extends('Frontend.master')
@section('ftitle')
    {{ "forget Password" }}
@endsection
@section('content')
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Account</h2>
                    <ul>
                        <li><a href="{{ route('frontPage') }}">Home</a></li>
                        <li><span>Login</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="account-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                  <div class="account-form form-style">
                     <p>Email Address *</p>
                     <input type="email" name="email" id="email"  placeholder="Enter your email">
                  </div>
                  <button style="cursor:pointer;background:red;" type="submit" class="btn btn-info btn-block">Email Password Reset Link</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection