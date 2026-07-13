<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MasterDataSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // 1. Kabupaten
        $this->upsertList('kabupaten', 'nama_kabupaten', ['Ketapang'], $now);
        $kabupatenId = DB::table('kabupaten')->where('nama_kabupaten', 'Ketapang')->value('id');

        // 2. Kecamatan (mengikuti kabupaten Ketapang)
        $kecamatan = [
            'Air Upas',
            'Benua Kayong',
            'Delta Pawan',
            'Hulu Sungai',
            'Jelai Hulu',
            'Kendawangan',
            'Manis Mata',
            'Marau',
            'Matan Hilir Selatan',
            'Matan Hilir Utara',
            'Muara Pawan',
            'Nanga Tayap',
            'Pemahan',
            'Sandai',
            'Simpang Dua',
            'Simpang Hulu',
            'Singkup',
            'Sungai Laur',
            'Sungai Melayu Rayak',
            'Tumbang Titi',
        ];
        $hasTsKec = Schema::hasColumn('kecamatan', 'created_at');
        foreach ($kecamatan as $nama) {
            $data = ['kabupaten_id' => $kabupatenId];
            if ($hasTsKec) {
                $data['created_at'] = $now;
                $data['updated_at'] = $now;
            }
            DB::table('kecamatan')->updateOrInsert(['nama_kecamatan' => $nama], $data);
        }

        // 3. Kategori PTK
        $this->upsertList('kategori_ptk', 'jenis_kategori', [
            'Pendidik',
            'Tenaga Kependidikan',
        ], $now);

        // 4. Pangkat / Golongan
        $this->upsertList('golongan_ptk', 'nama_golongan', [
            'I/c',
            'I/d',
            'II/a',
            'II/b',
            'II/c',
            'II/d',
            'III/a',
            'III/b',
            'III/c',
            'III/d',
            'IV',
            'IV/a',
            'IV/b',
            'IV/c',
            'IX',
            'XI',
        ], $now);

        // 5. Jabatan PTK
        $this->upsertList('jabatan_ptk', 'nama_jabatan', [
            'Guru Agama Budha',
            'Guru Agama Hindu',
            'Guru Agama Islam',
            'Guru Agama Katolik',
            'Guru Agama Kristen',
            'Guru Bahasa Indonesia',
            'Guru Bahasa Inggris',
            'Guru Bimbingan Konseling',
            'Guru IPA',
            'Guru IPS',
            'Guru Kelas',
            'Guru Matematika',
            'Guru Muatan Lokal Lainnya',
            'Guru PPKN',
            'Guru Penjasorkes',
            'Guru Prakarya Dan Kewirausahaan',
            'Guru Sejarah',
            'Guru Seni Budaya',
            'Guru Seni Rupa',
            'Guru TIK',
            'Instruktur',
            'Kepala Sekolah',
            'Penjaga Sekolah',
            'Pesuruh/Office Boy',
            'Petugas Keamanan',
            'Pustakawan',
            'Tenaga Administrasi Sekolah',
            'Tidak diisi',
            'Tukang Kebun',
            'Tutor',
        ], $now);
    }

    /**
     * Upsert daftar nilai ke sebuah tabel master (idempotent).
     * Timestamps hanya diisi kalau kolomnya ada.
     */
    private function upsertList(string $table, string $column, array $values, $now): void
    {
        $hasTs = Schema::hasColumn($table, 'created_at');
        foreach ($values as $value) {
            $data = $hasTs ? ['created_at' => $now, 'updated_at' => $now] : [];
            DB::table($table)->updateOrInsert([$column => $value], $data);
        }
    }
}
