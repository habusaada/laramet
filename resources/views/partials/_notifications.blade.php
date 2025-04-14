<div class="app-navbar-item ms-1 ms-md-3">
    <!--begin::Menu- wrapper-->
    <div class="btn btn-icon position-relative btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-30px h-30px w-md-40px h-md-40px"
        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
        data-kt-menu-placement="bottom-start">
        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
        <span class="svg-icon svg-icon-2 svg-icon-md-1">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path opacity="0.3"
                    d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z"
                    fill="currentColor" />
                <path
                    d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z"
                    fill="currentColor" />
            </svg>
        </span>
        <!--end::Svg Icon-->
        @if (auth()->check() && auth()->user()->unreadNotifications->count() > 0)
        <span
            class="top-0 p-0 position-absolute start-100 translate-middle badge badge-circle badge-danger fs-7 h-20px w-20px">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
        @endif
    </div>
    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true">
        <!--begin::Heading-->
        <div class="d-flex flex-column bgi-no-repeat rounded-top bg-dark">
            <!--begin::Title-->
            <h3 class="mt-10 mb-6 text-white fw-semibold px-9">الإشعارات
                <span
                    class="badge badge-light fs-7 ps-3 ms-3">(5)
                    تقرير</span>
            </h3>
            <!--end::Title-->
            <!--begin::Tabs-->
            <ul class="nav nav-line-tabs nav-line-tabs-2x nav-stretch fw-semibold px-9">
                <li class="nav-item">
                    <a class="pb-4 text-white opacity-75 nav-link opacity-state-100" data-bs-toggle="tab"
                        href="#kt_topbar_notifications">التحديثات</a>
                </li>
                <li class="nav-item">
                    <a class="pb-4 text-white opacity-75 nav-link opacity-state-100" data-bs-toggle="tab"
                        href="#kt_topbar_activities">السجل</a>
                </li>
            </ul>
            <!--end::Tabs-->
        </div>
        <!--end::Heading-->
        <!--begin::Tab content-->
        <div class="tab-content">
            <!--begin::Tab panel-->
            <div class="tab-pane fade show active" id="kt_topbar_notifications" role="tabpanel">
                <!--begin::Items-->
                <div class="px-4 my-5 ps-7 scroll-y mh-325px">
                    @if (auth()->check())
                        @foreach (auth()->user()->notifications as $notification)
                            <!--begin::Item-->
                            <div
                                class="py-4 px-4 w-100 d-flex flex-stack {{ is_null($notification->read_at) ? 'bg-light-primary' : ' ' }}">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-35px me-4">
                                        <span class="symbol-label bg-light-primary">
                                            <!--begin::Svg Icon | path: icons/duotune/technology/teh008.svg-->
                                            <span class="svg-icon svg-icon-2 svg-icon-primary">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.3"
                                                        d="M12 22C13.6569 22 15 20.6569 15 19C15 17.3431 13.6569 16 12 16C10.3431 16 9 17.3431 9 19C9 20.6569 10.3431 22 12 22Z"
                                                        fill="currentColor" />
                                                    <path
                                                        d="M19 15V18C19 18.6 18.6 19 18 19H6C5.4 19 5 18.6 5 18V15C6.1 15 7 14.1 7 13V10C7 7.6 8.7 5.6 11 5.1V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V5.1C15.3 5.6 17 7.6 17 10V13C17 14.1 17.9 15 19 15ZM11 10C11 9.4 11.4 9 12 9C12.6 9 13 8.6 13 8C13 7.4 12.6 7 12 7C10.3 7 9 8.3 9 10C9 10.6 9.4 11 10 11C10.6 11 11 10.6 11 10Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div class="mb-0 me-2">
                                        <a href="javascript:;"
                                            class="text-gray-800 d-block fs-6 text-hover-primary fw-bold">{{ $notification->data['message'] ?? 'No message provided' }}</a>
                                        <a href="{{ $notification->data['link'] ?? 'javascript:;' }}" target="_blank"
                                            class=" {{ is_null($notification->read_at) ? 'text-primary' : 'text-gray-400 text-hover-primary' }} fs-6">مشاهدة
                                            التفاصيل</a>
                                            <span class="mx-1 bullet bullet-line"></span>
                                        <a href="{{ route('notifications.read', $notification->id) }}"
                                            class=" {{ is_null($notification->read_at) ? 'text-primary' : 'text-gray-400 text-hover-primary' }} fs-6">
                                            تعييين كمقروء
                                        </a>
                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Label-->
                                <span
                                    class="badge badge-light fs-7 fw-bolder">{{ $notification->created_at->diffForHumans() }}</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Item-->
                        @endforeach
                    @endif
                </div>
                <!--end::Items-->
                <!--begin::View more-->
                <div class="py-3 text-center border-top">
                    <a href="../../demo1/pages/user-profile/activity.html"
                        class="btn btn-color-gray-600 btn-active-color-primary">عرض الكل
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                        <span class="svg-icon svg-icon-5">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1"
                                    fill="currentColor" />
                                <path
                                    d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon--></a>
                </div>
                <!--end::View more-->
            </div>
            <!--end::Tab panel-->
            <!--begin::Tab panel-->
            <div class="tab-pane fade" id="kt_topbar_activities" role="tabpanel">
                <!--begin::Items-->
                <div class="px-8 my-5 scroll-y mh-325px">
                    @if (auth()->check())
                        @foreach ($activities as $activity)
                            <!--begin::Item-->
                            <div class="py-4 d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center me-2">
                                    <!--begin::Code-->
                                    <span class="w-70px badge badge-light-success me-4">200 OK</span>
                                    <!--end::Code-->
                                    <!--begin::Title-->
                                    <span
                                        class="text-gray-800 d-block fs-6 text-hover-primary fw-bold">{{ $activity->description }}</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Section-->
                                <!--begin::Label-->
                                <span class="badge badge-light fs-8">{{ $activity->created_at->diffForHumans() }}</span>
                                <!--end::Label-->
                            </div>
                            <!--end::Item-->
                        @endforeach
                    @endif
                </div>
                <!--end::Items-->
                <!--begin::View more-->
                <div class="py-3 text-center border-top">
                    <a href="../../demo1/pages/user-profile/activity.html"
                        class="btn btn-color-gray-600 btn-active-color-primary">عرض الكل
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                        <span class="svg-icon svg-icon-5">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1"
                                    fill="currentColor" />
                                <path
                                    d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon--></a>
                </div>
                <!--end::View more-->
            </div>
            <!--end::Tab panel-->
        </div>
        <!--end::Tab content-->
    </div>
    <!--end::Menu-->
    <!--end::Menu wrapper-->
</div>
