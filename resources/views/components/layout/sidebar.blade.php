<aside class="left-sidebar">
    <style>
        .left-sidebar {
            background-color: #0f1f3d !important;
        }

        .left-sidebar .sidebar-link {
            color: rgba(251, 210, 6, 0.75) !important;
        }

        .left-sidebar .sidebar-link i {
            color: rgba(251, 210, 6, 0.75) !important;
        }

        .left-sidebar .sidebar-link:hover {
            background-color: rgba(251, 210, 6, 0.1) !important;
            color: #FBD206 !important;
        }

        .left-sidebar .sidebar-link.active,
        .left-sidebar .sidebar-item.selected>.sidebar-link,
        .left-sidebar .sidebar-nav ul .sidebar-item>.sidebar-link.active,
        .left-sidebar .sidebar-nav ul .sidebar-item.selected>.sidebar-link {
            background-color: rgba(251, 210, 6, 0.15) !important;
            color: #FBD206 !important;
            border-left: 3px solid #FBD206 !important;
        }

        .left-sidebar .sidebar-link.active i,
        .left-sidebar .sidebar-item.selected>.sidebar-link i,
        .left-sidebar .sidebar-link:hover i {
            color: #FBD206 !important;
        }

        .left-sidebar .nav-small-cap {
            color: rgba(251, 210, 6, 0.4) !important;
        }

        .left-sidebar .brand-logo h5 {
            color: #FBD206 !important;
        }

        .left-sidebar .sidebartoggler i {
            color: #FBD206 !important;
        }

        .brand-logo {
            min-height: 80px;
            background-color: #0f1f3d !important;
            border-bottom: 1px solid rgba(251, 210, 6, .15);
        }

        .brand-logo-img {
            width: 50px;
            height: 50px;
            object-fit: contain;
            border-radius: 8px;
            background: #fff;
            padding: 3px;
        }

        .brand-logo h5 {
            font-size: 20px;
            letter-spacing: .5px;
            margin-bottom: 0;
        }

        .brand-subtitle {
            color: #FBD206;
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        /* Box "Upgrade to Pro" disesuaikan ke tema navy + kuning */
        .left-sidebar .unlimited-access {
            background-color: rgba(251, 210, 6, 0.08) !important;
            border: 1px solid rgba(251, 210, 6, 0.2);
        }

        .left-sidebar .unlimited-access h6 {
            color: #FBD206 !important;
        }

        .left-sidebar .unlimited-access .btn-primary {
            background-color: #FBD206 !important;
            border-color: #FBD206 !important;
            color: #0f1f3d !important;
        }
    </style>

    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between px-3">
            <a href="{{ route('dashboard') }}" class="text-decoration-none d-flex align-items-center">

                <img src="{{ asset('template/assets/images/logo_ketapang.jpeg') }}" alt="Logo Kabupaten Ketapang"
                    class="brand-logo-img">

                <div class="ms-2">
                    <h5 class="fw-bold mb-0">
                        SILA-PTK
                    </h5>

                    <small class="brand-subtitle">
                        DINAS PENDIDIKAN
                    </small>
                </div>
            </a>

            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">HOME</span>
                    </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}" aria-expanded="false">
                        <span><i class="ti ti-layout-dashboard"></i></span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @role('operator_sekolah')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('dashboard/sekolah*') ? 'active' : '' }}"
                        href="{{ route('sekolah.my') }}" aria-expanded="false">
                        <span><i class="ti ti-school"></i></span>
                        <span class="hide-menu">Sekolah Saya</span>
                    </a>
                </li>
                @endrole

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
                        <a href="{{ route('operator') }}"
                            class="sidebar-link {{ request()->is('dashboard/operator*') ? 'active' : '' }}">
                            <span><i class="ti ti-users"></i></span>
                            <span class="hide-menu">Operator</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('dashboard/data-ptk*') ? 'active' : '' }}"
                            href="{{ route('data-ptk') }}" aria-expanded="false">
                            <span><i class="ti ti-users"></i></span>
                            <span class="hide-menu">Data PTK</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link @if (request()->is('dashboard/pengajuan*')) active @endif"
                            href="{{ route('pengajuan.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-file-description"></i>
                            </span>
                            <span class="hide-menu">Layanan Online</span>
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
