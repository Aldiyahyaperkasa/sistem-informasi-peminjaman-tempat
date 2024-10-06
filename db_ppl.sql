-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Okt 2024 pada 08.26
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ppl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id_peminjaman` varchar(10) NOT NULL,
  `peminjam` varchar(10) NOT NULL,
  `ruangan_dipinjam` varchar(12) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `waktu_peminjaman` datetime NOT NULL,
  `waktu_pengembalian` datetime DEFAULT NULL,
  `status_pinjam` varchar(15) NOT NULL,
  `pdf_file` varchar(255) DEFAULT NULL,
  `alasan_penolakan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`id_peminjaman`, `peminjam`, `ruangan_dipinjam`, `keterangan`, `waktu_peminjaman`, `waktu_pengembalian`, `status_pinjam`, `pdf_file`, `alasan_penolakan`) VALUES
('SIPT-00001', 'pengguna', '01', 'seminar penyuluhan narkoba', '2024-07-04 11:55:00', '2024-07-04 22:55:00', 'selesai', '1719892337_d114d691bb194e2e4b78.pdf', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ruangan`
--

CREATE TABLE `tb_ruangan` (
  `id_ruangan` varchar(12) NOT NULL,
  `nama_ruangan` varchar(50) NOT NULL,
  `gambar_ruangan` varchar(255) NOT NULL,
  `status` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_ruangan`
--

INSERT INTO `tb_ruangan` (`id_ruangan`, `nama_ruangan`, `gambar_ruangan`, `status`) VALUES
('01', 'Aula Dispopar', 'aula dispora.jpeg', 'Tersedia'),
('02', 'Sarana Prasarana Lapangan Bessai Berinta', 'lap. bola lang lang.jpeg', 'Tersedia'),
('03', 'Sarana Prasarana Lapangan Tennis Bessai Berinta', 'ruangan pendopo_1.jpg', 'Tersedia'),
('04', 'Sarana Prasarana Lapangan Taman Prestasi', 'ruangan pendopo_2.jpg', 'Tersedia'),
('05', 'Sarana Prasarana Gedung Sport Center Loktuan', 'ruangan pendopo_3.jpg', 'Tersedia'),
('06', 'Mangrove Edu Park Berbas Pantai', 'ruangan pendopo_4.jpg', 'Tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `username` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`username`, `fullname`, `password`, `level`) VALUES
('adinda', 'adinda febriyanti', '80ae4feb95c0768096fcdeee2e395936', 'Bagian Umum'),
('admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Bagian Umum'),
('akuu', 'akuu', '6dde7deb200847809f1b72b6fad7e8b2', 'Pengguna Ruangan'),
('aldi', 'aldi yahya', '5cf15fc7e77e85f5d525727358c0ffc9', 'Bagian Umum'),
('dila', 'nurfadillah', '35862fcf105f1aaa0b4f29ca71b96236', 'Bagian Umum'),
('pengguna', 'pengguna', '8b097b8a86f9d6a991357d40d3d58634', 'Pengguna Ruangan'),
('ppl', 'ppl', '5396681eea50ad639ae3c9f8ca17b7d8', 'Pengguna Ruangan'),
('sherly', 'sherly Rahmawaty', '1c8b06358890d6c512859b21557315b4', 'Bagian Umum'),
('stitek', 'stitek', '3754143605da38744db125fb10213d5c', 'Pengguna Ruangan'),
('user', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'Pengguna Ruangan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `ruangan_dipinjam` (`ruangan_dipinjam`),
  ADD KEY `peminjam` (`peminjam`);

--
-- Indeks untuk tabel `tb_ruangan`
--
ALTER TABLE `tb_ruangan`
  ADD PRIMARY KEY (`id_ruangan`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`username`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD CONSTRAINT `tb_peminjaman_ibfk_2` FOREIGN KEY (`ruangan_dipinjam`) REFERENCES `tb_ruangan` (`id_ruangan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_peminjaman_ibfk_3` FOREIGN KEY (`peminjam`) REFERENCES `tb_user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
