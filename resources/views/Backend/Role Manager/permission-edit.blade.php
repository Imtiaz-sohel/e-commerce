@extends('Backend.master')
@section('title')
    {{ "Role Manager" }}
@endsection
@section('role')
    active
@endsection
@section('permissonActive')
    active
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('permission') }}">Permission</a>
          <span class="breadcrumb-item active">All Permission</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row m-auto">
            <div class="col-xl-8">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Edit Permission</h6>
                    <form action="{{ route('permissionUpdatePost') }}" method="POST">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="p_id" value="{{ $permissionEdit->id }}" id="p_id">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Permission Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="permission" value="{{ $permissionEdit->name }}" id="permission" class="form-control @error('permission') is-invalid @enderror" placeholder="add category">
                              @error('permission')
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
          <div>Attentively and carefully made by Imtiaz.</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <span class="tx-uppercase mg-r-10">Share:</span>
          <a target="_blank" class="pd-x-5" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//themepixels.me/bracket/intro"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com/home?status=Bracket,%20your%20best%20choice%20for%20premium%20quality%20admin%20template%20from%20Bootstrap.%20Get%20it%20now%20at%20http%3A//themepixels.me/bracket/intro"><i class="fa fa-twitter tx-20"></i></a>
        </div>
    </footer>
</div>
@endsection