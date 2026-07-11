{{-- resources/views/dashboard/pengajuan/partials/show_penerbitan_nuptk.blade.php --}}
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
        <p class="text-muted small mb-1">NIP / NIPPPK</p>
        <p class="fw-semibold mb-0">{{ $detail->nip_nipppk ?? '-' }}</p>
    </div>
    <div class="col-md-4">
        <p class="text-muted small mb-1">Tempat, Tgl Lahir</p>
        <p class="fw-semibold mb-0">{{ $detail->tempat_lahir }}, {{ $detail->tanggal_lahir?->format('d M Y') }}</p>
    </div>
    <div class="col-md-4">
        <p class="text-muted small mb-1">Pendidikan Terakhir</p>
        <p class="fw-semibold mb-0">{{ $detail->pendidikan_terakhir }}</p>
    </div>
    <div class="col-md-4">
        <p class="text-muted small mb-1">Jurusan</p>
        <p class="fw-semibold mb-0">{{ $detail->jurusan }}</p>
    </div>

    <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Tempat Tugas</p></div>

    <div class="col-md-6">
        <p class="text-muted small mb-1">Nama Sekolah</p>
        <p class="fw-semibold mb-0">{{ $detail->nama_sekolah }}</p>
    </div>
    <div class="col-md-6">
        <p class="text-muted small mb-1">Kecamatan</p>
        <p class="fw-semibold mb-0">{{ $detail->kecamatan }}</p>
    </div>

    @if ($detail->keterangan)
    <div class="col-12">
        <p class="text-muted small mb-1">Keterangan</p>
        <p class="fw-semibold mb-0">{{ $detail->keterangan }}</p>
    </div>
    @endif

    @include('dashboard.pengajuan.partials._dokumen', ['files' => [
        'scan_ijazah'          => 'Scan Ijazah',
        'scan_sk_pengangkatan' => 'Scan SK Pengangkatan',
        'scan_ktp'             => 'Scan KTP',
        'scan_kk'              => 'Scan Kartu Keluarga',
    ]])

</div>
