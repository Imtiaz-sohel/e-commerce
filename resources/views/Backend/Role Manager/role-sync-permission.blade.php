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
          <span class="breadcrumb-item active">All Role</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row">
            <div class="col-xl-7">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Role Sync Permission</h6>
                    <div class="bd bd-gray-300 rounded table-responsive">
                      <table class="table mg-b-0">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Role Name</th>
                            <th>Have Permission</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $key => $role)                              
                            <tr>
                               <td>{{ $roles->firstItem()+$key }}</td>
                               <td>{{ $role->name }}</td>
                               <td>
                                  <ul>
                                      @foreach($role->getAllPermissions() as $key => $value)
                                        <li>{{ $value->name }}</li>    
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
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Sync Role To Permission</h6>
                    <form action="{{ route('roleSyncPost') }}" method="POST">
                        @csrf
                        <div class="row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Role Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                    <option value>Select One</option>
                                    @foreach($roles as $key => $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                              @error('role_id')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                        <div class="row mt-3">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Sync Permission:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <ul style="padding:0">
                                    @foreach($permissions as $key => $permission)
                                      <li style="list-style: none">
                                          <input type="checkbox" name="permission_id[]" id="p{{ $permission->id }}" value="{{ $permission->id }}">
                                          <label for="p{{ $permission->id }}">{{ $permission->name }}</label>
                                      </li>
                                    @endforeach
                                </ul>
                              @error('permission_id')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
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