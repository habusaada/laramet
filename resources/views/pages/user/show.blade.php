@extends('mainLayout')

@section('title')
    <title>{{ config('app.name') }} | {{ $data['options']['page_title'] }}</title>
@endsection


@section('stylesheet')
@endsection

@section('content')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">

        @component('components.akkim-components.tool-bar', ['options' => $data['options']])
        @endcomponent
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">

                @include('partials._messages')


                <div class="flex-column flex-lg-row-auto mb-10">
                    <!--begin::Card-->
                    <div class="card mb-5 mb-xl-8">
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Summary-->
                            <!--begin::User Info-->
                            <div class="d-flex flex-center flex-column py-5">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-100px symbol-circle mb-7">
                                    <img src="{{ Auth::user()->getFirstMediaUrl('user_image') ?: url('template/demo1/assets/media/avatars/blank.png') }}" alt="image" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Name-->
                                <a href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $data['user']->name }}</a>
                                <!--end::Name-->

                                <!--begin::Position-->
                                <div class="mb-9">
                                    <!--begin::Badge-->
                                    <div class="badge badge-lg badge-light-primary d-inline">{{ $data['user']->getRoleNames()->first() ? $data['user']->getRoleNames()->first() : 'Unsigned Role' }}</div>
                                    <!--begin::Badge-->
                                </div>
                                <!--end::Position-->
                                <!--begin::Info-->
                                <div class="text-gray-600 w-50 mb-7">{{ $data['user']->profile->bio ?  $data['user']->profile->bio : 'N/A'}}</div>
                                {{-- <!--begin::Info heading-->
                                <div class="fw-bold mb-3">Assigned Tickets
                                <span class="ms-2" ddata-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Number of support tickets assigned, closed and pending this week.">
                                    <i class="ki-duotone ki-information fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span></div>
                                <!--end::Info heading--> --}}
                                {{-- <div class="d-flex flex-wrap flex-center">
                                    <!--begin::Stats-->
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fs-4 fw-bold text-gray-700">
                                            <span class="w-75px">243</span>
                                            <i class="ki-duotone ki-arrow-up fs-3 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <div class="fw-semibold text-muted">Total</div>
                                    </div>
                                    <!--end::Stats-->
                                    <!--begin::Stats-->
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                        <div class="fs-4 fw-bold text-gray-700">
                                            <span class="w-50px">56</span>
                                            <i class="ki-duotone ki-arrow-down fs-3 text-danger">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <div class="fw-semibold text-muted">Solved</div>
                                    </div>
                                    <!--end::Stats-->
                                    <!--begin::Stats-->
                                    <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                        <div class="fs-4 fw-bold text-gray-700">
                                            <span class="w-50px">188</span>
                                            <i class="ki-duotone ki-arrow-up fs-3 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                        <div class="fw-semibold text-muted">Open</div>
                                    </div>
                                    <!--end::Stats-->
                                </div> --}}
                                <!--end::Info-->
                            </div>
                            <!--end::User Info-->
                            <!--end::Summary-->
                            <!--begin::Details toggle-->
                            <div class="d-flex flex-stack fs-4 py-3">
                                <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Details
                                <span class="ms-2 rotate-180">
                                    <i class="ki-duotone ki-down fs-3"></i>
                                </span></div>
                                <span>
                                    <a href="{{ route('user.edit', $data['user']->id) }}" class="btn btn-sm btn-light-primary">Edit</a>
                                    <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">Users List</a>
                                </span>
                            </div>
                            <!--end::Details toggle-->
                            <div class="separator"></div><!--begin::Details content-->
                            <div id="kt_user_view_details" class="collapse show">
                                <div class="pb-5 fs-6">
                                    <div class="row">
                                        <!-- Column 1 -->
                                        <div class="col-12 col-md-4">
                                            <div class="fw-bold mt-5">Account ID</div>
                                            <div class="text-gray-600">{{ $data['user']->profile->profile_id ? $data['user']->profile->profile_id : 'N/A'}}</div>

                                            <div class="fw-bold mt-5">Email</div>
                                            <div class="text-gray-600">{{ $data['user']->email ? $data['user']->email : 'N/A' }}</div>

                                            <div class="fw-bold mt-5">Company Name</div>
                                            <div class="text-gray-600">{{ $data['user']->profile->company_name ? $data['user']->profile->company_name : 'N/A' }}</div>

                                            <div class="fw-bold mt-5">Job Title</div>
                                            <div class="text-gray-600">{{ $data['user']->profile->job_title ? $data['user']->profile->job_title : 'N/A' }}</div>
                                        </div>

                                        <!-- Column 2 -->
                                        <div class="col-12 col-md-4">
                                            <div class="fw-bold mt-5">Company Location</div>
                                            <div class="text-gray-600">
                                                <a href="#" class="text-gray-600 text-hover-primary">{{ $data['user']->profile->company_location ? $data['user']->profile->company_location : 'N/A' }}</a>
                                            </div>

                                            <div class="fw-bold mt-5">Phone Number</div>
                                            <div class="text-gray-600">{{ $data['user']->profile->phone_number ? $data['user']->profile->phone_number : 'N/A' }}</div>

                                            <div class="fw-bold mt-5">Date of Birth</div>
                                            <div class="text-gray-600">{{ $data['user']->profile->date_of_birth ? $data['user']->profile->date_of_birth : 'N/A' }}</div>

                                            <div class="fw-bold mt-5">Gender</div>
                                            <div class="text-gray-600">{{ $data['user']->profile->gender ? $data['user']->profile->gender : 'N/A' }}</div>
                                        </div>

                                        <!-- Column 3 -->
                                        <div class="col-12 col-md-4">
                                            <div class="fw-bold mt-5">Address</div>
                                            <div class="text-gray-600">{{ $data['user']->profile->address ? $data['user']->profile->address : 'N/A' }}</div>

                                            <div class="fw-bold mt-5">Status</div>
                                            <div>
                                                @php
                                                    $status = $data['user']->profile->status;
                                                    $badgeClass = match($status) {
                                                        'approved' => 'badge badge-light-success',
                                                        'pending' => 'badge badge-light-warning',
                                                        'rejected' => 'badge badge-light-danger',
                                                        default => 'badge badge-light-secondary',
                                                    };
                                                @endphp

                                                <span class="{{ $badgeClass }}">{{ ucfirst($status) ? ucfirst($status) : 'N/A' }}</span>
                                            </div>

                                            <div class="fw-bold mt-5">Rejection Reason</div>
                                            <div class="text-gray-600">{{ $data['user']->profile->rejection_reason ?  $data['user']->profile->rejection_reason : 'N/A'}}</div>

                                            <div class="fw-bold mt-5">Last Login at</div>
                                            <div class="text-gray-600">{{ $data['user']->profile->last_login_at ? $data['user']->profile->last_login_at : 'N/A'}}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Details content-->

                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection

