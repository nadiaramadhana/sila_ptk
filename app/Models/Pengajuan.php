<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';

    protected $fillable = [
        'nomor_pengajuan',
        'kategori_pengajuan_id',
        'user_id',
        'status',
        'catatan_penolakan',
        'tanggal_proses',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_proses'  => 'datetime',
        'tanggal_selesai' => 'datetime',
    ];

    // Konstanta status
    const STATUS_DRAFT     = 'draft';
    const STATUS_DIAJUKAN  = 'diajukan';
    const STATUS_DIPROSES  = 'diproses';
    const STATUS_SELESAI   = 'selesai';
    const STATUS_DITOLAK   = 'ditolak';

    public static $statusLabels = [
        'draft'    => ['label' => 'Draft',    'class' => 'bg-secondary'],
        'diajukan' => ['label' => 'Diajukan', 'class' => 'bg-info'],
        'diproses' => ['label' => 'Diproses', 'class' => 'bg-warning'],
        'selesai'  => ['label' => 'Selesai',  'class' => 'bg-success'],
        'ditolak'  => ['label' => 'Ditolak',  'class' => 'bg-danger'],
    ];

    // ── Relasi ──────────────────────────────────────────────

    public function kategori()
    {
        return $this->belongsTo(KategoriPengajuan::class, 'kategori_pengajuan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 7 relasi ke tabel detail (hasOne karena 1 pengajuan = 1 detail)
    public function detailUpdateKepsek()
    {
        return $this->hasOne(DetailUpdateKepsek::class, 'pengajuan_id');
    }

    public function detailMutasiPtk()
    {
        return $this->hasOne(DetailMutasiPtk::class, 'pengajuan_id');
    }

    public function detailPerbaikanRombel()
    {
        return $this->hasOne(DetailPerbaikanRombel::class, 'pengajuan_id');
    }

    public function detailPenerbitanNuptk()
    {
        return $this->hasOne(DetailPenerbitanNuptk::class, 'pengajuan_id');
    }

    public function detailTunjanganProfesi()
    {
        return $this->hasOne(DetailTunjanganProfesi::class, 'pengajuan_id');
    }

    public function detailPerubahanP3k()
    {
        return $this->hasOne(DetailPerubahanP3k::class, 'pengajuan_id');
    }

    public function detailPenerbitanNrg()
    {
        return $this->hasOne(DetailPenerbitanNrg::class, 'pengajuan_id');
    }

    // ── Helper ──────────────────────────────────────────────

    /**
     * Ambil relasi detail yang aktif berdasarkan slug kategori
     */
    public function getDetailAttribute()
    {
        return match ($this->kategori?->slug) {
            'update-kepsek'    => $this->detailUpdateKepsek,
            'mutasi-ptk'       => $this->detailMutasiPtk,
            'perbaikan-rombel' => $this->detailPerbaikanRombel,
            'penerbitan-nuptk' => $this->detailPenerbitanNuptk,
            'tunjangan-profesi'=> $this->detailTunjanganProfesi,
            'perubahan-p3k'    => $this->detailPerubahanP3k,
            'penerbitan-nrg'   => $this->detailPenerbitanNrg,
            default            => null,
        };
    }

    /**
     * Generate nomor pengajuan otomatis: PGJ-YYYYMM-XXXX
     */
    public static function generateNomor(): string
    {
        $prefix = 'PGJ-' . now()->format('Ym') . '-';
        $last   = self::where('nomor_pengajuan', 'like', $prefix . '%')
                      ->orderByDesc('id')
                      ->value('nomor_pengajuan');

        $seq = $last ? ((int) substr($last, -4)) + 1 : 1;

        return $prefix . str_pad($seq, 4, '0', STR_PAD_LEFT);
    }
}
