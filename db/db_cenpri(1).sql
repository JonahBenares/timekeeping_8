-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2020 at 09:54 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_cenpri`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_department`
--

CREATE TABLE IF NOT EXISTS `tbl_department` (
`department_id` int(20) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_department`
--

INSERT INTO `tbl_department` (`department_id`, `department_name`) VALUES
(1, 'IT Department'),
(2, 'HR Department'),
(3, 'Procurement'),
(4, 'Time Keeping'),
(5, 'HR Development');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
`user_id` int(20) NOT NULL,
  `usertype_id` int(20) NOT NULL,
  `department_id` int(20) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `usertype_id`, `department_id`, `username`, `password`, `fullname`) VALUES
(1, 2, 2, 'admin', 'admin', 'asdas'),
(2, 1, 4, 'itadmin', 'itadmin', 'IT Admin'),
(5, 2, 2, 'hrstaff', 'hrstaff', 'HR Staff'),
(6, 1, 2, 'hradmin', 'hradmin', 'HR Admin'),
(7, 1, 3, 'procadmin', 'procadmin', 'Procurement Admin'),
(8, 2, 3, 'procstaff', 'procstaff', 'Procurement Staff'),
(9, 2, 1, 'lloyd', 'lloyd1234', 'Lloyd Jamero'),
(10, 2, 1, 'jason', 'jason1234', 'Jason Flor'),
(11, 2, 1, 'stephine', 'stephine1234', 'Stephine Severino'),
(12, 1, 1, 'jonah', 'jonah', 'Jonah Benares'),
(13, 1, 1, 'Merry', 'Energy0174', 'Merry Michelle Dato'),
(15, 3, 1, 'Arana', 'Arana1234', 'Ma. Milagros Arana'),
(16, 3, 1, 'Arsenio', 'Arsenio1234', 'Rhea Arsenio'),
(18, 3, 1, 'Calibjo', 'Calibjo1234', 'Joemarie Calibjo'),
(19, 3, 1, 'Cabaylo', 'Cabaylo1234', 'Maylen Cabaylo'),
(20, 3, 1, 'Carbaquil', 'Carbaquil1234', 'Rey  Carbaquil'),
(21, 3, 1, 'Danoy', 'Danoy1234', 'Gretchen Danoy'),
(22, 3, 1, 'DelosSantos', 'DelosSantos1234', 'Joemar Delos Santos'),
(23, 3, 1, 'Espera', 'Espera1234', 'Imelda Espera'),
(24, 3, 1, 'Gabales', 'Gabales1234', 'Zara Joy Gabales'),
(25, 3, 1, 'Gallo', 'Gallo1234', 'Relsie Gallo'),
(26, 3, 1, 'Grabillo', 'Grabillo1234', 'Celina Marie Grabillo'),
(27, 3, 1, 'Ibanez', 'Ibanez1234', 'Nazario Shyde Jr. Ibañez'),
(28, 3, 1, 'Jalandoni', 'Jalandoni1234', 'Gebby Jalandoni'),
(29, 3, 1, 'Lacambra', 'Lacambra1234', 'Annavi Lacambra'),
(30, 3, 1, 'Mistica', 'Mistica1234', 'Roselle Mistica'),
(31, 3, 1, 'Oquiana', 'Oquiana1234', 'Ma. Erika Oquiana'),
(32, 3, 1, 'Pastera', 'Pastera1234', 'Remmart Pastera'),
(33, 3, 1, 'Plaza', 'Plaza1234', 'Charmaine Rei Plaza'),
(34, 3, 1, 'Ramirez', 'Ramirez1234', 'Cresilda Mae Ramirez'),
(35, 3, 1, 'Rosales', 'Rosales1234', 'Zyndyryn Rosales'),
(36, 3, 1, 'Saludo', 'Saludo1234', 'Genie Saludo'),
(37, 3, 1, 'Sanchez', 'Sanchez1234', 'Daisy Jane Sanchez'),
(38, 3, 1, 'Sarroza', 'Sarroza1234', 'Rosemarie Sarroza'),
(39, 3, 1, 'Sia', 'Sia1234', 'Henry Sia'),
(40, 3, 1, 'Sinoro', 'Sinoro1234', 'Syndey Sinoro'),
(41, 3, 1, 'Tabilla', 'Tabilla1234', 'Marianita Tabilla'),
(42, 3, 1, 'Tagalog', 'Tagalog1234', 'Krystal Gayle Tagalog'),
(43, 3, 1, 'Tajo', 'Tajo1234', 'Richard Tajo'),
(44, 3, 1, 'Tan', 'Tan1234', 'Teresa Tan'),
(45, 3, 1, 'Villas', 'Villas1234', 'Dary Mae Villas'),
(46, 3, 1, 'Binas', 'Binas1234', 'Kervic Binas'),
(47, 3, 1, 'Dujenio', 'Dujenio1234', 'Butch Dujenio'),
(48, 3, 1, 'Labiao', 'Labiao1234', 'Orville Zoilo Labiao'),
(49, 3, 1, 'Caballero', 'Caballero1234', 'Angelika Caballero'),
(50, 3, 1, 'Nillos', 'Nillos1234', 'Lester Nillos'),
(51, 2, 1, 'jush', 'jush123', 'Jushkyle Jambongana'),
(52, 1, 2, 'saludo', 'saludo1234', 'Genie Saludo'),
(53, 1, 2, 'Sinoro', 'Sinoro1234', 'Syndey Sinoro'),
(54, 1, 5, 'jason', 'jason', 'Jason Flor'),
(55, 1, 5, 'Stephine', 'Stephine', 'Stephine Severino'),
(56, 1, 5, 'Jonah', 'Jonah', 'Jonah Benares'),
(57, 2, 1, 'sarroza', 'sarroza1234', 'rosemarie sarroza'),
(58, 1, 3, 'cabaylo', 'cabaylo123456', 'Maylene Cabaylo'),
(59, 2, 3, 'Arana', 'Arana1234', 'Ma. Milagros Arana'),
(60, 2, 3, 'binas', 'binas1234', 'Kervic Binas'),
(61, 2, 3, 'espera', 'espera1234', 'Imelda Espera'),
(62, 2, 3, 'mistica', 'mistica1234', 'roselle mistica'),
(63, 2, 3, 'Duis', 'duis1234', 'melfa duis'),
(64, 2, 3, 'ledesma', 'ledesma1234', 'Antonnete Ledesma'),
(69, 1, 2, 'Sinoro', 'Sinoro1234', 'Syndey Sinoro'),
(70, 1, 2, 'tagalog', 'tagalog1234', 'Krystal Gayle Tagalog'),
(71, 2, 3, 'villas', 'villas1234', 'Mary Rose Villas'),
(72, 2, 2, 'mistica', 'mistica1234', 'Roselle Mistica'),
(73, 1, 4, 'tagalog123', 'tagalog123', 'Gayle Tagalog'),
(77, 1, 4, 'espera123', 'espera123', 'Imelda Espera'),
(78, 1, 4, 'sinoro123', 'sinoro123', 'Syndey Sinoro'),
(79, 1, 4, 'arana123', 'arana123', 'Mila Arana'),
(80, 1, 4, 'admin', 'admin', 'Admin'),
(81, 3, 4, 'elaisa123', 'elaisa123', 'Elaisa Jane Febrio'),
(82, 3, 4, 'genie123', 'saludo123', 'Genie Saludo'),
(83, 1, 2, 'elaisa123', 'febrio123', 'Elaisa Jane Febrio'),
(84, 2, 3, 'melfa1234', 'melfa1234', 'Melfa Duis');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_usertype`
--

CREATE TABLE IF NOT EXISTS `tbl_usertype` (
`usertype_id` int(20) NOT NULL,
  `usertype_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_usertype`
--

INSERT INTO `tbl_usertype` (`usertype_id`, `usertype_name`) VALUES
(1, 'admin'),
(2, 'staff'),
(3, 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_department`
--
ALTER TABLE `tbl_department`
 ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_usertype`
--
ALTER TABLE `tbl_usertype`
 ADD PRIMARY KEY (`usertype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_department`
--
ALTER TABLE `tbl_department`
MODIFY `department_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `tbl_usertype`
--
ALTER TABLE `tbl_usertype`
MODIFY `usertype_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
