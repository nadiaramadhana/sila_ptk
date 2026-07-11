{{-- resources/views/dashboard/pengajuan/partials/show_penerbitan_nrg.blade.php --}}
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
    <div class="col-md-4">
        <p class="text-muted small mb-1">NIP / NIPPPK</p>
        <p class="fw-semibold mb-0">{{ $detail->nip_nipppk ?? '-' }}</p>
    </div>
    <div class="col-md-4">
        <p class="text-muted small mb-1">Tempat, Tgl Lahir</p>
        <p class="fw-semibold mb-0">{{ $detail->tempat_lahir }}, {{ $detail->tanggal_lahir?->format('d M Y') }}</p>
    </div>

    <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Tempat Tugas & Usulan</p></div>

    <div class="col-md-6">
        <p class="text-muted small mb-1">Nama Sekolah</p>
        <p class="fw-semibold mb-0">{{ $detail->nama_sekolah }}</p>
    </div>
    <div class="col-md-6">
        <p class="text-muted small mb-1">Kecamatan</p>
        <p class="fw-semibold mb-0">{{ $detail->kecamatan }}</p>
    </div>
    <div class="col-md-6">
        <p class="text-muted small mb-1">Jenis Usulan</p>
        <p class="fw-semibold mb-0">{{ str_replace('_', ' ', $detail->jenis_usulan) }}</p>
    </div>
    @if ($detail->nomor_nrg_lama)
    <div class="col-md-6">
        <p class="text-muted small mb-1">Nomor NRG Lama</p>
        <p class="fw-semibold mb-0">{{ $detail->nomor_nrg_lama }}</p>
    </div>
    @endif

    @include('dashboard.pengajuan.partials._dokumen', ['files' => [
        'scan_sertifikat_pendidik' => 'Scan Sertifikat Pendidik',
        'scan_sk_pengangkatan'     => 'Scan SK Pengangkatan',
    ]])

</div>
