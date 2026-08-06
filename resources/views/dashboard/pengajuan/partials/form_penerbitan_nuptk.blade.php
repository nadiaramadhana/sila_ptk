<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2" style="background-color: #0f1f3d">
        <i class="ti ti-transfer text-primary fs-5"></i>
        <span class="text-white fw-semibold">Syarat Berkas Penerbitan NUPTK</span>
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
                <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}">
                @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}">
                @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">NIP / NIPPPK</label>
                <input type="text" name="nip_nipppk" class="form-control" value="{{ old('nip_nipppk') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                <select name="pendidikan_terakhir" class="form-select @error('pendidikan_terakhir') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    @foreach (['S1','S2','S3','D3','SMA','SMK'] as $p)
                        <option value="{{ $p }}" {{ old('pendidikan_terakhir') == $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                </select>
                @error('pendidikan_terakhir')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" value="{{ old('jurusan') }}">
                @error('jurusan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                <input type="text" name="nama_sekolah" class="form-control @error('nama_sekolah') is-invalid @enderror" value="{{ old('nama_sekolah') }}">
                @error('nama_sekolah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" value="{{ old('kecamatan') }}">
                @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" rows="3" class="form-control">{{ old('keterangan') }}</textarea>
            </div>

            <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Dokumen Pendukung <span class="text-muted">(PDF/JPG/PNG, maks 2MB)</span></p></div>

            @foreach ([
                'scan_ijazah'          => 'Scan Ijazah',
                'scan_sk_pengangkatan' => 'Scan SK Pengangkatan',
                'scan_ktp'             => 'Scan KTP',
                'scan_kk'              => 'Scan Kartu Keluarga',
            ] as $name => $label)
            <div class="col-md-6">
                <label class="form-label">{{ $label }}</label>
                <input type="file" name="{{ $name }}" accept=".pdf,.jpg,.jpeg,.png"
                       class="form-control @error($name) is-invalid @enderror">
                @error($name)<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            @endforeach

        </div>
    </div>
</div>
