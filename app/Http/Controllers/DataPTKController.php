<?php

namespace App\Http\Controllers;

use App\Imports\DataPtkImport;
use App\Models\DataPTK;
use App\Models\JabatanPTK;
use App\Models\KategoriPTK;
use App\Models\PangkatPTK;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class DataPTKController extends Controller
{
    public function index(Request $request)
    {
        $search   = $request->search;
        $kategori = $request->kategori;

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
            ->withQueryString();

        return view('dashboard.data-ptk.index', compact('dataPtk'));
    }

    public function create()
    {
        $kategori = KategoriPTK::all();
        $jabatan  = JabatanPTK::all();
        $pangkat  = PangkatPTK::all();

        return view('dashboard.data-ptk.create', compact('kategori', 'jabatan', 'pangkat'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategori_id'        => 'required|exists:kategori_ptk,id',
            'nama_ptk'           => 'required|string',
            'jabatan_ptk'        => 'required|exists:jabatan_ptk,id',
            'pangkat_golongan_id'=> 'required|exists:golongan_ptk,id',
        ]);

        if ($validator->fails()) {
            $hasRequired = collect($validator->failed())->contains(fn($rules) => isset($rules['Required']));

            if ($hasRequired) {
                return back()->withErrors(['form' => 'Please fill out this field'])->withInput();
            }

            return back()->withErrors([
                'form' => $validator->errors()->first(),
            ])->withInput();
        }

        DataPTK::create($validator->validated());

        return redirect()->route('data-ptk')->with('success', 'Data PTK Berhasil Ditambahkan');
    }

    public function show($id)
    {
        $ptk = DataPTK::findOrFail($id);

        return view('dashboard.data-ptk.show', compact('ptk'));
    }

    public function edit($id)
    {
        $ptk      = DataPTK::findOrFail($id);
        $kategori = KategoriPTK::all();
        $jabatan  = JabatanPTK::all();
        $pangkat  = PangkatPTK::all();

        return view('dashboard.data-ptk.edit', compact('ptk', 'kategori', 'jabatan', 'pangkat'));
    }

    public function update(Request $request, $id)
    {
        $ptk = DataPTK::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kategori_id'        => 'required|exists:kategori_ptk,id',
            'nama_ptk'           => 'required|string',
            'jabatan_ptk'        => 'required|exists:jabatan_ptk,id',
            'pangkat_golongan_id'=> 'required|exists:golongan_ptk,id',
        ]);

        if ($validator->fails()) {
            $hasRequired = collect($validator->failed())->contains(fn($rules) => isset($rules['Required']));

            if ($hasRequired) {
                return back()->withErrors(['form' => 'Please fill out this field'])->withInput();
            }

            return back()->withErrors([
                'form' => $validator->errors()->first(),
            ])->withInput();
        }

        $ptk->update($validator->validated());

        return redirect()->route('data-ptk')->with('success', 'Data PTK Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        $ptk = DataPTK::findOrFail($id);
        $ptk->delete();

        return redirect()->route('data-ptk')->with('success', 'Data PTK Berhasil Dihapus');
    }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,xls,csv|max:5120',
        ]);

        if ($validator->fails()) {
            $hasRequired = collect($validator->failed())->contains(fn($rules) => isset($rules['Required']));

            if ($hasRequired) {
                return back()->withErrors(['form' => 'Please fill out this field'])->withInput();
            }

            return back()->withErrors([
                'form' => $validator->errors()->first(),
            ])->withInput();
        }

        $import = new DataPtkImport;
        Excel::import($import, $request->file('file'));

        $gagal = $import->failures();

        if ($gagal->isNotEmpty()) {
            $pesan = $gagal->map(fn ($f) =>
                "Baris {$f->row()}: " . implode('. ', $f->errors())
            )->implode(' | ');

            return back()->withErrors(['form' => "Sebagian data gagal diimport - {$pesan}"]);
        }

        return back()->with('success', 'Data PTK Berhasil Diimport');
    }
}
