-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Aug 11, 2015 at 08:44 PM
-- Server version: 5.5.34
-- PHP Version: 5.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `isw`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `command_id` int(11) NOT NULL,
  `type` enum('Train','Rest','Repair','Move','Assault','Attack','Raid','Counter Insurgency','Guerilla Warfare','Shield','Commerce Raid','Fortify','Dig In','Defend','Go to Ground','Scatter','Patrol') NOT NULL,
  `points` int(11) NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `game_id` (`game_id`,`command_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

