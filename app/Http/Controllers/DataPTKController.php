<?php

namespace App\Http\Controllers;

use App\Models\DataPTK;
use App\Models\JabatanPTK;
use App\Models\KategoriPTK;
use App\Models\PangkatPTK;
use Illuminate\Http\Request;

class DataPTKController extends Controller
{
    public function index()
    {
        return view('dashboard.data-ptk.index');
    }

    public function create()
    {
        $kategori = KategoriPTK::all();
        $jabatan = JabatanPTK::all();
        $pangkat = PangkatPTK::all();

        return view('dashboard.data-ptk.create', compact('kategori', 'jabatan', 'pangkat'));
    }
}
