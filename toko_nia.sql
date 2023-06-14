-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2021 at 03:04 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_nia`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `jenis_kelamin` varchar(250) NOT NULL,
  `telepon` varchar(250) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama`, `jenis_kelamin`, `telepon`, `alamat`) VALUES
(1, 'admin', 'admin', 'Administrator', 'Laki-Laki', '0885164846416', 'Kuningan');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(250) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `id_kategori`, `nama`, `harga`, `gambar`, `keterangan`, `tanggal`, `stok`) VALUES
(5, 4, 'Pepsodent 75 gram', 4000, 'image/barang/1626828517.jpg', '-', '2021-07-21 07:48:36', 100),
(6, 4, 'Pop Mie Besar', 3700, 'image/barang/1626828644.jpg', '-', '2021-07-21 07:50:44', 100),
(7, 4, 'Minyak Goreng Sedap', 29000, 'image/barang/1626828670.jpg', '-', '2021-07-21 07:51:10', 100),
(8, 4, 'Pocari Sweet Kecil', 6500, 'image/barang/1626828698.jpg', '-', '2021-07-21 07:51:37', 100),
(9, 4, 'Pocari Sweet Besar', 7000, 'image/barang/1626828725.jpg', '-', '2021-07-21 07:52:05', 99),
(10, 4, 'Susu SGM All Varian', 20000, 'image/barang/1626828764.jpg', '-', '2021-07-21 07:52:44', 998),
(11, 4, 'Gula Merah 1Kg', 13000, 'image/barang/1634580824.jpg', '9', '2021-07-21 07:53:21', 25),
(12, 4, 'Proclin 230ml', 8500, 'image/barang/1626828833.jpg', '-', '2021-07-21 07:53:53', 9);

-- --------------------------------------------------------

--
-- Stand-in structure for view `gethargatotal`
--
CREATE TABLE `gethargatotal` (
`Total` decimal(42,0)
,`id_pesanan` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama`) VALUES
(2, 'Beras'),
(3, 'Kentang'),
(4, 'Bahan Pokok');

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `id_kurir` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `jenis_kelamin` varchar(250) NOT NULL,
  `telepon` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`id_kurir`, `username`, `nama`, `password`, `jenis_kelamin`, `telepon`, `status`) VALUES
(3, 'kurir1', 'Ujang', '123', 'Laki-Laki', '092', 'Kosong');

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `kecamatan` varchar(250) NOT NULL,
  `ongkir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `kecamatan`, `ongkir`) VALUES
(1, 'Kuningan', 10000),
(3, 'Kadugede', 12000),
(4, 'Cilimus', 15000),
(5, 'Ciberem', 20000);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_rekening` int(11) DEFAULT NULL,
  `id_admin` int(11) DEFAULT NULL,
  `id_kurir` int(11) DEFAULT NULL,
  `tipe_pembayaran` enum('tunai','transfer') NOT NULL,
  `foto_transfer` varchar(250) DEFAULT NULL,
  `status` enum('sudah','belum','COD') NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_harga` int(11) NOT NULL,
  `total_dibayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pesanan`, `id_rekening`, `id_admin`, `id_kurir`, `tipe_pembayaran`, `foto_transfer`, `status`, `tanggal`, `total_harga`, `total_dibayar`) VALUES
(26, 28, 3, 1, NULL, 'transfer', 'image/pembayaran/pembayaran_1634735449.png', 'sudah', '2021-10-20 20:10:44', 30000, 30000),
(28, 30, NULL, 1, NULL, 'tunai', NULL, 'COD', '2021-10-20 20:25:46', 23000, 0),
(29, 31, 3, 1, NULL, 'transfer', 'image/pembayaran/pembayaran_1634737734.jpeg', 'sudah', '2021-10-20 20:48:32', 18500, 18500),
(30, 32, NULL, 1, NULL, 'tunai', NULL, 'COD', '2021-10-20 21:17:17', 33000, 0),
(31, 33, 3, 1, NULL, 'transfer', 'image/pembayaran/pembayaran_1634739961.jpeg', 'sudah', '2021-10-20 21:25:46', 17000, 17000);

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `jenis_kelamin` varchar(250) NOT NULL,
  `telepon` varchar(250) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `username`, `password`, `nama`, `jenis_kelamin`, `telepon`, `alamat`) VALUES
