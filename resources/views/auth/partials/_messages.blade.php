@if ($errors->has('profile_status'))
    <!--begin::Alert-->
    <div
        class="alert alert-dismissible bg-light-warning border border-warning border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
        <!--begin::Icon-->

        <i class=" ki-duotone ki-information fs-2hx text-warning me-4 mb-5 mb-sm-0">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
        </i>
        <!--end::Icon-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column pe-0 pe-sm-10">
            <!--begin::Content-->
            <span>{{ $errors->first('profile_status') }}</span>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Alert-->
@endif

@if ($errors->has('failed_attempts'))
<!--begin::Alert-->
<div
    class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">
    <!--begin::Icon-->

    <i class=" ki-duotone ki-information fs-2hx text-danger me-4 mb-5 mb-sm-0">
        <span class="path1"></span>
        <span class="path2"></span>
        <span class="path3"></span>
    </i>
    <!--end::Icon-->

    <!--begin::Wrapper-->
    <div class="d-flex flex-column pe-0 pe-sm-10">
        <!--begin::Content-->
        <span>{{ $errors->first('failed_attempts') }}</span>
        <!--end::Content-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Alert-->
@endif

@if (Session::has('success'))
    <!--begin::Alert-->

    <div class="alert alert-success d-flex align-items-center p-5 mb-7">
        <!--begin::Icon-->

        <span class="svg-icon svg-icon-2hx svg-icon-success mx-3">

            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                height="24px" viewBox="0 0 24 24" version="1.1">

                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                    <rect x="0" y="0" width="24" height="24"></rect>

                    <path
                        d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                        fill="currentColor" opacity="0.3"></path>

                    <path
                        d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z"
                        fill="currentColor"></path>

                </g>

            </svg>

        </span>

        <!--end::Icon-->



        <!--begin::Wrapper-->

        <div class="d-flex flex-column">

            <!--begin::Title-->

            <h5 class="text-success mb-1">حسناً</h5>

            <!--end::Title-->

            <!--begin::Content-->

            <span>{{ Session::get('success') }}</span>

            <!--end::Content-->

        </div>

        <!--end::Wrapper-->

    </div>

    <!--end::Alert-->
@endif




@if (Session::has('nopermission'))
    <div class="col-lg-12">



        <!--begin::Alert-->

        <div class="alert customAlert alert-info d-flex align-items-center p-5 ">

            <!--begin::Icon-->

            <span class="svg-icon svg-icon-2hx svg-icon-info mx-3">

                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">

                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                        <rect x="0" y="0" width="24" height="24"></rect>

                        <path
                            d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                            fill="currentColor" opacity="0.3"></path>

                        <path
                            d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z"
                            fill="currentColor"></path>

                    </g>

                </svg>

            </span>

            <!--end::Icon-->



            <!--begin::Wrapper-->

            <div class="d-flex flex-column">

                <!--begin::Title-->

                <h5 class="mb-1 text-info">خطأ في الصلاحية</h5>

                <!--end::Title-->

                <!--begin::Content-->

                <span>{{ Session::get('nopermission') }}</span>

                <!--end::Content-->

            </div>

            <!--end::Wrapper-->

            <!--begin::Close-->

            <button type="button"
                class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                data-bs-dismiss="alert">

                <span class="svg-icon svg-icon-2x svg-icon-info">

                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">

                        <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                            fill="currentColor">

                            <rect fill="currentColor" x="0" y="7" width="16" height="2" rx="1" />

                            <rect fill="currentColor" opacity="0.5"
                                transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) "
                                x="0" y="7" width="16" height="2" rx="1" />

                        </g>

                    </svg>

                </span>

            </button>

            <!--end::Close-->

        </div>

        <!--end::Alert-->

    </div>
@endif

@if (Session::has('login'))
    <!--begin::Alert-->

    <div class="alert customAlert alert-danger d-flex align-items-center p-5 ">

        <!--begin::Icon-->

        <span class="svg-icon svg-icon-2hx svg-icon-danger mx-3">

            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                height="24px" viewBox="0 0 24 24" version="1.1">

                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                    <rect x="0" y="0" width="24" height="24"></rect>

                    <path
                        d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                        fill="currentColor" opacity="0.3"></path>

                    <path
                        d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z"
                        fill="currentColor"></path>

                </g>

            </svg>

        </span>

        <!--end::Icon-->



        <!--begin::Wrapper-->

        <div class="d-flex flex-column">

            <!--begin::Title-->

            <h5 class="mb-1">{{ trans('messages.login_error') }}</h5>

            <!--end::Title-->

            <!--begin::Content-->

            <span>{{ trans('messages.' . Session::get('login') . '') }}</span>

            <!--end::Content-->

        </div>

        <!--end::Wrapper-->

        <!--begin::Close-->

        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">

            <span class="svg-icon svg-icon-2x svg-icon-danger">

                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">

                    <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                        fill="currentColor">

                        <rect fill="currentColor" x="0" y="7" width="16" height="2" rx="1" />

                        <rect fill="currentColor" opacity="0.5"
                            transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) "
                            x="0" y="7" width="16" height="2" rx="1" />

                    </g>

                </svg>

            </span>

        </button>

        <!--end::Close-->

    </div>

    <!--end::Alert-->