@section('javascript')
    <script src="{{ url('template/demo1/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {

            "use strict";

            var hostUrl = "{{ url('/') }}"; // Blade syntax to inject the value
            // alert(hostUrl);
            // Class definition
            var KTDatatablesServerSide = function() {
                // Shared variables
                var table;
                var dt;
                var filterPayment;

                // Private functions
                var initDatatable = function() {
                    dt = $("#kt_datatable_user").DataTable({
                        searchDelay: 500,
                        processing: true,
                        serverSide: true,
                        debug: true,
                        order: [
                            [4, 'desc']
                        ],
                        stateSave: true,
                        select: {
                            style: 'multi',
                            selector: 'td:first-child input[type="checkbox"]',
                            className: 'row-selected'
                        },
                        ajax: {
                            url: "{{ route('datatable.user') }}",
                            type: "GET",
                            error: function(xhr, error, thrown) {
                                console.error("AJAX Error:", xhr, error, thrown);
                            }
                        },
                        pageLength: 10, // Number of records per page
                        lengthMenu: [10, 25, 50, 100], // Options for number of records per page
                        columns: [{
                                data: 'id'
                            },
                            {
                                data: 'name'
                            },
                            {
                                data: 'email'
                            },
                            {
                                data: 'status'
                            },
                            {
                                data: 'is_verified',
                                className: 'text-center'
                            },
                            {
                                data: 'is_active'
                            },
                            {
                                data: 'created_at'
                            },
                            {
                                data: null
                            }, // This can be used for rendering custom content
                        ],
                        columnDefs: [{
                                targets: 0,
                                orderable: false,
                                render: function(data) {
                                    return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="${data}" />
                            </div>`;
                                }
                            },
                            {
                                targets: 3,
                                orderable: false,
                                render: function(data) {

                                    let badgeClass = '';
                                    let label = '';

                                    switch (data) {
                                        case 'pending':
                                            badgeClass = 'badge-light-warning';
                                            label = 'Pending';
                                            break;
                                        case 'under_review':
                                            badgeClass = 'badge-light-info';
                                            label = 'Under Review';
                                            break;
                                        case 'approved':
                                            badgeClass = 'badge-light-success';
                                            label = 'Approved';
                                            break;
                                        case 'rejected':
                                            badgeClass = 'badge-light-danger';
                                            label = 'Rejected';
                                            break;
                                        default:
                                            badgeClass = 'badge-light-secondary';
                                            label = data;
                                    }

                                    return `<span class="badge ${badgeClass} badge-square fw-normal py-2 px-4 text-capitalize">${label}</span>`;

                                }
                            },
                            {
                                targets: 4,
                                orderable: false,
                                render: function(data) {
                                    if (data === true || data === 1 || data === '1') {
                                        return `<i class="ki-duotone ki-verify text-primary fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    </i>`;
                                    } else {
                                        return `<i class="ki-duotone ki-verify text-lgiht fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    </i>`;
                                    }
                                }
                            },
                            {
                                targets: 5,
                                orderable: false,
                                render: function(data) {
                                    let badgeClass = data === 'Active' ?
                                        'badge-light-success' : 'badge-light-danger';
                                    return `<span class="badge ${badgeClass} badge-square fw-normal py-2 px-4">${data}</span>`;
                                }
                            },
                            {
                                targets: -1,
                                data: 'id',
                                orderable: false,
                                className: 'text-end',
                                render: function(data, type, row) {
                                    return `<a href="{{ route('user.show', '') }}/${row.id}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/user/${row.id}/edit" class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button  class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_${row.id}" data-bs-toggle="tooltip" data-bs-experiencement="top" title="حذف البيانات">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <div class="modal fade" tabindex="-1" id="kt_modal_${row.id}">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">تأكيد الحذف</h5>

                                            <!--begin::Close-->
                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                <span class="svg-icon svg-icon-2x">

                                                </span>
                                            </div>
                                            <!--end::Close-->
                                        </div>
                                        <div class="modal-body text-start">
                                            <h6 class="text-muted">
                                            هل أنت متأكد من حذف البيانات؟
                                            </h6>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>

                                            <form  method="POST" action="{{ route('user.destroy', '') }}/${row.id}">
                                                @csrf
                                                @method('DELETE')
                                            <button type="submit" class="btn btn-danger">تأكيد</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>`;

                                },
                            },
                        ],
                        // Add data-filter attribute
                        createdRow: function(row, data, dataIndex) {
                            $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
                        }
                    });

                    table = dt.$;

                    // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
                    dt.on('draw', function() {
                        initToggleToolbar();
                        toggleToolbars();
                        handleDeleteRows();
                        KTMenu.createInstances();
                    });
                }

                // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
                var handleSearchDatatable = function() {
                    const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
                    filterSearch.addEventListener('keyup', function(e) {
                        dt.search(e.target.value).draw();
                    });
                }

                // Filter Datatable
                var handleFilterDatatable = () => {
                    // Select filter options
                    filterPayment = document.querySelectorAll(
                        '[data-kt-docs-table-filter="payment_type"] [name="payment_type"]');
                    const filterButton = document.querySelector('[data-kt-docs-table-filter="filter"]');

                    // Filter datatable on submit
                    filterButton.addEventListener('click', function() {
                        // Get filter values
                        let paymentValue = '';

                        // Get payment value
                        filterPayment.forEach(r => {
                            if (r.checked) {
                                paymentValue = r.value;
                            }

                            // Reset payment value if "All" is selected
                            if (paymentValue === 'all') {
                                paymentValue = '';
                            }
                        });

                        // Filter datatable --- official docs reference: https://datatables.net/reference/api/search()
                        dt.search(paymentValue).draw();
                    });
                }

                // Delete customer
                var handleDeleteRows = () => {
                    // Select all delete buttons
                    const deleteButtons = document.querySelectorAll(
                        '[data-kt-docs-table-filter="delete_row"]');

                    deleteButtons.forEach(d => {
                        // Delete button on click
                        d.addEventListener('click', function(e) {
                            e.preventDefault();

                            // Select parent row
                            const parent = e.target.closest('tr');

                            // Get customer name
                            const customerName = parent.querySelectorAll('td')[1].innerText;

                            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                            Swal.fire({
                                text: "Are you sure you want to delete " +
                                    customerName + "?",
                                icon: "warning",
                                showCancelButton: true,
                                buttonsStyling: false,
                                confirmButtonText: "Yes, delete!",
                                cancelButtonText: "No, cancel",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-danger",
                                    cancelButton: "btn fw-bold btn-active-light-primary"
                                }
                            }).then(function(result) {
                                if (result.value) {
                                    // Simulate delete request -- for demo purpose only
                                    Swal.fire({
                                        text: "Deleting " + customerName,
                                        icon: "info",
                                        buttonsStyling: false,
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(function() {
                                        Swal.fire({
                                            text: "You have deleted " +
                                                customerName + "!.",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary",
                                            }
                                        }).then(function() {
                                            // delete row data from server and re-draw datatable
                                            dt.draw();
                                        });
                                    });
                                } else if (result.dismiss === 'cancel') {
                                    Swal.fire({
                                        text: customerName +
                                            " was not deleted.",
                                        icon: "error",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    });
                                }
                            });
                        })
                    });
                }

                // Reset Filter
                var handleResetForm = () => {
                    // Select reset button
                    const resetButton = document.querySelector('[data-kt-docs-table-filter="reset"]');

                    // Reset datatable
                    resetButton.addEventListener('click', function() {
                        // Reset payment type
                        filterPayment[0].checked = true;

                        // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
                        dt.search('').draw();
                    });
                }

                // Init toggle toolbar
                var initToggleToolbar = function() {
                    // Toggle selected action toolbar
                    // Select all checkboxes
                    const container = document.querySelector('#kt_datatable_user');
                    const checkboxes = container.querySelectorAll('[type="checkbox"]');

                    // Select elements
                    const deleteSelected = document.querySelector('#deleteSelected');

                    // Toggle delete selected toolbar
                    checkboxes.forEach(c => {
                        // Checkbox on click event
                        c.addEventListener('click', function() {
                            setTimeout(function() {
                                toggleToolbars();
                            }, 50);
                        });
                    });

                    // Deleted selected rows
                    deleteSelected.addEventListener('click', function() {
                        Swal.fire({
                            text: "هل أنت متأكد أنك تريد حذف الصفوف المحددة؟",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            showLoaderOnConfirm: true,
                            confirmButtonText: "نعم, احذف!",
                            cancelButtonText: "لا, إالغاء",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton: "btn fw-bold btn-active-light-primary"
                            },
                        }).then(function(result) {
                            if (result.value) {
                                // Simulate delete request -- for demo purpose only
                                Swal.fire({
                                    text: "Deleting selected customers",
                                    icon: "info",
                                    buttonsStyling: false,
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(function() {
                                    Swal.fire({
                                        text: "You have deleted all selected customers!.",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary",
                                        }
                                    }).then(function() {
                                        // delete row data from server and re-draw datatable
                                        dt.draw();
                                    });

                                    // Remove header checked box
                                    const headerCheckbox = container
                                        .querySelectorAll('[type="checkbox"]')[0];
                                    headerCheckbox.checked = false;
                                });
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: "Selected customers was not deleted.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                });
                            }
                        });
                    });
                }

                // Toggle toolbars
                var toggleToolbars = function() {
                    // Define variables
                    const container = document.querySelector('#kt_datatable_user');
                    const toolbarBase = document.querySelector('[data-kt-docs-table-toolbar="base"]');
                    const toolbarSelected = document.querySelector(
                        '[data-kt-docs-table-toolbar="selected"]');
                    const selectedCount = document.querySelector(
                        '[data-kt-docs-table-select="selected_count"]');

                    // Select refreshed checkbox DOM elements
                    const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

                    // Detect checkboxes state & count
                    let checkedState = false;
                    let count = 0;

                    // Count checked boxes
                    allCheckboxes.forEach(c => {
                        if (c.checked) {
                            checkedState = true;
                            count++;
                        }
                    });

                    // Toggle toolbars
                    if (checkedState) {
                        selectedCount.innerHTML = count;
                        toolbarBase.classList.add('d-none');
                        toolbarSelected.classList.remove('d-none');
                    } else {
                        toolbarBase.classList.remove('d-none');
                        toolbarSelected.classList.add('d-none');
                    }
                }

                // Public methods
                return {
                    init: function() {
                        initDatatable();
                        handleSearchDatatable();
                        initToggleToolbar();
                        handleFilterDatatable();
                        handleDeleteRows();
                        handleResetForm();
                    }
                }
            }();

            // On document ready
            KTUtil.onDOMContentLoaded(function() {
                KTDatatablesServerSide.init();
            });

            // document.addEventListener('DOMContentLoaded', function () {
            //     KTDatatablesServerSide.init();
            // });
        });
    </script>
@endsection
