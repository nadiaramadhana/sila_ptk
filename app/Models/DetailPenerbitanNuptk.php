<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenerbitanNuptk extends Model
{
    protected $table = 'detail_penerbitan_nuptk';

    protected $fillable = [
        'pengajuan_id', 'nama_lengkap', 'nik', 'tempat_lahir', 'tanggal_lahir',
        'nip_nipppk', 'pendidikan_terakhir', 'jurusan', 'nama_sekolah', 'kecamatan',
        'keterangan', 'scan_ijazah', 'scan_sk_pengangkatan', 'scan_ktp', 'scan_kk',
    ];

    protected $casts = ['tanggal_lahir' => 'date'];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
