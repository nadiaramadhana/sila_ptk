<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2" style="background-color: #0f1f3d">
        <i class="ti ti-transfer text-primary fs-5"></i>
        <span class="text-white fw-semibold">Perbaikan Rombongan Belajar</span>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-8">
                <label class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                <input type="text" name="nama_sekolah" class="form-control @error('nama_sekolah') is-invalid @enderror" value="{{ old('nama_sekolah') }}">
                @error('nama_sekolah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">NPSN <span class="text-danger">*</span></label>
                <input type="text" name="npsn" class="form-control @error('npsn') is-invalid @enderror" value="{{ old('npsn') }}">
                @error('npsn')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Rombel <span class="text-danger">*</span></label>
                <input type="text" name="nama_rombel" class="form-control @error('nama_rombel') is-invalid @enderror" value="{{ old('nama_rombel') }}">
                @error('nama_rombel')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">Kelas <span class="text-danger">*</span></label>
                <input type="text" name="kelas" class="form-control @error('kelas') is-invalid @enderror" value="{{ old('kelas') }}" placeholder="cth: VII A">
                @error('kelas')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" value="{{ old('tahun_ajaran') }}" placeholder="2024/2025">
                @error('tahun_ajaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label">Keterangan Perbaikan <span class="text-danger">*</span></label>
                <textarea name="keterangan_perbaikan" rows="4" class="form-control @error('keterangan_perbaikan') is-invalid @enderror">{{ old('keterangan_perbaikan') }}</textarea>
                @error('keterangan_perbaikan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Scan Dokumen <span class="text-muted small">(PDF/JPG/PNG, maks 2MB)</span></label>
                <input type="file" name="scan_dokumen" accept=".pdf,.jpg,.jpeg,.png" class="form-control @error('scan_dokumen') is-invalid @enderror">
                @error('scan_dokumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>
