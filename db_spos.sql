-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 01:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spos`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(15) NOT NULL,
  `nama_barang` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `kode_satuan` varchar(12) DEFAULT NULL,
  `harga` double(12,2) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `harga_jual` double(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `deskripsi`, `kode_satuan`, `harga`, `stock`, `harga_jual`) VALUES
('br-0001', 'Pop Mie Ayam Bawang', 'ada ayam dan bawang nya', 'ks-002', 7300.00, 100, 8030.00),
('br-0002', 'Pop mie rasa bakso', 'mie yang ada baksonya', 'ks-001', 5600.00, 100, 6160.00),
('br-0003', 'Chimory Yogurt rasa almond', 'rasa susu dengan kacang almond', 'ks-001', 12100.00, 103, 13310.00),
('br-0004', 'Waffer Tango', 'tango degan varian rasa strawberry', 'ks-001', 5500.00, 93, 6050.00),
('br-0005', 'Biskuat isi 30', 'Biskuat dengan ukuran large', 'ks-001', 13300.00, 100, 14630.00),
('br-0006', 'Susu Indomlik', 'susu dengan rasa coklat', 'ks-001', 8700.00, 100, 9570.00);

-- --------------------------------------------------------

--
-- Table structure for table `detail_faktur`
--

CREATE TABLE `detail_faktur` (
  `kode_detail` varchar(15) NOT NULL,
  `kode_faktur` varchar(15) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `kode_barang` varchar(15) DEFAULT NULL,
  `harga` double(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_faktur`
--

INSERT INTO `detail_faktur` (`kode_detail`, `kode_faktur`, `quantity`, `kode_barang`, `harga`) VALUES
('df-0001', 'fk-0001', 5, 'br-0001', 8030.00),
('df-0002', 'fk-0003', 9, 'br-0003', 13310.00),
('df-0003', 'fk-0003', 4, 'br-0001', 8030.00);

