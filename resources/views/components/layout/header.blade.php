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
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown d-flex align-items-center">

                    @php
                        $inisial = collect(explode(' ', Auth::user()->name))
                            ->take(2)
                            ->map(fn($w) => strtoupper($w[0]))
                            ->implode('');

                        $avatarStyle = match(true) {
                            Auth::user()->hasRole('admin')            => 'background:#e3f2fd;color:#1565c0',
                            Auth::user()->hasRole('kepala_dinas')     => 'background:#fff8e1;color:#f57f17',
                            Auth::user()->hasRole('operator_sekolah') => 'background:#e8f5e9;color:#2e7d32',
                            default                                   => 'background:#f5f5f5;color:#555',
                        };
                    @endphp

                    <a class="nav-link d-flex align-items-center gap-2" href="javascript:void(0)" id="drop2"
                       data-bs-toggle="dropdown" aria-expanded="false" style="cursor:pointer;">
                        <div style="width:40px;height:40px;border-radius:50%;{{ $avatarStyle }};
                                    display:flex;align-items:center;justify-content:center;
                                    font-size:14px;font-weight:600;
                                    border:2px solid rgba(0,0,0,0.08);flex-shrink:0;">
                            {{ $inisial }}
                        </div>
                        <span class="d-none d-sm-inline">{{ Auth::user()->name }}</span>
                        <i class="ti ti-chevron-down small"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                         aria-labelledby="drop2">
                        <div class="message-body">
                            <a href="{{ url('admin/profile') }}"
                               class="d-flex align-items-center gap-2 dropdown-item">
                                <i class="ti ti-user fs-6"></i>
                                <span class="mb-0 fs-3">Profile</span>
                            </a>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item d-flex align-items-center gap-2 text-danger" type="submit">
                                    <i class="ti ti-power fs-6"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>

                </li>
            </ul>
        </div>
    </nav>
</header>
