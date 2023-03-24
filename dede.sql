-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 24 Mar 2023 pada 07.07
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dede`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `ID_barangkeluar` ()  NO SQL BEGIN
SET @cek = (
    SELECT CONCAT("J",RIGHT(YEAR(CURDATE()),2), IF(MONTH(CURDATE())<10, CONCAT(0,MONTH(CURDATE())), MONTH(CURDATE())))
);

SET @num = (
    SELECT COUNT(*)
    FROM barang_keluar WHERE nota_id LIKE CONCAT(@cek, '%')
) + 1;

SET @nol = (
	IF(@num<10,"00", IF(@num<100,0,""))
);

SELECT CONCAT("J",RIGHT(YEAR(CURDATE()),2), IF(MONTH(CURDATE())<10, CONCAT(0,MONTH(CURDATE())), MONTH(CURDATE())), @nol, @num) AS `ID`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ID_barangmasuk` ()  NO SQL BEGIN
SET @cek = (
    SELECT CONCAT("B",RIGHT(YEAR(CURDATE()),2), IF(MONTH(CURDATE())<10, CONCAT(0,MONTH(CURDATE())), MONTH(CURDATE())))
);

SET @num = (
    SELECT COUNT(*)
    FROM barang_masuk WHERE invoice_id LIKE CONCAT(@cek, '%')
) + 1;

SET @nol = (
	IF(@num<10,0,"")
);

SELECT CONCAT("B",RIGHT(YEAR(CURDATE()),2), IF(MONTH(CURDATE())<10, CONCAT(0,MONTH(CURDATE())), MONTH(CURDATE())), @nol, @num) `ID`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ID_reseller` ()  NO SQL BEGIN

SET @num = (
    SELECT COUNT(*)
    FROM reseller
) + 1;

SET @nol = (
	IF(@num<10,"00",IF(@num<100,"0",""))
);

SELECT CONCAT("RL", @nol, @num) `ID`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ID_stockopname` ()  NO SQL BEGIN
SET @cek = (
    SELECT CONCAT("SO",RIGHT(YEAR(CURDATE()),2))
);

SET @num = (
    SELECT COUNT(*)
    FROM stock_opname WHERE opname_id LIKE CONCAT(@cek, '%')
) + 1;

SET @nol = (
	IF(@num<10,0, "")
);

SELECT CONCAT("SO",RIGHT(YEAR(CURDATE()),2), @nol, @num) AS `ID`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_barangkeluar` (IN `id_nota` VARCHAR(8), IN `id_admin` VARCHAR(15), IN `tanggal` DATE, IN `id_res` VARCHAR(6), IN `total` INT(12), IN `jum_kut` INT(5))  NO SQL INSERT INTO `barang_keluar`(`nota_id`, `admin_id`, `tanggal`, `reseller_id`, `total_harga_penjualan`, `sudah_dibayar`, `belum_dibayar`,`tanggal_pelunasan`, `jumlah_kutus`) VALUES (id_nota, id_admin, tanggal, id_res, total,0,total,0,jum_kut)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_barangmasuk` (IN `id_invo` VARCHAR(7), IN `tanggal` DATE, IN `total` INT(12), IN `admin_id` VARCHAR(12))  NO SQL INSERT INTO `barang_masuk`(`invoice_id`,  `tanggal`, `total_harga`,`admin_id`, `invoice_status`) VALUES (id_invo, tanggal, total,admin_id, 1)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_detbarangkeluar` (IN `id_nota` VARCHAR(8), IN `id_prod` VARCHAR(4), IN `jum` INT(5), IN `harga` INT(6))  NO SQL INSERT INTO `detail_barang_keluar`(`nota_id`, `produk_id`, `jumlah`, `satuan_id`, `harga_satuan`) VALUES (id_nota, id_prod, jum, 'pcs', harga)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_detbarangmasuk` (IN `id_invo` VARCHAR(7), IN `id_prod` VARCHAR(4), IN `jum` INT(5), IN `harga` INT(6))  NO SQL INSERT INTO `detail_barang_masuk`(`invoice_id`, `produk_id`, `jumlah`, `satuan_id`, `harga`) VALUES (id_invo, id_prod, jum, 'pcs',harga)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tambah_kutus` (IN `id_prod` VARCHAR(4), IN `jum` INT(5))  NO SQL BEGIN
SET @id_res = (
	SELECT reseller_id 
	FROM `barang_keluar` 
	ORDER BY `nota_id`  DESC 
	LIMIT 1
);

UPDATE `reseller` 
SET `total_kutus`= total_kutus + jum 
WHERE id_prod = 'MUS1' AND reseller_id = @id_res;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_admin` varchar(50) NOT NULL,
  `gaji` int(7) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL,
  `akses_id` tinyint(1) NOT NULL,
  `status_del` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `password`, `nama_admin`, `gaji`, `alamat`, `nomor_telepon`, `email`, `akses_id`, `status_del`, `created_at`, `updated_at`, `deleted_at`) VALUES
