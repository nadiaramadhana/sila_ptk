<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataPTK extends Model
{
    protected $table = "data_ptk";
    protected $fillable = [
        "nip", "kategori_id", "nama_ptk", "jabatan_ptk", "pangkat_golongan_id"
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriPTK::class, 'kategori_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(JabatanPTK::class, 'jabatan_ptk');
    }

    public function pangkat_golongan()
    {
        return $this->belongsTo(PangkatPTK::class, 'pangkat_golongan_id');
    }
}
