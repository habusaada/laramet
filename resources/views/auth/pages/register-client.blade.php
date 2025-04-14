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
            <div class="p-10 w-lg-500">
                <!--begin::Heading-->
                <div class="text-center mb-11">
                    <!--begin::Title-->
                    <h1 class="mb-3 text-primary fw-bolder">Customer Sign Up</h1>
                    <!--end::Title-->
                    <!--begin::Subtitle-->
                    <div class="text-gray-500 fw-semibold fs-6">Already registered? <a href="{{ route('login') }}"
                            class="btn btn-link fw-bold">Sign-in</a></div>
                    <!--end::Subtitle=-->
                </div>
                <!--begin::Heading-->
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
                        <span>Please enter all required fields ( <span class="text-danger">*</span> ) correctly. They will
                            appear in the final report.</span>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Alert-->
                <!--begin::Stepper-->
                <div class="stepper stepper-pills" id="kt_stepper_register_client">

                    <!--begin::Nav-->
                    <div class="stepper-nav flex-center flex-wrap mb-10">
                        <!--begin::Step 1-->
                        <div class="stepper-item me-5 current" data-kt-stepper-element="nav">
                            <!--begin::Wrapper-->
                            <div class="stepper-wrapper d-flex align-items-center">
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">1</span>
                                </div>
                                <!--end::Icon-->

                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">
                                        Company Information
                                    </h3>

                                    <div class="stepper-desc">
                                        Enter Company Info
                                    </div>
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Line-->
                            <div class="stepper-line h-40px"></div>
                            <!--end::Line-->
                        </div>
                        <!--end::Step 1-->

                        <!--begin::Step 2-->
                        <div class="stepper-item me-5" data-kt-stepper-element="nav">
                            <!--begin::Wrapper-->
                            <div class="stepper-wrapper d-flex align-items-center">
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">2</span>
                                </div>
                                <!--begin::Icon-->

                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">
                                        Personal Information
                                    </h3>

                                    <div class="stepper-desc">
                                        Enter Personal Info
                                    </div>
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Line-->
                            <div class="stepper-line h-40px"></div>
                            <!--end::Line-->
                        </div>
                        <!--end::Step 2-->
                    </div>
                    <!--end::Nav-->

                    <!--begin::Form-->
                    {{ html()->form('POST', route('register'))->attributes(['id' => 'kt_stepper_register_client_formo','class' => 'form w-lg-500px mx-auto','novalidate' => 'novalidate','data-parsley-validate' => '', 'enctype' => 'multipart/form-data'])->open() }}
                        <!--begin::Group-->
                        <div class="mb-5">
                            <!--begin::Step 1-->
                            <div class="flex-column current" data-kt-stepper-element="content">
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label required">Company Name</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" name="company_name"
                                        placeholder="Enter company name" value="{{ old('company_name') }}" />
                                    <!--end::Input-->
                                    <!--begin::error-->
                                    @if ($errors->has('company_name'))
                                        <ul>
                                            @foreach ($errors->get('company_name') as $error)
                                                <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <!--end::error-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label required">Location</label>
                                    <!--end::Label-->

                                    <!--begin::Select2-->
                                    <select class="mb-2 form-select form-select-solid" name="location"
                                        data-control="select2" data-hide-search="true"
                                        data-placeholder="Select Company Location" id="kt_location_select" required>

                                        @foreach (['Istanbul', 'Ankara', 'Izmir', 'Bursa', 'Adana', 'Gaziantep', 'Konya', 'Antalya', 'Kayseri', 'Mersin', 'Diyarbakır', 'Samsun', 'Eskişehir', 'Denizli', 'Trabzon', 'Erzurum', 'Malatya', 'Sakarya', 'Manisa', 'Balıkesir'] as $city)
                                            <option value="{{ $city }}"
                                                {{ old('location') == $city ? 'selected' : '' }}>
                                                {{ $city }}
                                            </option>
                                        @endforeach

                                    </select>
                                    <!--end::Select2-->
                                </div>
                                <!--end::Input group-->

                            </div>
                            <!--begin::Step 1-->

                            <!--begin::Step 2-->
                            <div class="flex-column" data-kt-stepper-element="content">
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label required">Full Name</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" name="full_name"
                                        placeholder="Enter you full name" value="{{ old('full_name') }}" />
                                    <!--end::Input-->
                                    <!--begin::error-->
                                    @if ($errors->has('full_name'))
                                        <ul>
                                            @foreach ($errors->get('full_name') as $error)
                                                <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <!--end::error-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label required">Job Title</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" name="job_title"
                                        placeholder="Enter your job title" value="{{ old('job_title') }}" />
                                    <!--end::Input-->
                                    <!--begin::error-->
                                    @if ($errors->has('job_title'))
                                        <ul>
                                            @foreach ($errors->get('job_title') as $error)
                                                <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <!--end::error-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label required">Email</label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-solid" name="email"
                                        placeholder="Enter your email" value="{{ old('email') }}" />
                                    <!--end::Input-->
                                    <!--begin::error-->
                                    @if ($errors->has('email'))
                                        <ul>
                                            @foreach ($errors->get('email') as $error)
                                                <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <!--end::error-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-8" data-kt-password-meter="true">
                                    <!--begin::Wrapper-->
                                    <div class="mb-1">
                                        <!--begin::Input wrapper-->
                                        <div class="position-relative mb-3">
                                            <input class="form-control bg-transparent" type="password"
                                                placeholder="Password" name="password" autocomplete="off" />
                                            <span
                                                class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                                data-kt-password-meter-control="visibility">
                                                <i class="ki-duotone ki-eye-slash fs-2"></i>
                                                <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                            </span>
                                        </div>
                                        <!--end::Input wrapper-->
                                        <!--begin::Meter-->
                                        <div class="d-flex align-items-center mb-3"
                                            data-kt-password-meter-control="highlight">
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                            </div>
                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                        </div>
                                        <!--end::Meter-->
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Hint-->
                                    <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &
                                        symbols.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Input group=-->
                                <!--end::Input group=-->
                                <div class="fv-row mb-8">
                                    <!--begin::Repeat Password-->
                                    <input type="password" placeholder="Repeat Password" name="password_confirmation"
                                        autocomplete="off" class="form-control bg-transparent" />
                                    <!--end::Repeat Password-->
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>
                                <!--end::Input group=-->
                            </div>
                            <!--begin::Step 1-->
                        </div>
                        <!--end::Group-->

                        <!--begin::Actions-->
                        <div class="d-flex flex-stack">
                            <!--begin::Wrapper-->
                            <div class="me-2">
                                <button type="button" class="btn btn-light btn-active-light-primary"
                                    data-kt-stepper-action="previous">
                                    Back
                                </button>
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Wrapper-->
                            <div>
                                <button type="submit" class="btn btn-primary" data-kt-stepper-action="submit">
                                    <span class="indicator-label">
                                        Submit
                                    </span>
                                    <span class="indicator-progress">
                                        Please wait... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>

                                <button type="button" class="btn btn-primary" data-kt-stepper-action="next">
                                    Continue
                                </button>
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Stepper-->
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
    <script>
        // Stepper lement
        var element = document.querySelector("#kt_stepper_register_client");

        // Initialize Stepper
        var stepper = new KTStepper(element);

        // Handle next step
        stepper.on("kt.stepper.next", function(stepper) {
            stepper.goNext(); // go next step
        });

        // Handle previous step
        stepper.on("kt.stepper.previous", function(stepper) {
            stepper.goPrevious(); // go previous step
        });
    </script>
@endsection
