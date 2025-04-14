
@extends('auth.authLayout')

@section('title')

    <title>{{ config('app.name') }} | {{ $data['options']['page_title'] }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('stylesheet')
@endsection

@section('body')

<div class="p-10 d-flex flex-column flex-lg-row-fluid w-lg-50">
    <!--begin::Form-->
    <div class="d-flex flex-center flex-column flex-lg-row-fluid">
        <!--begin::Wrapper-->
        <div class="p-10 w-lg-500px">
            <!--begin::Form-->
            {{ html()->form('POST', route('login'))->attributes(['data-parsley-validate' => '', 'enctype' => 'multipart/form-data'])->open() }}

                <!--begin::Heading-->
                <div class="text-center mb-11">
                    <!--begin::Title-->
                    <h1 class="mb-3 text-primary fw-bolder">Sign In to aKualys</h1>
                    <!--end::Title-->
                    <!--begin::Subtitle-->
                    <div class="text-gray-500 fw-semibold fs-6">New Here? <a href="{{ route('register') }}" class="btn btn-link fw-bold">Create an Account</a></div>
                    <!--end::Subtitle=-->
                </div>
                <!--begin::Heading-->
                @include('auth.partials._messages')
                <!--begin::Input group=-->
                <div class="mb-8 fv-row">

                    <!--begin::Email-->
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="mb-3 form-control form-control-solid" placeholder="Enter email address" autocomplete="off" data-parsley-required data-parsley-type="email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                    <!--end::Email-->

                </div>
                <!--end::Input group=-->
                <div class="mb-3 fv-row">
                    <!--begin::Password-->
                    <label class="form-label">Password</label>
                    <input type="password" placeholder="Enter password" name="password" autocomplete="off" class="form-control form-control-solid" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <!--end::Password-->
                </div>
                <!--end::Input group=-->
                <!--begin::Wrapper-->
                <div class="flex-wrap gap-3 mb-8 d-flex flex-stack fs-base fw-semibold">
                    <div></div>
                    <!--begin::Link-->
                    <a href="{{ route('password.request') }}" class="link-primary">Forgot Password ?</a>
                    <!--end::Link-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Submit button-->
                <div class="mb-10 d-grid">
                    <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
                        <!--begin::Indicator label-->
                        <span class="indicator-label">Sign In</span>
                        <!--end::Indicator label-->
                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">Please wait...
                        <span class="align-middle spinner-border spinner-border-sm ms-2"></span></span>
                        <!--end::Indicator progress-->
                    </button>
                </div>
                <!--end::Submit button-->
                <!--begin::Sign up-->
                <div class="text-center text-gray-500 fw-semibold fs-6">Not a Member yet?
                <a href="authentication/layouts/corporate/sign-up.html" class="link-primary">Sign up</a></div>
                <!--end::Sign up-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Form-->
    <!--begin::Footer-->
    <div class="px-10 mx-auto w-lg-500px d-flex flex-stack">
        <!--begin::Languages-->
        <div class="me-10">
            <!--begin::Toggle-->
            <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
                <span data-kt-element="current-lang-name" class="me-1">English</span>
                <span class="rotate-180 d-flex flex-center">
                    <i class="m-0 ki-duotone ki-down fs-5 text-muted"></i>
                </span>
            </button>
            <!--end::Toggle-->
            <!--begin::Menu-->
            <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px fs-7" data-kt-menu="true" id="kt_auth_lang_menu">
                <!--begin::Menu item-->
                <div class="px-3 menu-item">
                    <a href="#" class="px-5 menu-link d-flex" data-kt-lang="English">
                        <span data-kt-element="lang-name">English</span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="px-3 menu-item">
                    <a href="#" class="px-5 menu-link d-flex" data-kt-lang="Spanish">
                        <span data-kt-element="lang-name">Spanish</span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="px-3 menu-item">
                    <a href="#" class="px-5 menu-link d-flex" data-kt-lang="German">
                        <span data-kt-element="lang-name">German</span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="px-3 menu-item">
                    <a href="#" class="px-5 menu-link d-flex" data-kt-lang="Japanese">
                        <span data-kt-element="lang-name">Japanese</span>
                    </a>
                </div>
                <!--end::Menu item-->
                <!--begin::Menu item-->
                <div class="px-3 menu-item">
                    <a href="#" class="px-5 menu-link d-flex" data-kt-lang="French">
                        <span data-kt-element="lang-name">French</span>
                    </a>
                </div>
                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Languages-->
        <!--begin::Links-->
        <div class="gap-5 d-flex fw-semibold text-primary fs-base">
            <a href="pages/contact.html" target="_blank">Contact Us</a>
        </div>
        <!--end::Links-->
    </div>
    <!--end::Footer-->
</div>
@endsection
@if (session('status'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: '<strong>Success</strong>',
                text: @json(session('status')),
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Done'
            });
        });
    </script>
@endif
@section('javascript')
@endsection
