<x-layouts.app>
    {{-- Greeting --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">
                Selamat Datang, {{ Auth::user()->name }}
            </h4>
            <p class="text-muted mb-0 small">{{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
        {{-- <a href="{{ route('pengajuan.create') }}" class="btn btn-primary btn-sm">
            <i class="ti ti-plus me-1"></i> Buat Pengajuan
        </a> --}}
    </div>

    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-info bg-opacity-10"
                         style="width:52px;height:52px;flex-shrink:0;">
                        <i class="ti ti-file-description fs-4 text-info"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-3">{{ $totalPengajuan }}</div>
                        <div class="text-muted small">Total Pengajuan</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-warning bg-opacity-10"
                         style="width:52px;height:52px;flex-shrink:0;">
                        <i class="ti ti-clock fs-4 text-warning"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-3">{{ $pengajuanMenunggu }}</div>
                        <div class="text-muted small">Menunggu Proses</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10"
                         style="width:52px;height:52px;flex-shrink:0;">
                        <i class="ti ti-circle-check fs-4 text-success"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-3">{{ $pengajuanSelesai }}</div>
                        <div class="text-muted small">Selesai</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        {{-- Sekolah Operator --}}
        <div class="col-12 col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between py-3">
                    <h6 class="mb-0 fw-semibold">Sekolah Saya</h6>
                </div>
                <div class="card-body p-0">
                    @forelse ($sekolahOperator as $skl)
                        <div class="d-flex align-items-start gap-3 px-4 py-3 border-bottom">
                            <div class="rounded-circle d-flex align-items-center justify-content-center bg-primary bg-opacity-10 flex-shrink-0"
                                 style="width:40px;height:40px;">
                                <i class="ti ti-building-community text-primary"></i>
                            </div>
                            <div class="flex-grow-1 min-w-0">
                                <div class="fw-semibold small text-truncate">{{ $skl->nama_sekolah }}</div>
                                <div class="text-muted" style="font-size:0.78rem;">
                                    NPSN: {{ $skl->npsn_sekolah }}
                                    &bull; {{ $skl->jenjang_sekolah }}
                                </div>
                                @if ($skl->kecamatan)
                                    <div class="text-muted" style="font-size:0.78rem;">
                                        <i class="ti ti-map-pin me-1"></i>{{ $skl->kecamatan->nama_kecamatan ?? '-' }}
                                    </div>
                                @endif
                            </div>
                            <a href="{{ route('sekolah.show', $skl->id) }}"
                               class="btn btn-sm btn-outline-secondary flex-shrink-0" style="font-size:0.75rem;">
                                Detail
                            </a>
                        </div>
                    @empty
                        <div class="text-center text-muted py-5 small">
                            <i class="ti ti-school-off fs-2 d-block mb-2"></i>
                            Belum ada sekolah yang ditugaskan.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Pengajuan Operator --}}
        <div class="col-12 col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between py-3">
                    <h6 class="mb-0 fw-semibold">Pengajuan Saya</h6>
                    <a href="{{ route('pengajuan.index') }}" class="btn btn-sm btn-outline-primary">
                        Lihat Semua
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-white">
                                <tr>
                                    <th class="ps-4 py-3 small fw-semibold text-muted">No. Pengajuan</th>
                                    <th class="py-3 small fw-semibold text-muted">Kategori</th>
                                    <th class="py-3 small fw-semibold text-muted">Tanggal</th>
                                    <th class="py-3 small fw-semibold text-muted">Status</th>
                                    <th class="py-3 small fw-semibold text-muted"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($pengajuanOperator->take(8) as $pgj)
                                    @php
                                        $badge = \App\Models\Pengajuan::$statusLabels[$pgj->status]
                                            ?? ['label' => $pgj->status, 'class' => 'bg-secondary'];
                                    @endphp
                                    <tr>
                                        <td class="ps-4">
                                            <span class="fw-medium small">{{ $pgj->nomor_pengajuan }}</span>
                                        </td>
                                        <td class="small">{{ $pgj->kategori->nama ?? '-' }}</td>
                                        <td class="small text-muted">
                                            {{ $pgj->created_at->translatedFormat('d M Y') }}
                                        </td>
                                        <td>
                                            <span class="badge {{ $badge['class'] }} rounded-pill px-2">
                                                {{ $badge['label'] }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('pengajuan.show', $pgj->id) }}"
                                               class="btn btn-sm btn-outline-secondary" style="font-size:0.75rem;">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-5 small">
                                            <i class="ti ti-file-off fs-2 d-block mb-2"></i>
                                            Belum ada pengajuan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
