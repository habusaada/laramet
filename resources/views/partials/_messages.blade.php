@php
    $iconClasses = [
        'success' => 'ki-duotone ki-shield-tick',
        'danger'   => 'ki-duotone ki-shield-cross',
        'warning' => 'ki-duotone ki-information-4',
        'info'    => 'ki-duotone ki-information',
    ];

    $type = session('flash.type', 'info');
    $icon = $iconClasses[$type] ?? $iconClasses['info'];
@endphp
@if (Session::has('flash'))
    <!--begin::Alert-->
    <div
        class="alert alert-dismissible bg-light-{{ session('flash.type') }} border border-{{ session('flash.type') }} border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
        <!--begin::Icon-->

        <i class="{{ $icon }} fs-2hx text-{{ session('flash.type') }} me-4 mb-sm-0">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <!--begin::Content-->
            <!--begin::Title-->
            <h5 class="mb-1 text-{{ session('flash.type') }}">{{ session('flash.title') }}</h5>
            <!--end::Title-->
            <span>{{ session('flash.message') }}</span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Alert-->
@endif
@if (Session::has('success11'))
    <!--begin::Alert-->
    <div
        class="alert alert-dismissible bg-light-warning border border-warning border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
        <!--begin::Icon-->

        <i class=" ki-duotone ki-shield-tick fs-2hx text-success me-4 mb-sm-0">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <!--begin::Content-->
            <!--begin::Title-->
            <h5 class="mb-1 text-success">Access Denied</h5>
            <!--end::Title-->
            <span>{{ Session::get('success11') }}</span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Alert-->
@endif
@if (Session::has('nopermissionss'))
    <!--begin::Alert-->
    <div
        class="alert alert-dismissible bg-light-info border border-info border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
        <!--begin::Icon-->

        <i class=" ki-duotone ki-shield-tick fs-2hx text-info me-4 mb-sm-0">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <!--begin::Content-->
            <!--begin::Title-->
            <h5 class="mb-1 text-info">Access Denied</h5>
            <!--end::Title-->
            <span>{{ Session::get('nopermissionss') }}</span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Alert-->
@endif
