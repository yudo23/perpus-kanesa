<header id="header" class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white">
    <div class="navbar-nav-wrap">
        <!-- Logo -->
        <a class="navbar-brand" href="{{route('dashboard.index')}}" aria-label="Front">
            <img class="navbar-brand-logo" src="{{ asset(\SettingHelper::settings('dashboard', 'logo_large_dark') ?? 'templates/dashboard/assets/svg/logos/logo.svg') }}" alt="Logo" data-hs-theme-appearance="default">
            <img class="navbar-brand-logo" src="{{ asset(\SettingHelper::settings('dashboard', 'logo_large_light') ?? 'templates/dashboard/assets/svg/logos-light/logo.svg') }}" alt="Logo" data-hs-theme-appearance="dark">
            <img class="navbar-brand-logo-mini" src="{{ asset(\SettingHelper::settings('dashboard', 'logo_mini_dark') ?? 'templates/dashboard/assets/svg/logos-light/logo-short.svg') }}" alt="Logo" data-hs-theme-appearance="default">
            <img class="navbar-brand-logo-mini" src="{{ asset(\SettingHelper::settings('dashboard', 'logo_mini_light') ?? 'templates/dashboard/assets/svg/logos-light/logo-short.svg') }}" alt="Logo" data-hs-theme-appearance="dark">
        </a>
        <!-- End Logo -->

        <div class="navbar-nav-wrap-content-start">
            <!-- Navbar Vertical Toggle -->
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
            </button>
        </div>

        <div class="navbar-nav-wrap-content-end">
            <!-- Navbar -->
            <ul class="navbar-nav">
                <li class="nav-item d-none d-sm-inline-block">
                    <!-- Notification -->
                    <div class="dropdown">
                        <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="navbarNotificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
                            <i class="bi-bell"></i>
                            @if(Auth::user()->unreadNotifications->count() >= 1)
                            <span class="btn-status btn-sm-status btn-status-danger"></span>
                            @endif
                        </button>

                        <div class="dropdown-menu dropdown-menu-end dropdown-card navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="navbarNotificationsDropdown" style="width: 25rem;">
                            <div class="card">
                                <!-- Header -->
                                <div class="card-header card-header-content-between">
                                    <h4 class="card-title mb-0">Notifikasi</h4>

                                    <!-- Unfold -->
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary rounded-circle" id="navbarNotificationsDropdownSettings" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi-three-dots-vertical"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="navbarNotificationsDropdownSettings">
                                            <span class="dropdown-header">Settings</span>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi-check2-all dropdown-item-icon"></i> Tandai sudah dibaca
                                            </a>
                                        </div>
                                    </div>
                                    <!-- End Unfold -->
                                </div>
                                <!-- End Header -->

                                <!-- Nav -->
                                <ul class="nav nav-tabs nav-justified" id="notificationTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#notificationNavOne" id="notificationNavOne-tab" data-bs-toggle="tab" data-bs-target="#notificationNavOne" role="tab" aria-controls="notificationNavOne" aria-selected="true">Pesan ({{ Auth::user()->unreadNotifications->count() }})</a>
                                    </li>
                                </ul>
                                <!-- End Nav -->

                                <!-- Body -->
                                <div class="card-body-height">
                                    <!-- Tab Content -->
                                    <div class="tab-content" id="notificationTabContent">
                                        <div class="tab-pane fade show active" id="notificationNavOne" role="tabpanel" aria-labelledby="notificationNavOne-tab">
                                            <!-- List Group -->
                                            <ul class="list-group list-group-flush navbar-card-list-group">

                                                @forelse(Auth::user()->notifications->take(10) as $notification)
                                                <!-- Item -->
                                                <li class="list-group-item form-check-select">
                                                    <div href="{{ route('dashboard.notification.read', $notification) }}" class="row">
                                                        <div class="col-auto">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar avatar-sm avatar-circle">
                                                                    <img class="avatar-img" src="{{URL::to('/')}}/templates/dashboard/assets/img/bell.png" alt="Image Description">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- End Col -->

                                                        <div class="col ms-n2">
                                                            <div>
                                                                <div class="d-flex justify-content-between">
                                                                    <h5 class="mb-1">{{$notification["data"]["title"]}}</h5>
                                                                    @if(empty($notification->read_at))
                                                                    <div>
                                                                        <span class="badge bg-danger">NEW</span>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <p class="text-body fs-5">{{$notification["data"]["message"]}}</p>
                                                            </div>
                                                            <div>
                                                                <div class="font-size-12 text-muted">
                                                                    <p><i class="fa fa-clock"></i> {{ $notification->created_at->diffForHumans() }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- End Item -->
                                                @empty
                                                <div class="p-3 text-center" id="notifEmpty">
                                                    <h6 class="m-0">Tidak ada notifikasi</h6>
                                                </div>
                                                @endforelse
                                            </ul>
                                            <!-- End List Group -->
                                        </div>
                                    </div>
                                    <!-- End Tab Content -->
                                </div>
                                <!-- End Body -->

                                <!-- Card Footer -->
                                <a class="card-footer text-center" href="{{ route('dashboard.notification') }}">
                                    Lihat semua notifikasi <i class="bi-chevron-right"></i>
                                </a>
                                <!-- End Card Footer -->
                            </div>
                        </div>
                    </div>
                    <!-- End Notification -->
                </li>

                <li class="nav-item">
                    <!-- Account -->
                    <div class="dropdown">
                        <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
                            <div class="avatar avatar-sm avatar-circle">
                                <img class="avatar-img" src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : 'https://avatars.dicebear.com/api/initials/' . Auth::user()->name . '.png?background=blue' }}" alt="Image Description">
                                <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account" aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                            <div class="dropdown-item-text">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-sm avatar-circle">
                                        <img class="avatar-img" src="{{ Auth::user()->avatar ? asset(Auth::user()->avatar) : 'https://avatars.dicebear.com/api/initials/' . Auth::user()->name . '.png?background=blue' }}" alt="Image Description">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="mb-0">{{Auth::user()->name}}</h5>
                                        <p class="card-text text-body">{{Auth::user()->username}}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item text-center" href="{{route('dashboard.profile.index')}}">Ubah Profil</a>

                            <a class="dropdown-item text-center" href="{{route('dashboard.auth.logout')}}">Keluar</a>
                        </div>
                    </div>
                    <!-- End Account -->
                </li>
            </ul>
            <!-- End Navbar -->
        </div>
    </div>
</header>