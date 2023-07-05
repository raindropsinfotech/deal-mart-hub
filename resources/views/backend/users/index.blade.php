@extends('layouts.admin-app')

@section('page-header', 'Users Management')
@section('page-title-header', 'Users Management')

@section('page-breadcrumbs')
<li class="breadcrumb-item active">Users Management</li>
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
<div class="row">
  <!-- Left col -->
    <section class="col-lg-12">
        <div class="card">
            <div class="card-datatable table-responsive">
                <div class="card-header flex-column flex-md-row border-bottom">
                    {{-- <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons btn-group flex-wrap">
                            <a href="{{ route('backend_create_user') }}" class="btn btn-secondary create-new btn-label-primary">
                                <span>
                                    <i class="bx bx-user-plus me-md-2"></i>
                                    <span class="d-none d-sm-inline-block">Add User</span>
                                </span>
                            </a>
                        </div>
                    </div> --}}
                    <div class="d-flex justify-content-start align-items-center row py-3 gap-3 gap-md-0">
                        <div class="col-md-3 user_role">
                            <select name="roles" id="roles" class="form-select text-capitalize">
                                <option value=""> Select Role </option>
                                @foreach( $getRoles as $k => $role )
                                    <option value="{{ $role->name }}" data-role="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 user_status">
                            <select name="status" id="status" class="form-select text-capitalize">
                                <option value=""> Select Status </option>
                                <option value="Active"> Active </option>
                                <option value="Inactive"> Inactive </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('backend_create_user') }}" class="btn btn-secondary create-new btn-label-primary">
                                <span>
                                    <i class="bx bx-user-plus me-md-2"></i>
                                    <span class="d-none d-sm-inline-block">Add User</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
                <table class="users-table table border-top">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full name</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $users as $key => $user )
                        <tr>
                            <td class="text-center" width="10">{{ $key+1 }}</td>
                            <td>
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar avatar-sm me-3">
                                            @if( empty( $user->profile_img ) )
                                            <img src="{{asset('storage/upload/dummy.png')}}" alt="{{ $user->name }}" class="rounded-circle">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <a href="" class="text-body text-truncate">
                                            <span class="fw-semibold">{{ $user->name }}</span>
                                        </a>
                                        <small class="text-muted">{{ $user->email }}</small>
                                    </div>
                                </div>
                            </td>

                            <td>
                                @if($user->roles)
                                    @foreach( $user->roles as $rkey => $role )
                                        @if( $role->name == 'merchent')
                                            <span class="text-truncate d-flex align-items-center text-capitalize">
                                                <span class="badge badge-center rounded-pill bg-label-primary w-px-30 h-px-30 me-2">
                                                    <i class="bx bx-pie-chart-alt bx-xs"></i>
                                                </span>
                                                {{ $role->name }}
                                            </span>
                                        @elseif( $role->name == 'customer1' || $role->name == 'customer')
                                            <span class="text-truncate d-flex align-items-center text-capitalize">
                                                <span class="badge badge-center rounded-pill bg-label-warning w-px-30 h-px-30 me-2">
                                                    <i class="bx bx-user bx-xs"></i>
                                                </span>
                                                {{ $role->name }}
                                            </span>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if($user->trashed())
                                    <span class="badge bg-label-secondary">Inactive</span>
                                @else
                                    <span class="badge bg-label-success">Active</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <form action="" method="POST" id="confirm_delete">
                                    @csrf
                                    <a href="{{ route('backend_edit_user',['edit_id' => $user->id]) }}" class="btn btn-icon btn-outline-primary"  data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-custom-class="tooltip-primary" data-bs-html="true" data-bs-original-title="Edit">
                                        <span class="tf-icons bx bx-edit-alt"></span>
                                    </a>

                                    <button type="button" class="btn btn-icon btn-outline-danger show-alert-delete-box" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="right" data-bs-custom-class="tooltip-danger" data-bs-html="true" data-bs-original-title="Delete">
                                        <span class="tf-icons bx bx-trash-alt"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection

@section('js')
  <script src="{{ asset('backend/sneat/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
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

    $('.users-table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language" : {
            'emptyTable' : "No Users records",
            'paginate' : {
                'previous' : "Previous",
                'next' : "Next",
            }
        },
    });
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