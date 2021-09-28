@extends('Backend.Form.master')
@section('content')
<div class="row row-sm mg-t-20 justify-content-center">
    <div class="col-sm-6 col-lg-6 mg-t-20 mg-sm-t-0 text-center">
        <div class="card shadow-base bd-0">
          <div class="card-body">
            <p class="tx-sm tx-inverse tx-medium mg-b-0">Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.</p>
            @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
            @endif
            <form action="{{ route('verification.send') }}" method="POST">
                @csrf
                <div>
                    <button style="cursor: pointer" class="mg-t-9 btn btn-dark" type="submit">Resend Verification Email</button>
                </div>
            </form>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button style="cursor: pointer" type="submit" class="mg-t-9 btn btn-dark">
                    {{ __('Log Out') }}
                </button>
            </form>
          </div><!-- card-body -->
        </div><!-- card -->
      </div>
  </div>
@endsection