@extends('Backend.master')
@section('title')
    {{ "Faq Edit" }}
@endsection
@section('faq')
    active
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('faq.index') }}">Faq</a>
          <span class="breadcrumb-item active">Faq Edit</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row mt-5">
            <div class="col-xl-12">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Edit Faq</h6>
                    <form action="{{ route('faq.update',$faq->id) }}" method="POST">
                        @csrf
                        @method("PUT")
                        <div class="row">
                            <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Question:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="question" id="question" value="{{ $faq->question ?? old('question') }}" class="form-control @error('question') is-invalid @enderror" placeholder="Question Here ...">
                              @error('question')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                        <div class="row mt-4">
                            <label class="col-sm-2 form-control-label"><span class="tx-danger">*</span>Answer:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="answer" id="answer" value="{{ $faq->answer ?? old('answer') }}" class="form-control @error('answer') is-invalid @enderror" placeholder="Answer Here ...">
                              @error('answer')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                          <div class="row mg-t-30 justify-content-center">
                            <div class="col-sm-8 text-center">
                              <div class="form-layout-footer">
                                <button style="cursor: pointer" type="submit" class="btn btn-info">Update</button>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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