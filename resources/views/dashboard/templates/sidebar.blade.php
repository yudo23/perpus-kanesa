<aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <!-- Logo -->

            <a class="navbar-brand" href="{{route('dashboard.index')}}" aria-label="Front">
                <img class="navbar-brand-logo" src="{{ asset(\SettingHelper::settings('dashboard', 'logo_large_dark') ?? 'templates/dashboard/assets/svg/logos/logo.svg') }}" alt="Logo" data-hs-theme-appearance="default">
                <img class="navbar-brand-logo" src="{{ asset(\SettingHelper::settings('dashboard', 'logo_large_light') ?? 'templates/dashboard/assets/svg/logos-light/logo.svg') }}" alt="Logo" data-hs-theme-appearance="dark">
                <img class="navbar-brand-logo-mini" src="{{ asset(\SettingHelper::settings('dashboard', 'logo_mini_dark') ?? 'templates/dashboard/assets/svg/logos-light/logo-short.svg') }}" alt="Logo" data-hs-theme-appearance="default">
                <img class="navbar-brand-logo-mini" src="{{ asset(\SettingHelper::settings('dashboard', 'logo_mini_light') ?? 'templates/dashboard/assets/svg/logos-light/logo-short.svg') }}" alt="Logo" data-hs-theme-appearance="dark">
            </a>

            <!-- End Logo -->

            <!-- Navbar Vertical Toggle -->
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
            </button>

            <!-- End Navbar Vertical Toggle -->

            <!-- Content -->
            <div class="navbar-vertical-content">
                <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">

                    <span class="dropdown-header mt-4">Utama</span>
                    <small class="bi-three-dots nav-subtitle-replacer"></small>

                    @if(Auth::user()->hasRole([\App\Enums\RoleEnum::SUPERADMIN,\App\Enums\RoleEnum::ADMINISTRATOR]))
                    <div class="nav-item">
                        <a class="nav-link d-flex align-items-center " href="{{route('dashboard.index')}}" data-placement="left">
                            <i class="fa fa-tachometer nav-icon"></i>
                            <span class="nav-link-title">Dashboard</span>
                        </a>
                    </div>
                    @endif

                    @if(Auth::user()->hasRole([\App\Enums\RoleEnum::SUPERADMIN,\App\Enums\RoleEnum::ADMINISTRATOR]))
                    <div class="nav-item">
                        <a class="nav-link d-flex align-items-center " href="{{route('dashboard.biblios.index')}}" data-placement="left">
                            <i class="fa fa-book nav-icon"></i>
                            <span class="nav-link-title">Buku</span>
                        </a>
                    </div>
                    @endif

                    @if(Auth::user()->hasRole([\App\Enums\RoleEnum::SUPERADMIN,\App\Enums\RoleEnum::ADMINISTRATOR]))
                    <div class="nav-item">
                        <a class="nav-link d-flex align-items-center " href="{{route('dashboard.contacts.index')}}" data-placement="left">
                            <i class="fa fa-envelope nav-icon"></i>
                            <span class="nav-link-title">Pesan Masuk</span>
                        </a>
                    </div>
                    @endif

                    @if(Auth::user()->hasRole([\App\Enums\RoleEnum::SUPERADMIN,\App\Enums\RoleEnum::ADMINISTRATOR]))
                    <div class="nav-item">
                        <a class="nav-link d-flex align-items-center " href="{{route('dashboard.students.index')}}" data-placement="left">
                            <i class="fa fa-graduation-cap nav-icon"></i>
                            <span class="nav-link-title">Siswa</span>
                        </a>
                    </div>
                    @endif

                    @if(Auth::user()->hasRole([\App\Enums\RoleEnum::SUPERADMIN]))
                    <div class="nav-item">
                        <a class="nav-link d-flex align-items-center " href="{{route('dashboard.users.index')}}" data-placement="left">
                            <i class="fa fa-users nav-icon"></i>
                            <span class="nav-link-title">Pengguna</span>
                        </a>
                    </div>
                    @endif
    
                    @if(Auth::user()->hasRole([\App\Enums\RoleEnum::SUPERADMIN]))
                    <div class="nav-item">
                        <a class="nav-link dropdown-toggle " href="#navbarSettting" role="button" data-bs-toggle="collapse" data-bs-target="#navbarSettting" aria-expanded="false" aria-controls="navbarSettting">
                            <i class="fa fa-cog nav-icon"></i>
                            <span class="nav-link-title">Pengaturan</span>
                        </a>

                        <div id="navbarSettting" class="nav-collapse collapse " data-bs-parent="#navbarVerticalMenuPagesMenu">
                            <a class="nav-link " href="{{route('dashboard.settings.dashboard.index')}}">Dashboard</a>
                            <a class="nav-link " href="/dashboard/user-activity">Aktivitas</a>
                            <a class="nav-link " href="/dashboard/logs">Log Error</a>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
            <!-- End Content -->

            <!-- Footer -->
            <div class="navbar-vertical-footer">
                <ul class="navbar-vertical-footer-list">
                    <li class="navbar-vertical-footer-list-item">
                        <!-- Style Switcher -->
                        <div class="dropdown dropup">
                            <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>

                            </button>

                            <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown">
                                <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                                    <i class="bi-moon-stars me-2"></i>
                                    <span class="text-truncate" title="Auto (system default)">Auto (system default)</span>
                                </a>
                                <a class="dropdown-item" href="#" data-icon="bi-brightness-high" data-value="default">
                                    <i class="bi-brightness-high me-2"></i>
                                    <span class="text-truncate" title="Default (light mode)">Default (light mode)</span>
                                </a>
                                <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">
                                    <i class="bi-moon me-2"></i>
                                    <span class="text-truncate" title="Dark">Dark</span>
                                </a>
                            </div>
                        </div>

                        <!-- End Style Switcher -->
                    </li>
                </ul>
            </div>
            <!-- End Footer -->
        </div>
    </div>
</aside>