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
                {{-- <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
                <!--begin::Form-->
                {{ html()->form('POST', route('password.store'))->attributes(['data-parsley-validate' => '', 'enctype' => 'multipart/form-data'])->open() }}

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $data['request']->route('token') }}">
                <!--begin::Heading-->
                <div class="text-center mb-10">
                    <!--begin::Title-->
                    <h1 class="text-gray-900 fw-bolder mb-3">Setup New Password</h1>
                    <!--end::Title-->
                    <!--begin::Link-->
                    <div class="text-gray-500 fw-semibold fs-6">Have you already reset the password ?
                        <a href="{{ route('login') }}" class="link-primary fw-bold">Sign in</a>
                    </div>
                    <!--end::Link-->
                </div>
                <!--begin::Heading-->
                <!--begin::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Email-->
                    <input type="text" placeholder="Email" name="email" autocomplete="off"
                        class="form-control bg-transparent" :value="old('email')" required autofocus />
                    <!--end::Email-->
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <!--begin::Input group-->
                <div class="fv-row mb-8" data-kt-password-meter="true">
                    <!--begin::Wrapper-->
                    <div class="mb-1">
                        <!--begin::Input wrapper-->
                        <div class="position-relative mb-3">
                            <input class="form-control bg-transparent" type="password" placeholder="Password"
                                name="password" autocomplete="off" />
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                data-kt-password-meter-control="visibility">
                                <i class="ki-duotone ki-eye-slash fs-2"></i>
                                <i class="ki-duotone ki-eye fs-2 d-none"></i>
                            </span>
                        </div>
                        <!--end::Input wrapper-->
                        <!--begin::Meter-->
                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                        </div>
                        <!--end::Meter-->
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                    <!--end::Wrapper-->
                    <!--begin::Hint-->
                    <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                    <!--end::Hint-->
                </div>
                <!--end::Input group=-->
                <!--end::Input group=-->
                <div class="fv-row mb-8">
                    <!--begin::Repeat Password-->
                    <input type="password" placeholder="Repeat Password" name="password_confirmation" autocomplete="off"
                        class="form-control bg-transparent" />
                    <!--end::Repeat Password-->
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <!--end::Input group=-->
                <!--begin::Action-->
                <div class="d-grid mb-10">
                    <button type="submit" id="kt_new_password_submit" class="btn btn-primary">
                        <!--begin::Indicator label-->
                        <span class="indicator-label">Submit</span>
                        <!--end::Indicator label-->
                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        <!--end::Indicator progress-->
                    </button>
                </div>
                <!--end::Action-->
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
                <button class="btn btn-flex btn-link btn-color-gray-700 btn-active-color-primary rotate fs-base"
                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-offset="0px, 0px">
                    <span data-kt-element="current-lang-name" class="me-1">English</span>
                    <span class="rotate-180 d-flex flex-center">
                        <i class="m-0 ki-duotone ki-down fs-5 text-muted"></i>
                    </span>
                </button>
                <!--end::Toggle-->
                <!--begin::Menu-->
                <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px fs-7"
                    data-kt-menu="true" id="kt_auth_lang_menu">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: '<strong>Password Reset Link Sent</strong>',
                text: @json(session('status')),
                confirmButtonColor: '#1C3A74',
                confirmButtonText: 'Done',
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            });
        });
    </script>
@endif

@section('javascript')
@endsection
