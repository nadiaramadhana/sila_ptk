-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 10 Jun 2026 pada 23.54
-- Versi server: 8.0.30
-- Versi PHP: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Basis data: `laravel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:5:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:12:\"manage users\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"manage data\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:19:\"manage data sekolah\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:16:\"manage pengajuan\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:17:\"manage validation\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:2:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"admin\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:16:\"operator_sekolah\";s:1:\"c\";s:3:\"web\";}}}', 1781171492);

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ptk`
--

CREATE TABLE `data_ptk` (
  `id` bigint NOT NULL,
  `kategori_id` bigint NOT NULL,
  `nama_ptk` varchar(255) NOT NULL,
  `jabatan_ptk` bigint NOT NULL,
  `pangkat_golongan_id` bigint NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_ptk`
--

INSERT INTO `data_ptk` (`id`, `kategori_id`, `nama_ptk`, `jabatan_ptk`, `pangkat_golongan_id`, `created_at`, `updated_at`) VALUES
(2, 1, 'Nadia Ramadhana', 1, 6, '2026-06-05 07:43:41', '2026-06-05 07:43:41'),
(3, 1, 'Syeri', 1, 1, '2026-06-05 08:15:29', '2026-06-05 08:15:29'),
(5, 1, 'Adit', 1, 6, '2026-06-05 08:26:49', '2026-06-10 02:56:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_mutasi_ptk`
--

CREATE TABLE `detail_mutasi_ptk` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuan_id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nuptk` varchar(20) DEFAULT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nip_nipppk` varchar(50) DEFAULT NULL,
  `golongan` varchar(10) DEFAULT NULL,
  `pendidikan_terakhir` varchar(20) NOT NULL,
  `jurusan_pendidikan_terakhir` varchar(100) NOT NULL,
  `nama_tempat_tugas_asal` varchar(255) NOT NULL,
  `kecamatan_asal` varchar(100) NOT NULL,
  `nama_tempat_tugas_tujuan` varchar(255) NOT NULL,
  `kecamatan_tujuan` varchar(100) NOT NULL,
  `nomor_sk` varchar(100) NOT NULL,
  `tanggal_sk` date NOT NULL,
  `tmt` date NOT NULL,
  `scan_sk` varchar(255) DEFAULT NULL,
  `sebagai_sekolah` enum('INDUK','NON_INDUK') NOT NULL,
  `jenis_ptk` enum('KEPALA_SEKOLAH','GURU','TENAGA_KEPENDIDIKAN','LAINNYA') NOT NULL,
  `jenis_ptk_lainnya` varchar(100) DEFAULT NULL,
  `jabatan_ptk` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penerbitan_nrg`
--

CREATE TABLE `detail_penerbitan_nrg` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuan_id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nuptk` varchar(20) DEFAULT NULL,
  `nip_nipppk` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `jenis_usulan` enum('PENERBITAN_BARU','MUTASI_NRG_KEMENAG') NOT NULL,
  `nomor_nrg_lama` varchar(50) DEFAULT NULL,
  `scan_sertifikat_pendidik` varchar(255) DEFAULT NULL,
  `scan_sk_pengangkatan` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_penerbitan_nuptk`
--

CREATE TABLE `detail_penerbitan_nuptk` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuan_id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `nip_nipppk` varchar(50) DEFAULT NULL,
  `pendidikan_terakhir` varchar(20) NOT NULL,
  `jurusan` varchar(100) NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `keterangan` text,
  `scan_ijazah` varchar(255) DEFAULT NULL,
  `scan_sk_pengangkatan` varchar(255) DEFAULT NULL,
  `scan_ktp` varchar(255) DEFAULT NULL,
  `scan_kk` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_perbaikan_rombel`
--

CREATE TABLE `detail_perbaikan_rombel` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuan_id` bigint UNSIGNED NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `npsn` varchar(20) NOT NULL,
  `nama_rombel` varchar(100) NOT NULL,
  `kelas` varchar(20) NOT NULL,
  `tahun_ajaran` varchar(10) NOT NULL,
  `keterangan_perbaikan` text NOT NULL,
  `scan_dokumen` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_perubahan_p3k`
--

CREATE TABLE `detail_perubahan_p3k` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuan_id` bigint UNSIGNED NOT NULL,
  `status_kepegawaian_sebelum` enum('GURU_KONTRAK','GURU_HONOR_SEKOLAH','GURU_TETAP_YAYASAN','KONTRAK_TENAGA_ADMINISTRASI','HONOR_TENAGA_ADMINISTRASI') NOT NULL,
  `sertifikasi` enum('SUDAH','BELUM','DALAM_PROSES_2025') NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nuptk` varchar(20) DEFAULT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('LAKI_LAKI','PEREMPUAN') NOT NULL,
  `pendidikan_terakhir` enum('S1','SMA','SMK','LAINNYA') NOT NULL,
  `pendidikan_lainnya` varchar(100) DEFAULT NULL,
  `jurusan` varchar(100) NOT NULL,
  `jabatan_sesuai_sk` varchar(255) NOT NULL,
  `agama` enum('ISLAM','KATHOLIK','KRISTEN','HINDU','BUDHA','LAINNYA') NOT NULL,
  `tempat_tugas_sebelumnya` varchar(255) NOT NULL,
  `tempat_tugas_sekarang` varchar(255) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_sk_pppk` varchar(100) NOT NULL,
  `scan_sk_pppk` varchar(255) DEFAULT NULL,
  `scan_sertifikat_pendidik` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_tunjangan_profesi`
--

CREATE TABLE `detail_tunjangan_profesi` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuan_id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nip_nipppk` varchar(50) DEFAULT NULL,
  `nuptk` varchar(20) DEFAULT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `kecamatan` varchar(100) NOT NULL,
  `periode` enum('JANUARI_MARET','APRIL_JUNI','JULI_SEPTEMBER','OKTOBER_DESEMBER') NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `scan_sertifikat_pendidik` varchar(255) DEFAULT NULL,
  `scan_sk_mengajar` varchar(255) DEFAULT NULL,
  `scan_dokumen_pendukung` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_update_kepsek`
--

CREATE TABLE `detail_update_kepsek` (
  `id` bigint UNSIGNED NOT NULL,
  `pengajuan_id` bigint UNSIGNED NOT NULL,
  `status_kepsek` enum('DEFINITIF','PLT') NOT NULL,
  `alasan_pergantian` enum('KEPSEK_LAMA_PENSIUN','KEPSEK_LAMA_MENGUNDURKAN_DIRI','KEPSEK_LAMA_MENINGGAL','KEPSEK_LAMA_MUTASI_KE_SEKOLAH_LAIN','LAINNYA') NOT NULL,
  `alasan_lainnya` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nuptk` varchar(20) DEFAULT NULL,
  `nip_nipppk` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `golongan` varchar(10) DEFAULT NULL,
  `nama_tempat_tugas_asal` varchar(255) NOT NULL,
  `kecamatan_asal` varchar(100) NOT NULL,
  `nama_tempat_tugas_sekarang` varchar(255) NOT NULL,
  `kecamatan_sekarang` varchar(100) NOT NULL,
  `nomor_sk` varchar(100) NOT NULL,
  `tanggal_sk` date NOT NULL,
  `tmt` date NOT NULL,
  `scan_sk` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `connection` text COLLATE utf8mb4_general_ci NOT NULL,
  `queue` text COLLATE utf8mb4_general_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongan_ptk`
--

CREATE TABLE `golongan_ptk` (
  `id` bigint NOT NULL,
  `nama_golongan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `golongan_ptk`
--

INSERT INTO `golongan_ptk` (`id`, `nama_golongan`, `created_at`, `updated_at`) VALUES
(1, 'I/A', '2026-06-03 14:27:12', '2026-06-03 14:27:12'),
(2, 'I/B', '2026-06-03 14:27:12', '2026-06-03 14:27:12'),
(3, 'I/C', '2026-06-03 14:27:12', '2026-06-03 14:27:12'),
(4, 'II/A', '2026-06-03 14:27:12', '2026-06-03 14:27:12'),
(5, 'II/B', '2026-06-03 14:27:12', '2026-06-03 14:27:12'),
(6, 'II/C', '2026-06-03 14:27:12', '2026-06-03 14:27:12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan_ptk`
--

CREATE TABLE `jabatan_ptk` (
  `id` bigint NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jabatan_ptk`
--

INSERT INTO `jabatan_ptk` (`id`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
(1, 'Guru Senior', '2026-06-03 14:30:20', '2026-06-03 14:30:20'),
(2, 'Guru Madya', '2026-06-03 14:30:20', '2026-06-03 14:30:20'),
(3, 'Guru Muda', '2026-06-03 14:30:20', '2026-06-03 14:30:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_layanan`
--

CREATE TABLE `jenis_layanan` (
  `id` bigint NOT NULL,
  `jenis_layanan` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_general_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id` bigint NOT NULL,
  `nama_kabupaten` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `nama_kabupaten`, `created_at`, `updated_at`) VALUES
(1, 'KETAPANG', '2026-05-05 03:16:24', '2026-05-05 03:16:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_pengajuan`
--

CREATE TABLE `kategori_pengajuan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `deskripsi` text,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_pengajuan`
--

INSERT INTO `kategori_pengajuan` (`id`, `nama`, `slug`, `deskripsi`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Update Kepala Sekolah / PLT', 'update-kepsek', 'Pengajuan update data Kepala Sekolah Definitif atau PLT melalui sistem.', 1, '2026-06-10 07:06:49', '2026-06-10 07:06:49'),
(2, 'Mutasi / Aktifkan PTK Kembali', 'mutasi-ptk', 'Pengajuan mutasi PTK antar sekolah atau pengaktifan kembali PTK.', 1, '2026-06-10 07:06:49', '2026-06-10 07:06:49'),
(3, 'Perbaikan Rombel Peserta Didik', 'perbaikan-rombel', 'Pengajuan perbaikan data rombongan belajar peserta didik.', 1, '2026-06-10 07:06:49', '2026-06-10 07:06:49'),
(4, 'Syarat Berkas Penerbitan NUPTK', 'penerbitan-nuptk', 'Pengajuan penerbitan Nomor Unik Pendidik dan Tenaga Kependidikan.', 1, '2026-06-10 07:06:49', '2026-06-10 07:06:49'),
(5, 'Pemberkasan Tunjangan Profesi', 'tunjangan-profesi', 'Pemberkasan online tunjangan profesi bagi yang sudah sertifikasi.', 1, '2026-06-10 07:06:49', '2026-06-10 07:06:49'),
(6, 'Perubahan Status Menjadi P3K', 'perubahan-p3k', 'Pengajuan perubahan status kepegawaian menjadi PPPK.', 1, '2026-06-10 07:06:49', '2026-06-10 07:06:49'),
(7, 'Usulan Penerbitan NRG Baru / Mutasi NRG Kemenag', 'penerbitan-nrg', 'Usulan penerbitan atau mutasi Nomor Registrasi Guru.', 1, '2026-06-10 07:06:49', '2026-06-10 07:06:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_ptk`
--

CREATE TABLE `kategori_ptk` (
  `id` bigint NOT NULL,
  `jenis_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_ptk`
--

INSERT INTO `kategori_ptk` (`id`, `jenis_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Pendidik', '2026-06-05 07:18:31', '2026-06-05 07:18:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` bigint NOT NULL,
  `kabupaten_id` bigint NOT NULL,
  `nama_kecamatan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `kabupaten_id`, `nama_kecamatan`, `created_at`, `updated_at`) VALUES
(1, 1, 'DELTA PAWAN', '2026-04-17 16:22:47', '2026-04-17 16:22:47'),
(2, 1, 'MUARA PAWAN', '2026-04-17 16:23:23', '2026-04-17 16:23:23'),
(3, 1, 'BENUA KAYONG', '2026-04-17 16:23:40', '2026-04-17 16:23:40'),
(4, 1, 'MATAN HILIR UTARA', '2026-04-17 16:24:35', '2026-04-17 16:24:35'),
(5, 1, 'MATAN HILIR SELATAN', '2026-04-17 16:24:55', '2026-04-17 16:24:55'),
(6, 1, 'KENDAWANGAN', '2026-04-17 16:25:24', '2026-04-17 16:25:24'),
(7, 1, 'NANGA TAYAP', '2026-04-17 16:25:36', '2026-04-17 16:25:36'),
(8, 1, 'TUMBANG TITI', '2026-04-17 16:25:52', '2026-04-17 16:25:52'),
(9, 1, 'AIR UPAS', '2026-04-17 16:27:33', '2026-04-17 16:27:33'),
(10, 1, 'SANDAI', '2026-04-17 16:27:40', '2026-04-17 16:27:40'),
(11, 1, 'SUNGAI MELAYU RAYAK', '2026-04-17 16:28:05', '2026-04-17 16:28:05'),
(12, 1, 'HULU SUNGAI', '2026-04-17 16:29:16', '2026-04-17 16:29:16'),
(13, 1, 'JELAI HULU', '2026-04-17 16:29:28', '2026-04-17 16:29:28'),
(14, 1, 'MANIS MATA', '2026-04-17 16:29:51', '2026-04-17 16:29:51'),
(15, 1, 'MARAU', '2026-04-17 16:30:03', '2026-04-17 16:30:03'),
(16, 1, 'PEMAHAN', '2026-04-17 16:30:52', '2026-04-17 16:30:52'),
(17, 1, 'SIMPANG DUA', '2026-04-17 16:31:03', '2026-04-17 16:31:03'),
(18, 1, 'SIMPANG HULU', '2026-04-17 16:31:17', '2026-04-17 16:31:17'),
(19, 1, 'SINGKUP', '2026-04-17 16:31:26', '2026-04-17 16:31:26'),
(20, 1, 'SUNGAI LAUR', '2026-04-17 16:31:40', '2026-04-17 16:31:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_28_130839_create_permission_tables', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` bigint UNSIGNED NOT NULL,
  `nomor_pengajuan` varchar(255) NOT NULL,
  `kategori_pengajuan_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `status` enum('draft','diajukan','diproses','selesai','ditolak') NOT NULL DEFAULT 'draft',
  `catatan_penolakan` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengajuan_layanan`
--

CREATE TABLE `pengajuan_layanan` (
  `id` bigint NOT NULL,
  `sekolah_Id` bigint NOT NULL,
  `jenis_pengajuan_id` bigint NOT NULL,
  `dokumen` varchar(255) NOT NULL,
  `status_pengajuan` enum('DRAFT','DIPROSES','SELESAI') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage users', 'web', '2026-04-28 07:05:15', '2026-04-28 07:05:15'),
(2, 'manage data', 'web', '2026-04-28 07:05:15', '2026-04-28 07:05:15'),
(3, 'manage data sekolah', 'web', '2026-04-28 07:05:15', '2026-04-28 07:05:15'),
(4, 'manage pengajuan', 'web', '2026-04-28 07:05:16', '2026-04-28 07:05:16'),
(5, 'manage validation', 'web', '2026-04-28 07:05:16', '2026-04-28 07:05:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2026-04-28 07:05:16', '2026-04-28 07:05:16'),
(2, 'operator_sekolah', 'web', '2026-04-28 07:05:16', '2026-04-28 07:05:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(2, 2),
(3, 2),
(4, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sekolah`
--

CREATE TABLE `sekolah` (
  `id` bigint NOT NULL,
  `nama_sekolah` varchar(255) NOT NULL,
  `npsn_sekolah` varchar(255) NOT NULL,
  `kecamatan_id` bigint DEFAULT NULL,
  `kabupaten_id` bigint DEFAULT NULL,
  `alamat_sekolah` varchar(255) NOT NULL,
  `jenjang_sekolah` enum('PAUD','SD','SMP') NOT NULL,
  `scoupe_pengelolaan` enum('kabupaten','kecamatan') NOT NULL,
  `operator_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sekolah`
--

INSERT INTO `sekolah` (`id`, `nama_sekolah`, `npsn_sekolah`, `kecamatan_id`, `kabupaten_id`, `alamat_sekolah`, `jenjang_sekolah`, `scoupe_pengelolaan`, `operator_id`, `created_at`, `updated_at`) VALUES
(1, 'SDN 07 DELTA PAWAN', '11111111', 1, 1, 'Jl. Ade Irma Suryani', 'SD', 'kabupaten', 2, '2026-05-05 00:13:44', '2026-05-21 01:02:12'),
(2, 'SMPN 1 KETAPANG', '12121212', NULL, 1, 'Jl. RM  Sudiono No.42', 'SMP', 'kabupaten', 2, '2026-05-20 23:26:09', '2026-05-22 22:01:02'),
(3, 'SDN 05 DELTA PAWAN', '15151515', 1, 1, 'R. Suprapto', 'SD', 'kecamatan', 2, '2026-05-21 01:04:11', '2026-05-22 22:00:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `payload` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('WhEXlCYJjqCAlmilTtHmHuj1FB4QtdFhnFg0qWXI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieTA4YzZ0MXBRZkZ0QzRJeWlOeVZOVEZOVEFLSGQzUW5SZzg1VG50YyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fX0=', 1781086667);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `login_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `login_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'superadmin', NULL, '$2y$12$WQCE/bsvxQcHlt2Cp1l3keRq2Gp4jCTn4ppwAfqUJKpssFmEXBCbW', 'TrmFm8FwM69kwR1WEY1zrsezRN58a8uBF0wYD65suUymymuYLq1N1xa6hoRv', '2026-04-28 07:26:24', '2026-04-28 07:26:24'),
(2, 'Operator Sekolah', 'operator@gmail.com', '123456789', NULL, '$2y$12$lj7wMVus8/ZIi4V6kvGSSeDlhrwsFSfdr1TVzs30YXGrt9KNg6F0K', NULL, '2026-04-28 07:26:24', '2026-04-28 07:26:24');

--
-- Indeks untuk tabel yang dibuang
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `data_ptk`
--
ALTER TABLE `data_ptk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key_kategori_id` (`kategori_id`),
  ADD KEY `foreign_key_jabatan_id` (`jabatan_ptk`),
  ADD KEY `foreign_key_golongan_id` (`pangkat_golongan_id`);

--
-- Indeks untuk tabel `detail_mutasi_ptk`
--
ALTER TABLE `detail_mutasi_ptk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_mutasi_pengajuan` (`pengajuan_id`);

--
-- Indeks untuk tabel `detail_penerbitan_nrg`
--
ALTER TABLE `detail_penerbitan_nrg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nrg_pengajuan` (`pengajuan_id`);

--
-- Indeks untuk tabel `detail_penerbitan_nuptk`
--
ALTER TABLE `detail_penerbitan_nuptk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nuptk_pengajuan` (`pengajuan_id`);

--
-- Indeks untuk tabel `detail_perbaikan_rombel`
--
ALTER TABLE `detail_perbaikan_rombel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rombel_pengajuan` (`pengajuan_id`);

--
-- Indeks untuk tabel `detail_perubahan_p3k`
--
ALTER TABLE `detail_perubahan_p3k`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_p3k_pengajuan` (`pengajuan_id`);

--
-- Indeks untuk tabel `detail_tunjangan_profesi`
--
ALTER TABLE `detail_tunjangan_profesi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tunjangan_pengajuan` (`pengajuan_id`);

--
-- Indeks untuk tabel `detail_update_kepsek`
--
ALTER TABLE `detail_update_kepsek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kepsek_pengajuan` (`pengajuan_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `golongan_ptk`
--
ALTER TABLE `golongan_ptk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatan_ptk`
--
ALTER TABLE `jabatan_ptk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jenis_layanan`
--
ALTER TABLE `jenis_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_pengajuan`
--
ALTER TABLE `kategori_pengajuan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indeks untuk tabel `kategori_ptk`
--
ALTER TABLE `kategori_ptk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_pengajuan` (`nomor_pengajuan`),
  ADD KEY `fk_pengajuan_kategori` (`kategori_pengajuan_id`),
  ADD KEY `fk_pengajuan_user` (`user_id`);

--
-- Indeks untuk tabel `pengajuan_layanan`
--
ALTER TABLE `pengajuan_layanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key_sekolah_id` (`sekolah_Id`),
  ADD KEY `foreign_key_jenis_id` (`jenis_pengajuan_id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreign_key_users_id` (`operator_id`),
  ADD KEY `foreign_key_kecamatan_id` (`kecamatan_id`),
  ADD KEY `foreign_key_kabupaten_id` (`kabupaten_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `UNIQUE` (`login_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `data_ptk`
--
ALTER TABLE `data_ptk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `detail_mutasi_ptk`
--
ALTER TABLE `detail_mutasi_ptk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_penerbitan_nrg`
--
ALTER TABLE `detail_penerbitan_nrg`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_penerbitan_nuptk`
--
ALTER TABLE `detail_penerbitan_nuptk`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_perbaikan_rombel`
--
ALTER TABLE `detail_perbaikan_rombel`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_perubahan_p3k`
--
ALTER TABLE `detail_perubahan_p3k`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_tunjangan_profesi`
--
ALTER TABLE `detail_tunjangan_profesi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_update_kepsek`
--
ALTER TABLE `detail_update_kepsek`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `golongan_ptk`
--
ALTER TABLE `golongan_ptk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jabatan_ptk`
--
ALTER TABLE `jabatan_ptk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jenis_layanan`
--
ALTER TABLE `jenis_layanan`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kabupaten`
--
ALTER TABLE `kabupaten`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kategori_pengajuan`
--
ALTER TABLE `kategori_pengajuan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `kategori_ptk`
--
ALTER TABLE `kategori_ptk`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pengajuan_layanan`
--
ALTER TABLE `pengajuan_layanan`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_ptk`
--
ALTER TABLE `data_ptk`
  ADD CONSTRAINT `foreign_key_golongan_id` FOREIGN KEY (`pangkat_golongan_id`) REFERENCES `golongan_ptk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_key_jabatan_id` FOREIGN KEY (`jabatan_ptk`) REFERENCES `jabatan_ptk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_key_kategori_id` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_ptk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_mutasi_ptk`
--
ALTER TABLE `detail_mutasi_ptk`
  ADD CONSTRAINT `fk_mutasi_pengajuan` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_penerbitan_nrg`
--
ALTER TABLE `detail_penerbitan_nrg`
  ADD CONSTRAINT `fk_nrg_pengajuan` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_penerbitan_nuptk`
--
ALTER TABLE `detail_penerbitan_nuptk`
  ADD CONSTRAINT `fk_nuptk_pengajuan` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_perbaikan_rombel`
--
ALTER TABLE `detail_perbaikan_rombel`
  ADD CONSTRAINT `fk_rombel_pengajuan` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_perubahan_p3k`
--
ALTER TABLE `detail_perubahan_p3k`
  ADD CONSTRAINT `fk_p3k_pengajuan` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_tunjangan_profesi`
--
ALTER TABLE `detail_tunjangan_profesi`
  ADD CONSTRAINT `fk_tunjangan_pengajuan` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_update_kepsek`
--
ALTER TABLE `detail_update_kepsek`
  ADD CONSTRAINT `fk_kepsek_pengajuan` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `fk_pengajuan_kategori` FOREIGN KEY (`kategori_pengajuan_id`) REFERENCES `kategori_pengajuan` (`id`),
  ADD CONSTRAINT `fk_pengajuan_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `pengajuan_layanan`
--
ALTER TABLE `pengajuan_layanan`
  ADD CONSTRAINT `foreign_key_jenis_id` FOREIGN KEY (`jenis_pengajuan_id`) REFERENCES `jenis_layanan` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `foreign_key_sekolah_id` FOREIGN KEY (`sekolah_Id`) REFERENCES `sekolah` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sekolah`
--
ALTER TABLE `sekolah`
  ADD CONSTRAINT `foreign_key_kabupaten_id` FOREIGN KEY (`kabupaten_id`) REFERENCES `kabupaten` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_key_kecamatan_id` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreign_key_users_id` FOREIGN KEY (`operator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
