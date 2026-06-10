<?php
// ============================================================
//  app/Models/DetailUpdateKepsek.php
// ============================================================
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailUpdateKepsek extends Model
{
    protected $table = 'detail_update_kepsek';

    protected $fillable = [
        'pengajuan_id', 'status_kepsek', 'alasan_pergantian', 'alasan_lainnya',
        'nama_lengkap', 'nik', 'nuptk', 'nip_nipppk', 'tempat_lahir', 'tanggal_lahir',
        'golongan', 'nama_tempat_tugas_asal', 'kecamatan_asal',
        'nama_tempat_tugas_sekarang', 'kecamatan_sekarang',
        'nomor_sk', 'tanggal_sk', 'tmt', 'scan_sk',
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
