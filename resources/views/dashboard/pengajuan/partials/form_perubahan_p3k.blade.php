<div class="card mb-4">
    <div class="card-header d-flex align-items-center gap-2" style="background-color: #0f1f3d">
        <i class="ti ti-transfer text-primary fs-5"></i>
        <span class="text-white fw-semibold">Perubahan Status Menjadi P3K (PPPK)</span>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Status Kepegawaian Sebelumnya <span class="text-danger">*</span></label>
                <select name="status_kepegawaian_sebelum" class="form-select @error('status_kepegawaian_sebelum') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    @foreach ([
                        'GURU_KONTRAK'                  => 'Guru Kontrak',
                        'GURU_HONOR_SEKOLAH'            => 'Guru Honor Sekolah',
                        'GURU_TETAP_YAYASAN'            => 'Guru Tetap Yayasan',
                        'KONTRAK_TENAGA_ADMINISTRASI'   => 'Kontrak Tenaga Administrasi',
                        'HONOR_TENAGA_ADMINISTRASI'     => 'Honor Tenaga Administrasi',
                    ] as $v => $l)
                        <option value="{{ $v }}" {{ old('status_kepegawaian_sebelum') == $v ? 'selected' : '' }}>{{ $l }}</option>
                    @endforeach
                </select>
                @error('status_kepegawaian_sebelum')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Sertifikasi <span class="text-danger">*</span></label>
                <select name="sertifikasi" class="form-select @error('sertifikasi') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    <option value="SUDAH"            {{ old('sertifikasi') == 'SUDAH'            ? 'selected' : '' }}>Sudah</option>
                    <option value="BELUM"            {{ old('sertifikasi') == 'BELUM'            ? 'selected' : '' }}>Belum</option>
                    <option value="DALAM_PROSES_2025"{{ old('sertifikasi') == 'DALAM_PROSES_2025'? 'selected' : '' }}>Dalam Proses</option>
                </select>
                @error('sertifikasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Data Pribadi</p></div>

            <div class="col-md-6">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap') }}">
                @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">NIP <span class="text-danger">*</span></label>
                <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror" value="{{ old('nip') }}">
                @error('nip')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-3">
                <label class="form-label">NIK <span class="text-danger">*</span></label>
                <input type="text" name="nik" maxlength="16" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}">
                @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">NUPTK</label>
                <input type="text" name="nuptk" maxlength="20" class="form-control" value="{{ old('nuptk') }}">
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
                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    <option value="LAKI_LAKI" {{ old('jenis_kelamin') == 'LAKI_LAKI' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="PEREMPUAN" {{ old('jenis_kelamin') == 'PEREMPUAN' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Agama <span class="text-danger">*</span></label>
                <select name="agama" class="form-select @error('agama') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    @foreach (['ISLAM','KATHOLIK','KRISTEN','HINDU','BUDHA','LAINNYA'] as $a)
                        <option value="{{ $a }}" {{ old('agama') == $a ? 'selected' : '' }}>{{ ucfirst(strtolower($a)) }}</option>
                    @endforeach
                </select>
                @error('agama')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                <select name="pendidikan_terakhir" id="pendTerakhirP3K" class="form-select @error('pendidikan_terakhir') is-invalid @enderror">
                    <option value="">-- Pilih --</option>
                    @foreach (['S1'=>'S1','SMA'=>'SMA','SMK'=>'SMK','LAINNYA'=>'Lainnya'] as $v => $l)
                        <option value="{{ $v }}" {{ old('pendidikan_terakhir') == $v ? 'selected' : '' }}>{{ $l }}</option>
                    @endforeach
                </select>
                @error('pendidikan_terakhir')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4" id="pendLainnyaP3KWrap" style="{{ old('pendidikan_terakhir') == 'LAINNYA' ? '' : 'display:none' }}">
                <label class="form-label">Pendidikan Lainnya</label>
                <input type="text" name="pendidikan_lainnya" class="form-control" value="{{ old('pendidikan_lainnya') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                <input type="text" name="jurusan" class="form-control @error('jurusan') is-invalid @enderror" value="{{ old('jurusan') }}">
                @error('jurusan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Jabatan Sesuai SK <span class="text-danger">*</span></label>
                <input type="text" name="jabatan_sesuai_sk" class="form-control @error('jabatan_sesuai_sk') is-invalid @enderror" value="{{ old('jabatan_sesuai_sk') }}">
                @error('jabatan_sesuai_sk')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Lokasi Tugas</p></div>

            <div class="col-md-6">
                <label class="form-label">Tempat Tugas Sebelumnya <span class="text-danger">*</span></label>
                <input type="text" name="tempat_tugas_sebelumnya" class="form-control @error('tempat_tugas_sebelumnya') is-invalid @enderror" value="{{ old('tempat_tugas_sebelumnya') }}">
                @error('tempat_tugas_sebelumnya')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Tempat Tugas Sekarang <span class="text-danger">*</span></label>
                <input type="text" name="tempat_tugas_sekarang" class="form-control @error('tempat_tugas_sekarang') is-invalid @enderror" value="{{ old('tempat_tugas_sekarang') }}">
                @error('tempat_tugas_sekarang')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" value="{{ old('kecamatan') }}">
                @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Kabupaten <span class="text-danger">*</span></label>
                <input type="text" name="kabupaten" class="form-control @error('kabupaten') is-invalid @enderror" value="{{ old('kabupaten') }}">
                @error('kabupaten')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label">Nomor SK PPPK <span class="text-danger">*</span></label>
                <input type="text" name="nomor_sk_pppk" class="form-control @error('nomor_sk_pppk') is-invalid @enderror" value="{{ old('nomor_sk_pppk') }}">
                @error('nomor_sk_pppk')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label">Alamat <span class="text-danger">*</span></label>
                <textarea name="alamat" rows="2" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12"><hr class="my-1"><p class="text-muted small mb-0">Dokumen <span class="text-muted">(PDF/JPG/PNG, maks 2MB)</span></p></div>

            <div class="col-md-6">
                <label class="form-label">Scan SK PPPK</label>
                <input type="file" name="scan_sk_pppk" accept=".pdf,.jpg,.jpeg,.png" class="form-control @error('scan_sk_pppk') is-invalid @enderror">
                @error('scan_sk_pppk')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label">Scan Sertifikat Pendidik</label>
                <input type="file" name="scan_sertifikat_pendidik" accept=".pdf,.jpg,.jpeg,.png" class="form-control @error('scan_sertifikat_pendidik') is-invalid @enderror">
                @error('scan_sertifikat_pendidik')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('pendTerakhirP3K')?.addEventListener('change', function () {
    document.getElementById('pendLainnyaP3KWrap').style.display = this.value === 'LAINNYA' ? '' : 'none';
});
</script>
@endpush
