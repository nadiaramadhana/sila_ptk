<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailMutasiPtk extends Model
{
    protected $table = 'detail_mutasi_ptk';

    protected $fillable = [
        'pengajuan_id', 'nama_lengkap', 'nik', 'nuptk', 'tempat_lahir', 'tanggal_lahir',
        'nip_nipppk', 'golongan', 'pendidikan_terakhir', 'jurusan_pendidikan_terakhir',
        'nama_tempat_tugas_asal', 'kecamatan_asal',
        'nama_tempat_tugas_tujuan', 'kecamatan_tujuan',
        'nomor_sk', 'tanggal_sk', 'tmt', 'scan_sk',
        'sebagai_sekolah', 'jenis_ptk', 'jenis_ptk_lainnya', 'jabatan_ptk',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_sk'    => 'date',
        'tmt'           => 'date',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
