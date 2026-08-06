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
            {{-- <strong><i class="ti ti-alert-circle me-1"></i>Terdapat kesalahan input:</strong> --}}
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
            <div class="card-header text-white d-flex align-items-center gap-2" style="background-color: #0f1f3d">
                <i class="ti ti-list-check fs-5"></i>
                <span class="fw-semibold">Pilih Kategori Pengajuan</span>
            </div>
            <div class="card-body">
                <label for="kategoriSelect" class="form-label fw-semibold">Kategori Pengajuan</label>
                <select name="kategori_pengajuan_id" id="kategoriSelect"
                        class="form-select @error('kategori_pengajuan_id') is-invalid @enderror">
                    <option value="" data-slug="" data-desc="">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $kat)
                        <option value="{{ $kat->id }}"
                                data-slug="{{ $kat->slug }}"
                                data-desc="{{ $kat->deskripsi }}"
                                {{ old('kategori_pengajuan_id') == $kat->id || ($selectedKategori && $selectedKategori->id == $kat->id) ? 'selected' : '' }}>
                            {{ $kat->nama }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_pengajuan_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div id="kategoriDesc" class="text-muted small mt-2"></div>
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
                {{-- <a href="{{ route('pengajuan.index') }}" class="btn btn-outline-secondary">Batal</a> --}}
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
    const select     = document.getElementById('kategoriSelect');
    const sectionDet = document.getElementById('sectionDetail');
    const detForms   = document.querySelectorAll('.detail-form');
    const descBox    = document.getElementById('kategoriDesc');

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
        sectionDet.classList.toggle('d-none', !slug);
    }

    function syncDesc(opt) {
        descBox.textContent = opt && opt.dataset.desc ? opt.dataset.desc : '';
    }

    // Default: semua form detail nonaktif sampai kategori dipilih.
    detForms.forEach(f => setFormEnabled(f, false));

    const initialOpt = select.options[select.selectedIndex];
    if (initialOpt && initialOpt.value) {
        showForm(initialOpt.dataset.slug);
        syncDesc(initialOpt);
    }

    select.addEventListener('change', function () {
        const opt = this.options[this.selectedIndex];
        showForm(opt.dataset.slug);
        syncDesc(opt);
    });
})();
</script>
@endpush
</x-layouts.app>
