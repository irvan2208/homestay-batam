-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 05, 2016 at 11:56 AM
-- Server version: 10.0.28-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `homesta1_btm1108`
--

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE IF NOT EXISTS `fasilitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `houseid` varchar(255) NOT NULL,
  `entity` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id`, `houseid`, `entity`, `value`) VALUES
(1, '1', 'Swiming Pool', '0'),
(2, '1', 'Bathub', '1'),
(3, '1', 'Garasi', '0'),
(29, '29', 'kolam renang', '1');

-- --------------------------------------------------------

--
-- Table structure for table `gmbar`
--

CREATE TABLE IF NOT EXISTS `gmbar` (
  `imgid` int(11) NOT NULL AUTO_INCREMENT,
  `houseid` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `active` varchar(1) DEFAULT NULL,
  `asbg` varchar(1) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `ena` varchar(1) NOT NULL,
  PRIMARY KEY (`imgid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `gmbar`
--

INSERT INTO `gmbar` (`imgid`, `houseid`, `path`, `active`, `asbg`, `size`, `ena`) VALUES
(1, '1', 'catalog/imgh/house1.jpg', '1', '0', NULL, '1'),
(2, '1', 'catalog/imgh/house2.jpeg', '0', '1', NULL, '1'),
(38, '29', 'catalog/imgh/homdef.ico', '0', '0', NULL, '1'),
(39, '29', 'catalog/imgh/2490970651_418d8c0841.jpg', '1', '1', NULL, '1'),
(41, '29', 'catalog/imgh/via-southern-living-4_thumb1.jpg', '0', '0', NULL, '1'),
(43, '29', 'catalog/imgh/Desain_Taman_Mungil_Rumah_Minimalis_2.jpg', '0', '0', NULL, '1'),
(44, '30', 'catalog/imgh/homdef.ico', '1', '1', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `hbtcek`
--

CREATE TABLE IF NOT EXISTS `hbtcek` (
  `id` varchar(255) NOT NULL,
  `houseid` varchar(255) NOT NULL,
  `cekdt` datetime NOT NULL,
  `tgla` date NOT NULL,
  `tglb` date NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `pesan` varchar(255) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hbtcek`
--

INSERT INTO `hbtcek` (`id`, `houseid`, `cekdt`, `tgla`, `tglb`, `nama`, `email`, `phone`, `pesan`, `harga`) VALUES
('160820231610', '1', '2016-08-20 23:16:10', '2016-08-23', '2016-08-26', 'irvan santoso', 'irvan_boyz7777@yahoo.com', '083184476796', '', 650000),
('160822093642', '1', '2016-08-22 09:36:42', '2016-08-23', '2016-08-24', 'irvan santoso', 'irvan_boyz7777@yahoo.com', '083184476796', '', 650000),
('160822162915', '1', '2016-08-22 16:29:15', '2016-08-23', '2016-08-24', 'irvan santoso', 'irvan.2208@gmail.com', '083184476796', '', 650000),
('160822212131', '29', '2016-08-22 21:21:31', '2016-08-23', '2016-08-24', 'irvan santoso', 'irvan_boyz7777@yahoo.com', '083184476796', '', 400000),
('160823095856', '29', '2016-08-23 09:58:56', '2016-08-24', '2016-08-25', 'irvan santoso', 'irvan_boyz7777@yahoo.com', '083184476796', '', 400000),
('160823162117', '1', '2016-08-23 16:21:17', '2016-08-24', '2016-08-25', 'irvan santoso', 'irvan.2208@gmail.com', '083184476796', '', 650000),
('160829224513', '1', '2016-08-29 22:45:13', '2016-08-30', '2016-08-31', 'irvan santoso', 'irvan.2208@gmail.com', '083184476796', 'test', 650000),
('160907083130', '1', '2016-09-07 08:31:30', '2016-09-08', '2016-09-09', 'test', 'test@test.com', '08', '12\n', 650000),
('160921092452', '29', '2016-09-21 09:24:52', '2016-09-22', '2016-09-23', 'Vivian', 'vivilai96@gmail.com', '082319900823', '', 400000),
('160921094316', '1', '2016-09-21 09:43:16', '1970-01-01', '1970-01-01', 'test', 'test@test.com', '23412', '213423asdf', 650000),
('160927212114', '1', '2016-09-27 21:21:14', '2016-09-28', '2016-09-29', 'irvan santoso', 'irvan_boyz7777@yahoo.com', '083184476796', '', 650000),
('160927212903', '1', '2016-09-27 21:29:03', '2016-09-28', '2016-09-29', 'irvan santoso', 'irvan.2208@gmail.com', '083184476796', '', 650000),
('160927213429', '1', '2016-09-27 21:34:29', '2016-09-28', '2016-09-29', 'irvan santoso', 'irvan.2208@gmail.com', '083184476796', '', 650000),
('160929190414', '1', '2016-09-29 19:04:14', '2016-10-01', '2016-10-08', 'Claudya', 'claudyanovery@gmail.com', '11111111', 'aaa', 650000),
('161011195842', '1', '2016-10-11 19:58:42', '2016-10-12', '2016-10-13', 'irvan santoso', 'irvan.2208@gmail.com', '083184476796', '', 650000),
('161021211322', '29', '2016-10-21 21:13:22', '2016-10-29', '2016-11-05', 'irvan santoso', 'hendy.cai@gmail.com', '083184476796', '', 400000),
('161021211547', '29', '2016-10-21 21:15:47', '2016-10-29', '2016-11-03', 'irvan santoso', 'hendy.cai02@gmail.com', '083184476796', '', 400000),
('161031212732', '29', '2016-10-31 21:27:32', '2016-11-01', '2016-11-02', 'irvan santoso', 'irvan_boyz7777@yahoo.com', '083184476796', '', 400000),
('161031213050', '1', '2016-10-31 21:30:50', '2016-11-01', '2016-11-02', 'irvan santoso', 'irvan_boyz7777@yahoo.com', '083184476796', '', 650000),
('161031213613', '1', '2016-10-31 21:36:13', '2016-11-01', '2016-11-02', 'irvan santoso', 'irvan_boyz7777@yahoo.com', '083184476796', '', 650000),
('161114202902', '29', '2016-11-14 20:29:02', '2016-11-15', '2016-11-16', 'irvan santoso', 'irvan_boyz7777@yahoo.com', '083184476796', '12321\n', 400000),
('161114214357', '1', '2016-11-14 21:43:57', '2016-11-15', '2016-11-16', 'irvan santoso', 'irvan_boyz7777@yahoo.com', '083184476796', '', 650000),
('161114214540', '1', '2016-11-14 21:45:40', '2016-11-15', '2016-11-16', 'irvan santoso', 'irvan_boyz7777@yahoo.com', '083184476796', '', 650000),
('161115190228', '29', '2016-11-15 19:02:28', '2016-11-23', '2016-11-24', 'irvan santoso', 'irvan_boyz7777@yahoo.com', '083184476796', 'asf', 400000);

-- --------------------------------------------------------

--
-- Table structure for table `hbtcek_approve`
--

CREATE TABLE IF NOT EXISTS `hbtcek_approve` (
  `id` varchar(255) NOT NULL,
  `appdate` datetime NOT NULL,
  `appadm` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hbtcek_approve`
--

INSERT INTO `hbtcek_approve` (`id`, `appdate`, `appadm`) VALUES
('', '2016-08-23 16:19:39', ''),
('160820231610', '2016-08-21 09:20:22', ''),
('160822093642', '2016-08-22 09:40:15', ''),
('160822212131', '2016-08-22 21:22:25', ''),
('160823095856', '2016-08-23 09:59:50', ''),
('160823162117', '2016-08-23 16:22:09', ''),
('160907083130', '2016-09-07 08:35:33', ''),
('160921092452', '2016-09-21 09:37:05', ''),
('160921094316', '2016-09-29 19:11:52', ''),
('160929190414', '2016-09-29 19:12:19', ''),
('161011195842', '2016-10-11 20:29:38', ''),
('161021211547', '2016-10-21 21:16:40', ''),
('161031212732', '2016-10-31 21:28:01', ''),
('161031213050', '2016-10-31 21:30:58', ''),
('161031213613', '2016-10-31 21:36:42', ''),
('161114202902', '2016-11-14 20:44:56', ''),
('161114214357', '2016-11-14 21:44:34', ''),
('161114214540', '2016-11-14 21:45:46', ''),
('161115190228', '2016-11-15 20:38:15', '');

-- --------------------------------------------------------

--
-- Table structure for table `hbtcek_booked`
--

CREATE TABLE IF NOT EXISTS `hbtcek_booked` (
  `id` varchar(255) NOT NULL,
  `appid` varchar(255) NOT NULL,
  `bookdt` datetime NOT NULL,
  `fee` int(11) NOT NULL,
  `rent` int(11) NOT NULL,
  `tranid` int(11) NOT NULL,
  `bayar` varchar(1) NOT NULL,
  `cfmdt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hbtcek_booked`
--

INSERT INTO `hbtcek_booked` (`id`, `appid`, `bookdt`, `fee`, `rent`, `tranid`, `bayar`, `cfmdt`) VALUES
('16082160', '160820231610', '2016-08-21 10:14:18', 195060, 1950000, 60, '1', '2016-08-22 21:27:35'),
('16082210', '160822212131', '2016-08-22 21:23:00', 40010, 400000, 10, '1', '2016-08-22 21:28:05'),
('16082228', '160822093642', '2016-08-22 09:41:01', 65028, 650000, 28, '1', '2016-08-22 21:18:45'),
('16082318', '160823162117', '2016-08-23 16:23:06', 65018, 650000, 18, '1', '2016-08-23 16:26:53'),
('16082332', '160823095856', '2016-08-23 10:01:53', 40032, 400000, 32, '1', '2016-08-23 10:02:09'),
('16090719', '160907083130', '2016-09-07 08:38:25', 65019, 650000, 19, '1', '2016-09-07 08:38:50'),
('16092126', '160921092452', '2016-09-21 09:38:07', 40026, 400000, 26, '1', '2016-09-21 09:41:42'),
('16101132', '161011195842', '2016-10-11 20:30:18', 65032, 650000, 32, '1', '2016-10-11 20:34:44'),
('16102148', '161021211547', '2016-10-21 21:18:24', 200048, 2000000, 48, '1', '2016-10-21 21:28:20'),
('16103115', '161031213613', '2016-10-31 21:42:49', 65015, 650000, 15, '1', '2016-10-31 21:44:13'),
('16111426', '161114214540', '2016-11-14 21:46:40', 65026, 650000, 26, '1', '2016-11-14 21:47:09'),
('16111531', '161115190228', '2016-11-15 20:38:40', 40031, 400000, 31, '1', '2016-11-15 20:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `hbtcek_decline`
--

CREATE TABLE IF NOT EXISTS `hbtcek_decline` (
  `id` varchar(255) NOT NULL,
  `decdate` datetime NOT NULL,
  `decadm` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hbtcek_decline`
--

INSERT INTO `hbtcek_decline` (`id`, `decdate`, `decadm`) VALUES
('160822162915', '2016-08-23 09:59:52', ''),
('160829224513', '2016-08-30 13:00:14', ''),
('160927212114', '2016-10-12 10:34:20', ''),
('160927212903', '2016-10-12 10:34:21', ''),
('160927213429', '2016-10-12 10:34:24', '');

-- --------------------------------------------------------

--
-- Table structure for table `hbt_admin`
--

CREATE TABLE IF NOT EXISTS `hbt_admin` (
  `id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hbt_admin`
--

INSERT INTO `hbt_admin` (`id`, `username`, `pass`) VALUES
('1', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE IF NOT EXISTS `house` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ownid` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `desk` longtext,
  `price` int(11) DEFAULT NULL,
  `kamar` varchar(255) DEFAULT NULL,
  `toilet` varchar(255) DEFAULT NULL,
  `tv` varchar(255) DEFAULT NULL,
  `ac` varchar(255) DEFAULT NULL,
  `regdate` date DEFAULT NULL,
  `active` varchar(255) NOT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `long` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`id`, `ownid`, `sku`, `title`, `alamat`, `desk`, `price`, `kamar`, `toilet`, `tv`, `ac`, `regdate`, `active`, `lat`, `long`) VALUES
(1, '1', 'big-house-with-beach-view', 'Big House With Beach View', 'alamat rumah', '\r\nKemudahan dalam mencari tempat penginapan yang sesuai dengan pilihan kita, Kami menghubungkan wisatawan dengan lokal di batam\r\n\r\nIngin mendaftarkan rumah anda di homestay batam?, ikuti langkah-langkahnya disini', 650000, '4', '2', '5', '3', '2016-07-09', '1', '1.123859', '104.096966'),
(29, '74', 'rumah-asri-dekat-pantai-(2-kamar-1-ruang-tamu)', 'Rumah asri dekat pantai (2 kamar 1 ruang tamu)', 'alamat rumahnya', '<p></p><ol><li>dekat dengan pantai<br></li><li>5 menit menuju mall<br></li></ol><p></p>', 400000, '2', '2', '2', '1', '2016-08-10', '1', '1.054', '103.997'),
(30, '74', 'a', 'a', '', '', 0, '', '', '', '', '2016-08-23', '0', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE IF NOT EXISTS `owner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usernm` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `jk` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT 'catalog/imgo/owndef.ico',
  `alamat` varchar(255) DEFAULT NULL,
  `ttl` date DEFAULT NULL,
  `joindt` date DEFAULT NULL,
  `usrbg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`id`, `usernm`, `nama`, `jk`, `phone`, `img`, `alamat`, `ttl`, `joindt`, `usrbg`) VALUES
(1, 'irvan', 'Test Name', '1', '083184476796', 'catalog/imgo/owner.jpg', 'alamatowner', '1996-08-22', '2016-06-20', 'img/bg.jpg'),
(74, 'Owner_Baru', 'Owner Baru', '1', '08123455678', 'catalog/imgo/owndef.png', 'alamat', '1970-01-01', '2016-08-10', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `title`, `content`) VALUES
(1, 'tentang-kami', 'Tentang Kami', '<p>Homestay Batam merupakan sebuah media untuk memudahkan backpacker/turis dalam mencari tempat penginapan yang efektif dan terjangkau, seluruh rumah yang ditampilkan merupakan milik warga lokal, dan seluruh harga yang ditampilkan sudah merupakan harga fi'),
(2, 'hubungi-kami', 'Hubungi Kami', '<p>Hubungi Kami melalui</p><p>Email: request@homestay-batam.com</p><p>Hp: 083184476796</p>'),
(3, 'cara-kerja', 'Cara Kerja', '<p>Cara Kerja</p><p>1. cek ketersediaan rumah yang anda inginkan</p><p>2. Book melalui link yang dikirimkan ke email anda</p><p>3. lakukan pembayaran ke rekening yang diberikan</p><p>4. Datang ke alamat yang di berikan di tanggal check-in</p>'),
(4, 'bergabung', 'Bergabung', '<p>Hubungi Kami melalui</p><p>Email: request@homestay-batam.com</p><p>Hp: 083184476796</p>');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
