@extends('layouts.admin-app')
@php
    $pagename = 'Edit '.$editRole->name.' Role';
@endphp
@section('page-header', $pagename)
@section('page-title-header', $pagename)

@section('page-breadcrumbs')
<li class="breadcrumb-item">
    <a href="{{ route('backend_roles') }}">Roles Management</a>
</li>
<li class="breadcrumb-item active">Edit {{ $editRole->name }} Role</li>
@endsection

@section('content')
<div class="card mb-4">
    <form class="card-body" method="POST" action="{{ route('backend_update_role',['update_id'=>$editRole->id]) }}" enctype="multipart/form-data" id="createRole">
    @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Enter Role Name" value="{{ old('name') ?? $editRole->name }}">
                <div class="form-text text-info"> Please type role name ex:abc, abc-def, do not use space. </div>
                @error('name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="pt-4">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <a href="{{ route('backend_roles') }}" type="reset" class="btn btn-label-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection