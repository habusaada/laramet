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
                {{ html()->modelForm($data['user'], 'PUT', route('userrole.update', $data['user']->id))->class(['form d-flex flex-column flex-lg-row'])->attributes(['data-parsley-validate' => '', 'enctype' => 'multipart/form-data'])->open() }}

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
                                <label class="required form-label">User Name</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="user_name" class="mb-2 form-control form-control-solid"
                                    placeholder="" value="{{ $data['user']->name }}" readonly />
                                <!--end::Input-->

                                <!--begin::Input-->
                                <input type="text" name="user_id" value="{{ $data['user']->id }}" hidden />
                                <!--end::Input-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">This is the username in the system.</div>
                                <!--end::Description-->

                                <!--begin::error-->
                                @if ($errors->has('user_name'))
                                    <ul>
                                        @foreach ($errors->get('user_name') as $error)
                                            <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                                <!--end::error-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">System User Roles</label>
                                <!--end::Label-->

                                <!--begin::Wrapper-->
                                <div class="d-flex fw-semibold h-100">
                                    @php
                                        $userRoles = $data['user']->roles->pluck('id')->toArray();
                                    @endphp

                                    @foreach ($data['roles'] as $key => $option)
                                        <div class="mb-2 form-check form-solid form-check-inline me-9">
                                            <input class="form-check-input" type="checkbox" name="role[]"
                                                id="role_{{ $key }}" value="{{ $option->id }}"
                                                {{ in_array($option->id, $userRoles) ? 'checked' : '' }}
                                                data-parsley-multiple="role">
                                            <label class="form-check-label"
                                                for="role_{{ $key }}">{{ $option->name }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">Select the role(s) from above.</div>
                                <!--end::Description-->

                                <!--begin::error-->
                                @if ($errors->has('role'))
                                    <ul>
                                        @foreach ($errors->get('role') as $error)
                                            <li><span class="text-danger fs-7">{{ $error }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                                <!--end::error-->
                            </div>
                            <!--end::Input group-->

                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->

                    <!--begin::Actions-->
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('userrole.index') }}" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5">Cancel</a>

                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Save Changes</span>
                            <span class="indicator-progress">Please wait...
                                <span class="align-middle spinner-border spinner-border-sm ms-2"></span>
                            </span>
                        </button>
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
@endsection
