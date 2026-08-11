<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>

        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center gap-3"> <!-- Mengubah gap-2 ke gap-3 agar jaraknya lebih pas -->

                {{-- Komponen Lonceng Notifikasi AJAX --}}
                <li class="nav-item dropdown">
                    <a class="nav-link position-relative d-flex align-items-center justify-content-center p-2 rounded-circle"
                       href="javascript:void(0)" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                       style="width: 38px; height: 38px; background-color: #f8f9fa;">
                        <i class="ti ti-bell" style="font-size: 1.25rem; color: #5a6a85;"></i>

                        {{-- Badge Angka Merah (Akan muncul otomatis via AJAX jika ada data) --}}
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none"
                              id="notifBadge" style="font-size: 0.65rem; padding: 0.25em 0.5em;">
                            0
                        </span>
                    </a>

                    {{-- Dropdown Container List Notifikasi --}}
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up shadow border-0 mt-2 p-0"
                         aria-labelledby="notifDropdown" style="width: 320px; max-height: 400px; overflow-y: auto;">
                        <div class="px-3 py-2 border-bottom bg-light">
                            <h6 class="mb-0 fw-semibold" style="font-size: 0.875rem">Notifikasi Terbaru</h6>
                        </div>

                        {{-- Elemen ini yang akan diisi datanya secara dinamis oleh JavaScript --}}
                        <div id="notifItems">
                            <div class="text-center text-muted small py-4">Memuat notifikasi...</div>
                        </div>
                    </div>
                </li>

                {{-- User dropdown (Bawaan Kode Anda) --}}
                <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link d-flex align-items-center gap-2 pe-0"
                       id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">

                        {{-- Avatar inisial --}}
                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0"
                             style="width:38px;height:38px;font-size:.95rem;
                             background: {{ Auth::user()->hasRole('admin') ? '#dc3545' : '#0d6efd' }}">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>

                        <div class="d-none d-md-block text-start lh-sm">
                            <div class="fw-semibold" style="font-size:.875rem">{{ Auth::user()->name }}</div>
                            <div class="text-muted" style="font-size:.75rem">{{ Auth::user()->login_id }}</div>
                        </div>

                        <i class="ti ti-chevron-down text-muted ms-1" style="font-size:.8rem"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up shadow-sm border-0 mt-2"
                         aria-labelledby="userDropdown" style="min-width:220px">

                        {{-- Info user --}}
                        <div class="px-3 py-2 border-bottom">
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white flex-shrink-0"
                                     style="width:40px;height:40px;
                                     background: {{ Auth::user()->hasRole('admin') ? '#dc3545' : '#0d6efd' }}">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-semibold" style="font-size:.875rem">{{ Auth::user()->name }}</div>
                                    <div class="text-muted" style="font-size:.75rem">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                        </div>

                        {{-- Logout --}}
                        <div class="px-3 py-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm w-100 d-flex align-items-center justify-content-center gap-2">
                                    <i class="ti ti-logout"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </nav>
</header>
