-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 02-07-2009 a las 12:26:18
-- Versión del servidor: 5.0.67
-- Versión de PHP: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bwsp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE IF NOT EXISTS `cache` (
  `service` varchar(50) NOT NULL,
  `request` varchar(255) NOT NULL,
  `row` text NOT NULL,
  `json` text NOT NULL,
  `mode` tinyint(2) NOT NULL,
  `lastUpdate` int(20) unsigned NOT NULL,
  PRIMARY KEY  (`request`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
