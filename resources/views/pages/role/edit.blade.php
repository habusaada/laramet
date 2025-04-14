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
                {{ html()->modelForm($data['role'], 'PUT', route('role.update', $data['role']->id))->class(['form d-flex flex-column flex-lg-row'])->attributes(['files' => 'true', 'data-parsley-validate' => '', 'enctype' => 'multipart/form-data'])->open() }}

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                    <!--begin::Role Information-->
                    <div class="py-4 card card-flush">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>User Role Details</h2>
                            </div>
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="pt-0 card-body">
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">User Role</label>
                                <!--end::Label-->

                                <!--begin::Input-->
                                <input type="text" name="role_name" class="mb-2 form-control form-control-solid" placeholder=""
                                    value="{{ $data['role']->name }}" required />
                                <!--end::Input-->

                                <!--begin::Description-->
                                <div class="text-muted fs-7">Enter the name of the role you want to update.</div>
                                <!--end::Description-->

                                <!--begin::Error-->
                                @if ($errors->has('role_name'))
                                    <ul>
                                        @foreach ($errors->get('role_name') as $error)
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
                        <a href="../../demo1/dist/apps/ecommerce/catalog/products.html" id="kt_ecommerce_add_product_cancel"
                            class="btn btn-light me-5">Cancel</a>
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
@endsection
