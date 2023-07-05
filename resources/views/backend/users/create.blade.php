@extends('layouts.admin-app')

@section('page-header', 'Create User')
@section('page-title-header', 'Create User')

@section('page-breadcrumbs')
<li class="breadcrumb-item">
    <a href="{{ route('backend_all_users') }}">Users Management</a>
</li>
<li class="breadcrumb-item active">Create User</li>
@endsection

@section('css')
@endsection

@section('content')
<div class="card mb-4">
    <form class="card-body" method="POST" action="{{ route('backend_store_user') }}" enctype="multipart/form-data" id="createUser">
    @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control  @error('name') is-invalid @enderror" placeholder="Enter Name" value="{{ old('name') }}">
                @error('name')
                    <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <label class="form-label" for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email" value="{{ old('email') }}" aria-describedby="multicol-email2">
                @error('email')
                    <span id="email-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="form-password-toggle">
                    <label class="form-label" for="password">Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="multicol-password2" />
                        <span class="input-group-text cursor-pointer" id="multicol-password2"><i class="bx bx-hide"></i></span>
                        @error('password')
                            <span id="password-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-password-toggle">
                    <label class="form-label" for="cpassword">Confirm Password</label>
                    <div class="input-group input-group-merge">
                        <input type="password" name="cpassword" id="cpassword" class="form-control @error('cpassword') is-invalid @enderror" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="multicol-confirm-password2" />
                        <span class="input-group-text cursor-pointer" id="multicol-confirm-password2"><i class="bx bx-hide"></i></span>
                        @error('cpassword')
                            <span id="cpassword-error" class="error invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label" for="role">Role</label>
                <select name="role" id="role" class="form-select text-capitalize @error('role') is-invalid @enderror">
                    <option value=""> Select Role </option>
                    @foreach( $getRoles as $key => $role )
                        <option value="{{ $role->id }}" data-role="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role')
                    <span id="role-error" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            {{-- <div class="col-md-6">
                <div class="form-password-toggle">
                    <label class="form-label" for="profile_img">Profile Image</label>
                    <input type="file" class="form-control @error('profile_img') is-invalid @enderror" name="profile_img" id="profile_img" value="{{ old('profile_img') }}">
                    @error('profile_img')
                        <span id="profile_img-error" class="error invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <img src="" alt="" id="preview-image-before-upload" style="max-height: 125px;">
                    <button type="button" class="btn btn-outline-danger btn-sm remove-image"><i class="far fa-times-circle"></i></button>
                </div>
            </div> --}}
        </div>
        <div class="pt-4">
            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            <a href="{{ route('backend_all_users') }}" type="reset" class="btn btn-label-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

@section('js')
<script>

    $(document).ready(function () {

        $('#profile_img').change(function(){
            console.log(this.files);
            let reader = new FileReader();
            reader.onload = (e) => {
                $('.remove-image').show();
                $('#preview-image-before-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $(document).on('click', '.remove-image', function(){
            $('#profile_img').val(null);
            $('#preview-image-before-upload').attr('src','');
            $(this).hide();
        });
    });
</script>
@endsection