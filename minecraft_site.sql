-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 07, 2022 at 11:41 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `minecraft_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `pseudo` varchar(256) NOT NULL,
  `id_users` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `article` text NOT NULL,
  `id_article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`pseudo`, `id_users`, `title`, `article`, `id_article`) VALUES
('Picman', 8, 'Mon premier article', 'Bonjour, ceci est mon premier Article', 47),
('Lapi', 7, 'Je suis un lapin', 'Je suis un lapin', 51),
('Lapi', 7, 'Salutation', 'Bonjour je suis nouveau ici', 52),
('Titigre', 9, 'test', 'test 2', 80),
('Picman', 8, 'Ceci est mon second article !', 'Je suis heureux de vous présenter mon second article !', 82),
('Lapi', 7, 'le dernier article', 'Je suis le dernier article ', 83),
('Titigre', 9, 'New article', 'J''ajoute un article', 84);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `pseudo` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `is_banned` tinyint(1) NOT NULL,
  `avatar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `pseudo`, `email`, `password`, `is_banned`, `avatar`) VALUES
(6, 'Test', 'test@gmail.com', 'test', 0, '6.png'),
(7, 'Lapi', 'lapi@gmail.com', 'lapi', 0, '7.png'),
(8, 'Picman', 'picman@gmail.com', 'banana', 0, '8.png'),
(9, 'Titigre', 'titigremc@gmail.com', 'titigre', 0, '9.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id_article`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id_article` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
