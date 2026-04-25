<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    protected $table = "kecamatan";
    protected $fillable = [
        'nama kecamatan',
        'kabupaten_id',
    ];

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }

}
