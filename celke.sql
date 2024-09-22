-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 26-Nov-2023 às 18:21
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `celke`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `obs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `events`
--

INSERT INTO `events` (`id`, `title`, `color`, `start`, `end`, `obs`, `user_id`) VALUES
(1, 'Tutorial 1G', '#FFD700', '2023-10-16 10:05:00', '2023-10-16 11:05:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 1),
(2, 'Tutorial 2C', '#FF4500', '2023-10-18 10:06:00', '2023-10-18 16:06:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 1),
(3, 'Tutorial 3K', '#228B22', '2023-10-20 11:07:00', '2023-10-20 12:07:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 1),
(4, 'Tutorial 4C', '#A020F0', '2023-10-23 11:08:00', '2023-10-23 11:08:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 1),
(5, 'Tutorial 5', '#40E0D0', '2023-10-25 10:09:00', '2023-10-26 11:09:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 1),
(6, 'Tutorial 6C', '#0071c5', '2023-10-27 10:10:00', '2023-10-27 11:10:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 1),
(7, 'Tutorial 7', '#A020F0', '2023-10-30 10:05:00', '2023-10-30 11:05:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 1),
(8, 'Tutorial 8', '#8B0000', '2023-11-01 10:00:00', '2023-11-01 11:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 1),
(9, 'Tutorial 9', '#FF4500', '2023-11-03 10:01:00', '2023-11-03 10:01:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 1),
(10, 'Tutorial 10', '#228B22', '2023-11-06 10:01:00', '2023-11-06 10:01:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 2),
(11, 'Tutorial 11', '#8B4513', '2023-11-08 10:01:00', '2023-11-08 10:01:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 1),
(12, 'Tutorial 12', '#FFD700', '2023-11-10 10:01:00', '2023-11-10 10:01:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 1),
(13, 'Tutorial 13', '#40E0D0', '2023-11-13 00:00:00', '2023-11-14 00:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 3),
(14, 'Tutorial 14', '#436EEE', '2023-11-15 10:00:00', '2023-11-16 10:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 1),
(15, 'Tutorial 15', '#1C1C1C', '2023-11-17 10:00:00', '2023-11-17 10:00:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 1),
(16, 'Tutorial 16', '#228B22', '2023-11-20 10:00:00', '2023-11-20 10:30:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus vitae augue eget tortor finibus laoreet ut eget dui.', 1),
(17, 'Tutorial 17', '#FF4500', '2023-11-22 10:00:00', '2023-11-22 11:00:00', 'In fringilla augue eu est porta mattis.', 1),
(18, 'Tutorial 18', '#0071c5', '2023-11-24 10:00:00', '2023-11-24 11:00:00', '18 Quisque rutrum, quam eget aliquet laoreet, sem metus vulputate lorem, sit amet congue ipsum.', 1),
(19, 'Tutorial 21', '#228B22', '2023-12-01 10:00:00', '2023-12-01 11:00:00', 'Donec non cursus dui. Etiam eu tellus pharetra, eleifend diam et, egestas ipsum. Nam non urna eget erat suscipit dapibus. ', 2),
(20, 'Tutorial 19', '#8B0000', '2023-11-27 10:00:00', '2023-11-27 11:00:00', 'Aenean venenatis aliquam leo maximus lacinia.', 1),
(21, 'Tutorial 22', '#FF4500', '2023-12-04 00:00:00', '2023-12-04 00:00:00', 'Tutorial 22', 3),
(22, 'Tutorial 23', '#436EEE', '2023-12-06 00:00:00', '2023-12-06 00:00:00', 'Tutorial 23', 4),
(23, 'Tutorial 20', '#A020F0', '2023-11-29 00:00:00', '2023-11-29 00:00:00', 'Tutorial 20', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(220) NOT NULL,
  `email` varchar(220) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`) VALUES
(1, 'Cesar', 'cesar@celke.com.br'),
(2, 'Kelly', 'kelly@celke.com.br'),
(3, 'Jessica', 'jessica@celke.com.br'),
(4, 'Gabrielly', 'gabrielly@celke.com.br');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
