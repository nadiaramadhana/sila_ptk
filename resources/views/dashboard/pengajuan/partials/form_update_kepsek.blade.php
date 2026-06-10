{{-- resources/views/pengajuan/partials/form_update_kepsek.blade.php --}}
<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2">
        <i class="ti ti-user-star text-primary fs-5"></i>
        <span class="fw-semibold">Update Kepala Sekolah / PLT</span>
    </div>
    <div class="card-body">

        <div class="row g-3">

            {{-- Status & Alasan --}}
            <div class="col-md-6">
                <label class="form-label">Status Kepala Sekolah <span class="text-danger">*</span></label>
                <select name="status_kepsek" class="form-select @error('status_kepsek') is-invalid @enderror">
                    <option value="">-- Pilih Status --</option>
                    <option value="DEFINITIF" {{ old('status_kepsek') == 'DEFINITIF' ? 'selected' : '' }}>Definitif</option>
                    <option value="PLT"       {{ old('status_kepsek') == 'PLT'       ? 'selected' : '' }}>PLT</option>
                </select>
                @error('status_kepsek')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Alasan Pergantian <span class="text-danger">*</span></label>
                <select name="alasan_pergantian" id="alasanPergantian"
                        class="form-select @error('alasan_pergantian') is-invalid @enderror">
                    <option value="">-- Pilih Alasan --</option>
                    @foreach ([
                        'KEPSEK_LAMA_PENSIUN'               => 'Kepsek Lama Pensiun',
                        'KEPSEK_LAMA_MENGUNDURKAN_DIRI'     => 'Kepsek Lama Mengundurkan Diri',
                        'KEPSEK_LAMA_MENINGGAL'             => 'Kepsek Lama Meninggal',
                        'KEPSEK_LAMA_MUTASI_KE_SEKOLAH_LAIN'=> 'Kepsek Lama Mutasi ke Sekolah Lain',
                        'LAINNYA'                           => 'Lainnya',
                    ] as $val => $label)
                        <option value="{{ $val }}" {{ old('alasan_pergantian') == $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('alasan_pergantian')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12" id="alasanLainnyaWrap" style="{{ old('alasan_pergantian') == 'LAINNYA' ? '' : 'display:none' }}">
                <label class="form-label">Keterangan Alasan Lainnya <span class="text-danger">*</span></label>
                <input type="text" name="alasan_lainnya"
                       class="form-control @error('alasan_lainnya') is-invalid @enderror"
                       value="{{ old('alasan_lainnya') }}">
                @error('alasan_lainnya')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12"><hr class="my-1"></div>

            {{-- Data Pribadi --}}
            <div class="col-md-6">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama_lengkap"
                       class="form-control @error('nama_lengkap') is-invalid @enderror"
                       value="{{ old('nama_lengkap') }}">
                @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">NIK <span class="text-danger">*</span></label>
                <input type="text" name="nik" maxlength="16"
                       class="form-control @error('nik') is-invalid @enderror"
                       value="{{ old('nik') }}">
                @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">NUPTK</label>
                <input type="text" name="nuptk" maxlength="20"
                       class="form-control @error('nuptk') is-invalid @enderror"
                       value="{{ old('nuptk') }}">
                @error('nuptk')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">NIP / NIPPPK</label>
                <input type="text" name="nip_nipppk"
                       class="form-control @error('nip_nipppk') is-invalid @enderror"
                       value="{{ old('nip_nipppk') }}">
                @error('nip_nipppk')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                <input type="text" name="tempat_lahir"
                       class="form-control @error('tempat_lahir') is-invalid @enderror"
                       value="{{ old('tempat_lahir') }}">
                @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_lahir"
                       class="form-control @error('tanggal_lahir') is-invalid @enderror"
                       value="{{ old('tanggal_lahir') }}">
                @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Golongan</label>
                <input type="text" name="golongan" maxlength="10"
                       class="form-control @error('golongan') is-invalid @enderror"
                       value="{{ old('golongan') }}" placeholder="cth: III/A">
                @error('golongan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Data Tempat Tugas</p></div>

            <div class="col-md-6">
                <label class="form-label">Nama Tempat Tugas Asal <span class="text-danger">*</span></label>
                <input type="text" name="nama_tempat_tugas_asal"
                       class="form-control @error('nama_tempat_tugas_asal') is-invalid @enderror"
                       value="{{ old('nama_tempat_tugas_asal') }}">
                @error('nama_tempat_tugas_asal')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Kecamatan Asal <span class="text-danger">*</span></label>
                <input type="text" name="kecamatan_asal"
                       class="form-control @error('kecamatan_asal') is-invalid @enderror"
                       value="{{ old('kecamatan_asal') }}">
                @error('kecamatan_asal')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Tempat Tugas Sekarang <span class="text-danger">*</span></label>
                <input type="text" name="nama_tempat_tugas_sekarang"
                       class="form-control @error('nama_tempat_tugas_sekarang') is-invalid @enderror"
                       value="{{ old('nama_tempat_tugas_sekarang') }}">
                @error('nama_tempat_tugas_sekarang')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Kecamatan Sekarang <span class="text-danger">*</span></label>
                <input type="text" name="kecamatan_sekarang"
                       class="form-control @error('kecamatan_sekarang') is-invalid @enderror"
                       value="{{ old('kecamatan_sekarang') }}">
                @error('kecamatan_sekarang')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Data SK</p></div>

            <div class="col-md-4">
                <label class="form-label">Nomor SK <span class="text-danger">*</span></label>
                <input type="text" name="nomor_sk"
                       class="form-control @error('nomor_sk') is-invalid @enderror"
                       value="{{ old('nomor_sk') }}">
                @error('nomor_sk')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal SK <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_sk"
                       class="form-control @error('tanggal_sk') is-invalid @enderror"
                       value="{{ old('tanggal_sk') }}">
                @error('tanggal_sk')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">TMT <span class="text-danger">*</span></label>
                <input type="date" name="tmt"
                       class="form-control @error('tmt') is-invalid @enderror"
                       value="{{ old('tmt') }}">
                @error('tmt')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Scan SK <span class="text-muted small">(PDF/JPG/PNG, maks 2MB)</span></label>
                <input type="file" name="scan_sk" accept=".pdf,.jpg,.jpeg,.png"
                       class="form-control @error('scan_sk') is-invalid @enderror">
                @error('scan_sk')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('alasanPergantian')?.addEventListener('change', function () {
    document.getElementById('alasanLainnyaWrap').style.display = this.value === 'LAINNYA' ? '' : 'none';
});
</script>
@endpush
