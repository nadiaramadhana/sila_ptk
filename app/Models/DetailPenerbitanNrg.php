<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenerbitanNrg extends Model
{
    protected $table = 'detail_penerbitan_nrg';

    protected $fillable = [
        'pengajuan_id', 'nama_lengkap', 'nik', 'nuptk', 'nip_nipppk',
        'tempat_lahir', 'tanggal_lahir', 'nama_sekolah', 'kecamatan',
        'jenis_usulan', 'nomor_nrg_lama',
        'scan_sertifikat_pendidik', 'scan_sk_pengangkatan',
    ];

    protected $casts = ['tanggal_lahir' => 'date'];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
