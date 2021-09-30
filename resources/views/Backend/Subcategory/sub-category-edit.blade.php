@extends('Backend.master')
@section('subcategory')
    active
@endsection
@section('title')
    {{ "Sub-Category Edit" }}
@endsection
@section('content')
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="{{ route('sub-category.index') }}">Sub-Category List</a>
          <span class="breadcrumb-item active">Sub-Category Edit</span>
        </nav>
    </div>
    <div class="br-pagebody">
      <div class="row justify-content-center">
        <div class="col-xl-6 text-center">
                <div class="form-layout form-layout-5 bg-white">
                    <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10 text-center">Add Sub-Category</h6>
                    <form action="{{ route('sub-category.update',$subcategoryEdit->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- Subcategory Name --}}
                        <div class="row">
                            <label class="col-sm-4 form-control-label"><span class="tx-danger">*</span> Sub-Category Name:</label>
                            <div class="col-sm-8 mg-t-10 mg-sm-t-0">
                              <input type="text" name="subcategory_name" id="subcategory_name" value="{{ $subcategoryEdit->subcategory_name ?? old('subcategory_name') }}" class="form-control @error('subcategory_name') is-invalid @enderror" placeholder="Enter Sub Category">
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
                                     <option value >Select Category</option>
                                    @foreach($categories as $key => $category)
                                      <option @if($subcategoryEdit->category_id==$category->id) selected @endif value="{{ $category->id }}">{{ $category->category_name }}</option>
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
                                <button style="cursor: pointer" type="submit" class="btn btn-info">Update</button>
                              </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection