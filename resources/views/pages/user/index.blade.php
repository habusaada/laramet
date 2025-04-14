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


                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="pt-6 border-0 card-header">

                        <!--begin::Card title-->
                        <div class="card-title">

                            <!--begin::Search-->
                            <div class="my-1 d-flex align-items-center position-relative">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                            rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" data-kt-docs-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-14" placeholder="Search in Users" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">

                            <!--begin::Wrapper-->
                            <div class="mb-5 d-flex flex-stack">
                                <!--begin::Toolbar-->
                                <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                                    <!--begin::Export to Excel-->
                                    <a href="{{ route('user.export') }}" class="fw-bolder btn btn-sm btn-light-primary me-3"
                                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse fw-light fs-5"
                                        title="تصدير الجدول إلى ملف إكسل"><i class="fa-regular fa-file-excel fs-2"></i>
                                        Export to Excel
                                    </a>
                                    <!--begin::Export to Excel-->
                                    <!--begin::Add customer-->
                                    <a href="{{ route('user.create') }}" class="fw-bolder btn btn-sm btn-primary"
                                        data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse fw-light fs-5"
                                        title="Add New">
                                        <i class="fa-solid fa-file-circle-plus fs-2"></i>
                                        Add New User
                                    </a>
                                    <!--end::Add customer-->
                                </div>
                                <!--end::Toolbar-->

                                <!--begin::Group actions-->
                                <div class="d-flex justify-content-end align-items-center d-none"
                                    data-kt-docs-table-toolbar="selected">
                                    <div class="fs-base fw-bold me-5">
                                        <span class="me-2" data-kt-docs-table-select="selected_count"></span>صف تم تحديده
                                    </div>
                                    <button id="deleteSelected" type="button" class="btn btn-sm btn-danger"
                                        data-kt-user-table-select="delete_selected">حذف المحدد</button>
                                </div>
                                <!--end::Group actions-->
                            </div>
                            <!--end::Wrapper-->

                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="py-4 card-body">
                        <!--begin::Table-->

                        <!--begin::Datatable-->
                        <table id="kt_datatable_user" class="table align-middle table-striped table-rounded gy-3 gs-7">
                            <thead>
                                <tr class="text-gray-800 border-gray-200 fw-bold fs-6 border-bottom-2">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_datatable_user .row-checkbox"
                                                value="1" />
                                        </div>
                                    </th>
                                    <th class="text-start min-w-100px">ID</th>
                                    <th class="text-start min-w-100px">Name</th>
                                    <th class="text-start min-w-100px">Email</th>
                                    <th class="text-start min-w-100px">Profile Status</th>
                                    <th class="text-start min-w-100px">Email Verified</th>
                                    <th class="text-start min-w-100px">Active</th>
                                    <th class="text-start min-w-50px">Created at</th>
                                    <th class="text-end min-w-100px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-regular">
                            </tbody>
                        </table>
                        <!--end::Datatable-->

                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
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
                                data: 'profile_id'
                            },
                            {
                                data: 'name'
                            },
                            {
                                data: 'email'
                            },
                            {
                                data: 'is_verified',
                                className: 'text-center'
                            },
                            {
                                data: 'status',
                                className: 'text-center'
                            },
                            {
                                data: 'is_active',
                                className: 'text-center'
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
                                <input class="form-check-input row-checkbox" type="checkbox" value="${data}" />
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
                                        return `<i class="ki-duotone ki-verify text-success fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    </i>`;
                                    } else {
                                        return `<i class="ki-duotone ki-verify text-primary fs-1">
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
                                        'badge-light-success' : 'badge-light-primary';
                                    return `<span class="badge ${badgeClass} badge-square fw-normal py-2 px-4">${data}</span>`;
                                }
                            },
                            {
                                targets: 6,
                                orderable: false,
                                render: function(data, type, row, meta) {
                                    const checked = data === 1 || data === '1' ? 'checked' : '';
                                    const id = `switch_${row.id}`;
                                    return `<div class="form-check form-switch form-check-custom form-check-solid toggle">
                                                <input class="form-check-input h-20px w-40px" name="is_active" type="checkbox" value="${row.id}" id="${id}" ${checked} data-user-id="${row.id}" />
                                            </div>
                                        `;
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
        <button class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_${row.id}" data-bs-toggle="tooltip" data-bs-experiencement="top" title="Delete Data">
            <i class="fas fa-trash-alt"></i>
        </button>
        <div class="modal fade" tabindex="-1" id="kt_modal_${row.id}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Deletion</h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                            <span class="svg-icon svg-icon-2x"></span>
                        </div>
                        <!--end::Close-->
                    </div>
                    <div class="modal-body text-start">
                        <h6 class="text-muted">
                            Are you sure you want to delete the data?
                        </h6>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>

                        <form method="POST" action="{{ route('user.destroy', '') }}/${row.id}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Confirm</button>
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
                    const checkboxes = container.querySelectorAll('.row-checkbox');

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
                    const allCheckboxes = container.querySelectorAll('tbody .row-checkbox');

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


        $(document).on('change', '.form-check-input[type="checkbox"]', function () {
        const userId = $(this).data('user-id');
        const isActive = $(this).is(':checked') ? 1 : 0;

        $.ajax({
            url: `/user/${userId}/toggle-status`, // 👈 your update route
            method: 'POST',
            data: {
                is_active: isActive,
                _token: '{{ csrf_token() }}' // 👈 required for Laravel POST requests
            },
            success: function(response) {
                console.log('Status updated:', response.message);
                // Optionally show a toast or flash message
            },
            error: function(xhr) {
                console.error('Failed to update status');
                alert('Error updating status');
            }
        });
    });
    </script>
@endsection
