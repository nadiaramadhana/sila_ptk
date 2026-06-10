<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTunjanganProfesi extends Model
{
    protected $table = 'detail_tunjangan_profesi';

    protected $fillable = [
        'pengajuan_id', 'nama_lengkap', 'nip_nipppk', 'nuptk',
        'nama_sekolah', 'kecamatan', 'periode', 'tahun',
        'scan_sertifikat_pendidik', 'scan_sk_mengajar', 'scan_dokumen_pendukung',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
