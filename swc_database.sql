-- phpMyAdmin SQL Dump
-- version 4.4.13.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 16, 2016 at 10:01 PM
-- Server version: 5.6.28-0ubuntu0.15.10.1
-- PHP Version: 5.6.11-1ubuntu3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swc_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE IF NOT EXISTS `submissions` (
  `id` int(11) NOT NULL,
  `fromdate` varchar(100) DEFAULT NULL,
  `todate` varchar(100) DEFAULT NULL,
  `reason` varchar(4096) DEFAULT NULL,
  `address` varchar(1024) DEFAULT NULL,
  `guardian` varchar(25) DEFAULT NULL,
  `rollno` int(9) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `fromdate`, `todate`, `reason`, `address`, `guardian`, `rollno`) VALUES
(1, '2016-04-13', '2016-04-13', 'fm kjdsfnjznsfdzsk;djfns;fnkm kmff;lKSAM', 'fkns;fdknk kfnSNF nfs', '14451415151461', 140101013),
(2, '2016-04-16 9:00', '2016-04-16 21:00', 'hghdfgdgdfg', 'hfgdhsh nhsbsbd', '576345345634', 140101013),
(3, '2016-04-13 14-00', '2016-04-16 8-00', 'i wanna go home bro', 'kadskadmk', '5555555555', 140101013),
(8, '2016-04-16 7-25', '2016-04-16 7-30', 'fsfasdfs ffdg gaga fsdfsaf sfasf gegertgetert', 'asfdasdf  fsaf sfs afsa f', '7777777777', 140101015),
(9, '2016-04-16 12-00', '2016-04-17 12-00', 'Heart Attack', 'Nandyal', '7896878348', 140101015),
(12, '2016-04-16 10-10', '2016-04-16 10-50', 'gdsfgdsfgdsgfdsgfdsggbfghfghfhg', 'hfdhghfd', '7777777777', 140101013);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `webmail` varchar(50) NOT NULL,
  `rollno` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`webmail`, `rollno`) VALUES
('k.betha', 140101013),
('chelimilla', 140101015);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rollno` (`rollno`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`webmail`),
  ADD UNIQUE KEY `rollno` (`rollno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`rollno`) REFERENCES `user` (`rollno`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
