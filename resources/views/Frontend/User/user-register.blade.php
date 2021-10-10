@extends('Frontend.master')
@section('ftitle')
    {{ "Register" }}
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
                        <li><span>Register</span></li>
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
                <form action="{{ route('register') }}" method="POST">
                  @csrf
                 <div class="account-form form-style">
                    <p>User Name *</p>
                    <input type="name" name="name" id="name">
                    <p>Email Address *</p>
                    <input type="email" name="email" id="email" @error('email') is-invalid @enderror>
                    <div class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                    <p>Password *</p>
                    <input type="Password" name="password" id="password" @error('password') is-invalid @enderror>
                    <div class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                    <p>Confirm Password *</p>
                    <input type="Password" name="password_confirmation" id="password_confirmation">
                    <button>Register</button>
                    <div class="text-center">
                        <a href="{{ route('userLogin') }}">Or Login</a>
                    </div>
                 </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection