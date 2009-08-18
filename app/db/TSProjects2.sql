-- phpMyAdmin SQL Dump
-- version 2.7.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Aug 17, 2009 at 06:14 PM
-- Server version: 5.0.19
-- PHP Version: 5.1.6
-- 
-- Database: `tsProjects`
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
-- Table structure for table `projects`
-- 

CREATE TABLE `projects` (
  `id` int(255) NOT NULL auto_increment,
  `url` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `tools` varchar(255) NOT NULL,
  `courses` varchar(255) NOT NULL,
  `languages` varchar(255) NOT NULL,
  `date_complete` varchar(255) NOT NULL,
  `assign_spec` varchar(255) NOT NULL,
  `project_approach` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `projects`
-- 

