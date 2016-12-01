-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 02, 2016 at 09:16 PM
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stream_chat`
--

INSERT INTO `stream_chat` (`id`, `user_id`, `tag`, `state`) VALUES
(12, 30, 'cssfg', 1),
(13, 25, 'sdsfdft', 1),
(14, 27, 'ddgfhaadyerxg234', 1),
(15, 21, '213dttvv', 1),
(16, 32, 'myfirststream', 1),
(17, 23, 'leagueoflegends', 1),
(18, 17, 'grad_cam_1', 1),
(19, 25, 'cam_2', 1),
(20, 32, 'cam_4', 1),
(21, 24, 'dfgdgfh', 1),
(22, 18, '32afvdf4', 1),
(23, 20, '3sf46fg', 1),
(24, 29, '3sxcjuhjh', 1),
(25, 23, 'oyptdfy', 1),
(26, 23, '232xcd65', 1),
(27, 20, 'sadddsxxv', 1),
(28, 25, '3sfd454s', 1),
(29, 26, '566ggdd5', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
--
-- Dumping data for table `stream_video`
--

INSERT INTO `stream_video` (`id`, `user_id`, `title`, `tag`, `description`, `numOfConnections`, `maxConnections`, `state`, `recordable`, `stream_key`) VALUES
(12, 30, 'Cooking time - roast dinner', 'cssfg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s', 0, 1000, 0, 0, 'ofm3rtqyz3'),
(13, 25, 'Graduation - Berlin University', 'sdsfdft', 'It has survived not only five centuries, but also the leap into electronic typesetting.', 0, 1000, 0, 0, '32pfglrp?1'),
(14, 27, 'League of legends - TSM', 'ddgfhaadyerxg234', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 0, 1000, 0, 0, 'lfao-bq8yv'),
(15, 21, 'Lorem ipsum title', '213dttvv', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s', 0, 1000, 0, 0, 'dw03ug2rkj'),
(16, 32, 'Lorem ipsum title', 'myfirststream', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 0, 1000, 0, 0, 'e!l8q6yi5a'),
(17, 23, 'Graduation - London University', 'leagueoflegends', 'It has survived not only five centuries, but also the leap into electronic typesetting.', 0, 1000, 0, 0, 'mi2n3iogb5'),
(18, 17, 'Graduation - Hull University', 'grad_cam_1', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 0, 1000, 0, 0, 'jsz6x5c4sw'),
(19, 25, 'Graduation - London University', 'cam_2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s', 0, 1000, 0, 0, 'mnfxb0vrvd'),
(20, 32, 'Graduation - Hull University', 'cam_4', 'Using new stream to reach out to my fans!!!! Hellooo.', 0, 1000, 0, 0, 'lfbmc4gs-p'),
(21, 24, 'Live with countryfile mag', 'dfgdgfh', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 0, 1000, 0, 0, 'v2epynzfda'),
(22, 18, 'Graduation - London University', '32afvdf4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s', 0, 1000, 0, 0, 'um-hmfa8xb'),
(23, 20, 'Graduation - Berlin University', '3sf46fg', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 0, 1000, 0, 0, '99lxjlvyf7'),
(24, 29, 'Cooking time - roast dinner', '3sxcjuhjh', 'It has survived not only five centuries, but also the leap into electronic typesetting.', 0, 1000, 0, 0, '6z29x09fj3'),
(25, 23, 'Building a custom pc', 'oyptdfy', 'It has survived not only five centuries, but also the leap into electronic typesetting.', 0, 1000, 0, 0, '?6s2t-1qtl'),
(26, 23, 'Live with countryfile mag', '232xcd65', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 0, 1000, 0, 0, 'qjj8fg6!5x'),
(27, 20, 'Cooking time - roast dinner', 'sadddsxxv', 'It has survived not only five centuries, but also the leap into electronic typesetting.', 0, 1000, 0, 0, 'wbpb4!puj7'),
(28, 25, 'Live with PC mag', '3sfd454s', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s', 0, 1000, 0, 0, 'g248hq50fz'),
(29, 26, 'Building a custom pc', '566ggdd5', 'Using new stream to reach out to my fans!!!! Hellooo.', 0, 1000, 0, 0, 'g3qv8dfjb!');
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

ALTER TABLE `stream_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `stream_video`
--
ALTER TABLE `stream_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
