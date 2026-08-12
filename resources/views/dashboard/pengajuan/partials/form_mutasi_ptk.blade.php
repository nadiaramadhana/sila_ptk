<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2" style="background-color: #0f1f3d">
        <i class="ti ti-transfer text-primary fs-5"></i>
        <span class="text-white fw-semibold">Mutasi PTK</span>
    </div>
    <div class="card-body">
        <div class="row g-3">

            {{-- Data Pribadi --}}
            @include('dashboard.pengajuan.partials._ptk_picker', [
                'widgetId' => 'mutasi-ptk',
            ])
            <div class="col-md-6">
                <label class="form-label">NIK <span class="text-danger">*</span></label>
                <input type="text" name="nik" maxlength="16"
                       class="form-control @error('nik') is-invalid @enderror"
                       value="{{ old('nik') }}">
                @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">NUPTK</label>
                <input type="text" name="nuptk" class="form-control" value="{{ old('nuptk') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">NIP / NIPPPK</label>
                <input type="text" name="nip_nipppk" class="form-control" value="{{ old('nip_nipppk') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Golongan</label>
                <input type="text" name="golongan" maxlength="10" class="form-control"
                       value="{{ old('golongan') }}" placeholder="cth: III/B">
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
                <label class="form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                <select name="pendidikan_terakhir"
                        class="form-select @error('pendidikan_terakhir') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    @foreach (['S1','S2','S3','D3','SMA','SMK'] as $p)
                        <option value="{{ $p }}" {{ old('pendidikan_terakhir') == $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                </select>
                @error('pendidikan_terakhir')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Jurusan Pendidikan Terakhir <span class="text-danger">*</span></label>
                <input type="text" name="jurusan_pendidikan_terakhir"
                       class="form-control @error('jurusan_pendidikan_terakhir') is-invalid @enderror"
                       value="{{ old('jurusan_pendidikan_terakhir') }}">
                @error('jurusan_pendidikan_terakhir')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Tempat Tugas</p></div>

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
                <label class="form-label">Nama Tempat Tugas Tujuan <span class="text-danger">*</span></label>
                <input type="text" name="nama_tempat_tugas_tujuan"
                       class="form-control @error('nama_tempat_tugas_tujuan') is-invalid @enderror"
                       value="{{ old('nama_tempat_tugas_tujuan') }}">
                @error('nama_tempat_tugas_tujuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Kecamatan Tujuan <span class="text-danger">*</span></label>
                <input type="text" name="kecamatan_tujuan"
                       class="form-control @error('kecamatan_tujuan') is-invalid @enderror"
                       value="{{ old('kecamatan_tujuan') }}">
                @error('kecamatan_tujuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Jabatan & Jenis PTK</p></div>

            <div class="col-md-4">
                <label class="form-label">Jenis PTK <span class="text-danger">*</span></label>
                <select name="jenis_ptk" id="jenisPtk"
                        class="form-select @error('jenis_ptk') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    @foreach (['KEPALA_SEKOLAH'=>'Kepala Sekolah','GURU'=>'Guru','TENAGA_KEPENDIDIKAN'=>'Tenaga Kependidikan','LAINNYA'=>'Lainnya'] as $v => $l)
                        <option value="{{ $v }}" {{ old('jenis_ptk') == $v ? 'selected' : '' }}>{{ $l }}</option>
                    @endforeach
                </select>
                @error('jenis_ptk')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4" id="jenisPtkLainnyaWrap" style="{{ old('jenis_ptk') == 'LAINNYA' ? '' : 'display:none' }}">
                <label class="form-label">Jenis PTK Lainnya <span class="text-danger">*</span></label>
                <input type="text" name="jenis_ptk_lainnya" class="form-control"
                       value="{{ old('jenis_ptk_lainnya') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Sebagai Sekolah <span class="text-danger">*</span></label>
                <select name="sebagai_sekolah" class="form-select @error('sebagai_sekolah') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    <option value="INDUK"     {{ old('sebagai_sekolah') == 'INDUK'     ? 'selected' : '' }}>Induk</option>
                    <option value="NON_INDUK" {{ old('sebagai_sekolah') == 'NON_INDUK' ? 'selected' : '' }}>Non Induk</option>
                </select>
                @error('sebagai_sekolah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Jabatan PTK <span class="text-danger">*</span></label>
                <input type="text" name="jabatan_ptk"
                       class="form-control @error('jabatan_ptk') is-invalid @enderror"
                       value="{{ old('jabatan_ptk') }}">
                @error('jabatan_ptk')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
document.getElementById('jenisPtk')?.addEventListener('change', function () {
    document.getElementById('jenisPtkLainnyaWrap').style.display = this.value === 'LAINNYA' ? '' : 'none';
});
</script>
@endpush
