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

                <!--begin::Form-->
                {{ html()->modelForm($data['user'], 'PUT', route('user.update', $data['user']->id))->class(['form d-flex flex-column flex-lg-row'])->attributes(['files' => 'true', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data'])->open() }}

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                    <!--begin::Role Information-->
                    <div class="py-4 card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ $data['options']['card_header'] }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="pt-0 card-body">
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Name</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="name" class="mb-2 form-control form-control-solid"
                                    placeholder="" value="{{ $data['user']->name }}" required />
                                <!--end::Input-->
                                <!--begin::Error-->
                                @if ($errors->has('name'))
                                    <ul>
                                        @foreach ($errors->get('name') as $error)
                                            <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                                <!--end::Error-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Bio</label>
                                <!--end::Label-->

                                <!--begin::Input-->

                                <textarea name="bio" class="form-control form-control form-control-solid" data-kt-autosize="true">{{ $data['user']->profile->bio }}</textarea>
                                <!--end::Input-->
                                <!--begin::Error-->
                                @if ($errors->has('name'))
                                    <ul>
                                        @foreach ($errors->get('name') as $error)
                                            <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                                <!--end::Error-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Phone Number</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="phone_number" class="mb-2 form-control form-control-solid"
                                    placeholder="" value="{{ $data['user']->profile->phone_number }}" required />
                                <!--end::Input-->
                                <!--begin::Error-->
                                @if ($errors->has('phone_number'))
                                    <ul>
                                        @foreach ($errors->get('phone_number') as $error)
                                            <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                                <!--end::Error-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Company Name</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="company_name" class="mb-2 form-control form-control-solid"
                                    placeholder="" value="{{ $data['user']->profile->company_name }}" required />
                                <!--end::Input-->
                                <!--begin::Error-->
                                @if ($errors->has('company_name'))
                                    <ul>
                                        @foreach ($errors->get('company_name') as $error)
                                            <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                                <!--end::Error-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Company Location</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="company_location" class="mb-2 form-control form-control-solid"
                                    placeholder="" value="{{ $data['user']->profile->company_location }}" required />
                                <!--end::Input-->
                                <!--begin::Error-->
                                @if ($errors->has('company_location'))
                                    <ul>
                                        @foreach ($errors->get('company_location') as $error)
                                            <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                                <!--end::Error-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Company Location</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="job_title" class="mb-2 form-control form-control-solid"
                                    placeholder="" value="{{ $data['user']->profile->job_title }}" required />
                                <!--end::Input-->
                                <!--begin::Error-->
                                @if ($errors->has('job_title'))
                                    <ul>
                                        @foreach ($errors->get('job_title') as $error)
                                            <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                                <!--end::Error-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Date of Birth</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <div class="input-group" id="kt_td_picker_localization" data-td-target-input="nearest"
                                    data-td-target-toggle="nearest">
                                    <input type="text" value="{{ $data['user']->profile->date_of_birth }}" name="date_of_birth"
                                        class="form-control form-control-solid"
                                        data-td-target="#kt_td_picker_localization" />
                                    <span class="input-group-text input-group-solid"
                                        data-td-target="#kt_td_picker_localization" data-td-toggle="datetimepicker">
                                        <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span
                                                class="path2"></span></i>
                                    </span>
                                </div>
                                <!--end::Input-->
                                <!--begin::Error-->
                                @if ($errors->has('date_of_birth'))
                                    <ul>
                                        @foreach ($errors->get('date_of_birth') as $error)
                                            <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                                <!--end::Error-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Gender</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                @php
                                    $selectedGender = old('gender', $data['user']->profile->gender ?? '');
                                @endphp

                                <div class="form-check form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input" type="radio" name="gender" id="genderMale"
                                        value="male" {{ $selectedGender === 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderMale">
                                        Male
                                    </label>
                                </div>

                                <div class="form-check form-check-custom form-check-solid mb-2">
                                    <input class="form-check-input" type="radio" name="gender" id="genderFemale"
                                        value="female" {{ $selectedGender === 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderFemale">
                                        Female
                                    </label>
                                </div>

                                <div class="form-check form-check-custom form-check-solid">
                                    <input class="form-check-input" type="radio" name="gender" id="genderOther"
                                        value="other" {{ $selectedGender === 'other' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="genderOther">
                                        Other
                                    </label>
                                </div>
                                <!--end::Input-->
                                <!--begin::Error-->
                                @if ($errors->has('job_title'))
                                    <ul>
                                        @foreach ($errors->get('job_title') as $error)
                                            <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                                <!--end::Error-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Address</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="address" class="mb-2 form-control form-control-solid"
                                    placeholder="" value="{{ $data['user']->profile->address }}" required />
                                <!--end::Input-->
                                <!--begin::Error-->
                                @if ($errors->has('address'))
                                    <ul>
                                        @foreach ($errors->get('address') as $error)
                                            <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                                <!--end::Error-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Role Information-->

                    <!--begin::Actions-->
                    <div class="d-flex justify-content-end">
                        <!--begin::Cancel Button-->
                        <a href="../../demo1/dist/apps/ecommerce/catalog/products.html"
                            id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">Cancel</a>
                        <!--end::Cancel Button-->

                        <!--begin::Submit Button-->
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Save Changes</span>
                            <span class="indicator-progress">Please wait...
                                <span class="align-middle spinner-border spinner-border-sm ms-2"></span>
                            </span>
                        </button>
                        <!--end::Submit Button-->
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Main column-->

                </form>
                <!--end::Form-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

@endsection

@section('javascript')
    <script>
        new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_localization"), {
            localization: {
                locale: "en",
                startOfTheWeek: 1,
                format: "dd-MM-yyyy"
            }
        });
    </script>
@endsection
