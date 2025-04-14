@extends('mainLayout')

@section('title')
    <title>{{ config('app.name') }} | {{ $data['options']['page_title'] }}</title>
@endsection

@section('stylesheet')
@endsection

@section('content')
    <div class="d-flex flex-column flex-column-fluid">

        @component('components.akkim-components.tool-bar', ['options' => $data['options']])
        @endcomponent

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">

                @include('partials._messages')

                <div class="card">
                    <div class="pt-6 border-0 card-header">
                        <div class="card-title">
                            <div class="my-1 d-flex align-items-center position-relative">
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17" y="15" width="8" height="2" rx="1"
                                            transform="rotate(45 17 15)" fill="currentColor" />
                                        <path
                                            d="M11 19C6.5 19 3 15.5 3 11C3 6.5 6.5 3 11 3C15.5 3 19 6.5 19 11C19 15.5 15.5 19 11 19ZM11 5C7.5 5 5 7.5 5 11C5 14.5 7.5 17 11 17C14.5 17 17 14.5 17 11C17 7.5 14.5 5 11 5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <input type="text" data-kt-docs-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-14"
                                    placeholder="Search users" />
                            </div>
                        </div>

                        <div class="card-toolbar">
                            <div class="mb-5 d-flex flex-stack">
                                <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                                    <a href="{{ route('userrole.export') }}"
                                        class="fw-bolder btn btn-light-primary me-3"
                                        title="Export table to Excel">
                                        <i class="fa-regular fa-file-excel fs-2"></i> Export to Excel
                                    </a>

                                    <a href="{{ route('userrole.create') }}" class="fw-bolder btn btn-primary"
                                        title="Add new">
                                        <i class="fa-solid fa-file-circle-plus fs-2"></i> Assign Role to User
                                    </a>
                                </div>

                                <div class="d-flex justify-content-end align-items-center d-none"
                                    data-kt-docs-table-toolbar="selected">
                                    <div class="fs-base fw-bold me-5">
                                        <span class="me-2" data-kt-docs-table-select="selected_count"></span> rows selected
                                    </div>
                                    <button id="deleteSelected" type="button" class="btn btn-danger">
                                        Delete Selected
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="py-4 card-body">
                        <table id="kt_datatable_userrole"
                            class="table align-middle table-striped table-rounded gy-3 gs-7">
                            <thead>
                                <tr class="text-gray-800 border-gray-200 fw-bold fs-6 border-bottom-2">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                data-kt-check-target="#kt_datatable_userrole .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    <th class="text-start min-w-100px">Name</th>
                                    <th class="text-start min-w-100px">Email</th>
                                    <th class="text-start min-w-100px">Role</th>
                                    <th class="text-start min-w-150px">Created At</th>
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-regular">
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="{{ url('template/demo1/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var dt = $("#kt_datatable_userrole").DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('datatable.userrole') }}",
                order: [[4, 'desc']],
                language: {
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "Showing 0 to 0 of 0 entries",
                    infoFiltered: "(filtered from _MAX_ total entries)",
                    loadingRecords: "Loading...",
                    processing: "Processing...",
                    search: "Search:",
                    zeroRecords: "No matching records found",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    },
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    }
                },
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'role' },
                    { data: 'created_at' },
                    { data: null }
                ],
                columnDefs: [
                    {
                        targets: 0,
                        orderable: false,
                        render: function (data) {
                            return `
                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="${data}" />
                                </div>`;
                        }
                    },
                    {
                        targets: 3,
                        orderable: false,
                        render: function (data) {
                            if (Array.isArray(data) && data.length > 0) {
                                return data.map(role => {
                                    return `<span class="badge badge-light-success fw-normal">${role}</span>`;
                                }).join(' ');
                            }
                            return `<span class="badge badge-light-danger fw-normal">No Roles</span>`;
                        }
                    },
                    {
                        targets: -1,
                        data: 'id',
                        orderable: false,
                        className: 'text-end',
                        render: function (data, type, row) {
                            return `
                                <a href="/userrole/${row.id}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="/userrole/${row.id}/edit" class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-1" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_${row.id}" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                <div class="modal fade" tabindex="-1" id="kt_modal_${row.id}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete Confirmation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                <h6 class="text-muted">Are you sure you want to delete this entry?</h6>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                <form method="POST" action="/userrole/${row.id}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                    }
                ]
            });

            // Search input
            document.querySelector('[data-kt-docs-table-filter="search"]').addEventListener('keyup', function (e) {
                dt.search(e.target.value).draw();
            });
        });
    </script>
@endsection
