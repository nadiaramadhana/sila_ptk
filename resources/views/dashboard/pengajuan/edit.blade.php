<x-layouts.app>
<div class="container-fluid">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('pengajuan.show', $pengajuan) }}" class="btn btn-sm btn-outline-secondary">
            <i class="ti ti-arrow-left"></i>
        </a>
        <div>
            <h4 class="mb-0 fw-semibold">Edit Pengajuan</h4>
            <p class="text-muted mb-0 small">{{ $pengajuan->nomor_pengajuan }} &mdash; {{ $pengajuan->kategori->nama }}</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{-- <strong><i class="ti ti-alert-circle me-1"></i>Terdapat kesalahan input:</strong> --}}
            <ul class="mb-0 mt-2 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pengajuan.update', $pengajuan) }}" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="alert alert-info d-flex align-items-center gap-2 mb-4">
            <i class="ti ti-info-circle fs-5"></i>
            <span>Kategori pengajuan: <strong>{{ $pengajuan->kategori->nama }}</strong> (tidak dapat diubah)</span>
        </div>

        @php $slug = $pengajuan->kategori->slug; $detail = $pengajuan->detail; @endphp

        @include('dashboard.pengajuan.partials.form_' . str_replace('-', '_', $slug), ['editDetail' => $detail])

        <div class="d-flex justify-content-end gap-2 mt-2">
            <a href="{{ route('pengajuan.show', $pengajuan) }}" class="btn btn-outline-secondary">Batal</a>
            <button type="submit" class="btn btn-primary px-4">
                <i class="ti ti-device-floppy me-1"></i>Simpan Perubahan
            </button>
        </div>
    </form>

</div>
</x-layouts.app>
