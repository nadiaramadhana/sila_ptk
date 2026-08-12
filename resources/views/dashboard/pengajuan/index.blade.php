<x-layouts.app>
    <div class="container-fluid">
        {{-- HEADER CARD  (kartu putih judul & subjudul) --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body py-3 px-4 d-flex align-items-center justify-content-between">
                <div>
                    <h4 class="mb-0 fw-semibold">Layanan Pendidik & Tenaga Kependidikan</h4>
                    <p class="text-muted mb-0 small">Kelola Seluruh Layanan Pendidik & Tenaga Kependidikan</p>
                </div>
                @role('operator_sekolah')
                    <a href="{{ route('pengajuan.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                        <i class="ti ti-plus fs-5"></i>
                        Ajukan Layanan
                    </a>
                @endrole
                @role('admin')
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalExport">
                        <i class="ti ti-file-spreadsheet me-1"></i>Export Excel
                    </button>
                @endrole
            </div>
        </div>

        {{-- FILTER CARD --}}
        <div class="card mb-4 border-0 shadow-sm">
            <div class="card-body">
                <form method="GET" action="{{ route('pengajuan.index') }}" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Nomor Layanan</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="ti ti-search"></i></span>
                            <input type="text" name="search" class="form-control" placeholder="Cari Nomor..."
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small fw-semibold">Jenis Layanan</label>
                        <select name="kategori" class="form-select">
                            <option value="">Semua Layanan</option>
                            @foreach ($kategoris as $kat)
                                <option value="{{ $kat->id }}"
                                    {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="">Status Layanan</option>
                            @foreach (\App\Models\Pengajuan::$statusLabels as $val => $info)
                                <option value="{{ $val }}" {{ request('status') == $val ? 'selected' : '' }}>
                                    {{ $info['label'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="ti ti-filter me-1"></i>Filter
                        </button>
                        <a href="{{ route('pengajuan.index') }}" class="btn btn-outline-secondary">
                            <i class="ti ti-refresh"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- TABEL DATA --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-white">
                            <tr>
                                <th class="ps-4" style="width:50px">No</th>
                                <th>Nomor Layanan</th>
                                <th>Kategori</th>
                                @role('admin')
                                    <th>Diajukan Oleh</th>
                                @endrole
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th class="text-center pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengajuans as $item)
                                <tr>
                                    <td class="ps-4 text-muted small">
                                        {{ $pengajuans->firstItem() + $loop->index }}
                                    </td>
                                    <td>
                                        <span class="fw-semibold font-monospace small">
                                            {{ $item->nomor_pengajuan }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-dark">
                                            {{ $item->kategori->nama ?? '-' }}
                                        </span>
                                    </td>
                                    @role('admin')
                                        <td class="small">{{ $item->user->name ?? '-' }}</td>
                                    @endrole
                                    <td class="text-muted small">
                                        {{ $item->created_at->format('d M Y') }}
                                    </td>
                                    <td>
                                        @php $s = \App\Models\Pengajuan::$statusLabels[$item->status] ?? null @endphp
                                        @if ($s)
                                            <span class="badge {{ $s['class'] }}">{{ $s['label'] }}</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <a href="{{ route('pengajuan.show', $item) }}" class="btn btn-sm btn-info"
                                                title="Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            @if (in_array($item->status, ['draft', 'ditolak']))
                                                <a href="{{ route('pengajuan.edit', $item) }}"
                                                    class="btn btn-sm btn-outline-warning" title="Edit">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                                <form action="{{ route('pengajuan.destroy', $item) }}" method="POST"
                                                    class="js-delete-form"
                                                    data-confirm-text="Pengajuan yang dihapus tidak dapat dikembalikan.">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Hapus">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="ti ti-inbox fs-1 d-block mb-2"></i>
                                        Belum Ada Data Layanan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="card-footer bg-white border-top">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                        <div class="text-muted small">
                            Menampilkan
                            <strong>{{ $pengajuans->firstItem() ?? 0 }}</strong>
                            -
                            <strong>{{ $pengajuans->lastItem() ?? 0 }}</strong>
                            dari
                            <strong>{{ $pengajuans->total() }}</strong>
                            data.
                        </div>
                        <div>
                            {{ $pengajuans->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @role('admin')
            <div class="modal fade" id="modalExport" tabindex="-1" aria-labelledby="modalExportLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow">

                        <div class="modal-header">
                            <h5 class="modal-title fw-semibold" id="modalExportLabel">
                                <i class="ti ti-file-spreadsheet me-1"></i>
                                Export Data Layanan
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form method="GET" action="{{ route('pengajuan.export') }}">
                            <div class="modal-body">

                                <p class="text-muted small mb-4">
                                    Pilih rentang tahun data layanan yang ingin diekspor.
                                </p>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="tahun_awal" class="form-label fw-semibold">
                                            Tahun Awal
                                        </label>
                                        <select name="tahun_awal" id="tahun_awal" class="form-select" required>
                                            <option value="">Pilih Tahun</option>

                                            @for ($tahun = date('Y'); $tahun >= 2020; $tahun--)
                                                <option value="{{ $tahun }}">
                                                    {{ $tahun }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="tahun_akhir" class="form-label fw-semibold">
                                            Tahun Akhir
                                        </label>
                                        <select name="tahun_akhir" id="tahun_akhir" class="form-select" required>
                                            <option value="">Pilih Tahun</option>

                                            @for ($tahun = date('Y'); $tahun >= 2020; $tahun--)
                                                <option value="{{ $tahun }}">
                                                    {{ $tahun }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                    Batal
                                </button>

                                <button type="submit" class="btn btn-success">
                                    <i class="ti ti-download me-1"></i>
                                    Export Excel
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        @endrole

    </div>
</x-layouts.app>
