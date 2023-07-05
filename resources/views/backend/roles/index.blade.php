@extends('layouts.admin-app')

@section('page-header', 'Roles Management')
@section('page-title-header', 'Roles Management')

@section('page-breadcrumbs')
<li class="breadcrumb-item active">Roles Management</li>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('backend/sneat/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('backend/sneat/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('backend/sneat/assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
<link rel="stylesheet" href="{{ asset('backend/sneat/assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('backend/sneat/assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<!-- Row Group CSS -->
<link rel="stylesheet" href="{{ asset('backend/sneat/assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">

<!-- SweetAlerts -->
<link rel="stylesheet" href="{{ asset('backend/sneat/assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />

<link rel="stylesheet" href="{{ asset('backend/sneat/assets/vendor/libs/toastr/toastr.css') }}" />
<link rel="stylesheet" href="{{ asset('backend/sneat/assets/vendor/libs/animate-css/animate.css') }}" />
@endsection

@section('content')
<div class="row g-4 mb-5">
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card h-100">
            <div class="row h-100">
                <div class="col-sm-5">
                    <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                        <img src="{{ asset('backend/sneat/assets/img/illustrations/sitting-girl-with-laptop-light.png') }}" class="img-fluid" alt="Image" width="120">
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="card-body text-sm-end text-center ps-sm-0">
                        <a href="{{ route('backend_create_role') }}" class="btn btn-primary mb-3 text-nowrap add-new-role">Add New Role</a>
                        <p class="mb-0">Add role, if it does not exist</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Existing roles -->
<div class="row g-4">
    @foreach ($getRoles as $key => $role)
        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="fw-normal">Total <strong>{{ $role->users_count }}</strong> users</h6>
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="role-heading">
                            <h4 class="mb-1">{{ $role->name }}</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('backend_edit_role',['edit_id'=>$role->id]) }}" class="btn btn-sm btn-icon btn-outline-primary"  data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-custom-class="tooltip-primary" data-bs-html="true" data-bs-original-title="Edit">
                                    <span class="tf-icons bx bx-edit-alt"></span>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ route('backend_delete_role', ['delete_id'=>$role->id]) }}" method="POST" id="confirm_delete">
                                    @csrf
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-danger show-alert-delete-box" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-custom-class="tooltip-danger" data-bs-html="true" data-bs-original-title="Delete">
                                        <span class="tf-icons bx bx-trash-alt"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('js')
  <script src="{{ asset('backend/sneat/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
  {{-- <script src="{{ asset('backend/sneat/assets/js/tables-datatables-basic.js') }}"></script> --}}
  <script src="{{ asset('backend/sneat/assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
  <script src="{{ asset('backend/sneat/assets/js/extended-ui-sweetalert2.js') }}"></script>
  <script src="{{ asset('backend/sneat/assets/vendor/libs/toastr/toastr.js') }}"></script>
  <script type="text/javascript">
    // Display toaster msg
    @if(Session::has('success'))
        toastr.options = {
            "showEasing" : "swing",
            "showMethod" : "fadeIn",
            "hideEasing" : "linear",
            "hideMethod" : "fadeOut",
            "closeMethod" : "fadeOut",
            "closeEasing" : "linear",
            "closeButton" : true,
            "progressBar" : true ,
            "delay": 3000
        };
        toastr.success("{{ session('success') }}");
    @endif

    $(document).on('click','.show-alert-delete-box',function(event){
        var form =  $(this).closest("form");
        var name = $(this).data("name");
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure you want to delete this record?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
  </script>
@endsection