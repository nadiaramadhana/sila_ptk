<x-layouts.app>
<div class="container-fluid">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('pengajuan.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="ti ti-arrow-left"></i>
        </a>
        <div class="flex-grow-1">
            <h4 class="mb-0 fw-semibold">{{ $pengajuan->nomor_pengajuan }}</h4>
            <p class="text-muted mb-0 small">{{ $pengajuan->kategori->nama ?? '-' }}</p>
        </div>
        @php $s = \App\Models\Pengajuan::$statusLabels[$pengajuan->status] ?? null @endphp
        @if ($s)
            <span class="badge {{ $s['class'] }} fs-6 px-3 py-2">{{ $s['label'] }}</span>
        @endif
    </div>

    {{-- Info Pengajuan --}}
    <div class="card mb-4">
        <div class="card-header fw-semibold d-flex align-items-center gap-2">
            <i class="ti ti-info-circle text-primary"></i> Informasi Pengajuan
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <p class="text-muted small mb-1">Nomor Pengajuan</p>
                    <p class="fw-semibold font-monospace mb-0">{{ $pengajuan->nomor_pengajuan }}</p>
                </div>
                <div class="col-md-4">
                    <p class="text-muted small mb-1">Kategori</p>
                    <p class="fw-semibold mb-0">{{ $pengajuan->kategori->nama ?? '-' }}</p>
                </div>
                <div class="col-md-4">
                    <p class="text-muted small mb-1">Diajukan Oleh</p>
                    <p class="fw-semibold mb-0">{{ $pengajuan->user->name ?? '-' }}</p>
                </div>
                <div class="col-md-4">
                    <p class="text-muted small mb-1">Tanggal Pengajuan</p>
                    <p class="fw-semibold mb-0">{{ $pengajuan->created_at->format('d M Y, H:i') }}</p>
                </div>
                <div class="col-md-4">
                    <p class="text-muted small mb-1">Status</p>
                    @if ($s)
                        <span class="badge {{ $s['class'] }}">{{ $s['label'] }}</span>
                    @endif
                </div>
                @if ($pengajuan->tanggal_proses)
                <div class="col-md-4">
                    <p class="text-muted small mb-1">Diproses Pada</p>
                    <p class="fw-semibold mb-0">
                        <i class="ti ti-clock-play text-warning me-1"></i>
                        {{ $pengajuan->tanggal_proses->format('d M Y, H:i') }}
                    </p>
                </div>
                @endif
                @if ($pengajuan->tanggal_selesai)
                <div class="col-md-4">
                    <p class="text-muted small mb-1">Selesai Pada</p>
                    <p class="fw-semibold mb-0">
                        <i class="ti ti-circle-check text-success me-1"></i>
                        {{ $pengajuan->tanggal_selesai->format('d M Y, H:i') }}
                    </p>
                </div>
                @endif
                @if ($pengajuan->catatan_penolakan)
                <div class="col-12">
                    <div class="alert alert-danger mb-0">
                        <strong><i class="ti ti-x me-1"></i>Catatan Penolakan:</strong>
                        <p class="mb-0 mt-1">{{ $pengajuan->catatan_penolakan }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Detail per Kategori --}}
    @php $detail = $pengajuan->detail; $slug = $pengajuan->kategori?->slug; @endphp

    @if ($detail)
    <div class="card mb-4">
        <div class="card-header fw-semibold d-flex align-items-center gap-2">
            <i class="ti ti-file-description text-primary"></i> Detail Pengajuan
        </div>
        <div class="card-body">
            @include('dashboard.pengajuan.partials.show_' . str_replace('-', '_', $slug), ['detail' => $detail])
        </div>
    </div>
    @endif

    {{-- Admin: ubah status --}}
    @role('admin')
    <div class="card mb-4">
        <div class="card-header fw-semibold d-flex align-items-center gap-2">
            <i class="ti ti-settings text-primary"></i> Validasi/Tindak Lanjut
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('pengajuan.update-status', $pengajuan) }}">
                @csrf @method('PATCH')
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Status Pengajuan</label>
                        <select name="status" id="statusAdmin" class="form-select">
                            <option value="diproses" {{ $pengajuan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="selesai"  {{ $pengajuan->status == 'selesai'  ? 'selected' : '' }}>Selesai</option>
                            <option value="ditolak"  {{ $pengajuan->status == 'ditolak'  ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-6" id="catatanWrap" style="{{ $pengajuan->status == 'ditolak' ? '' : 'display:none' }}">
                        <label class="form-label">Catatan Penolakan</label>
                        <input type="text" name="catatan_penolakan" class="form-control"
                               value="{{ $pengajuan->catatan_penolakan }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endrole

    {{-- Action buttons --}}
    <div class="d-flex gap-2">
        @if (in_array($pengajuan->status, ['draft', 'ditolak']))
            <a href="{{ route('pengajuan.edit', $pengajuan) }}" class="btn btn-warning">
                <i class="ti ti-pencil me-1"></i>Edit Pengajuan
            </a>
            <form action="{{ route('pengajuan.destroy', $pengajuan) }}" method="POST"
                  class="js-delete-form"
                  data-confirm-text="Pengajuan yang dihapus tidak dapat dikembalikan.">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="ti ti-trash me-1"></i>Hapus
                </button>
            </form>
        @endif
        <a href="{{ route('pengajuan.index') }}" class="btn btn-outline-secondary">
            <i class="ti ti-arrow-left me-1"></i>Kembali
        </a>
    </div>

</div>

@push('scripts')
<script>
document.getElementById('statusAdmin')?.addEventListener('change', function () {
    document.getElementById('catatanWrap').style.display = this.value === 'ditolak' ? '' : 'none';
});
</script>
@endpush
</x-layouts.app>
