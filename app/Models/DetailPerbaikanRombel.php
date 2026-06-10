<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPerbaikanRombel extends Model
{
    protected $table = 'detail_perbaikan_rombel';

    protected $fillable = [
        'pengajuan_id', 'nama_sekolah', 'npsn', 'nama_rombel',
        'kelas', 'tahun_ajaran', 'keterangan_perbaikan', 'scan_dokumen',
    ];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
}
