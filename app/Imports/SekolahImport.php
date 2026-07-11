<?php

namespace App\Imports;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Sekolah;
use App\Models\User;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;

class SekolahImport implements ToModel, WithHeadingRow, WithValidation, WithUpserts, SkipsEmptyRows, SkipsOnFailure, WithChunkReading
{
    use SkipsFailures;

    protected $kecamatanMap;
    protected $kabupatenMap;

    /** Cache login_id => user id agar tidak query/bcrypt berulang tiap baris */
    protected $operatorMap;

    public function __construct()
    {
        $this->kecamatanMap = Kecamatan::pluck("id", "nama_kecamatan")
            ->mapWithKeys(fn ($id, $nama) => [Str::lower(trim($nama)) => $id]);

        $this->kabupatenMap = Kabupaten::pluck("id", "nama_kabupaten")
            ->mapWithKeys(fn ($id, $nama) => [Str::lower(trim($nama)) => $id]);

        // Preload seluruh operator yang sudah ada sekali saja (login_id => id)
        $this->operatorMap = User::pluck('id', 'login_id');
    }

    public function model(array $row)
    {
        $kec = Str::lower(trim($row['kecamatan'] ?? ''));
        $kab = Str::lower(trim($row['kabupaten'] ?? ''));

        $namaSekolah = trim($row['nama_sekolah']);
        $npsn        = trim($row['npsn_sekolah']);

        // Otomatis buat akun operator untuk sekolah ini (NPSN sebagai login & password awal).
        // Hanya bcrypt & assignRole saat user benar-benar baru, sehingga import ratusan
        // baris tidak menjalankan bcrypt (yang berat) ratusan kali.
        $operatorId = $this->operatorMap[$npsn] ?? null;

        if ($operatorId === null) {
            $operator = User::create([
                'login_id' => $npsn,
                'name'     => 'Operator ' . $namaSekolah,
                'email'    => $npsn . '@sch.id',
                'password' => bcrypt($npsn),
            ]);

            $operator->assignRole('operator_sekolah');

            $operatorId = $operator->id;
            $this->operatorMap[$npsn] = $operatorId;
        }

        return new Sekolah([
            'nama_sekolah'      => $namaSekolah,
            'npsn_sekolah'      => $npsn,
            'kecamatan_id'      => $this->kecamatanMap[$kec] ?? null,
            'kabupaten_id'      => $this->kabupatenMap[$kab] ?? null,
            'alamat_sekolah'    => $row['alamat_sekolah'] ?? null,
            'jenjang_sekolah'   => Str::upper(trim($row['jenjang_sekolah'])),
            'scoupe_pengelolaan' => Str::lower(trim($row['scoupe_pengelolaan'] ?? 'kabupaten')),
            'operator_id'       => $operatorId,
        ]);
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function uniqueBy()
    {
        return 'npsn_sekolah';
    }

    public function rules(): array
    {
        return [
            'nama_sekolah' => 'required|string|max:255',
            'npsn_sekolah' => 'required|string|max:255',
            'jenjang_sekolah' => 'required|in:PAUD,SD,SMP',
            'scoupe_pengelolaan' => 'nullable|in:kabupaten,kecamatan',
        ];
    }
}
