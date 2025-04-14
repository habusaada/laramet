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
                {{ html()->form('POST', route('userrole.store'))->class(['form d-flex flex-column flex-lg-row'])->attributes(['files' => 'true', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data'])->open() }}

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                    <!--begin::Card-->
                    <div class="py-4 card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Assign Role to User</h2>
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="pt-0 card-body">

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Select User Name</label>
                                <!--end::Label-->
                                <!--begin::Select2-->
                                <select class="mb-2 form-select form-select-solid" name="user" data-control="select2"
                                    data-hide-search="false" data-placeholder="Select a user name"
                                    id="kt_ecommerce_add_product_status_select" required>
                                    @foreach ($data['users'] as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('user') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <!--end::Select2-->
                                <!--begin::Description-->
                                <div class="text-muted fs-7">Choose the user name from the list.</div>
                                <!--end::Description-->

                                @if ($errors->has('user'))
                                    <ul>
                                        @foreach ($errors->get('user') as $error)
                                            <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">System User Roles</label>
                                <!--end::Label-->
                                <!--begin::Wrapper-->
                                <div class="d-flex fw-semibold h-100">
                                    @foreach ($data['roles'] as $key => $option)
                                        <div class="mb-2 form-check form-check-solid form-check-inline me-9">
                                            <input class="form-check-input form-check-input" type="checkbox" name="role[]"
                                                id="role_{{ $key }}" value="{{ $option->id }}">
                                            <label class="form-check-label"
                                                for="role_{{ $key }}">{{ $option->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Description-->
                                <div class="text-muted fs-7">Select one or more roles above.</div>
                                <!--end::Description-->

                                @if ($errors->has('role'))
                                    <ul>
                                        @foreach ($errors->get('role') as $error)
                                            <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <!--end::Input group-->

                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->

                    <div class="d-flex justify-content-end">
                        <!--begin::Cancel Button-->
                        <a href="{{ route('userrole.index') }}"
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
@endsection
