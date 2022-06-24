-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 24, 2022 at 01:13 AM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `gs_content_table`
--

CREATE TABLE `gs_content_table` (
  `id` int(12) NOT NULL,
  `title` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `content` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `update_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gs_content_table`
--

INSERT INTO `gs_content_table` (`id`, `title`, `content`, `img`, `date`, `username`, `update_time`) VALUES
(11, 'aaa_revised', 'aaa_revised', '20220622072133_capcha.png', '2022-06-22 16:21:33', 'yutasaitoh', '2022-06-22 16:53:49'),
(12, 'bbb', 'bbb', '20220622072146_capcha.png', '2022-06-22 16:21:46', 'yutasaitoh', NULL),
(13, 'ccc', 'ccc', '20220622072213_capcha.png', '2022-06-22 16:22:13', 'johnsmith', NULL),
(14, 'ddd', 'ddd', '20220622072231_capcha.png', '2022-06-22 16:22:31', 'johnsmith', NULL),
(15, 'eee', 'eee', '20220622072250_capcha.png', '2022-06-22 16:22:50', 'johnsmith', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gs_content_table`
--
ALTER TABLE `gs_content_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gs_content_table`
--
ALTER TABLE `gs_content_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
