-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 23, 2022 at 03:04 PM
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

CREATE TABLE `tbl_bookings` (
  `book_id` int(11) NOT NULL,
  `ticket_id` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(5) NOT NULL,
  `date` date NOT NULL,
  `combo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bookings`
--

INSERT INTO `tbl_bookings` (`book_id`, `ticket_id`, `user_id`, `amount`, `date`, `combo_id`) VALUES
(1, 'TIK1', 2, 435, '2022-07-23', 4),
(2, 'TIK2', 2, 360, '2022-07-23', NULL),
(3, 'TIK3', 2, 455, '2022-07-23', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_combos`
--

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
(6, 'DETECTIVE CONAN: THE BRIDE OF HALLOWEEN', 'Minami Takayama, Chafuurin, Tooru Furuya', 'During the wedding of Takagi and Sato, an assailant breaks and tries to attack Sato. But Takagi protects her while getting injured. The attacker escapes, but the situation is settled, although Sato is rightfully rattled by it all.', '2022-07-23', 'images/conan.jpg', 'https://youtu.be/SqSJPzWvcLc', 111),
(7, 'MINIONS: THE RISE OF GRU', 'Steve Carell, Lucy Lawless, Michelle Yeoh', 'The untold story of one twelve-year-olds dream to become the worlds greatest supervillain', '2022-07-24', 'images/minion2.jpg', 'https://youtu.be/dTQXlDV16SY', 88),
(8, 'CHERRY MAGIC', ' Eiji Akaso, Keita Machida , Kodai Asaka, Yutaro, Takuya Kusakawa , Rei Sato, Suzunosuke', ' Adachi is a dull office worker who turned 30 as a virgin and has obtained MAGIC that enables him to read the minds of those he touches. Kurosawa is Adachi s lover at work and is popular and successful. They are secretly lovers. One day, Adachi is offered a job transfer. Adachi is happy to have the chance to do the work he wants, but his new job place is in Nagasaki, 1,200 km away. Through difficulties and challenges, their long distance relationship leads them to rethink about their relationship and their future. Where will the magic lead them?', '2022-07-15', 'images/cherrymagic.jpg', 'https://youtu.be/obTrN5__BAM', 104),
(9, 'THOR: LOVE AND THUNDER', 'Chris Hemsworth, Tessa Thompson, Natalie Portman, Chris Pratt', 'Thor reunites with Valkyrie, Korg and his ex-girlfriend Jane Foster to fight the threat of Gorr, The God Butcher.', '2022-07-08', 'images/thor4.jpg', 'https://youtu.be/6_dk-s57jck', 118),
(10, 'DECISION TO LEAVE', 'Tang Wei, Park Hae Il', 'A detective falls for a mysterious widow after she becomes the prime suspect in his latest murder investigation.', '2022-07-15', 'images/dtl.jpg', 'https://youtu.be/kdJvKwT2NAU', 130),
(11, 'DC SUPER PETS', 'Dwayne Johnson, Kevin Hart, Keanu Reeves', 'Krypto the Super Dog and Superman are inseparable best friends, sharing the same superpowers and fighting crime side by side in Metropolis. However, Krypto must master his own powers for a rescue mission when Superman is kidnapped.', '2022-07-29', 'images/dcpets.jpg', 'https://youtu.be/GrBRGS6Z-jI', 106),
(12, 'MY GIRL', 'Hong Je Yi, Kim Ji Young, Kim Mi Hwa, Hwang Seok Jeong, Shin Eun Hung, Jeon So Min, Yoon Mi Kyung, Jung In Ki', '19-year-old Yoon yeong lives alone with her mother and prepares for the civil service exam while working part-time. She wants to go to school like her friends, but prioritizes her exam and to pass it as soon as possible for the sake of her hearing-impaired mother. Regardless of good heart and sincere will, unexpected incidents turn Yoon-yeong from a victim to the killer, driving her to prison and being called inmate 2037.', '2022-07-29', 'images/mygirl.jpg', 'https://youtu.be/1AXeEfyTLKs', 111),
(13, 'BULLET TRAIN', 'Brad Pitt, Joey King, Andrew Koji, Aaron Taylor Johnson, Brian Tyree Henry, Zazie Beetz, Masi Oka, Michael Shannon, Logan Lerman, Hiroyuki Sanada, Karen Fukuhara, Bad Bunny, Sandra Bullock', 'Five assassins aboard a fast moving bullet train find out their missions have something in common.', '2022-08-12', 'images/bullettrain.jpg', 'https://youtu.be/niy4sIjV858', 126),
(14, 'WHERE THE CRAWDADS SING', 'Daisy Edgar Jones, Taylor John Smith, Harris Dickinson, David Strathairn, Jayson Warner Smith, Garret Dillahunt', 'A woman who raised herself in the marshes of the deep South becomes a suspect in the murder of a man she was once involved with', '2022-08-02', 'images/wtcs.jpg', 'https://youtu.be/S2jTTbz_hVs', 125),
(15, 'BLACK ADAM', 'Dwayne Johnson, Sarah Shahi, Pierce Brosnan, Noah Centineo, Aldis Hodge, Joseph Gatt, Natalie Burn, Quintessa Swindell', 'Nearly 5,000 years after he was bestowed with the almighty powers of the ancient gods—and imprisoned just as quickly—Black Adam (Johnson) is freed from his earthly tomb, ready to unleash his unique form of justice on the modern world.', '2022-10-21', 'images/blackadam.jpg', 'https://youtu.be/aaLmjQtg2P8', 136),
(16, 'GHOST BOOK 2022', 'Aragaki Yui, Kamiki Ryunosuke, Yoshimura Ayaka, Sonny Mcclendon, Shibazaki Fuga, Jyo Kairi', 'A story that depicts a number of trials, new encounters, and farewells awaiting children who have acquired a book, a ghost book that will fulfill any wish.', '2022-07-20', 'images/ghostbook.jpg', 'https://youtu.be/PMMy-oBSK0s', 96),
(17, 'SHIN ULTRAMAN', 'Saito Takumi, Nagasawa Masami, Akari Hayami, Yamamoto Kohi, Arioka Daiki', 'The film is the tribute story of the Ultraman series, which is one of the most famous Tokusatsu series in Japan and around the world.', '2022-07-21', 'images/shinultraman.jpg', 'https://www.youtube.com/watch?v=eVFd_Semtao', 112),
(18, 'KINGDOM 2', 'Kento Yamazaki, Ryo Yoshizawa, Kanna Hashimoto, Nana Seino, Takao Osawa', 'Based on manga series KINGDOM by Yasuhisa Hara (first published 2006 in weekly Japanese magazine Weekly Young Jump).', '2022-07-15', 'images/kingdom2.jpg', 'https://www.crunchyroll.com/anime-news/2022/05/05-1/world-changing-war-begins-in-kingdom-2-live-action-film-new-trailer', 134),
(19, 'SUZUME NO TOJIMARI', 'Nanoka Hara', 'The film is about Suzume, a 17-year-old girl who lives in a quiet town in the Kyushu region of southwestern Japan. The story begins when Suzume meets a young man looking for a \"door\". The two travel together and find an old door at an abandoned house in the mountains. As if pulled by something, Suzume reaches out her hand towards the door and is pulled in. \"Doors of Disaster\" begin to appear across Japan, which started a series of unfortunate disasters.', '2022-11-11', 'images/suzume.jpg', 'https://www.cwfilms.jp/en/news/article/a_new_poster_has_been_released_featuring_the_main_character.html', 115),
(20, 'THE WITCH: PART 2.THE OTHER ONE', 'Shin Shi A, Lee Jong Suk, Park Eun Bin, Jin Goo, Kim Da Mi', 'Somewhere, a girl wakes up in a huge secret laboratory. The girl accidentally meets Kyung-hee who is trying to protect her house from the gang who harassed her. When the gang bumps into the girl, they are overpowered by an unexpected power of her. In the meantime, the secret laboratory starts to find the missing girl. Who is this mysterious girl and why is she being chased?', '2022-07-11', 'images/stnt.jpg', 'https://youtu.be/pDkRx2yF0YA', 138);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rooms`
--

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
(7, 'VIP02', 3),
(9, 'S02', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roomtypes`
--

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
(7, 6, 6, '2022-07-23', '21:00:00', '22:51:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tickets`
--

CREATE TABLE `tbl_tickets` (
  `s_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `seat_id` varchar(5) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_tickets`
--

INSERT INTO `tbl_tickets` (`s_id`, `book_id`, `seat_id`, `price`) VALUES
(7, 1, 'D5', 180),
(7, 1, 'D7', 180),
(7, 2, 'E4', 180),
(7, 2, 'E6', 180);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `age` int(2) NOT NULL,
  `gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `name`, `email`, `phone`, `age`, `gender`) VALUES
(2, 'Hoai Nam', 'fuyuyukito@gmail.com', '9876543210', 20, 'male');

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
-- Indexes for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  ADD PRIMARY KEY (`s_id`,`book_id`,`seat_id`),
  ADD KEY `fk_bookings` (`book_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bookings`
--
ALTER TABLE `tbl_bookings`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_rooms`
--
ALTER TABLE `tbl_rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_roomtypes`
--
ALTER TABLE `tbl_roomtypes`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_shows`
--
ALTER TABLE `tbl_shows`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD CONSTRAINT `fk_regis` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE;

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
-- Constraints for table `tbl_tickets`
--
ALTER TABLE `tbl_tickets`
  ADD CONSTRAINT `fk_bookings` FOREIGN KEY (`book_id`) REFERENCES `tbl_bookings` (`book_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_tickets_ibfk_1` FOREIGN KEY (`s_id`) REFERENCES `tbl_shows` (`s_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
