-- phpMyAdmin SQL Dump
-- version 2.7.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Aug 25, 2009 at 11:36 PM
-- Server version: 5.0.19
-- PHP Version: 5.1.6
-- 
-- Database: `TSProjects`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `language`
-- 

CREATE TABLE `language` (
  `id` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `language`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `photos`
-- 

CREATE TABLE `photos` (
  `id` int(255) NOT NULL,
  `prof_img` varchar(255) NOT NULL,
  `landscape_img` varchar(255) NOT NULL,
  `screen_shot1` varchar(255) NOT NULL,
  `screen_shot2` varchar(255) NOT NULL,
  `screen_shot3` varchar(255) NOT NULL,
  `screen_shot4` varchar(255) NOT NULL,
  `screen_shot5` varchar(255) NOT NULL,
  `screen_shot6` varchar(255) NOT NULL,
  `project_id` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `photos`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `project_languages`
-- 

CREATE TABLE `project_languages` (
  `id` int(255) NOT NULL auto_increment,
  `languages_id` int(255) NOT NULL,
  `project_id` int(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `project_languages`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `project_tools`
-- 

CREATE TABLE `project_tools` (
  `id` int(255) NOT NULL auto_increment,
  `tools_id` int(255) NOT NULL,
  `project_id` int(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `project_tools`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `projects`
-- 

CREATE TABLE `projects` (
  `id` int(255) NOT NULL auto_increment,
  `url` varchar(255) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `courses` varchar(255) NOT NULL,
  `date_complete` varchar(255) NOT NULL,
  `assign_spec` varchar(255) NOT NULL,
  `project_approach` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `other_tools` varchar(255) NOT NULL,
  `other_languages` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `projects`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `tools`
-- 

CREATE TABLE `tools` (
  `id` int(255) NOT NULL auto_increment,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `tools`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

CREATE TABLE `users` (
  `id` int(255) NOT NULL auto_increment,
  `email` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `security_question` varchar(255) NOT NULL,
  `security_answer` varchar(255) NOT NULL,
  `admin` binary(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (15, 'new@user.com', 'new', 'user', 'b9rQEMKYz4Ybw', 'pass', 'pass', 0x30);
INSERT INTO `users` VALUES (14, 'jess@ica.com', 'jess', 'jess', 'f7qiDNa/VbX7Y', 'pass', 'pass', 0x30);
