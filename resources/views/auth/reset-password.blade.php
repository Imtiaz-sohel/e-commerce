@extends('Backend.Form.master')
@section('content')
<div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
    <div class="signin-logo tx-center tx-28 tx-bold tx-inverse mg-b-30"><span class="tx-normal">[</span>Password Reset<span class="tx-normal">]</span></div>
    <form action="{{ route('password.update') }}" method="POST">
        @csrf
        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
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
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password">
        </div>
        <button style="cursor: pointer" type="submit" class="btn btn-info btn-block">RESET PASSWORD</button>
    </form>
</div>
@endsection