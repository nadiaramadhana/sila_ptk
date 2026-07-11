{{-- resources/views/dashboard/pengajuan/partials/show_mutasi_ptk.blade.php --}}
<div class="row g-3">

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
    <div class="col-md-3">
        <p class="text-muted small mb-1">Pendidikan Terakhir</p>
        <p class="fw-semibold mb-0">{{ $detail->pendidikan_terakhir }} <span class="text-muted small">{{ $detail->jurusan_pendidikan_terakhir }}</span></p>
    </div>

    <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Jenis & Jabatan PTK</p></div>

    <div class="col-md-4">
        <p class="text-muted small mb-1">Jenis PTK</p>
        <p class="fw-semibold mb-0">
            {{ str_replace('_', ' ', $detail->jenis_ptk) }}
            @if ($detail->jenis_ptk_lainnya) <span class="text-muted">({{ $detail->jenis_ptk_lainnya }})</span> @endif
        </p>
    </div>
    <div class="col-md-4">
        <p class="text-muted small mb-1">Jabatan PTK</p>
        <p class="fw-semibold mb-0">{{ $detail->jabatan_ptk ?? '-' }}</p>
    </div>
    <div class="col-md-4">
        <p class="text-muted small mb-1">Sebagai Sekolah</p>
        <p class="fw-semibold mb-0">{{ $detail->sebagai_sekolah ?? '-' }}</p>
    </div>

    <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Tempat Tugas</p></div>

    <div class="col-md-6">
        <p class="text-muted small mb-1">Tempat Tugas Asal</p>
        <p class="fw-semibold mb-0">{{ $detail->nama_tempat_tugas_asal }} <span class="text-muted small">({{ $detail->kecamatan_asal }})</span></p>
    </div>
    <div class="col-md-6">
        <p class="text-muted small mb-1">Tempat Tugas Tujuan</p>
        <p class="fw-semibold mb-0">{{ $detail->nama_tempat_tugas_tujuan }} <span class="text-muted small">({{ $detail->kecamatan_tujuan }})</span></p>
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

    @include('dashboard.pengajuan.partials._dokumen', ['files' => [
        'scan_sk' => 'Scan SK',
    ]])

</div>
