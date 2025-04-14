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

                <!--begin::Pricing-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="px-10 pb-10 card-body px-lg-20 pt-17">

                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-striped gy-7">
                                <!--begin::Table head-->
                                <thead class="align-middle">
                                    <tr id="kt_pricing">
                                        <th class="text-start ps-9 min-w-200px">User Role</th>
                                    </tr>
                                </thead>
                                <!--end::Table head-->

                                <!--begin::Table body-->
                                <tbody>
                                    <tr>
                                        <th class="card-rounded-start">
                                            <div class="fw-bold d-flex align-items-center ps-9 fs-3">
                                                {{ $data['role']->name }}
                                            </div>
                                        </th>
                                    </tr>
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->

                        <!--begin::Footer-->
                        <div class="flex-wrap d-flex flex-stack mt-lg-20 pt-13">
                            <!--begin::Actions-->
                            <div class="my-1 me-5">
                                <a href="{{ route('role.index') }}" class="my-1 btn btn-light">
                                    User Roles List
                                </a>
                            </div>
                            <!--end::Actions-->

                            <!--begin::Action-->
                            <a href="{{ route('role.create') }}" class="my-1 btn btn-primary">
                                Add New Role
                            </a>
                            <!--end::Action-->
                        </div>
                        <!--end::Footer-->

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Pricing-->

            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection

@section('javascript')
@endsection
