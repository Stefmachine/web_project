-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2017 at 06:00 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ooze`
--
CREATE DATABASE IF NOT EXISTS `db_ooze` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `db_ooze`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `completed_time` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `state` varchar(100) COLLATE utf8_bin NOT NULL,
  `update_time` int(11) NOT NULL DEFAULT '0',
  `creation_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `completed_time`, `user_id`, `state`, `update_time`, `creation_time`) VALUES
(1, NULL, 1, 'pending', 1511739857, 1511739857);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_product`
--

DROP TABLE IF EXISTS `tbl_order_product`;
CREATE TABLE `tbl_order_product` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cost` double(4,2) NOT NULL,
  `creation_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tbl_order_product`
--

INSERT INTO `tbl_order_product` (`order_id`, `product_id`, `quantity`, `size`, `cost`, `creation_time`, `update_time`) VALUES
(1, 2, 1, 'small', 3.99, 1511936110, 1511936110),
(1, 15, 1, 'regular', 5.99, 1511934844, 1511934844),
(1, 12, 3, 'regular', 17.95, 1511919834, 1511919834),
(1, 7, 1, 'regular', 4.49, 1511919824, 1511919824),
(1, 9, 3, 'small', 8.97, 1511919838, 1511919838),
(1, 10, 1, 'regular', 2.98, 1511919784, 1511919784),
(1, 8, 1, 'small', 3.49, 1511919440, 1511919440);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `cost` double(4,2) NOT NULL,
  `picture` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `creation_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `description`, `cost`, `picture`, `tags`, `creation_time`, `update_time`) VALUES
(1, 'Taco régulier', 'Taco avec les ingrédients traditionnels', 2.49, 'taco-reg.jpg', 'taco,regulier', 1511331226, 1511331226),
(2, 'Taco végétarien', 'Taco sans viande et avec des protéines de soya', 3.99, 'taco-veg.jpg', 'taco,vegetarien', 0, 0),
(3, 'Tortilla régulière', 'Tortilla traditionnelle', 0.99, 'tortilla-reg.jpg', 'tortilla,regulier', 0, 0),
(4, 'Tortilla aux grains entiers', 'Tortilla faite avec de la farine aux graisn entiers', 1.49, 'tortilla-gen.jpg', 'tortilla', 0, 0),
(5, 'Tortilla au mais', 'Tortilla faite avec de la farine de mais', 1.99, 'tortilla-ama.jpg', 'tortilla', 0, 0),
(6, 'Enchilada verte', 'Taco avec piments verts', 2.99, 'enchilada-ver.jpg', 'enchilada', 0, 0),
(7, 'Enchilada rouge', 'Taco avec tomates et piments rouges', 2.99, 'enchilada-rou.jpg', 'enchilada', 0, 0),
(8, 'Enchilada au mole', 'Enchilada avec sauce au mole', 3.49, 'enchilada-mol.jpg', 'enchilada', 0, 0),
(9, 'Quesadilla régulier', 'Quesadilla avec les ingrédients traditionnels', 2.99, 'quesadilla-reg.jpg', 'quesadilla,regulier', 0, 0),
(10, 'Quesadilla simplifiée', 'Quesadilla avec fromage seulement', 1.99, 'quesadilla-sim.jpg', 'quesadilla', 0, 0),
(11, 'Burrito régulier', 'Burrito avec les ingrédients traditionnels', 2.99, 'burrito-reg.jpg', 'burrito,regulier', 0, 0),
(12, 'Burrito végétarien', 'Burrito sans viande et avec des protéines de soya', 3.99, 'burrito-veg.jpg', 'burrito,vegetarien', 0, 0),
(13, 'Chimichanga régulier', 'Chimichanga avec les ingrédients traditionnels', 2.99, 'chimichanga-reg.jpg', 'chimichanga,regulier', 0, 0),
(14, 'Chimichanga extra de riz', 'Chimichanga avec deux fois plus de riz', 4.99, 'chimichanga-eri.jpg', 'chimichanga', 0, 0),
(15, 'Chimichanga végétarienne', 'Chimichanga sans viande et avec des protéines de soya', 3.99, 'chimichanga-veg.jpg', 'chimichanga,vegetarien', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `creation_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `first_name`, `last_name`, `email`, `creation_time`, `update_time`) VALUES
(1, 'admin', 'admin', 'Admin', 'User', 'fake@address.com', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
