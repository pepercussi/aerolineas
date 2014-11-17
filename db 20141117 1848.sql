-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2014 a las 22:47:47
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

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
  `cod_pcia` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_pcia` (`cod_pcia`)
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
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `fila` int(11) NOT NULL,
  `columna` varchar(1) NOT NULL,
  `pasillo` tinyint(1) DEFAULT NULL,
  `ventanilla` tinyint(1) DEFAULT NULL,
  `cod_clase` int(11) NOT NULL,
  `cod_tiene` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_clase` (`cod_clase`),
  KEY `cod_tiene` (`cod_tiene`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avion`
--

CREATE TABLE IF NOT EXISTS `avion` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(30) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `cod_tipo` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_tipo` (`cod_tipo`)
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
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(25) NOT NULL,
  PRIMARY KEY (`cod`)
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
  `cod_clase` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_vuelo` (`cod_vuelo`,`cod_clase`),
  KEY `cod_clase` (`cod_clase`)
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
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`cod`)
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
  `dni` int(11) NOT NULL AUTO_INCREMENT,
  `apellido` varchar(32) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `f_nac` date NOT NULL,
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pcia`
--

CREATE TABLE IF NOT EXISTS `pcia` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_pais` (`cod_pais`)
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
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `num_reserva` varchar(20) NOT NULL,
  `factura` double DEFAULT NULL,
  `checkin` tinyint(1) NOT NULL,
  `cod_asiento` int(11) NOT NULL,
  `cod_vuelo` int(11) NOT NULL,
  `cod_pasajero` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_asiento` (`cod_asiento`,`cod_vuelo`,`cod_pasajero`),
  KEY `cod_pasajero` (`cod_pasajero`),
  KEY `cod_vuelo` (`cod_vuelo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `total_plazas` int(11) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`cod`, `numero`, `total_plazas`) VALUES
(1, 1, 23),
(2, 2, 30),
(3, 3, 80),
(4, 4, 125),
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
  `cod_asignado_a` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_se_dirige_a` (`cod_se_dirige_a`),
  KEY `cod_parte_de` (`cod_parte_de`),
  KEY `cod_asignado_a` (`cod_asignado_a`),
  KEY `cod_cuesta` (`cod_se_dirige_a`,`cod_parte_de`,`cod_asignado_a`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `vuelo`
--

INSERT INTO `vuelo` (`cod`, `fecha_sal`, `fecha_llegada`, `cod_se_dirige_a`, `cod_parte_de`, `cod_asignado_a`) VALUES
(1, '2014-10-04 00:00:00', '2014-10-05 00:00:00', 2, 1, 1),
(2, '2014-11-10 00:00:00', '2014-11-10 22:00:00', 8, 3, 2),
(3, '2014-11-12 00:00:00', '2014-11-12 00:00:00', 3, 8, 3);

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
