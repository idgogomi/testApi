-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 19 Feb 2020 pada 23.12
-- Versi server: 10.1.44-MariaDB-cll-lve
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `konq1592_api`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `qty`, `harga`) VALUES
(3, 'songket', 35, 73000),
(21, 'gelas', 10, 1000),
(22, 'Mua', 555, 555),
(23, 'saos', 10, 20000),
(24, 'testing', 10, 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `inspirasinama_kategori`
--

CREATE TABLE `inspirasinama_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `inspirasinama_kategori`
--

INSERT INTO `inspirasinama_kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Arab'),
(2, 'Latin'),
(3, 'Inggris'),
(4, 'Jepang'),
(5, 'Yunani'),
(6, 'Sansekerta'),
(7, 'Ibrani'),
(8, 'Persia'),
(9, 'Jawa'),
(10, 'Rusia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inspirasinama_nama`
--

CREATE TABLE `inspirasinama_nama` (
  `id_nama` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `arti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `inspirasinama_nama`
--

INSERT INTO `inspirasinama_nama` (`id_nama`, `nama`, `id_kategori`, `arti`) VALUES
(1, 'Aqila', 1, 'Bijaksana dan berbakat'),
(2, 'Bella', 2, 'cantik, taat kepada Tuhan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `survei`
--

CREATE TABLE `survei` (
  `nik` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `domisili` varchar(50) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `create_at` date NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `survei`
--

INSERT INTO `survei` (`nik`, `nama`, `domisili`, `gender`, `create_at`, `lat`, `lng`) VALUES
(1, 'shunseng', 'depok', 'male', '2019-06-10', -6.353927, 106.840050),
(3, 'semvak merah', 'jakarta', 'male', '2019-06-07', -6.350089, 106.829651),
(12, 'qqq', 'qqq', 'male', '2019-06-07', 23.000000, 23.000000),
(23, 'tes', 'tes', 'male', '2019-06-07', -6.345599, 106.833344),
(123, 'charles', 'depok', 'male', '2019-06-05', -6.286541, 106.900688),
(376, 'bobo yawa', 'pinoy', 'male', '2019-06-07', -6.353977, 106.839981),
(444, 'goro', 'bekasi', 'female', '2019-06-07', -6.350089, 106.829651),
(1234, 'charles', 'depok', 'male', '2019-06-05', -6.286541, 106.900688),
(11111, 'kopo', 'tangerang', 'male', '2019-06-07', 66.000000, 66.000000),
(55555, 'Hello', 'World', 'male', '2019-06-07', -6.354865, 106.842781),
(123456, 'john wick', 'kontinental', 'male', '2019-06-06', -6.286541, 106.900688);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indeks untuk tabel `inspirasinama_kategori`
--
ALTER TABLE `inspirasinama_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `inspirasinama_nama`
--
ALTER TABLE `inspirasinama_nama`
  ADD PRIMARY KEY (`id_nama`);

--
-- Indeks untuk tabel `survei`
--
ALTER TABLE `survei`
  ADD PRIMARY KEY (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `inspirasinama_kategori`
--
ALTER TABLE `inspirasinama_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `inspirasinama_nama`
--
ALTER TABLE `inspirasinama_nama`
  MODIFY `id_nama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
