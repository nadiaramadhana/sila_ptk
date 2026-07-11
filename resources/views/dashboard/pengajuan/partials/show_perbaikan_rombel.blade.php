{{-- resources/views/dashboard/pengajuan/partials/show_perbaikan_rombel.blade.php --}}
<div class="row g-3">

    <div class="col-md-6">
        <p class="text-muted small mb-1">Nama Sekolah</p>
        <p class="fw-semibold mb-0">{{ $detail->nama_sekolah }}</p>
    </div>
    <div class="col-md-6">
        <p class="text-muted small mb-1">NPSN</p>
        <p class="fw-semibold mb-0">{{ $detail->npsn }}</p>
    </div>

    <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Data Rombel</p></div>

    <div class="col-md-4">
        <p class="text-muted small mb-1">Nama Rombel</p>
        <p class="fw-semibold mb-0">{{ $detail->nama_rombel }}</p>
    </div>
    <div class="col-md-4">
        <p class="text-muted small mb-1">Kelas</p>
        <p class="fw-semibold mb-0">{{ $detail->kelas }}</p>
    </div>
    <div class="col-md-4">
        <p class="text-muted small mb-1">Tahun Ajaran</p>
        <p class="fw-semibold mb-0">{{ $detail->tahun_ajaran }}</p>
    </div>

    @if ($detail->keterangan_perbaikan)
    <div class="col-12">
        <p class="text-muted small mb-1">Keterangan Perbaikan</p>
        <p class="fw-semibold mb-0">{{ $detail->keterangan_perbaikan }}</p>
    </div>
    @endif

    @include('dashboard.pengajuan.partials._dokumen', ['files' => [
        'scan_dokumen' => 'Scan Dokumen Pendukung',
    ]])

</div>
