@extends('Backend.Form.master')
@section('content')
  <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
    <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span> Admin Login <span class="tx-normal">]</span></div>
    <x-auth-validation-errors class="mb-4" :errors="$errors" />
    <div class="tx-center mg-b-30">Admin Panel</div>
    <form action="{{ route('login') }}" method="post">
        @csrf
      {{-- Email --}}
      <div class="form-group">
        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your email">
      </div>
      {{-- Password --}}
      <div class="form-group">
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
      </div>
     {{-- Forget Password --}}
      <div class="form-group">
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif
      </div>
      {{-- Remember Me  --}}
      <div class="form-group">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
      </div>
      <button style="cursor:pointer" type="submit" class="btn btn-info btn-block">Sign In</button>
    </form>
    <div class="mg-t-60 tx-center">Not yet a member? <a href="{{ route('register') }}" class="tx-info">Sign Up</a></div>
  </div>
@endsection
