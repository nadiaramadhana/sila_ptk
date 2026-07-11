<?php

namespace App\Http\Controllers;

use App\Imports\DataPtkImport;
use App\Models\DataPTK;
use App\Models\JabatanPTK;
use App\Models\KategoriPTK;
use App\Models\PangkatPTK;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DataPTKController extends Controller
{
    public function index(Request $request)
{
    $search   = $request->search;
    $kategori = $request->kategori; // "Pendidik" | "Tenaga Kependidikan"

    $dataPtk = DataPTK::with(['kategori', 'jabatan', 'pangkat_golongan'])
        ->when($search, function ($query) use ($search) {
            $query->where('nama_ptk', 'like', "%{$search}%")
                  ->orWhere('jabatan_ptk', 'like', "%{$search}%");
        })
        ->when($kategori, function ($query) use ($kategori) {
            $query->whereHas('kategori', function ($q) use ($kategori) {
                $q->where('jenis_kategori', $kategori);
            });
        })
        ->orderBy('id')
        ->paginate(10)
        ->withQueryString(); // biar filter kategori tetap ada saat pindah halaman

    return view('dashboard.data-ptk.index', compact('dataPtk'));
}

    public function create()
    {
        $kategori = KategoriPTK::all();
        $jabatan = JabatanPTK::all();
        $pangkat = PangkatPTK::all();

        return view('dashboard.data-ptk.create', compact('kategori', 'jabatan', 'pangkat'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'kategori_id' => 'required|exists:kategori_ptk,id',
            'nama_ptk' => 'required|string',
            'jabatan_ptk' => 'required|exists:jabatan_ptk,id',
            'pangkat_golongan_id' => 'required|exists:golongan_ptk,id',
        ]);

        DataPTK::create($validate);

        return redirect()->route('data-ptk')->with('success', 'Data Berhasil Disimpan');
    }

    public function show($id)
    {
        $ptk = DataPTK::findOrFail($id);

        return view('dashboard.data-ptk.show', compact('ptk'));
    }

    public function edit($id)
    {
        $ptk = DataPTK::findOrFail($id);

        $kategori = KategoriPTK::all();
        $jabatan = JabatanPTK::all();
        $pangkat = PangkatPTK::all();

        return view('dashboard.data-ptk.edit', compact('ptk', 'kategori', 'jabatan', 'pangkat'));
    }

    public function update(Request $request, $id)
    {
        $ptk = DataPTK::findOrFail($id);
        $validate = $request->validate([
            'kategori_id' => 'required|exists:kategori_ptk,id',
            'nama_ptk' => 'required|string',
            'jabatan_ptk' => 'required|exists:jabatan_ptk,id',
            'pangkat_golongan_id' => 'required|exists:golongan_ptk,id',
        ]);

        $ptk->update($validate);

        return redirect()->route('data-ptk')->with('success', 'Data PTK Berhasil di Perbaharui');
    }

    public function destroy($id)
    {
        $ptk = DataPTK::findOrFail($id);

        $ptk->delete();

        return redirect()->route('data-ptk')->with('success', 'Data PTK Berhasil di Hapus');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        $import = new DataPtkImport;
        Excel::import($import, $request->file('file'));

        $gagal = $import->failures();

        if ($gagal->isNotEmpty()) {
            $pesan = $gagal->map(fn ($f) =>
                "Baris {$f->row()}: " . implode('. ', $f->errors())
            )->implode(' | ');

            return back()->with('error', "Sebagian data gagal - {$pesan}");
        }

        return back()->with('success', 'Data PTK berhasil diimport.');
    }
}
