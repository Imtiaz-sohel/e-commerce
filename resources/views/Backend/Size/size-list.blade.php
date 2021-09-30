@extends('Backend.master')
@section('size')
    active
@endsection
@section('title')
    {{ "Size" }}
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{ route('size.index') }}">Size List</a>
            <span class="breadcrumb-item active">Size View & Add</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row">
            <div class="col-xl-6">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Size ({{ $sizeCount }})</h6>
                    <div class="bd bd-gray-300 rounded table-responsive">
                      <table class="table mg-b-0">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Size Name</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($sizes as $key => $size)                                
                            <tr>
                              <td>{{ $sizes->firstItem() +$key }}</td>
                              <td>{{ $size->size_name }}</td>
                              <td>
                                  @if($size->status==1)
                                      <a href="{{ route('sizeStatus',$size->id) }}" class="btn btn-outline-success">Active</a>
                                  @else
                                      <a href="{{ route('sizeStatus',$size->id) }}" class="btn btn-outline-danger">Inactive</a>    
                                  @endif
                              </td>
                              <td>
                                  <a href="{{ route('size.edit',$size->id) }}" class="btn btn-outline-success"><i class="fa fa-edit"></i></a>
                                  <form action="{{ route('size.destroy',$size->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger" type="submit"><i class="fa fa-trash"></i></button>
                                  </form>
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
                {{ $sizes->links() }}
                <div class="row mt-5">
                    <div class="col-xl-12">
                        <div class="br-section-wrapper">
                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Trashed Size ({{ $sizeTrashCount }})</h6>
                            <div class="bd bd-gray-300 rounded table-responsive">
                              <table class="table mg-b-0">
                                <thead>
                                  <tr>
                                    <th>SL</th>
                                    <th>Size Name</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($sizeTrashes as $key => $sizeTrash)   
                                    <tr>
                                      <td>{{ $sizeTrashes->firstItem() + $key }}</td>
                                      <td>{{ $sizeTrash->size_name }}</td>
                                      <td>
                                          <a class="btn-outline-success" href="{{ route('sizeRestore',$sizeTrash->id) }}">Restore</a>
                                          <a class="btn-outline-danger" href="{{ route('sizePerDelete',$sizeTrash->id) }}">Permanent Delete</a>
                                      </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div><!-- bd -->
                        </div>
                        {{ $sizeTrashes->links() }}
                    </div>
                </div>
             </div>
            <div class="col-xl-6">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Add Size</h6>
                    <form action="{{ route('size.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Size Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="size_name" id="size_name" value="{{ old('size_name') }}" class="form-control @error('size_name') is-invalid @enderror" placeholder="Enter Size">
                              @error('size_name')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                          <div class="row mg-t-30">
                            <div class="col-sm-8 mg-l-auto text-center">
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