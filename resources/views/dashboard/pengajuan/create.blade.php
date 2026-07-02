<x-layouts.app>
<div class="container-fluid">

    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('pengajuan.index') }}" class="btn btn-sm btn-outline-secondary">
            <i class="ti ti-arrow-left"></i>
        </a>
        <div>
            <h4 class="mb-0 fw-semibold">Buat Pengajuan Baru</h4>
            <p class="text-muted mb-0 small">Pilih kategori lalu isi formulir pengajuan</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong><i class="ti ti-alert-circle me-1"></i>Terdapat kesalahan input:</strong>
            <ul class="mb-0 mt-2 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pengajuan.store') }}" enctype="multipart/form-data" id="formPengajuan">
        @csrf

        {{-- Step 1: Pilih Kategori --}}
        <div class="card mb-4" id="sectionKategori">
            <div class="card-header bg-primary text-white d-flex align-items-center gap-2">
                <i class="ti ti-list-check fs-5"></i>
                <span class="fw-semibold">Pilih Kategori Pengajuan</span>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    @foreach ($kategoris as $kat)
                        <div class="col-md-6 col-lg-4">
                            <label class="kategori-card d-block cursor-pointer h-100">
                                <input type="radio" name="kategori_pengajuan_id"
                                       value="{{ $kat->id }}"
                                       data-slug="{{ $kat->slug }}"
                                       class="d-none kategori-radio"
                                       {{ old('kategori_pengajuan_id') == $kat->id || ($selectedKategori && $selectedKategori->id == $kat->id) ? 'checked' : '' }}>
                                <div class="card h-100 border-2 kategori-option {{ old('kategori_pengajuan_id') == $kat->id ? 'border-primary bg-primary bg-opacity-10' : '' }}">
                                    <div class="card-body d-flex align-items-start gap-3">
                                        <div class="bg-primary bg-opacity-10 rounded p-2 flex-shrink-0">
                                            <i class="ti {{ $loop->index % 2 == 0 ? 'ti-file-text' : 'ti-file-certificate' }} fs-4 text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-semibold small">{{ $kat->nama }}</div>
                                            @if ($kat->deskripsi)
                                                <div class="text-muted" style="font-size:0.78rem">{{ $kat->deskripsi }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('kategori_pengajuan_id')
                    <div class="text-danger small mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Step 2: Form Detail --}}
        <div id="sectionDetail" class="{{ old('kategori_pengajuan_id') || $selectedKategori ? '' : 'd-none' }}">

            <div class="detail-form d-none" data-slug="update-kepsek">
                @include('dashboard.pengajuan.partials.form_update_kepsek')
            </div>
            <div class="detail-form d-none" data-slug="mutasi-ptk">
                @include('dashboard.pengajuan.partials.form_mutasi_ptk')
            </div>
            <div class="detail-form d-none" data-slug="perbaikan-rombel">
                @include('dashboard.pengajuan.partials.form_perbaikan_rombel')
            </div>
            <div class="detail-form d-none" data-slug="penerbitan-nuptk">
                @include('dashboard.pengajuan.partials.form_penerbitan_nuptk')
            </div>
            <div class="detail-form d-none" data-slug="tunjangan-profesi">
                @include('dashboard.pengajuan.partials.form_tunjangan_profesi')
            </div>
            <div class="detail-form d-none" data-slug="perubahan-p3k">
                @include('dashboard.pengajuan.partials.form_perubahan_p3k')
            </div>
            <div class="detail-form d-none" data-slug="penerbitan-nrg">
                @include('dashboard.pengajuan.partials.form_penerbitan_nrg')
            </div>

            <div class="d-flex justify-content-end gap-2 mt-2">
                <a href="{{ route('pengajuan.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary px-4">
                    <i class="ti ti-send me-1"></i>Ajukan
                </button>
            </div>
        </div>

    </form>
</div>

@push('scripts')
<script>
(function () {
    const radios     = document.querySelectorAll('.kategori-radio');
    const options    = document.querySelectorAll('.kategori-option');
    const sectionDet = document.getElementById('sectionDetail');
    const detForms   = document.querySelectorAll('.detail-form');

    function setFormEnabled(form, enabled) {
        form.querySelectorAll('input, select, textarea').forEach(el => {
            el.disabled = !enabled;
        });
    }

    function showForm(slug) {
        detForms.forEach(f => {
            const active = f.dataset.slug === slug;
            f.classList.toggle('d-none', !active);
            // Hanya form kategori terpilih yang dikirim; nonaktifkan sisanya
            // agar field bernama sama tidak saling menimpa (mengakibatkan "field required").
            setFormEnabled(f, active);
        });
        sectionDet.classList.remove('d-none');
    }

    // Default: semua form detail nonaktif sampai kategori dipilih.
    detForms.forEach(f => setFormEnabled(f, false));

    const checked = document.querySelector('.kategori-radio:checked');
    if (checked) showForm(checked.dataset.slug);

    radios.forEach(radio => {
        radio.addEventListener('change', function () {
            options.forEach(o => o.classList.remove('border-primary', 'bg-primary', 'bg-opacity-10'));
            this.closest('.kategori-card').querySelector('.kategori-option')
                .classList.add('border-primary', 'bg-primary', 'bg-opacity-10');
            showForm(this.dataset.slug);
        });
    });
})();
</script>
@endpush
</x-layouts.app>
