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
                                <input type="text" data-kt-docs-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-14" placeholder="Search places" />
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
                                    <!--begin::Filter-->
                                    <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="tooltip"
                                        title="Coming soon">
                                        <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span
                                                class="path2"></span></i>
                                        Filter
                                    </button>
                                    <!--end::Filter-->

                                    <!--begin::Add customer-->
                                    <a href="{{ route('permission.create') }}" class="btn btn-primary" data-bs-toggle="tooltip"
                                    data-bs-custom-class="tooltip-inverse fw-light fs-5" title="Add new">
                                        <i class="ki-duotone ki-plus fs-2"></i>
                                        Add Permissions
                                    </a>
                                    <!--end::Add customer-->
                                </div>
                                <!--end::Toolbar-->

                                <!--begin::Group actions-->
                                <div class="d-flex justify-content-end align-items-center d-none"
                                    data-kt-docs-table-toolbar="selected">
                                    <div class="fs-base fw-bold me-5">
                                        <span class="me-2" data-kt-docs-table-select="selected_count"></span>Row selected
                                    </div>
                                    <button id="deleteSelected" type="button" class="btn btn-danger"
                                        data-kt-user-table-select="delete_selected">Delete Selected</button>
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
                        <!--begin::Datatable-->
                        <table id="kt_datatable_permission" class="table align-middle table-striped table-rounded gy-3 gs-7">
                            <thead>
                                <tr class="text-gray-800 border-gray-200 fw-bold fs-6 border-bottom-2">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_datatable_permission .form-check-input"
                                                value="1" />
                                        </div>
                                    </th>
                                    <th class="text-start min-w-250px">User Role Permission</th>
                                    <th class="text-center w-150px">Added Since</th>
                                    <th class="text-end min-w-100px">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-regular">
                            </tbody>
                        </table>
                        <!--end::Datatable-->
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
        @hasanyrole('superAdmin')
            let hasSuperAdminRole = true;
        @else
            let hasSuperAdminRole = false;
        @endhasanyrole

        document.addEventListener('DOMContentLoaded', function() {
            "use strict";

            var hostUrl = "{{ url('/') }}";

            var KTDatatablesServerSide = function() {
                var table;
                var dt;
                var filterPayment;

                var initDatatable = function() {
                    dt = $("#kt_datatable_permission").DataTable({
                        searchDelay: 500,
                        processing: true,
                        serverSide: true,
                        debug: true,
                        order: [[1, 'desc']],
                        stateSave: true,
                        select: {
                            style: 'multi',
                            selector: 'td:first-child input[type="checkbox"]',
                            className: 'row-selected'
                        },
                        ajax: {
                            url: "{{ route('datatable.permission') }}",
                            type: "GET",
                            error: function(xhr, error, thrown) {
                                console.error("AJAX Error:", xhr, error, thrown);
                            }
                        },
                        pageLength: 10,
                        lengthMenu: [10, 25, 50, 100],
                        columns: [
                            { data: 'id' },
                            { data: 'name' },
                            { data: 'created_at' },
                            { data: null },
                        ],
                        columnDefs: [
                            {
                                targets: 0,
                                orderable: false,
                                render: function(data) {
                                    return `<div class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="${data}" />
                                            </div>`;
                                }
                            },
                            {
                                targets: -1,
                                data: 'id',
                                orderable: false,
                                className: 'text-end',
                                render: function(data, type, row) {
                                    if (hasSuperAdminRole) {
                                        return `<a href="{{ route('permission.show', '') }}/${row.id}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="/permission/${row.id}/edit" class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-1">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_${row.id}" title="Delete data">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                                <div class="modal fade" tabindex="-1" id="kt_modal_${row.id}">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Delete Confirmation</h5>
                                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                                                                    <span class="svg-icon svg-icon-2x"></span>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body text-start">
                                                                <h6 class="text-muted">Are you sure you want to delete this record?</h6>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                                <form method="POST" action="{{ route('permission.destroy', '') }}/${row.id}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>`;
                                    }
                                },
                            },
                        ],
                        createdRow: function(row, data, dataIndex) {
                            $(row).find('td:eq(4)').attr('data-filter', data.CreditCardType);
                        }
                    });

                    table = dt.$;

                    dt.on('draw', function() {
                        initToggleToolbar();
                        toggleToolbars();
                        handleDeleteRows();
                        KTMenu.createInstances();
                    });
                }

                var handleSearchDatatable = function() {
                    const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');
                    filterSearch.addEventListener('keyup', function(e) {
                        dt.search(e.target.value).draw();
                    });
                }

                var handleDeleteRows = () => {
                    const deleteButtons = document.querySelectorAll('[data-kt-docs-table-filter="delete_row"]');

                    deleteButtons.forEach(d => {
                        d.addEventListener('click', function(e) {
                            e.preventDefault();
                            const parent = e.target.closest('tr');
                            const customerName = parent.querySelectorAll('td')[1].innerText;

                            Swal.fire({
                                text: `Are you sure you want to delete ${customerName}?`,
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
                                    Swal.fire({
                                        text: `Deleting ${customerName}`,
                                        icon: "info",
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(function() {
                                        Swal.fire({
                                            text: `${customerName} has been deleted!`,
                                            icon: "success",
                                            confirmButtonText: "Ok, got it!",
                                            customClass: {
                                                confirmButton: "btn fw-bold btn-primary"
                                            }
                                        }).then(function() {
                                            dt.draw();
                                        });
                                    });
                                } else if (result.dismiss === 'cancel') {
                                    Swal.fire({
                                        text: `${customerName} was not deleted.`,
                                        icon: "error",
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary"
                                        }
                                    });
                                }
                            });
                        });
                    });
                }

                var initToggleToolbar = function() {
                    const container = document.querySelector('#kt_datatable_permission');
                    const checkboxes = container.querySelectorAll('[type="checkbox"]');
                    const deleteSelected = document.querySelector('#deleteSelected');

                    checkboxes.forEach(c => {
                        c.addEventListener('click', function() {
                            setTimeout(toggleToolbars, 50);
                        });
                    });

                    deleteSelected.addEventListener('click', function() {
                        Swal.fire({
                            text: "Are you sure you want to delete the selected rows?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            showLoaderOnConfirm: true,
                            confirmButtonText: "Yes, delete!",
                            cancelButtonText: "No, cancel",
                            customClass: {
                                confirmButton: "btn fw-bold btn-danger",
                                cancelButton: "btn fw-bold btn-active-light-primary"
                            },
                        }).then(function(result) {
                            if (result.value) {
                                Swal.fire({
                                    text: "Deleting selected rows...",
                                    icon: "info",
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(function() {
                                    Swal.fire({
                                        text: "All selected rows have been deleted!",
                                        icon: "success",
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn fw-bold btn-primary"
                                        }
                                    }).then(function() {
                                        dt.draw();
                                    });

                                    const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                                    headerCheckbox.checked = false;
                                });
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: "No rows were deleted.",
                                    icon: "error",
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                });
                            }
                        });
                    });
                }

                var toggleToolbars = function() {
                    const container = document.querySelector('#kt_datatable_permission');
                    const toolbarBase = document.querySelector('[data-kt-docs-table-toolbar="base"]');
                    const toolbarSelected = document.querySelector('[data-kt-docs-table-toolbar="selected"]');
                    const selectedCount = document.querySelector('[data-kt-docs-table-select="selected_count"]');

                    const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

                    let checkedState = false;
                    let count = 0;

                    allCheckboxes.forEach(c => {
                        if (c.checked) {
                            checkedState = true;
                            count++;
                        }
                    });

                    if (checkedState) {
                        selectedCount.innerHTML = count;
                        toolbarBase.classList.add('d-none');
                        toolbarSelected.classList.remove('d-none');
                    } else {
                        toolbarBase.classList.remove('d-none');
                        toolbarSelected.classList.add('d-none');
                    }
                }

                return {
                    init: function() {
                        initDatatable();
                        handleSearchDatatable();
                        initToggleToolbar();
                        handleDeleteRows();
                        handleResetForm();
                    }
                }
            }();

            KTUtil.onDOMContentLoaded(function() {
                KTDatatablesServerSide.init();
            });
        });
    </script>
@endsection
