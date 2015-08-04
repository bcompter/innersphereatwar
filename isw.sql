-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Aug 04, 2015 at 11:55 AM
-- Server version: 5.5.38
-- PHP Version: 5.5.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `isw`
--

-- --------------------------------------------------------

--
-- Table structure for table `battalions`
--

CREATE TABLE `battalions` (
`battalion_id` int(11) NOT NULL,
  `regiment_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `combat_commands`
--

CREATE TABLE `combat_commands` (
`command_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `game_id` int(11) NOT NULL,
  `faction_id` int(11) NOT NULL,
  `planet_id` int(11) NOT NULL,
  `mechs` int(11) NOT NULL,
  `vehicles` int(11) NOT NULL,
  `infantry` int(11) NOT NULL,
  `aero` int(11) NOT NULL,
  `artillery` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
`company_id` int(11) NOT NULL,
  `battalion_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `elements`
--

CREATE TABLE `elements` (
`element_id` int(11) NOT NULL,
  `lance_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `class` enum('Light','Medium','Heavy','Assault') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `factions`
--

CREATE TABLE `factions` (
`faction_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `color` varchar(12) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
`game_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `turn` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
`id` mediumint(8) unsigned NOT NULL,
  `name` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `description` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lances`
--

CREATE TABLE `lances` (
`lance_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `class` enum('Light','Medium','Heavy','Assault') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meta`
--

CREATE TABLE `meta` (
`id` mediumint(8) unsigned NOT NULL,
  `user_id` mediumint(8) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `planets`
--

CREATE TABLE `planets` (
`planet_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
`player_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `faction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rat`
--

CREATE TABLE `rat` (
`rat_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `faction` varchar(200) NOT NULL,
  `type` enum('Mech','Vehicle','Aero','') NOT NULL,
  `class` enum('Light','Medium','Heavy','Assault') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rat_data`
--

CREATE TABLE `rat_data` (
`data_id` int(11) NOT NULL,
  `rat_id` int(11) NOT NULL,
  `roll` int(11) NOT NULL,
  `value` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `regiments`
--

CREATE TABLE `regiments` (
`regiment_id` int(11) NOT NULL,
  `command_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` enum('Mech','Vehicle','Infantry','Aero') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
`unit_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` enum('Mech','Vehicle','Infantry','Aero') NOT NULL,
  `size` int(11) NOT NULL,
  `move` int(11) NOT NULL,
  `has_jump` int(11) NOT NULL,
  `short_dmg` int(11) NOT NULL,
  `med_dmg` int(11) NOT NULL,
  `long_dmg` int(11) NOT NULL,
  `overheat` int(11) NOT NULL,
  `armor` int(11) NOT NULL,
  `structure` int(11) NOT NULL,
  `special` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
`id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  `ip_address` char(16) COLLATE latin1_general_ci NOT NULL,
  `username` varchar(25) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(40) COLLATE latin1_general_ci NOT NULL,
  `salt` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `activation_code` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `forgotten_password_code` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `remember_code` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `battalions`
--
ALTER TABLE `battalions`
 ADD PRIMARY KEY (`battalion_id`), ADD KEY `regiment_id` (`regiment_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `combat_commands`
--
ALTER TABLE `combat_commands`
 ADD PRIMARY KEY (`command_id`), ADD KEY `game_id` (`game_id`,`faction_id`,`planet_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
 ADD PRIMARY KEY (`company_id`), ADD KEY `battalion_id` (`battalion_id`);

--
-- Indexes for table `elements`
--
ALTER TABLE `elements`
 ADD PRIMARY KEY (`element_id`), ADD KEY `lance_id` (`lance_id`);

--
-- Indexes for table `factions`
--
ALTER TABLE `factions`
 ADD PRIMARY KEY (`faction_id`), ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
 ADD PRIMARY KEY (`game_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lances`
--
ALTER TABLE `lances`
 ADD PRIMARY KEY (`lance_id`), ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `meta`
--
ALTER TABLE `meta`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planets`
--
ALTER TABLE `planets`
 ADD PRIMARY KEY (`planet_id`), ADD KEY `game_id` (`game_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
 ADD PRIMARY KEY (`player_id`), ADD KEY `game_id` (`game_id`,`user_id`,`faction_id`);

--
-- Indexes for table `rat`
--
ALTER TABLE `rat`
 ADD PRIMARY KEY (`rat_id`);

--
-- Indexes for table `rat_data`
--
ALTER TABLE `rat_data`
 ADD PRIMARY KEY (`data_id`), ADD KEY `rat_id` (`rat_id`);

--
-- Indexes for table `regiments`
--
ALTER TABLE `regiments`
 ADD PRIMARY KEY (`regiment_id`), ADD KEY `command_id` (`command_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
 ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `battalions`
--
ALTER TABLE `battalions`
MODIFY `battalion_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `combat_commands`
--
ALTER TABLE `combat_commands`
MODIFY `command_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `elements`
--
ALTER TABLE `elements`
MODIFY `element_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `factions`
--
ALTER TABLE `factions`
MODIFY `faction_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
MODIFY `game_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lances`
--
ALTER TABLE `lances`
MODIFY `lance_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `meta`
--
ALTER TABLE `meta`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `planets`
--
ALTER TABLE `planets`
MODIFY `planet_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rat`
--
ALTER TABLE `rat`
MODIFY `rat_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rat_data`
--
ALTER TABLE `rat_data`
MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `regiments`
--
ALTER TABLE `regiments`
MODIFY `regiment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
