<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPTK extends Model
{
    protected $fillable = [
        "kategori_id", "nama_ptk", "jabatan_ptk", "pangkat_golongan_id"
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriPTK::class);
    }

    public function jabatan()
    {
        return $this->belongsTo(JabatanPTK::class);
    }

    public function pangkat_golongan()
    {
        return $this->belongsTo(PangkatPTK::class);
    }
}
