@extends('Frontend.master')
@section('ftitle')
    {{ "login" }}
@endsection
@section('content')
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Account</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
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
                <form action="{{ route('login') }}" method="post">
                    @csrf
                  <div class="account-form form-style">
                    <p>Email Address *</p>
                    <input type="email" name="email" id="email">
                    <p>Password *</p>
                    <input type="Password" name="password" id="password">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="remember_me">
                                <input id="remember_me" type="checkbox" name="remember">
                                <span>{{ __('Remember me') }}</span>
                            </label>
                          </div>
                          <div class="col-lg-6 text-right">
                            @if (Route::has('password.request'))
                                <a href="{{ route('ForgetPassword') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif
                        </div>  
                      </div>
                    <button>SIGN IN</button>
                    <div class="text-center">
                        <a href="{{ route('userRegister') }}">Or Creat an Account</a>
                    </div>
                  </div>
                </form>
                <div class="social text-center mt-3">
                    <a href="{{ route('google') }}" class="btn btn-danger btn-icon mg-r-5 mg-b-10"><div><i class="fa fa-google-plus"></i></div></a>
                    <a href="{{ route('github') }}" class="btn btn-dark btn-icon mg-r-5 mg-b-10"><div><i class="fa fa-github"></i></div></a>
                </div>
                @if(session('error'))
                    <div class="alert alert-danger text-center">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection