-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jul 2024 pada 19.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek_pbl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `distributors`
--

CREATE TABLE `distributors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `distributors`
--

INSERT INTO `distributors` (`id`, `name`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'PT. Lux', 'Lux.indonesia@yahoo.com', '081333300024', 'Cikampek', '2024-06-16 04:34:54', '2024-06-16 04:34:54'),
(2, 'PT. Aqua', 'Aqua.indonesia@yahoo.com', '081333300455', 'Pasuruan', '2024-06-16 04:37:09', '2024-06-16 04:37:09'),
(3, 'PT. BIMOLI INDONESIA', 'Bimoli.indonesia@gmail.com', '081399988800', 'Bandung', '2024-06-22 00:42:55', '2024-06-22 00:43:11'),
(4, 'PT. Ladaku Indonesia', 'Ladaku.indonesia@yahoo.com', '08139777240', 'Cikampek', '2024-06-29 11:13:27', '2024-06-29 11:13:45'),
(5, 'PT. HARUMAS INDONESIA', 'Harumas@gmail.co.id', '+6277954685', 'Bengkong Batam', '2024-06-30 05:26:02', '2024-06-30 05:26:02');

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
-- Struktur dari tabel `kasirs`
--

CREATE TABLE `kasirs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kasirs`
--

INSERT INTO `kasirs` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Kasir 1', 'kasir1@example.com', '$2y$10$ui8mpdL2CO7BqRLJB5DJoetXb7qCd42W/d6Ay1DlOc3rniVpJdMpW', '2024-06-16 04:37:43', '2024-06-16 04:37:43'),
(2, 'Kasir 2', 'kasir2@example.com', '$2y$10$ebp8DybZZJ4NLmhSSvxLV.LYoGMnCPnq77hiFDM6JK4Ksih4LdCv2', '2024-06-17 22:18:00', '2024-06-17 22:18:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategoris`
--

