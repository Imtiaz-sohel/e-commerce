@extends('Backend.master')
@section('subcategory')
    active
@endsection
@section('title')
    {{ "Sub-Category" }}
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('sub-category.index') }}">Sub Category</a>
          <span class="breadcrumb-item active">Subcategory View & Add</span>
        </nav>
    </div>
    <div class="br-pagebody">
        <div class="row">
            <div class="col-xl-6">
                <div class="br-section-wrapper">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Sub-Category ({{ $subCategoryCount }})</h6>
                    <div class="bd bd-gray-300 rounded table-responsive">
                      <table class="table mg-b-0">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Sub Category</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($subCategories as $key => $subCategory)                                
                            <tr>
                              <td>{{ $subCategories->firstItem() + $key }}</td>
                              <td>{{ $subCategory->subcategory_name }}</td>
                              <td>{{ $subCategory->category->category_name }}</td>
                              <td>
                                  @if($subCategory->status==1)
                                      <a class="btn btn-outline-success" href="{{ route('subcategoryStatus',$subCategory->id) }}">ACTIVE</a>
                                  @else
                                      <a class="btn btn-outline-danger" href="{{ route('subcategoryStatus',$subCategory->id) }}">INACTIVE</a>    
                                  @endif
                              </td>
                              <td>
                                  @if($subCategory->status==1)                                      
                                  <a href="{{ route('sub-category.edit',$subCategory->id) }}" class="btn btn-outline-primary"><i class="fa fa-edit"></i></a>
                                  <form action="{{ route('sub-category.destroy',$subCategory->id) }}" method="POST">
                                      @csrf
                                      @method('DELETE')
                                      <button style="cursor:pointer" class="btn btn-outline-danger"  type="submit"><i class="fa fa-trash"></i></button>
                                  </form>
                                  @else
                                    {{ 'NOT ALLOWED' }}
                                  @endif
                              </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                </div>
                {{ $subCategories->links() }}
                {{--Sub Category Trash List --}}
                <div class="row mt-4">
                    <div class="col-xl-12">
                        <div class="br-section-wrapper">
                            <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">ALL Trashed Category ({{ $subCategoryTrashesCount }})</h6>
                            <div class="bd bd-gray-300 rounded table-responsive">
                              <table class="table mg-b-0">
                                <thead>
                                  <tr>
                                    <th>SL</th>
                                    <th>Sub Category</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($subCategoryTrashes as $key=>$subCategoryTrashe)                                        
                                    <tr>
                                        <td>{{ $subCategoryTrashes->firstItem() + $key }}</td>
                                        <td>{{ $subCategoryTrashe->subcategory_name }}</td>
                                        <td>{{ $subCategoryTrashe->category->category_name }}</td>
                                        <td>
                                            <a class="bt btn-outline-success" href="{{ route('subCategoryRestore',$subCategoryTrashe->id) }}">Restore</a>
                                            <a class="bt btn-outline-danger" href="{{ route('subCategoryPerDelete',$subCategoryTrashe->id) }}">Permanent Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              </table>
                            </div>
                        </div> 
                        {{ $subCategoryTrashes->links() }}                       
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Add Sub-Category</h6>
                    <form action="{{ route('sub-category.store') }}" method="POST">
                        @csrf
                        {{-- Subcategory Name --}}
                        <div class="row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Sub-Category Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="subcategory_name" id="subcategory_name" value="{{ old('subcategory_name') }}" class="form-control @error('subcategory_name') is-invalid @enderror" placeholder="Enter Sub Category">
                              @error('subcategory_name')
                                  <div class="text-danger">
                                      {{ $message }}
                                  </div>
                              @enderror
                            </div>
                          </div>
                        {{-- Category Name --}}
                        <div class="row mt-4">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span>Select Category:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                                <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                                     <option value>Select Category</option>
                                    @foreach($categories as $key => $category)
                                      <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
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