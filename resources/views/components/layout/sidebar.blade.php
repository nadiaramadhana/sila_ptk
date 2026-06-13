<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('dashboard') }}" class="text-nowrap logo-img d-flex align-items-center gap-2 text-decoration-none">
                <div class="d-flex align-items-center justify-content-center rounded-2 bg-primary"
                     style="width:36px;height:36px;flex-shrink:0;">
                    <i class="ti ti-school text-white fs-5"></i>
                </div>
                <div class="hide-menu lh-sm">
                    <div class="fw-bold text-dark" style="font-size:0.95rem;letter-spacing:0.5px;">SILA-PTK</div>
                    <div class="text-muted" style="font-size:0.68rem;">Sistem Layanan PTK</div>
                </div>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}" aria-expanded="false">
                        <span><i class="ti ti-layout-dashboard"></i></span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                @hasrole('admin')
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Master Data</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('dashboard/kecamatan*') ? 'active' : '' }}"
                        href="{{ route('kecamatan') }}" aria-expanded="false">
                        <span><i class="ti ti-map"></i></span>
                        <span class="hide-menu">Kecamatan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('dashboard/sekolah*') ? 'active' : '' }}"
                        href="{{ route('sekolah') }}" aria-expanded="false">
                        <span><i class="ti ti-school"></i></span>
                        <span class="hide-menu">Sekolah</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('dashboard/data-ptk*') ? 'active' : '' }}"
                        href="{{ route('data-ptk') }}" aria-expanded="false">
                        <span><i class="ti ti-users"></i></span>
                        <span class="hide-menu">Data PTK</span>
                    </a>
                </li>
                @endhasrole

                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Pengajuan</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('dashboard/pengajuan*') ? 'active' : '' }}"
                        href="{{ route('pengajuan.index') }}" aria-expanded="false">
                        <span><i class="ti ti-file-description"></i></span>
                        <span class="hide-menu">Daftar Pengajuan</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