INSERT INTO `kategoris` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Sabun', '2024-06-16 04:35:29', '2024-06-16 04:35:29'),
(2, 'Minuman', '2024-06-16 04:38:21', '2024-06-16 04:38:21'),
(3, 'Minyak Goreng', '2024-06-16 05:50:46', '2024-06-16 05:50:46'),
(4, 'Bumbu Dapur', '2024-06-16 05:51:08', '2024-06-16 05:51:08'),
(6, 'Daging', '2024-06-16 05:51:44', '2024-06-16 05:51:44'),
(7, 'Susu', '2024-06-16 05:51:58', '2024-06-16 05:51:58'),
(8, 'Snack', '2024-06-16 05:52:19', '2024-06-16 05:52:19'),
(9, 'Parfume', '2024-06-16 05:53:38', '2024-06-16 05:53:38'),
(11, 'Roti', '2024-06-16 05:56:02', '2024-06-16 05:56:02'),
(12, 'Mie', '2024-06-17 18:25:10', '2024-06-17 18:25:10');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_05_31_200629_create_kategoris_table', 1),
(6, '2024_05_31_201653_create_distributors_table', 1),
(7, '2024_05_31_201653_create_produks_table', 1),
(8, '2024_05_31_201654_create_kasirs_table', 1),
(9, '2024_06_01_004032_create_transaksi_penjualans_table', 1),
(10, '2024_06_01_004156_create_transaksi_penjualan_details_table', 1),
(11, '2024_06_22_182009_create_pembelian_stok_produk_table', 2),
(12, '2024_06_23_134608_create_permission_tables', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Struktur dari tabel `pembelian_stok_produk`
--

CREATE TABLE `pembelian_stok_produk` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga_beli` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembelian_stok_produk`
--

INSERT INTO `pembelian_stok_produk` (`id`, `produk_id`, `quantity`, `harga_beli`, `created_at`, `updated_at`) VALUES
(4, 5, 20, 5000.00, '2024-06-23 03:23:49', '2024-06-23 03:23:49'),
(5, 6, 50, 6000.00, '2024-06-23 03:51:42', '2024-06-23 03:51:42'),
(6, 6, 10, 6000.00, '2024-06-23 10:01:00', '2024-06-23 10:01:00'),
(7, 5, 42, 5000.00, '2024-06-23 10:01:54', '2024-06-23 10:01:54'),
(8, 5, 15, 5000.00, '2024-06-28 17:34:48', '2024-06-28 17:34:48'),
(9, 3, 14, 8000.00, '2024-06-29 09:41:21', '2024-06-29 09:41:21'),
(11, 11, 100, 40000.00, '2024-06-29 13:08:22', '2024-06-29 13:08:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `produks`
--

CREATE TABLE `produks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `harga_beli` decimal(10,2) NOT NULL,
  `harga_jual` decimal(10,2) NOT NULL,
  `stok` int(11) NOT NULL,
  `kategori_id` bigint(20) UNSIGNED NOT NULL,
  `distributor_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produks`
--

INSERT INTO `produks` (`id`, `name`, `harga_beli`, `harga_jual`, `stok`, `kategori_id`, `distributor_id`, `created_at`, `updated_at`) VALUES
(1, 'Lux', 3500.00, 4500.00, 188, 1, 1, '2024-06-16 04:36:11', '2024-06-28 19:36:42'),
(2, 'Aqua 1,5 Liter', 6000.00, 6500.00, 430, 2, 2, '2024-06-16 04:39:45', '2024-06-28 19:27:40'),
(3, 'Shinzui Sabun Batangan', 8000.00, 9600.00, 60, 1, 1, '2024-06-20 02:45:42', '2024-06-29 09:41:21'),
(4, 'Mizone', 5000.00, 6000.00, 105, 2, 2, '2024-06-22 03:50:47', '2024-06-28 19:09:16'),
(5, 'Prima 1,5 Liter', 5000.00, 6000.00, 34, 2, 2, '2024-06-22 20:15:01', '2024-06-28 19:41:46'),
(6, 'Ades Botol 1,5 Liter', 6000.00, 7200.00, 35, 2, 2, '2024-06-23 03:51:12', '2024-06-28 19:41:46'),
(11, 'Lada Hitam Pedas', 40000.00, 48000.00, 100, 4, 4, '2024-06-29 13:07:52', '2024-06-29 13:24:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_penjualans`
--

CREATE TABLE `transaksi_penjualans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kasir_id` bigint(20) UNSIGNED NOT NULL,
  `total_price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_penjualans`
--

INSERT INTO `transaksi_penjualans` (`id`, `kasir_id`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 1, 90500.00, '2024-06-16 04:40:43', '2024-06-16 04:49:39'),
(2, 2, 175000.00, '2024-06-18 16:46:04', '2024-06-18 16:46:04'),
(3, 1, 132500.00, '2024-06-19 06:56:53', '2024-06-19 06:56:54'),
(4, 1, 175200.00, '2024-06-22 03:56:10', '2024-06-22 03:56:10'),
(5, 2, 168000.00, '2024-06-23 06:37:22', '2024-06-23 06:37:22'),
(6, 2, 329000.00, '2024-06-26 15:49:17', '2024-06-26 15:49:17'),
(7, 1, 189000.00, '2024-06-26 15:53:13', '2024-06-26 15:53:13'),
(8, 1, 126000.00, '2024-06-26 16:27:17', '2024-06-26 16:27:17'),
(9, 1, 84500.00, '2024-06-28 15:55:28', '2024-06-28 15:55:28'),
(10, 2, 281700.00, '2024-06-28 18:53:18', '2024-06-28 18:53:18'),
(11, 1, 96000.00, '2024-06-28 19:01:57', '2024-06-28 19:01:57'),
(12, 1, 96000.00, '2024-06-28 19:05:54', '2024-06-28 19:05:54'),
(13, 1, 96000.00, '2024-06-28 19:09:16', '2024-06-28 19:09:16'),
(14, 2, 141000.00, '2024-06-28 19:25:37', '2024-06-28 19:25:38'),
(15, 1, 65000.00, '2024-06-28 19:27:40', '2024-06-28 19:27:40'),
(16, 1, 94500.00, '2024-06-28 19:36:42', '2024-06-28 19:36:42'),
(17, 2, 168000.00, '2024-06-28 19:41:46', '2024-06-28 19:41:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_penjualan_details`
--

CREATE TABLE `transaksi_penjualan_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaksi_id` bigint(20) UNSIGNED NOT NULL,
  `produk_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `transaksi_penjualan_details`
--

INSERT INTO `transaksi_penjualan_details` (`id`, `transaksi_id`, `produk_id`, `quantity`, `total_price`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 10, 45000.00, '2024-06-16 04:49:39', '2024-06-16 04:49:39'),
(4, 1, 2, 7, 45500.00, '2024-06-16 04:49:39', '2024-06-16 04:49:39'),
(5, 2, 2, 20, 130000.00, '2024-06-18 16:46:04', '2024-06-18 16:46:04'),
(6, 2, 1, 10, 45000.00, '2024-06-18 16:46:04', '2024-06-18 16:46:04'),
(7, 3, 2, 10, 65000.00, '2024-06-19 06:56:54', '2024-06-19 06:56:54'),
(8, 3, 1, 15, 67500.00, '2024-06-19 06:56:54', '2024-06-19 06:56:54'),
(9, 4, 3, 12, 115200.00, '2024-06-22 03:56:10', '2024-06-22 03:56:10'),
(10, 4, 4, 10, 60000.00, '2024-06-22 03:56:10', '2024-06-22 03:56:10'),
(11, 5, 5, 12, 72000.00, '2024-06-23 06:37:22', '2024-06-23 06:37:22'),
(12, 5, 3, 10, 96000.00, '2024-06-23 06:37:22', '2024-06-23 06:37:22'),
(13, 6, 2, 10, 65000.00, '2024-06-26 15:49:17', '2024-06-26 15:49:17'),
(14, 6, 3, 15, 144000.00, '2024-06-26 15:49:17', '2024-06-26 15:49:17'),
(15, 6, 4, 20, 120000.00, '2024-06-26 15:49:17', '2024-06-26 15:49:17'),
(16, 7, 3, 15, 144000.00, '2024-06-26 15:53:13', '2024-06-26 15:53:13'),
(17, 7, 1, 10, 45000.00, '2024-06-26 15:53:13', '2024-06-26 15:53:13'),
(18, 8, 3, 10, 96000.00, '2024-06-26 16:27:17', '2024-06-26 16:27:17'),
(19, 8, 5, 5, 30000.00, '2024-06-26 16:27:17', '2024-06-26 16:27:17'),
(20, 9, 2, 13, 84500.00, '2024-06-28 15:55:28', '2024-06-28 15:55:28'),
(21, 10, 3, 17, 163200.00, '2024-06-28 18:53:18', '2024-06-28 18:53:18'),
(22, 10, 1, 13, 58500.00, '2024-06-28 18:53:18', '2024-06-28 18:53:18'),
(23, 10, 4, 10, 60000.00, '2024-06-28 18:53:18', '2024-06-28 18:53:18'),
(24, 11, 5, 16, 96000.00, '2024-06-28 19:01:57', '2024-06-28 19:01:57'),
(25, 12, 3, 10, 96000.00, '2024-06-28 19:05:54', '2024-06-28 19:05:54'),
(26, 13, 1, 4, 18000.00, '2024-06-28 19:09:16', '2024-06-28 19:09:16'),
(27, 13, 3, 5, 48000.00, '2024-06-28 19:09:16', '2024-06-28 19:09:16'),
(28, 13, 4, 5, 30000.00, '2024-06-28 19:09:16', '2024-06-28 19:09:16'),
(29, 14, 3, 10, 96000.00, '2024-06-28 19:25:37', '2024-06-28 19:25:37'),
(30, 14, 1, 10, 45000.00, '2024-06-28 19:25:38', '2024-06-28 19:25:38'),
(31, 15, 2, 10, 65000.00, '2024-06-28 19:27:40', '2024-06-28 19:27:40'),
(32, 16, 6, 10, 72000.00, '2024-06-28 19:36:42', '2024-06-28 19:36:42'),
(33, 16, 1, 5, 22500.00, '2024-06-28 19:36:42', '2024-06-28 19:36:42'),
(34, 17, 6, 15, 108000.00, '2024-06-28 19:41:46', '2024-06-28 19:41:46'),
(35, 17, 5, 10, 60000.00, '2024-06-28 19:41:46', '2024-06-28 19:41:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'pradana', 'pradana.rp@gmail.com', '$2y$10$.2lAQyimz7MbIVhGt85zyezxAuH6uqeMmg6gxf.XtaMAvjLeVceva', 'owner', '2024-06-20 15:18:46', '2024-06-20 15:18:46'),
(2, 'restu', 'restu@gmail.com', '$2y$10$CSAlKitpWgsre3IkbcBj.OK80fUh/uYJWNo.SFofCWlzKSSlywW.i', 'admin', '2024-06-25 07:02:01', '2024-06-25 07:02:01'),
(4, 'kasir4', 'kasir4@gmail.com', '$2y$10$fQERPxLUGtZi0EMpeogxWuOs6GTOwcEXEqfk8AnXjD.w9jLa9q6mu', 'karyawan', '2024-06-30 03:46:43', '2024-07-03 12:33:12'),
(5, 'Koh ALiong', 'aliong@gmail.com', '$2y$10$jYJJpwJ8OUNe6lXVxkJkMeXe/felnrxBF/0exDWPwEHfNDXUj0aZC', 'owner', '2024-07-01 11:06:30', '2024-07-01 11:06:30'),
(9, 'admin1', 'admin1@example.com', '$2y$10$ZnH1bKIycu1vhg9EKR36A.pHqNYp23NkhhX5o.u.mas1wtNx/SVpq', 'admin', '2024-07-01 17:30:34', '2024-07-01 17:30:34'),
(10, 'salsa', 'salsa@gmail.com', '$2y$10$2sUnmk2rc7VaIErZbuCeF..ciefnCJJv9gGJAQwNHy60/qTuLBGY.', 'admin', '2024-07-01 17:56:10', '2024-07-01 18:06:25');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `distributors`
--
ALTER TABLE `distributors`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kasirs`
--
ALTER TABLE `kasirs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kasirs_email_unique` (`email`);

--
-- Indeks untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
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
-- Indeks untuk tabel `pembelian_stok_produk`
--
ALTER TABLE `pembelian_stok_produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelian_stok_produk_produk_id_foreign` (`produk_id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produks_kategori_id_foreign` (`kategori_id`),
  ADD KEY `produks_distributor_id_foreign` (`distributor_id`);

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
-- Indeks untuk tabel `transaksi_penjualans`
--
ALTER TABLE `transaksi_penjualans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_penjualans_kasir_id_foreign` (`kasir_id`);

--
-- Indeks untuk tabel `transaksi_penjualan_details`
--
ALTER TABLE `transaksi_penjualan_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_penjualan_details_transaksi_id_foreign` (`transaksi_id`),
  ADD KEY `transaksi_penjualan_details_produk_id_foreign` (`produk_id`);

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
-- AUTO_INCREMENT untuk tabel `distributors`
--
ALTER TABLE `distributors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kasirs`
--
ALTER TABLE `kasirs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `pembelian_stok_produk`
--
ALTER TABLE `pembelian_stok_produk`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `produks`
--
ALTER TABLE `produks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_penjualans`
--
ALTER TABLE `transaksi_penjualans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `transaksi_penjualan_details`
--
ALTER TABLE `transaksi_penjualan_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

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
-- Ketidakleluasaan untuk tabel `pembelian_stok_produk`
--
ALTER TABLE `pembelian_stok_produk`
  ADD CONSTRAINT `pembelian_stok_produk_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `produks`
--
ALTER TABLE `produks`
  ADD CONSTRAINT `produks_distributor_id_foreign` FOREIGN KEY (`distributor_id`) REFERENCES `distributors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `produks_kategori_id_foreign` FOREIGN KEY (`kategori_id`) REFERENCES `kategoris` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi_penjualans`
--
ALTER TABLE `transaksi_penjualans`
  ADD CONSTRAINT `transaksi_penjualans_kasir_id_foreign` FOREIGN KEY (`kasir_id`) REFERENCES `kasirs` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi_penjualan_details`
--
ALTER TABLE `transaksi_penjualan_details`
  ADD CONSTRAINT `transaksi_penjualan_details_produk_id_foreign` FOREIGN KEY (`produk_id`) REFERENCES `produks` (`id`),
  ADD CONSTRAINT `transaksi_penjualan_details_transaksi_id_foreign` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi_penjualans` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
