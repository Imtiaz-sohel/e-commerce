@extends('Backend.master')
@section('category')
    active
@endsection
@section('title')
    {{ 'Category List' }}
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('category.index') }}">Category List</a>
          <span class="breadcrumb-item active">Category View & Add</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row">
            <div class="col-xl-6">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Category ({{ $categoryCount }})</h6>
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
                            @foreach($categories as $key => $category)                                
                            <tr>
                              <td>{{ $categories->firstItem() + $key }}</td>
                              <td>{{ $category->category_name }}</td>
                              <td>
                                  @if($category->status==1)
                                   <a class="btn btn-outline-success" href="{{ route('categoryStatus',$category->id) }}">ACTIVE</a>
                                  @else
                                   <a class="btn btn-outline-danger" href="{{ route('categoryStatus',$category->id) }}">INACTIVE</a>
                                  @endif
                              </td>
                              <td>
                                  @if($category->status==1)
                                   <a class="btn btn-outline-success" href="{{ route('category.edit',$category->id) }}"><i class="fa fa-edit"></i></a>
                                   <form action="{{ route('category.destroy',$category->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button style="cursor:pointer" class="btn btn-outline-danger" type="submit"><i class="fa fa-trash"></i></button>
                                  </form>
                                  @else
                                    {{ 'Not Allowed' }}
                                  @endif
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div><!-- bd -->
                </div>
                {{ $categories->links() }}
                <div class="row mt-5">
                    <div class="col-xl-12">
                        <div class="br-section-wrapper">
                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Category</h6>
                            <div class="bd bd-gray-300 rounded table-responsive">
                              <table class="table mg-b-0">
                                <thead>
                                  <tr>
                                    <th>SL</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($categoryTrashes as $key => $categoryTrashe)
                                    <tr>
                                      <td>{{ $categoryTrashes->firstItem() + $key }}</td>
                                      <td>{{ $categoryTrashe->category_name }}</td>
                                      <td>
                                          <a href="{{ route('categoryRestore',$categoryTrashe->id)}}" class="btn btn-outline-success">Restore</a>
                                          <a href="{{ route('categoryPerDelete',$categoryTrashe->id) }}" class="btn btn-outline-danger">Permanent Delete</a>
                                      </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div>
                        </div>
                        {{ $categoryTrashes->links() }}
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Add Category</h6>
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Category:</label>
                            {{-- category name --}}
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="category_name" id="category_name" value="{{ old('category_name') }}" class="form-control @error('category_name') is-invalid @enderror" placeholder="Enter category">
                              @error('category_name')
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