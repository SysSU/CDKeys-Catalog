-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 30, 2011 at 10:59 AM
-- Server version: 5.0.91
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shamthis_keystest`
--

-- --------------------------------------------------------

--
-- Table structure for table `cd_keys`
--

CREATE TABLE IF NOT EXISTS `cd_keys` (
  `id` mediumint(10) NOT NULL auto_increment,
  `program` varchar(75) default NULL,
  `program_key` varchar(75) default NULL,
  `program_notes` text NOT NULL,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `cd_keys`
--

INSERT INTO `cd_keys` (`id`, `program`, `program_key`, `program_notes`, `category`) VALUES
(1, 'First Key Name', 'First Key Key', '<p>First Key Notes</p>', 'Other');
