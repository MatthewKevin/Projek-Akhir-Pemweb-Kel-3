-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2022 at 11:42 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `noverukun`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_genre`
--

CREATE TABLE `tb_genre` (
  `id_genre` int(11) NOT NULL,
  `nama_genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_genre`
--

INSERT INTO `tb_genre` (`id_genre`, `nama_genre`) VALUES
(15, 'Light Novel'),
(16, 'Romance Novel'),
(17, 'Action Novel'),
(18, 'Sci-Fi Novel'),
(19, 'Slice of Life Novel'),
(20, 'School Novel'),
(21, 'Mystery Novel'),
(22, 'Comedy Novel'),
(23, 'Horror Novel');

-- --------------------------------------------------------

--
-- Table structure for table `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id_krj` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`id_krj`, `name`, `price`, `quantity`) VALUES
(1, 'Samsung', 2000000, 2),
(2, 'Samsung2', 3000000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_novel`
--

CREATE TABLE `tb_novel` (
  `kd_novel` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_genre` varchar(10) NOT NULL,
  `deskripsi` text NOT NULL,
  `jumlah_brg` int(11) NOT NULL,
  `headline` enum('Y','T') NOT NULL,
  `tgl_masuk` date NOT NULL,
  `hrg_jual` double NOT NULL,
  `terjual` int(11) NOT NULL,
  `foto` text NOT NULL,
  `stok_barang` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_novel`
--

INSERT INTO `tb_novel` (`kd_novel`, `nama`, `id_genre`, `deskripsi`, `jumlah_brg`, `headline`, `tgl_masuk`, `hrg_jual`, `terjual`, `foto`, `stok_barang`) VALUES
(29, 'Goblin Slayer', '15', 'Sebuah Light Novel yang menceritakan tentang petualangan dari karakter utama novel tersebut didalam dunia fantasi yang dipenuhi oleh monster.', 99, 'Y', '2022-06-01', 150000, 0, '62974ab6ebee4.jpg', 100),
(31, 'The Rising of The Shield Hero', '17', '-', 95, 'Y', '2022-06-07', 160000, 0, 'Shield Hero.png', 100),
(32, 'Overlord', '15', '-', 99, 'Y', '2022-06-07', 155000, 0, 'Overlord.png', 100),
(33, 'Jack Knifed', '21', '-', 100, 'Y', '2022-06-07', 160000, 0, 'Jack Knifed.png', 100),
(34, 'The Rising Dead', '23', '-', 100, 'Y', '2022-06-07', 160000, 0, 'Rising Dead.png', 100),
(35, 'Games You Can Play With Your Pussy', '22', '-', 100, 'Y', '2022-06-07', 155000, 0, 'Games You Can Play.png', 100),
(36, 'It Seems I Was Hitting On the Most Beautiful Girl ', '19', '-', 100, 'Y', '2022-06-07', 150000, 0, 'Otonari Asobi.png', 100),
(37, 'The Story Of How A Beautiful Foreign Student Who L', '20', '-', 100, 'Y', '2022-06-07', 150000, 0, 'Maigo ni Tasuketara.png', 100),
(38, 'My Youth Romantic Comedy Is Wrong As I Expected', '16', '-', 100, 'Y', '2022-06-07', 155000, 0, 'Oregairu.png', 100),
(39, 'The Irregular at Magic High School', '18', '-', 100, 'Y', '2022-06-07', 155000, 0, 'Mahouka Koukou.png', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ongkir`
--

CREATE TABLE `tb_ongkir` (
  `id_ongkir` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_ongkir`
--

INSERT INTO `tb_ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'Mangelang', 50000),
(2, 'Lampung', 38000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `bank` varchar(50) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(1, 8, 'Harun', 'Mandiri Syariah', 1000000, '2020-07-05', '5f01d09d6d736.png'),
(2, 9, 'ss', 'BRI', 1000000, '2020-07-07', '5f03eebea7d11.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tgl_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `alamat_pengiriman` text NOT NULL,
  `status_pembelian` varchar(50) NOT NULL DEFAULT 'pending',
  `resi_pengiriman` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembelian`
--

INSERT INTO `tb_pembelian` (`id_pembelian`, `id_user`, `id_ongkir`, `tgl_pembelian`, `total_pembelian`, `nama_kota`, `tarif`, `alamat_pengiriman`, `status_pembelian`, `resi_pengiriman`) VALUES
(8, 5, 1, '2020-07-03', 128000, '', 0, '', 'Barang Dikirim', 'ABCS'),
(9, 5, 1, '2020-07-03', 339000, '', 0, '', 'Barang Dikirim', ''),
(10, 5, 2, '2020-07-03', 217000, 'Lampung', 38000, '', 'pending', ''),
(11, 5, 1, '2020-07-03', 139000, 'Mangelang', 50000, 'Jl. kakak tua no.34', 'pending', ''),
(12, 5, 2, '2020-07-04', 366000, 'Lampung', 38000, 'asdasd', 'pending', ''),
(13, 5, 2, '2020-07-05', 305000, 'Lampung', 38000, 'erer', 'pending', ''),
(33, 1, 1, '2022-06-07', 360000, 'Mangelang', 50000, 'jl veteran no 8', 'pending', ''),
(34, 1, 1, '2022-06-08', 205000, 'Mangelang', 50000, 'JL. Veteran No 8', 'pending', ''),
(35, 1, 1, '2022-06-10', 200000, 'Mangelang', 50000, 'JL. Veteran No. 8', 'pending', '');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembelian_novel`
--

CREATE TABLE `tb_pembelian_novel` (
  `id_pembelian_novel` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `kd_novel` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembelian_novel`
--

INSERT INTO `tb_pembelian_novel` (`id_pembelian_novel`, `id_pembelian`, `kd_novel`, `jumlah`, `nama`, `harga`, `subharga`) VALUES
(0, 15, 31, 1, 'The Rising of The Shield Hero', 160000, 160000),
(2, 1, 12, 30000, '', 0, 0),
(3, 5, 12, 1, '', 0, 0),
(5, 6, 12, 1, '', 0, 0),
(6, 6, 13, 1, '', 0, 0),
(7, 7, 12, 1, '', 0, 0),
(8, 8, 20, 1, '', 0, 0),
(9, 9, 12, 1, 'OEM Stainless Steel Panci 18 cm', 89000, 89000),
(10, 9, 13, 1, 'Gamis Coklat', 200000, 200000),
(11, 10, 12, 1, 'OEM Stainless Steel Panci 18 cm', 89000, 89000),
(12, 10, 21, 1, 'Kipas Angin Sekai HDO 615-S', 90000, 90000),
(13, 11, 12, 1, 'OEM Stainless Steel Panci 18 cm', 89000, 89000),
(14, 12, 12, 2, 'OEM Stainless Steel Panci 18 cm', 89000, 178000),
(15, 12, 13, 1, 'Gamis Coklat', 150000, 150000),
(16, 13, 12, 3, 'OEM Stainless Steel Panci 18 cm', 89000, 267000),
(33, 0, 31, 1, 'The Rising of The Shield Hero', 160000, 160000),
(34, 0, 32, 1, 'Overlord', 155000, 155000),
(35, 0, 29, 1, 'Goblin Slayer', 150000, 150000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk_foto`
--

CREATE TABLE `tb_produk_foto` (
  `id_produk_foto` int(11) NOT NULL,
  `kd_novel` int(11) NOT NULL,
  `nama_produk_foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_produk_foto`
--

INSERT INTO `tb_produk_foto` (`id_produk_foto`, `kd_novel`, `nama_produk_foto`) VALUES
(19, 28, '13233084_1721459411430483_8266543403885607708_n.jpg'),
(20, 28, '3365637c499f0983332b36667725ebbe.jpg'),
(21, 0, 'Goblin-Slayer.jpg'),
(22, 0, ''),
(23, 29, ''),
(24, 0, 'Shield Hero.png'),
(25, 0, 'Overlord.png'),
(26, 0, 'Jack Knifed.png'),
(27, 0, 'Rising Dead.png'),
(28, 0, 'Games You Can Play.png'),
(29, 0, 'Otonari Asobi.png'),
(30, 0, 'Maigo ni Tasuketara.png'),
(31, 0, 'Oregairu.png'),
(32, 0, 'Mahouka Koukou.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` int(20) NOT NULL,
  `level` varchar(20) NOT NULL,
  `blokir` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `level`, `blokir`) VALUES
(1, 'matthew', '$2y$10$4YmUM.369zpBBaJ0dfEnnOZcgyggv5MCGGCYiIEKeSI9AYtWsgzZy', 'Matthew Kevin Siahaan', 'matthewkevinsiahaan@gmail.com', 2147483647, 'admin', 'N'),
(9, 'admin', '$2y$10$EiEdFgv/QZyLcin0O10Kte.Ouc00MLCG9JyjlvOsGEChc4VADqhPC', 'admin', 'admin@gmail.com', 986776565, 'admin', 'N'),
(11, 'esel', '$2y$10$Y6/XqlP1EIAU81b/zyFX6eAIVAtWLoBmxCUWtoW0rUNdKUdYUwHge', 'Esel Sugiharto', 'eselsugiharto@gmail.com', 2147483647, 'User', 'N'),
(12, 'iqbal', '$2y$10$1WU2FTBZRU3Aw0bHsIt5i.Lt5zOs5RO7EjzyP2G8ajgPG5n4AY6zm', 'Muhammad Rizky Iqbal', 'rizkyiqbal@gmail.com', 2147483647, 'User', 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_genre`
--
ALTER TABLE `tb_genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indexes for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id_krj`);

--
-- Indexes for table `tb_novel`
--
ALTER TABLE `tb_novel`
  ADD PRIMARY KEY (`kd_novel`);

--
-- Indexes for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `tb_pembelian_novel`
--
ALTER TABLE `tb_pembelian_novel`
  ADD PRIMARY KEY (`id_pembelian_novel`);

--
-- Indexes for table `tb_produk_foto`
--
ALTER TABLE `tb_produk_foto`
  ADD PRIMARY KEY (`id_produk_foto`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_genre`
--
ALTER TABLE `tb_genre`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id_krj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_novel`
--
ALTER TABLE `tb_novel`
  MODIFY `kd_novel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `tb_ongkir`
--
ALTER TABLE `tb_ongkir`
  MODIFY `id_ongkir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tb_produk_foto`
--
ALTER TABLE `tb_produk_foto`
  MODIFY `id_produk_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
