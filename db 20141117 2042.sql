-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2014 a las 00:41:31
-- Versión del servidor: 5.6.11
-- Versión de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `aerolineas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aeropuerto`
--

CREATE TABLE IF NOT EXISTS `aeropuerto` (
  `cod` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `cod_pcia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aeropuerto`
--

INSERT INTO `aeropuerto` (`cod`, `nombre`, `direccion`, `ciudad`, `cod_pcia`) VALUES
(1, 'Aeropuerto Gobernador Francisco Gabrielli', 'Costa rica 56', 'Guaymayen', 1),
(2, 'Aeropuerto Ingeniero Ambrosio Taravella', 'Jujuy 789', 'Cordoba', 2),
(3, 'Aeropuerto Ministro Pistarini', 'Callao 567', 'Ezeiza', 3),
(4, 'Aeropuerto Martín Miguel de Güemes', 'San Martin 900', 'Salta', 4),
(5, 'Aeropuerto Porto Alegre', 'Figueiras 788', 'Porto Alegre', 5),
(6, 'Aeropuerto Rio de Janeiro', 'Kilo 2132', 'Rio de Janeiro', 6),
(7, 'Aeropuerto Puerto Arenas', 'Shilenos 78', 'Puerto Arenas', 7),
(8, 'Aeropuerto Internacional de Lima', 'Ajo 900', 'Lima', 8),
(9, 'Aeropuerto Kennedy', 'Yankees 678', 'New York', 9),
(10, 'Aeropuerto Internacional de Roma', 'Fetuccini 555', 'Roma', 10),
(11, 'Aeropuerto de Madrid', 'Gilipoias 698', 'Madrid', 11),
(12, 'Aeropuerto Internacional de Berlin', 'Strujen 9874', 'Berlin', 12),
(13, 'Aeropuerto Internacional de Shangai', 'Notene Pila 666', 'Shangai', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asiento`
--

CREATE TABLE IF NOT EXISTS `asiento` (
`cod` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `fila` int(11) NOT NULL,
  `columna` varchar(1) NOT NULL,
  `pasillo` tinyint(1) DEFAULT NULL,
  `ventanilla` tinyint(1) DEFAULT NULL,
  `cod_clase` int(11) NOT NULL,
  `cod_tiene` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=517 ;

--
-- Volcado de datos para la tabla `asiento`
--

INSERT INTO `asiento` (`cod`, `numero`, `fila`, `columna`, `pasillo`, `ventanilla`, `cod_clase`, `cod_tiene`) VALUES
(1, 1, 2, '2', 0, 1, 1, 1),
(2, 2, 2, '3', 0, 0, 1, 1),
(3, 3, 2, '4', 1, 0, 1, 1),
(4, 4, 2, '7', 1, 0, 1, 1),
(5, 5, 2, '8', 0, 0, 1, 1),
(6, 6, 2, '9', 0, 1, 1, 1),
(7, 7, 4, '2', 0, 1, 1, 1),
(8, 8, 4, '3', 0, 0, 1, 1),
(9, 9, 4, '4', 1, 0, 1, 1),
(10, 10, 4, '7', 1, 0, 1, 1),
(11, 11, 4, '8', 0, 0, 1, 1),
(12, 12, 4, '9', 0, 1, 1, 1),
(13, 13, 7, '2', 0, 1, 2, 1),
(14, 14, 7, '3', 0, 0, 2, 1),
(15, 15, 7, '4', 1, 0, 2, 1),
(16, 16, 7, '7', 1, 0, 2, 1),
(17, 17, 7, '8', 0, 0, 2, 1),
(18, 18, 7, '9', 0, 1, 2, 1),
(19, 19, 8, '2', 0, 1, 2, 1),
(20, 20, 8, '3', 0, 0, 2, 1),
(21, 21, 8, '4', 1, 0, 2, 1),
(22, 22, 8, '7', 1, 0, 2, 1),
(23, 23, 8, '8', 0, 0, 2, 1),
(24, 24, 8, '9', 0, 1, 2, 1),
(25, 25, 9, '2', 0, 1, 2, 1),
(26, 26, 9, '3', 0, 0, 2, 1),
(27, 27, 9, '4', 1, 0, 2, 1),
(28, 28, 9, '7', 1, 0, 2, 1),
(29, 29, 9, '8', 0, 0, 2, 1),
(30, 30, 9, '9', 0, 1, 2, 1),
(31, 31, 10, '2', 0, 1, 2, 1),
(32, 32, 10, '3', 0, 0, 2, 1),
(33, 33, 10, '4', 1, 0, 2, 1),
(34, 34, 10, '7', 1, 0, 2, 1),
(35, 35, 10, '8', 0, 0, 2, 1),
(36, 36, 10, '9', 0, 1, 2, 1),
(37, 37, 11, '2', 0, 1, 2, 1),
(38, 38, 11, '3', 0, 0, 2, 1),
(39, 39, 11, '4', 1, 0, 2, 1),
(40, 40, 11, '7', 1, 0, 2, 1),
(41, 41, 11, '8', 0, 0, 2, 1),
(42, 42, 11, '9', 0, 1, 2, 1),
(43, 43, 12, '2', 0, 1, 2, 1),
(44, 44, 12, '3', 0, 0, 2, 1),
(45, 45, 12, '4', 1, 0, 2, 1),
(46, 46, 12, '7', 1, 0, 2, 1),
(47, 47, 12, '8', 0, 0, 2, 1),
(48, 48, 12, '9', 0, 1, 2, 1),
(49, 49, 13, '2', 0, 1, 2, 1),
(50, 50, 13, '3', 0, 0, 2, 1),
(51, 51, 13, '4', 1, 0, 2, 1),
(52, 52, 13, '7', 1, 0, 2, 1),
(53, 53, 13, '8', 0, 0, 2, 1),
(54, 54, 13, '9', 0, 1, 2, 1),
(55, 55, 14, '2', 0, 1, 2, 1),
(56, 56, 14, '3', 0, 0, 2, 1),
(57, 57, 14, '4', 1, 0, 2, 1),
(58, 58, 14, '7', 1, 0, 2, 1),
(59, 59, 14, '8', 0, 0, 2, 1),
(60, 60, 14, '9', 0, 1, 2, 1),
(61, 1, 2, '2', 0, 1, 1, 2),
(62, 2, 2, '3', 0, 0, 1, 2),
(63, 3, 2, '4', 1, 0, 1, 2),
(64, 4, 2, '7', 1, 0, 1, 2),
(65, 5, 2, '8', 0, 0, 1, 2),
(66, 6, 2, '9', 0, 1, 1, 2),
(67, 7, 4, '2', 0, 1, 1, 2),
(68, 8, 4, '3', 0, 0, 1, 2),
(69, 9, 4, '4', 1, 0, 1, 2),
(70, 10, 4, '7', 1, 0, 1, 2),
(71, 11, 4, '8', 0, 0, 1, 2),
(72, 12, 4, '9', 0, 1, 1, 2),
(73, 13, 7, '2', 0, 1, 1, 2),
(74, 14, 7, '3', 0, 0, 1, 2),
(75, 15, 7, '4', 1, 0, 1, 2),
(76, 16, 7, '7', 1, 0, 1, 2),
(77, 17, 7, '8', 0, 0, 1, 2),
(78, 18, 7, '9', 0, 1, 1, 2),
(79, 19, 8, '2', 0, 1, 2, 2),
(80, 20, 8, '3', 0, 0, 2, 2),
(81, 21, 8, '4', 1, 0, 2, 2),
(82, 22, 8, '7', 1, 0, 2, 2),
(83, 23, 8, '8', 0, 0, 2, 2),
(84, 24, 8, '9', 0, 1, 2, 2),
(85, 25, 9, '2', 0, 1, 2, 2),
(86, 26, 9, '3', 0, 0, 2, 2),
(87, 27, 9, '4', 1, 0, 2, 2),
(88, 28, 9, '7', 1, 0, 2, 2),
(89, 29, 9, '8', 0, 0, 2, 2),
(90, 30, 9, '9', 0, 1, 2, 2),
(91, 31, 10, '2', 0, 1, 2, 2),
(92, 32, 10, '3', 0, 0, 2, 2),
(93, 33, 10, '4', 1, 0, 2, 2),
(94, 34, 10, '7', 1, 0, 2, 2),
(95, 35, 10, '8', 0, 0, 2, 2),
(96, 36, 10, '9', 0, 1, 2, 2),
(97, 37, 11, '2', 0, 1, 2, 2),
(98, 38, 11, '3', 0, 0, 2, 2),
(99, 39, 11, '4', 1, 0, 2, 2),
(100, 40, 11, '7', 1, 0, 2, 2),
(101, 41, 11, '8', 0, 0, 2, 2),
(102, 42, 11, '9', 0, 1, 2, 2),
(103, 43, 12, '2', 0, 1, 2, 2),
(104, 44, 12, '3', 0, 0, 2, 2),
(105, 45, 12, '4', 1, 0, 2, 2),
(106, 46, 12, '7', 1, 0, 2, 2),
(107, 47, 12, '8', 0, 0, 2, 2),
(108, 48, 12, '9', 0, 1, 2, 2),
(109, 49, 13, '2', 0, 1, 2, 2),
(110, 50, 13, '3', 0, 0, 2, 2),
(111, 51, 13, '4', 1, 0, 2, 2),
(112, 52, 13, '7', 1, 0, 2, 2),
(113, 53, 13, '8', 0, 0, 2, 2),
(114, 54, 13, '9', 0, 1, 2, 2),
(115, 55, 14, '2', 0, 1, 2, 2),
(116, 56, 14, '3', 0, 0, 2, 2),
(117, 57, 14, '4', 1, 0, 2, 2),
(118, 58, 14, '7', 1, 0, 2, 2),
(119, 59, 14, '8', 0, 0, 2, 2),
(120, 60, 14, '9', 0, 1, 2, 2),
(121, 61, 15, '2', 0, 1, 2, 2),
(122, 62, 15, '3', 0, 0, 2, 2),
(123, 63, 15, '4', 1, 0, 2, 2),
(124, 64, 15, '7', 1, 0, 2, 2),
(125, 65, 15, '8', 0, 0, 2, 2),
(126, 66, 15, '9', 0, 1, 2, 2),
(127, 67, 16, '2', 0, 1, 2, 2),
(128, 68, 16, '3', 0, 0, 2, 2),
(129, 69, 16, '4', 1, 0, 2, 2),
(130, 70, 16, '7', 1, 0, 2, 2),
(131, 71, 16, '8', 0, 0, 2, 2),
(132, 72, 16, '9', 0, 1, 2, 2),
(133, 73, 17, '2', 0, 1, 2, 2),
(134, 74, 17, '3', 0, 0, 2, 2),
(135, 75, 17, '4', 1, 0, 2, 2),
(136, 76, 17, '7', 1, 0, 2, 2),
(137, 77, 17, '8', 0, 0, 2, 2),
(138, 78, 17, '9', 0, 1, 2, 2),
(139, 79, 18, '2', 0, 1, 2, 2),
(140, 80, 18, '3', 0, 0, 2, 2),
(141, 81, 18, '4', 1, 0, 2, 2),
(142, 82, 18, '7', 1, 0, 2, 2),
(143, 83, 18, '8', 0, 0, 2, 2),
(144, 84, 18, '9', 0, 1, 2, 2),
(145, 85, 19, '2', 0, 1, 2, 2),
(146, 86, 19, '3', 0, 0, 2, 2),
(147, 87, 19, '4', 1, 0, 2, 2),
(148, 88, 19, '7', 1, 0, 2, 2),
(149, 89, 19, '8', 0, 0, 2, 2),
(150, 90, 19, '9', 0, 1, 2, 2),
(151, 1, 2, '2', 0, 1, 1, 3),
(152, 2, 2, '3', 0, 0, 1, 3),
(153, 3, 2, '4', 1, 0, 1, 3),
(154, 4, 2, '7', 1, 0, 1, 3),
(155, 5, 2, '8', 0, 0, 1, 3),
(156, 6, 2, '9', 0, 1, 1, 3),
(157, 7, 4, '2', 0, 1, 1, 3),
(158, 8, 4, '3', 0, 0, 1, 3),
(159, 9, 4, '4', 1, 0, 1, 3),
(160, 10, 4, '7', 1, 0, 1, 3),
(161, 11, 4, '8', 0, 0, 1, 3),
(162, 12, 4, '9', 0, 1, 1, 3),
(163, 13, 6, '2', 0, 1, 1, 3),
(164, 14, 6, '2', 1, 0, 1, 3),
(165, 15, 6, '8', 1, 0, 1, 3),
(166, 16, 6, '9', 0, 1, 1, 3),
(167, 17, 8, '2', 0, 1, 2, 3),
(168, 18, 8, '3', 1, 0, 2, 3),
(169, 19, 8, '5', 1, 0, 2, 3),
(170, 20, 8, '6', 1, 0, 2, 3),
(171, 21, 8, '8', 1, 0, 2, 3),
(172, 22, 8, '9', 0, 1, 2, 3),
(173, 23, 9, '2', 0, 1, 2, 3),
(174, 24, 9, '3', 1, 0, 2, 3),
(175, 25, 9, '5', 1, 0, 2, 3),
(176, 26, 9, '6', 1, 0, 2, 3),
(177, 27, 9, '8', 1, 0, 2, 3),
(178, 28, 9, '9', 0, 1, 2, 3),
(179, 29, 10, '2', 0, 1, 2, 3),
(180, 30, 10, '3', 1, 0, 2, 3),
(181, 31, 10, '5', 1, 0, 2, 3),
(182, 32, 10, '6', 1, 0, 2, 3),
(183, 33, 10, '8', 1, 0, 2, 3),
(184, 34, 10, '9', 0, 1, 2, 3),
(185, 35, 11, '2', 0, 1, 2, 3),
(186, 36, 11, '3', 1, 0, 2, 3),
(187, 37, 11, '5', 1, 0, 2, 3),
(188, 38, 11, '6', 1, 0, 2, 3),
(189, 39, 11, '8', 1, 0, 2, 3),
(190, 40, 11, '9', 0, 1, 2, 3),
(191, 41, 12, '2', 0, 1, 2, 3),
(192, 42, 12, '3', 1, 0, 2, 3),
(193, 43, 12, '5', 1, 0, 2, 3),
(194, 44, 12, '6', 1, 0, 2, 3),
(195, 45, 12, '8', 1, 0, 2, 3),
(196, 46, 12, '9', 0, 1, 2, 3),
(197, 47, 13, '2', 0, 1, 2, 3),
(198, 48, 13, '3', 1, 0, 2, 3),
(199, 49, 13, '5', 1, 0, 2, 3),
(200, 50, 13, '6', 1, 0, 2, 3),
(201, 51, 13, '8', 1, 0, 2, 3),
(202, 52, 13, '9', 0, 1, 2, 3),
(203, 53, 14, '2', 0, 1, 2, 3),
(204, 54, 14, '3', 1, 0, 2, 3),
(205, 55, 14, '5', 1, 0, 2, 3),
(206, 56, 14, '6', 1, 0, 2, 3),
(207, 57, 14, '8', 1, 0, 2, 3),
(208, 58, 14, '9', 0, 1, 2, 3),
(209, 59, 15, '2', 0, 1, 2, 3),
(210, 60, 15, '3', 1, 0, 2, 3),
(211, 61, 15, '5', 1, 0, 2, 3),
(212, 62, 15, '6', 1, 0, 2, 3),
(213, 63, 15, '8', 1, 0, 2, 3),
(214, 64, 15, '9', 0, 1, 2, 3),
(215, 65, 16, '2', 0, 1, 2, 3),
(216, 66, 16, '3', 1, 0, 2, 3),
(217, 67, 16, '5', 1, 0, 2, 3),
(218, 68, 16, '6', 1, 0, 2, 3),
(219, 69, 16, '8', 1, 0, 2, 3),
(220, 70, 16, '9', 0, 1, 2, 3),
(221, 71, 17, '2', 0, 1, 2, 3),
(222, 72, 17, '3', 1, 0, 2, 3),
(223, 73, 17, '5', 1, 0, 2, 3),
(224, 74, 17, '6', 1, 0, 2, 3),
(225, 75, 17, '8', 1, 0, 2, 3),
(226, 76, 17, '9', 0, 1, 2, 3),
(227, 77, 18, '2', 0, 1, 2, 3),
(228, 78, 18, '3', 1, 0, 2, 3),
(229, 79, 18, '5', 1, 0, 2, 3),
(230, 80, 18, '6', 1, 0, 2, 3),
(231, 81, 18, '8', 1, 0, 2, 3),
(232, 82, 18, '9', 0, 1, 2, 3),
(233, 83, 19, '2', 0, 1, 2, 3),
(234, 84, 19, '3', 1, 0, 2, 3),
(235, 85, 19, '5', 1, 0, 2, 3),
(236, 86, 19, '6', 1, 0, 2, 3),
(237, 87, 19, '8', 1, 0, 2, 3),
(238, 88, 19, '9', 0, 1, 2, 3),
(239, 89, 20, '2', 0, 1, 2, 3),
(240, 90, 20, '3', 1, 0, 2, 3),
(241, 91, 20, '5', 1, 0, 2, 3),
(242, 92, 20, '6', 1, 0, 2, 3),
(243, 93, 20, '8', 1, 0, 2, 3),
(244, 94, 20, '9', 0, 1, 2, 3),
(245, 95, 21, '2', 0, 1, 2, 3),
(246, 96, 21, '3', 1, 0, 2, 3),
(247, 97, 21, '5', 1, 0, 2, 3),
(248, 98, 21, '6', 1, 0, 2, 3),
(249, 99, 21, '8', 1, 0, 2, 3),
(250, 100, 21, '9', 0, 1, 2, 3),
(251, 101, 22, '2', 0, 1, 2, 3),
(252, 102, 22, '3', 1, 0, 2, 3),
(253, 103, 22, '5', 1, 0, 2, 3),
(254, 104, 22, '6', 1, 0, 2, 3),
(255, 105, 22, '8', 1, 0, 2, 3),
(256, 106, 22, '9', 0, 1, 2, 3),
(257, 107, 23, '2', 0, 1, 2, 3),
(258, 108, 23, '3', 1, 0, 2, 3),
(259, 109, 23, '5', 1, 0, 2, 3),
(260, 110, 23, '6', 1, 0, 2, 3),
(261, 111, 23, '8', 1, 0, 2, 3),
(262, 112, 23, '9', 0, 1, 2, 3),
(263, 1, 2, '2', 0, 1, 1, 4),
(264, 2, 2, '4', 1, 0, 1, 4),
(265, 3, 2, '7', 1, 0, 1, 4),
(266, 4, 2, '9', 0, 1, 1, 4),
(267, 5, 4, '2', 0, 1, 1, 4),
(268, 6, 4, '4', 1, 0, 1, 4),
(269, 7, 4, '7', 1, 0, 1, 4),
(270, 8, 4, '9', 0, 1, 1, 4),
(271, 9, 6, '2', 0, 1, 1, 4),
(272, 10, 6, '4', 1, 0, 1, 4),
(273, 11, 6, '7', 1, 0, 1, 4),
(274, 12, 6, '9', 0, 1, 1, 4),
(275, 13, 8, '2', 0, 1, 1, 4),
(276, 14, 8, '4', 1, 0, 1, 4),
(277, 15, 8, '7', 1, 0, 1, 4),
(278, 16, 8, '9', 0, 1, 1, 4),
(279, 17, 10, '2', 0, 1, 2, 4),
(280, 18, 10, '3', 0, 0, 2, 4),
(281, 19, 10, '4', 1, 0, 2, 4),
(282, 20, 10, '7', 1, 0, 2, 4),
(283, 21, 10, '8', 0, 0, 2, 4),
(284, 22, 10, '9', 0, 1, 2, 4),
(285, 23, 11, '2', 0, 1, 2, 4),
(286, 24, 11, '3', 0, 0, 2, 4),
(287, 25, 11, '4', 1, 0, 2, 4),
(288, 26, 11, '7', 1, 0, 2, 4),
(289, 27, 11, '8', 0, 0, 2, 4),
(290, 28, 11, '9', 0, 1, 2, 4),
(291, 29, 12, '2', 0, 1, 2, 4),
(292, 30, 12, '3', 0, 0, 2, 4),
(293, 31, 12, '4', 1, 0, 2, 4),
(294, 32, 12, '7', 1, 0, 2, 4),
(295, 33, 12, '8', 0, 0, 2, 4),
(296, 34, 12, '9', 0, 1, 2, 4),
(297, 35, 13, '2', 0, 1, 2, 4),
(298, 36, 13, '3', 0, 0, 2, 4),
(299, 37, 13, '4', 1, 0, 2, 4),
(300, 38, 13, '7', 1, 0, 2, 4),
(301, 39, 13, '8', 0, 0, 2, 4),
(302, 40, 13, '9', 0, 1, 2, 4),
(303, 41, 14, '2', 0, 1, 2, 4),
(304, 42, 14, '3', 0, 0, 2, 4),
(305, 43, 14, '4', 1, 0, 2, 4),
(306, 44, 14, '7', 1, 0, 2, 4),
(307, 45, 14, '8', 0, 0, 2, 4),
(308, 46, 14, '9', 0, 1, 2, 4),
(309, 47, 15, '2', 0, 1, 2, 4),
(310, 48, 15, '3', 0, 0, 2, 4),
(311, 49, 15, '4', 1, 0, 2, 4),
(312, 50, 15, '7', 1, 0, 2, 4),
(313, 51, 15, '8', 0, 0, 2, 4),
(314, 52, 15, '9', 0, 1, 2, 4),
(315, 53, 16, '2', 0, 1, 2, 4),
(316, 54, 16, '3', 0, 0, 2, 4),
(317, 55, 16, '4', 1, 0, 2, 4),
(318, 56, 16, '7', 1, 0, 2, 4),
(319, 57, 16, '8', 0, 0, 2, 4),
(320, 58, 16, '9', 0, 1, 2, 4),
(321, 59, 17, '2', 0, 1, 2, 4),
(322, 60, 17, '3', 0, 0, 2, 4),
(323, 61, 17, '4', 1, 0, 2, 4),
(324, 62, 17, '7', 1, 0, 2, 4),
(325, 63, 17, '8', 0, 0, 2, 4),
(326, 64, 17, '9', 0, 1, 2, 4),
(327, 65, 18, '2', 0, 1, 2, 4),
(328, 66, 18, '3', 0, 0, 2, 4),
(329, 67, 18, '4', 1, 0, 2, 4),
(330, 68, 18, '7', 1, 0, 2, 4),
(331, 69, 18, '8', 0, 0, 2, 4),
(332, 70, 18, '9', 0, 1, 2, 4),
(333, 71, 19, '2', 0, 1, 2, 4),
(334, 72, 19, '3', 0, 0, 2, 4),
(335, 73, 19, '4', 1, 0, 2, 4),
(336, 74, 19, '7', 1, 0, 2, 4),
(337, 75, 19, '8', 0, 0, 2, 4),
(338, 76, 19, '9', 0, 1, 2, 4),
(339, 77, 20, '2', 0, 1, 2, 4),
(340, 78, 20, '3', 0, 0, 2, 4),
(341, 79, 20, '4', 1, 0, 2, 4),
(342, 80, 20, '7', 1, 0, 2, 4),
(343, 81, 20, '8', 0, 0, 2, 4),
(344, 82, 20, '9', 0, 1, 2, 4),
(345, 83, 21, '2', 0, 1, 2, 4),
(346, 84, 21, '3', 0, 0, 2, 4),
(347, 85, 21, '4', 1, 0, 2, 4),
(348, 86, 21, '7', 1, 0, 2, 4),
(349, 87, 21, '8', 0, 0, 2, 4),
(350, 88, 21, '9', 0, 1, 2, 4),
(351, 89, 22, '2', 0, 1, 2, 4),
(352, 90, 22, '3', 0, 0, 2, 4),
(353, 91, 22, '4', 1, 0, 2, 4),
(354, 92, 22, '7', 1, 0, 2, 4),
(355, 93, 22, '8', 0, 0, 2, 4),
(356, 94, 22, '9', 0, 1, 2, 4),
(357, 95, 23, '2', 0, 1, 2, 4),
(358, 96, 23, '3', 0, 0, 2, 4),
(359, 97, 23, '4', 1, 0, 2, 4),
(360, 98, 23, '7', 1, 0, 2, 4),
(361, 99, 23, '8', 0, 0, 2, 4),
(362, 100, 23, '9', 0, 1, 2, 4),
(363, 101, 24, '2', 0, 1, 2, 4),
(364, 102, 24, '3', 0, 0, 2, 4),
(365, 103, 24, '4', 1, 0, 2, 4),
(366, 104, 24, '7', 1, 0, 2, 4),
(367, 105, 24, '8', 0, 0, 2, 4),
(368, 106, 24, '9', 0, 1, 2, 4),
(369, 107, 25, '2', 0, 1, 2, 4),
(370, 108, 25, '3', 0, 0, 2, 4),
(371, 109, 25, '4', 1, 0, 2, 4),
(372, 110, 25, '7', 1, 0, 2, 4),
(373, 111, 25, '8', 0, 0, 2, 4),
(374, 112, 25, '9', 0, 1, 2, 4),
(375, 113, 26, '2', 0, 1, 2, 4),
(376, 114, 26, '3', 0, 0, 2, 4),
(377, 115, 26, '4', 1, 0, 2, 4),
(378, 116, 26, '7', 1, 0, 2, 4),
(379, 117, 26, '8', 0, 0, 2, 4),
(380, 118, 26, '9', 0, 1, 2, 4),
(381, 1, 2, '2', 0, 1, 1, 5),
(382, 2, 2, '4', 1, 0, 1, 5),
(383, 3, 2, '7', 1, 0, 1, 5),
(384, 4, 2, '9', 0, 1, 1, 5),
(385, 5, 4, '2', 0, 1, 1, 5),
(386, 6, 4, '4', 1, 0, 1, 5),
(387, 7, 4, '7', 1, 0, 1, 5),
(388, 8, 4, '9', 0, 1, 1, 5),
(389, 9, 6, '2', 0, 1, 1, 5),
(390, 10, 6, '4', 1, 0, 1, 5),
(391, 11, 6, '7', 1, 0, 1, 5),
(392, 12, 6, '9', 0, 1, 1, 5),
(393, 13, 8, '2', 0, 1, 1, 5),
(394, 14, 8, '4', 1, 0, 1, 5),
(395, 15, 8, '7', 1, 0, 1, 5),
(396, 16, 8, '9', 0, 1, 1, 5),
(397, 17, 10, '2', 0, 1, 2, 5),
(398, 18, 10, '3', 0, 0, 2, 5),
(399, 19, 10, '4', 1, 0, 2, 5),
(400, 20, 10, '7', 1, 0, 2, 5),
(401, 21, 10, '8', 0, 0, 2, 5),
(402, 22, 10, '9', 0, 1, 2, 5),
(403, 23, 11, '2', 0, 1, 2, 5),
(404, 24, 11, '3', 0, 0, 2, 5),
(405, 25, 11, '4', 1, 0, 2, 5),
(406, 26, 11, '7', 1, 0, 2, 5),
(407, 27, 11, '8', 0, 0, 2, 5),
(408, 28, 11, '9', 0, 1, 2, 5),
(409, 29, 12, '2', 0, 1, 2, 5),
(410, 30, 12, '3', 0, 0, 2, 5),
(411, 31, 12, '4', 1, 0, 2, 5),
(412, 32, 12, '7', 1, 0, 2, 5),
(413, 33, 12, '8', 0, 0, 2, 5),
(414, 34, 12, '9', 0, 1, 2, 5),
(415, 35, 13, '2', 0, 1, 2, 5),
(416, 36, 13, '3', 0, 0, 2, 5),
(417, 37, 13, '4', 1, 0, 2, 5),
(418, 38, 13, '7', 1, 0, 2, 5),
(419, 39, 13, '8', 0, 0, 2, 5),
(420, 40, 13, '9', 0, 1, 2, 5),
(421, 41, 14, '2', 0, 1, 2, 5),
(422, 42, 14, '3', 0, 0, 2, 5),
(423, 43, 14, '4', 1, 0, 2, 5),
(424, 44, 14, '7', 1, 0, 2, 5),
(425, 45, 14, '8', 0, 0, 2, 5),
(426, 46, 14, '9', 0, 1, 2, 5),
(427, 47, 15, '2', 0, 1, 2, 5),
(428, 48, 15, '3', 0, 0, 2, 5),
(429, 49, 15, '4', 1, 0, 2, 5),
(430, 50, 15, '7', 1, 0, 2, 5),
(431, 51, 15, '8', 0, 0, 2, 5),
(432, 52, 15, '9', 0, 1, 2, 5),
(433, 53, 16, '2', 0, 1, 2, 5),
(434, 54, 16, '3', 0, 0, 2, 5),
(435, 55, 16, '4', 1, 0, 2, 5),
(436, 56, 16, '7', 1, 0, 2, 5),
(437, 57, 16, '8', 0, 0, 2, 5),
(438, 58, 16, '9', 0, 1, 2, 5),
(439, 59, 17, '2', 0, 1, 2, 5),
(440, 60, 17, '3', 0, 0, 2, 5),
(441, 61, 17, '4', 1, 0, 2, 5),
(442, 62, 17, '7', 1, 0, 2, 5),
(443, 63, 17, '8', 0, 0, 2, 5),
(444, 64, 17, '9', 0, 1, 2, 5),
(445, 65, 18, '2', 0, 1, 2, 5),
(446, 66, 18, '3', 0, 0, 2, 5),
(447, 67, 18, '4', 1, 0, 2, 5),
(448, 68, 18, '7', 1, 0, 2, 5),
(449, 69, 18, '8', 0, 0, 2, 5),
(450, 70, 18, '9', 0, 1, 2, 5),
(451, 71, 19, '2', 0, 1, 2, 5),
(452, 72, 19, '3', 0, 0, 2, 5),
(453, 73, 19, '4', 1, 0, 2, 5),
(454, 74, 19, '7', 1, 0, 2, 5),
(455, 75, 19, '8', 0, 0, 2, 5),
(456, 76, 19, '9', 0, 1, 2, 5),
(457, 77, 20, '2', 0, 1, 2, 5),
(458, 78, 20, '3', 0, 0, 2, 5),
(459, 79, 20, '4', 1, 0, 2, 5),
(460, 80, 20, '7', 1, 0, 2, 5),
(461, 81, 20, '8', 0, 0, 2, 5),
(462, 82, 20, '9', 0, 1, 2, 5),
(463, 83, 21, '2', 0, 1, 2, 5),
(464, 84, 21, '3', 0, 0, 2, 5),
(465, 85, 21, '4', 1, 0, 2, 5),
(466, 86, 21, '7', 1, 0, 2, 5),
(467, 87, 21, '8', 0, 0, 2, 5),
(468, 88, 21, '9', 0, 1, 2, 5),
(469, 89, 22, '2', 0, 1, 2, 5),
(470, 90, 22, '3', 0, 0, 2, 5),
(471, 91, 22, '4', 1, 0, 2, 5),
(472, 92, 22, '7', 1, 0, 2, 5),
(473, 93, 22, '8', 0, 0, 2, 5),
(474, 94, 22, '9', 0, 1, 2, 5),
(475, 95, 23, '2', 0, 1, 2, 5),
(476, 96, 23, '3', 0, 0, 2, 5),
(477, 97, 23, '4', 1, 0, 2, 5),
(478, 98, 23, '7', 1, 0, 2, 5),
(479, 99, 23, '8', 0, 0, 2, 5),
(480, 100, 23, '9', 0, 1, 2, 5),
(481, 101, 24, '2', 0, 1, 2, 5),
(482, 102, 24, '3', 0, 0, 2, 5),
(483, 103, 24, '4', 1, 0, 2, 5),
(484, 104, 24, '7', 1, 0, 2, 5),
(485, 105, 24, '8', 0, 0, 2, 5),
(486, 106, 24, '9', 0, 1, 2, 5),
(487, 107, 25, '2', 0, 1, 2, 5),
(488, 108, 25, '3', 0, 0, 2, 5),
(489, 109, 25, '4', 1, 0, 2, 5),
(490, 110, 25, '7', 1, 0, 2, 5),
(491, 111, 25, '8', 0, 0, 2, 5),
(492, 112, 25, '9', 0, 1, 2, 5),
(493, 113, 26, '2', 0, 1, 2, 5),
(494, 114, 26, '3', 0, 0, 2, 5),
(495, 115, 26, '4', 1, 0, 2, 5),
(496, 116, 26, '7', 1, 0, 2, 5),
(497, 117, 26, '8', 0, 0, 2, 5),
(498, 118, 26, '9', 0, 1, 2, 5),
(499, 119, 27, '2', 0, 1, 2, 5),
(500, 120, 27, '3', 0, 0, 2, 5),
(501, 121, 27, '4', 1, 0, 2, 5),
(502, 122, 27, '7', 1, 0, 2, 5),
(503, 123, 27, '8', 0, 0, 2, 5),
(504, 124, 27, '9', 0, 1, 2, 5),
(505, 125, 28, '2', 0, 1, 2, 5),
(506, 126, 28, '3', 0, 0, 2, 5),
(507, 127, 28, '4', 1, 0, 2, 5),
(508, 128, 28, '7', 1, 0, 2, 5),
(509, 129, 28, '8', 0, 0, 2, 5),
(510, 130, 28, '9', 0, 1, 2, 5),
(511, 131, 29, '2', 0, 1, 2, 5),
(512, 132, 29, '3', 0, 0, 2, 5),
(513, 133, 29, '4', 1, 0, 2, 5),
(514, 134, 29, '7', 1, 0, 2, 5),
(515, 135, 29, '8', 0, 0, 2, 5),
(516, 136, 29, '9', 0, 1, 2, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avion`
--

CREATE TABLE IF NOT EXISTS `avion` (
`cod` int(11) NOT NULL,
  `marca` varchar(30) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `cod_tipo` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `avion`
--

INSERT INTO `avion` (`cod`, `marca`, `modelo`, `cod_tipo`) VALUES
(1, 'boing', '747', 1),
(2, 'Boeing', '737', 2),
(3, 'Boeing', '689', 3),
(4, 'Embraer', 'ER145', 4),
(5, 'Embraer', 'ER560', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE IF NOT EXISTS `clase` (
`cod` int(11) NOT NULL,
  `tipo` varchar(25) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`cod`, `tipo`) VALUES
(1, 'primera'),
(2, 'Ejecutiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuesta`
--

CREATE TABLE IF NOT EXISTS `cuesta` (
  `cod` int(11) NOT NULL DEFAULT '0',
  `precio` float NOT NULL,
  `cod_vuelo` int(11) NOT NULL,
  `cod_clase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuesta`
--

INSERT INTO `cuesta` (`cod`, `precio`, `cod_vuelo`, `cod_clase`) VALUES
(1, 10, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE IF NOT EXISTS `pais` (
`cod` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`cod`, `nombre`) VALUES
(1, 'argentina'),
(2, 'Brasil'),
(3, 'Chile'),
(4, 'Peru'),
(5, 'EEUU'),
(6, 'Italia'),
(7, 'España'),
(8, 'Alemania'),
(9, 'China');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajero`
--

CREATE TABLE IF NOT EXISTS `pasajero` (
`dni` int(11) NOT NULL,
  `apellido` varchar(32) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `f_nac` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pcia`
--

CREATE TABLE IF NOT EXISTS `pcia` (
`cod` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cod_pais` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `pcia`
--

INSERT INTO `pcia` (`cod`, `nombre`, `cod_pais`) VALUES
(1, 'Mendoza', 1),
(2, 'Cordoba', 1),
(3, 'Buenos Aires', 1),
(4, 'Salta', 1),
(5, 'Porto Alegre', 2),
(6, 'Rio de Janeiro', 2),
(7, 'Punta Arenas', 3),
(8, 'Lima', 4),
(9, 'New York', 5),
(10, 'Roma', 6),
(11, 'Madrid', 7),
(12, 'Berlin', 8),
(13, 'Shangai', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE IF NOT EXISTS `reserva` (
`cod` int(11) NOT NULL,
  `num_reserva` varchar(20) NOT NULL,
  `factura` double DEFAULT NULL,
  `checkin` tinyint(1) NOT NULL,
  `cod_asiento` int(11) NOT NULL,
  `cod_vuelo` int(11) NOT NULL,
  `cod_pasajero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
`cod` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `total_plazas` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`cod`, `numero`, `total_plazas`) VALUES
(1, 1, 60),
(2, 2, 90),
(3, 3, 112),
(4, 4, 118),
(5, 5, 150);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vuelo`
--

CREATE TABLE IF NOT EXISTS `vuelo` (
  `cod` int(11) NOT NULL DEFAULT '0',
  `fecha_sal` datetime NOT NULL,
  `fecha_llegada` datetime NOT NULL,
  `cod_se_dirige_a` int(11) NOT NULL,
  `cod_parte_de` int(11) NOT NULL,
  `cod_asignado_a` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vuelo`
--

INSERT INTO `vuelo` (`cod`, `fecha_sal`, `fecha_llegada`, `cod_se_dirige_a`, `cod_parte_de`, `cod_asignado_a`) VALUES
(1, '2014-10-04 00:00:00', '2014-10-05 00:00:00', 2, 1, 1),
(2, '2014-11-10 00:00:00', '2014-11-10 22:00:00', 8, 3, 2),
(3, '2014-11-12 00:00:00', '2014-11-12 00:00:00', 3, 8, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aeropuerto`
--
ALTER TABLE `aeropuerto`
 ADD PRIMARY KEY (`cod`), ADD KEY `cod_pcia` (`cod_pcia`);

--
-- Indices de la tabla `asiento`
--
ALTER TABLE `asiento`
 ADD PRIMARY KEY (`cod`), ADD KEY `cod_clase` (`cod_clase`), ADD KEY `cod_tiene` (`cod_tiene`);

--
-- Indices de la tabla `avion`
--
ALTER TABLE `avion`
 ADD PRIMARY KEY (`cod`), ADD KEY `cod_tipo` (`cod_tipo`);

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
 ADD PRIMARY KEY (`cod`);

--
-- Indices de la tabla `cuesta`
--
ALTER TABLE `cuesta`
 ADD PRIMARY KEY (`cod`), ADD KEY `cod_vuelo` (`cod_vuelo`,`cod_clase`), ADD KEY `cod_clase` (`cod_clase`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
 ADD PRIMARY KEY (`cod`);

--
-- Indices de la tabla `pasajero`
--
ALTER TABLE `pasajero`
 ADD PRIMARY KEY (`dni`);

--
-- Indices de la tabla `pcia`
--
ALTER TABLE `pcia`
 ADD PRIMARY KEY (`cod`), ADD KEY `cod_pais` (`cod_pais`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
 ADD PRIMARY KEY (`cod`), ADD KEY `cod_asiento` (`cod_asiento`,`cod_vuelo`,`cod_pasajero`), ADD KEY `cod_pasajero` (`cod_pasajero`), ADD KEY `cod_vuelo` (`cod_vuelo`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
 ADD PRIMARY KEY (`cod`);

--
-- Indices de la tabla `vuelo`
--
ALTER TABLE `vuelo`
 ADD PRIMARY KEY (`cod`), ADD KEY `cod_se_dirige_a` (`cod_se_dirige_a`), ADD KEY `cod_parte_de` (`cod_parte_de`), ADD KEY `cod_asignado_a` (`cod_asignado_a`), ADD KEY `cod_cuesta` (`cod_se_dirige_a`,`cod_parte_de`,`cod_asignado_a`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asiento`
--
ALTER TABLE `asiento`
MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=517;
--
-- AUTO_INCREMENT de la tabla `avion`
--
ALTER TABLE `avion`
MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `pasajero`
--
ALTER TABLE `pasajero`
MODIFY `dni` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pcia`
--
ALTER TABLE `pcia`
MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aeropuerto`
--
ALTER TABLE `aeropuerto`
ADD CONSTRAINT `aeropuerto_ibfk_1` FOREIGN KEY (`cod_pcia`) REFERENCES `pcia` (`cod`);

--
-- Filtros para la tabla `asiento`
--
ALTER TABLE `asiento`
ADD CONSTRAINT `asiento_ibfk_1` FOREIGN KEY (`cod_clase`) REFERENCES `clase` (`cod`),
ADD CONSTRAINT `asiento_ibfk_2` FOREIGN KEY (`cod_tiene`) REFERENCES `avion` (`cod`);

--
-- Filtros para la tabla `avion`
--
ALTER TABLE `avion`
ADD CONSTRAINT `avion_ibfk_1` FOREIGN KEY (`cod_tipo`) REFERENCES `tipo` (`cod`);

--
-- Filtros para la tabla `cuesta`
--
ALTER TABLE `cuesta`
ADD CONSTRAINT `cuesta_ibfk_1` FOREIGN KEY (`cod_vuelo`) REFERENCES `vuelo` (`cod`),
ADD CONSTRAINT `cuesta_ibfk_2` FOREIGN KEY (`cod_clase`) REFERENCES `clase` (`cod`);

--
-- Filtros para la tabla `pcia`
--
ALTER TABLE `pcia`
ADD CONSTRAINT `pcia_ibfk_1` FOREIGN KEY (`cod_pais`) REFERENCES `pais` (`cod`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`cod_pasajero`) REFERENCES `pasajero` (`dni`),
ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`cod_vuelo`) REFERENCES `vuelo` (`cod`),
ADD CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`cod_asiento`) REFERENCES `asiento` (`cod`);

--
-- Filtros para la tabla `vuelo`
--
ALTER TABLE `vuelo`
ADD CONSTRAINT `vuelo_ibfk_1` FOREIGN KEY (`cod_se_dirige_a`) REFERENCES `aeropuerto` (`cod`),
ADD CONSTRAINT `vuelo_ibfk_2` FOREIGN KEY (`cod_parte_de`) REFERENCES `aeropuerto` (`cod`),
ADD CONSTRAINT `vuelo_ibfk_3` FOREIGN KEY (`cod_asignado_a`) REFERENCES `avion` (`cod`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
