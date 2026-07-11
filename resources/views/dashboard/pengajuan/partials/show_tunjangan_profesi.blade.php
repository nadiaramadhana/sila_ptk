{{-- resources/views/dashboard/pengajuan/partials/show_tunjangan_profesi.blade.php --}}
<div class="row g-3">

    <div class="col-md-6">
        <p class="text-muted small mb-1">Nama Lengkap</p>
        <p class="fw-semibold mb-0">{{ $detail->nama_lengkap }}</p>
    </div>
    <div class="col-md-3">
        <p class="text-muted small mb-1">NIP / NIPPPK</p>
        <p class="fw-semibold mb-0">{{ $detail->nip_nipppk ?? '-' }}</p>
    </div>
    <div class="col-md-3">
        <p class="text-muted small mb-1">NUPTK</p>
        <p class="fw-semibold mb-0">{{ $detail->nuptk ?? '-' }}</p>
    </div>

    <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Tempat Tugas & Periode</p></div>

    <div class="col-md-6">
        <p class="text-muted small mb-1">Nama Sekolah</p>
        <p class="fw-semibold mb-0">{{ $detail->nama_sekolah }}</p>
    </div>
    <div class="col-md-6">
        <p class="text-muted small mb-1">Kecamatan</p>
        <p class="fw-semibold mb-0">{{ $detail->kecamatan }}</p>
    </div>
    <div class="col-md-6">
        <p class="text-muted small mb-1">Periode</p>
        <p class="fw-semibold mb-0">{{ str_replace('_', ' ', $detail->periode) }}</p>
    </div>
    <div class="col-md-6">
        <p class="text-muted small mb-1">Tahun</p>
        <p class="fw-semibold mb-0">{{ $detail->tahun }}</p>
    </div>

    @include('dashboard.pengajuan.partials._dokumen', ['files' => [
        'scan_sertifikat_pendidik' => 'Scan Sertifikat Pendidik',
        'scan_sk_mengajar'         => 'Scan SK Mengajar',
        'scan_dokumen_pendukung'   => 'Scan Dokumen Pendukung',
    ]])

</div>
