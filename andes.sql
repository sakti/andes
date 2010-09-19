-- phpMyAdmin SQL Dump
-- version 3.3.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 26, 2010 at 03:26 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.2-1ubuntu4.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `andes`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailbrg`
--

CREATE TABLE IF NOT EXISTS `detailbrg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtransaksi` int(11) NOT NULL,
  `namabrg` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `berat` float NOT NULL,
  `idkategori` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idtransaksi` (`idtransaksi`),
  KEY `idkategori` (`idkategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `detailbrg`
--

INSERT INTO `detailbrg` (`id`, `idtransaksi`, `namabrg`, `berat`, `idkategori`) VALUES
(1, 1, 'Acer 4530', 5, 2),
(2, 2, 'FD Kingston 10GB', 1, 2),
(3, 3, 'Aqua galon', 10, 3),
(4, 4, 'jkasdfasdfas', 8, 2),
(5, 4, 'lkjdflsdf', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detailpegpengiriman`
--

CREATE TABLE IF NOT EXISTS `detailpegpengiriman` (
  `id` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `idrute` int(11) NOT NULL,
  `idrutedetail` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idrutedetail` (`idrutedetail`),
  KEY `idrute` (`idrute`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `detailpegpengiriman`
--

INSERT INTO `detailpegpengiriman` (`id`, `idrute`, `idrutedetail`) VALUES
('222222222', 1, 2),
('333333333', 2, 50);

-- --------------------------------------------------------

--
-- Table structure for table `historypengirim`
--

CREATE TABLE IF NOT EXISTS `historypengirim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtransaksi` int(11) NOT NULL,
  `tglwaktu` datetime NOT NULL,
  `idpengirim` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `kcpengambilan` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idtransaksi` (`idtransaksi`),
  KEY `idpengirim` (`idpengirim`),
  KEY `kcpengambilan` (`kcpengambilan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `historypengirim`
--

INSERT INTO `historypengirim` (`id`, `idtransaksi`, `tglwaktu`, `idpengirim`, `kcpengambilan`) VALUES
(1, 1, '2010-05-23 11:07:15', '333333333', 29),
(2, 1, '2010-05-23 11:10:50', '222222222', 2),
(3, 2, '2010-05-25 19:40:36', '222222222', 1),
(4, 2, '2010-05-25 19:41:34', '333333333', 2),
(5, 3, '2010-05-25 19:53:48', '222222222', 1),
(6, 3, '2010-05-25 19:57:28', '333333333', 2),
(7, 4, '2010-05-26 03:12:48', '222222222', 1),
(8, 4, '2010-05-26 03:16:08', '333333333', 2);

-- --------------------------------------------------------

--
-- Table structure for table `historystatus`
--

CREATE TABLE IF NOT EXISTS `historystatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtransaksi` int(11) NOT NULL,
  `idstatus` int(11) NOT NULL,
  `tglwaktu` datetime NOT NULL,
  `idkecamatan` int(11) NOT NULL,
  `idkantorcabang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idtransaksi` (`idtransaksi`),
  KEY `idstatus` (`idstatus`),
  KEY `idkecamatan` (`idkecamatan`),
  KEY `idkantorcabang` (`idkantorcabang`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `historystatus`
--

INSERT INTO `historystatus` (`id`, `idtransaksi`, `idstatus`, `tglwaktu`, `idkecamatan`, `idkantorcabang`) VALUES
(1, 1, 1, '2010-05-23 10:55:33', 14, 29),
(2, 1, 2, '2010-05-23 11:07:15', 14, 29),
(3, 1, 2, '2010-05-23 11:08:06', 3, 27),
(4, 1, 2, '2010-05-23 11:08:21', 4, 28),
(5, 1, 2, '2010-05-23 11:08:40', 22, 31),
(6, 1, 2, '2010-05-23 11:08:47', 13, NULL),
(7, 1, 2, '2010-05-23 11:09:01', 1, 2),
(8, 1, 5, '2010-05-23 11:10:23', 1, 2),
(9, 1, 2, '2010-05-23 11:10:50', 1, 2),
(10, 1, 2, '2010-05-23 11:11:26', 188, 1),
(11, 1, 3, '2010-05-23 11:11:45', 188, 1),
(12, 2, 1, '2010-05-25 19:39:42', 188, 1),
(13, 2, 2, '2010-05-25 19:40:36', 188, 1),
(14, 2, 2, '2010-05-25 19:40:55', 1, 2),
(15, 2, 5, '2010-05-25 19:41:14', 1, 2),
(16, 2, 2, '2010-05-25 19:41:34', 1, 2),
(17, 3, 1, '2010-05-25 19:52:18', 188, 1),
(18, 3, 2, '2010-05-25 19:53:48', 188, 1),
(19, 3, 2, '2010-05-25 19:54:07', 32, 3),
(20, 3, 2, '2010-05-25 19:54:19', 1, 2),
(21, 3, 5, '2010-05-25 19:54:52', 1, 2),
(22, 3, 2, '2010-05-25 19:57:28', 1, 2),
(23, 4, 1, '2010-05-26 03:11:04', 188, 1),
(24, 4, 2, '2010-05-26 03:12:48', 188, 1),
(25, 4, 2, '2010-05-26 03:13:37', 32, 3),
(26, 4, 2, '2010-05-26 03:13:58', 1, 2),
(27, 4, 5, '2010-05-26 03:14:28', 1, 2),
(28, 4, 2, '2010-05-26 03:16:08', 1, 2),
(29, 2, 2, '2010-05-26 03:16:37', 14, 29),
(30, 3, 2, '2010-05-26 03:16:37', 14, 29),
(31, 4, 2, '2010-05-26 03:16:38', 14, 29),
(32, 4, 3, '2010-05-26 03:17:01', 14, 29);

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE IF NOT EXISTS `kabupaten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id`, `nama`) VALUES
(1, 'bandung'),
(2, 'bekasi'),
(3, 'bogor'),
(4, 'ciamis'),
(5, 'cianjur'),
(6, 'cirebon'),
(7, 'garut'),
(8, 'indramayu'),
(9, 'karawang'),
(10, 'kuningan'),
(11, 'majalengka'),
(12, 'purwakarta'),
(13, 'subang'),
(14, 'sukabumi'),
(15, 'sumedang'),
(16, 'tasikmalaya'),
(17, 'kota bandung'),
(18, 'kota banjar'),
(19, 'kota bekasi'),
(20, 'kota bogor'),
(21, 'kota cimahi'),
(22, 'kota cirebon'),
(23, 'kota depok'),
(24, 'kota sukabumi'),
(25, 'kota tasikmalaya');

-- --------------------------------------------------------

--
-- Table structure for table `kantorcabang`
--

CREATE TABLE IF NOT EXISTS `kantorcabang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `idkecamatan` int(11) NOT NULL,
  `detalamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notelp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idkecamatan` (`idkecamatan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `kantorcabang`
--

INSERT INTO `kantorcabang` (`id`, `nama`, `idkecamatan`, `detalamat`, `notelp`) VALUES
(1, 'Pusat Kota Bandung', 188, 'jl antix dd ikenai', '022 231232123'),
(2, 'Pusat Kab Bandung', 1, 'jl arsajari no 2312 ', '022 32334342'),
(3, 'Pusat Kab Bekasi', 32, 'jl gggge no 232', '034 1233123'),
(4, 'Pusat Kab Bogor', 47, 'jl adipati ungkur no 39', '04233434323'),
(5, 'Pusat Kab Ciamis', 54, 'jl sss skdf jksaf  no 34', '032 342343'),
(6, 'Pusat Kab Cianjur', 66, 'jl semetan gg adi sd no 32', '023 323421'),
(7, 'Pusat Kab Cirebon', 78, 'jl muara putih no 4', '042 321233'),
(8, 'Pusat Kab Garut', 82, 'jl merdeka baru no 39', '042 322331'),
(9, 'Pusat Kab Indramayu', 92, 'jl natajna no 43', '025 234231'),
(10, 'Pusat Kab Karawang', 102, 'jl batu empuk no 49\n', '025 323412'),
(11, 'Pusat Kab Kuningan', 112, 'jl merbabu meledak no 4', '032 34212'),
(12, 'Pusat Kab Majalengka', 122, 'jl gapura no 95', '041 342434'),
(13, 'Pusat Kab Purwakarta', 132, 'jl senam sk no 32', '026 321231'),
(14, 'Pusat Kab Subang', 142, 'jl dagelan no 73', '042 3423'),
(15, 'Pusat Kab Sukabumi', 152, 'jl asdfg no 32', '025 232123'),
(16, 'Pusat Kab Sumedang', 162, 'jl buah manis no 32', '023 384382'),
(17, 'Pusat Kab Tasikmalaya', 177, 'jl kampret dua no 34', '026 837472'),
(18, 'Pusat Kota Banjar', 197, 'jl acer no 34', '0343 334453'),
(19, 'Pusat Kota Bekasi', 201, 'jl parfum wangi no 32', '028 830483'),
(20, 'Pusat Kota Bogor', 211, 'jl katamso no 34', '042 032848'),
(21, 'Pusat Kota Cimahi', 217, 'jl ahmad yani no 323', '032 234413'),
(22, 'Pusat Kota Cirebon', 220, 'jl ahmad dahlan no 3', '043 431234'),
(23, 'Pusat Kota Depok', 225, 'jl biji no 432', '032 321233'),
(24, 'Pusat Kota Sukabumi', 235, 'jl mario no 32', '042 231244'),
(25, 'Pusat Kota Tasikmalaya', 242, 'jl merdeka selatan no 423', '042 4213498'),
(26, 'Baleendah Bandung', 2, 'jl kladjflas dsdf ds', '022 33123'),
(27, 'Banjaran bandung', 3, 'jl lasjhfsjdf', '022 232123'),
(28, 'Bojongsoang Bandung', 4, 'jl asdfnasdf jasdhfjkashdf  no 2', '022 42343'),
(29, 'Dayeuhkolot Bandung', 14, 'jl lldfasd sfsadf sdf no 4', '022 429384'),
(30, 'Margaasih Bandung', 20, 'jl asdf adf lkjkh h 3', '022 334334'),
(31, 'Nagreg Bandung', 22, 'jl lksjoipn jkjhj no 32', '022 423434'),
(32, 'Pangalengan Bandung', 25, 'jl jkgjh fjhd fjg no 65', '022 982342'),
(33, 'Andir Kota Bandung', 187, 'jl andiran dno a no 3', '022 483399'),
(34, 'Batununggal Kota Bandung', 195, 'jl kjhd asf sdf no 3', '022 08343'),
(35, 'Bandung Wetan kota Bandung', 194, 'jl sadf adfsdf df no 3', '022 432343'),
(36, 'KC Babelan bekasi', 32, 'jl merdeka semua no 39', '03232323');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE IF NOT EXISTS `kecamatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idkabupaten` int(11) NOT NULL,
  `nama` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idkabupaten` (`idkabupaten`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=252 ;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `idkabupaten`, `nama`, `lat`, `lon`) VALUES
(1, 1, 'arjasari', -7.06, 107.65),
(2, 1, 'baleendah', -7.01, 107.63),
(3, 1, 'banjaran', -7.06, 107.59),
(4, 1, 'bojongsoang', -6.99, 107.65),
(5, 1, 'cangkuang', -7.03, 107.57),
(6, 1, 'cicalengka', -7, 107.86),
(7, 1, 'cikancung', -7.04, 107.83),
(8, 1, 'cilengkrang', -6.89, 107.73),
(9, 1, 'cileunyi', -6.93, 107.73),
(10, 1, 'cimaung', -7.09, 107.57),
(11, 1, 'cimenyan', -6.87, 107.67),
(12, 1, 'ciparay', -7.03, 107.71),
(13, 1, 'ciwidey', -7.1, 107.46),
(14, 1, 'dayeuhkolot', -6.67, 107.65),
(15, 1, 'ibun', -7.12, 107.76),
(16, 1, 'katapang', -7, 107.55),
(17, 1, 'kertasari', -7.23, 107.66),
(18, 1, 'kutawaringin', -7.34, 107.95),
(19, 1, 'majalaya', -7.06, 107.75),
(20, 1, 'margaasih', -6.94, 107.56),
(21, 1, 'margahayu', -6.95, 107.59),
(22, 1, 'nagreg', -7.01, 107.89),
(23, 1, 'pacet', -6.72, 107.03),
(24, 1, 'pameungpeuk', -7.02, 107.6),
(25, 1, 'pangalengan', -7.16, 107.61),
(26, 1, 'paseh', -7.07, 107.79),
(27, 1, 'pasirjambu', -7.25, 107.16),
(28, 1, 'rancabali', -7.4, 107.18),
(29, 1, 'rancaekek', -6.95, 107.77),
(30, 1, 'solokan jeruk', -7.01, 107.74),
(31, 1, 'soreang', -6.97, 107.54),
(32, 2, 'babelan', -6.12, 107.03),
(33, 2, 'bojongmanggu', -6.42, 107.2),
(34, 2, 'cabangbungin', -6.05, 107.14),
(35, 2, 'cibarusah', -6.43, 107.15),
(36, 2, 'cibitung', -6.2, 107.11),
(37, 2, 'cikarang barat', -6.25, 107.16),
(38, 2, 'cikarang pusat', -6.25, 107.16),
(39, 2, 'cikarang selatan', -6.25, 107.16),
(40, 2, 'cikarang timur', -6.25, 107.16),
(41, 2, 'cikarang utara', -6.25, 107.16),
(42, 3, 'babakan madang', -6.55, 106.88),
(43, 3, 'bojonggede', -6.48, 106.81),
(44, 3, 'caringin', -6.7, 106.82),
(45, 3, 'cariu', -6.53, 107.11),
(46, 3, 'ciampea', -6.54, 106.7),
(47, 3, 'ciawi', -6.64, 106.84),
(48, 3, 'cibinong', -6.48, 106.85),
(49, 3, 'cibungbulang', -6.63, 106.67),
(50, 3, 'cigombong', -6.74, 106.79),
(51, 3, 'cigudeg', -6.54, 106.56),
(52, 4, 'banjarsari', -7.47, 108.63),
(53, 4, 'baregbeg', -7.32, 108.38),
(54, 4, 'ciamis', -7.33, 108.37),
(55, 4, 'cidolog', -7.3, 106.84),
(56, 4, 'cihaurbeuti', -7.17, 108.24),
(57, 4, 'cijeungjing', -7.33, 108.43),
(58, 4, 'cijulang', 7.73, 108.48),
(59, 4, 'cikoneng', 7.32, 108.28),
(60, 4, 'cimaragas', -7.38, 108.45),
(61, 4, 'cimerak', 7.74, 108.42),
(62, 5, 'argabinta', -6.85, 107.22),
(63, 5, 'bojongpicung', -6.86, 107.27),
(64, 5, 'campaka', -6.52, 107.49),
(65, 5, 'capmpaka mulya', -7.1, 107.59),
(66, 5, 'cianjur', -6.81, 107.15),
(67, 5, 'cibeber', -6.95, 107.14),
(68, 5, 'cibinong', -6.57, 107.41),
(69, 5, 'cidaun', -7.49, 107.35),
(70, 5, 'cijati', -7.26, 107.02),
(71, 5, 'cikadu', -7.33, 107.28),
(72, 6, 'arjawinangun', -6.65, 108.41),
(73, 6, 'astanajapura', -6.79, 108.65),
(74, 6, 'babakan', -6.86, 108.73),
(75, 6, 'beber', -6.82, 108.53),
(76, 6, 'ciledug', -6.91, 108.75),
(77, 6, 'ciwaringin', -6.7, 108.39),
(78, 6, 'depok', -6.4, 106.83),
(79, 6, 'dukupuntang', -6.77, 108.42),
(80, 6, 'gunungjati', -7.13, 109.19),
(81, 6, 'gebang', -7.65, 110),
(82, 7, 'banjarwangi', -7.42, 107.9),
(83, 7, 'banyuresmi', -7.16, 107.95),
(84, 7, 'bayongbong', -7.27, 107.83),
(85, 7, 'balubur limbangan', -7.04, 107.98),
(86, 7, 'bungbulang', -7.44, 107.62),
(87, 7, 'caringin', -7.48, 107.52),
(88, 7, 'cibalong', -7.65, 107.85),
(89, 7, 'cibatu', -7.11, 107.97),
(90, 7, 'cibiuk', -7.08, 107.97),
(91, 7, 'cigedug', -7.33, 107.82),
(92, 8, 'anjatan', -6.35, 107.99),
(93, 8, 'arahan', -6.38, 108.26),
(94, 8, 'balongan', -6.36, 108.37),
(95, 8, 'bangodua', -6.53, 108.32),
(96, 8, 'bongas', -6.39, 108.01),
(97, 8, 'cantigi', -6.34, 108.24),
(98, 8, 'cikedung', -6.5, 108.17),
(99, 8, 'gabuswetan', -6.43, 108.08),
(100, 8, 'gantar', -6.5, 107.99),
(101, 8, 'haurgeulis', -6.47, 107.97),
(102, 9, 'batujaya', -6.06, 107.19),
(103, 9, 'banyusari', -7.01, 107.58),
(104, 9, 'ciampel', -6.92, 108.86),
(105, 9, 'cibuaya', -6.04, 107.36),
(106, 9, 'cikampek', -6.37, 107.46),
(107, 9, 'cilamaya kulon', -6.22, 107.59),
(108, 9, 'cilamaya wetan', -6.22, 107.59),
(109, 9, 'cilebar', -6.13, 107.41),
(110, 9, 'jatisari', -6.31, 107.52),
(111, 9, 'jayakerta', -6.08, 107.31),
(112, 10, 'ciawigebang', -6.97, 108.58),
(113, 10, 'cibeureum', -7.19, 107.66),
(114, 10, 'cibingbin', -7.06, 108.78),
(115, 10, 'cidahu', -6.98, 108.5),
(116, 10, 'cigandamekar', -6.98, 108.5),
(117, 10, 'cigugur', -6.96, 108.47),
(118, 10, 'cilebak', -7.14, 108.58),
(119, 10, 'cilimus', -6.87, 108.51),
(120, 10, 'cimahi', -7, 108.71),
(121, 10, 'ciniru', -7.04, 108.51),
(122, 11, 'argapura', -6.89, 108.36),
(123, 11, 'banjaran', -6.88, 108.29),
(124, 11, 'bantarujeg', -6.97, 108.25),
(125, 11, 'cigasong', -6.84, 108.26),
(126, 11, 'cikijing', -7.03, 108.37),
(127, 11, 'cingambul', -7.05, 108.36),
(128, 11, 'dawuan', -6.76, 108.19),
(129, 11, 'jatitujuh', -6.65, 108.23),
(130, 11, 'jatiwangi', -6.72, 108.24),
(131, 11, 'kadipaten', -6.77, 108.17),
(132, 12, 'babakancikao', -6.52, 107.43),
(133, 12, 'bojong', -6.7, 107.51),
(134, 12, 'bungursari', -6.48, 107.46),
(135, 12, 'campaka', -6.51, 107.5),
(136, 12, 'cibatu', -6.49, 107.53),
(137, 12, 'darangdan', -6.67, 107.43),
(138, 12, 'jatiluhur', -6.53, 107.42),
(139, 12, 'kiarapedes', -6.64, 107.57),
(140, 12, 'maniis', -6.64, 107.57),
(141, 12, 'pesawahan', -6.59, 107.49),
(142, 13, 'binong', -6.42, 107.79),
(143, 13, 'blanakan', -6.28, 107.66),
(144, 13, 'ciasem', -6.34, 107.66),
(145, 13, 'cibogo', -6.55, 107.82),
(146, 13, 'cijambe', -6.63, 107.72),
(147, 13, 'cikaum', -6.44, 107.74),
(148, 13, 'cipeundeuy', -6.5, 107.58),
(149, 13, 'cipunagara', -6.46, 107.83),
(150, 13, 'cisalak', -6.71, 107.77),
(151, 13, 'compreng', -6.38, 107.87),
(152, 14, 'bantargadung', -6.98, 106.7),
(153, 14, 'bojong genteng', -6.83, 106.73),
(154, 14, 'caringin', -6.91, 106.42),
(155, 14, 'ciambar', -6.82, 106.79),
(156, 14, 'cibadak', -6.88, 106.78),
(157, 14, 'cibitung', -7.16, 106.92),
(158, 14, 'cicantayan', -6.9, 106.84),
(159, 14, 'cicurug', -6.78, 106.79),
(160, 14, 'cidadap', -7.24, 106.95),
(161, 14, 'cidahu', -6.75, 106.74),
(162, 15, 'buahdua', -6.68, 107.96),
(163, 15, 'cibugel', -6.96, 108.03),
(164, 15, 'cimalaka', -6.8, 107.99),
(165, 15, 'cimanggu', -6.95, 107.85),
(166, 15, 'cisarua', -6.83, 107.97),
(167, 15, 'cisitu', -6.88, 108.06),
(168, 15, 'conggeang', -6.72, 108.04),
(169, 15, 'darmaraja', -6.92, 108.07),
(170, 15, 'ganeas', -6.87, 107.98),
(171, 15, 'jatigede', -6.7, 107.8),
(172, 15, 'jatinangor', -6.93, 107.77),
(173, 15, 'jatinunggal', -6.93, 107.77),
(174, 15, 'pamulihan', -6.87, 107.82),
(175, 15, 'paseh', -6.79, 108.03),
(176, 15, 'rancakalong', -6.82, 107.82),
(177, 16, 'bantarkalong', -7.65, 108.07),
(178, 16, 'bojong asih', -7.57, 108.11),
(179, 16, 'bojonggambir', -7.54, 107.97),
(180, 16, 'ciawi', -7.17, 108.16),
(181, 16, 'cibalong', -7.51, 108.18),
(182, 16, 'cigalontang', -7.29, 108.01),
(183, 16, 'cikalong', -7.74, 108.2),
(184, 16, 'cikatomas', -7.62, 108.28),
(185, 16, 'cineam', -7.39, 108.35),
(186, 16, 'cipatujah', -7.72, 108.03),
(187, 17, 'andir', -6.91, 107.58),
(188, 17, 'antapani', -6.92, 107.67),
(189, 17, 'arcamanik', -6.91, 107.68),
(190, 17, 'astanaanyar', -6.94, 107.61),
(191, 17, 'babakanciparay', -6.94, 107.59),
(192, 17, 'bandung kidul', -6.95, 107.64),
(193, 17, 'bandung kulon', -6.93, 107.58),
(194, 17, 'bandung wetan', -6.9, 107.63),
(195, 17, 'batununggal', -6.93, 107.65),
(196, 17, 'bojongloa kaler', -6.93, 107.6),
(197, 18, 'banjar', -7.67, 108.78),
(198, 18, 'langensari', -7.36, 108.62),
(199, 18, 'pataruman', -7.4, 108.7),
(200, 18, 'purwaharja', -7.1, 108.5),
(201, 19, 'bantar gebang', -6.31, 107),
(202, 19, 'bekasi barat', -6.2, 106.98),
(203, 19, 'bekasi selatan', -6.24, 106.99),
(204, 19, 'bekasi timur', -6.25, 107.02),
(205, 19, 'bekasi utara', -6.18, 107.01),
(206, 19, 'jati asih', -6.27, 106.97),
(207, 19, 'jati sampurna', -6.33, 106.93),
(208, 19, 'medan satria', -6.18, 106.99),
(209, 19, 'mustika jaya', -6.29, 107.03),
(210, 19, 'pondok gede', -6.29, 106.94),
(211, 20, 'bogor barat', -6.56, 106.77),
(212, 20, 'bogor selatan', -6.61, 106.82),
(213, 20, 'bogor tengah', -6.57, 106.79),
(214, 20, 'bogor timur', -6.6, 106.82),
(215, 20, 'bogor utara', -6.56, 106.8),
(216, 20, 'tanah sareal', -6.56, 106.79),
(217, 21, 'cimahi selatan', -6.9, 107.57),
(218, 21, 'cimahi tengah', -6.87, 107.56),
(219, 21, 'cimahi utara', -6.86, 107.57),
(220, 22, 'harjamukti', -6.76, 108.53),
(221, 22, 'kejaksan', -6.73, 108.57),
(222, 22, 'kesambi', -6.74, 108.56),
(223, 22, 'lemahwungkuk', -6.73, 108.58),
(224, 22, 'pekalipan', -6.73, 108.57),
(225, 23, 'beji', -6.37, 106.82),
(226, 23, 'bojongsari', -6.39, 106.76),
(227, 23, 'cilodong', -6.44, 106.84),
(228, 23, 'cimanggis', -6.39, 106.89),
(229, 23, 'cipayung', -6.33, 106.91),
(230, 23, 'cinere', -6.33, 106.78),
(231, 23, 'limo', -6.35, 106.77),
(232, 23, 'pancoran mas', -6.39, 106.81),
(233, 23, 'sawangan', -6.4, 106.77),
(234, 23, 'sukmajaya', -6.4, 106.85),
(235, 24, 'baros', -6.96, 106.95),
(236, 24, 'cibeureum', -6.93, 106.95),
(237, 24, 'cikole', -6.9, 106.93),
(238, 24, 'citamiang', -6.93, 106.92),
(239, 24, 'gunungpuyuh', -6.91, 106.91),
(240, 24, 'lembursitu', -6.96, 106.87),
(241, 24, 'warudoyong', -6.93, 106.92),
(242, 25, 'bungursari', -6.48, 107.46),
(243, 25, 'cibeureum', -7.38, 108.27),
(244, 25, 'cihideung', -7.35, 108.22),
(245, 25, 'cipedes', -7.3, 108.21),
(246, 25, 'indihiang', -7.3, 108.19),
(247, 25, 'kawalu', -7.39, 108.2),
(248, 25, 'mangkubumi', -7.36, 108.2),
(249, 25, 'purbaratu', -7.35, 108.26),
(250, 25, 'tamansari', -7.41, 108.26),
(251, 25, 'tawang', -7.34, 108.23);

-- --------------------------------------------------------

--
-- Table structure for table `keluhantransaksi`
--

CREATE TABLE IF NOT EXISTS `keluhantransaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idtransaksi` int(11) NOT NULL,
  `tglwaktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  `stat` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idtransaksi` (`idtransaksi`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `keluhantransaksi`
--

INSERT INTO `keluhantransaksi` (`id`, `idtransaksi`, `tglwaktu`, `deskripsi`, `stat`) VALUES
(1, 1, '2010-05-23 11:12:46', 'Sip dah cepet buanget', 'closed'),
(2, 4, '2010-05-26 03:17:58', 'kok ngga nyampe2?', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `id` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `jk` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `tgllahir` date NOT NULL,
  `jabatan` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `notelp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `idkantorcabang` int(11) NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idkantorcabang` (`idkantorcabang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id`, `nama`, `jk`, `tgllahir`, `jabatan`, `notelp`, `idkantorcabang`, `password`) VALUES
('111111111', 'Alessandro Nesta', 'l', '1980-01-10', 'customer service', '082837387394', 1, 'c4ca4238a0b923820dcc509a6f75849b'),
('222222222', 'Nicolas Anelka', 'l', '1980-11-11', 'peg. pengiriman', '232323231233', 1, 'c81e728d9d4c2f636f067f89cc14862c'),
('333333333', 'F. Lampard', 'l', '1983-05-18', 'peg. pengiriman', '081232343433', 29, 'eccbc87e4b5ce2fe28308fd9f2a7baf3'),
('444444444', 'Nicole', 'p', '1990-05-08', 'customer service', '032234123232', 29, 'a87ff679a2f3e71d9181a67b7542122c'),
('613081029', 'Sakti Dwi Cahyono', 'l', '1990-10-01', 'administratif', '081914947566', 1, '40ec350d9282eafa93ecc79c57777528');

-- --------------------------------------------------------

--
-- Table structure for table `perhitunganbiaya`
--

CREATE TABLE IF NOT EXISTS `perhitunganbiaya` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jarak` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `asuransi` float NOT NULL,
  `kategori` int(11) NOT NULL,
  `kilat` float NOT NULL,
  `digunakan` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `perhitunganbiaya`
--

INSERT INTO `perhitunganbiaya` (`id`, `jarak`, `berat`, `asuransi`, `kategori`, `kilat`, `digunakan`) VALUES
(1, 100, 1, 0.1, 1, 2, 'y');

-- --------------------------------------------------------

--
-- Table structure for table `responkeluhan`
--

CREATE TABLE IF NOT EXISTS `responkeluhan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idkeluhan` int(11) NOT NULL,
  `idpegawai` int(11) DEFAULT NULL,
  `tglwaktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deskripsi` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idkeluhan` (`idkeluhan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `responkeluhan`
--

INSERT INTO `responkeluhan` (`id`, `idkeluhan`, `idpegawai`, `tglwaktu`, `deskripsi`) VALUES
(1, 1, 613081029, '2010-05-23 11:16:25', 'Tentu dunks..\n>-<'),
(2, 1, NULL, '2010-05-23 11:16:51', 'selamat ya gan, tetap dijaga'),
(3, 1, NULL, '2010-05-23 13:39:20', 'heheheh dsf\n\n\nsadfasd\nfasdf'),
(4, 1, 613081029, '2010-05-23 13:39:52', 'xdsfa asfas dfasdfasd'),
(5, 1, 613081029, '2010-05-23 13:40:01', 'sfasdfasd fdghsgdf'),
(6, 1, 613081029, '2010-05-26 03:07:38', 'ya ...\n\n\n\n\n..'),
(7, 2, 613081029, '2010-05-26 03:18:33', 'jlnnya banjir'),
(8, 2, NULL, '2010-05-26 03:18:44', 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `rute`
--

CREATE TABLE IF NOT EXISTS `rute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `rute`
--

INSERT INTO `rute` (`id`, `nama`) VALUES
(1, 'Antar Pusat Kab/Kota'),
(2, 'Intra Kab Bandung'),
(3, 'Intra Kota Bandung');

-- --------------------------------------------------------

--
-- Table structure for table `rutedetail`
--

CREATE TABLE IF NOT EXISTS `rutedetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idrute` int(11) NOT NULL,
  `idkecamatan` int(11) NOT NULL,
  `idkantorcabang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idkecamatan` (`idkecamatan`),
  KEY `idkantorcabang` (`idkantorcabang`),
  KEY `idrute` (`idrute`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=78 ;

--
-- Dumping data for table `rutedetail`
--

INSERT INTO `rutedetail` (`id`, `idrute`, `idkecamatan`, `idkantorcabang`) VALUES
(1, 1, 188, 1),
(2, 1, 1, 2),
(3, 1, 32, 3),
(4, 1, 47, 4),
(5, 1, 54, 5),
(6, 1, 66, 6),
(7, 1, 78, 7),
(8, 1, 82, 8),
(9, 1, 92, 9),
(10, 1, 102, 10),
(11, 1, 112, 11),
(12, 1, 122, 12),
(13, 1, 132, 13),
(14, 1, 142, 14),
(15, 1, 152, 15),
(16, 1, 162, 16),
(17, 1, 177, 17),
(18, 1, 197, 18),
(19, 1, 201, 19),
(20, 1, 211, 20),
(21, 1, 217, 21),
(22, 1, 220, 22),
(23, 1, 225, 23),
(24, 1, 235, 24),
(25, 1, 242, 25),
(46, 2, 1, 2),
(47, 2, 2, 26),
(48, 2, 3, 27),
(49, 2, 4, 28),
(50, 2, 14, 29),
(51, 2, 20, 30),
(52, 2, 22, 31),
(53, 2, 25, 32),
(54, 2, 5, NULL),
(55, 2, 6, NULL),
(56, 2, 7, NULL),
(57, 2, 8, NULL),
(58, 2, 9, NULL),
(59, 2, 10, NULL),
(60, 2, 11, NULL),
(61, 2, 12, NULL),
(62, 2, 13, NULL),
(63, 2, 15, NULL),
(64, 2, 16, NULL),
(65, 2, 17, NULL),
(66, 2, 18, NULL),
(67, 2, 19, NULL),
(68, 2, 26, NULL),
(69, 3, 188, 1),
(70, 3, 187, 33),
(71, 3, 194, 35),
(72, 3, 189, NULL),
(73, 3, 190, NULL),
(74, 3, 191, NULL),
(75, 3, 192, NULL),
(76, 3, 193, NULL),
(77, 3, 196, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblkategori`
--

CREATE TABLE IF NOT EXISTS `tblkategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `bobot` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tblkategori`
--

INSERT INTO `tblkategori` (`id`, `deskripsi`, `bobot`) VALUES
(1, 'dokumen', 3),
(2, 'barang elektronik', 7),
(3, 'bahan makanan', 6),
(4, 'garmen', 2),
(5, 'obat-obatan legal', 5),
(6, 'kendaraan bermotor', 8),
(7, 'spare part', 6),
(8, 'furnitur', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tblstatus`
--

CREATE TABLE IF NOT EXISTS `tblstatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deskripsi` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tblstatus`
--

INSERT INTO `tblstatus` (`id`, `deskripsi`) VALUES
(1, 'belum dikirim'),
(2, 'sedang dikirim'),
(3, 'diterima'),
(4, 'dititipkan'),
(5, 'dikantorcabang');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE IF NOT EXISTS `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `namapengirim` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `notelppengirim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `idkecpengirim` int(11) NOT NULL,
  `detalamatpengirim` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `namapenerima` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `notelppenerima` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `idkecpenerima` int(11) NOT NULL,
  `detalamatpenerima` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idcs` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `idpengirim` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idstatus` int(11) NOT NULL,
  `biaya` bigint(20) NOT NULL,
  `asuransi` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `kilat` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `infopenerima` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `poskc` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idkecpengirim` (`idkecpengirim`),
  KEY `idkecpenerima` (`idkecpenerima`),
  KEY `idcs` (`idcs`),
  KEY `idpengirim` (`idpengirim`),
  KEY `idstatus` (`idstatus`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `namapengirim`, `notelppengirim`, `idkecpengirim`, `detalamatpengirim`, `namapenerima`, `notelppenerima`, `idkecpenerima`, `detalamatpenerima`, `idcs`, `idpengirim`, `idstatus`, `biaya`, `asuransi`, `kilat`, `infopenerima`, `poskc`) VALUES
(1, 'Soepati', '03432434234', 14, 'jl suraparna no 43', 'Alex saputra', '042312323', 188, 'jl surapati no 43', '444444444', '222222222', 3, 766900, 'y', 'y', 'barang telah diterima oleh orang yang tepat', 1),
(2, 'Shuuji', '03242342', 195, 'jl surabaya no 80', 'Somat', '02323123', 14, 'jl mangga dua no 2323', '111111111', '333333333', 2, 86300, 'y', 'y', '', 29),
(3, 'Sunny', '0819123233', 187, 'jl antah berantah no 93', 'Nanny', '022 09123231', 22, 'jl martapura no 99', '111111111', '333333333', 2, 63600, 'y', 't', '', 29),
(4, 'jjjjjjjjjj', '023212312', 187, 'jl jjjdsfasdf asdf df', 'sdfasdfasdfa', '0323423', 14, 'jl sfasdfa sdfasdf asfasdf', '111111111', '333333333', 3, 1111100, 'y', 'y', 'barang telah terkirim dengan selamat', 29);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailbrg`
--
ALTER TABLE `detailbrg`
  ADD CONSTRAINT `detailbrg_ibfk_1` FOREIGN KEY (`idtransaksi`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `detailbrg_ibfk_2` FOREIGN KEY (`idkategori`) REFERENCES `tblkategori` (`id`);

--
-- Constraints for table `detailpegpengiriman`
--
ALTER TABLE `detailpegpengiriman`
  ADD CONSTRAINT `detailpegpengiriman_ibfk_3` FOREIGN KEY (`idrutedetail`) REFERENCES `rutedetail` (`id`),
  ADD CONSTRAINT `detailpegpengiriman_ibfk_4` FOREIGN KEY (`id`) REFERENCES `pegawai` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detailpegpengiriman_ibfk_5` FOREIGN KEY (`idrute`) REFERENCES `rute` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `historypengirim`
--
ALTER TABLE `historypengirim`
  ADD CONSTRAINT `historypengirim_ibfk_1` FOREIGN KEY (`idtransaksi`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `historypengirim_ibfk_2` FOREIGN KEY (`idpengirim`) REFERENCES `pegawai` (`id`),
  ADD CONSTRAINT `historypengirim_ibfk_3` FOREIGN KEY (`kcpengambilan`) REFERENCES `kantorcabang` (`id`);

--
-- Constraints for table `historystatus`
--
ALTER TABLE `historystatus`
  ADD CONSTRAINT `historystatus_ibfk_1` FOREIGN KEY (`idtransaksi`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `historystatus_ibfk_2` FOREIGN KEY (`idstatus`) REFERENCES `tblstatus` (`id`),
  ADD CONSTRAINT `historystatus_ibfk_3` FOREIGN KEY (`idkecamatan`) REFERENCES `kecamatan` (`id`),
  ADD CONSTRAINT `historystatus_ibfk_4` FOREIGN KEY (`idkantorcabang`) REFERENCES `kantorcabang` (`id`);

--
-- Constraints for table `kantorcabang`
--
ALTER TABLE `kantorcabang`
  ADD CONSTRAINT `kantorcabang_ibfk_1` FOREIGN KEY (`idkecamatan`) REFERENCES `kecamatan` (`id`);

--
-- Constraints for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD CONSTRAINT `kecamatan_ibfk_1` FOREIGN KEY (`idkabupaten`) REFERENCES `kabupaten` (`id`);

--
-- Constraints for table `keluhantransaksi`
--
ALTER TABLE `keluhantransaksi`
  ADD CONSTRAINT `keluhantransaksi_ibfk_1` FOREIGN KEY (`idtransaksi`) REFERENCES `transaksi` (`id`);

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`idkantorcabang`) REFERENCES `kantorcabang` (`id`);

--
-- Constraints for table `responkeluhan`
--
ALTER TABLE `responkeluhan`
  ADD CONSTRAINT `responkeluhan_ibfk_1` FOREIGN KEY (`idkeluhan`) REFERENCES `keluhantransaksi` (`id`);

--
-- Constraints for table `rutedetail`
--
ALTER TABLE `rutedetail`
  ADD CONSTRAINT `rutedetail_ibfk_2` FOREIGN KEY (`idkecamatan`) REFERENCES `kecamatan` (`id`),
  ADD CONSTRAINT `rutedetail_ibfk_3` FOREIGN KEY (`idkantorcabang`) REFERENCES `kantorcabang` (`id`),
  ADD CONSTRAINT `rutedetail_ibfk_4` FOREIGN KEY (`idrute`) REFERENCES `rute` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`idkecpengirim`) REFERENCES `kecamatan` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`idkecpenerima`) REFERENCES `kecamatan` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`idcs`) REFERENCES `pegawai` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_4` FOREIGN KEY (`idpengirim`) REFERENCES `pegawai` (`id`),
  ADD CONSTRAINT `transaksi_ibfk_5` FOREIGN KEY (`idstatus`) REFERENCES `tblstatus` (`id`);
