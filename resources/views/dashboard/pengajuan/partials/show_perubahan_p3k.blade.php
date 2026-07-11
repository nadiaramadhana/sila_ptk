{{-- resources/views/dashboard/pengajuan/partials/show_perubahan_p3k.blade.php --}}
<div class="row g-3">

    <div class="col-md-6">
        <p class="text-muted small mb-1">Status Kepegawaian Sebelumnya</p>
        <p class="fw-semibold mb-0">{{ str_replace('_', ' ', $detail->status_kepegawaian_sebelum) }}</p>
    </div>
    <div class="col-md-6">
        <p class="text-muted small mb-1">Sertifikasi</p>
        <p class="fw-semibold mb-0">{{ $detail->sertifikasi }}</p>
    </div>

    <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Data Diri</p></div>

    <div class="col-md-6">
        <p class="text-muted small mb-1">Nama Lengkap</p>
        <p class="fw-semibold mb-0">{{ $detail->nama_lengkap }}</p>
    </div>
    <div class="col-md-3">
        <p class="text-muted small mb-1">Jenis Kelamin</p>
        <p class="fw-semibold mb-0">{{ $detail->jenis_kelamin }}</p>
    </div>
    <div class="col-md-3">
        <p class="text-muted small mb-1">Agama</p>
        <p class="fw-semibold mb-0">{{ $detail->agama }}</p>
    </div>
    <div class="col-md-3">
        <p class="text-muted small mb-1">NIP</p>
        <p class="fw-semibold mb-0">{{ $detail->nip ?? '-' }}</p>
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
        <p class="text-muted small mb-1">Tempat, Tgl Lahir</p>
        <p class="fw-semibold mb-0">{{ $detail->tempat_lahir }}, {{ $detail->tanggal_lahir?->format('d M Y') }}</p>
    </div>
    <div class="col-md-6">
        <p class="text-muted small mb-1">Pendidikan Terakhir</p>
        <p class="fw-semibold mb-0">
            {{ $detail->pendidikan_terakhir }}
            @if ($detail->pendidikan_lainnya) <span class="text-muted">({{ $detail->pendidikan_lainnya }})</span> @endif
            <span class="text-muted small">{{ $detail->jurusan }}</span>
        </p>
    </div>
    <div class="col-md-6">
        <p class="text-muted small mb-1">Jabatan Sesuai SK</p>
        <p class="fw-semibold mb-0">{{ $detail->jabatan_sesuai_sk }}</p>
    </div>

    <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Tempat Tugas</p></div>

    <div class="col-md-6">
        <p class="text-muted small mb-1">Tempat Tugas Sebelumnya</p>
        <p class="fw-semibold mb-0">{{ $detail->tempat_tugas_sebelumnya }}</p>
    </div>
    <div class="col-md-6">
        <p class="text-muted small mb-1">Tempat Tugas Sekarang</p>
        <p class="fw-semibold mb-0">{{ $detail->tempat_tugas_sekarang }}</p>
    </div>
    <div class="col-md-4">
        <p class="text-muted small mb-1">Kecamatan</p>
        <p class="fw-semibold mb-0">{{ $detail->kecamatan }}</p>
    </div>
    <div class="col-md-4">
        <p class="text-muted small mb-1">Kabupaten</p>
        <p class="fw-semibold mb-0">{{ $detail->kabupaten }}</p>
    </div>
    @if ($detail->alamat)
    <div class="col-12">
        <p class="text-muted small mb-1">Alamat</p>
        <p class="fw-semibold mb-0">{{ $detail->alamat }}</p>
    </div>
    @endif

    <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Data SK PPPK</p></div>

    <div class="col-md-6">
        <p class="text-muted small mb-1">Nomor SK PPPK</p>
        <p class="fw-semibold mb-0">{{ $detail->nomor_sk_pppk }}</p>
    </div>

    @include('dashboard.pengajuan.partials._dokumen', ['files' => [
        'scan_sk_pppk'             => 'Scan SK PPPK',
        'scan_sertifikat_pendidik' => 'Scan Sertifikat Pendidik',
    ]])

</div>
