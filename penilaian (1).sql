-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Nov 2023 pada 10.09
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penilaian`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `guru`
--

CREATE TABLE `guru` (
  `kd_guru` int(11) NOT NULL,
  `nama_guru` varchar(50) NOT NULL,
  `pendidikan_guru` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `guru`
--

INSERT INTO `guru` (`kd_guru`, `nama_guru`, `pendidikan_guru`) VALUES
(1, 'iman', 'S1'),
(2, 'Radith', 'D3'),
(3, 'rehan', 'S3'),
(4, 'Iqbal', 'S1'),
(5, 'katon', 'D2'),
(6, 'Dafha', 'S3'),
(7, 'Reifan', 'D3'),
(8, 'Haitsam', 'S1'),
(9, 'Alfian', 'D2'),
(10, 'farel', 'S3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `kd_kelas` varchar(5) NOT NULL,
  `nama_kelas` varchar(20) NOT NULL,
  `jml_siswa` int(11) NOT NULL,
  `kd_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`kd_kelas`, `nama_kelas`, `jml_siswa`, `kd_guru`) VALUES
('11111', 'X RPL-1', 20, 5),
('22222', 'X RPL-2', 32, 1),
('33333', 'XI RPL-1', 30, 6),
('44444', 'XI RPL-2', 50, 2),
('55555', 'XII RPL-1', 50, 8),
('66666', 'XII RPL-2', 35, 9),
('77777', 'XII RPL-3', 90, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mapel`
--

CREATE TABLE `mapel` (
  `kd_mapel` varchar(30) NOT NULL,
  `nama_mapel` varchar(60) NOT NULL,
  `jp` int(11) NOT NULL,
  `kd_guru` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `mapel`
--

INSERT INTO `mapel` (`kd_mapel`, `nama_mapel`, `jp`, `kd_guru`) VALUES
('KD1212', 'Bahasa Inggris', 22, 1),
('KD1231', 'PKK', 5, 2),
('KD1234', 'Pemograman Berbasis Objek', 10, 3),
('KD1237', 'Pemograman Web', 7, 4),
('KD1239', 'Bahasa Sunda', 1, 5),
('KD2121', 'PPKN', 2, 6),
('KD2222', 'MATEMATIKA', 3, 7),
('KD2323', 'Bahasa Indonesia', 11, 8),
('KD4321', 'Dasar Kejuruan', 4, 9);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `kd_mapel` varchar(8) NOT NULL,
  `uts` smallint(4) NOT NULL,
  `uas` smallint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `nilai`
--

INSERT INTO `nilai` (`id`, `nis`, `kd_mapel`, `uts`, `uas`) VALUES
(24, 333333333, 'KD1234', 100, 90),
(42, 111111111, 'KD1231', 88, 88),
(45, 111111111, 'KD1234', 100, 78),
(46, 333333333, 'KD2222', 88, 99),
(48, 123456789, 'KD1239', 100, 87),
(52, 123456789, 'KD4321', 99, 77),
(53, 333333333, 'KD2121', 99, 88),
(61, 123123123, 'KD1212', 99, 83),
(68, 111111111, 'KD1212', 91, 77),
(71, 111111111, 'KD2222', 67, 75),
(73, 999999999, 'KD1212', 90, 66),
(75, 123123123, 'KD2222', 99, 75),
(76, 333333333, 'KD1212', 90, 90),
(77, 10101010, 'KD1212', 99, 77);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
--

CREATE TABLE `role_user` (
  `id_role_user` int(11) NOT NULL,
  `nama_role_user` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`id_role_user`, `nama_role_user`) VALUES
(1, 'admin'),
(2, 'guru');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` int(11) NOT NULL,
  `nama_siswa` varchar(50) NOT NULL,
  `jk_siswa` enum('Perempuan','Laki-Laki') NOT NULL,
  `alamat_siswa` varchar(50) NOT NULL,
  `kd_kelas` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `nama_siswa`, `jk_siswa`, `alamat_siswa`, `kd_kelas`) VALUES
(10101010, 'uning', 'Laki-Laki', 'bekasi', '11111'),
(111111111, 'radith', 'Laki-Laki', 'jakarta', '22222'),
(121212121, 'Putri', 'Perempuan', 'Bekasi ', '33333'),
(123123123, 'Dafha ', 'Laki-Laki', 'Villa mas garden', '33333'),
(123456789, 'katon', 'Laki-Laki', 'seroja', '44444'),
(222222222, 'wahyu', 'Laki-Laki', 'bekasi', '55555'),
(333333333, 'miku', 'Perempuan', 'Tanggerang', '66666'),
(999999999, 'kanna', 'Perempuan', 'bekla', '11111');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_role_user` int(11) NOT NULL,
  `kd_guru` int(11) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `id_role_user`, `kd_guru`, `nama_user`, `username`, `password`) VALUES
(1, 1, 6, 'muhammad dafha', 'dafha', '12345');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`kd_guru`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kd_kelas`),
  ADD KEY `kd_guru` (`kd_guru`);

--
-- Indeks untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD PRIMARY KEY (`kd_mapel`),
  ADD KEY `kd_guru` (`kd_guru`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kd_mapel` (`kd_mapel`) USING BTREE,
  ADD KEY `nis` (`nis`) USING BTREE;

--
-- Indeks untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id_role_user`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `kd_kelas` (`kd_kelas`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_role_user` (`id_role_user`),
  ADD KEY `kd_guru` (`kd_guru`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT untuk tabel `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id_role_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_ibfk_1` FOREIGN KEY (`kd_guru`) REFERENCES `guru` (`kd_guru`);

--
-- Ketidakleluasaan untuk tabel `mapel`
--
ALTER TABLE `mapel`
  ADD CONSTRAINT `mapel_ibfk_1` FOREIGN KEY (`kd_guru`) REFERENCES `guru` (`kd_guru`);

--
-- Ketidakleluasaan untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`kd_mapel`) REFERENCES `mapel` (`kd_mapel`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`kd_kelas`) REFERENCES `kelas` (`kd_kelas`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`kd_guru`) REFERENCES `guru` (`kd_guru`),
  ADD CONSTRAINT `user_ibfk_3` FOREIGN KEY (`id_role_user`) REFERENCES `role_user` (`id_role_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
