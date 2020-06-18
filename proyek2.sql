-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jun 2020 pada 16.49
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `proyek2`
--

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `bayar`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `bayar` (
`id_service` int(11)
,`status` enum('pengajuan','diterima','selesai')
,`petugas_id` int(40)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kendaraan`
--

CREATE TABLE `tb_kendaraan` (
  `id` int(11) NOT NULL,
  `petugas_id` int(40) NOT NULL,
  `tempat_tugas` varchar(40) NOT NULL,
  `no_kendaraan` varchar(40) DEFAULT NULL,
  `no_rangka` varchar(40) DEFAULT NULL,
  `no_mesin` varchar(40) DEFAULT NULL,
  `merek` varchar(40) DEFAULT NULL,
  `jenis` varchar(40) DEFAULT NULL,
  `tgl_berlaku` date DEFAULT NULL,
  `tgl_kir` date DEFAULT NULL,
  `tahun_masuk` int(11) DEFAULT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kendaraan`
--

INSERT INTO `tb_kendaraan` (`id`, `petugas_id`, `tempat_tugas`, `no_kendaraan`, `no_rangka`, `no_mesin`, `merek`, `jenis`, `tgl_berlaku`, `tgl_kir`, `tahun_masuk`, `gambar`, `created_at`, `updated_at`) VALUES
(45, 36, 'Kota Kediri', 'AG 7386  BG', '65444fsf2444', '5346265423', 'Yahama', 'tosa', '2020-06-19', '2020-06-19', NULL, '30366-2020-06-17-22-01-48.jpg', '2020-06-17 15:01:48', '2020-06-17 15:01:48'),
(46, 36, 'Kota Kediri', 'AG 5676 BG', 'HBF329JHJ', '5346265425', 'HILUX', 'tosa', '2020-06-11', '2020-06-26', NULL, '76407-2020-06-17-22-02-22.jpg', '2020-06-17 15:02:22', '2020-06-17 15:02:22'),
(47, 39, 'Kota Kediri', 'AG 5996 BG', '653627sf244', '5346265', 'ISUZU NKR 71 B2', 'truck dump', '2020-06-27', '2020-06-24', NULL, '87372-2020-06-18-03-05-17.jpg', '2020-06-17 20:05:17', '2020-06-17 20:05:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id` int(11) NOT NULL,
  `nama_petugas` varchar(40) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `no_hp` varchar(12) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `foto` varchar(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_petugas`
--

INSERT INTO `tb_petugas` (`id`, `nama_petugas`, `alamat`, `no_hp`, `email`, `user_id`, `foto`, `created_at`, `updated_at`) VALUES
(34, 'Galih Dwi P', 'Kota Kediri', '089639168431', 'gdwi24@gmail.com', 14, 'Aaron_Hill_on_July_22%2C_2013.jpg', '2020-06-11 04:37:41', '2020-06-10 21:37:41'),
(35, 'Amir Mahmud', 'Ds. Jambangan Pesantren', '089986431113', 'mahmud@gmail.com', 15, 'HTB1dz8mKbuWBuNjSszgq6z8jVXaQ.jpg_350x350.jpg', '2020-06-06 03:50:57', '2020-06-05 20:50:57'),
(36, 'Bima Enggus Saputra', 'kediri', '098765465789', 'Bima@gmail.com', 16, NULL, '2020-06-09 23:44:32', '2020-06-09 23:44:32'),
(37, 'bambang', 'kediri', '085736645772', 'bambang@gmail.com', 17, NULL, '2020-06-10 21:38:44', '2020-06-10 21:38:44'),
(38, 'SUPRIYANTO', 'ngasem', '085677455345', 'sup@gmail.com', 18, NULL, '2020-06-10 21:39:32', '2020-06-10 21:39:32'),
(39, 'AGUNG SANTOSO', 'kediri', '085345667876', 'agung@gmail.com', 19, NULL, '2020-06-10 21:40:21', '2020-06-10 21:40:21'),
(40, 'DWI PURWANTO', 'kediri', '089765455765', 'dwi@gmail.com', 20, NULL, '2020-06-10 21:41:23', '2020-06-10 21:41:23'),
(41, 'HANDOYO', 'ngasem', '087678654334', 'handoyo@gmai.com', 21, NULL, '2020-06-10 21:53:27', '2020-06-10 21:53:27'),
(42, 'AGUS H.', 'Kota  Kediri', '0987654345', 'Agus@gmai.com', 22, NULL, '2020-06-10 23:14:53', '2020-06-10 23:14:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_service`
--

CREATE TABLE `tb_service` (
  `id` int(11) NOT NULL,
  `kendaraan_id` int(11) NOT NULL,
  `tgl_service` date NOT NULL,
  `kategori_service` enum('pergantian part','oli','service rutin') NOT NULL,
  `foto_service` varchar(255) DEFAULT NULL,
  `bukti_pembayaran` varchar(225) DEFAULT NULL,
  `status` enum('pengajuan','diterima','selesai') DEFAULT 'pengajuan',
  `jumlah_service` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_service`
--

INSERT INTO `tb_service` (`id`, `kendaraan_id`, `tgl_service`, `kategori_service`, `foto_service`, `bukti_pembayaran`, `status`, `jumlah_service`, `created_at`, `updated_at`) VALUES
(55, 45, '2020-06-26', 'oli', NULL, NULL, 'pengajuan', NULL, '2020-06-18 03:26:17', '2020-06-18 03:26:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` enum('petugas','admin','kadin') NOT NULL,
  `telp` varchar(12) NOT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `level`, `telp`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'gdwi24@gmail.com', 'Galih Dwi', '$2y$10$j2zWoIy46X.RoQIakiP8k.Vdy1rKAolz2HCnR7lTQaK2cBLur2jBq', 'admin', '089677377765', '52142-2019-10-30-19-54-44.JPG', '2019-10-30 19:54:44', '2019-10-30 12:54:44'),
(5, 'didikcatur@dlhkp.com', 'Didik Catur', '$2y$10$yMvd2mMg.CBkTy63rwBplO02vRRYwZJ9O5W1Jju9tlDsi7jUTJqGK', 'kadin', '08974629187', '22561-2020-03-29-06-29-53.jpg', '2020-03-28 23:29:54', '2020-03-28 23:29:54'),
(15, 'mahmud@gmail.com', 'Amir Mahmud', '$2y$10$TjYmlQTR3kAao7.U71q/dOSbQOG4Jstb8BuzSLwzSkdmwjBYBmarm', 'petugas', '089986431113', '{{url(\'images/kendaraan/default.png\')}}', '2020-06-05 20:43:38', '2020-06-05 20:43:38'),
(16, 'Bima@gmail.com', 'Bima Enggus Saputra', '$2y$10$Ppm1D1efb9b4YHcpKualCuhD/izt7FPZfTLD6iuqYfxgBuTduGG0G', 'petugas', '098765465789', '{{url(\'images/kendaraan/default.png\')}}', '2020-06-09 23:44:32', '2020-06-09 23:44:32'),
(17, 'bambang@gmail.com', 'bambang', '$2y$10$gBV3Q12djnD2ugxrpYGmV.G3YRYFib5q5rO2Gkyh1GrRyx0HY5WYi', 'petugas', '085736645772', '{{url(\'images/kendaraan/default.png\')}}', '2020-06-10 21:38:44', '2020-06-10 21:38:44'),
(18, 'sup@gmail.com', 'SUPRIYANTO', '$2y$10$h3HXNE8XR1PlAGtWUP7qLOZwd27Mc8oKEKH8R6VfsE699BvN8g5lm', 'petugas', '085677455345', '{{url(\'images/kendaraan/default.png\')}}', '2020-06-10 21:39:32', '2020-06-10 21:39:32'),
(19, 'agung@gmail.com', 'AGUNG SANTOSO', '$2y$10$7CzfCKWKb3JcjcfmYqtI9e8YPTicPC49CCxw7/12l4zZKgoOqZO7y', 'petugas', '085345667876', '{{url(\'images/kendaraan/default.png\')}}', '2020-06-10 21:40:21', '2020-06-10 21:40:21'),
(20, 'dwi@gmail.com', 'DWI PURWANTO', '$2y$10$5rNWdVyBhH4nMN86WEFPU.cUlRpmu8qYTL6G5bphdG8dWeNM6xNH.', 'petugas', '089765455765', '{{url(\'images/kendaraan/default.png\')}}', '2020-06-10 21:41:23', '2020-06-10 21:41:23'),
(21, 'handoyo@gmai.com', 'HANDOYO', '$2y$10$LI.wXIgClTqwfWApZYmhXOx3FiKzHwA81VIPA/Y2fa1jpOx5uZ.qO', 'petugas', '087678654334', '{{url(\'images/kendaraan/default.png\')}}', '2020-06-10 21:53:27', '2020-06-10 21:53:27'),
(22, 'Agus@gmai.com', 'AGUS H.', '$2y$10$rnx3HIqdPFOKXyQ3ebebUeYjkrB15Wms9xmC2OUovw8/RAKtK8uW6', 'petugas', '0987654345', '{{url(\'images/kendaraan/default.png\')}}', '2020-06-10 23:14:53', '2020-06-10 23:14:53');

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_asets`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_asets` (
`id_petugas` int(11)
,`nama_petugas` varchar(40)
,`alamat` varchar(200)
,`no_hp` varchar(12)
,`email_petugas` varchar(40)
,`user_id` int(11)
,`foto` varchar(225)
,`id_kendaraan` int(11)
,`petugas_id` int(40)
,`tempat_tugas` varchar(40)
,`no_kendaraan` varchar(40)
,`no_rangka` varchar(40)
,`no_mesin` varchar(40)
,`merek` varchar(40)
,`jenis` varchar(40)
,`tgl_berlaku` date
,`tgl_kir` date
,`gambar` varchar(200)
,`id_user` int(11)
,`email` varchar(40)
,`username` varchar(40)
,`password` varchar(200)
,`level` enum('petugas','admin','kadin')
,`telp` varchar(12)
,`gambar_user` varchar(200)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `bayar`
--
DROP TABLE IF EXISTS `bayar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `bayar`  AS  select `a`.`id` AS `id_service`,`a`.`status` AS `status`,`b`.`petugas_id` AS `petugas_id` from ((`tb_service` `a` join `tb_kendaraan` `b`) join `tb_petugas` `c`) where `b`.`petugas_id` = `c`.`id` and `a`.`kendaraan_id` = `b`.`id` order by `a`.`id` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_asets`
--
DROP TABLE IF EXISTS `view_asets`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_asets`  AS  select `a`.`id` AS `id_petugas`,`a`.`nama_petugas` AS `nama_petugas`,`a`.`alamat` AS `alamat`,`a`.`no_hp` AS `no_hp`,`a`.`email` AS `email_petugas`,`a`.`user_id` AS `user_id`,`a`.`foto` AS `foto`,`b`.`id` AS `id_kendaraan`,`b`.`petugas_id` AS `petugas_id`,`b`.`tempat_tugas` AS `tempat_tugas`,`b`.`no_kendaraan` AS `no_kendaraan`,`b`.`no_rangka` AS `no_rangka`,`b`.`no_mesin` AS `no_mesin`,`b`.`merek` AS `merek`,`b`.`jenis` AS `jenis`,`b`.`tgl_berlaku` AS `tgl_berlaku`,`b`.`tgl_kir` AS `tgl_kir`,`b`.`gambar` AS `gambar`,`c`.`id` AS `id_user`,`c`.`email` AS `email`,`c`.`username` AS `username`,`c`.`password` AS `password`,`c`.`level` AS `level`,`c`.`telp` AS `telp`,`c`.`gambar` AS `gambar_user` from ((`tb_petugas` `a` join `tb_kendaraan` `b`) join `users` `c`) where `c`.`email` = `a`.`email` and `a`.`user_id` = `c`.`id` and `a`.`id` = `b`.`petugas_id` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `tb_kendaraan_ibfk_2` (`petugas_id`);

--
-- Indeks untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_service`
--
ALTER TABLE `tb_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kendaraan_id` (`kendaraan_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `tb_service`
--
ALTER TABLE `tb_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_kendaraan`
--
ALTER TABLE `tb_kendaraan`
  ADD CONSTRAINT `tb_kendaraan_ibfk_1` FOREIGN KEY (`petugas_id`) REFERENCES `tb_petugas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_service`
--
ALTER TABLE `tb_service`
  ADD CONSTRAINT `tb_service_ibfk_1` FOREIGN KEY (`kendaraan_id`) REFERENCES `tb_kendaraan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
