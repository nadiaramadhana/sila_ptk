<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengajuan;
use App\Models\Pengajuan;
use App\Models\DetailUpdateKepsek;
use App\Models\DetailMutasiPtk;
use App\Models\DetailPerbaikanRombel;
use App\Models\DetailPenerbitanNuptk;
use App\Models\DetailTunjanganProfesi;
use App\Models\DetailPerubahanP3k;
use App\Models\DetailPenerbitanNrg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    // ── Index ────────────────────────────────────────────────

    public function index(Request $request)
    {
        $query = Pengajuan::with(['kategori', 'user'])
            ->when(Auth::user()->hasRole('operator_sekolah'), fn ($q) =>
                $q->where('user_id', Auth::id())
            );

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_pengajuan_id', $request->kategori);
        }

        // Search nomor pengajuan
        if ($request->filled('search')) {
            $query->where('nomor_pengajuan', 'like', '%' . $request->search . '%');
        }

        $pengajuans  = $query->latest()->paginate(15)->withQueryString();
        $kategoris   = KategoriPengajuan::where('is_active', true)->get();

        return view('dashboard.pengajuan.index', compact('pengajuans', 'kategoris'));
    }

    // ── Create ───────────────────────────────────────────────

    public function create(Request $request)
    {
        $kategoris = KategoriPengajuan::where('is_active', true)->get();

        // Jika sudah memilih kategori (query param ?kategori=slug)
        $selectedKategori = null;
        if ($request->filled('kategori')) {
            $selectedKategori = KategoriPengajuan::where('slug', $request->kategori)->first();
        }

        return view('dashboard.pengajuan.create', compact('kategoris', 'selectedKategori'));
    }

    // ── Store ────────────────────────────────────────────────

    public function store(Request $request)
    {
        $request->validate([
            'kategori_pengajuan_id' => 'required|exists:kategori_pengajuan,id',
        ]);

        $kategori = KategoriPengajuan::findOrFail($request->kategori_pengajuan_id);

        // Validasi detail sesuai kategori
        $this->validateDetail($request, $kategori->slug);

        DB::beginTransaction();
        try {
            $pengajuan = Pengajuan::create([
                'nomor_pengajuan'      => Pengajuan::generateNomor(),
                'kategori_pengajuan_id'=> $kategori->id,
                'user_id'              => Auth::id(),
                'status'               => Pengajuan::STATUS_DIAJUKAN,
            ]);

            $this->storeDetail($request, $pengajuan);

            DB::commit();

            return redirect()
                ->route('pengajuan.show', $pengajuan)
                ->with('success', 'Pengajuan berhasil disubmit dengan nomor ' . $pengajuan->nomor_pengajuan);
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal menyimpan pengajuan: ' . $e->getMessage());
        }
    }

    // ── Show ─────────────────────────────────────────────────

    public function show(Pengajuan $pengajuan)
    {
        $this->authorizeAccess($pengajuan);

        $pengajuan->load(['kategori', 'user',
            'detailUpdateKepsek', 'detailMutasiPtk', 'detailPerbaikanRombel',
            'detailPenerbitanNuptk', 'detailTunjanganProfesi',
            'detailPerubahanP3k', 'detailPenerbitanNrg',
        ]);

        return view('dashboard.pengajuan.show', compact('pengajuan'));
    }

    // ── Edit ─────────────────────────────────────────────────

    public function edit(Pengajuan $pengajuan)
    {
        $this->authorizeAccess($pengajuan);

        abort_if(
            !in_array($pengajuan->status, [Pengajuan::STATUS_DRAFT, Pengajuan::STATUS_DITOLAK]),
            403,
            'Pengajuan yang sudah diproses tidak dapat diedit.'
        );

        $pengajuan->load(['kategori',
            'detailUpdateKepsek', 'detailMutasiPtk', 'detailPerbaikanRombel',
            'detailPenerbitanNuptk', 'detailTunjanganProfesi',
            'detailPerubahanP3k', 'detailPenerbitanNrg',
        ]);

        return view('dashboard.pengajuan.edit', compact('pengajuan'));
    }

    // ── Update ───────────────────────────────────────────────

    public function update(Request $request, Pengajuan $pengajuan)
    {
        $this->authorizeAccess($pengajuan);

        abort_if(
            !in_array($pengajuan->status, [Pengajuan::STATUS_DRAFT, Pengajuan::STATUS_DITOLAK]),
            403
        );

        $kategori = $pengajuan->kategori;
        $this->validateDetail($request, $kategori->slug, isUpdate: true);

        DB::beginTransaction();
        try {
            // Update status kembali ke diajukan jika sebelumnya ditolak
            if ($pengajuan->status === Pengajuan::STATUS_DITOLAK) {
                $pengajuan->update([
                    'status'             => Pengajuan::STATUS_DIAJUKAN,
                    'catatan_penolakan'  => null,
                ]);
            }

            $this->updateDetail($request, $pengajuan);

            DB::commit();

            return redirect()
                ->route('pengajuan.show', $pengajuan)
                ->with('success', 'Pengajuan berhasil diperbarui.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Gagal memperbarui: ' . $e->getMessage());
        }
    }

    // ── Destroy ──────────────────────────────────────────────

    public function destroy(Pengajuan $pengajuan)
    {
        $this->authorizeAccess($pengajuan);

        abort_if(
            $pengajuan->status === Pengajuan::STATUS_DIPROSES,
            403,
            'Pengajuan sedang diproses, tidak dapat dihapus.'
        );

        $pengajuan->delete();

        return redirect()
            ->route('pengajuan.index')
            ->with('success', 'Pengajuan berhasil dihapus.');
    }

    // ── Admin: ubah status ───────────────────────────────────

    public function updateStatus(Request $request, Pengajuan $pengajuan)
    {
        abort_if(!Auth::user()->hasRole('admin'), 403, 'Akses ditolak.');

        $request->validate([
            'status'            => 'required|in:diproses,selesai,ditolak',
            'catatan_penolakan' => 'required_if:status,ditolak|nullable|string',
        ]);

        $data = [
            'status'            => $request->status,
            // Catatan penolakan hanya relevan saat status ditolak.
            // Selain itu selalu dikosongkan agar catatan lama tidak ikut terbawa.
            'catatan_penolakan' => null,
        ];

        // Catat waktu proses & selesai
        if ($request->status === Pengajuan::STATUS_DIPROSES) {
            // Tandai waktu mulai diproses (sekali saja), reset waktu selesai
            $data['tanggal_proses']  = $pengajuan->tanggal_proses ?? now();
            $data['tanggal_selesai'] = null;
        } elseif ($request->status === Pengajuan::STATUS_SELESAI) {
            // Pastikan waktu proses terisi walau admin langsung menandai selesai
            $data['tanggal_proses']  = $pengajuan->tanggal_proses ?? now();
            $data['tanggal_selesai'] = $pengajuan->tanggal_selesai ?? now();
        } elseif ($request->status === Pengajuan::STATUS_DITOLAK) {
            // Ditolak: simpan catatan penolakan, bukan pengajuan selesai
            $data['catatan_penolakan'] = $request->catatan_penolakan;
            $data['tanggal_selesai']   = null;
        }

        $pengajuan->update($data);

        return back()->with('success', 'Status pengajuan diperbarui.');
    }

    // ════════════════════════════════════════════════════════
    //  Private helpers
    // ════════════════════════════════════════════════════════

    private function authorizeAccess(Pengajuan $pengajuan): void
    {
        if (Auth::user()->hasRole('operator_sekolah')) {
            abort_if($pengajuan->user_id !== Auth::id(), 403);
        }
    }

    // ── Validasi per kategori ────────────────────────────────

    private function validateDetail(Request $request, string $slug, bool $isUpdate = false): void
    {
        $fileRule = $isUpdate ? 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
                              : 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048';

        $rules = match ($slug) {
            'update-kepsek' => [
                'status_kepsek'              => 'required|in:DEFINITIF,PLT',
                'alasan_pergantian'          => 'required|in:KEPSEK_LAMA_PENSIUN,KEPSEK_LAMA_MENGUNDURKAN_DIRI,KEPSEK_LAMA_MENINGGAL,KEPSEK_LAMA_MUTASI_KE_SEKOLAH_LAIN,LAINNYA',
                'alasan_lainnya'             => 'nullable|required_if:alasan_pergantian,LAINNYA|string|max:255',
                'nama_lengkap'               => 'required|string|max:255',
                'nik'                        => 'required|digits:16',
                'nuptk'                      => 'nullable|string|max:20',
                'nip_nipppk'                 => 'nullable|string|max:50',
                'tempat_lahir'               => 'required|string|max:100',
                'tanggal_lahir'              => 'required|date',
                'golongan'                   => 'nullable|string|max:10',
                'nama_tempat_tugas_asal'     => 'required|string|max:255',
                'kecamatan_asal'             => 'required|string|max:100',
                'nama_tempat_tugas_sekarang' => 'required|string|max:255',
                'kecamatan_sekarang'         => 'required|string|max:100',
                'nomor_sk'                   => 'required|string|max:100',
                'tanggal_sk'                 => 'required|date',
                'tmt'                        => 'required|date',
                'scan_sk'                    => $fileRule,
            ],

            'mutasi-ptk' => [
                'nama_lengkap'                  => 'required|string|max:255',
                'nik'                           => 'required|digits:16',
                'nuptk'                         => 'nullable|string|max:20',
                'tempat_lahir'                  => 'required|string|max:100',
                'tanggal_lahir'                 => 'required|date',
                'nip_nipppk'                    => 'nullable|string|max:50',
                'golongan'                      => 'nullable|string|max:10',
                'pendidikan_terakhir'           => 'required|string|max:20',
                'jurusan_pendidikan_terakhir'   => 'required|string|max:100',
                'nama_tempat_tugas_asal'        => 'required|string|max:255',
                'kecamatan_asal'                => 'required|string|max:100',
                'nama_tempat_tugas_tujuan'      => 'required|string|max:255',
                'kecamatan_tujuan'              => 'required|string|max:100',
                'nomor_sk'                      => 'required|string|max:100',
                'tanggal_sk'                    => 'required|date',
                'tmt'                           => 'required|date',
                'scan_sk'                       => $fileRule,
                'sebagai_sekolah'               => 'required|in:INDUK,NON_INDUK',
                'jenis_ptk'                     => 'required|in:KEPALA_SEKOLAH,GURU,TENAGA_KEPENDIDIKAN,LAINNYA',
                'jenis_ptk_lainnya'             => 'nullable|required_if:jenis_ptk,LAINNYA|string|max:100',
                'jabatan_ptk'                   => 'required|string|max:255',
            ],

            'perbaikan-rombel' => [
                'nama_sekolah'          => 'required|string|max:255',
                'npsn'                  => 'required|string|max:20',
                'nama_rombel'           => 'required|string|max:100',
                'kelas'                 => 'required|string|max:20',
                'tahun_ajaran'          => 'required|string|max:10',
                'keterangan_perbaikan'  => 'required|string',
                'scan_dokumen'          => $fileRule,
            ],

            'penerbitan-nuptk' => [
                'nama_lengkap'          => 'required|string|max:255',
                'nik'                   => 'required|digits:16',
                'tempat_lahir'          => 'required|string|max:100',
                'tanggal_lahir'         => 'required|date',
                'nip_nipppk'            => 'nullable|string|max:50',
                'pendidikan_terakhir'   => 'required|string|max:20',
                'jurusan'               => 'required|string|max:100',
                'nama_sekolah'          => 'required|string|max:255',
                'kecamatan'             => 'required|string|max:100',
                'keterangan'            => 'nullable|string',
                'scan_ijazah'           => $fileRule,
                'scan_sk_pengangkatan'  => $fileRule,
                'scan_ktp'              => $fileRule,
                'scan_kk'               => $fileRule,
            ],

            'tunjangan-profesi' => [
                'nama_lengkap'              => 'required|string|max:255',
                'nip_nipppk'                => 'nullable|string|max:50',
                'nuptk'                     => 'nullable|string|max:20',
                'nama_sekolah'              => 'required|string|max:255',
                'kecamatan'                 => 'required|string|max:100',
                'periode'                   => 'required|in:JANUARI_MARET,APRIL_JUNI,JULI_SEPTEMBER,OKTOBER_DESEMBER',
                'tahun'                     => 'required|digits:4',
                'scan_sertifikat_pendidik'  => $fileRule,
                'scan_sk_mengajar'          => $fileRule,
                'scan_dokumen_pendukung'    => $fileRule,
            ],

            'perubahan-p3k' => [
                'status_kepegawaian_sebelum'=> 'required|in:GURU_KONTRAK,GURU_HONOR_SEKOLAH,GURU_TETAP_YAYASAN,KONTRAK_TENAGA_ADMINISTRASI,HONOR_TENAGA_ADMINISTRASI',
                'sertifikasi'               => 'required|in:SUDAH,BELUM,DALAM_PROSES_2025',
                'nama_lengkap'              => 'required|string|max:255',
                'nip'                       => 'required|string|max:50',
                'nik'                       => 'required|digits:16',
                'nuptk'                     => 'nullable|string|max:20',
                'tempat_lahir'              => 'required|string|max:100',
                'tanggal_lahir'             => 'required|date',
                'jenis_kelamin'             => 'required|in:LAKI_LAKI,PEREMPUAN',
                'pendidikan_terakhir'       => 'required|in:S1,SMA,SMK,LAINNYA',
                'pendidikan_lainnya'        => 'nullable|required_if:pendidikan_terakhir,LAINNYA|string|max:100',
                'jurusan'                   => 'required|string|max:100',
                'jabatan_sesuai_sk'         => 'required|string|max:255',
                'agama'                     => 'required|in:ISLAM,KATHOLIK,KRISTEN,HINDU,BUDHA,LAINNYA',
                'tempat_tugas_sebelumnya'   => 'required|string|max:255',
                'tempat_tugas_sekarang'     => 'required|string|max:255',
                'kecamatan'                 => 'required|string|max:100',
                'kabupaten'                 => 'required|string|max:100',
                'alamat'                    => 'required|string',
                'nomor_sk_pppk'             => 'required|string|max:100',
                'scan_sk_pppk'              => $fileRule,
                'scan_sertifikat_pendidik'  => $fileRule,
            ],

            'penerbitan-nrg' => [
                'nama_lengkap'              => 'required|string|max:255',
                'nik'                       => 'required|digits:16',
                'nuptk'                     => 'nullable|string|max:20',
                'nip_nipppk'                => 'nullable|string|max:50',
                'tempat_lahir'              => 'required|string|max:100',
                'tanggal_lahir'             => 'required|date',
                'nama_sekolah'              => 'required|string|max:255',
                'kecamatan'                 => 'required|string|max:100',
                'jenis_usulan'              => 'required|in:PENERBITAN_BARU,MUTASI_NRG_KEMENAG',
                'nomor_nrg_lama'            => 'nullable|required_if:jenis_usulan,MUTASI_NRG_KEMENAG|string|max:50',
                'scan_sertifikat_pendidik'  => $fileRule,
                'scan_sk_pengangkatan'      => $fileRule,
            ],

            default => [],
        };

        $request->validate($rules);
    }

    // ── Upload helper ────────────────────────────────────────

    private function handleFileUpload(Request $request, string $field, ?string $existing = null): ?string
    {
        if ($request->hasFile($field)) {
            if ($existing) {
                Storage::disk('public')->delete($existing);
            }
            return $request->file($field)->store('pengajuan', 'public');
        }
        return $existing;
    }

    // ── Store detail per kategori ────────────────────────────

    private function storeDetail(Request $request, Pengajuan $pengajuan): void
    {
        $slug = $pengajuan->kategori->slug;
        $data = $request->except(['_token', 'kategori_pengajuan_id']);
        $data['pengajuan_id'] = $pengajuan->id;

        // Handle file uploads
        foreach ($this->fileFieldsForSlug($slug) as $field) {
            $data[$field] = $this->handleFileUpload($request, $field);
        }

        match ($slug) {
            'update-kepsek'    => DetailUpdateKepsek::create($data),
            'mutasi-ptk'       => DetailMutasiPtk::create($data),
            'perbaikan-rombel' => DetailPerbaikanRombel::create($data),
            'penerbitan-nuptk' => DetailPenerbitanNuptk::create($data),
            'tunjangan-profesi'=> DetailTunjanganProfesi::create($data),
            'perubahan-p3k'    => DetailPerubahanP3k::create($data),
            'penerbitan-nrg'   => DetailPenerbitanNrg::create($data),
        };
    }

    // ── Update detail per kategori ───────────────────────────

    private function updateDetail(Request $request, Pengajuan $pengajuan): void
    {
        $slug   = $pengajuan->kategori->slug;
        $detail = $pengajuan->detail;

        $data = $request->except(['_token', '_method', 'kategori_pengajuan_id']);

        foreach ($this->fileFieldsForSlug($slug) as $field) {
            $data[$field] = $this->handleFileUpload($request, $field, $detail?->$field);
        }

        $detail?->update($data);
    }

    // ── File fields map ──────────────────────────────────────

    private function fileFieldsForSlug(string $slug): array
    {
        return match ($slug) {
            'update-kepsek'    => ['scan_sk'],
            'mutasi-ptk'       => ['scan_sk'],
            'perbaikan-rombel' => ['scan_dokumen'],
            'penerbitan-nuptk' => ['scan_ijazah', 'scan_sk_pengangkatan', 'scan_ktp', 'scan_kk'],
            'tunjangan-profesi'=> ['scan_sertifikat_pendidik', 'scan_sk_mengajar', 'scan_dokumen_pendukung'],
            'perubahan-p3k'    => ['scan_sk_pppk', 'scan_sertifikat_pendidik'],
            'penerbitan-nrg'   => ['scan_sertifikat_pendidik', 'scan_sk_pengangkatan'],
            default            => [],
        };
    }
}
