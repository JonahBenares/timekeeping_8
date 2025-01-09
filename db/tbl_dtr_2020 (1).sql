-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2020 at 04:57 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_timekeeping_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dtr_2020`
--

CREATE TABLE IF NOT EXISTS `tbl_dtr_2020` (
`dtr_Id` int(11) NOT NULL,
  `employee_biometricnumber` varchar(255) DEFAULT NULL,
  `employee_name` varchar(255) DEFAULT NULL,
  `dtr_date` date DEFAULT '0000-00-00',
  `dtr_day` varchar(255) DEFAULT NULL,
  `dtr_checkin` varchar(255) DEFAULT NULL,
  `dtr_breakout_am` varchar(255) DEFAULT NULL,
  `dtr_breakin_am` varchar(255) DEFAULT NULL,
  `dtr_breakout_nn` varchar(255) DEFAULT NULL,
  `dtr_breakin_nn` varchar(255) DEFAULT NULL,
  `dtr_breakout_pm` varchar(255) DEFAULT NULL,
  `dtr_breakin_pm` varchar(255) DEFAULT NULL,
  `dtr_checkout` varchar(255) DEFAULT NULL,
  `dtr_remarks` varchar(255) DEFAULT NULL,
  `employee_Id` int(11) DEFAULT NULL,
  `user_Id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_dtr_2020`
--
ALTER TABLE `tbl_dtr_2020`
 ADD PRIMARY KEY (`dtr_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_dtr_2020`
--
ALTER TABLE `tbl_dtr_2020`
MODIFY `dtr_Id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
