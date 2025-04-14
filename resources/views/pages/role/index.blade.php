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

                <!--begin::Roles Table Widget-->
                <div class="mb-5 card mb-xl-8">
                    <!--begin::Header-->
                    <div class="pt-5 border-0 card-header">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="mb-1 card-label fw-bold fs-3">User Roles List</span>
                            <span class="mt-1 text-muted fw-semibold fs-7">
                                Total roles added ({{ count($data['roles']) }})
                            </span>
                        </h3>
                        <div class="card-toolbar"></div>
                    </div>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="pt-3 card-body">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed table-row-gray-300 gs-4 gy-4">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th>User Roles</th>
                                        <th class="min-w-150px text-end"></th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->

                                <!--begin::Table body-->
                                <tbody>
                                    @foreach ($data['roles'] as $role)
                                        <tr>
                                            <td class="text-start">
                                                <div class="d-flex align-items-center">
                                                    <div class="me-5">
                                                        {{ $role->name }}
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="text-end">
                                                @hasanyrole('superAdmin')
                                                    <a href="{{ route('role.show', $role->id) }}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                        title="View Role">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                @endhasanyrole

                                                @hasanyrole('superAdmin|Admin|Manager|Editor')
                                                    <a href="{{ route('role.edit', $role->id) }}"
                                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                                        title="Edit Role">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endhasanyrole

                                                @hasanyrole('superAdmin')
                                                    <button class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#kt_modal_{{ $role->id }}"
                                                        title="Delete Role">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>

                                                    <!-- Delete Confirmation Modal -->
                                                    <div class="modal fade" tabindex="-1" id="kt_modal_{{ $role->id }}">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Delete Confirmation</h5>
                                                                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <span class="svg-icon svg-icon-2x"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body text-start">
                                                                    <h6 class="text-muted">Are you sure you want to delete this role?</h6>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                                                        Cancel
                                                                    </button>
                                                                    <form method="POST" action="{{ route('role.destroy', $role->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Confirm</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endhasanyrole
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Roles Table Widget-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection

@section('javascript')
@endsection
