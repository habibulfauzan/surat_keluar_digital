-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Feb 2025 pada 07.45
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lpm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_surat`
--

CREATE TABLE `jenis_surat` (
  `id` int(11) NOT NULL,
  `jenis_surat` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_surat`
--

INSERT INTO `jenis_surat` (`id`, `jenis_surat`, `created_at`, `updated_at`) VALUES
(1, 'Surat Undangan', '2025-01-20 05:03:23', '2025-01-20 05:03:23'),
(2, 'Surat Pengantar', '2025-02-03 09:19:07', '2025-02-03 09:19:07'),
(3, 'Surat Permohonan', '2025-02-03 09:19:07', '2025-02-03 09:19:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `group_by` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `permission`
--

INSERT INTO `permission` (`id`, `name`, `slug`, `group_by`, `created_at`, `updated_at`) VALUES
(2, 'User', 'User', 1, NULL, NULL),
(3, 'Add User', 'Add User', 1, NULL, NULL),
(4, 'Edit User', 'Edit User', 1, NULL, NULL),
(5, 'Delete User', 'Delete User', 1, NULL, NULL),
(6, 'Role', 'Role', 2, NULL, NULL),
(7, 'Add Role', 'Add Role', 2, NULL, NULL),
(8, 'Edit Role', 'Edit Role', 2, NULL, NULL),
(9, 'Delete Role', 'Delete Role', 2, NULL, NULL),
(11, 'Surat Keluar', 'Surat Keluar', 4, NULL, NULL),
(12, 'Verifikasi Surat', 'Verifikasi Surat', 4, NULL, NULL),
(15, 'Buat Surat', 'Buat Surat', 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_role`
--

CREATE TABLE `permission_role` (
  `id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `permission_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(338, 13, 11, '2025-02-05 18:02:08', '2025-02-05 18:02:08'),
(339, 13, 15, '2025-02-05 18:02:08', '2025-02-05 18:02:08'),
(340, 37, 11, '2025-02-05 18:02:14', '2025-02-05 18:02:14'),
(341, 37, 12, '2025-02-05 18:02:14', '2025-02-05 18:02:14'),
(342, 1, 2, '2025-02-06 11:12:32', '2025-02-06 11:12:32'),
(343, 1, 3, '2025-02-06 11:12:32', '2025-02-06 11:12:32'),
(344, 1, 4, '2025-02-06 11:12:32', '2025-02-06 11:12:32'),
(345, 1, 5, '2025-02-06 11:12:32', '2025-02-06 11:12:32'),
(346, 1, 6, '2025-02-06 11:12:32', '2025-02-06 11:12:32'),
(347, 1, 7, '2025-02-06 11:12:32', '2025-02-06 11:12:32'),
(348, 1, 8, '2025-02-06 11:12:32', '2025-02-06 11:12:32'),
(349, 1, 9, '2025-02-06 11:12:32', '2025-02-06 11:12:32'),
(350, 1, 11, '2025-02-06 11:12:32', '2025-02-06 11:12:32'),
(351, 1, 12, '2025-02-06 11:12:32', '2025-02-06 11:12:32'),
(352, 1, 15, '2025-02-06 11:12:32', '2025-02-06 11:12:32'),
(353, 3, 11, '2025-02-06 15:16:29', '2025-02-06 15:16:29'),
(354, 3, 12, '2025-02-06 15:16:29', '2025-02-06 15:16:29'),
(355, 2, 11, '2025-02-19 20:56:23', '2025-02-19 20:56:23'),
(356, 2, 12, '2025-02-19 20:56:23', '2025-02-19 20:56:23'),
(357, 2, 15, '2025-02-19 20:56:23', '2025-02-19 20:56:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2025-01-14 15:51:22', '2025-01-14 15:51:22'),
(2, 'Ketua', '2025-01-14 15:51:31', '2025-01-14 15:51:31'),
(3, 'Sekretaris 1', '2025-01-14 15:51:44', '2025-02-05 12:53:56'),
(13, 'Pembuat Surat', '2025-01-14 18:51:15', '2025-01-14 20:30:44'),
(37, 'Sekretaris 2', '2025-02-05 12:54:10', '2025-02-05 12:54:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('08bbjnK7zeZD1845jf1qiLosnkRDtXyYN3WxVnxi', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRHVLT3NmWkxwMnNmUVNYeldMOHRuVVNhemZnQktMcUlIQkc4TjhrQyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTE6Imh0dHA6Ly9sb2NhbGhvc3QvbHBtL3B1YmxpYy9wYW5lbC9zdXJhdC9hZGRfbGFpbm55YSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1740031086),
('gbzudJzYHSMwHMIcYibHtgj7uZCdrGWNDfBd4O8h', 1, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiTTl6R0FWd21FRGFPdmJqUUpqQ29SM0ZIRmZnMkxsUjNBbWNRZlBxQSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTM6Imh0dHA6Ly9sb2NhbGhvc3QvbHBtL3B1YmxpYy9wYW5lbC9zdXJhdC9hZGRfcGVuZ2FudGFyIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNzoibGFzdF9jb21wbGV0ZWRfMTQiO2k6MDtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1740033866),
('u6G0mBkaQJwVYEmC5BoYW7ICDUEksAxolrpMGFdA', 15, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVUdMWEI2Y2JRN0tsYzZTM2hUSGpTZVF2OHNhMVRudEdhSTg5MHc1OCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly9sb2NhbGhvc3QvbHBtL3B1YmxpYy9wYW5lbC9zdXJhdC9zZWxlc2FpIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTU7fQ==', 1740033318);

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat`
--

CREATE TABLE `surat` (
  `id` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `template_nomor` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kepada` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `ket` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat`
--

INSERT INTO `surat` (`id`, `nomor`, `template_nomor`, `nama`, `kepada`, `file_path`, `status`, `ket`, `created_at`, `updated_at`) VALUES
(87, 1, 'Un.04/Ka.LPM/PP.00.9', 'Undangan Rapat', 'Rekto', 'Surat/PP.00.9/8c93_1_Undangan_Rapat.pdf', 'is_ok', NULL, '2025-02-20', '2025-02-20'),
(88, 2, 'Un.04/Ka.LPM/PP.00.9', 'Hal', 'Rektor', 'draft_surat/2_Hal.docx', 'rejected', 'ada typo', '2025-02-20', '2025-02-20'),
(89, 22, 'Un.04/Ka.LPM/PP.00.9', '2', 'Rektor', 'Surat/PP.00.9/3f53_22_2.pdf', 'is_ok', NULL, '2025-02-20', '2025-02-20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '2025-01-14 13:14:40', '$2y$12$DoNVX6rQNMFYpcbo.TGaS.AfVrKK3wVX7Rm/TN2l71wh5lQOVIZiK', 1, 'x8MuNzaFJ33wNdGubitsGnBMeTKZMhXZ3ClXZkEGhNncUCh3CCQqLoK3THbr', '2025-01-14 13:14:40', '2025-01-14 13:14:40'),
(13, 'Ketua', 'ketua@ketua.com', NULL, '$2y$12$rMjReygpTuktfbFEzMG1MOxgLi.ol371cMe3Nirl.oFFxWRunYbsK', 2, NULL, '2025-01-14 13:32:03', '2025-01-14 13:32:03'),
(14, 'Pembuat Surat', 'buatsurat@buatsurat.com', NULL, '$2y$12$jvXDmPaD/wORJ9n5yprl/O0AVjp.VYXBQiLWzsklo4HfHFi7/Fx6.', 13, NULL, '2025-01-14 14:01:45', '2025-01-14 16:01:01'),
(15, 'Sekretaris 1', 'sekretaris@gmail.com', NULL, '$2y$12$lTcr1guYkS/8ZZmC0atYpOGLVCQDeHorJkI4cHRBI5DCXb/msToEa', 3, NULL, '2025-01-20 00:48:50', '2025-02-05 05:31:18'),
(18, 'Sekretaris 2', 'sekretaris2@gmail.com', NULL, '$2y$12$OP/9GSMwCqLysh3OKd3opu.MGsuR6V8COjkrh4lX44yyVaqjmU56i', 37, NULL, '2025-02-05 05:55:54', '2025-02-05 05:55:54');

--
-- Indexes for dumped tables
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
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
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
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jenis_surat`
--
ALTER TABLE `jenis_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=358;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
