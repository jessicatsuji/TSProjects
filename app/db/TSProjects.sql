-- phpMyAdmin SQL Dump
-- version 2.11.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 10, 2009 at 09:20 PM
-- Server version: 5.0.41
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `TSProjects`
--

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL auto_increment,
  `prof_img` text NOT NULL,
  `landscape_img` text NOT NULL,
  `screen_shot1` text NOT NULL,
  `screen_shot2` text NOT NULL,
  `screen_shot3` text NOT NULL,
  `screen_shot4` text NOT NULL,
  `screen_shot5` text NOT NULL,
  `screen_shot6` text NOT NULL,
  `projects_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` VALUES(1, 'profile_image.jpg', 'landscape_image.jpg', 'screen_shot1.jpg', 'screen_shot2.jpg', 'screen_shot3.jpg', 'screen_shot4.jpg', 'screen_shot5.jpg', 'screen_shot6.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `title` text NOT NULL,
  `tools` text NOT NULL,
  `course` text NOT NULL,
  `languages` text NOT NULL,
  `date_complete` varchar(10) NOT NULL,
  `assign_spec` mediumtext NOT NULL,
  `project_approach` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` VALUES(0, 'www.example.com', 'Example', 'Photoshop', 'WDIM366', 'PHP', '08/10/2009', 'Here is where what the assignment specification.', 'Here is where you would put in the project approach.');
