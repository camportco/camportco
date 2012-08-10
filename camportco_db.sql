-- phpMyAdmin SQL Dump
-- version 3.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 10, 2012 at 07:31 PM
-- Server version: 5.0.67
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `camportco_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE IF NOT EXISTS `advertisement` (
  `id` int(10) NOT NULL auto_increment,
  `img_url` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL auto_increment,
  `cat_name` varchar(255) NOT NULL default '',
  `display_seq` int(10) NOT NULL,
  `sts` varchar(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `cat_name` (`cat_name`),
  KEY `display_seq` (`display_seq`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `category_make`
--

CREATE TABLE IF NOT EXISTS `category_make` (
  `cat_id` int(10) NOT NULL,
  `make_id` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `make`
--

CREATE TABLE IF NOT EXISTS `make` (
  `id` int(11) NOT NULL auto_increment,
  `make_name` varchar(255) NOT NULL,
  `display_seq` int(10) NOT NULL,
  `sts` varchar(1) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `make_name` (`make_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- Table structure for table `newslink`
--

CREATE TABLE IF NOT EXISTS `newslink` (
  `id` int(2) NOT NULL auto_increment,
  `url` varchar(255) collate utf8_bin NOT NULL,
  `content` text collate utf8_bin NOT NULL,
  `display_seq` int(10) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) NOT NULL auto_increment,
  `product_id` varchar(30) default '0',
  `make_id` int(10) default NULL,
  `make_name` varchar(255) default NULL,
  `model` varchar(255) default NULL,
  `remark` text,
  `name` varchar(255) default NULL,
  `pcs` int(11) NOT NULL default '0',
  `price` double(10,2) default '0.00',
  `sup` varchar(255) default NULL,
  `colour` varchar(100) default NULL,
  `location` varchar(100) default NULL,
  `model_no` varchar(255) default NULL,
  `year` varchar(100) default NULL,
  `cat_id` int(10) default NULL,
  `cat_name` varchar(20) default NULL,
  `desc` text,
  `stock` int(11) NOT NULL default '0',
  `material` varchar(255) NOT NULL,
  `display_seq` int(10) NOT NULL,
  `sts` varchar(1) NOT NULL,
  `photo_cnt` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `product_id` (`product_id`),
  KEY `make_id` (`make_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=883 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_back`
--

CREATE TABLE IF NOT EXISTS `product_back` (
  `id` int(10) NOT NULL auto_increment,
  `product_id` varchar(30) default '0',
  `make_id` int(10) default NULL,
  `make_name` varchar(255) default NULL,
  `model` varchar(255) default NULL,
  `remark` tinytext,
  `name` varchar(255) default NULL,
  `pcs` int(11) NOT NULL default '0',
  `price` double(10,2) default '0.00',
  `sup` varchar(255) default NULL,
  `colour` varchar(100) default NULL,
  `location` varchar(100) default NULL,
  `model_no` varchar(255) default NULL,
  `year` varchar(100) default NULL,
  `cat_id` int(10) default NULL,
  `cat_name` varchar(20) default NULL,
  `desc` text,
  `stock` int(11) NOT NULL default '0',
  `material` varchar(255) NOT NULL,
  `display_seq` int(10) NOT NULL,
  `sts` varchar(1) NOT NULL,
  `photo_cnt` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 PACK_KEYS=0 AUTO_INCREMENT=422 ;

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE IF NOT EXISTS `slideshow` (
  `id` int(2) NOT NULL auto_increment,
  `url` varchar(255) collate utf8_bin NOT NULL,
  `jpg` varchar(255) collate utf8_bin NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `systemparameters`
--

CREATE TABLE IF NOT EXISTS `systemparameters` (
  `id` int(10) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
