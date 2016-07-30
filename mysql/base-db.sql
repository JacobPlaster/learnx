-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 31, 2016 at 12:55 AM
-- Server version: 5.5.42
-- PHP Version: 5.4.42

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `learnx`
--

-- --------------------------------------------------------

--
-- Table structure for table `stream_chat`
--

CREATE TABLE `stream_chat` (
  `user_id` int(11) NOT NULL,
  `tag` varchar(32) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stream_chat`
--

INSERT INTO `stream_chat` (`user_id`, `tag`, `state`) VALUES
(27, 'cssfg', 0),
(29, 'sdsfdft', 0),
(30, 'ddgfhaadyerxg234', 0),
(18, '213dttvv', 0),
(18, 'myfirststream', 0),
(28, 'leagueoflegends', 0),
(22, 'grad_cam_1', 0),
(19, 'cam_2', 0),
(24, 'cam_4', 0),
(25, 'dfgdgfh', 0),
(20, '32afvdf4', 0);

-- --------------------------------------------------------

--
-- Table structure for table `stream_video`
--

CREATE TABLE `stream_video` (
  `user_id` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `tag` varchar(32) NOT NULL,
  `description` varchar(400) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0',
  `stream_key` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stream_video`
--

INSERT INTO `stream_video` (`user_id`, `title`, `tag`, `description`, `state`, `stream_key`) VALUES
(27, 'Building a custom pc', 'cssfg', 'It has survived not only five centuries, but also the leap into electronic typesetting.', 0, 'r6pxxh6!gn'),
(29, 'Live with countryfile mag', 'sdsfdft', 'Using new stream to reach out to my fans!!!! Hellooo.', 0, 'qwxgtalqe0'),
(30, 'Live with PC mag', 'ddgfhaadyerxg234', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s', 0, '9gpz-8t7tt'),
(18, 'Live with countryfile mag', '213dttvv', 'It has survived not only five centuries, but also the leap into electronic typesetting.', 0, '0ah889wymx'),
(18, 'Live with PC mag', 'myfirststream', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 0, 'yqz9az2hz?'),
(28, 'Graduation - Hull University', 'leagueoflegends', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s', 0, 'hnockoq6bx'),
(22, 'League of legends - TSM', 'grad_cam_1', 'when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 0, 'g0ppbh5jvg'),
(19, 'Cooking time - roast dinner', 'cam_2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s', 0, 'd-lbc8kqvo'),
(24, 'Live with PC mag', 'cam_4', 'Using new stream to reach out to my fans!!!! Hellooo.', 0, 'd77zb74?tp'),
(25, 'Graduation - London University', 'dfgdgfh', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s', 0, 'xwfzk7o5a-'),
(20, 'Cooking time - roast dinner', '32afvdf4', 'Using new stream to reach out to my fans!!!! Hellooo.', 0, 'u48ox3ilfj');

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`) VALUES
(17, 'Jacob', 'Jacob', 'Jacob@gmail.com'),
(18, 'Admin', 'Admin', 'Admin@gmail.com'),
(19, 'Yaqub', 'Yaqub', 'Yaqub@gmail.com'),
(20, 'Dave232', 'Dave232', 'Dave232@gmail.com'),
(21, 'THomster24', 'THomster24', 'THomster24@gmail.com'),
(22, 'Sir_Clownz', 'Sir_Clownz', 'Sir_Clownz@gmail.com'),
(23, 'MrGrathen', 'MrGrathen', 'MrGrathen@gmail.com'),
(24, 'Am_Dirty', 'Am_Dirty', 'Am_Dirty@gmail.com'),
(25, 'musclemayoan', 'musclemayoan', 'musclemayoan@gmail.com'),
(26, 'ChampChong', 'ChampChong', 'ChampChong@gmail.com'),
(27, 'root', 'root', 'root@gmail.com'),
(28, 'conor747', 'conor747', 'conor747@gmail.com'),
(29, 'Thornster321', 'Thornster321', 'Thornster321@gmail.com'),
(30, 'Markell8743', 'Markell8743', 'Markell8743@gmail.com'),
(31, 'WockaWocka', 'WockaWocka', 'WockaWocka@gmail.com'),
(32, 'a', 'a', 'a@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
