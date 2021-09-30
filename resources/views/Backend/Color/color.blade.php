@extends('Backend.master')
@section('title')
    {{ "Color List" }}
@endsection
@section('color')
    active
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('color.index') }}">Color List</a>
          <span class="breadcrumb-item active">Color Add & View</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row">
            <div class="col-xl-6">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Color ({{ $colorCount }})</h6>
                    <div class="bd bd-gray-300 rounded table-responsive">
                      <table class="table mg-b-0">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($colors as $key => $color)                                
                            <tr>
                              <td>{{ $colors->firstItem() + $key }}</td>
                              <td>{{ $color->color_name }}</td>
                              <td>
                                  @if($color->status==1)
                                      <a href="{{ route('colorStatus',$color->id) }}" class="btn btn-outline-success">Active</a>
                                   @else
                                      <a href="{{ route('colorStatus',$color->id) }}" class="btn btn-outline-danger">Inactive</a>
                                  @endif
                              </td>
                              <td>
                                  @if($color->status==1)                                      
                                    <a href="{{ route('color.edit',$color->id) }}" class="btn btn-outline-success"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('color.destroy',$color->id) }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-outline-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                  @else
                                   {{ "NOT ALLOWED" }}  
                                  @endif
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    {{ $colors->links() }}
                 </div>
                 {{-- Color Trashed List --}}
                 <div class="row mt-5">
                     <div class="col-xl-12">
                        <div class="br-section-wrapper">
                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Trashed Color ({{ $colorTrashCount }})</h6>
                            <div class="bd bd-gray-300 rounded table-responsive">
                              <table class="table mg-b-0">
                                <thead>
                                  <tr>
                                    <th>SL</th>
                                    <th>Color</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($colorTrashes as $key => $colorTrash)
                                    <tr>
                                      <td>{{ $colorTrashes->firstItem() + $key }}</td>
                                      <td>{{ $colorTrash->color_name }}</td>
                                      <td>
                                          <a class="btn-outline-success" href="{{ route('colorRestore',$colorTrash->id) }}">Restore</a>
                                          <a class="btn-outline-danger" href="{{ route('colorPerDelete',$colorTrash->id) }}">Permanent Delete</a>
                                      </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div><!-- bd -->
                        </div>
                        {{ $colorTrashes->links() }}
                     </div>
                 </div>
              </div>
            <div class="col-xl-6">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Add Color</h6>
                    <form action="{{ route('color.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Color Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="color_name" id="color_name" value="{{ old('color_name') }}" class="form-control @error('color_name') is-invalid @enderror" placeholder="Enter Color Name">
                              @error('color_name')
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