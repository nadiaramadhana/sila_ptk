<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriPengajuan extends Model
{
    protected $table = 'kategori_pengajuan';

    protected $fillable = ['nama', 'slug', 'deskripsi', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class, 'kategori_pengajuan_id');
    }
}
