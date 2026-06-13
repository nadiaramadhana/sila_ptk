<x-layouts.app>
    <div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-0 fw-semibold">Pengajuan PTK</h4>
            <p class="text-muted mb-0 small">Kelola seluruh pengajuan pendidik dan tenaga kependidikan</p>
        </div>
        <a href="{{ route('pengajuan.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i class="ti ti-plus fs-5"></i>
            Buat Pengajuan
        </a>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="ti ti-circle-check me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="ti ti-alert-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Filter Card --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('pengajuan.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Nomor Pengajuan</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="ti ti-search"></i></span>
                        <input type="text" name="search" class="form-control"
                               placeholder="Cari nomor..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Kategori</label>
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-semibold">Status</label>
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
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

    {{-- Tabel --}}
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width:50px">#</th>
                            <th>Nomor Pengajuan</th>
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
                                    <span class="badge bg-light text-dark border">
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
                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center gap-1">
                                        <a href="{{ route('pengajuan.show', $item) }}"
                                           class="btn btn-sm btn-outline-info" title="Detail">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        @if (in_array($item->status, ['draft', 'ditolak']))
                                            <a href="{{ route('pengajuan.edit', $item) }}"
                                               class="btn btn-sm btn-outline-warning" title="Edit">
                                                <i class="ti ti-pencil"></i>
                                            </a>
                                            <form action="{{ route('pengajuan.destroy', $item) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin hapus pengajuan ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
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
                                    Belum ada data pengajuan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($pengajuans->hasPages())
                <div class="px-4 py-3 border-top">
                    {{ $pengajuans->links() }}
                </div>
            @endif
        </div>
    </div>

</div>
</x-layouts.app>
