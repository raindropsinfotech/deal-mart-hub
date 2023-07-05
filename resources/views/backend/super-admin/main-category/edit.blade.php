@extends('layouts.admin-app')

@section('page-header', 'Create Main Category')
@section('page-title-header', 'Create Main Category')

@section('page-breadcrumbs')
<li class="breadcrumb-item">
    <a href="{{ route('backend_all_main_categories') }}">Main Categories</a>
</li>
<li class="breadcrumb-item active">Create Main Category</li>
@endsection

@section('content')
<div class="card mb-4">
    <form class="card-body" method="POST" action="{{ route('backend_update_main_category',['update_id' => $editMainCategories->id]) }}" enctype="multipart/form-data" id="createUser">
    @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Enter Name" value="{{ old('name') ?? $editMainCategories->name}}">
                @error('name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="slug">Slug</label>
                {{-- <p class="fw-bold" id="sulg-label">{{ $editMainCategories->slug }}</p> --}}
                <input type="text" name="slug" id="slug" class="form-control  @error('slug') is-invalid @enderror" placeholder="Slug" value="{{ old('slug') ?? $editMainCategories->slug }}">
                @error('slug')
                    <span id="slug-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="pt-4">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Update</button>
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
                url: '{{ route('backend_create_main_category_slug') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    name : name,
                    // id : '{{ $editMainCategories->id }}'
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