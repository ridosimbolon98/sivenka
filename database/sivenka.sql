-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Feb 2023 pada 02.17
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sivenka`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bisnis_unit`
--

CREATE TABLE `bisnis_unit` (
  `kode` varchar(30) NOT NULL,
  `deskripsi` varchar(150) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fax` varchar(30) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `hp` varchar(20) NOT NULL,
  `input_by` varchar(50) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_update` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bisnis_unit`
--

INSERT INTO `bisnis_unit` (`kode`, `deskripsi`, `alamat`, `email`, `fax`, `no_telp`, `hp`, `input_by`, `tgl_input`, `tgl_update`, `status`) VALUES
('JBM01', 'PT. JAYA ABADI MAKMUR', 'JL. Semarang Demak KM.2 No.1, Kota Semarang', 'corporate@jayaabadi.co.id', '0240812349', '0240812349', '085231659785', 'ADMIN1', '2023-01-23 07:54:23', '2023-01-23 08:52:05', 1),
('JBMRTL', 'PT. JAYA ABADI RETAIL YOGYA', '', 'corporate@jayaabadi.co.id', '0240812349', '0240812349', '085231659785', 'ADMIN1', '2023-01-23 07:54:58', '2023-01-23 08:54:26', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('kvof8phkqanjojq4qfitpn8u4ggheltu', '127.0.0.1', 1674113374, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343131333239353b),
('jjm83kbqv920jqntqqck5fc34q8mamq4', '127.0.0.1', 1674113432, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343131333338353b),
('fse7jikebd29aognvo4cagjtmrir45bg', '127.0.0.1', 1674113446, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343131333433363b757365726e616d657c733a363a2241444d494e31223b726f6c657c733a353a2241444d494e223b69647c733a383a2230373a32363a3332223b7374617475737c733a363a226c6f67676564223b),
('r4cs74n1g8a4qkabtm3omi1qg3nbho0m', '127.0.0.1', 1674113994, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343131333934393b),
('i9ifujbrqg1h5uhqikipj461p94aputh', '127.0.0.1', 1674114102, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343131333939383b),
('aaoesjpb5h1ak7hkgg9svlrqs349jqi2', '127.0.0.1', 1674119686, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343131393638363b757365726e616d657c733a363a2241444d494e31223b726f6c657c733a353a2241444d494e223b69647c733a383a2230373a32363a3332223b7374617475737c733a363a226c6f67676564223b),
('gah1o8f4ou4otcfa4tqhdvpkddj95l6o', '127.0.0.1', 1674183151, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343138323933333b),
('kgcjaa6pd1s3qhker7knvf1ta8pn1dlt', '127.0.0.1', 1674183316, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343138333135363b),
('v4c4kt9rjpm2rmbsqh41bgkcm8bbp5f3', '127.0.0.1', 1674183863, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343138333836313b757365726e616d657c733a363a2241444d494e31223b726f6c657c733a353a2241444d494e223b69647c733a383a2230373a32363a3332223b7374617475737c733a363a226c6f67676564223b),
('8nfk810qccebdb8nsgeaaen9c95dek36', '127.0.0.1', 1674183871, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343138333836383b),
('a7944cs397cg2v4q4dg87pgoc8su8pj4', '127.0.0.1', 1674184330, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343138343332393b757365726e616d657c733a363a2241444d494e31223b726f6c657c733a353a2241444d494e223b69647c733a383a2230373a32363a3332223b7374617475737c733a363a226c6f67676564223b),
('oji2hgttc0aea12dva14fdnrc8d8on44', '127.0.0.1', 1674208478, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343230383237363b757365726e616d657c733a363a2241444d494e31223b726f6c657c733a353a2241444d494e223b69647c733a383a2230373a32363a3332223b7374617475737c733a363a226c6f67676564223b737563636573737c733a36333a22426572686173696c2070726f7365732070656d6261796172616e2064656e67616e206e6f6d6f7220696e766f6963653a20494e56313637343230383437382e223b5f5f63695f766172737c613a313a7b733a373a2273756363657373223b733a333a226f6c64223b7d),
('4cgi9korks88tqkuj0b7u626fgi1ras4', '127.0.0.1', 1674272698, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343237323632373b757365726e616d657c733a363a2241444d494e31223b726f6c657c733a353a2241444d494e223b69647c733a383a2230373a32363a3332223b7374617475737c733a363a226c6f67676564223b),
('3ep1peah222711kqjgoo50erb158trum', '127.0.0.1', 1674458385, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343435383338353b),
('8jj9rjramde939m2soru62gtjmelc08q', '127.0.0.1', 1674458665, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343435383338393b757365726e616d657c733a363a2241444d494e31223b726f6c657c733a353a2241444d494e223b69647c733a383a2230373a32363a3332223b7374617475737c733a363a226c6f67676564223b),
('tamd8vgv3b30ivi1j7mnid1dicb61s5q', '127.0.0.1', 1674459401, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343435393430303b757365726e616d657c733a363a2241444d494e31223b726f6c657c733a353a2241444d494e223b69647c733a383a2230373a32363a3332223b7374617475737c733a363a226c6f67676564223b),
('upabkftt78ch1ms3r7h6hvbgrl86a0co', '127.0.0.1', 1674466938, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343436363835363b757365726e616d657c733a363a2241444d494e31223b726f6c657c733a353a2241444d494e223b69647c733a383a2230373a32363a3332223b7374617475737c733a363a226c6f67676564223b),
('hd51502ea657i64gpgeofppip8sb8ldt', '127.0.0.1', 1674553608, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343535333438393b757365726e616d657c733a363a2241444d494e31223b726f6c657c733a353a2241444d494e223b69647c733a31343a226232643769353372373739616664223b7374617475737c733a363a226c6f67676564223b),
('ojp3be1r4smt30cfguf1g0se169ic7q5', '127.0.0.1', 1674610968, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343631303936383b),
('mdo6moc3f7naf5gqa82n66hvhbn3mbho', '127.0.0.1', 1674629613, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637343632393438323b757365726e616d657c733a363a2241444d494e31223b726f6c657c733a353a2241444d494e223b69647c733a31343a226232643769353372373739616664223b7374617475737c733a363a226c6f67676564223b),
('h49db41bcckm1q1m4f176h0sufrd73em', '127.0.0.1', 1675157002, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637353135363938303b757365726e616d657c733a363a2241444d494e31223b726f6c657c733a353a2241444d494e223b69647c733a31343a226232643769353372373739616664223b7374617475737c733a363a226c6f67676564223b),
('1dkokcerrv4skkfrcgu6r644mvatjvcf', '192.168.10.30', 1675158671, 0x5f5f63695f6c6173745f726567656e65726174657c693a313637353135383637313b);

-- --------------------------------------------------------

--
-- Struktur dari tabel `invoice`
--

CREATE TABLE `invoice` (
  `id_invoice` varchar(50) NOT NULL,
  `invoice` varchar(50) NOT NULL,
  `jml_bayar` bigint(100) NOT NULL,
  `jml_kembalian` bigint(100) NOT NULL,
  `id_kasir` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `periode` varchar(7) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `invoice`
--

INSERT INTO `invoice` (`id_invoice`, `invoice`, `jml_bayar`, `jml_kembalian`, `id_kasir`, `status`, `periode`, `tgl_input`) VALUES
('1674208295', 'INV1674208295', 560000, 0, 'ADMIN1', 'LUNAS', '2023-01', '2023-01-20 09:01:35'),
('1674208478', 'INV1674208478', 840000, 67600, 'ADMIN1', 'LUNAS', '2023-01', '2023-01-20 09:01:38'),
('1674272070', 'INV1674272070', 910000, 189900, 'ADMIN1', 'LUNAS', '2023-01', '2023-01-21 03:01:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_produk`
--

CREATE TABLE `kategori_produk` (
  `id_kategori` varchar(50) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_update` datetime NOT NULL,
  `input_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori_produk`
--

INSERT INTO `kategori_produk` (`id_kategori`, `deskripsi`, `status`, `tgl_input`, `tgl_update`, `input_by`) VALUES
('1674119349', 'KESEHATAN', 1, '2023-01-19 09:01:09', '2023-01-24 16:01:32', 'ADMIN1'),
('1674119361', 'PERALATAN DAPUR', 1, '2023-01-19 09:01:21', '2023-01-19 16:01:21', 'ADMIN1'),
('1674119370', 'MAKANAN', 1, '2023-01-19 09:01:30', '2023-01-19 16:01:30', 'ADMIN1'),
('1674119376', 'ATK', 1, '2023-01-19 09:01:36', '2023-01-19 16:01:36', 'ADMIN1'),
('1674119390', 'ELEKTRONIK', 1, '2023-01-19 09:01:50', '2023-01-19 16:01:50', 'ADMIN1'),
('1674119397', 'FASHION', 1, '2023-01-19 09:01:57', '2023-01-19 16:01:57', 'ADMIN1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` varchar(30) NOT NULL,
  `kd_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(500) NOT NULL,
  `harga_modal` bigint(100) NOT NULL,
  `harga_jual` bigint(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `subtotal` bigint(100) NOT NULL,
  `input_by` varchar(50) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `selesai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `merk_produk`
--

CREATE TABLE `merk_produk` (
  `id_merk` varchar(50) NOT NULL,
  `deskripsi` varchar(150) NOT NULL,
  `input_by` varchar(50) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `merk_produk`
--

INSERT INTO `merk_produk` (`id_merk`, `deskripsi`, `input_by`, `tgl_input`, `tgl_update`) VALUES
('1674119234', 'MITOCIBA', 'ADMIN1', '2023-01-19 09:01:14', '2023-01-24 16:01:31'),
('1674119283', 'COSMOS', 'ADMIN1', '2023-01-19 09:01:03', '2023-01-19 16:01:03'),
('1674119290', 'TUPPERWARE', 'ADMIN1', '2023-01-19 09:01:10', '2023-01-19 16:01:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `outlet`
--

CREATE TABLE `outlet` (
  `id` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `tentang` varchar(500) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fax` varchar(15) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `input_by` varchar(50) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_by` varchar(50) NOT NULL,
  `tgl_update` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `outlet`
--

INSERT INTO `outlet` (`id`, `nama`, `tentang`, `alamat`, `email`, `fax`, `no_telp`, `no_hp`, `input_by`, `tgl_input`, `update_by`, `tgl_update`, `status`) VALUES
(1, 'CV. JAYA ABADI MAKMUR', 'JL. Semarang Timur No.23, Kota Semarang', 'Perusahaan Penanaman Modal Dalam Negeri yang berdiri pada tahun 2016', 'corporate@jayabadi.co.id', '0240812349', '0240812349', '085213649587', 'ADMIN1', '2023-01-23 03:28:34', 'ADMIN1', '2023-01-24 10:01:55', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id` int(10) NOT NULL,
  `periode` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id`, `periode`) VALUES
(1, '2023-01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `kode_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(200) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `kategori_produk` varchar(50) NOT NULL,
  `satuan_jual` varchar(30) NOT NULL,
  `harga_beli` bigint(100) NOT NULL,
  `harga_jual` bigint(100) NOT NULL,
  `suplier` varchar(50) NOT NULL,
  `input_by` varchar(50) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_update` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `merk`, `kategori_produk`, `satuan_jual`, `harga_beli`, `harga_jual`, `suplier`, `input_by`, `tgl_input`, `tgl_update`, `status`) VALUES
('1674186962', 'Panci Portable Mini', '1674119283', '1674119361', 'UNIT', 255000, 380000, 'SPL1674119135', 'ADMIN1', '2023-01-20 03:01:02', '2023-01-24 14:01:54', 0),
('1674271524', 'Blender Portable', '1674119234', '1674119361', 'UNIT', 230000, 350000, 'SPL1674119045', 'ADMIN1', '2023-01-21 03:01:24', '2023-01-21 10:01:24', 1),
('1675150238', 'Penanak Nasi', '1674119283', '1674119361', 'UNIT', 355000, 450000, 'SPL1674119135', 'ADMIN1', '2023-02-01 07:31:40', '2023-02-01 14:31:40', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_produk`
--

CREATE TABLE `satuan_produk` (
  `id_satuan` varchar(50) NOT NULL,
  `nama_satuan` varchar(150) NOT NULL,
  `keterangan` varchar(150) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `satuan_produk`
--

INSERT INTO `satuan_produk` (`id_satuan`, `nama_satuan`, `keterangan`, `tgl_input`) VALUES
('1', 'KG', 'KILOGRAM', '2023-01-20 03:51:21'),
('2', 'LTR', 'LITER', '2023-01-20 03:51:21'),
('3', 'TON', 'TON', '2023-01-20 03:51:21'),
('4', 'UNIT', 'UNIT', '2023-01-20 03:51:21'),
('5', 'PACK', 'PACK', '2023-01-20 03:51:21'),
('6', 'SAK', 'SAK', '2023-01-20 03:51:21'),
('7', 'LBR', 'LEMBAR', '2023-01-20 03:51:21'),
('8', 'PCS', 'PCS', '2023-01-20 03:51:21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_produk`
--

CREATE TABLE `stok_produk` (
  `id` varchar(30) NOT NULL,
  `kode_produk` varchar(50) NOT NULL,
  `jml_stock` bigint(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stok_produk`
--

INSERT INTO `stok_produk` (`id`, `kode_produk`, `jml_stock`) VALUES
('1', '1674186962', 84),
('1674271837', '1674271524', 22),
('1675150261', '1675150238', 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `suplier`
--

CREATE TABLE `suplier` (
  `id_suplier` varchar(50) NOT NULL,
  `nama_suplier` varchar(150) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `input_by` varchar(50) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_update` datetime NOT NULL,
  `status_suplier` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `suplier`
--

INSERT INTO `suplier` (`id_suplier`, `nama_suplier`, `alamat`, `no_telp`, `email`, `no_hp`, `input_by`, `tgl_input`, `tgl_update`, `status_suplier`) VALUES
('SPL1674119045', 'CV. MAJU BERSAMA GEMILANG', 'JL. Raya Semarang - Demak KM. 10', '0240128945', 'corporate@majubersama.co.id', '081234567890', 'ADMIN1', '2023-01-19 09:01:05', '2023-01-24 16:01:34', 1),
('SPL1674119135', 'PT. ABADI SEJAHTERA', 'JL. Mulawarman Timur IV no.1', '0210781292', 'abadisejartera@gmail.com', '085312348756', 'ADMIN1', '2023-01-19 09:01:35', '2023-01-24 16:01:43', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_trans` varchar(30) NOT NULL,
  `invoice` varchar(30) NOT NULL,
  `kd_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(500) NOT NULL,
  `harga_modal` bigint(100) NOT NULL,
  `harga_jual` bigint(100) NOT NULL,
  `jumlah` int(100) NOT NULL,
  `subtotal` bigint(100) NOT NULL,
  `periode_trans` varchar(7) NOT NULL,
  `input_by` varchar(50) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_trans`, `invoice`, `kd_produk`, `nama_produk`, `harga_modal`, `harga_jual`, `jumlah`, `subtotal`, `periode_trans`, `input_by`, `tgl_input`) VALUES
('TRX1674208295', 'INV1674208295', '1674186962', 'Panci Portable', 235000, 280000, 2, 560000, '2023-01', 'ADMIN1', '2023-01-20 09:01:00'),
('TRX1674208478', 'INV1674208478', '1674186962', 'Panci Portable', 235000, 280000, 3, 840000, '2023-01', 'ADMIN1', '2023-01-20 09:01:31'),
('TRX16742720700', 'INV1674272070', '1674186962', 'Panci Portable', 235000, 280000, 2, 560000, '2023-01', 'ADMIN1', '2023-01-21 03:01:04'),
('TRX16742720701', 'INV1674272070', '1674271524', 'Blender Portable', 230000, 350000, 1, 350000, '2023-01', 'ADMIN1', '2023-01-21 03:01:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `trans_stok`
--

CREATE TABLE `trans_stok` (
  `id_ts` varchar(50) NOT NULL,
  `kode_produk` varchar(50) NOT NULL,
  `suplier` varchar(50) NOT NULL,
  `jml_stok` bigint(12) NOT NULL,
  `tipe_trans` varchar(50) NOT NULL,
  `no_faktur` varchar(150) NOT NULL,
  `input_by` varchar(50) NOT NULL,
  `tgl_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `tgl_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `trans_stok`
--

INSERT INTO `trans_stok` (`id_ts`, `kode_produk`, `suplier`, `jml_stok`, `tipe_trans`, `no_faktur`, `input_by`, `tgl_input`, `tgl_update`) VALUES
('TS1674193923', '1674186962', 'SPL1674119135', 25, 'MASUK', 'FC1294234', 'ADMIN1', '2023-01-20 05:01:03', '2023-01-20 12:01:03'),
('TS1674194958', '1674186962', 'SPL1674119135', 42, 'MASUK', 'FC1294673', 'ADMIN1', '2023-01-20 06:01:18', '2023-01-20 13:01:18'),
('TS1674271837', '1674271524', 'SPL1674119045', 25, 'MASUK', 'FC1292654', 'ADMIN1', '2023-01-21 03:01:37', '2023-01-21 10:01:37'),
('TS1675150261', '1675150238', 'SPL1674119135', 20, 'MASUK', 'FC1295678', 'ADMIN1', '2023-01-31 07:01:01', '2023-01-31 14:01:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_by` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
('63ce54187138d', 'KASIR', 'e10adc3949ba59abbe56e057f20f883e', 'KASIR', 1, 'ADMIN1', '2023-01-23 09:01:08', '2023-01-23 09:01:08'),
('b2d7i53r779afd', 'ADMIN1', 'e10adc3949ba59abbe56e057f20f883e', 'ADMIN', 1, 'ADMIN1', '2023-01-19 07:26:32', '2023-01-19 07:24:49');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bisnis_unit`
--
ALTER TABLE `bisnis_unit`
  ADD PRIMARY KEY (`kode`);

--
-- Indeks untuk tabel `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indeks untuk tabel `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_invoice`),
  ADD UNIQUE KEY `invoice` (`invoice`);

--
-- Indeks untuk tabel `kategori_produk`
--
ALTER TABLE `kategori_produk`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indeks untuk tabel `merk_produk`
--
ALTER TABLE `merk_produk`
  ADD PRIMARY KEY (`id_merk`);

--
-- Indeks untuk tabel `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`);

--
-- Indeks untuk tabel `satuan_produk`
--
ALTER TABLE `satuan_produk`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `stok_produk`
--
ALTER TABLE `stok_produk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indeks untuk tabel `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_trans`);

--
-- Indeks untuk tabel `trans_stok`
--
ALTER TABLE `trans_stok`
  ADD PRIMARY KEY (`id_ts`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `outlet`
--
ALTER TABLE `outlet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
