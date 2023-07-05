@extends('layouts.admin-app')

@section('page-header', 'Sub Categories')
@section('page-title-header', 'Sub Categories')

@section('page-breadcrumbs')
<li class="breadcrumb-item active">Sub Categories</li>
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
                    <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                        <div class="col-md-4 main_categories">
                            <select id="main_categories" class="form-select text-capitalize">
                                <option value=""> Select Main Category </option>
                                @foreach( $getMainCategories as $key => $mainCategory )
                                    <option value="{{$mainCategory->name}}">{{$mainCategory->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-md-4 super_admins"></div> --}}
                    </div>
                </div>
                <table class="sub-categories-table table border-top">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>Slug</th>
                            <th>Main Category</th>
                            <th>Parent Category</th>
                            <th>Created By</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getSubCategories as $key => $sub_category)
                            <tr>
                                <td class="text-center" width="10">{{ $key+1 }}</td>
                                <td class="" width="">{{ $sub_category->name }}</td>
                                <td class="" width="">{{ $sub_category->slug }}</td>
                                <td class="" width="">
                                    <span class="badge bg-label-primary">{{ $sub_category->getMainCategories->name }}</span>
                                </td>
                                <td class="" width="">
                                    @if($sub_category->getParentCategories)
                                        <span class="badge bg-label-info">{{ $sub_category->getParentCategories->name }}</span>
                                    @endif
                                </td>
                                <td class="" width="">{{ $sub_category->getAuthor->name }}</td>
                                <td class="text-center">
                                    <form action="{{ route('backend_delete_sub_category',['delete_id' => $sub_category->id]) }}" method="POST" id="confirm_delete">
                                        @csrf
                                        <a href="{{ route('backend_edit_sub_category',['edit_id' => $sub_category->id]) }}" class="btn btn-icon btn-outline-primary"  data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="left" data-bs-custom-class="tooltip-primary" data-bs-html="true" data-bs-original-title="Edit">
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

    @if(Session::has('error'))
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
        toastr.error("{{ session('error') }}");
    @endif

    $('.sub-categories-table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language" : {
            'emptyTable' : "No Sub Categories found",
            'paginate' : {
                'previous' : "Previous",
                'next' : "Next",
            }
        },
        "dom":
            '<"row mx-2"<"col-md-2"<"me-3"l>><"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',

        "buttons": [
            {
                "text": '<i class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add Sub Category</span>',
                "className": "btn btn-secondary btn-label-primary me-0 mx-3",
                action: function () {
                  window.location.href = "{{ route('backend_create_sub_category') }}";
                },
                attr: { "href" : "{{ route('backend_create_sub_category') }}" },
            },
        ],
        "responsive": {
            "details": {
                "display": $.fn.dataTable.Responsive.display.modal({
                    header: function (e) {
                        return "Details of " + e.data().full_name;
                    },
                }),
                "type": "column",
                renderer: function (e, t, a) {
                    a = $.map(a, function (e, t) {
                        return "" !== e.title ? '<tr data-dt-row="' + e.rowIndex + '" data-dt-column="' + e.columnIndex + '"><td>' + e.title + ":</td> <td>" + e.data + "</td></tr>" : "";
                    }).join("");
                    return !!a && $('<table class="table"/><tbody />').append(a);
                },
            },
        },

    });
    // Remove class from DT Default search and page shorting boxes
    setTimeout(() => {
        $(".dataTables_filter .form-control").removeClass("form-control-sm"), $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 100);

    $( document ).on('change', '#main_categories', function(){
        var main_cat = $(this).val();
        if( main_cat ) {
            $('.sub-categories-table').DataTable().column(3).search('\\b' + $.fn.dataTable.util.escapeRegex(main_cat) + '\\b', true, false).draw();
        } else {
            $('.sub-categories-table').DataTable().column(3).search('').draw();
        }
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