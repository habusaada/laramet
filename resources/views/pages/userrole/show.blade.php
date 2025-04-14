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

                <!--begin::Row-->
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                    <!--begin::Column-->
                    <div class="col-md-12 col-xl-12">
                        <!--begin::Card-->
                        <div class="card card-flush h-md-100">
                            <!--begin::Card header-->
                            <div class="card-header">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>{{ $data['user']->name }}</h2>
                                </div>
                                <!--end::Card title-->
                            </div>
                            <!--end::Card header-->

                            <!--begin::Card body-->
                            <div class="pt-1 card-body">
                                <!--begin::Assigned roles count-->
                                <div class="mb-5 text-gray-600 fw-bold">
                                    Number of assigned roles: {{ count($data['user']->roles) }}
                                </div>
                                <!--end::Assigned roles count-->

                                <!--begin::Roles list-->
                                <div class="text-gray-600 d-flex flex-column">
                                    @foreach ($data['user']->roles as $role)
                                        <div class="py-2 d-flex align-items-center">
                                            <span class="bullet bg-primary me-3"></span>{{ $role->name }}
                                        </div>
                                    @endforeach
                                </div>
                                <!--end::Roles list-->
                            </div>
                            <!--end::Card body-->

                            <!--begin::Card footer-->
                            <div class="flex-wrap pt-0 card-footer">
                                <!--begin::Footer actions-->
                                <div class="flex-wrap pt-3 d-flex flex-stack mt-lg-10">
                                    <!--begin::Back to list-->
                                    <div class="my-5 me-5">
                                        <a href="{{ route('userrole.index') }}" class="my-1 btn btn-light">
                                            System Users List
                                        </a>
                                    </div>
                                    <!--end::Back to list-->

                                    <!--begin::Assign role-->
                                    <a href="{{ route('userrole.create') }}" class="my-1 btn btn-primary">
                                        Assign Role to User
                                    </a>
                                    <!--end::Assign role-->
                                </div>
                                <!--end::Footer actions-->
                            </div>
                            <!--end::Card footer-->
                        </div>
                        <!--end::Card-->
                    </div>
                    <!--end::Column-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
@endsection

@section('javascript')
@endsection
