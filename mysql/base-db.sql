-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 01, 2016 at 08:44 PM
-- Server version: 5.5.42
-- PHP Version: 5.4.42

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `learnx`
--

-- --------------------------------------------------------

--
-- Table structure for table `saved_video`
--

CREATE TABLE `saved_video` (
  `stream_video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(16) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `stream_chat`
--

CREATE TABLE `stream_chat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tag` varchar(32) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `stream_video`
--

CREATE TABLE `stream_video` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `tag` varchar(32) NOT NULL,
  `description` varchar(400) NOT NULL,
  `numOfConnections` int(11) NOT NULL DEFAULT '0',
  `maxConnections` int(11) NOT NULL DEFAULT '1000',
  `state` int(11) NOT NULL DEFAULT '0',
  `recordable` int(11) NOT NULL DEFAULT '0',
  `stream_key` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(24) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stream_chat`
--
ALTER TABLE `stream_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stream_video`
--
ALTER TABLE `stream_video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stream_chat`
--
ALTER TABLE `stream_chat` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `stream_video`
--
ALTER TABLE `stream_video` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
