<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2" style="background-color: #0f1f3d">
        <i class="ti ti-transfer text-primary fs-5"></i>
        <span class="text-white fw-semibold">Usulan Penerbitan NRG Baru / Mutasi NRG Kemenag</span>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap') }}">
                @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">NIK <span class="text-danger">*</span></label>
                <input type="text" name="nik" maxlength="16" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}">
                @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">NUPTK</label>
                <input type="text" name="nuptk" maxlength="20" class="form-control" value="{{ old('nuptk') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">NIP / NIPPPK</label>
                <input type="text" name="nip_nipppk" class="form-control" value="{{ old('nip_nipppk') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}">
                @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}">
                @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-8">
                <label class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                <input type="text" name="nama_sekolah" class="form-control @error('nama_sekolah') is-invalid @enderror" value="{{ old('nama_sekolah') }}">
                @error('nama_sekolah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" value="{{ old('kecamatan') }}">
                @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Jenis Usulan <span class="text-danger">*</span></label>
                <select name="jenis_usulan" id="jenisUsulanNrg" class="form-select @error('jenis_usulan') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    <option value="PENERBITAN_BARU"       {{ old('jenis_usulan') == 'PENERBITAN_BARU'       ? 'selected' : '' }}>Penerbitan Baru</option>
                    <option value="MUTASI_NRG_KEMENAG"    {{ old('jenis_usulan') == 'MUTASI_NRG_KEMENAG'    ? 'selected' : '' }}>Mutasi NRG Kemenag</option>
                </select>
                @error('jenis_usulan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6" id="nrgLamaWrap" style="{{ old('jenis_usulan') == 'MUTASI_NRG_KEMENAG' ? '' : 'display:none' }}">
                <label class="form-label">Nomor NRG Lama <span class="text-danger">*</span></label>
                <input type="text" name="nomor_nrg_lama" class="form-control @error('nomor_nrg_lama') is-invalid @enderror" value="{{ old('nomor_nrg_lama') }}">
                @error('nomor_nrg_lama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Dokumen <span class="text-muted">(PDF/JPG/PNG, maks 2MB)</span></p></div>

            <div class="col-md-6">
                <label class="form-label">Scan Sertifikat Pendidik</label>
                <input type="file" name="scan_sertifikat_pendidik" accept=".pdf,.jpg,.jpeg,.png" class="form-control @error('scan_sertifikat_pendidik') is-invalid @enderror">
                @error('scan_sertifikat_pendidik')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Scan SK Pengangkatan</label>
                <input type="file" name="scan_sk_pengangkatan" accept=".pdf,.jpg,.jpeg,.png" class="form-control @error('scan_sk_pengangkatan') is-invalid @enderror">
                @error('scan_sk_pengangkatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('jenisUsulanNrg')?.addEventListener('change', function () {
    document.getElementById('nrgLamaWrap').style.display = this.value === 'MUTASI_NRG_KEMENAG' ? '' : 'none';
});
</script>
@endpush
