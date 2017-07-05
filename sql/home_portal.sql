-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 05, 2017 at 03:40 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `home_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `type` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `langtext`
--

CREATE TABLE IF NOT EXISTS `langtext` (
  `id` int(11) NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `langtext`
--

INSERT INTO `langtext` (`id`, `lang`, `text`) VALUES
(1, 'gr', '<p>Î ÏÎ¿ÎºÎµÎ¹Î¼ÎµÎ½Î¿Ï… Î¼Î¹Î± ÏƒÎµÎ»Î¹Î´Î± Ï†Î¹Î»Î¿Ï… Î½Î± ÎµÎ»ÎµÎ½Î¾ÎµÎ¹ Î±Î½ Î´Î¿Ï…Î»ÎµÏ…ÎµÎ¹ Î· Î´Î¹ÎºÎ· ÏƒÎ±Ï‚ Ï€ÏÎµÏ€ÎµÎ¹ Ï€ÏÏ‰Ï„Î± Î½Î± Î´Î¿Ï…Î»ÎµÏ…ÎµÎ¹ ÎµÎºÎµÎ¹Î½Î· ÎºÎ±Î¹ Î½Î± Î¼Ï€Î¿ÏÎµÎ¹Ï„Îµ Î½Î± Ï„Î· Î´ÎµÎ¹Ï„Îµ.</p> 						 <p>H Î´Î¹ÎµÏ…Î¸Ï…Î½ÏƒÎ· Ï„Î¿Ï… Ï†Î¹Î»Î¿Ï… Î¸Î± Ï€ÏÎµÏ€ÎµÎ¹ Î½Î± ÎµÎ¹Î½Î±Î¹ Î· Ï€ÏÎ±Î³Î¼Î±Ï„Î¹ÎºÎ· Ï„Î¿Ï… Ï€Ï‡. http://200.200.200.200:40 ÎºÎ±Î¹ Î¿Ï‡Î¹ Î· Ï€Î»Î±ÏƒÎ¼Î±Ï„Î¹ÎºÎ· Ï„Î¿Ï… Î´Î¹ÎµÏ…Î¸Ï…Î½ÏƒÎ· Î¿Ï€Ï‰Ï‚ Ï€Ï‡. http://homeportal.php0h.com/redirect.php?friend=friend</p>		'),
(1, 'en', '<p>If you want to test your page with a friend page his page must work.</p> <p>Friends address must be his real ex. http://200.200.200.200:40 and not his redirect address ex. http://homeportal.php0h.com/redirect.php?friend=friend</p>');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(10) unsigned NOT NULL,
  `lang` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(200) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `lang`, `text`) VALUES
(1, 'gr', 'Ï€ÏÎµÏ€ÎµÎ¹ Î½Î± Î´Ï‰Î¸ÎµÎ¹ ÎµÎ½Î± Î¿Î½Î¿Î¼Î±'),
(2, 'gr', 'Î‘Ï€Î±Î½Ï„Î·ÏƒÎ· ÏƒÎµ Î±Î½Î±ÎºÎ¿Î¹Î½Ï‰ÏƒÎ·'),
(3, 'gr', 'Î•Î¹ÏƒÎ±Î³Ï‰Î³Î® Î½Î­Î±Ï‚ Î±Î½Î±ÎºÎ¿Î¯Î½Ï‰ÏƒÎ·Ï‚'),
(46, 'gr', 'Î“ÎµÎ½Î¹ÎºÎ­Ï‚ ÏÏ…Î¸Î¼Î¯ÏƒÎµÎ¹Ï‚ '),
(5, 'gr', 'Î‘Î½Î±Î¶Î®Ï„Î·ÏƒÎ·'),
(6, 'gr', 'Ï†Î¯Î»Î¿Ï‚ Î”Î¹Î±Î´Î¹ÎºÏ„ÏÎ¿Ï…'),
(7, 'gr', 'Ï†Î¯Î»Î¿Ï‚ Ï„Î¿Ï€ÎºÎ¿Ï Î´Î¹ÎºÏ„ÏÎ¿Ï…'),
(8, 'gr', 'Î£Ï„Î¿Î¹Ï‡ÎµÎ¹Î± ÎµÏ€Î¹ÎºÎ¿Î¹Î½Ï‰Î½Î¯Î±Ï‚'),
(9, 'gr', 'Î‘Ï€Î±Î½Ï„Î·ÏƒÎ·'),
(10, 'gr', 'Î•Î¹ÏƒÎ±Î³Ï‰Î³Î® Î½Î­Î±Ï‚ Î±Î½Î±ÎºÎ¿Î¯Î½Ï‰ÏƒÎ·Ï‚'),
(11, 'gr', 'Download Home portal for your PC'),
(12, 'gr', 'Ï€ÏÎ¿Ï„Î¹Î¼Î·ÏƒÎµÎ¹Ï‚'),
(13, 'gr', 'Embed code is not active'),
(14, 'gr', 'Î‘Ï€Î¿ÏƒÏ„Î¿Î»Î·'),
(15, 'gr', 'Î”Î·Î¼Î¿ÏƒÎ¹Î± Ï€ÏÎ¿Î²Î¿Î»Î·'),
(16, 'gr', 'Videos'),
(17, 'gr', 'ÎœÎ¿Ï…ÏƒÎ¹ÎºÎ·'),
(18, 'gr', 'Î‘Ï€Î¿Î¸Î®ÎºÎµÏ…ÏƒÎ·'),
(19, 'gr', 'Î‘ÏÏ‡ÎµÎ¹Î± Î³Î¹Î± Î±Î½ÎµÎ²Î±ÏƒÎ¼Î±'),
(20, 'gr', 'Î‘ÏÏ‡ÎµÎ¹Î± Î³Î¹Î± ÎºÎ±Ï„Î­Î²Î±ÏƒÎ¼Î±'),
(21, 'gr', 'private uploads'),
(22, 'gr', 'Î‘ÏÏ‡ÎµÎ¹Î± Ï€Î¿Ï… Î±Î½ÎµÎ²Î·ÎºÎ±Î½ Î±Ï€Î¿ Ï‡ÏÎ·ÏƒÏ„ÎµÏ‚'),
(4, 'gr', 'Î Î¹Î½Î±ÎºÎ±Ï‚ Î‘Î½Î±ÎºÎ¿Î¹Î½Ï‰ÏƒÎµÏ‰Î½'),
(23, 'gr', 'Î‘Î½ÎµÎ²Î±ÏƒÎ¼Î± Î±ÏÏ‡ÎµÎ¹Î¿Ï…'),
(24, 'gr', 'Î‘Î½Î±Î¶Î·Ï„Î·ÏƒÎ· Ï†Î¹Î»Î¿Ï…'),
(25, 'gr', 'Î’Î±Î»Ï„Îµ Ï„Î¿ Î¿Î½Î¿Î¼Î± Ï„Î¿Ï… Î±Ï„Î¿Î¼Î¿Ï… Ï€Î¿Ï… ÏˆÎ±Ï‡Î½ÎµÏ„Îµ ÎµÎ´Ï‰ ÎºÎ±Î¹ Ï€Î±Ï„Î·ÏƒÏ„Îµ Î±Î½Î±Î¶Î·Ï„Î·ÏƒÎ·'),
(26, 'gr', 'Î‘Î½Î±Î¶Î·Ï„Î·ÏƒÎ·'),
(27, 'gr', 'ÎŸÎ¼Î¹Î»Î¹Î±'),
(28, 'gr', 'Embed code is active'),
(29, 'gr', 'Î†ÎºÏ…ÏÎ¿'),
(30, 'gr', 'ÎŸÎ¼Î¹Î»Î¹Î±'),
(48, 'gr', 'Î‘Î½Î±Î¶Î®Ï„Î·ÏƒÎ·'),
(32, 'gr', 'WAN:'),
(33, 'gr', 'LAN:'),
(34, 'gr', 'hostname:'),
(35, 'gr', 'Î£ÎµÎ»Î¯Î´ÎµÏ‚ Ï†Î¯Î»Ï‰Î½'),
(45, 'gr', 'Î“ÎµÎ½Î¹ÎºÎ­Ï‚ ÏÏ…Î¸Î¼Î¯ÏƒÎµÎ¹Ï‚ '),
(36, 'gr', 'url&nbsp;&nbsp;&nbsp;'),
(37, 'gr', 'ÎŒÎ½Î¿Î¼Î±'),
(38, 'gr', 'Î¤Î¯Ï„Î»Î¿Ï‚'),
(41, 'gr', 'Web'),
(42, 'gr', 'Videos'),
(43, 'gr', 'Anime'),
(44, 'gr', 'Torrents'),
(39, 'gr', 'Files'),
(40, 'gr', 'Games'),
(31, 'gr', 'Î ÏÎ¿Ï„Î¹Î¼Î®ÏƒÎµÎ¹Ï‚'),
(47, 'gr', 'Î£ÏÎ½Î´ÎµÏƒÎ·'),
(49, 'gr', 'Î•Î¼Ï†Î¬Î½Î¹ÏƒÎ·'),
(50, 'gr', 'Î‘ÏÏ‡ÎµÎ¯Î±'),
(51, 'gr', 'ÏŒÎ½Î¿Î¼Î± Ï‡ÏÎ®ÏƒÏ„Î·'),
(52, 'gr', 'personal message'),
(53, 'gr', 'Î“Î»ÏŽÏƒÏƒÎ±'),
(54, 'gr', 'Î¸Î± ÎµÎ¼Ï†Î±Î½Î¯Î¶Î¿Î½Ï„Î±Î¹ Î¼Î¿Î½Î¿ Î¿Î¹'),
(55, 'gr', 'Ï„ÎµÎ»ÎµÏ…Ï„Î±Î¯ÎµÏ‚ ÎµÎ¹Î´Î¿Ï€Î¿Î¹Î®ÏƒÎµÎ¹Ï‚ '),
(56, 'gr', 'ÎµÎ½Î·Î¼ÎµÏÏ‰ÏƒÎ· Ï„Î¿Ï… Tracker Î³Î¹Î± Î½Î± Î²ÏÎ¹ÏƒÎºÎµÏ„Î±Î¹ Î· ÏƒÎµÎ»Î¹Î´Î± Î±Ï€Î¿ Î±Î»Î»Î± Î±Ï„Î¿Î¼Î±'),
(57, 'gr', 'tracker username'),
(58, 'gr', 'tracker password'),
(59, 'gr', 'Î“Î¹Î± Î»Î¿Î³Î¿Ï…Ï‚ Î±ÏƒÏ†Î±Î»ÎµÎ¹Î±Ï‚ Ï„Î¿ username ÎºÎ±Î¹ Ï„Î¿ password Î³Î¹Î± Ï„Î¿Î½ tracker Î´ÎµÎ½ ÎµÎ¼Ï†Î±Î½Î¹Î¶Î¿Î½Ï„Î¹Î±Î¹ Ï€Î±Î½Ï‰ ÏƒÏ„Î· ÏƒÎµÎ»Î¹Î´Î±'),
(60, 'gr', 'Î‘Ï€Î¿Î¸Î®ÎºÎµÏ…ÏƒÎ·'),
(61, 'gr', 'Î£Ï…Î½Î´ÎµÏƒÎ¹Î¼Î¿Ï„Î·Ï„Î±'),
(62, 'gr', 'Î”Î¹Î±Î´Î¯ÎºÏ„Ï…Î¿ '),
(63, 'gr', 'Î¤Î¿Ï€Î¹ÎºÏŒ Î´Î¯ÎºÏ„Ï…Î¿'),
(64, 'gr', 'Î’Î±Î»Ï„Îµ ÎµÎ½Î± Ï†Î¹Î»Î¿ ÏƒÏ„Î¿ Î´Î¹Î±Î´Î¯ÎºÏ„Ï…Î¿ Î½Î± Î´Î¿ÎºÎ¹Î¼Î±ÏƒÎµÎ¹ Î±Î½ Î´Î¿Ï…Î»ÎµÏ…ÎµÎ¹ Î· ÏƒÎµÎ»Î¯Î´Î± ÏƒÎ±Ï‚'),
(65, 'gr', 'Î’Î±Î»Ï„Îµ ÎµÎ½Î± Ï†Î¹Î»Î¿ ÏƒÏ„Î¿ Ï„Î¿Ï€Î¹ÎºÏŒ Î´Î¯ÎºÏ„Ï…Î¿ Î½Î± Î´Î¿ÎºÎ¹Î¼Î±ÏƒÎµÎ¹ Î±Î½ Î´Î¿Ï…Î»ÎµÏ…ÎµÎ¹ Î· ÏƒÎµÎ»Î¹Î´Î± ÏƒÎ±Ï‚'),
(66, 'gr', 'wan port'),
(67, 'gr', 'Î•Î½Î·Î¼Î­ÏÏ‰ÏƒÎ·'),
(68, 'gr', 'Î‘Î½ÎµÎ²Î±ÏƒÎ¼Î± Î±ÏÏ‡ÎµÎ¹Ï‰Î½'),
(69, 'gr', 'Î‘Ï€Î¿Î´Î¿Ï‡Î· Î±ÏÏ‡ÎµÎ¹Ï‰Î½'),
(70, 'gr', 'Ï…Ï€Î¿ÏƒÏ„Î·ÏÎ¹Î¶Î¿Î¼ÎµÎ½Î¿Î¹ Ï„Ï…Ï€Î¿Î¹ Î±ÏÏ‡ÎµÎ¹Ï‰Î½'),
(71, 'gr', 'Ï€ÏÎ¿ÏƒÏ„Î±ÏƒÎ¹Î± Î¼Îµ ÎºÏ‰Î´Î¹ÎºÎ¿'),
(72, 'gr', 'ÎºÏ‰Î´Î¹ÎºÎ¿Ï‚ upload'),
(73, 'gr', 'ÎœÎµÎ³Î¹ÏƒÏ„Î¿ Î¼ÎµÎ³ÎµÎ¸Î¿Ï‚ Î±ÏÏ‡ÎµÎ¹Î¿Ï…'),
(74, 'gr', 'Î•Î¼Ï†Î¬Î½Î·ÏƒÎ·'),
(75, 'gr', 'Ï‡ÏÏŽÎ¼Î± Ï€Î±ÏÎ±ÏƒÎºÎ·Î½Î¯Î¿Ï…'),
(76, 'gr', 'ÎµÎ¹ÎºÏŒÎ½Î± Ï€Î±ÏÎ±ÏƒÎºÎ·Î½Î¯Î¿Ï…'),
(77, 'gr', 'Ï‡ÏÏŽÎ¼Î± ÎºÎµÎ½Ï„ÏÎ¹ÎºÎ¿Ï Ï€Î±ÏÎ±Î¸ÏÏÎ¿Ï… ÎºÎ±Î¹ Î¼ÎµÎ½Î¿Ï'),
(78, 'gr', 'Ï‡ÏÏ‰Î¼Î± Î³ÏÎ±Î¼Î¼Î±Ï„Ï‰Î½'),
(79, 'gr', 'Î¸Î­Î¼Î± Ï„Î¿Ï… Ï€Î±ÏÎ¬Î¸Ï…ÏÎ¿Ï… Î¿Î¼Î¹Î»Î¯Î±Ï‚/chat'),
(80, 'gr', 'Î´Î¹Î±Ï†Î¬Î½ÎµÎ¹Î± Ï€Î±ÏÎ±Î¸ÏÏÏ‰Î½'),
(81, 'gr', 'Î³ÏÎ±Î¼Î¼Î±Ï„Î± Î¿Î½Î¿Î¼Î±Ï„Î¿Ï‚:'),
(82, 'gr', 'Î³ÏÎ±Î¼Î¼Î±Ï„Î¿ÏƒÎµÎ¹ÏÎ¬'),
(83, 'gr', 'Ï‡ÏÏŽÎ¼Î±'),
(84, 'gr', 'Î¼ÎµÎ³ÎµÎ¸Î¿Ï‚'),
(85, 'gr', 'Î³ÏÎ±Î¼Î¼Î±Ï„Î± pm:'),
(86, 'gr', 'Î‘Î½Î±Î¶Î·Ï„Î·ÏƒÎ·'),
(87, 'gr', 'Ï‡ÏÎ·ÏƒÎ· Ï„Î¿Ï… Î¿Î½Î¿Î¼Î±Ï„Î¿Ï‚-Ï‡ÏÎ·ÏƒÏ„Î· Î³Î¹Î± Î¿Î¼Î¹Î»Î¯Î±/chat'),
(1, 'en', 'a name must be given'),
(2, 'en', 'Reply to notice'),
(3, 'en', 'Insert new notice'),
(4, 'en', 'Notice Board'),
(5, 'en', 'Search'),
(6, 'en', 'Internet friend'),
(7, 'en', 'local network friend'),
(8, 'en', 'About'),
(9, 'en', 'Reply'),
(10, 'en', 'Insert new notice'),
(11, 'en', 'Download Home portal for your PC'),
(12, 'en', 'preferences'),
(13, 'en', 'Embed code is not active'),
(14, 'en', 'Send'),
(15, 'en', 'Public preview'),
(16, 'en', 'Videos'),
(17, 'en', 'Music'),
(18, 'en', 'Save'),
(19, 'en', 'File for upload'),
(20, 'en', 'Files for download'),
(21, 'en', 'private uploads'),
(22, 'en', 'Files uploaded by users'),
(23, 'en', 'Upload a File'),
(24, 'en', 'Friend search'),
(25, 'en', 'Insert the name of the person you are looking and press search'),
(26, 'en', 'Search'),
(27, 'en', 'Chat'),
(28, 'en', 'Embed code is active'),
(29, 'en', 'Cancel'),
(30, 'en', 'Chat'),
(31, 'en', 'Preferences'),
(32, 'en', 'WAN:'),
(33, 'en', 'LAN:'),
(34, 'en', 'hostname:'),
(35, 'en', 'Friends pages'),
(36, 'en', 'url&nbsp;&nbsp;'),
(37, 'en', 'Name'),
(38, 'en', 'Title'),
(45, 'en', 'Favourite Pages'),
(46, 'en', 'General settings'),
(47, 'en', 'Connection'),
(39, 'en', 'Files'),
(40, 'en', 'Games'),
(41, 'en', 'Web'),
(42, 'en', 'Videos'),
(43, 'en', 'Anime'),
(44, 'en', 'Torrents'),
(48, 'en', 'Search'),
(50, 'en', 'Files'),
(49, 'en', 'Appearance'),
(51, 'en', 'username'),
(52, 'en', 'personal message'),
(53, 'en', 'Language'),
(54, 'en', 'only the last '),
(55, 'en', 'notices will appear'),
(56, 'en', 'update Tracker so others can find your webpage'),
(57, 'en', 'tracker username'),
(58, 'en', 'tracker password'),
(59, 'en', 'For safety reasons username and password will not appear on page'),
(60, 'en', 'Save'),
(61, 'en', 'Connection'),
(62, 'en', 'Internet'),
(63, 'en', 'Local Area Network'),
(66, 'en', 'wan port'),
(68, 'en', 'Upload files'),
(72, 'en', 'upload password'),
(73, 'en', 'maximum file size'),
(74, 'en', 'Appearance'),
(75, 'en', 'background color'),
(76, 'en', 'background image'),
(69, 'en', 'Accept files'),
(64, 'en', 'Test  your page via an Internet friend'),
(65, 'en', 'Test  your page via a local network friend'),
(67, 'en', 'Update'),
(70, 'en', 'supported files'),
(71, 'en', 'password protection'),
(77, 'en', 'main panel and menu color'),
(78, 'en', 'font color'),
(79, 'en', 'chat theme'),
(86, 'en', 'Search'),
(87, 'en', 'use your username for chat'),
(85, 'en', 'pm font:'),
(83, 'en', 'color'),
(84, 'en', 'size'),
(80, 'en', 'panel opacity'),
(81, 'en', 'name font:'),
(82, 'en', 'font type'),
(88, 'gr', '	  Î•Î»ÎµÎ³Ï‡Î¿Ï‚ Î»ÎµÎ¹Ï„Î¿Ï…ÏÎ³Î¹Î±Ï‚ Ï„Î·Ï‚ ÏƒÎµÎ»Î¹Î´Î±Ï‚ Î¼ÎµÏƒÏ‰ Ï†Î¹Î»Î¿Ï…'),
(89, 'gr', 'ÏƒÎµÎ»Î¹Î´Î± Ï†Î¹Î»Î¿Ï…'),
(90, 'gr', 'test'),
(91, 'gr', 'Î”Ï‰ÏƒÏ„Îµ Ï„Î· ÏƒÎµÎ»Î¹Î´Î± Ï„Î¿Ï… Ï†Î¹Î»Î¿Ï… ÎºÎ±Î¹ Ï€Î±Ï„Î·ÏƒÏ„Îµ test.'),
(92, 'gr', 'Î— Î±Î½Î±Î½ÎµÏ‰ÏƒÎ· Ï„Î¿Ï… tracker ÎµÎ¹Î½Î±Î¹ Î±Ï€ÎµÎ½ÎµÏÎ³Î¿Ï€Î¿Î¹Î·Î¼ÎµÎ½Î·'),
(92, 'en', 'Tracker update is disabled'),
(88, 'en', 'Test your page with a friend'),
(89, 'en', 'friend page'),
(90, 'en', 'test'),
(91, 'en', 'Insert friends page and press test');

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

CREATE TABLE IF NOT EXISTS `music` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

CREATE TABLE IF NOT EXISTS `noticeboard` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notice` text,
  `private` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
