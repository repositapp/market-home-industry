-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 04 Jul 2022 pada 00.54
-- Versi server: 10.5.15-MariaDB-cll-lve
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u1794227_market`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `nm_admin` varchar(50) NOT NULL,
  `jk_admin` char(10) NOT NULL,
  `telp_admin` varchar(15) NOT NULL,
  `email_admin` varchar(25) NOT NULL,
  `alamat_admin` text NOT NULL,
  `foto_admin` text NOT NULL,
  `change_admin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `id_user`, `nm_admin`, `jk_admin`, `telp_admin`, `email_admin`, `alamat_admin`, `foto_admin`, `change_admin`) VALUES
(1, 1, 'Jonathan Edward', 'Laki-Laki', '080012121212', 'jonathan.ed@gmail.com', 'Jl. Jendral Sudirman No. 32', '7f6ea07c2d1c4498c25613efde18bbfe.png', '2022-02-13 17:59:34'),
(2, 3, 'Renata', 'Perempuan', '081212121212', 'renata@gmail.com', 'Jl. Keliling', 'user1.png', '2021-11-12 15:44:47');

-- --------------------------------------------------------

--
-- Struktur dari tabel `alamat_costumer`
--

CREATE TABLE `alamat_costumer` (
  `id_alamat` int(5) NOT NULL,
  `costumer` int(3) NOT NULL,
  `nama_alamat` varchar(50) NOT NULL,
  `wilayah` int(3) NOT NULL,
  `detail_alamat` text NOT NULL,
  `telp_alamat` varchar(16) NOT NULL,
  `tipe_alamat` varchar(25) NOT NULL,
  `status_alamat` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `alamat_costumer`
--

INSERT INTO `alamat_costumer` (`id_alamat`, `costumer`, `nama_alamat`, `wilayah`, `detail_alamat`, `telp_alamat`, `tipe_alamat`, `status_alamat`) VALUES
(1, 10, 'Wirardo Atmajaya Syahputra', 10, 'Jl. Martadinata No.21', '080812121212', 'rumah', 1),
(2, 10, 'Wirardo Atmajaya Syahputra', 37, 'Jl.Kesana No.12', '080812121213', 'kantor', 0),
(5, 12, '', 41, 'Jl. Example', '080812121212', 'rumah', 1),
(6, 14, '', 18, 'Jl. Kalista Numbar No 31', '080812121212', 'rumah', 1),
(7, 14, '', 39, 'Jl. Sidarta Gautama No 11', '080812121212', 'kantor', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `bank`
--

CREATE TABLE `bank` (
  `id_bank` int(3) NOT NULL,
  `nm_bank` varchar(35) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `pemilik` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bank`
--

INSERT INTO `bank` (`id_bank`, `nm_bank`, `no_rekening`, `pemilik`) VALUES
(1, 'BCA', '6860148577', 'Cafe Baneno'),
(2, 'BRI', '050401000240301', 'Cafe Baneno'),
(3, 'BNI', '0095777779', 'Cafe Baneno'),
(4, 'Mandiri', '0700001877773', 'Cafe Baneno');

-- --------------------------------------------------------

--
-- Struktur dari tabel `costumer`
--

CREATE TABLE `costumer` (
  `id_costumer` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `nm_costumer` varchar(50) NOT NULL,
  `jk_costumer` char(10) NOT NULL,
  `telp_costumer` varchar(15) NOT NULL,
  `email_costumer` varchar(25) NOT NULL,
  `foto_costumer` text NOT NULL,
  `change_costumer` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `costumer`
--

INSERT INTO `costumer` (`id_costumer`, `id_user`, `nm_costumer`, `jk_costumer`, `telp_costumer`, `email_costumer`, `foto_costumer`, `change_costumer`) VALUES
(4, 10, 'Wirardo Atmajaya Syahputra', 'Laki-Laki', '081212121212', 'wirardo.as00@gmail.com', '121368b84ac218f0ff5bf71261c4bbf5.PNG', '2021-11-30 17:41:51'),
(6, 12, 'Test', 'Laki-Laki', '0808080808', 'test@gmail.com', 'default.png', '2021-12-01 17:10:45'),
(8, 14, 'Urian', 'Laki-Laki', '002300110099', 'urian@gmail.com', 'default.png', '2021-12-02 22:14:58'),
(10, 28, 'Nani', 'Perempuan', '008022123323', 'example@gmail.com', 'default.png', '2022-06-25 11:18:30'),
(11, 29, 'Wahid', 'Laki-Laki', '080000000000', 'wahid@gmail.com', 'default.png', '2022-06-19 10:54:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `diskon`
--

CREATE TABLE `diskon` (
  `id_diskon` int(4) NOT NULL,
  `kode_diskon` varchar(18) NOT NULL,
  `kode_produk` varchar(18) NOT NULL,
  `jumlah_diskon` int(3) NOT NULL,
  `awal_diskon` date NOT NULL,
  `akhir_diskon` date NOT NULL,
  `status_diskon` int(2) NOT NULL,
  `change_diskon` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `diskon`
--

INSERT INTO `diskon` (`id_diskon`, `kode_diskon`, `kode_produk`, `jumlah_diskon`, `awal_diskon`, `akhir_diskon`, `status_diskon`, `change_diskon`) VALUES
(1, 'DHEx1Kwqe3LlHx3', 'KRP-5238579596-010', 6, '2022-02-22', '2022-02-27', 1, '2021-11-23 16:18:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gambar_produk`
--

CREATE TABLE `gambar_produk` (
  `id_gambar_produk` int(4) NOT NULL,
  `kode_produk` varchar(18) NOT NULL,
  `gambar_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gambar_produk`
--

INSERT INTO `gambar_produk` (`id_gambar_produk`, `kode_produk`, `gambar_produk`) VALUES
(81, 'KRP-0511177897-001', 'e0bbf50501cf2b70cc62e1511924433a.jpg'),
(82, 'KRP-0511177897-001', '06852c1d4cbddd0290ccd699b029a6cb.jpg'),
(84, 'KRP-9066886550-002', '4d18c3d045dcd99b8e22a97a1336ddc9.jpg'),
(85, 'KRP-9066886550-002', '89e94bffb54ca9af101ff3cfdd31b0c9.jpg'),
(87, 'KRP-9066886550-002', 'aab953a37b9da3ef4027f622784911ea.jpg'),
(88, 'KRP-9361567181-003', '8fee44f9a8e31164b85b39b55e610410.jpg'),
(89, 'KRP-9361567181-003', '096c06c16c441beb51181363347af359.jpg'),
(90, 'KRP-9361567181-003', 'd73ab6234f009ec5aba4213d0fddc2bd.jpg'),
(91, 'KRP-9361567181-003', '8788e087916bce89deffe022980e3b31.jpg'),
(92, 'KRP-2580126135-004', '772e047319269a41fab6829dcc338ebd.jpg'),
(93, 'KRP-2580126135-004', 'c90917315b9051709f0e21a68cbb156b.jpg'),
(94, 'KRP-0632106326-005', '741d6831c37be2c057403b9461074af7.jpg'),
(95, 'KRP-0632106326-005', '7e9b54252c6d01694bfe5956a316707e.jpg'),
(96, 'KRP-4653268606-006', '88b7afce932484746c2c1a6ccdec668d.jpg'),
(97, 'KRP-4653268606-006', '1cf2a5437a859d7af9302ed9684c11f7.jpg'),
(98, 'KRP-6628005131-007', '0a604c9021448b8ec9f14f67c1fe9420.jpg'),
(99, 'KRP-6628005131-007', '9d75a6c772d453480242a1cd7a15e0b4.jpg'),
(100, 'KRP-6628005131-007', '9d3703055ccf306cc94d1219a1677a8c.jpg'),
(101, 'KRP-1558578380-008', '06d502a80197826223c22553bc9bdbcc.jpg'),
(102, 'KRP-1558578380-008', '64d1e15cb7c13c3cc6338c381b29bd2f.jpg'),
(103, 'KRP-1558578380-008', '75d6f16c7c97aee2507892c9deb1dc73.jpg'),
(104, 'KRP-3863406633-009', '9b57715e2cb86ce94129cdc7150d0f7a.jpg'),
(105, 'KRP-3863406633-009', '1b08ebd0972dcb309c8cae1b7c0e6df7.jpg'),
(106, 'KRP-3863406633-009', '148dc0c97b62ccd43c1c811a45f81f68.jpg'),
(107, 'KRP-0867238516-010', '3d5e9c3a052772a327d8d7cd2f49a330.jpg'),
(108, 'KRP-0867238516-010', '1e05c8ad8df31180d3162a0bb3db813c.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori_produk` int(3) NOT NULL,
  `nm_kategori_produk` varchar(35) NOT NULL,
  `gambar_kategori_produk` text NOT NULL,
  `status_kategori_produk` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori_produk`, `nm_kategori_produk`, `gambar_kategori_produk`, `status_kategori_produk`) VALUES
(8, 'Kerajinan', '5f8254c974fffdb6ab4dcaaf3fa7ee80.png', 1),
(9, 'Kopi', '6759d0d1d193fd5e9da0ff0b4d027498.png', 1),
(10, 'Olahan Bawang', '35688e36ecb2753107eaceac2e9dd053.png', 1),
(11, 'Abon', '822a382951bc0bbd3403c157e0df2d04.png', 1),
(14, 'Ikan', 'e92839903807dfe61a405b59c75c1047.png', 1),
(15, 'Makanan & Cemilan', 'd767010fa62dbd2accf4edacc8e60cf4.png', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kebijakan`
--

CREATE TABLE `kebijakan` (
  `id_kebijakan` int(3) NOT NULL,
  `konten_kebijakan` text NOT NULL,
  `change_kebijakan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kebijakan`
--

INSERT INTO `kebijakan` (`id_kebijakan`, `konten_kebijakan`, `change_kebijakan`) VALUES
(1, '<h4 class=\"mb-1\" style=\"line-height: 1.3; font-size: 14px; margin-right: 0px; margin-left: 0px; color: rgb(34, 34, 34); font-family: Lato, sans-serif;\"><b style=\"font-size: 10.5pt;\">Permohonan untuk\r\nPengembalian Barang/Dana</b><br></h4><h2 class=\"mb-3\" style=\"line-height: 1.3; margin-right: 0px; margin-left: 0px;\"><p class=\"content-color\" style=\"font-size: 14px; line-height: 1.3; font-family: Lato, sans-serif; color: rgb(119, 119, 119) !important;\">Dengan tunduk pada syarat dan ketentuan dalam Kebijakan Pengembalian Dana dan Barang ini serta Syarat Layanan, Pembeli dapat mengajukan permohonan untuk pengembalian barang yang dibeli (\"Barang\") dan/atau pengembalian dana sebelum barang sampai ke tangan pembeli.</p></h2><h4 class=\"mb-1\" style=\"line-height: 1.3; font-size: 14px; margin-right: 0px; margin-left: 0px; color: rgb(34, 34, 34); font-family: Lato, sans-serif;\">Pengembalian Dana Transfer</h4><h2 class=\"mb-3\" style=\"line-height: 1.3; margin-right: 0px; margin-left: 0px;\"><p class=\"content-color\" style=\"font-size: 14px; line-height: 1.3; font-family: Lato, sans-serif; color: rgb(119, 119, 119) !important;\">Uang Pembeli hanya akan dikembalikan setelah Pihak UMKM menerima konfirmasi dari Kurir bahwa Kurir telah menerima Barang yang dikembalikan. Apabila Pihak UMKM tidak mendengar dari Kurir dalam jangka waktu yang ditentukan, Pihak UMKM memiliki kebebasan untuk mengembalikan jumlah yang sesuai kepada Pembeli.</p></h2><h4 class=\"mb-1\" style=\"line-height: 1.3; font-size: 14px; margin-right: 0px; margin-left: 0px; color: rgb(34, 34, 34); font-family: Lato, sans-serif;\">Tanggung Jawab Biaya Pengiriman Barang Yang Dikembalikan</h4><h2 class=\"mb-3\" style=\"line-height: 1.3; margin-right: 0px; margin-left: 0px;\"><ul class=\"listing-section mb-2\" style=\"padding-inline-start: 20px; color: rgb(34, 34, 34); font-family: Lato, sans-serif; font-size: 14px;\"><li style=\"color: rgb(119, 119, 119);\">Dalam skenario kesalahan yang tidak terduga dari sisi Banenos (yaitu produk rusak, cacat atau salah dikirimkan ke Pembeli), Pihak UMKM&nbsp;atau Pembeli akan menanggung biaya pengiriman pengembalian Barang bergantung pada kesepakatan Pihak UMKM&nbsp;dan Pembeli;</li><li style=\"color: rgb(119, 119, 119);\">Dalam skenario dimana Pihak UMKM&nbsp;dan Pembeli mempersengketakan siapa pihak yang bertanggung jawab atas biaya pengiriman Barang yang dikembalikan, Pihak UMKM&nbsp;atas kebijakannya sendiri akan menentukan siapa pihak yang akan bertanggung jawab atas biaya pengiriman pengembalian Barang.</li></ul></h2>', '2022-02-13 23:27:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id_kecamatan` int(5) NOT NULL,
  `id_kota` int(5) NOT NULL,
  `nm_kecamatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kecamatan`
--

INSERT INTO `kecamatan` (`id_kecamatan`, `id_kota`, `nm_kecamatan`) VALUES
(1, 1, 'Batupoaro'),
(2, 1, 'Betoambari'),
(3, 1, 'Bungi'),
(4, 1, 'Kokalukuna'),
(5, 1, 'Lea-Lea'),
(6, 1, 'Murhum'),
(7, 1, 'Sorawolio'),
(8, 1, 'Wolio');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id_kelurahan` int(5) NOT NULL,
  `id_kecamatan` int(5) NOT NULL,
  `nm_kelurahan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelurahan`
--

INSERT INTO `kelurahan` (`id_kelurahan`, `id_kecamatan`, `nm_kelurahan`) VALUES
(1, 1, 'Bone-Bone'),
(2, 1, 'Kaobula'),
(3, 1, 'Lanto'),
(4, 1, 'Nganganaumala'),
(5, 1, 'Tarafu'),
(6, 1, 'Wameo'),
(7, 2, 'Katobengke'),
(8, 2, 'Labalawa'),
(9, 2, 'Lipu'),
(10, 2, 'Sulaa'),
(11, 2, 'Waborobo'),
(12, 3, 'Kampeonaho'),
(13, 3, 'Liabuku'),
(14, 3, 'Ngkaring Karing'),
(15, 3, 'Tampuna'),
(16, 3, 'Waliabuku'),
(17, 4, 'Kadolo'),
(18, 4, 'Kadolomoko'),
(19, 4, 'Lakologou'),
(20, 4, 'Liwuto'),
(21, 4, 'Sukanaeyo'),
(22, 4, 'Waruruma'),
(23, 5, 'Kalia-Lia'),
(24, 5, 'Kantalai'),
(25, 5, 'Kolese'),
(26, 5, 'Lowu-Lowu'),
(27, 5, 'Palabusa'),
(28, 6, 'Baadia'),
(29, 6, 'Lamangga'),
(30, 6, 'Melai'),
(31, 6, 'Tanganapada'),
(32, 6, 'Wajo'),
(33, 7, 'Bugi'),
(34, 7, 'Gonda Baru'),
(35, 7, 'Kaisabu Baru'),
(36, 7, 'Karya Baru'),
(37, 8, 'Bataraguru'),
(38, 8, 'Batulo'),
(39, 8, 'Bukit Wolio Indah'),
(40, 8, 'Kadolo Katapi'),
(41, 8, 'Tomba'),
(42, 8, 'Wale'),
(43, 8, 'Wangkanapi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(5) NOT NULL,
  `costumer` int(3) NOT NULL,
  `reseler` int(5) NOT NULL,
  `kode_produk` varchar(18) NOT NULL,
  `qty` int(5) NOT NULL,
  `nm_produk` text NOT NULL,
  `harga_produk` bigint(15) NOT NULL,
  `variasi_produk` int(5) NOT NULL,
  `change_keranjang` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(5) NOT NULL,
  `nm_kota` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kota`
--

INSERT INTO `kota` (`id_kota`, `nm_kota`) VALUES
(1, 'Baubau');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `reseler` int(5) NOT NULL,
  `nm_kurir` varchar(50) NOT NULL,
  `jk_kurir` char(10) NOT NULL,
  `telp_kurir` varchar(15) NOT NULL,
  `email_kurir` varchar(25) NOT NULL,
  `alamat_kurir` text NOT NULL,
  `foto_kurir` text NOT NULL,
  `status_kurir` int(3) NOT NULL,
  `change_kurir` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kurir`
--

INSERT INTO `kurir` (`id_kurir`, `id_user`, `reseler`, `nm_kurir`, `jk_kurir`, `telp_kurir`, `email_kurir`, `alamat_kurir`, `foto_kurir`, `status_kurir`, `change_kurir`) VALUES
(4, 8, 0, 'Norani', 'Laki-Laki', '080812121212', 'kurirpertama@gmail.com', 'Jl. Kesana', 'f8ab26632964b4d9fe0660caf4f9d7a0.jpg', 0, '2021-11-30 19:35:42'),
(6, 26, 0, 'Kurir Ke Dua', 'Perempuan', '080812123322', 'mail@gmail.com', 'Jl. Kelurahan', '582299935f983beb38d8b5b901f93abc.png', 1, '2022-06-29 19:20:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `wilayah` int(3) NOT NULL,
  `harga_ongkir` bigint(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `wilayah`, `harga_ongkir`) VALUES
(1, 42, 5000),
(3, 41, 5000),
(4, 40, 5000),
(5, 39, 5000),
(6, 38, 5000),
(7, 37, 5000),
(8, 36, 5000),
(9, 35, 5000),
(10, 34, 5000),
(11, 33, 5000),
(12, 32, 5000),
(13, 31, 5000),
(14, 30, 5000),
(15, 29, 5000),
(16, 28, 5000),
(17, 27, 5000),
(18, 26, 5000),
(19, 25, 5000),
(20, 24, 5000),
(21, 23, 5000),
(22, 22, 5000),
(23, 21, 5000),
(24, 20, 5000),
(25, 19, 5000),
(26, 18, 5000),
(27, 17, 5000),
(28, 16, 5000),
(29, 15, 5000),
(30, 14, 5000),
(31, 13, 5000),
(32, 12, 5000),
(33, 11, 5000),
(34, 10, 5000),
(35, 9, 5000),
(37, 8, 5000),
(38, 7, 5000),
(39, 6, 5000),
(40, 5, 5000),
(41, 4, 5000),
(42, 3, 5000),
(43, 1, 5000),
(45, 2, 5000),
(46, 42, 6000),
(47, 41, 6000),
(48, 40, 6000),
(49, 39, 6000),
(50, 38, 6000),
(51, 37, 6000),
(52, 36, 6000),
(53, 35, 6000),
(54, 34, 6000),
(55, 33, 6000),
(56, 32, 6000),
(57, 31, 6000),
(58, 30, 6000),
(59, 29, 6000),
(60, 28, 6000),
(61, 27, 6000),
(62, 26, 6000),
(63, 25, 6000),
(64, 24, 6000),
(65, 23, 6000),
(66, 22, 6000),
(67, 21, 6000),
(68, 20, 6000),
(69, 19, 6000),
(70, 18, 6000),
(71, 17, 6000),
(72, 16, 6000),
(73, 15, 6000),
(74, 14, 6000),
(75, 13, 6000),
(76, 12, 6000),
(77, 11, 6000),
(78, 10, 6000),
(79, 9, 6000),
(80, 8, 6000),
(81, 7, 6000),
(82, 6, 6000),
(83, 5, 6000),
(84, 4, 6000),
(85, 3, 6000),
(86, 1, 6000),
(87, 2, 6000),
(88, 42, 7000),
(89, 41, 7000),
(90, 40, 7000),
(91, 39, 7000),
(92, 38, 7000),
(93, 37, 7000),
(94, 36, 7000),
(95, 35, 7000),
(96, 34, 7000),
(97, 33, 7000),
(98, 32, 7000),
(99, 31, 7000),
(100, 30, 7000),
(101, 29, 7000),
(102, 28, 7000),
(103, 27, 7000),
(104, 26, 7000),
(105, 25, 7000),
(106, 24, 7000),
(107, 23, 7000),
(108, 22, 7000),
(109, 21, 7000),
(110, 20, 7000),
(111, 19, 7000),
(112, 18, 7000),
(113, 17, 7000),
(114, 16, 7000),
(115, 15, 7000),
(116, 14, 7000),
(117, 13, 7000),
(118, 12, 7000),
(119, 11, 7000),
(120, 10, 7000),
(121, 9, 7000),
(122, 8, 7000),
(123, 7, 7000),
(124, 6, 7000),
(125, 5, 7000),
(126, 4, 7000),
(127, 3, 7000),
(128, 1, 7000),
(129, 2, 7000),
(130, 42, 4000),
(131, 41, 4000),
(132, 40, 4000),
(133, 39, 4000),
(134, 38, 4000),
(135, 37, 4000),
(136, 36, 4000),
(137, 35, 4000),
(138, 34, 4000),
(139, 33, 4000),
(140, 32, 4000),
(141, 31, 4000),
(142, 30, 4000),
(143, 29, 4000),
(144, 28, 4000),
(145, 27, 4000),
(146, 26, 4000),
(147, 25, 4000),
(148, 24, 4000),
(149, 23, 4000),
(150, 22, 4000),
(151, 21, 4000),
(152, 20, 4000),
(153, 19, 4000),
(154, 18, 4000),
(155, 17, 4000),
(156, 16, 4000),
(157, 15, 4000),
(158, 14, 4000),
(159, 13, 4000),
(160, 12, 4000),
(161, 11, 4000),
(162, 10, 4000),
(163, 9, 4000),
(164, 8, 4000),
(165, 7, 4000),
(166, 6, 4000),
(167, 5, 4000),
(168, 4, 4000),
(169, 3, 4000),
(170, 1, 4000),
(171, 2, 4000),
(172, 42, 8000),
(173, 41, 8000),
(174, 40, 8000),
(175, 39, 8000),
(176, 38, 8000),
(177, 37, 8000),
(178, 36, 8000),
(179, 35, 8000),
(180, 34, 8000),
(181, 33, 8000),
(182, 32, 8000),
(183, 31, 8000),
(184, 30, 8000),
(185, 29, 8000),
(186, 28, 8000),
(187, 27, 8000),
(188, 26, 8000),
(189, 25, 8000),
(190, 24, 8000),
(191, 23, 8000),
(192, 22, 8000),
(193, 21, 8000),
(194, 20, 8000),
(195, 19, 8000),
(196, 18, 8000),
(197, 17, 8000),
(198, 16, 8000),
(199, 15, 8000),
(200, 14, 8000),
(201, 13, 8000),
(202, 12, 8000),
(203, 11, 8000),
(204, 10, 8000),
(205, 9, 8000),
(206, 8, 8000),
(207, 7, 8000),
(208, 6, 8000),
(209, 5, 8000),
(210, 4, 8000),
(211, 3, 8000),
(212, 1, 8000),
(213, 2, 8000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir_jasa`
--

CREATE TABLE `ongkir_jasa` (
  `id_ongkir_jasa` int(3) NOT NULL,
  `jasa_pengiriman` varchar(30) NOT NULL,
  `harga_perkilo` bigint(15) NOT NULL,
  `logo_jasa` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ongkir_jasa`
--

INSERT INTO `ongkir_jasa` (`id_ongkir_jasa`, `jasa_pengiriman`, `harga_perkilo`, `logo_jasa`) VALUES
(1, 'Kurir', 10000, 'kurir.png'),
(2, 'JNE', 6000, 'jne.png'),
(4, 'JNT', 8000, 'jnt.png'),
(5, 'Tiki', 7500, 'tiki.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(5) NOT NULL,
  `reseler` int(5) NOT NULL,
  `kategori_produk` int(3) NOT NULL,
  `kode_produk` varchar(18) NOT NULL,
  `nm_produk` text NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `harga_produk` bigint(15) NOT NULL,
  `harga_modal` bigint(15) NOT NULL,
  `stok` int(4) NOT NULL,
  `ukuran_jual` varchar(50) NOT NULL,
  `satuan_jual` varchar(15) NOT NULL,
  `berat` int(11) NOT NULL,
  `status_produk` int(2) NOT NULL,
  `change_produk` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `reseler`, `kategori_produk`, `kode_produk`, `nm_produk`, `deskripsi_produk`, `harga_produk`, `harga_modal`, `stok`, `ukuran_jual`, `satuan_jual`, `berat`, `status_produk`, `change_produk`) VALUES
(27, 25, 11, 'KRP-0511177897-001', 'Abon Lande Aneka Rasa', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates nostrum magnam tenetur, iusto necessitatibus neque ducimus cum blanditiis? Maxime, dicta! Facilis atque asperiores facere deserunt perspiciatis natus sed perferendis porro.<br></p>', 35000, 30000, 120, '1', 'Pack', 650, 1, '2022-06-26 19:18:31'),
(28, 25, 14, 'KRP-9066886550-002', 'Ikan Kayu', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates nostrum magnam tenetur, iusto necessitatibus neque ducimus cum blanditiis? Maxime, dicta! Facilis atque asperiores facere deserunt perspiciatis natus sed perferendis porro.<br></p>', 32000, 0, 100, '1', 'Pack', 450, 1, '2022-06-25 03:41:22'),
(29, 25, 14, 'KRP-9361567181-003', 'Sambal Goreng Teri', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore illum labore in possimus, neque obcaecati pariatur et deserunt corrupti suscipit nobis fugit ea, excepturi delectus cum blanditiis unde officia asperiores!<br></p>', 120000, 112000, 80, '1', 'Pack', 316, 1, '2022-06-28 09:51:46'),
(30, 19, 15, 'KRP-2580126135-004', 'Pop Corn Aneka Rasa', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore illum labore in possimus, neque obcaecati pariatur et deserunt corrupti suscipit nobis fugit ea, excepturi delectus cum blanditiis unde officia asperiores!<br></p>', 13500, 10000, 210, '1', 'Pack', 80, 1, '2022-06-28 10:15:06'),
(31, 19, 15, 'KRP-0632106326-005', 'Kambose Kapusu', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore illum labore in possimus, neque obcaecati pariatur et deserunt corrupti suscipit nobis fugit ea, excepturi delectus cum blanditiis unde officia asperiores!<br></p>', 15000, 13500, 100, '1', 'Box', 90, 1, '2022-06-28 10:20:08'),
(32, 19, 15, 'KRP-4653268606-006', 'Kasuami', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore illum labore in possimus, neque obcaecati pariatur et deserunt corrupti suscipit nobis fugit ea, excepturi delectus cum blanditiis unde officia asperiores!<br></p>', 6000, 4500, 100, '1', 'Pack', 50, 1, '2022-06-28 10:23:46'),
(33, 18, 10, 'KRP-6628005131-007', 'Bawang Goreng Lande', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore illum labore in possimus, neque obcaecati pariatur et deserunt corrupti suscipit nobis fugit ea, excepturi delectus cum blanditiis unde officia asperiores!<br></p>', 15000, 13750, 230, '1', 'Pack', 210, 1, '2022-06-28 10:26:16'),
(34, 18, 15, 'KRP-1558578380-008', 'Keripik Pisang Aneka Rasa', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore illum labore in possimus, neque obcaecati pariatur et deserunt corrupti suscipit nobis fugit ea, excepturi delectus cum blanditiis unde officia asperiores!<br></p>', 8000, 6500, 200, '1', 'Pack', 80, 1, '2022-06-28 10:28:43'),
(35, 18, 15, 'KRP-3863406633-009', 'Kacang Sembunyi', '<p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;\"><span style=\"margin: 0px; padding: 0px;\">Kacang yg bakal bikin kamu ketagihan dan gak kerasa sudah habis aja dicamilin sambil nonton tv atau ngobrol\" sama keluarga dan teman-teman.</span><span style=\"margin: 0px; padding: 0px; display: block;\"></span><span style=\"margin: 0px; padding: 0px;\">ini dijamin renyah guys...</span></p><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;\"><span style=\"margin: 0px; padding: 0px;\">Bahan-bahan juga berkualitas..</span></p><p style=\"margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding: 0px; font-family: Roboto, -apple-system, BlinkMacSystemFont, &quot;Helvetica Neue&quot;, Helvetica, sans-serif;\"><span style=\"margin: 0px; padding: 0px;\">NB: BARANG YANG SUDAH DIBELI TIDAK DAPAT DIKEMBALIKAN ATAU DIBATALKAN TANPA SYARAT APAPUN . MEMBELI BERARTI SETUJU !</span><span style=\"margin: 0px; padding: 0px; display: block;\"></span><span style=\"margin: 0px; padding: 0px;\">Free Packing Kardus.</span></p>', 30000, 28950, 50, '1', 'KG', 1000, 1, '2022-06-28 10:31:51'),
(36, 17, 15, 'KRP-0867238516-010', 'Roti Bakar Aneka Rasa', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore illum labore in possimus, neque obcaecati pariatur et deserunt corrupti suscipit nobis fugit ea, excepturi delectus cum blanditiis unde officia asperiores!<br></p>', 20000, 18940, 200, '1', 'Box', 450, 1, '2022-06-28 10:35:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_atribut`
--

CREATE TABLE `produk_atribut` (
  `id_produk_atribut` int(11) NOT NULL,
  `kode_produk` varchar(18) NOT NULL,
  `judul_taribut` text NOT NULL,
  `isian_atribut` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk_atribut`
--

INSERT INTO `produk_atribut` (`id_produk_atribut`, `kode_produk`, `judul_taribut`, `isian_atribut`) VALUES
(1, 'KRP-9066886550-002', 'Jenis Masakan', 'Khas Daerah'),
(2, 'KRP-9066886550-002', 'Kondisi Penyimpanan', 'Suhu Ruangan'),
(3, 'KRP-9066886550-002', 'Masa Penyimpanan', '4 Bulan'),
(4, 'KRP-0511177897-001', 'Jenis Masakan', 'Khas Daerah'),
(5, 'KRP-0511177897-001', 'Kondisi Penyimpanan', 'Suhu Ruangan'),
(6, 'KRP-0511177897-001', 'Masa Penyimpanan', '6 Bulan'),
(8, 'KRP-2580126135-004', 'Jenis Masakan', 'Umum'),
(9, 'KRP-2580126135-004', 'Kondisi Penyimpanan', 'Suhu Ruangan'),
(10, 'KRP-2580126135-004', 'Masa Penyimpanan', '3 Minggu'),
(11, 'KRP-0632106326-005', 'Jenis Masakan', 'Khas Daerah'),
(12, 'KRP-0632106326-005', 'Kondisi Penyimpanan', 'Suhu Ruangan'),
(13, 'KRP-0632106326-005', 'Masa Penyimpanan', '3 Hari'),
(14, 'KRP-4653268606-006', 'Jenis Masakan', 'Khas Daerah'),
(15, 'KRP-4653268606-006', 'Kondisi Penyimpanan', 'Suhu Ruangan'),
(16, 'KRP-4653268606-006', 'Masa Penyimpanan', '2 Hari'),
(17, 'KRP-6628005131-007', 'Jenis Masakan', 'Umum'),
(18, 'KRP-6628005131-007', 'Kondisi Penyimpanan', 'Suhu Ruangan'),
(19, 'KRP-6628005131-007', 'Masa Penyimpanan', '2 Bulan'),
(20, 'KRP-1558578380-008', 'Jenis Masakan', 'Umum'),
(21, 'KRP-1558578380-008', 'Kondisi Penyimpanan', 'Suhu Ruangan'),
(22, 'KRP-1558578380-008', 'Masa Penyimpanan', '1 Bulan'),
(23, 'KRP-3863406633-009', 'Jenis Masakan', 'Umum'),
(24, 'KRP-3863406633-009', 'Ruang Penyimpanan', 'Suhu Ruangan'),
(25, 'KRP-3863406633-009', 'Masa Penyimpanan', '6 Minggu'),
(26, 'KRP-0867238516-010', 'Jenis Masakan', 'Umum'),
(27, 'KRP-0867238516-010', 'Kondisi Penyimpanan', 'Suhu Ruangan'),
(28, 'KRP-0867238516-010', 'Masa Penyimpanan', '2 Hari'),
(29, 'KRP-9361567181-003', 'Jenis Masakan', 'Umum'),
(30, 'KRP-9361567181-003', 'Kondisi Penyimpanan', 'Suhu Ruangan'),
(31, 'KRP-9361567181-003', 'Masa Penyimpanan', '1 Bulan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk_variasi`
--

CREATE TABLE `produk_variasi` (
  `id_produk_variasi` int(7) NOT NULL,
  `kode_produk` varchar(18) NOT NULL,
  `size` varchar(35) NOT NULL,
  `warna_rasa` varchar(50) NOT NULL,
  `stok_variasi` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk_variasi`
--

INSERT INTO `produk_variasi` (`id_produk_variasi`, `kode_produk`, `size`, `warna_rasa`, `stok_variasi`) VALUES
(1, 'KRP-9066886550-002', 'none', 'Rasa Sambal Balado', 50),
(2, 'KRP-9066886550-002', 'none', 'Rasa Bawang', 50),
(3, 'KRP-0511177897-001', 'none', 'Rasa Balado', 25),
(4, 'KRP-0511177897-001', 'none', 'Rasa Bawang', 95),
(6, 'KRP-2580126135-004', 'none', 'Keju Manis', 20),
(7, 'KRP-2580126135-004', 'none', 'Barbeque', 30),
(8, 'KRP-2580126135-004', 'none', 'Balado', 30),
(9, 'KRP-2580126135-004', 'none', 'Coklat', 30),
(10, 'KRP-0632106326-005', 'none', 'Rasa Bawang', 40),
(11, 'KRP-0632106326-005', 'none', 'Rasa Pedas', 50),
(12, 'KRP-4653268606-006', 'none', 'Rasa Bawang', 50),
(13, 'KRP-4653268606-006', 'none', 'Rasa Singkong', 50),
(14, 'KRP-6628005131-007', 'none', 'Krispi', 230),
(15, 'KRP-1558578380-008', 'none', 'Rasa Balado', 50),
(16, 'KRP-1558578380-008', 'none', 'Rasa Coklat', 50),
(17, 'KRP-1558578380-008', 'none', 'Rasa Keju Manis', 50),
(18, 'KRP-1558578380-008', 'none', 'Rasa Barbeque', 50),
(19, 'KRP-3863406633-009', 'none', 'Gula Merah', 25),
(20, 'KRP-3863406633-009', 'none', 'Gula Putih', 25),
(21, 'KRP-0867238516-010', 'none', 'Coklat Kacang', 40),
(22, 'KRP-0867238516-010', 'none', 'Coklat Keju', 40),
(23, 'KRP-0867238516-010', 'none', 'Coklat Nanas', 40),
(24, 'KRP-0867238516-010', 'none', 'Nanas Strowbery', 40),
(25, 'KRP-0867238516-010', 'none', 'Kacang Keju', 35),
(26, 'KRP-9361567181-003', 'none', 'Rasa Pedas', 80);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reseler`
--

CREATE TABLE `reseler` (
  `id_reseler` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `nik_reseler` bigint(16) NOT NULL,
  `nm_reseler` varchar(50) NOT NULL,
  `telp_reseler` varchar(15) NOT NULL,
  `email_reseler` varchar(50) NOT NULL,
  `jk_reseler` char(10) NOT NULL,
  `alamat_reseler` text NOT NULL,
  `foto_reseler` text NOT NULL,
  `change_reseler` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `reseler`
--

INSERT INTO `reseler` (`id_reseler`, `id_user`, `nik_reseler`, `nm_reseler`, `telp_reseler`, `email_reseler`, `jk_reseler`, `alamat_reseler`, `foto_reseler`, `change_reseler`) VALUES
(4, 17, 7472923312003, 'Linda Wardana', '08366276378', 'lindapole@gmail.com', 'Perempuan', 'Jln. Panglima Polim, Kel. kaobula Kec. batupoaro, Kota Baubau, Prov. Sulawesi Tenggara', 'default.png', '2022-02-04 23:26:16'),
(5, 18, 7472923312004, 'ANUGRAH HENI', '0938837483994', 'aanvtr@gmail.com', 'Laki-Laki', 'Jln. Pahlawan, Kel. Kadolo Kec. Kadolomoko, Kota Baubau, Prov. Sulawesi Tenggara', 'default.png', '2022-02-04 23:26:16'),
(6, 19, 7472923312005, 'Zakiya Rahim', '082232102611', 'zakiyabawangku@gmail.com', 'Laki-Laki', 'Jln. Hayam Wuruk, Kel. Bone-Bone, Kec. batupoaro, Kota Baubau, Prov. Sulawesi Tenggara', 'default.png', '2022-02-04 23:26:16'),
(7, 25, 747200221122, 'Alboni Maida', '082138213213', 'reseller@gmail.com', 'Laki-Laki', 'Lande', 'ea6b8286831ed9dd9bbea612aec1fa64.jpg', '2022-06-28 05:55:51');

-- --------------------------------------------------------

--
-- Struktur dari tabel `set_web`
--

CREATE TABLE `set_web` (
  `id_web` int(3) NOT NULL,
  `nama_web` text NOT NULL,
  `title_web` varchar(35) NOT NULL,
  `sidebar_title` char(9) NOT NULL,
  `email_web` varchar(50) NOT NULL,
  `telepon_web` varchar(20) NOT NULL,
  `fax_web` varchar(20) NOT NULL,
  `web_kantor` text NOT NULL,
  `alamat_web` text NOT NULL,
  `tentang_aplikasi` text NOT NULL,
  `gambar_about` text NOT NULL,
  `logo_web` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `set_web`
--

INSERT INTO `set_web` (`id_web`, `nama_web`, `title_web`, `sidebar_title`, `email_web`, `telepon_web`, `fax_web`, `web_kantor`, `alamat_web`, `tentang_aplikasi`, `gambar_about`, `logo_web`) VALUES
(1, 'HINDES', 'HINDES', 'HINDES', 'hindes.market@gmail.com', '(0402) 0000-0001', '(0402) 0000-0000', '-', 'Desa Gerak Makmur, Kecamatan Sampolawa, Kabupaten Buton Selatan, Provinsi Sulawesi Tenggara', '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus eos sapiente illum harum voluptatibus dicta eligendi qui nihil culpa cum! Earum exercitationem quidem adipisci praesentium, temporibus sit itaque quisquam reiciendis.<br></p>', 'd91cf77fc6e612e31874131dde38d5f0.jpg', '0828f078170e3c51b5ec8d32b9a1f873.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slider`
--

CREATE TABLE `slider` (
  `id_slider` int(3) NOT NULL,
  `gbr_slider` text NOT NULL,
  `ket_slider` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `slider`
--

INSERT INTO `slider` (`id_slider`, `gbr_slider`, `ket_slider`) VALUES
(1, 'dfc0a42b80bfcd3cfbe3d0a55299f8aa.mp4', 'Slider 1'),
(6, 'b062a2b0ac48afc94126223300006cae.mp4', 'Slider 2'),
(7, '60182fe6326a6e1a1dbbce6c01b78e43.mp4', 'Slider 3'),
(8, '1ab8719c038630bec9d7f11b2cf0a8bc.jpg', 'Slider 4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(5) NOT NULL,
  `reseler` int(5) NOT NULL,
  `nm_toko` varchar(50) NOT NULL,
  `alamat_toko` text NOT NULL,
  `maps_toko` text NOT NULL,
  `email_toko` varchar(25) NOT NULL,
  `telp_toko` varchar(17) NOT NULL,
  `izin_usaha` text NOT NULL,
  `foto_ktp` text NOT NULL,
  `logo_toko` text NOT NULL,
  `status_toko` int(3) NOT NULL,
  `change_toko` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `reseler`, `nm_toko`, `alamat_toko`, `maps_toko`, `email_toko`, `telp_toko`, `izin_usaha`, `foto_ktp`, `logo_toko`, `status_toko`, `change_toko`) VALUES
(4, 17, 'UMKM Dusun Lande IV', 'Desa Lande, Kecamatan Sampolawa, Kabupaten Buton Selatan, Provinsi Sulawesi Tenggara', '-5.1511296,119.4524672', 'ksjad@gmail.com', '082232102611', 'default.png', 'default.png', 'default_toko.png', 1, '2022-02-04 23:26:16'),
(5, 18, 'UMKM Dusun Lande III', 'Desa Lande, Kecamatan Sampolawa, Kabupaten Buton Selatan, Provinsi Sulawesi Tenggara', '-5.1511296,119.4524672', 'ksjad@gmail.com', '082232102611', 'default.png', 'default.png', 'default_toko.png', 1, '2022-02-04 23:26:16'),
(6, 19, 'UMKM Dusun Lande II', 'Desa Lande, Kecamatan Sampolawa, Kabupaten Buton Selatan, Provinsi Sulawesi Tenggara', '-5.1511296,119.4524672', 'ksjad@gmail.com', '082232102611', 'default.png', 'default.png', 'default_toko.png', 1, '2022-02-04 23:26:16'),
(7, 25, 'UMKM Dusun Lande I', 'Desa Lande, Kecamatan Sampolawa, Kabupaten Buton Selatan, Provinsi Sulawesi Tenggara', '-5.483351611030401, 122.5781204183574', 'umkmlande1@gmail.com', '0182018208120', '7820b82381537a06ecbfdbb1773df30d.jpg', '40a3cd9518838e525a31750062524599.jpeg', 'default_toko.png', 1, '2022-06-28 08:00:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(5) NOT NULL,
  `costumer` int(5) NOT NULL,
  `alamat_costumer` int(3) NOT NULL,
  `reseler` int(5) NOT NULL,
  `invoice` varchar(18) NOT NULL,
  `kode_barang` varchar(18) NOT NULL,
  `harga_barang` bigint(15) NOT NULL,
  `nm_barang` text NOT NULL,
  `jumlah_beli` int(5) NOT NULL,
  `variasi_produk` int(5) NOT NULL,
  `total_beban` bigint(15) NOT NULL,
  `total_pengiriman` bigint(15) NOT NULL,
  `total_transaksi` bigint(15) NOT NULL,
  `jenis_pembayaran` int(3) NOT NULL,
  `status_transaksi` int(3) NOT NULL,
  `status_pengemasan` int(2) NOT NULL,
  `jasa_pengiriman` int(3) NOT NULL,
  `kurir` int(3) NOT NULL,
  `terima_barang` int(3) NOT NULL,
  `penyerahan_barang` int(3) NOT NULL,
  `bukti_penyerahan` text NOT NULL,
  `bukti_terima` text NOT NULL,
  `change_transaksi` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `costumer`, `alamat_costumer`, `reseler`, `invoice`, `kode_barang`, `harga_barang`, `nm_barang`, `jumlah_beli`, `variasi_produk`, `total_beban`, `total_pengiriman`, `total_transaksi`, `jenis_pembayaran`, `status_transaksi`, `status_pengemasan`, `jasa_pengiriman`, `kurir`, `terima_barang`, `penyerahan_barang`, `bukti_penyerahan`, `bukti_terima`, `change_transaksi`) VALUES
(46, 10, 1, 25, 'YW4MgcjOQG8iYGyNeD', 'KRP-9066886550-002', 32000, 'Ikan Kayu', 9, 2, 1750, 32500, 635500, 1, 4, 1, 1, 26, 1, 1, '9f467d72b4c551eb1ba6759d5457d380.PNG', '25fcd3868158bd89ad05f2369c63d952.jpg', '2022-06-27 15:18:56'),
(47, 10, 1, 25, 'YW4MgcjOQG8iYGyNeD', 'KRP-0511177897-001', 35000, 'Abon Lande Aneka Rasa', 2, 3, 1750, 32500, 635500, 1, 4, 1, 1, 26, 1, 1, '9f467d72b4c551eb1ba6759d5457d380.PNG', '25fcd3868158bd89ad05f2369c63d952.jpg', '2022-06-27 15:18:56'),
(48, 10, 1, 25, 'YW4MgcjOQG8iYGyNeD', 'KRP-0511177897-001', 35000, 'Abon Lande Aneka Rasa', 7, 4, 1750, 32500, 635500, 1, 4, 1, 1, 26, 1, 1, '9f467d72b4c551eb1ba6759d5457d380.PNG', '25fcd3868158bd89ad05f2369c63d952.jpg', '2022-06-27 15:18:56'),
(49, 10, 1, 25, 'dvAbzlODo6Bs0b25k0', 'KRP-0511177897-001', 35000, 'Abon Lande Aneka Rasa', 2, 4, 650, 21500, 91500, 2, 2, 1, 1, 26, 0, 0, 'none', 'none', '2022-06-29 13:27:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_pembayaran`
--

CREATE TABLE `transaksi_pembayaran` (
  `id_pembayaran` int(5) NOT NULL,
  `costumer` int(5) NOT NULL,
  `invoice` varchar(18) NOT NULL,
  `bank_transfer` int(3) NOT NULL,
  `bukti_pembayaran` text NOT NULL,
  `change_pembayaran` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_pembayaran`
--

INSERT INTO `transaksi_pembayaran` (`id_pembayaran`, `costumer`, `invoice`, `bank_transfer`, `bukti_pembayaran`, `change_pembayaran`) VALUES
(15, 10, 'YW4MgcjOQG8iYGyNeD', 0, 'none', '2022-06-27 15:18:56'),
(16, 10, 'dvAbzlODo6Bs0b25k0', 4, '7f4b07de581bac4517e34d7d5718c185.jpg', '2022-06-29 13:27:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_to`
--

CREATE TABLE `transaksi_to` (
  `id_transaksi_to` int(5) NOT NULL,
  `costumer` int(5) NOT NULL,
  `invoice` varchar(18) NOT NULL,
  `status_to` int(3) NOT NULL,
  `change_to` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_to`
--

INSERT INTO `transaksi_to` (`id_transaksi_to`, `costumer`, `invoice`, `status_to`, `change_to`) VALUES
(1, 10, 'YW4MgcjOQG8iYGyNeD', 0, '2022-06-27 15:18:56'),
(2, 10, 'YW4MgcjOQG8iYGyNeD', 1, '2022-06-27 20:45:17'),
(3, 10, 'YW4MgcjOQG8iYGyNeD', 2, '2022-06-28 08:11:11'),
(4, 10, 'YW4MgcjOQG8iYGyNeD', 3, '2022-06-28 08:44:17'),
(5, 10, 'YW4MgcjOQG8iYGyNeD', 4, '2022-06-28 08:55:39'),
(6, 10, 'dvAbzlODo6Bs0b25k0', 0, '2022-06-29 13:27:24'),
(7, 10, 'dvAbzlODo6Bs0b25k0', 1, '2022-06-29 13:33:03'),
(8, 10, 'dvAbzlODo6Bs0b25k0', 2, '2022-06-29 19:20:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `akses` int(3) NOT NULL,
  `sts_akun` int(5) NOT NULL,
  `change_user` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `akses`, `sts_akun`, `change_user`) VALUES
(1, 'admin', '$2y$10$ouFjrVVGDHxvip.JC.YQNuggso2x8EbsVuBHwNsz.rdJsjEFkLsqC', 1, 1, '2022-02-13 17:58:35'),
(3, 'renata', '$2y$10$mBPfSuwJH0rzSOmDbwYU2Ohe5ZmFvzBadfHXWYCRJEhL87wQusb3m', 1, 1, '2021-11-12 15:44:47'),
(8, 'kurir1', '$2y$10$ePWi.Xd73dD.XcJmDBlY4OB34m9vhcKMWWpOSWf1jd6r1f0oj6H8W', 4, 1, '2021-11-30 19:38:48'),
(10, 'example', '$2y$10$sIrw.SuveMlv6iO5SMpc5OOjM0irEzfU6Nbbvk83AgyM//mWgQx1e', 3, 1, '2021-11-30 17:56:52'),
(12, 'test', '$2y$10$H2Qi/IoribU6xF0t5df7g.fBLEByprAjd5YKCe7pmwHHb2nHrEX4G', 3, 1, '2021-12-01 17:10:45'),
(14, 'urian', '$2y$10$RFMA/ferDZgZYY.cJ1LpQ.qg1ScxV/qxcWWLJX4cxdFYFlrtW826q', 3, 1, '2021-12-02 22:14:58'),
(17, 'reseler4', '$2y$10$5atbbcmatIH127KV9LesCewuer2cIt7I6InhmDLLjITyPDmOWR98O', 2, 1, '2022-02-04 23:26:16'),
(18, 'reseler3', '$2y$10$5atbbcmatIH127KV9LesCewuer2cIt7I6InhmDLLjITyPDmOWR98O', 2, 1, '2022-02-04 23:26:16'),
(19, 'reseler2', '$2y$10$5atbbcmatIH127KV9LesCewuer2cIt7I6InhmDLLjITyPDmOWR98O', 2, 1, '2022-02-04 23:26:16'),
(25, 'reseler1', '$2y$10$5atbbcmatIH127KV9LesCewuer2cIt7I6InhmDLLjITyPDmOWR98O', 2, 1, '2022-02-12 15:13:08'),
(26, 'kurir2', '$2y$10$4mleGqHqlkgmNeDrpfsElOCmdmdk0ElTN9gBpg2twbMLZ6G48vWyy', 4, 1, '2022-02-13 17:33:31'),
(28, 'nani', '$2y$10$ifZKpDr.4sJs0iL7KRxMNOren3jEeawet/cP3Y50yjLG8Zt2JskGm', 3, 0, '2022-06-25 11:18:30'),
(29, 'wahid', '$2y$10$byOp6f4/EvbXZeGrY0e21.wDHBqzLQ7Yi2nONt9NiHFjZ9oPudMRi', 3, 1, '2022-06-19 10:54:10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `alamat_costumer`
--
ALTER TABLE `alamat_costumer`
  ADD PRIMARY KEY (`id_alamat`);

--
-- Indeks untuk tabel `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id_bank`);

--
-- Indeks untuk tabel `costumer`
--
ALTER TABLE `costumer`
  ADD PRIMARY KEY (`id_costumer`);

--
-- Indeks untuk tabel `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indeks untuk tabel `gambar_produk`
--
ALTER TABLE `gambar_produk`
  ADD PRIMARY KEY (`id_gambar_produk`);

--
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori_produk`);

--
-- Indeks untuk tabel `kebijakan`
--
ALTER TABLE `kebijakan`
  ADD PRIMARY KEY (`id_kebijakan`);

--
-- Indeks untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id_kecamatan`);

--
-- Indeks untuk tabel `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id_kelurahan`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indeks untuk tabel `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `ongkir_jasa`
--
ALTER TABLE `ongkir_jasa`
  ADD PRIMARY KEY (`id_ongkir_jasa`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `produk_atribut`
--
ALTER TABLE `produk_atribut`
  ADD PRIMARY KEY (`id_produk_atribut`);

--
-- Indeks untuk tabel `produk_variasi`
--
ALTER TABLE `produk_variasi`
  ADD PRIMARY KEY (`id_produk_variasi`);

--
-- Indeks untuk tabel `reseler`
--
ALTER TABLE `reseler`
  ADD PRIMARY KEY (`id_reseler`);

--
-- Indeks untuk tabel `set_web`
--
ALTER TABLE `set_web`
  ADD PRIMARY KEY (`id_web`);

--
-- Indeks untuk tabel `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id_slider`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `transaksi_to`
--
ALTER TABLE `transaksi_to`
  ADD PRIMARY KEY (`id_transaksi_to`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `alamat_costumer`
--
ALTER TABLE `alamat_costumer`
  MODIFY `id_alamat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `bank`
--
ALTER TABLE `bank`
  MODIFY `id_bank` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `costumer`
--
ALTER TABLE `costumer`
  MODIFY `id_costumer` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id_diskon` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `gambar_produk`
--
ALTER TABLE `gambar_produk`
  MODIFY `id_gambar_produk` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  MODIFY `id_kategori_produk` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `kebijakan`
--
ALTER TABLE `kebijakan`
  MODIFY `id_kebijakan` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id_kecamatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id_kelurahan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=214;

--
-- AUTO_INCREMENT untuk tabel `ongkir_jasa`
--
ALTER TABLE `ongkir_jasa`
  MODIFY `id_ongkir_jasa` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `produk_atribut`
--
ALTER TABLE `produk_atribut`
  MODIFY `id_produk_atribut` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `produk_variasi`
--
ALTER TABLE `produk_variasi`
  MODIFY `id_produk_variasi` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `reseler`
--
ALTER TABLE `reseler`
  MODIFY `id_reseler` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `set_web`
--
ALTER TABLE `set_web`
  MODIFY `id_web` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `slider`
--
ALTER TABLE `slider`
  MODIFY `id_slider` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `transaksi_pembayaran`
--
ALTER TABLE `transaksi_pembayaran`
  MODIFY `id_pembayaran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `transaksi_to`
--
ALTER TABLE `transaksi_to`
  MODIFY `id_transaksi_to` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
