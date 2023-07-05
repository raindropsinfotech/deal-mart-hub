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
                    <img class="img-fluid rounded my-4" src="../../assets/img/avatars/10.png" height="110" width="110" alt="User avatar" />
                    <div class="user-info text-center">
                        <h4 class="mb-2">Violet Mendoza</h4>
                        <span class="badge bg-label-secondary">Author</span>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-around flex-wrap my-4 py-3">
                <div class="d-flex align-items-start me-4 mt-3 gap-3">
                    <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-check bx-sm'></i></span>
                    <div>
                        <h5 class="mb-0">1.23k</h5>
                        <span>Tasks Done</span>
                    </div>
                </div>
                <div class="d-flex align-items-start mt-3 gap-3">
                    <span class="badge bg-label-primary p-2 rounded"><i class='bx bx-customize bx-sm'></i></span>
                    <div>
                        <h5 class="mb-0">568</h5>
                        <span>Projects Done</span>
                    </div>
                </div>
            </div>
            <h5 class="pb-2 border-bottom mb-4">Details</h5>
            <div class="info-container">
                <ul class="list-unstyled">
                    <li class="mb-3">
                    <span class="fw-bold me-2">Username:</span>
                    <span>violet.dev</span>
                </li>
                <li class="mb-3">
                    <span class="fw-bold me-2">Email:</span>
                    <span>vafgot@vultukir.org</span>
                </li>
                <li class="mb-3">
                    <span class="fw-bold me-2">Status:</span>
                    <span class="badge bg-label-success">Active</span>
                </li>
                <li class="mb-3">
                    <span class="fw-bold me-2">Role:</span>
                    <span>Author</span>
                </li>
                <li class="mb-3">
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
                </li>
            </ul>
            <div class="d-flex justify-content-center pt-3">
                <a href="javascript:;" class="btn btn-primary me-3" data-bs-target="#editUser" data-bs-toggle="modal">Edit</a>
                <a href="javascript:;" class="btn btn-label-danger suspend-user">Suspended</a>
            </div>
        </div>
      </div>
    </div>
    <!-- /User Card -->
    </div>
    <!--/ User Sidebar -->

    <!-- User Content -->
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
    <!-- User Pills -->
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i>Account</a></li>
      <li class="nav-item"><a class="nav-link" href="app-user-view-security.html"><i class="bx bx-lock-alt me-1"></i>Security</a></li>
      <li class="nav-item"><a class="nav-link" href="app-user-view-billing.html"><i class="bx bx-detail me-1"></i>Billing & Plans</a></li>
      <li class="nav-item"><a class="nav-link" href="app-user-view-notifications.html"><i class="bx bx-bell me-1"></i>Notifications</a></li>
      <li class="nav-item"><a class="nav-link" href="app-user-view-connections.html"><i class="bx bx-link-alt me-1"></i>Connections</a></li>
    </ul>
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