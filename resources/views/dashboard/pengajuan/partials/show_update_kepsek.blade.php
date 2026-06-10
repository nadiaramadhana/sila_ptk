{{-- resources/views/pengajuan/partials/show_update_kepsek.blade.php --}}
{{-- Dipakai di show.blade.php via @include('pengajuan.partials.show_update_kepsek') --}}

<div class="row g-3">

    <div class="col-md-6">
        <p class="text-muted small mb-1">Status Kepala Sekolah</p>
        <p class="fw-semibold mb-0">{{ $detail->status_kepsek }}</p>
    </div>
    <div class="col-md-6">
        <p class="text-muted small mb-1">Alasan Pergantian</p>
        <p class="fw-semibold mb-0">
            {{ str_replace('_', ' ', $detail->alasan_pergantian) }}
            @if ($detail->alasan_lainnya) <span class="text-muted">({{ $detail->alasan_lainnya }})</span> @endif
        </p>
    </div>

    <div class="col-12"><hr class="my-1"></div>

    <div class="col-md-6">
        <p class="text-muted small mb-1">Nama Lengkap</p>
        <p class="fw-semibold mb-0">{{ $detail->nama_lengkap }}</p>
    </div>
    <div class="col-md-3">
        <p class="text-muted small mb-1">NIK</p>
        <p class="fw-semibold mb-0">{{ $detail->nik }}</p>
    </div>
    <div class="col-md-3">
        <p class="text-muted small mb-1">NUPTK</p>
        <p class="fw-semibold mb-0">{{ $detail->nuptk ?? '-' }}</p>
    </div>
    <div class="col-md-3">
        <p class="text-muted small mb-1">NIP / NIPPPK</p>
        <p class="fw-semibold mb-0">{{ $detail->nip_nipppk ?? '-' }}</p>
    </div>
    <div class="col-md-3">
        <p class="text-muted small mb-1">Tempat, Tgl Lahir</p>
        <p class="fw-semibold mb-0">{{ $detail->tempat_lahir }}, {{ $detail->tanggal_lahir?->format('d M Y') }}</p>
    </div>
    <div class="col-md-3">
        <p class="text-muted small mb-1">Golongan</p>
        <p class="fw-semibold mb-0">{{ $detail->golongan ?? '-' }}</p>
    </div>

    <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Tempat Tugas</p></div>

    <div class="col-md-6">
        <p class="text-muted small mb-1">Nama Tempat Tugas Asal</p>
        <p class="fw-semibold mb-0">{{ $detail->nama_tempat_tugas_asal }} <span class="text-muted small">({{ $detail->kecamatan_asal }})</span></p>
    </div>
    <div class="col-md-6">
        <p class="text-muted small mb-1">Nama Tempat Tugas Sekarang</p>
        <p class="fw-semibold mb-0">{{ $detail->nama_tempat_tugas_sekarang }} <span class="text-muted small">({{ $detail->kecamatan_sekarang }})</span></p>
    </div>

    <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Data SK</p></div>

    <div class="col-md-4">
        <p class="text-muted small mb-1">Nomor SK</p>
        <p class="fw-semibold mb-0">{{ $detail->nomor_sk }}</p>
    </div>
    <div class="col-md-4">
        <p class="text-muted small mb-1">Tanggal SK</p>
        <p class="fw-semibold mb-0">{{ $detail->tanggal_sk?->format('d M Y') }}</p>
    </div>
    <div class="col-md-4">
        <p class="text-muted small mb-1">TMT</p>
        <p class="fw-semibold mb-0">{{ $detail->tmt?->format('d M Y') }}</p>
    </div>

    @if ($detail->scan_sk)
    <div class="col-md-6">
        <p class="text-muted small mb-1">Scan SK</p>
        <a href="{{ Storage::url($detail->scan_sk) }}" target="_blank" class="btn btn-sm btn-outline-primary">
            <i class="ti ti-file-download me-1"></i>Lihat Dokumen
        </a>
    </div>
    @endif

</div>

{{-- Pola yang sama berlaku untuk show partial lainnya --}}
{{-- Buat file show_mutasi_ptk.blade.php, show_perbaikan_rombel.blade.php, dst. --}}
{{-- dengan menampilkan field sesuai tabel detail masing-masing --}}
