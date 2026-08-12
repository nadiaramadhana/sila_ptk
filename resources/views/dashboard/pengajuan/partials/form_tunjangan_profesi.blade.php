<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2" style="background-color: #0f1f3d">
        <i class="ti ti-transfer text-primary fs-5"></i>
        <span class=" text-white fw-semibold">Pemberkasan Tunjangan Profesi</span>
    </div>
    <div class="card-body">
        <div class="row g-3">
            @include('dashboard.pengajuan.partials._ptk_picker', [
                'widgetId' => 'tunjangan-profesi',
            ])
            <div class="col-md-3">
                <label class="form-label">NIP / NIPPPK</label>
                <input type="text" name="nip_nipppk" class="form-control" value="{{ old('nip_nipppk') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label">NUPTK</label>
                <input type="text" name="nuptk" maxlength="20" class="form-control" value="{{ old('nuptk') }}">
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
            <div class="col-md-6">
                <label class="form-label">Periode <span class="text-danger">*</span></label>
                <select name="periode" class="form-select @error('periode') is-invalid @enderror">
                    <option value="">-- Pilih Periode --</option>
                    @foreach (['JANUARI_MARET'=>'Januari - Maret','APRIL_JUNI'=>'April - Juni','JULI_SEPTEMBER'=>'Juli - September','OKTOBER_DESEMBER'=>'Oktober - Desember'] as $v => $l)
                        <option value="{{ $v }}" {{ old('periode') == $v ? 'selected' : '' }}>{{ $l }}</option>
                    @endforeach
                </select>
                @error('periode')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Tahun <span class="text-danger">*</span></label>
                <input type="text" name="tahun" maxlength="4" class="form-control @error('tahun') is-invalid @enderror"
                       value="{{ old('tahun', date('Y')) }}" placeholder="{{ date('Y') }}">
                @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Dokumen Pendukung <span class="text-muted">(PDF/JPG/PNG, maks 2MB)</span></p></div>

            @foreach ([
                'scan_sertifikat_pendidik' => 'Scan Sertifikat Pendidik',
                'scan_sk_mengajar'         => 'Scan SK Mengajar',
                'scan_dokumen_pendukung'   => 'Scan Dokumen Pendukung',
            ] as $name => $label)
            <div class="col-md-4">
                <label class="form-label">{{ $label }}</label>
                <input type="file" name="{{ $name }}" accept=".pdf,.jpg,.jpeg,.png"
                       class="form-control @error($name) is-invalid @enderror">
                @error($name)<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            @endforeach

        </div>
    </div>
</div>
