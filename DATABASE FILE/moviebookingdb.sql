-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 21, 2022 at 11:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `moviebookingdb`
--
CREATE DATABASE IF NOT EXISTS `moviebookingdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `moviebookingdb`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookings`
--

DROP TABLE IF EXISTS `tbl_bookings`;
CREATE TABLE `tbl_bookings` (
  `book_id` int(11) NOT NULL,
  `ticket_id` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `show_time` time NOT NULL,
  `room_name` varchar(10) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `seats` varchar(600) NOT NULL COMMENT 'id of seats',
  `amount` int(5) NOT NULL,
  `ticket_date` date NOT NULL,
  `date` date NOT NULL,
  `combo_id` int(11) DEFAULT NULL,
  `combo_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bookings`
--

INSERT INTO `tbl_bookings` (`book_id`, `ticket_id`, `user_id`, `show_time`, `room_name`, `movie_id`, `movie_name`, `seats`, `amount`, `ticket_date`, `date`, `combo_id`, `combo_desc`) VALUES
(6, 'TIK6', 1, '08:00:00', 'L01', 2, 'Cherry', 'B5 B7', 240, '2022-07-18', '2022-07-18', NULL, NULL),
(8, 'TIK8', 2, '06:35:00', 'VIP01', 1, 'The Invisible Man', 'B5 B8', 475, '2022-07-20', '2022-07-19', 3, '1 Popcorn + 1 Drink Combo'),
(9, 'TIK9', 2, '08:00:00', 'L01', 2, 'Cherry', 'C6 C7', 315, '2022-07-20', '2022-07-19', 3, '1 Popcorn + 1 Drink Combo'),
(12, 'TIK12', 1, '00:00:00', 'IMAX01', 5, 'Justice League', 'E5 E7', 360, '2022-07-20', '2022-07-20', NULL, NULL),
(13, 'TIK13', 2, '20:52:31', '3D01', 5, 'Justice League', 'E5 E7', 435, '2022-07-21', '2022-07-21', 4, '1 Popcorn + 2 Drinks Combo');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combos`
--

DROP TABLE IF EXISTS `tbl_combos`;
CREATE TABLE `tbl_combos` (
  `combo_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `week_date` int(11) NOT NULL,
  `desc` varchar(255) NOT NULL COMMENT 'description',
  `amount` int(11) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_combos`
--

INSERT INTO `tbl_combos` (`combo_id`, `start_date`, `end_date`, `week_date`, `desc`, `amount`, `image`) VALUES
(1, '2022-07-19', '2022-12-31', 5, 'MOMO Payment Discount', -69, 'combo_images/giamgia1.jpg'),
(2, '2022-07-20', '2022-12-31', 3, 'Happy Wednesday Discount', -75, 'combo_images/giamgia3.jpg'),
(3, '2022-07-21', '2023-07-21', 0, '1 Popcorn + 1 Drink Combo', 55, 'combo_images/bongnuoc1.jpg'),
(4, '2022-07-19', '2022-12-31', 0, '1 Popcorn + 2 Drinks Combo', 75, 'combo_images/bongnuoc2.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

DROP TABLE IF EXISTS `tbl_login`;
CREATE TABLE `tbl_login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL COMMENT 'email',
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `user_id`, `username`, `password`) VALUES
(5, 2, 'fuyuyukito@gmail.com', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_admin`
--

DROP TABLE IF EXISTS `tbl_login_admin`;
CREATE TABLE `tbl_login_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_login_admin`
--

INSERT INTO `tbl_login_admin` (`id`, `username`, `password`, `user_type`) VALUES
(1, 'admin', 'password', 0),
(2, 'THR760801', 'PWD649976', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movie`
--

DROP TABLE IF EXISTS `tbl_movie`;
CREATE TABLE `tbl_movie` (
  `movie_id` int(11) NOT NULL,
  `movie_name` varchar(255) NOT NULL,
  `cast` varchar(500) NOT NULL,
  `desc` varchar(1000) NOT NULL,
  `release_date` date NOT NULL,
  `image` varchar(200) NOT NULL,
  `video_url` varchar(200) NOT NULL,
  `length` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_movie`
--

INSERT INTO `tbl_movie` (`movie_id`, `movie_name`, `cast`, `desc`, `release_date`, `image`, `video_url`, `length`) VALUES
(1, 'The Invisible Man', 'Elisabeth Moss, Oliver Jackson-Cohen, Aldis Hodge, Storm Reid', 'Cecilia\'s abusive ex-boyfriend fakes his death and becomes invisible to stalk and torment her. She begins experiencing strange events and decides to hunt down the truth on her own.', '2022-07-04', 'images/tim.jpg', 'https://www.youtube.com/watch?v=WO_FJdiY9dA', 114),
(2, 'Cherry', 'Tom Holland, Ciara Bravo, Harry Holland, Kelli Berglund', 'Cherry (Tom Holland) drifts from college dropout to army medic in Iraq-anchored only by his one true love, Emily (Ciara Bravo). But after returning from the war with PTSD, his life spirals into drugs.', '2022-07-05', 'images/cherry.jpg', 'https://www.youtube.com/watch?v=H5bH6O0bErk', 112),
(3, 'Godzilla vs. Kong', 'Millie Bobby Brown, Alexander Skarsgard, Rebecca Hall', 'The initial confrontation between the two titans -- instigated by unseen forces -- is only the beginning of the mystery that lies deep within the core of the planet.', '2022-07-05', 'images/gvkpster.jpg', 'https://www.youtube.com/watch?v=odM92ap8_c0', 102),
(5, 'Justice League', 'Ben Affleck, Henry Cavil, Ezra Miller', 'This is a demo description for the movie ZSJL.', '2022-06-22', 'images/zsjl.jpg', 'https://www.youtube.com/watch?v=vM-Bja2Gy04', 108),
(6, 'DETECTIVE CONAN: THE BRIDE OF HALLOWEEN', 'Minami Takayama, Chafuurin, Tooru Furuya', 'During the wedding of Takagi and Sato, an assailant breaks and tries to attack Sato. But Takagi protects her while getting injured. The attacker escapes, but the situation is settled, although Sato is rightfully rattled by it all.', '2022-07-23', 'images/conan.jpg', 'https://youtu.be/SqSJPzWvcLc', 111);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

DROP TABLE IF EXISTS `tbl_registration`;
CREATE TABLE `tbl_registration` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `age` int(2) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`user_id`, `name`, `email`, `phone`, `age`, `gender`) VALUES
(2, 'Hoai Nam', 'fuyuyukito@gmail.com', '9876543210', 20, 'male');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms`
--

DROP TABLE IF EXISTS `tbl_rooms`;
CREATE TABLE `tbl_rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(10) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_rooms`
--

INSERT INTO `tbl_rooms` (`room_id`, `room_name`, `type_id`) VALUES
(1, 'L01', 1),
(2, 'S01', 2),
(3, 'VIP01', 3),
(4, 'IMAX01', 4),
(5, '3D01', 5),
(6, 'IMAX02', 4),
(7, 'VIP02', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roomtypes`
--

DROP TABLE IF EXISTS `tbl_roomtypes`;
CREATE TABLE `tbl_roomtypes` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(10) NOT NULL,
  `seats` int(11) NOT NULL COMMENT 'number of seats',
  `vip` int(11) NOT NULL COMMENT 'number of vip seats',
  `charge` int(11) NOT NULL,
  `vip_charge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_roomtypes`
--

INSERT INTO `tbl_roomtypes` (`type_id`, `type_name`, `seats`, `vip`, `charge`, `vip_charge`) VALUES
(1, 'Large room', 120, 60, 120, 135),
(2, 'Small room', 84, 48, 135, 150),
(3, 'VIP room', 48, 48, 0, 200),
(4, 'IMAX room', 96, 60, 165, 180),
(5, '3D room', 96, 60, 165, 180);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shows`
--

DROP TABLE IF EXISTS `tbl_shows`;
CREATE TABLE `tbl_shows` (
  `s_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_shows`
--

INSERT INTO `tbl_shows` (`s_id`, `room_id`, `movie_id`, `start_date`, `start_time`, `end_time`) VALUES
(1, 1, 2, '2022-07-22', '08:00:00', '10:00:00'),
(4, 4, 5, '2022-07-22', '00:00:00', '02:00:00'),
(5, 5, 5, '2022-07-21', '20:52:31', '23:52:31'),
(6, 3, 1, '2022-07-22', '12:55:00', '14:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `tmp_seats`
--

DROP TABLE IF EXISTS `tmp_seats`;
CREATE TABLE `tmp_seats` (
  `s_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `seat_id` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_seats`
--

INSERT INTO `tmp_seats` (`s_id`, `book_id`, `seat_id`) VALUES
(1, 6, 'B5'),
(1, 6, 'B7'),
(1, 9, 'C6'),
(1, 9, 'C7'),
(4, 12, 'E5'),
(4, 12, 'E7'),
(5, 13, 'E5'),
(5, 13, 'E7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bookings`
--
ALTER TABLE `tbl_bookings`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `tbl_combos`
--
ALTER TABLE `tbl_combos`
  ADD PRIMARY KEY (`combo_id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id`,`user_id`),
  ADD KEY `fk_regis` (`user_id`);

--
-- Indexes for table `tbl_login_admin`
--
ALTER TABLE `tbl_login_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_movie`
--
ALTER TABLE `tbl_movie`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `tbl_roomtypes`
--
ALTER TABLE `tbl_roomtypes`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tbl_shows`
--
ALTER TABLE `tbl_shows`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `fk_movies` (`movie_id`),
  ADD KEY `fk_rooms` (`room_id`);

--
-- Indexes for table `tmp_seats`
--
ALTER TABLE `tmp_seats`
  ADD PRIMARY KEY (`s_id`,`book_id`,`seat_id`),
  ADD KEY `fk_bookings` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bookings`
--
ALTER TABLE `tbl_bookings`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_combos`
--
ALTER TABLE `tbl_combos`
  MODIFY `combo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_login_admin`
--
ALTER TABLE `tbl_login_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_movie`
--
ALTER TABLE `tbl_movie`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_registration`
--
ALTER TABLE `tbl_registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_roomtypes`
--
ALTER TABLE `tbl_roomtypes`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_shows`
--
ALTER TABLE `tbl_shows`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD CONSTRAINT `fk_regis` FOREIGN KEY (`user_id`) REFERENCES `tbl_registration` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  ADD CONSTRAINT `tbl_rooms_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `tbl_roomtypes` (`type_id`);

--
-- Constraints for table `tbl_shows`
--
ALTER TABLE `tbl_shows`
  ADD CONSTRAINT `fk_movies` FOREIGN KEY (`movie_id`) REFERENCES `tbl_movie` (`movie_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_rooms` FOREIGN KEY (`room_id`) REFERENCES `tbl_rooms` (`room_id`) ON DELETE CASCADE;

--
-- Constraints for table `tmp_seats`
--
ALTER TABLE `tmp_seats`
  ADD CONSTRAINT `fk_bookings` FOREIGN KEY (`book_id`) REFERENCES `tbl_bookings` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tmp_seats_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `tbl_shows` (`s_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
