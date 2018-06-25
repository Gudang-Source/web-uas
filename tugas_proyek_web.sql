-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2018 at 12:13 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tugas_proyek_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_sewa`
--

CREATE TABLE `detail_sewa` (
  `id` int(11) NOT NULL,
  `id_sewa` int(11) NOT NULL DEFAULT '0',
  `id_produk` int(11) NOT NULL DEFAULT '0',
  `qty` int(11) NOT NULL DEFAULT '0',
  `biaya_per_hari` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_sewa`
--

INSERT INTO `detail_sewa` (`id`, `id_sewa`, `id_produk`, `qty`, `biaya_per_hari`) VALUES
(1, 3, 1, 2, 100000),
(2, 3, 5, 3, 135000);

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `id` int(11) NOT NULL,
  `jenis_identitas` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id`, `jenis_identitas`) VALUES
(18, 'Kartu Pelajar'),
(16, 'KTM'),
(13, 'KTP'),
(17, 'Passport'),
(14, 'SIM');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama_kategori`, `parent`) VALUES
(1, 'Tenda', 0),
(2, 'Tenda 3 - 4 Orang', 1),
(3, 'Tenda 4 - 5 Orang', 1),
(4, 'Alat Masak', 0),
(5, 'Kompor', 4),
(6, 'Tenda 2 Orang', 1),
(7, 'Nesting', 4),
(8, 'Tas', 0),
(9, 'Kompor Minyak', 5),
(10, 'Kompor Gas', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL DEFAULT '0',
  `no_identitas` varchar(50) NOT NULL DEFAULT '0',
  `id_identitas` int(11) DEFAULT NULL,
  `alamat` varchar(100) NOT NULL DEFAULT '0',
  `no_hp` varchar(15) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `no_identitas`, `id_identitas`, `alamat`, `no_hp`, `email`) VALUES
(3, 'Kim Jong Un', '11343323', 13, 'Jl. Kaliurang KM 20', '08445454', 'jongun@kim.com'),
(4, 'Tommy Winata', '13455111312', 13, 'Nitikan UH VI/223', '089922322321', 'tommy@email.com'),
(6, 'John Meyer', '12313123123', 18, 'Jl. Naik Turun 22 Yogyakarta', '11232112313', 'ganti@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `description` text,
  `total_stock` int(3) DEFAULT '0',
  `ready_stock` int(3) DEFAULT '0',
  `harga_sewa` int(7) NOT NULL DEFAULT '0',
  `foto` varchar(300) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `nama_produk`, `description`, `total_stock`, `ready_stock`, `harga_sewa`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Consina Magnum 4', '<p>Tenda yang sangat cocok untuk digunakan di segala medan.</p>', 6, 4, 50000, 'magnum4.jpg', '2018-06-24 20:03:09', '2018-06-25 16:28:18'),
(5, 'Tas Deuter AirContact 45', '<p>Tas andalan di segala medan</p>', 15, 12, 45000, 'aircontact.jpg', '2018-06-24 20:59:41', '2018-06-25 16:29:49'),
(7, 'Merapi Fire Bird', '<p>Size: (50 x 140) x 200 x 105 cm<br> Capacity: 2 Persons<br> Type: 3 Seasons<br> Construction type: Dome (inner First)<br> Flysheet Material: 190T Polyester<br> Flysheet Coating: PU 2000mm seam taped<br> Inner Fabric: 190T Polyester breathable<br> Inner Mesh: B3 no-see-um mesh<br> Floor Material: 190T Polyeste<br> Floor Coating: PU2000mm seam taped<br> Floor Size: 140 x 200 cm<br> Poles Material: 7001 T6 Aluminum<br> Poles Size: Diameter 7.9mm<br> Poles Quantity: 2 set poles<br> Pegs Material: Steel Pegs<br> Pegs Quantity: 6 pcs<br> Guyrope: Diameter 3mm no reflective<br> Packing size: 47 x 12 x 12 cm<br> Total weight: 1,7 kg<br> Foot Print Material: 190T Polyester<br> Foot Print Coating: PU3000mm seam taped<br> Vestibule size: 200 x (diameter 50 cm)<br> Vestibule Quantity: 1 vestibule<br> Tent Door: 1 door<br> Door Layers: 1 (half fabric & Half mesh)<br> Tent Ventilation: 1 ventilation<br> Tent Height: 105 cm</p>', 6, 6, 35000, 'fire-bird1.jpg', '2018-06-24 21:09:56', '2018-06-25 15:09:06');

-- --------------------------------------------------------

--
-- Table structure for table `produk_to_kategori`
--

CREATE TABLE `produk_to_kategori` (
  `id_produk` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk_to_kategori`
--

INSERT INTO `produk_to_kategori` (`id_produk`, `id_kategori`) VALUES
(1, 1),
(1, 3),
(5, 8),
(7, 1),
(7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `sewa`
--

CREATE TABLE `sewa` (
  `id` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL DEFAULT '0',
  `tgl_sewa` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `biaya_per_hari` int(9) NOT NULL,
  `biaya_total` int(9) NOT NULL,
  `dikembalikan` tinyint(1) NOT NULL DEFAULT '0',
  `denda` int(9) NOT NULL DEFAULT '0',
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sewa`
--

INSERT INTO `sewa` (`id`, `id_pelanggan`, `tgl_sewa`, `tgl_kembali`, `biaya_per_hari`, `biaya_total`, `dikembalikan`, `denda`, `id_petugas`) VALUES
(3, 3, '2018-06-25', '2018-06-27', 150000, 470000, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(64) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama`, `email`, `id_role`, `foto`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'Zunan Arif Rahmanto', 'zunan@themeae.com', 1, 'zunan.png'),
(2, 'petugas1', '7b1456bbe1a4e6644561e38e12b5bf04d425c5825b8bdf3620fecf5592a4438e', 'Karto Suwito', 'karto@suwito.com', 2, 'photo1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `id_role` int(11) NOT NULL,
  `nama_role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id_role`, `nama_role`) VALUES
(1, 'Administrator'),
(2, 'Petugas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_sewa`
--
ALTER TABLE `detail_sewa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_detail_sewa_sewa` (`id_sewa`),
  ADD KEY `FK_detail_sewa_produk` (`id_produk`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jenis_identitas` (`jenis_identitas`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `no_hp` (`no_hp`),
  ADD KEY `id_identitas` (`id_identitas`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk_to_kategori`
--
ALTER TABLE `produk_to_kategori`
  ADD PRIMARY KEY (`id_produk`,`id_kategori`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `sewa`
--
ALTER TABLE `sewa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_sewa_pelanggan` (`id_pelanggan`),
  ADD KEY `FK_sewa_user` (`id_petugas`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_sewa`
--
ALTER TABLE `detail_sewa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `identitas`
--
ALTER TABLE `identitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sewa`
--
ALTER TABLE `sewa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_sewa`
--
ALTER TABLE `detail_sewa`
  ADD CONSTRAINT `FK_detail_sewa_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`),
  ADD CONSTRAINT `FK_detail_sewa_sewa` FOREIGN KEY (`id_sewa`) REFERENCES `sewa` (`id`);

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`id_identitas`) REFERENCES `identitas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `produk_to_kategori`
--
ALTER TABLE `produk_to_kategori`
  ADD CONSTRAINT `produk_to_kategori_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_to_kategori_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sewa`
--
ALTER TABLE `sewa`
  ADD CONSTRAINT `FK_sewa_pelanggan` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id`),
  ADD CONSTRAINT `FK_sewa_user` FOREIGN KEY (`id_petugas`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `user_role` (`id_role`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