(7, 'opa', '123', 'opa', 'Laki-Laki', '089723445633', 'Kuningan'),
(8, 'eman', 'eman', 'eman', 'Laki-Laki', '085789907765', 'Kuningan'),
(9, 'udin', 'udin', 'udin', 'Laki-Laki', '089623477637', 'kuningan');

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `id_pemilik` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `jenis_kelamin` varchar(250) NOT NULL,
  `telepon` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`id_pemilik`, `nama`, `username`, `password`, `jenis_kelamin`, `telepon`) VALUES
(1, 'Owner Toko', 'pemilik', 'pemilik', 'Laki-Laki', '52352'),
(3, '41444', '414', '123', 'Laki-Laki', '414');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_kurir` int(11) DEFAULT NULL,
  `id_ongkir` int(11) DEFAULT NULL,
  `status` enum('pesan','proses','menunggu','dikirim','diterima','bayar') NOT NULL,
  `alamat` text,
  `kecamatan` varchar(250) DEFAULT NULL,
  `ongkir` int(11) DEFAULT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_pembeli`, `id_kurir`, `id_ongkir`, `status`, `alamat`, `kecamatan`, `ongkir`, `tanggal`) VALUES
(28, 8, 3, 1, 'diterima', 'kuningan', 'Kuningan', 10000, '2021-10-20 20:10:37'),
(30, 7, 3, 1, 'diterima', 'kuningan', 'Kuningan', 10000, '2021-10-20 20:25:37'),
(31, 9, 3, 1, 'dikirim', 'kuningan', 'Kuningan', 10000, '2021-10-20 20:48:13'),
(32, 7, 3, 5, 'diterima', 'ciberem', 'Ciberem', 20000, '2021-10-20 21:16:50'),
(33, 7, 3, 1, 'diterima', 'kuningan', 'Kuningan', 10000, '2021-10-20 21:25:22');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id_pesanan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id_pesanan`, `id_barang`, `quantity`) VALUES
(33, 9, 1),
(28, 10, 1),
(30, 11, 1),
(32, 11, 1),
(31, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `id_rekening` int(11) NOT NULL,
  `bank` varchar(250) NOT NULL,
  `atas_nama` varchar(250) NOT NULL,
  `nomor_rekening` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`id_rekening`, `bank`, `atas_nama`, `nomor_rekening`) VALUES
(3, 'BRI', 'Opa Meidi', '8232867231332');

-- --------------------------------------------------------

--
-- Structure for view `gethargatotal`
--
DROP TABLE IF EXISTS `gethargatotal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `gethargatotal`  AS  select sum((`me1`.`harga` * `pd1`.`quantity`)) AS `Total`,`pe1`.`id_pesanan` AS `id_pesanan` from ((`pesanan` `pe1` left join `pesanan_detail` `pd1` on((`pe1`.`id_pesanan` = `pd1`.`id_pesanan`))) left join `barang` `me1` on((`pd1`.`id_barang` = `me1`.`id_barang`))) group by `pe1`.`id_pesanan` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`id_kurir`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pesanan` (`id_pesanan`),
  ADD KEY `id_rekening` (`id_rekening`),
  ADD KEY `id_admin` (`id_admin`),
  ADD KEY `id_kurir` (`id_kurir`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id_pemilik`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_pembeli` (`id_pembeli`),
  ADD KEY `id_kurir` (`id_kurir`),
  ADD KEY `id_ongkir` (`id_ongkir`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD UNIQUE KEY `id_barang` (`id_barang`,`id_pesanan`) USING BTREE,
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`id_rekening`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `id_kurir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id_pemilik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `rekening`
--
ALTER TABLE `rekening`
  MODIFY `id_rekening` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_3` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pembayaran_ibfk_4` FOREIGN KEY (`id_rekening`) REFERENCES `rekening` (`id_rekening`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pembayaran_ibfk_5` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`),
  ADD CONSTRAINT `pembayaran_ibfk_6` FOREIGN KEY (`id_kurir`) REFERENCES `kurir` (`id_kurir`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_kurir`) REFERENCES `kurir` (`id_kurir`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pesanan_ibfk_4` FOREIGN KEY (`id_ongkir`) REFERENCES `ongkir` (`id_ongkir`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD CONSTRAINT `pesanan_detail_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pesanan_detail_ibfk_2` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
