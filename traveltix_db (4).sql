-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Nov 2023 pada 15.45
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traveltix_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `booking`
--

CREATE TABLE `booking` (
  `id` int(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `asal` varchar(20) NOT NULL,
  `tujuan` varchar(20) NOT NULL,
  `kuantitas_tiket` int(30) NOT NULL,
  `total_pembayaran` int(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `destination`
--

CREATE TABLE `destination` (
  `id` int(30) NOT NULL,
  `asal` varchar(20) NOT NULL,
  `tujuan` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_pesawat` varchar(30) NOT NULL,
  `harga_tiket` int(30) NOT NULL,
  `image` varchar(500) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `destination`
--

INSERT INTO `destination` (`id`, `asal`, `tujuan`, `tanggal`, `nama_pesawat`, `harga_tiket`, `image`, `rate`) VALUES
(9, 'Balikpapan', 'Lombok', '2023-11-23', 'Redflag', 2600000, 'th (2).jpg', 2),
(10, 'Yogyakarta', 'Jakarta', '2023-11-24', 'wadawd', 2600000, 'bukit bintang.jpg', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ordered`
--

CREATE TABLE `ordered` (
  `id` int(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `asal` varchar(20) NOT NULL,
  `tujuan` varchar(30) NOT NULL,
  `pesawat` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ordered`
--

INSERT INTO `ordered` (`id`, `username`, `asal`, `tujuan`, `pesawat`, `tanggal`, `status`) VALUES
(1, 'farid', 'Yogyakarta', 'Jakarta', 'wadawd', '2023-11-24', 'lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `email_address` varchar(20) NOT NULL,
  `phone_number` varchar(30) NOT NULL,
  `pincode` int(30) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(30) NOT NULL,
  `reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email_address`, `phone_number`, `pincode`, `dob`, `address`, `reset_token`) VALUES
(1, 'nofan', 'nofangagah', 'nofan@gmail.com', '0812345678', 2222, '2023-11-04', 'jogja', NULL),
(2, 'farid', 'faridaja', 'bambang@gmail.com', '0812345678', 69696, '3033-11-22', 'godean', NULL),
(3, 'nofan', 'faridaja', 'nofangagah@gmail.com', '082339477974', 0, '0333-11-22', 'a', NULL),
(4, 'nofan', 'nofan123#*', 'novanzohrial2@gmail.', '082339477974', 111, '0033-11-22', 's', NULL),
(7, 'Admin', 'admin123', 'admin20@gmail.com', '08121313131', 52123, '2023-11-01', 'Padwa', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ordered`
--
ALTER TABLE `ordered`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `ordered`
--
ALTER TABLE `ordered`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
