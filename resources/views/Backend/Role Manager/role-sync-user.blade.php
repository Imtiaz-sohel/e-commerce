@extends('Backend.master')
@section('title')
    {{ "Role Manager" }}
@endsection
@section('role')
    active
@endsection
@section('userActive')
    active
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('permission') }}">Permission</a>
          <span class="breadcrumb-item active">Role Sync User</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row">
            <div class="col-xl-7">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Role Sync User</h6>
                    <div class="bd bd-gray-300 rounded table-responsive">
                      <table class="table mg-b-0">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>User Name</th>
                            <th>Have Role</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $key => $usr)                                
                            <tr>
                                <td>{{ $users->firstItem() + $key }}</td>
                                <td>{{ $usr->name }}</td>
                                <td>
                                    <ul>
                                        @foreach($usr->getRoleNames() as $key => $value)
                                          <li>{{ $value }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div><!-- bd -->
                </div>
            </div>
            <div class="col-xl-5">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Sync Role To User</h6>
                    <form action="{{ route('roleSyncUserPost') }}" method="POST">
                        @csrf
                        <div class="row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>User Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                                    <option value>Select One</option>
                                    @foreach($users as $key => $usr)
                                        <option value="{{ $usr->id }}">{{ $usr->name }}</option>
                                    @endforeach
                                </select>
                              @error('user_id')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                        <div class="row mt-4">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Sync Role:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <ul style="padding: 0">
                                    @foreach($roles as $key => $role)
                                    <li style="list-style: none">
                                        <input type="checkbox" name="role_id[]" id="r{{ $role->id }}" value="{{ $role->id }}">
                                        <label for="r{{ $role->id }}">{{ $role->name }}</label>
                                    </li>
                                    @endforeach
                                    @error('role_id')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </ul>
                            </div>
                          </div>
                          <div class="row mg-t-30 justify-content-center">
                            <div class="col-sm-8 text-center">
                              <div class="form-layout-footer">
                                <button style="cursor: pointer" type="submit" class="btn btn-info">Submit</button>
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