@endif

@if (Session::has('join'))
    <!--begin::Alert-->

    <div class="alert customAlert alert-danger d-flex align-items-center p-5 ">

        <!--begin::Icon-->

        <span class="svg-icon svg-icon-2hx svg-icon-danger mx-3">

            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                height="24px" viewBox="0 0 24 24" version="1.1">

                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                    <rect x="0" y="0" width="24" height="24"></rect>

                    <path
                        d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                        fill="currentColor" opacity="0.3"></path>

                    <path
                        d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z"
                        fill="currentColor"></path>

                </g>

            </svg>

        </span>

        <!--end::Icon-->



        <!--begin::Wrapper-->

        <div class="d-flex flex-column">

            <!--begin::Title-->

            <h5 class="mb-1">{{ trans('messages.join_error') }}</h5>

            <!--end::Title-->

            <!--begin::Content-->

            <span>{{ trans('messages.' . Session::get('join') . '') }}</span>

            <!--end::Content-->

        </div>

        <!--end::Wrapper-->

        <!--begin::Close-->

        <button type="button"
            class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
            data-bs-dismiss="alert">

            <span class="svg-icon svg-icon-2x svg-icon-danger">

                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">

                    <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                        fill="currentColor">

                        <rect fill="currentColor" x="0" y="7" width="16" height="2" rx="1" />

                        <rect fill="currentColor" opacity="0.5"
                            transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) "
                            x="0" y="7" width="16" height="2" rx="1" />

                    </g>

                </svg>

            </span>

        </button>

        <!--end::Close-->

    </div>

    <!--end::Alert-->
@endif

@if (Session::has('sorry'))
    <div class="col-lg-12">



        <!--begin::Alert-->

        <div class="alert customAlert alert-warning d-flex align-items-center p-5 ">

            <!--begin::Icon-->

            <span class="svg-icon svg-icon-2hx svg-icon-warning mx-3">

                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">

                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

                        <rect x="0" y="0" width="24" height="24"></rect>

                        <path
                            d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z"
                            fill="currentColor" opacity="0.3"></path>

                        <path
                            d="M11.1750002,14.75 C10.9354169,14.75 10.6958335,14.6541667 10.5041669,14.4625 L8.58750019,12.5458333 C8.20416686,12.1625 8.20416686,11.5875 8.58750019,11.2041667 C8.97083352,10.8208333 9.59375019,10.8208333 9.92916686,11.2041667 L11.1750002,12.45 L14.3375002,9.2875 C14.7208335,8.90416667 15.2958335,8.90416667 15.6791669,9.2875 C16.0625002,9.67083333 16.0625002,10.2458333 15.6791669,10.6291667 L11.8458335,14.4625 C11.6541669,14.6541667 11.4145835,14.75 11.1750002,14.75 Z"
                            fill="currentColor"></path>

                    </g>

                </svg>

            </span>

            <!--end::Icon-->



            <!--begin::Wrapper-->

            <div class="d-flex flex-column">

                <!--begin::Title-->

                <h5 class="mb-1">{{ trans('messages.sorry') }}</h5>

                <!--end::Title-->

                <!--begin::Content-->

                <span>{{ Session::get('sorry') }}</span>

                <!--end::Content-->

            </div>

            <!--end::Wrapper-->

            <!--begin::Close-->

            <button type="button"
                class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto"
                data-bs-dismiss="alert">

                <span class="svg-icon svg-icon-2x svg-icon-warning">

                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">

                        <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                            fill="currentColor">

                            <rect fill="currentColor" x="0" y="7" width="16" height="2" rx="1" />

                            <rect fill="currentColor" opacity="0.5"
                                transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000) "
                                x="0" y="7" width="16" height="2" rx="1" />

                        </g>

                    </svg>

                </span>

            </button>

            <!--end::Close-->

        </div>

        <!--end::Alert-->

    </div>
@endif
