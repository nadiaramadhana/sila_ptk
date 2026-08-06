<x-layouts.app>
    {{-- Greeting --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-1 fw-semibold">
                Selamat Datang, {{ Auth::user()->name }}
            </h4>
            <p class="text-muted mb-0 small">{{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
    </div>

    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-primary bg-opacity-10"
                         style="width:52px;height:52px;flex-shrink:0;">
                        <i class="ti ti-users fs-4 text-primary"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-3">{{ $totalPtk }}</div>
                        <div class="text-muted small">Total PTK</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="rounded-circle d-flex align-items-center justify-content-center bg-success bg-opacity-10"
                         style="width:52px;height:52px;flex-shrink:0;">
                        <i class="ti ti-school fs-4 text-success"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-3">{{ $totalSekolah }}</div>
                        <div class="text-muted small">Total Sekolah</div>
                    </div>
                </div>
            </div>
        </div>
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
                        <div class="text-muted small">Perlu Diproses</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        {{-- Chart Pengajuan Per Bulan --}}
        <div class="col-12 col-lg-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between py-3">
                    <h6 class="mb-0 fw-semibold">Pengajuan per Bulan ({{ now()->year }})</h6>
                </div>
                <div class="card-body">
                    <div id="chartPengajuan"></div>
                </div>
            </div>
        </div>

        {{-- PTK per Kategori --}}
        <div class="col-12 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="mb-0 fw-semibold">PTK per Kategori</h6>
                </div>
                <div class="card-body">
                    @forelse ($ptkPerKategori as $kat)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="small fw-medium">{{ $kat->jenis_kategori }}</span>
                                <span class="small text-muted">{{ $kat->data_ptk_count }}</span>
                            </div>
                            <div class="progress" style="height:6px;">
                                <div class="progress-bar bg-primary"
                                     style="width:{{ $totalPtk > 0 ? round($kat->data_ptk_count / $totalPtk * 100) : 0 }}%">
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small mb-0">Belum ada Data Kategori</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Pengajuan Terbaru --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between py-3">
            <h6 class="mb-0 fw-semibold">Pengajuan Terbaru</h6>
            <a href="{{ route('pengajuan.index') }}" class="btn btn-sm btn-outline-primary">
                Lihat Semua
            </a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-white">
                        <tr>
                            <th class="ps-4 py-3 small fw-semibold text-muted">No.</th>
                            <th class="py-3 small fw-semibold text-muted">Nomor Pengajuan</th>
                            <th class="py-3 small fw-semibold text-muted">Kategori</th>
                            <th class="py-3 small fw-semibold text-muted">Pengaju</th>
                            <th class="py-3 small fw-semibold text-muted">Tanggal</th>
                            <th class="py-3 small fw-semibold text-muted">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajuanTerbaru as $i => $pgj)
                            @php
                                $badge = \App\Models\Pengajuan::$statusLabels[$pgj->status] ?? ['label' => $pgj->status, 'class' => 'bg-secondary'];
                            @endphp
                            <tr>
                                <td class="ps-4 text-muted small">{{ $i + 1 }}</td>
                                <td>
                                    <a href="{{ route('pengajuan.show', $pgj->id) }}"
                                       class="fw-medium text-decoration-none">
                                        {{ $pgj->nomor_pengajuan }}
                                    </a>
                                </td>
                                <td class="small">{{ $pgj->kategori->nama ?? '-' }}</td>
                                <td class="small">{{ $pgj->user->name ?? '-' }}</td>
                                <td class="small text-muted">{{ $pgj->created_at->translatedFormat('d M Y') }}</td>
                                <td>
                                    <span class="badge {{ $badge['class'] }} rounded-pill px-3">
                                        {{ $badge['label'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4 small">
                                    Belum ada Pengajuan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.41.0/apexcharts.min.js"></script>
    <script>
        const options = {
            chart: {
                type: 'bar',
                height: 280,
                toolbar: { show: false },
                fontFamily: 'inherit'
            },
            series: [{
                name: 'Pengajuan',
                data: {!! $bulanData !!}
            }],
            xaxis: {
                categories: {!! $bulanLabels !!},
                labels: { style: { fontSize: '12px' } }
            },
            yaxis: {
                labels: { style: { fontSize: '12px' } },
                min: 0,
                tickAmount: 4,
            },
            colors: ['#5d87ff'],
            plotOptions: {
                bar: { borderRadius: 4, columnWidth: '45%' }
            },
            dataLabels: { enabled: false },
            grid: { borderColor: '#f0f0f0', strokeDashArray: 4 },
            tooltip: { theme: 'light' },
        };

        new ApexCharts(document.querySelector('#chartPengajuan'), options).render();
    </script>
    @endpush

    @stack('scripts')
</x-layouts.app>
