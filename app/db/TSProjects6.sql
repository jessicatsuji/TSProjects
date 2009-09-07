-- phpMyAdmin SQL Dump
-- version 2.7.0-pl2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 06, 2009 at 05:49 PM
-- Server version: 5.0.19
-- PHP Version: 5.1.6
-- 
-- Database: `TSProjects`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `languages`
-- 

CREATE TABLE `languages` (
  `id` int(255) NOT NULL auto_increment,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `languages`
-- 

INSERT INTO `languages` VALUES (2, 'HTML');
INSERT INTO `languages` VALUES (3, 'CSS');
INSERT INTO `languages` VALUES (4, 'XML');
INSERT INTO `languages` VALUES (5, 'JavaScript');
INSERT INTO `languages` VALUES (6, 'PHP');
INSERT INTO `languages` VALUES (7, 'ActionScript');

-- --------------------------------------------------------

-- 
-- Table structure for table `photos`
-- 

CREATE TABLE `photos` (
  `id` int(255) NOT NULL auto_increment,
  `file_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `project_id` int(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `photos`
-- 

INSERT INTO `photos` VALUES (9, '3684fc32f48814ecb2cf833d9d591bb0-12.png', 'landscape', 12);
INSERT INTO `photos` VALUES (8, '9b257c6c465beae17c5ffc17d53d3792-12.jpg', 'portrait', 12);

-- --------------------------------------------------------

-- 
-- Table structure for table `project_languages`
-- 

CREATE TABLE `project_languages` (
  `id` int(255) NOT NULL auto_increment,
  `language_id` int(255) NOT NULL,
  `project_id` int(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- 
-- Dumping data for table `project_languages`
-- 

INSERT INTO `project_languages` VALUES (1, 2, 7);
INSERT INTO `project_languages` VALUES (2, 3, 7);
INSERT INTO `project_languages` VALUES (3, 5, 8);
INSERT INTO `project_languages` VALUES (28, 7, 10);
INSERT INTO `project_languages` VALUES (27, 6, 10);
INSERT INTO `project_languages` VALUES (26, 5, 10);
INSERT INTO `project_languages` VALUES (25, 4, 10);
INSERT INTO `project_languages` VALUES (24, 3, 10);
INSERT INTO `project_languages` VALUES (11, 2, 12);
INSERT INTO `project_languages` VALUES (23, 2, 10);

-- --------------------------------------------------------

-- 
-- Table structure for table `project_tools`
-- 

CREATE TABLE `project_tools` (
  `id` int(255) NOT NULL auto_increment,
  `tools_id` int(255) NOT NULL,
  `project_id` int(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

-- 
-- Dumping data for table `project_tools`
-- 

INSERT INTO `project_tools` VALUES (1, 0, 5);
INSERT INTO `project_tools` VALUES (2, 1, 6);
INSERT INTO `project_tools` VALUES (3, 3, 6);
INSERT INTO `project_tools` VALUES (4, 5, 6);
INSERT INTO `project_tools` VALUES (5, 6, 6);
INSERT INTO `project_tools` VALUES (6, 3, 7);
INSERT INTO `project_tools` VALUES (7, 5, 7);
INSERT INTO `project_tools` VALUES (8, 7, 7);
INSERT INTO `project_tools` VALUES (9, 3, 8);
INSERT INTO `project_tools` VALUES (10, 4, 8);
INSERT INTO `project_tools` VALUES (33, 6, 10);
INSERT INTO `project_tools` VALUES (32, 5, 10);
INSERT INTO `project_tools` VALUES (24, 8, 12);
INSERT INTO `project_tools` VALUES (23, 7, 12);
INSERT INTO `project_tools` VALUES (22, 3, 12);

-- --------------------------------------------------------

-- 
-- Table structure for table `projects`
-- 

CREATE TABLE `projects` (
  `id` int(255) NOT NULL auto_increment,
  `url` varchar(255) NOT NULL,
  `author_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `courses` varchar(255) NOT NULL,
  `date_month` varchar(255) NOT NULL,
  `date_day` varchar(255) NOT NULL,
  `date_year` varchar(255) NOT NULL,
  `assign_spec` varchar(255) NOT NULL,
  `project_approach` varchar(255) NOT NULL,
  `other_tools` varchar(255) NOT NULL,
  `other_languages` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- 
-- Dumping data for table `projects`
-- 

INSERT INTO `projects` VALUES (4, 'project', '14', 'new', 'is', 'march', '5', '2011', 'created', 'now', 'other', 'other');
INSERT INTO `projects` VALUES (3, 'url', '14', 'project', 'course', 'june', '8', '2006', 'hello world', 'appppppproach', 'other tooollllzzzzz', 'other languages');
INSERT INTO `projects` VALUES (5, 'proj', '14', 'new', 'jsld', 'default_month', 'default_day', 'default_year', 'asdf', 'asdf', 'other', 'other');
INSERT INTO `projects` VALUES (6, 'project', '14', 'one', '23232', 'default_month', 'default_day', 'default_year', 'asdf', 'asdf', 'other', 'other');
INSERT INTO `projects` VALUES (7, 'please', '14', 'work', 'project', 'december', '16', '2013', 'asdf', 'asdf', 'other', 'other');
INSERT INTO `projects` VALUES (8, 'this', '14', 'refresh', 'page', 'july', '14', '2010', 'asdf', 'asdf', 'other', 'other');
INSERT INTO `projects` VALUES (10, 'asdf MORE EDIT', '16', 'a new project EDITEDDDDDD', 'asdf', 'default_month', '17', '2015', 'asdfasdfasdf', 'asdfasdf', 'other', 'other');
INSERT INTO `projects` VALUES (12, '123', '16', 'testing', '2349872', 'june', '12', '2002', 'asdf', 'asdf', 'other', 'other');

-- --------------------------------------------------------

-- 
-- Table structure for table `tools`
-- 

CREATE TABLE `tools` (
  `id` int(255) NOT NULL auto_increment,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `tools`
-- 

INSERT INTO `tools` VALUES (1, 'Photoshop');
INSERT INTO `tools` VALUES (2, 'Flash');
INSERT INTO `tools` VALUES (3, 'Illustrator');
INSERT INTO `tools` VALUES (4, 'Dreamweaver');
INSERT INTO `tools` VALUES (5, 'Fireworks');
INSERT INTO `tools` VALUES (6, 'Coda');
INSERT INTO `tools` VALUES (7, 'Textmate');
INSERT INTO `tools` VALUES (8, 'jQuery');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` VALUES (16, 'new', 'new', 'new', '22wvwMsFozMYI', 'new', 'new', 0x30);
INSERT INTO `users` VALUES (15, 'new@user.com', 'new', 'user', 'b9rQEMKYz4Ybw', 'pass', 'pass', 0x30);
INSERT INTO `users` VALUES (14, 'jess@ica.com', 'jess', 'jess', 'f7qiDNa/VbX7Y', 'pass', 'pass', 0x30);
