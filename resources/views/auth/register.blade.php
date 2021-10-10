@extends('Backend.Form.master')
@section('content')
    <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white rounded shadow-base">
        <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span> To Honeys <span class="tx-normal">]</span></div>
        <div class="tx-center mg-b-40">Admin Panel</div>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            {{-- user Name --}}
            <div class="form-group">
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter your username">
                @error('name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- Phone --}}
            <div class="form-group">
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control" placeholder="Enter your phone">
            </div>
            {{-- Email --}}
            <div class="form-group">
                <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
                @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- Password --}}
            <div class="form-group">
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password">
                @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- Confirm Password --}}
            <div class="form-group">
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm password">
            </div>
            <button style="cursor: pointer" type="submit" class="btn btn-info btn-block">Sign Up</button>
        </form>
        <div class="mg-t-40 tx-center">Already Member? <a href="{{ route('login') }}" class="tx-info">Login</a></div>
    </div>
@endsection
