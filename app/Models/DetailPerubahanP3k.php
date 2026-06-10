<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPerubahanP3k extends Model
{
    protected $table = 'detail_perubahan_p3k';

    protected $fillable = [
        'pengajuan_id', 'status_kepegawaian_sebelum', 'sertifikasi',
        'nama_lengkap', 'nip', 'nik', 'nuptk', 'tempat_lahir', 'tanggal_lahir',
        'jenis_kelamin', 'pendidikan_terakhir', 'pendidikan_lainnya', 'jurusan',
        'jabatan_sesuai_sk', 'agama', 'tempat_tugas_sebelumnya', 'tempat_tugas_sekarang',
        'kecamatan', 'kabupaten', 'alamat',
        'nomor_sk_pppk', 'scan_sk_pppk', 'scan_sertifikat_pendidik',
    ];

    protected $casts = ['tanggal_lahir' => 'date'];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
