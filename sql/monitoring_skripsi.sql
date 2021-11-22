-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2021 at 03:19 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring_skripsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(40) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `is_delete`, `create_at`, `update_at`) VALUES
('VriyhXrzjHglpAMKbnNN', 'Staf Admin', 'admin@default.com', '$2y$10$ybcqQvKdVgnf3gzXF4PpRuyY0MGWsjQKj6HuwuENA/zozkBUyLt6e', 0, '2021-04-24 14:56:44', '2021-06-22 12:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE `lecture` (
  `id` varchar(40) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`id`, `name`, `email`, `password`, `is_delete`, `create_at`, `update_at`) VALUES
('28eb3f1b5f629d08173d94737b52e8ca', 'dosen 1', 'dosen1@default.com', '$2y$10$WZV1blk6VbZOtQGFlps2cOL6Qh7zOm08we6EcwdipwiztnrQKXR2y', 0, '2021-04-25 01:28:12', '2021-04-25 01:28:12'),
('395e91263375ff77c0f48d28cd67bd35', 'dosen 61', 'dosen6@default.com', '$2y$10$ApUhJtGVSRQpFNC6lHCWi.SabylK13ksCOcy8IUxo9vGpkOaIS7UW', 0, '2021-04-25 03:05:23', '2021-04-25 03:05:23'),
('40899a5a37ee0ca641d663c2a73a5628', 'dosen 21', 'dosen212@default.com', '$2y$10$IejGKEQD.VwnF6Z.yP1gkui/2caU8hR8B6HUfFjxyWd9HIGO7QcOa', 1, '2021-06-22 12:12:34', '2021-06-22 12:12:34'),
('4ffeddb8ad76132bd60fc8fc134ab6d9', 'dosen 2', 'dosen2@default.com', '$2y$10$WZV1blk6VbZOtQGFlps2cOL6Qh7zOm08we6EcwdipwiztnrQKXR2y', 0, '2021-04-25 01:28:33', '2021-04-25 01:28:33'),
('79a5c8aa3f213bb151b28710b4164033', 'dosen 4', 'dosen4@default.com', '$2y$10$lYGHptcj/f36iFOtcAWWQeFsdlvYV3DQyH3z4qONaqe3Ld0gGlr5q', 0, '2021-04-25 02:54:26', '2021-04-25 02:54:26'),
('7d9a09a1d7ab97f1c2e388a08466e95b', 'dosen 3', 'dosen3@default.com', '$2y$10$oJ2VpFoMnnGMHZxmkTX4T.uRdSUGjL2KfRbLF7iHHwYMdkCxZ8clq', 0, '2021-04-25 02:53:59', '2021-04-25 02:53:59'),
('cbda972ef51048d29efa1dc449171da1', 'dosen 5', 'dosen5@default.com', '$2y$10$ZOehf6Ujp8nPrJ9QNqLlxum29uHBEvssrpCIuMnEU8i2YtxCs2PxS', 0, '2021-04-25 03:05:09', '2021-04-25 03:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `major_head`
--

CREATE TABLE `major_head` (
  `id` varchar(40) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_delete` tinyint(1) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `major_head`
--

INSERT INTO `major_head` (`id`, `name`, `email`, `password`, `is_delete`, `create_at`, `update_at`) VALUES
('kVXY8z0Fhdny77EjnADz', 'Kepala Jurusan', 'headMajors@default.com', '$2y$10$WZV1blk6VbZOtQGFlps2cOL6Qh7zOm08we6EcwdipwiztnrQKXR2y', 0, '2021-04-24 14:58:32', '2021-04-25 05:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `thesis`
--

CREATE TABLE `thesis` (
  `id` varchar(40) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nim` varchar(100) NOT NULL,
  `title` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `is_graduate` tinyint(1) NOT NULL DEFAULT 0,
  `semester` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `lecture_one` varchar(40) NOT NULL,
  `lecture_two` varchar(40) DEFAULT NULL,
  `is_delete` tinyint(1) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thesis`
--

INSERT INTO `thesis` (`id`, `name`, `nim`, `title`, `type`, `date_start`, `date_end`, `is_graduate`, `semester`, `year`, `lecture_one`, `lecture_two`, `is_delete`, `create_at`, `update_at`) VALUES
('1e4e9f9ba301a7da73735055832fb68e', 'nikma', '123213', 'asasass', 'Skripsi', '2021-11-01', '2021-11-30', 1, 'Semester Genap', '121212 / 1212121', '79a5c8aa3f213bb151b28710b4164033', '79a5c8aa3f213bb151b28710b4164033', 0, '2021-11-22 01:37:22', '2021-11-22 01:37:22'),
('3314345682bd0fa9e40c1aa945b28d16', 'nikma', '123213', 'asdsdsads', 'Perancangan', '2021-04-06', '2021-04-26', 1, 'Semester Genap', '2021 / 2022', '395e91263375ff77c0f48d28cd67bd35', NULL, 0, '2021-04-25 03:31:19', '2021-04-25 04:08:21'),
('345e4d24677d3669d11869ba77f262a9', 'eko', '123', 'apa saja', 'Skripsi', '2020-01-01', '2020-01-01', 0, 'Semester Ganjil', '2020 / 2021', '4ffeddb8ad76132bd60fc8fc134ab6d9', '28eb3f1b5f629d08173d94737b52e8ca', 0, '2021-04-25 02:04:29', '2021-04-25 02:14:39'),
('44a14c3624c315bc5ec479616bf58f49', 'eko', '123', 'apa saja', 'Perancangan', '2020-01-01', '2020-01-01', 1, 'Semester Ganjil', '2020 / 2021', '28eb3f1b5f629d08173d94737b52e8ca', NULL, 0, '2021-04-25 02:05:27', '2021-04-25 02:05:27'),
('5c421fe07d1101785b2b4f704c79001f', 'qewqe', '12', '234', 'Perancangan', '2021-06-01', '2021-06-08', 1, 'Semester Genap', '123 / 1231', '4ffeddb8ad76132bd60fc8fc134ab6d9', NULL, 0, '2021-06-22 12:21:31', '2021-06-22 12:21:31'),
('6321edf7146b545a7514bf8e11c723e6', 'asdsadsad', '12312312', 'qweqwewqe', 'Perancangan', '2021-06-01', '2021-06-01', 1, 'Semester Ganjil', '123123 / 123123', '28eb3f1b5f629d08173d94737b52e8ca', NULL, 1, '2021-06-22 12:14:51', '2021-06-22 12:17:46'),
('9e0f0ca2ea6f68eeb8a23bdef50cbfac', 'eko', '123', 'apa saja', 'Perancangan', '2020-01-01', '2020-01-01', 1, 'Semester Ganjil', '2020 / 2021', '4ffeddb8ad76132bd60fc8fc134ab6d9', NULL, 0, '2021-04-25 02:08:10', '2021-04-25 02:08:10'),
('ca8fd747a9c63781f8540997a7ef3fe6', 'eko', '123', 'apa saja', 'Skripsi', '2020-01-01', '2020-01-01', 0, 'Semester Ganjil', '2020 / 2021', '28eb3f1b5f629d08173d94737b52e8ca', '4ffeddb8ad76132bd60fc8fc134ab6d9', 0, '2021-04-25 02:03:59', '2021-04-25 02:03:59'),
('ecbc23d46d3c64c1ef5613871a62dabc', 'ni\'ma', '165150401111011', 'nikma orang bijak', 'Perancangan', '2021-04-06', '2021-04-27', 0, 'Semester Ganjil', '2020 / 2021', '28eb3f1b5f629d08173d94737b52e8ca', NULL, 0, '2021-04-25 03:30:30', '2021-04-25 03:30:30'),
('f1b69b9451b65ce2e862c97659c33f5b', 'eko', '123', 'apa saja12', 'Tugas Akhir', '2020-01-01', '2020-01-01', 0, 'Semester Ganjil', '2020 / 2021', '28eb3f1b5f629d08173d94737b52e8ca', '4ffeddb8ad76132bd60fc8fc134ab6d9', 0, '2021-04-25 02:04:15', '2021-06-22 12:01:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `major_head`
--
ALTER TABLE `major_head`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thesis`
--
ALTER TABLE `thesis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leture_one` (`lecture_one`),
  ADD KEY `lecture_two` (`lecture_two`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `thesis`
--
ALTER TABLE `thesis`
  ADD CONSTRAINT `thesis_ibfk_1` FOREIGN KEY (`lecture_one`) REFERENCES `lecture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `thesis_ibfk_2` FOREIGN KEY (`lecture_two`) REFERENCES `lecture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