--
-- Triggers `detail_faktur`
--
DELIMITER $$
CREATE TRIGGER `mengurangi_jumlah_barang` AFTER INSERT ON `detail_faktur` FOR EACH ROW BEGIN
    DECLARE kode_barang_var VARCHAR(10);
    DECLARE jumlah_var INT(10);

    SELECT kode_barang, stock
    INTO kode_barang_var, jumlah_var
    FROM barang
    WHERE kode_barang = NEW.kode_barang;

    SET jumlah_var = jumlah_var - NEW.quantity;

    UPDATE barang
    SET stock = jumlah_var
    WHERE kode_barang = NEW.kode_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_after_delete_barang` AFTER DELETE ON `detail_faktur` FOR EACH ROW BEGIN
    DECLARE delta_jumlah INT;
    
    -- Menghitung selisih jumlah setelah penghapusan
    SET delta_jumlah = OLD.quantity;
    
    -- Update jumlah di tabel keramik
    UPDATE barang
    SET stock = stock + delta_jumlah
    WHERE kode_barang = OLD.kode_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `detail_fakturbeli`
--

CREATE TABLE `detail_fakturbeli` (
  `kode_detailbeli` varchar(15) NOT NULL,
  `kode_fakturbeli` varchar(15) DEFAULT NULL,
  `kode_barang` varchar(15) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` double(12,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_fakturbeli`
--

INSERT INTO `detail_fakturbeli` (`kode_detailbeli`, `kode_fakturbeli`, `kode_barang`, `jumlah`, `harga`) VALUES
('dfb-0002', 'fkb-0001', 'br-0002', 5, 6160.00),
('dfb-0003', 'fkb-0001', 'br-0004', 7, 6050.00);

--
-- Triggers `detail_fakturbeli`
--
DELIMITER $$
CREATE TRIGGER `mengurangi_jumlahbarang` AFTER INSERT ON `detail_fakturbeli` FOR EACH ROW BEGIN
    DECLARE kode_barang_var VARCHAR(10);
    DECLARE jumlah_var INT(10);

    SELECT kode_barang, stock
    INTO kode_barang_var, jumlah_var
    FROM barang
    WHERE kode_barang = NEW.kode_barang;

    SET jumlah_var = jumlah_var - NEW.jumlah;

    UPDATE barang
    SET stock = jumlah_var
    WHERE kode_barang = NEW.kode_barang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_after_deletebarang` AFTER DELETE ON `detail_fakturbeli` FOR EACH ROW BEGIN
    DECLARE delta_jumlah INT;
    
    -- Menghitung selisih jumlah setelah penghapusan
    SET delta_jumlah = OLD.jumlah;
    
    -- Update jumlah di tabel keramik
    UPDATE barang
    SET stock = stock + delta_jumlah
    WHERE kode_barang = OLD.kode_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `faktur`
--

CREATE TABLE `faktur` (
  `kode_faktur` varchar(15) NOT NULL,
  `tgl_faktur` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kode_karyawan` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faktur`
--

INSERT INTO `faktur` (`kode_faktur`, `tgl_faktur`, `kode_karyawan`) VALUES
('fk-0001', '2024-01-21 17:00:00', 'kry-001'),
('fk-0002', '2024-01-21 17:00:00', 'kry-001'),
('fk-0003', '2024-01-22 17:00:00', 'kry-001');

-- --------------------------------------------------------

--
-- Table structure for table `fakturbeli`
--

CREATE TABLE `fakturbeli` (
  `kode_fakturbeli` varchar(15) NOT NULL,
  `tanggal_beli` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kode_supp` varchar(15) DEFAULT NULL,
  `kode_karyawan` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fakturbeli`
--

INSERT INTO `fakturbeli` (`kode_fakturbeli`, `tanggal_beli`, `kode_supp`, `kode_karyawan`) VALUES
('fkb-0001', '2024-01-23 07:19:49', 'SUP-002', 'kry-002');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `kode_karyawan` varchar(15) NOT NULL,
  `nama_karyawan` varchar(50) DEFAULT NULL,
  `jabatan` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`kode_karyawan`, `nama_karyawan`, `jabatan`) VALUES
('kry-001', 'Nabilla', 'Kasir'),
('kry-002', 'Khairul', 'Cleaning Services'),
('kry-003', 'adi', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `marginprofit`
--

CREATE TABLE `marginprofit` (
  `kode_margin` varchar(15) NOT NULL,
  `tahun_berlaku` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `margin` double(7,1) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marginprofit`
--

INSERT INTO `marginprofit` (`kode_margin`, `tahun_berlaku`, `margin`, `status`) VALUES
('mg-01', '2024-01-19 08:51:58', 10.0, 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `kode_satuan` varchar(12) NOT NULL,
  `satuan` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`kode_satuan`, `satuan`) VALUES
('ks-001', 'pcs'),
('ks-002', 'set');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `kode_supp` varchar(15) NOT NULL,
  `nama_supp` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`kode_supp`, `nama_supp`, `alamat`) VALUES
('SUP-001', 'Arya Companies', 'Jln. Ngurul No.78'),
('SUP-002', 'Takes Two', 'California, Handburg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `kode_user` varchar(11) NOT NULL,
  `nama_user` varchar(20) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `hak_akses` int(2) DEFAULT NULL,
  `kode_karyawan` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`kode_user`, `nama_user`, `password`, `hak_akses`, `kode_karyawan`) VALUES
('user-001', 'khairul', 'khairul123', 2, 'kry-002'),
('user-002', 'nabila', 'bila123', 2, 'kry-001'),
('user-003', 'admin', 'admin', 1, 'kry-003');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`),
  ADD KEY `kode_satuan` (`kode_satuan`);

--
-- Indexes for table `detail_faktur`
--
ALTER TABLE `detail_faktur`
  ADD PRIMARY KEY (`kode_detail`),
  ADD UNIQUE KEY `kode_faktur_2` (`kode_faktur`,`kode_barang`),
  ADD KEY `kode_faktur` (`kode_faktur`),
  ADD KEY `relasi_kodebarang` (`kode_barang`);

--
-- Indexes for table `detail_fakturbeli`
--
ALTER TABLE `detail_fakturbeli`
  ADD PRIMARY KEY (`kode_detailbeli`),
  ADD UNIQUE KEY `kode_faktur_2` (`kode_fakturbeli`,`kode_barang`),
  ADD KEY `kode_barang` (`kode_barang`),
  ADD KEY `kode_faktur` (`kode_fakturbeli`);

--
-- Indexes for table `faktur`
--
ALTER TABLE `faktur`
  ADD PRIMARY KEY (`kode_faktur`),
  ADD KEY `kode_karyawan` (`kode_karyawan`) USING BTREE;

--
-- Indexes for table `fakturbeli`
--
ALTER TABLE `fakturbeli`
  ADD PRIMARY KEY (`kode_fakturbeli`),
  ADD KEY `kode_supp` (`kode_supp`),
  ADD KEY `kode_karyawan` (`kode_karyawan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`kode_karyawan`);

--
-- Indexes for table `marginprofit`
--
ALTER TABLE `marginprofit`
  ADD PRIMARY KEY (`kode_margin`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`kode_satuan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`kode_supp`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`kode_user`),
  ADD KEY `kode_karyawan` (`kode_karyawan`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `relasi_satuan` FOREIGN KEY (`kode_satuan`) REFERENCES `satuan` (`kode_satuan`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_faktur`
--
ALTER TABLE `detail_faktur`
  ADD CONSTRAINT `relasi_faktur` FOREIGN KEY (`kode_faktur`) REFERENCES `faktur` (`kode_faktur`) ON UPDATE CASCADE,
  ADD CONSTRAINT `relasi_kodebarang` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON UPDATE CASCADE;

--
-- Constraints for table `detail_fakturbeli`
--
ALTER TABLE `detail_fakturbeli`
  ADD CONSTRAINT `relasi_fakturbeli` FOREIGN KEY (`kode_fakturbeli`) REFERENCES `fakturbeli` (`kode_fakturbeli`) ON UPDATE CASCADE,
  ADD CONSTRAINT `relasi_kode_barang` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`);

--
-- Constraints for table `faktur`
--
ALTER TABLE `faktur`
  ADD CONSTRAINT `relasi_karyawan` FOREIGN KEY (`kode_karyawan`) REFERENCES `karyawan` (`kode_karyawan`) ON UPDATE CASCADE;

--
-- Constraints for table `fakturbeli`
--
ALTER TABLE `fakturbeli`
  ADD CONSTRAINT `relasi_kodekaryawan` FOREIGN KEY (`kode_karyawan`) REFERENCES `karyawan` (`kode_karyawan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `relasi_supp` FOREIGN KEY (`kode_supp`) REFERENCES `supplier` (`kode_supp`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `relasi_kode_karyawan` FOREIGN KEY (`kode_karyawan`) REFERENCES `karyawan` (`kode_karyawan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
