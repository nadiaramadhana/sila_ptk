<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JabatanPTK extends Model
{
    protected $table = "jabatan_ptk";

    protected $fillable = [
        'nama_jabatan',
    ];

    public function data_ptk()
    {
        return $this->hasMany(DataPTK::class, 'jabatan_ptk');
    }
}
