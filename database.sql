-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2018 at 02:23 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `entertaiment_ethiopia`
--
CREATE DATABASE IF NOT EXISTS `entertaiment_ethiopia` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `entertaiment_ethiopia`;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `catagory` varchar(255) NOT NULL,
  `content` varchar(766) NOT NULL,
  `importance` int(11) NOT NULL,
  `source` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `catagory`, `content`, `importance`, `source`, `date`) VALUES
(1, 'f', 'sf', 'sdf', 3, 'fd', '2018-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `cinemas`
--

CREATE TABLE `cinemas` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cinemas`
--

INSERT INTO `cinemas` (`id`, `name`, `location`) VALUES
(0, 'Alem', 'Bole'),
(1, 'Alem', 'Bole');

-- --------------------------------------------------------

--
-- Table structure for table `cinema_reprsentatives`
--

CREATE TABLE `cinema_reprsentatives` (
  `username` varchar(255) NOT NULL,
  `representing_cinema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `id` int(11) NOT NULL,
  `title` int(11) NOT NULL,
  `catagory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forum_participants`
--

CREATE TABLE `forum_participants` (
  `fourm_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fourm_thoughts`
--

CREATE TABLE `fourm_thoughts` (
  `fourm_id` int(11) NOT NULL,
  `content` varchar(766) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `movie_title` varchar(255) NOT NULL,
  `length` double NOT NULL,
  `release_date` date NOT NULL,
  `producer` varchar(255) NOT NULL,
  `cast` varchar(255) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movie_schedules`
--

CREATE TABLE `movie_schedules` (
  `movie_id` int(11) NOT NULL,
  `cinema_id` int(11) NOT NULL,
  `schedule_day` varchar(10) NOT NULL,
  `schedule_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `musics`
--

CREATE TABLE `musics` (
  `id` int(11) NOT NULL,
  `music_title` varchar(255) NOT NULL,
  `singer` varchar(255) NOT NULL,
  `length` double NOT NULL,
  `release_date` date NOT NULL,
  `producer` varchar(255) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `e-mail` varchar(255) NOT NULL,
  `userType` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`first_name`, `last_name`, `username`, `password`, `e-mail`, `userType`) VALUES
('Dawit', 'Yonas', 'dawit', 'test123', 'dawityonas010@gmail.com', 'cinemaRep');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cinemas`
--
ALTER TABLE `cinemas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cinema_reprsentatives`
--
ALTER TABLE `cinema_reprsentatives`
  ADD PRIMARY KEY (`username`,`representing_cinema`),
  ADD KEY `representing_cinema` (`representing_cinema`) USING BTREE;

--
-- Indexes for table `forums`
--
ALTER TABLE `forums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_participants`
--
ALTER TABLE `forum_participants`
  ADD PRIMARY KEY (`fourm_id`,`user_id`);

--
-- Indexes for table `fourm_thoughts`
--
ALTER TABLE `fourm_thoughts`
  ADD PRIMARY KEY (`fourm_id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movie_schedules`
--
ALTER TABLE `movie_schedules`
  ADD PRIMARY KEY (`movie_id`,`cinema_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- Indexes for table `musics`
--
ALTER TABLE `musics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cinema_reprsentatives`
--
ALTER TABLE `cinema_reprsentatives`
  ADD CONSTRAINT `cinema_reprsentatives_ibfk_1` FOREIGN KEY (`representing_cinema`) REFERENCES `cinemas` (`id`),
  ADD CONSTRAINT `cinema_reprsentatives_ibfk_2` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
