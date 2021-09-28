@extends('Backend.Form.master')
@section('content')
<div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
    <div class="signin-logo tx-center tx-28 tx-bold tx-inverse"><span class="tx-normal">[</span> Admin Login <span
        class="tx-normal">]</span></div>
    <div class="tx-center mg-b-30">Password Update</div>
    <form action="{{ route('password.email') }}" method="post">
        @csrf
      {{-- Email --}}
       <div class="form-group">
        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Enter your email">
       </div>
      <button style="cursor:pointer" type="submit" class="btn btn-info btn-block">Email Password Reset Link</button>
    </form>
  </div>
@endsection
