@extends('layouts.admin-app')

@section('page-header', 'Edit User')
@section('page-title-header', 'Edit User')

@section('page-breadcrumbs')
<li class="breadcrumb-item">
    <a href="{{ route('backend_all_users') }}">Users Management</a>
</li>
<li class="breadcrumb-item active">Edit User</li>
@endsection

@section('css')

@endsection

@section('content')
<div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
        <!-- User Card -->
        <div class="card mb-4">
        <div class="card-body">
            <div class="user-avatar-section">
                <div class=" d-flex align-items-center flex-column">
                    <img class="img-fluid rounded my-4" src="{{asset('storage/upload/dummy.png')}}" height="110" width="110" alt="{{$editUser->name}}" />
                    <div class="user-info text-center">
                        <h4 class="mb-2">{{$editUser->name}}</h4>
                        <span class="badge bg-label-secondary">{{ $editUser->roles[0]->name }}</span>
                    </div>
                </div>
            </div>

            <h5 class="pb-2 border-bottom mb-4">Details</h5>
            <div class="info-container">
                <ul class="list-unstyled">
                    <li class="mb-3">
                    <span class="fw-bold me-2">Name:</span>
                    <span>{{$editUser->name}}</span>
                </li>
                <li class="mb-3">
                    <span class="fw-bold me-2">Email:</span>
                    <span><a href="mailto:{{$editUser->email}}">{{$editUser->email}}</a></span>
                </li>
                <li class="mb-3">
                    <span class="fw-bold me-2">Status:</span>
                    @if($editUser->trashed())
                        <span class="badge bg-label-secondary">Inactive</span>
                    @else
                        <span class="badge bg-label-success">Active</span>
                    @endif
                </li>
                <li class="mb-3">
                    <span class="fw-bold me-2">Role:</span>
                    <span class="text-truncate text-capitalize">{{$editUser->roles[0]->name}}</span>
                </li>
                {{-- <li class="mb-3">
                    <span class="fw-bold me-2">Tax id:</span>
                    <span>Tax-8965</span>
                </li>
                <li class="mb-3">
                    <span class="fw-bold me-2">Contact:</span>
                    <span>(123) 456-7890</span>
                </li>
                <li class="mb-3">
                    <span class="fw-bold me-2">Languages:</span>
                    <span>French</span>
                </li>
                <li class="mb-3">
                    <span class="fw-bold me-2">Country:</span>
                    <span>England</span>
                </li> --}}
            </ul>
            {{-- <div class="d-flex justify-content-center pt-3">
                <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
                <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspended</a>
            </div> --}}
        </div>
      </div>
    </div>
    <!-- /User Card -->
    </div>
    <!--/ User Sidebar -->

    <!-- User Content -->
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">

    </div>
    <!--/ User Pills -->
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