('owner', '81dc9bdb52d04dc20036dbd8313ed055', 'OWNER ACCOUNT', 0, 'Kutus-Kutus Bali', '08', 'pflorence@student.ciputra.ac.id', 0, 1, NULL, '2023-03-21 04:59:43', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `nota_id` varchar(8) NOT NULL,
  `admin_id` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `reseller_id` varchar(6) NOT NULL,
  `total_harga_penjualan` int(12) NOT NULL,
  `sudah_dibayar` int(12) NOT NULL,
  `belum_dibayar` int(12) NOT NULL,
  `tanggal_pelunasan` date NOT NULL,
  `jumlah_kutus` int(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_keluar`
--

INSERT INTO `barang_keluar` (`nota_id`, `admin_id`, `tanggal`, `reseller_id`, `total_harga_penjualan`, `sudah_dibayar`, `belum_dibayar`, `tanggal_pelunasan`, `jumlah_kutus`, `created_at`, `deleted_at`, `updated_at`) VALUES
('J2101002', 'clara_1', '2021-01-04', 'RL002', 505000, 505000, 0, '0000-00-00', 2, NULL, NULL, NULL),
('J2101003', 'clara_1', '2021-01-04', 'RL003', 250000, 250000, 0, '0000-00-00', 0, NULL, NULL, NULL),
('J2101004', 'clara_1', '2021-01-05', 'RL004', 2300000, 2300000, 0, '0000-00-00', 10, NULL, NULL, NULL),
('J2101006', 'sewunah12', '2021-01-06', 'RL006', 450000, 450000, 0, '0000-00-00', 0, NULL, NULL, NULL),
('J2101007', 'sewunah12', '2021-01-06', 'RL007', 430000, 430000, 0, '0000-00-00', 1, NULL, NULL, NULL),
('J2101008', 'sewunah12', '2021-01-07', 'RL001', 960000, 960000, 0, '0000-00-00', 2, NULL, NULL, NULL),
('J2101009', 'sewunah12', '2021-04-07', 'RL002', 120000, 120000, 0, '0000-00-00', 0, NULL, NULL, NULL),
('J2101010', 'sewunah12', '2021-04-10', 'RL003', 1040000, 1040000, 0, '0000-00-00', 0, NULL, NULL, '2021-05-22 08:52:41'),
('J2101011', 'sewunah12', '2021-04-10', 'RL004', 1150000, 1150000, 0, '0000-00-00', 0, NULL, NULL, '2022-08-02 23:12:50'),
('J2101013', 'sewunah12', '2021-04-15', 'RL006', 320000, 320000, 0, '0000-00-00', 0, NULL, NULL, NULL),
('J2101014', 'juleha33', '2021-01-15', 'RL007', 2500000, 2500000, 0, '0000-00-00', 10, NULL, NULL, NULL),
('J2101015', 'juleha33', '2021-01-18', 'RL008', 1250000, 1250000, 0, '2023-03-22', 0, NULL, NULL, '2023-03-22 06:02:46'),
('J2101016', 'juleha33', '2021-01-19', 'RL001', 700000, 700000, 0, '2023-03-22', 0, NULL, NULL, '2023-03-22 06:02:59'),
('J2101017', 'juleha33', '2021-01-19', 'RL003', 5000000, 5000000, 0, '0000-00-00', 20, NULL, NULL, NULL),
('J2101018', 'juleha33', '2021-04-20', 'RL003', 11200000, 11200000, 0, '2023-03-22', 40, NULL, NULL, '2023-03-22 06:03:26'),
('J2101019', 'juleha33', '2021-04-20', 'RL004', 1200000, 1200000, 0, '0000-00-00', 0, NULL, NULL, NULL),
('J2101021', 'juleha33', '2021-04-21', 'RL008', 1300000, 1300000, 0, '0000-00-00', 5, NULL, NULL, NULL),
('J2101022', 'juleha33', '2021-04-22', 'RL001', 2500000, 2500000, 0, '0000-00-00', 0, NULL, NULL, NULL),
('J2101023', 'juleha33', '2021-04-22', 'RL002', 2500000, 2500000, 0, '2023-03-22', 0, NULL, NULL, '2023-03-22 06:03:49'),
('J2101024', 'juleha33', '2021-04-25', 'RL006', 960000, 960000, 0, '0000-00-00', 2, NULL, NULL, NULL),
('J2101025', 'juleha33', '2021-04-25', 'RL007', 960000, 960000, 0, '2023-03-22', 2, NULL, NULL, '2023-03-22 06:04:12'),
('J2101026', 'clara_1', '2021-04-28', 'RL001', 1300000, 1300000, 0, '2023-03-22', 5, NULL, NULL, '2023-03-22 06:00:47'),
('J2101027', 'sewunah12', '2021-04-29', 'RL002', 1300000, 1300000, 0, '2023-03-22', 5, NULL, NULL, '2023-03-22 06:04:25'),
('J2105001', 'Clara_1', '2021-05-05', 'RL004', 715000, 715000, 0, '2023-03-22', 0, NULL, NULL, '2023-03-22 05:58:36'),
('J2105002', 'Clara_1', '2021-05-05', 'RL002', 1980000, 1980000, 0, '2023-03-22', 0, NULL, NULL, '2023-03-22 05:58:20'),
('J2105003', 'Clara_1', '2021-06-05', 'RL007', 685000, 685000, 0, '2023-03-22', 0, NULL, NULL, '2023-03-22 05:58:04'),
('J2105004', 'owner', '2021-10-05', 'RL007', 220000, 220000, 0, '2023-03-22', 0, NULL, NULL, '2023-03-22 05:57:43'),
('J2105005', 'owner', '2021-10-05', 'RL007', 190000, 190000, 0, '2023-03-22', 0, NULL, NULL, '2023-03-22 05:52:51'),
('J2105006', 'owner', '2021-10-05', 'RL007', 410000, 410000, 0, '2023-03-22', 0, NULL, NULL, '2023-03-22 05:45:58'),
('J2105007', 'owner', '2021-10-05', 'RL007', 452000, 452000, 0, '0000-00-00', 0, NULL, '2021-05-17 01:55:51', '2021-05-17 01:55:51'),
('J2105009', 'owner', '2021-05-17', 'RL001', 220000, 220000, 0, '2023-03-22', 0, NULL, NULL, '2023-03-22 05:45:20'),
('J2105010', 'owner', '2021-05-22', 'RL007', 1760000, 1760000, 0, '0000-00-00', 0, NULL, NULL, '2021-05-22 08:52:13'),
('J2105011', 'owner', '2021-05-28', 'RL011', 1628000, 1628000, 0, '0000-00-00', 0, NULL, NULL, '2021-05-27 22:55:55'),
('J2105012', 'owner', '2021-05-31', 'RL008', 133000000, 133000000, 0, '2023-03-22', 700, NULL, NULL, '2023-03-22 05:44:48'),
('J2105013', 'owner', '2021-05-31', 'RL003', 133190000, 133190000, 0, '2023-03-22', 701, NULL, NULL, '2023-03-22 06:04:42'),
('J2208001', 'hai', '2022-08-03', 'RL004', 6068000, 0, 6068000, '2023-05-23', 0, NULL, NULL, '2023-03-22 05:43:48'),
('J2208002', 'hai', '2022-08-03', 'RL011', 1280000, 1280000, 0, '2023-03-22', 0, NULL, NULL, '2023-03-22 05:43:25'),
('J2303001', 'hai', '2023-03-21', 'RL001', 4180000, 4180000, 0, '2023-03-22', 22, NULL, NULL, '2023-03-22 05:42:05'),
('J2303002', 'hai', '2023-03-21', 'RL011', 2147483647, 2147483647, 0, '2023-03-22', 0, NULL, NULL, '2023-03-22 05:41:50'),
('J2303003', 'hai', '2023-03-21', 'RL001', 39960000, 39960000, 0, '2023-03-22', 0, NULL, NULL, '2023-03-22 05:45:27'),
('J2303004', 'owner', '2024-03-07', 'RL001', 1900000, 0, 1900000, '2023-04-30', 10, NULL, '2023-03-22 06:04:48', '2023-03-22 06:04:48'),
('J2303005', 'owner', '2023-03-21', 'RL012', 1900000, 1900000, 0, '2023-03-22', 10, NULL, NULL, '2023-03-22 05:39:35'),
('J2303006', 'owner', '2023-03-22', 'RL011', 17000000, 17000000, 0, '2023-03-22', 100, NULL, NULL, '2023-03-22 05:39:04'),
('J2303007', 'owner', '2023-03-22', 'RL012', 1900000, 100000, 1800000, '2023-03-31', 10, NULL, NULL, '2023-03-22 05:33:07'),
('J2303008', 'owner', '2023-03-22', 'RL009', 2300000, 100000, 2200000, '2023-04-20', 10, NULL, NULL, '2023-03-22 06:09:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `invoice_id` varchar(7) NOT NULL,
  `admin_id` varchar(15) NOT NULL,
  `tanggal` date NOT NULL,
  `total_harga` int(12) NOT NULL,
  `invoice_status` tinyint(1) NOT NULL,
  `status_del` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang_masuk`
--

INSERT INTO `barang_masuk` (`invoice_id`, `admin_id`, `tanggal`, `total_harga`, `invoice_status`, `status_del`) VALUES
('B210401', 'Clara_1', '2021-04-01', 500000, 1, 1),
('B210402', 'Julia_1', '2021-04-02', 150000, 1, 1),
('B210403', 'Julia_1', '2021-04-05', 400000, 1, 1),
('B210404', 'Clara_1', '2021-04-07', 460000, 1, 1),
('B210405', 'Julia_1', '2021-04-07', 90000, 1, 1),
('B210501', 'Clara_1', '2021-07-05', 23000000, 1, 1),
('B210502', 'Clara_1', '2021-07-05', 72500000, 1, 1),
('B210503', 'owner', '2021-10-05', 230000, 1, 1),
('B210504', 'owner', '2021-10-05', 80000000, 1, 1),
('B210505', 'owner', '2021-11-05', 5280000, 1, 1),
('B210506', 'owner', '2021-05-11', 2650000, 1, 1),
('B210507', 'owner', '2021-05-11', 5775000, 1, 1),
('B210508', 'owner', '2021-05-11', 525000, 1, 1),
('B210509', 'owner', '2021-12-05', 80000000, 1, 1),
('B210510', 'owner', '2021-05-12', 20000000, 1, 1),
('B210511', 'owner', '2021-05-13', 43000000, 1, 1),
('B210512', 'owner', '2021-05-16', 780000, 1, 1),
('B210513', 'owner', '2021-05-17', 800000, 1, 1),
('B210514', 'owner', '2021-05-20', 230000, 1, 1),
('B210515', 'owner', '2021-05-20', 230000, 1, 1),
('B210516', 'owner', '2021-05-22', 23000000, 1, 1),
('B210517', 'owner', '2021-05-31', 29500000, 1, 1),
('B210518', 'owner', '2021-05-31', 6100000, 1, 1),
('B210519', 'owner', '2021-05-31', 1970000, 1, 1),
('B210520', 'owner', '2021-05-31', 360000, 1, 1),
('B210521', 'owner', '2021-05-31', 2600000, 1, 1),
('B210522', 'owner', '2021-05-31', 2600000, 1, 1),
('B210523', 'owner', '2021-05-31', 50500000, 1, 1),
('B210524', 'owner', '2021-05-31', 2315000, 1, 1),
('B210525', 'owner', '2021-05-31', 161000000, 1, 1),
('B210526', 'owner', '2021-05-31', 250000000, 1, 1),
('B220801', 'hai', '2022-08-03', 161230000, 1, 1),
('B230301', 'owner', '0000-00-00', 2023, 1, 1),
('B230302', 'owner', '0000-00-00', 2023, 1, 1),
('B230303', '2300000', '0000-00-00', 2023, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_barang_keluar`
--

CREATE TABLE `detail_barang_keluar` (
  `nota_id` varchar(8) NOT NULL,
  `produk_id` varchar(4) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `satuan_id` varchar(4) NOT NULL,
  `harga_satuan` int(6) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_barang_keluar`
--

INSERT INTO `detail_barang_keluar` (`nota_id`, `produk_id`, `jumlah`, `satuan_id`, `harga_satuan`, `deleted_at`, `updated_at`) VALUES
('J2101001', 'MUS1', 6, 'pcs', 230000, NULL, NULL),
('J2101002', 'MUS1', 2, 'pcs', 230000, NULL, NULL),
('J2101002', 'SLA3', 1, 'pcs', 45000, NULL, NULL),
('J2101003', 'MMI2', 1, 'pcs', 250000, NULL, NULL),
('J2101004', 'MUS1', 10, 'pcs', 230000, NULL, NULL),
('J2101005', 'MUS1', 2, 'pcs', 230000, NULL, NULL),
('J2101005', 'SLA3', 1, 'pcs', 45000, NULL, NULL),
('J2101006', 'SLA3', 10, 'pcs', 45000, NULL, NULL),
('J2101007', 'BUK5', 1, 'pcs', 200000, NULL, NULL),
('J2101007', 'MUS1', 1, 'pcs', 230000, NULL, NULL),
('J2101008', 'MUS1', 2, 'pcs', 230000, NULL, NULL),
('J2101008', 'MMI2', 2, 'pcs', 250000, NULL, NULL),
('J2101009', 'SMU4', 1, 'pcs', 75000, NULL, NULL),
('J2101009', 'SLA3', 1, 'pcs', 45000, NULL, NULL),
('J2101010', 'BUK5', 1, 'pcs', 200000, NULL, NULL),
('J2101010', 'SLA3', 2, 'pcs', 45000, NULL, NULL),
('J2101010', 'SMU4', 1, 'pcs', 75000, NULL, NULL),
('J2101011', 'MUS1', 5, 'pcs', 230000, NULL, NULL),
('J2101012', 'MUS1', 8, 'pcs', 230000, NULL, NULL),
('J2101013', 'BUK5', 1, 'pcs', 200000, NULL, NULL),
('J2101013', 'SLA3', 1, 'pcs', 45000, NULL, NULL),
('J2101013', 'SMU4', 1, 'pcs', 75000, NULL, NULL),
('J2101014', 'MUS1', 10, 'pcs', 230000, NULL, NULL),
('J2101014', 'BUK5', 1, 'pcs', 200000, NULL, NULL),
('J2101015', 'BUK5', 5, 'pcs', 200000, NULL, NULL),
('J2101015', 'MMI2', 1, 'pcs', 250000, NULL, NULL),
('J2101016', 'MMI2', 2, 'pcs', 250000, NULL, NULL),
('J2101016', 'BUK5', 1, 'pcs', 200000, NULL, NULL),
('J2101017', 'MUS1', 20, 'pcs', 230000, NULL, NULL),
('J2101017', 'BUK5', 2, 'pcs', 200000, NULL, NULL),
('J2101018', 'BUK5', 10, 'pcs', 200000, NULL, NULL),
('J2101018', 'SMU4', 10, 'pcs', 75000, NULL, NULL),
('J2101019', 'BUK5', 10, 'pcs', 200000, NULL, NULL),
('J2101019', 'MUS1', 40, 'pcs', 230000, NULL, NULL),
('J2101020', 'MUS1', 5, 'pcs', 230000, NULL, NULL),
('J2101020', 'SMU4', 2, 'pcs', 75000, NULL, NULL),
('J2101021', 'MUS1', 5, 'pcs', 230000, NULL, NULL),
('J2101021', 'SMU4', 2, 'pcs', 75000, NULL, NULL),
('J2101022', 'BUK5', 10, 'pcs', 200000, NULL, NULL),
('J2101022', 'MMI2', 2, 'pcs', 250000, NULL, NULL),
('J2101023', 'BUK5', 10, 'pcs', 200000, NULL, NULL),
('J2101023', 'MMI2', 2, 'pcs', 250000, NULL, NULL),
('J2101024', 'MUS1', 2, 'pcs', 230000, NULL, NULL),
('J2101024', 'MMI2', 2, 'pcs', 250000, NULL, NULL),
('J2101025', 'MUS1', 2, 'pcs', 230000, NULL, NULL),
('J2101025', 'MMI2', 2, 'pcs', 250000, NULL, NULL),
('J2101026', 'MUS1', 5, 'pcs', 230000, NULL, NULL),
('J2101026', 'SMU4', 2, 'pcs', 75000, NULL, NULL),
('J2101027', 'MUS1', 5, 'pcs', 230000, NULL, NULL),
('J01027', 'SMU4', 2, 'pcs', 75000, NULL, NULL),
('J2105001', 'SMU4', 11, 'pcs', 75000, NULL, NULL),
('J2105002', 'BUK5', 11, 'pcs', 200000, NULL, NULL),
('J2105003', 'MUS1', 1, 'pcs', 230000, NULL, NULL),
('J2105003', 'MMI2', 2, 'pcs', 250000, NULL, NULL),
('J2105003', 'SLA3', 3, 'pcs', 45000, NULL, NULL),
('J2105004', 'MMI2', 1, 'pcs', 250000, NULL, NULL),
('J2105005', 'MUS1', 1, 'pcs', 230000, NULL, NULL),
('J2105006', 'MUS1', 1, 'pcs', 230000, NULL, NULL),
('J2105006', 'MMI2', 1, 'pcs', 250000, NULL, NULL),
('J2105007', 'MMI2', 1, 'pcs', 250000, '2021-05-17 01:55:51', '2021-05-17 01:55:51'),
('J2105007', 'MUS1', 1, 'pcs', 230000, '2021-05-17 01:55:51', '2021-05-17 01:55:51'),
('J2105007', 'SLA3', 1, 'pcs', 45000, '2021-05-17 01:55:51', '2021-05-17 01:55:51'),
('J2105008', 'MUS1', 1, 'pcs', 230000, '2021-05-17 01:54:49', '2021-05-17 01:54:49'),
('J2105008', 'MMI2', 1, 'pcs', 250000, '2021-05-17 01:54:49', '2021-05-17 01:54:49'),
('J2105008', 'SLA3', 1, 'pcs', 45000, '2021-05-17 01:54:49', '2021-05-17 01:54:49'),
('J2105008', 'SMU4', 1, 'pcs', 75000, '2021-05-17 01:54:49', '2021-05-17 01:54:49'),
('J2105010', 'MUS1', 1, 'pcs', 190000, '2021-05-17 01:52:18', '2021-05-17 01:52:18'),
('J2105010', 'SLA3', 1, 'pcs', 42000, '2021-05-17 01:52:18', '2021-05-17 01:52:18'),
('J2105010', 'MMI2', 1, 'pcs', 220000, '2021-05-17 01:52:18', '2021-05-17 01:52:18'),
('J2105010', 'SMU4', 1, 'pcs', 72000, '2021-05-17 01:52:18', '2021-05-17 01:52:18'),
('J2105010', 'BUK5', 1, 'pcs', 180000, '2021-05-17 01:52:18', '2021-05-17 01:52:18'),
('J2105011', 'MUS1', 1, 'pcs', 190000, NULL, NULL),
('J2105013', 'MUS1', 1, 'pcs', 190000, NULL, NULL),
('J2105013', 'MMI2', 1, 'pcs', 220000, NULL, NULL),
('J2105016', 'MMI2', 1, 'pcs', 220000, NULL, NULL),
('J2105016', 'MUS1', 1, 'pcs', 190000, NULL, NULL),
('J2105016', 'SMU4', 1, 'pcs', 72000, NULL, NULL),
('J2105016', 'SLA3', 1, 'pcs', 42000, NULL, NULL),
('J2105016', 'BUK5', 1, 'pcs', 180000, NULL, NULL),
('J2105009', 'MMI2', 1, 'pcs', 220000, NULL, NULL),
('J2105010', 'MMI2', 8, 'pcs', 220000, NULL, NULL),
('J2105011', 'MMI2', 8, 'pcs', 190000, NULL, NULL),
('J2105011', 'SLA3', 3, 'pcs', 36000, NULL, NULL),
('J2105012', 'MUS1', 700, 'pcs', 190000, NULL, NULL),
('J2208001', 'MMI2', 23, 'pcs', 220000, NULL, NULL),
('J2208001', 'SLA3', 24, 'pcs', 42000, NULL, NULL),
('J2208002', 'BUK5', 8, 'pcs', 160000, NULL, NULL),
('J2303001', 'MUS1', 22, 'pcs', 230000, NULL, NULL),
('J2303003', 'BUK5', 222, 'pcs', 200000, NULL, NULL),
('J2303004', 'MUS1', 10, 'pcs', 230000, '2023-03-22 06:04:48', '2023-03-22 06:04:48'),
('J2303005', 'MUS1', 10, 'pcs', 230000, NULL, NULL),
('J2303006', 'MUS1', 100, 'pcs', 230000, NULL, NULL),
('J2303007', 'MUS1', 10, 'pcs', 230000, NULL, NULL),
('J2303008', 'MUS1', 10, 'pcs', 230000, NULL, NULL);

--
-- Trigger `detail_barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `in_kutus` AFTER INSERT ON `detail_barang_keluar` FOR EACH ROW BEGIN

SET @id_prod = NEW.produk_id;

SET @jum = NEW.jumlah;

CALL tambah_kutus(@id_prod, @jum);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurang_stok` AFTER INSERT ON `detail_barang_keluar` FOR EACH ROW BEGIN
SET @id = NEW.produk_id;

SET @jum = NEW.jumlah;

UPDATE `produk` SET `jumlah_stok`= jumlah_stok - @jum WHERE produk_id = @id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_barang_masuk`
--

CREATE TABLE `detail_barang_masuk` (
  `invoice_id` varchar(7) NOT NULL,
  `produk_id` varchar(4) NOT NULL,
  `jumlah` int(5) NOT NULL,
  `satuan_id` varchar(4) NOT NULL,
  `harga` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_barang_masuk`
--

INSERT INTO `detail_barang_masuk` (`invoice_id`, `produk_id`, `jumlah`, `satuan_id`, `harga`) VALUES
('B210401', 'MMI2', 2, 'pcs', 250000),
('B210402', 'SMU4', 2, 'pcs', 75000),
('B210403', 'BUK5', 2, 'pcs', 200000),
('B210404', 'MUS1', 2, 'pcs', 230000),
('B210405', 'SLA3', 2, 'pcs', 45000),
('B210501', 'MUS1', 100, 'pcs', 230000),
('B210502', 'MMI2', 100, 'pcs', 250000),
('B210502', 'SLA3', 100, 'pcs', 45000),
('B210502', 'SLA3', 100, 'pcs', 45000),
('B210502', 'BUK5', 100, 'pcs', 200000),
('B210503', 'MUS1', 1, 'pcs', 230000),
('B210504', 'MUS1', 100, 'pcs', 230000),
('B210504', 'MMI2', 100, 'pcs', 250000),
('B210504', 'SLA3', 100, 'pcs', 45000),
('B210504', 'SMU4', 100, 'pcs', 75000),
('B210504', 'BUK5', 100, 'pcs', 200000),
('B210505', 'MUS1', 11, 'pcs', 230000),
('B210505', 'MMI2', 11, 'pcs', 250000),
('B210506', 'SLA3', 10, 'pcs', 45000),
('B210506', 'BUK5', 11, 'pcs', 200000),
('B210507', 'MUS1', 11, 'pcs', 230000),
('B210507', 'MMI2', 11, 'pcs', 250000),
('B210507', 'SLA3', 11, 'pcs', 45000),
('B210508', 'SMU4', 7, 'pcs', 75000),
('B210509', 'SLA3', 100, 'pcs', 45000),
('B210509', 'MUS1', 100, 'pcs', 230000),
('B210509', 'MMI2', 100, 'pcs', 250000),
('B210509', 'SMU4', 100, 'pcs', 75000),
('B210509', 'BUK5', 100, 'pcs', 200000),
('B210510', 'BUK5', 100, 'pcs', 200000),
('B210511', 'MUS1', 100, 'pcs', 230000),
('B210511', 'BUK5', 100, 'pcs', 200000),
('B210512', 'MUS1', 1, 'pcs', 230000),
('B210512', 'MUS1', 1, 'pcs', 230000),
('B210512', 'SLA3', 1, 'pcs', 45000),
('B210512', 'SMU4', 1, 'pcs', 75000),
('B210512', 'BUK5', 1, 'pcs', 200000),
('B210513', 'MUS1', 1, 'pcs', 230000),
('B210513', 'MMI2', 1, 'pcs', 250000),
('B210513', 'SLA3', 1, 'pcs', 45000),
('B210513', 'SMU4', 1, 'pcs', 75000),
('B210513', 'BUK5', 1, 'pcs', 200000),
('B210514', 'MUS1', 1, 'pcs', 230000),
('B210515', 'MUS1', 1, 'pcs', 230000),
('B210516', 'MUS1', 100, 'pcs', 230000),
('B210517', 'MMI2', 100, 'pcs', 250000),
('B210518', 'SLA3', 100, 'pcs', 45000),
('B210519', 'SLA3', 8, 'pcs', 45000),
('B210520', 'SLA3', 8, 'pcs', 45000),
('B210521', 'MMI2', 8, 'pcs', 250000),
('B210521', 'SMU4', 8, 'pcs', 75000),
('B210522', 'MMI2', 8, 'pcs', 250000),
('B210522', 'SMU4', 8, 'pcs', 75000),
('B210523', 'BUK5', 100, 'pcs', 200000),
('B210523', 'SMU4', 100, 'pcs', 75000),
('B210523', 'MUS1', 100, 'pcs', 230000),
('B210524', 'SLA3', 7, 'pcs', 45000),
('B210524', 'MMI2', 8, 'pcs', 250000),
('B210525', 'MUS1', 700, 'pcs', 230000),
('B210526', 'MMI2', 1000, 'pcs', 250000),
('B220801', 'MUS1', 701, 'pcs', 230000),
('B230301', 'BUK5', 1, 'pcs', 200000),
('B230302', 'MMI2', 10, 'pcs', 250000),
('B230301', 'MUS1', 10, 'pcs', 230000),
('B230302', 'BUK5', 10, 'pcs', 20000),
('B230303', 'MMI2', 10, 'pcs', 230000);

--
-- Trigger `detail_barang_masuk`
--
DELIMITER $$
CREATE TRIGGER `tambah_stok` AFTER INSERT ON `detail_barang_masuk` FOR EACH ROW BEGIN
SET @id = NEW.produk_id;

SET @jum = NEW.jumlah;

UPDATE `produk` SET `jumlah_stok`= jumlah_stok + @jum WHERE produk_id = @id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `grade`
--

CREATE TABLE `grade` (
  `grade_id` varchar(2) NOT NULL,
  `jenis_grade` varchar(15) NOT NULL,
  `produk_id` varchar(4) NOT NULL,
  `potongan` int(6) NOT NULL,
  `status_del` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `grade`
--

INSERT INTO `grade` (`grade_id`, `jenis_grade`, `produk_id`, `potongan`, `status_del`) VALUES
('G1', 'Reseller', 'MUS1', 0, 1),
('G1', 'Reseller', 'MMI2', 0, 1),
('G1', 'Reseller', 'SLA3', 0, 1),
('G1', 'Reseller', 'SMU4', 0, 1),
('G1', 'Reseller', 'BUK5', 0, 1),
('G2', 'Depo Perwira', 'MUS1', 0, 1),
('G2', 'Depo Perwira', 'MMI2', 0, 1),
('G2', 'Depo Perwira', 'SLA3', 0, 1),
('G2', 'Depo Perwira', 'SMU4', 0, 1),
('G2', 'Depo Perwira', 'BUK5', 0, 1),
('G3', 'Depo Utama', 'MUS1', 0, 1),
('G3', 'Depo Utama', 'MMI2', 0, 1),
('G3', 'Depo Utama', 'SLA3', 0, 1),
('G3', 'Depo Utama', 'SMU4', 0, 1),
('G3', 'Depo Utama', 'BUK5', 0, 1),
('G4', 'Depo Madya', 'MUS1', 0, 1),
('G4', 'Depo Madya', 'MMI2', 0, 1),
('G4', 'Depo Madya', 'SLA3', 0, 1),
('G4', 'Depo Madya', 'SMU4', 0, 1),
('G4', 'Depo Madya', 'BUK5', 0, 1),
('G5', 'Distributor', 'MUS1', 0, 1),
('G5', 'Distributor', 'MMI2', 0, 1),
('G5', 'Distributor', 'SLA3', 0, 1),
('G5', 'Distributor', 'SMU4', 0, 1),
('G5', 'Distributor', 'BUK5', 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `produk_id` varchar(4) NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `jumlah_stok` int(5) UNSIGNED NOT NULL,
  `satuan_id` varchar(4) NOT NULL,
  `harga_modal` int(6) NOT NULL,
  `harga_jual` int(6) NOT NULL,
  `status_del` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`produk_id`, `nama_produk`, `jumlah_stok`, `satuan_id`, `harga_modal`, `harga_jual`, `status_del`, `updated_at`) VALUES
('MUS1', 'Minyak Kutus - Kutus', 1249, 'pcs', 130000, 230000, 1, '2023-03-22 13:09:20'),
('MMI2', 'Minyak Tanamu Tanami', 1404, 'pcs', 150000, 250000, 1, '2023-03-22 11:30:20'),
('SLA3', 'Sabun Kalila', 541, 'pcs', 25000, 45000, 1, '2022-08-03 04:58:19'),
('SMU4', 'Sabun Tanamu', 896, 'pcs', 35000, 75000, 1, '2021-05-31 06:40:09'),
('BUK5', 'Bubuk Kutus', 20, 'pcs', 10000, 20000, 1, '2023-03-22 11:27:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reseller`
--

CREATE TABLE `reseller` (
  `reseller_id` varchar(6) NOT NULL,
  `nama_reseller` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `total_kutus` int(5) NOT NULL,
  `tanggal_kutus` date NOT NULL,
  `grade_id` varchar(2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reseller`
--

INSERT INTO `reseller` (`reseller_id`, `nama_reseller`, `alamat`, `total_kutus`, `tanggal_kutus`, `grade_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('RL001', 'Juné Plearnpichaya Komalarajun', 'Jl. Jalan setiap minggu', 39, '2021-01-01', 'G1', NULL, NULL, NULL),
('RL002', 'Jaonaay Jinjett Wattanasin', 'Jl. Surapati II no.2', 5, '2021-01-04', 'G1', NULL, NULL, NULL),
('RL003', 'Chutimon Chuengcharoensukying', 'Jalan R. P. Suroso no. 9 kelurahan sukamaju', 13, '2021-01-04', 'G1', NULL, NULL, NULL),
('RL004', 'Chanon Santinatornkul', 'Jalan Serabi kota 45', 3, '2021-01-05', 'G1', NULL, NULL, NULL),
('RL005', 'Hanna Montana', 'Amerika Serikat', 3, '2021-01-05', 'G1', NULL, '2023-03-22 06:05:23', '2023-03-22 06:05:23'),
('RL006', 'Bright Vachirawit', 'Jl. Pad Thai No. 1', 2, '2021-04-25', 'G3', NULL, '2021-05-22 08:55:21', NULL),
('RL007', 'Win Metawin', 'Jl. Maew No. 2', 22, '2021-04-25', 'G1', NULL, NULL, NULL),
('RL008', 'Singto Prachaya', 'Jl. Mango No. 3', 706, '2021-04-21', 'G1', NULL, NULL, NULL),
('RL009', 'Pimchanok Luevisadpaibul', 'Jl. Patthaya', 110, '2021-05-13', 'G5', '2021-05-13 10:03:06', '2021-05-13 10:03:06', NULL),
('RL010', 'HAHAHAHAH', 'jalani semua ini', 0, '2021-05-22', 'G2', '2021-05-22 08:56:45', '2021-05-22 08:56:45', NULL),
('RL011', 'Mei-Mei', 'Jalan Ahmad Yani', 100, '2021-05-28', 'G3', '2021-05-27 22:54:09', '2021-05-27 22:54:09', NULL),
('RL012', 'Nyoman Pagi', 'Gianyar', 20, '2023-03-21', 'G1', '2023-03-21 07:36:34', '2023-03-21 07:36:34', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `satuan_id` varchar(4) NOT NULL,
  `nama_satuan` varchar(10) NOT NULL,
  `status_del` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`satuan_id`, `nama_satuan`, `status_del`) VALUES
('pcs', 'pieces', 1),
('btl', 'botol', 1),
('box', 'box', 1),
('lsn', 'lusin', 1),
('doz', 'dozen', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_opname`
--

CREATE TABLE `stock_opname` (
  `opname_id` varchar(6) NOT NULL,
  `admin_id` varchar(15) NOT NULL,
  `produk_id` varchar(4) NOT NULL,
  `satuan_id` varchar(4) NOT NULL,
  `jumlah_sistem` int(5) NOT NULL,
  `jumlah_hitung` int(5) NOT NULL,
  `perbedaan` int(5) NOT NULL,
  `alasan` text NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `stock_opname`
--

INSERT INTO `stock_opname` (`opname_id`, `admin_id`, `produk_id`, `satuan_id`, `jumlah_sistem`, `jumlah_hitung`, `perbedaan`, `alasan`, `tanggal`, `created_at`, `updated_at`) VALUES
('SO2101', 'owner', 'MUS1', 'pcs', 19, 20, 1, 'Salah hitung', '2021-01-01', NULL, NULL),
('SO2102', 'owner', 'MMI2', 'pcs', 28, 30, 2, 'Barang keselip', '2021-01-01', NULL, NULL),
('SO2103', 'owner', 'SLA3', 'pcs', 45, 40, 5, 'Hilang', '2021-01-01', NULL, NULL),
('SO2104', 'owner', 'SMU4', 'pcs', 42, 40, 2, 'Hilang dicuri', '2021-01-01', NULL, NULL),
('SO2105', 'owner', 'BUK5', 'pcs', 55, 50, 5, 'Hilang', '2021-01-01', NULL, NULL),
('SO2106', 'owner', 'MUS1', 'pcs', 196, 200, -4, 'Salah Hitung', '2021-10-05', '2021-05-10 10:51:58', '2021-05-10 10:51:58'),
('SO2107', 'owner', 'MMI2', 'pcs', 323, 300, 23, 'DIpecahin Preti Kiki Pluto', '2021-05-16', '2021-05-16 01:56:23', '2021-05-16 01:56:23'),
('SO2108', 'owner', 'MUS1', 'pcs', 421, 400, 21, 'Dipecahin Preti Kiki Pluto', '2021-05-17', '2021-05-17 00:57:29', '2021-05-17 00:57:29'),
('SO2109', 'owner', 'SMU4', 'pcs', 231, 780, -549, 'gatau ya', '2021-05-22', '2021-05-22 08:58:25', '2021-05-22 08:58:25'),
('SO2301', 'owner', 'MUS1', 'pcs', 1369, 1370, -1, 'Salah hitung', '2023-03-22', '2023-03-22 02:23:07', '2023-03-22 02:23:07'),
('SO2302', 'owner', 'MUS1', 'pcs', 1270, 1269, 1, 'Salah hitung', '2023-03-22', '2023-03-22 03:49:04', '2023-03-22 03:49:04');

--
-- Trigger `stock_opname`
--
DELIMITER $$
CREATE TRIGGER `apdet_stok` AFTER INSERT ON `stock_opname` FOR EACH ROW BEGIN
SET @id = NEW.produk_id;

SET @jum = NEW.jumlah_hitung;

UPDATE `produk` 
SET `jumlah_stok`= @jum
WHERE produk_id = @id;

END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`nota_id`);

--
-- Indeks untuk tabel `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indeks untuk tabel `stock_opname`
--
ALTER TABLE `stock_opname`
  ADD PRIMARY KEY (`opname_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
