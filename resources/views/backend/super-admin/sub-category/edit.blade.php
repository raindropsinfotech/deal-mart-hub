@extends('layouts.admin-app')

@section('page-header', 'Edit Sub Category')
@section('page-title-header', 'Edit Sub Category')

@section('page-breadcrumbs')
<li class="breadcrumb-item">
    <a href="{{ route('backend_all_sub_categories') }}">Sub Categories</a>
</li>
<li class="breadcrumb-item active">Edit Sub Category</li>
@endsection

@section('content')
<div class="card mb-4">
    <form class="card-body" method="POST" action="{{ route('backend_update_sub_category',['update_id' => $editSubCategories->id]) }}" enctype="multipart/form-data" id="createUser">
    @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Enter Name" value="{{ old('name') ?? $editSubCategories->name }}">
                @error('name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="slug">Slug</label>
                <p class="fw-bold" id="sulg-label">{{$editSubCategories->slug}}</p>
                <input type="hidden" name="slug" id="slug" class="form-control  @error('slug') is-invalid @enderror" placeholder="Slug" value="{{ old('slug') ?? $editSubCategories->slug }}">
                @error('slug')
                    <span id="slug-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="maincat_id">Main Category</label>
                <div class="row">
                    @foreach( $getMainCategories as $key => $main_categories )
                    <div class="col-md-6 mb-3">
                        <div class="form-check custom-option custom-option-basic">
                            <label class="form-check-label custom-option-content" for="{{ $main_categories->name }}">
                            <input name="main_categories" class="form-check-input" type="radio" value="{{ $main_categories->id }}" id="{{ $main_categories->name }}" @if($main_categories->id === $editSubCategories->maincat_id) checked @endif>
                                <span class="custom-option-header">
                                    <span class="h6 mb-0">{{ $main_categories->name }}</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
                @error('maincat_id')
                    <span id="maincat_id-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="parent_id">Sub Category</label>
                <select class="form-select @error('parent_id') is-invalid @enderror" name="parent_id" id="parent_id" aria-label="Default select example">
                    <option value="">Select sub category</option>
                    @foreach($getSubCategories as $key => $sub_category)
                        <option value="{{ $sub_category->id }}" @if($sub_category->id == $editSubCategories->parent_id) selected @endif>{{ $sub_category->name }}</option>
                    @endforeach
                </select>
                @error('parent_id')
                    <span id="parent_id-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="pt-4">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <a href="{{ route('backend_all_main_categories') }}" type="reset" class="btn btn-label-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>

    $(document).ready(function () {
        $(document).on('keyup', '#name', function(){
            var name = $(this).val();
            $.ajax({
                url: '{{ route('backend_create_sub_category_slug') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name : name,
                    // id : '{{ $editSubCategories->id }}'
                },
                success: function (response) {
                    console.log(response.slug);
                    if( response.status === 'success' ) {
                        $('#sulg-label').text(response.slug);
                        $('#slug').val(response.slug);
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
@endsection