-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.24-log


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema aerolineas
--

CREATE DATABASE IF NOT EXISTS aerolineas;
USE aerolineas;

--
-- Definition of table `aeropuerto`
--

DROP TABLE IF EXISTS `aeropuerto`;
CREATE TABLE `aeropuerto` (
  `cod` int(11) NOT NULL DEFAULT '0',
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `cod_pcia` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_pcia` (`cod_pcia`),
  CONSTRAINT `aeropuerto_ibfk_1` FOREIGN KEY (`cod_pcia`) REFERENCES `pcia` (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aeropuerto`
--

/*!40000 ALTER TABLE `aeropuerto` DISABLE KEYS */;
INSERT INTO `aeropuerto` (`cod`,`nombre`,`direccion`,`ciudad`,`cod_pcia`) VALUES 
 (1,'Ezeiza','av siempreviva 123','Ezeiza',1),
 (2,'Jorge Newbery','lalal 1234','CABA',1),
 (3,'Ingeniero Ambrosio Taravella','Av Monseñor PAblo Cabrera 333','CBA Capital',2),
 (4,'Congonhas','Av Washington Luis 444','Sao Paulo',3),
 (5,'Guarulhos','Rodovia Helio Smidth 555','Guarulhos',3),
 (6,'Santos Dumont','Av Infante Dom Henrique','Rio de Janeiro',4),
 (7,'Olaya Herrera','Carrera 66B','Medellin',5),
 (8,'Maiquetía Simón Bolívar','Maiquetía 1161','Maiquetía',6),
 (9,'Miami','2100 NW 42nd Ave','Miami',7),
 (10,'Leonardo Da Vinci','Via dell\' Aeroporto di Fiumicino 320','Roma',8);
/*!40000 ALTER TABLE `aeropuerto` ENABLE KEYS */;


--
-- Definition of table `asiento`
--

DROP TABLE IF EXISTS `asiento`;
CREATE TABLE `asiento` (
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
  KEY `cod_tiene` (`cod_tiene`),
  CONSTRAINT `asiento_ibfk_1` FOREIGN KEY (`cod_clase`) REFERENCES `clase` (`cod`),
  CONSTRAINT `asiento_ibfk_2` FOREIGN KEY (`cod_tiene`) REFERENCES `avion` (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asiento`
--

/*!40000 ALTER TABLE `asiento` DISABLE KEYS */;
/*!40000 ALTER TABLE `asiento` ENABLE KEYS */;


--
-- Definition of table `avion`
--

DROP TABLE IF EXISTS `avion`;
CREATE TABLE `avion` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(30) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `cod_tipo` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_tipo` (`cod_tipo`),
  CONSTRAINT `avion_ibfk_1` FOREIGN KEY (`cod_tipo`) REFERENCES `tipo` (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `avion`
--

/*!40000 ALTER TABLE `avion` DISABLE KEYS */;
INSERT INTO `avion` (`cod`,`marca`,`modelo`,`cod_tipo`) VALUES 
 (1,'boing','747',1);
/*!40000 ALTER TABLE `avion` ENABLE KEYS */;


--
-- Definition of table `clase`
--

DROP TABLE IF EXISTS `clase`;
CREATE TABLE `clase` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(25) NOT NULL,
  `cod_cuesta` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_cuesta` (`cod_cuesta`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clase`
--

/*!40000 ALTER TABLE `clase` DISABLE KEYS */;
INSERT INTO `clase` (`cod`,`tipo`,`cod_cuesta`) VALUES 
 (1,'primera',1);
/*!40000 ALTER TABLE `clase` ENABLE KEYS */;


--
-- Definition of table `cuesta`
--

DROP TABLE IF EXISTS `cuesta`;
CREATE TABLE `cuesta` (
  `cod` int(11) NOT NULL DEFAULT '0',
  `precio` float NOT NULL,
  `cod_vuelo` int(11) NOT NULL,
  `cod_clase` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_vuelo` (`cod_vuelo`,`cod_clase`),
  KEY `cod_clase` (`cod_clase`),
  CONSTRAINT `cuesta_ibfk_1` FOREIGN KEY (`cod_vuelo`) REFERENCES `vuelo` (`cod`),
  CONSTRAINT `cuesta_ibfk_2` FOREIGN KEY (`cod_clase`) REFERENCES `clase` (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cuesta`
--

/*!40000 ALTER TABLE `cuesta` DISABLE KEYS */;
INSERT INTO `cuesta` (`cod`,`precio`,`cod_vuelo`,`cod_clase`) VALUES 
 (1,10,1,1);
/*!40000 ALTER TABLE `cuesta` ENABLE KEYS */;


--
-- Definition of table `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE `pais` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pais`
--

/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` (`cod`,`nombre`) VALUES 
 (1,'Argentina'),
 (2,'Brasil'),
 (3,'Colombia'),
 (4,'Venezuela'),
 (5,'Estados Unidos'),
 (6,'Italia'),
 (7,'Francia');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;


--
-- Definition of table `pasajero`
--

DROP TABLE IF EXISTS `pasajero`;
CREATE TABLE `pasajero` (
  `dni` int(11) NOT NULL AUTO_INCREMENT,
  `apellido` varchar(32) NOT NULL,
  `nombre` varchar(32) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `f_nac` date NOT NULL,
  PRIMARY KEY (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasajero`
--

/*!40000 ALTER TABLE `pasajero` DISABLE KEYS */;
/*!40000 ALTER TABLE `pasajero` ENABLE KEYS */;


--
-- Definition of table `pcia`
--

DROP TABLE IF EXISTS `pcia`;
CREATE TABLE `pcia` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  PRIMARY KEY (`cod`),
  KEY `cod_pais` (`cod_pais`),
  CONSTRAINT `pcia_ibfk_1` FOREIGN KEY (`cod_pais`) REFERENCES `pais` (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pcia`
--

/*!40000 ALTER TABLE `pcia` DISABLE KEYS */;
INSERT INTO `pcia` (`cod`,`nombre`,`cod_pais`) VALUES 
 (1,'Buenos Aires',1),
 (2,'Cordoba',1),
 (3,'Sao Pablo',2),
 (4,'Rio de Janeiro',2),
 (5,'Medellin',3),
 (6,'Caracas',4),
 (7,'Florida',5),
 (8,'Nueva York',5),
 (9,'Cleveland',5),
 (10,'Roma',6),
 (11,'Milan',6),
 (12,'Paris',7);
/*!40000 ALTER TABLE `pcia` ENABLE KEYS */;


--
-- Definition of table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE `reserva` (
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
  KEY `cod_vuelo` (`cod_vuelo`),
  CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`cod_pasajero`) REFERENCES `pasajero` (`dni`),
  CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`cod_vuelo`) REFERENCES `vuelo` (`cod`),
  CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`cod_asiento`) REFERENCES `asiento` (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserva`
--

/*!40000 ALTER TABLE `reserva` DISABLE KEYS */;
/*!40000 ALTER TABLE `reserva` ENABLE KEYS */;


--
-- Definition of table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
CREATE TABLE `tipo` (
  `cod` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `total_plazas` int(11) NOT NULL,
  PRIMARY KEY (`cod`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo`
--

/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` (`cod`,`numero`,`total_plazas`) VALUES 
 (1,1,23);
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;


--
-- Definition of table `vuelo`
--

DROP TABLE IF EXISTS `vuelo`;
CREATE TABLE `vuelo` (
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
  KEY `cod_cuesta` (`cod_se_dirige_a`,`cod_parte_de`,`cod_asignado_a`) USING BTREE,
  CONSTRAINT `vuelo_ibfk_1` FOREIGN KEY (`cod_se_dirige_a`) REFERENCES `aeropuerto` (`cod`),
  CONSTRAINT `vuelo_ibfk_2` FOREIGN KEY (`cod_parte_de`) REFERENCES `aeropuerto` (`cod`),
  CONSTRAINT `vuelo_ibfk_3` FOREIGN KEY (`cod_asignado_a`) REFERENCES `avion` (`cod`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vuelo`
--

/*!40000 ALTER TABLE `vuelo` DISABLE KEYS */;
INSERT INTO `vuelo` (`cod`,`fecha_sal`,`fecha_llegada`,`cod_se_dirige_a`,`cod_parte_de`,`cod_asignado_a`) VALUES 
 (1,'2015-01-01 13:00:00','2015-01-01 15:00:00',2,1,1),
 (2,'2015-01-02 13:00:00','2015-01-02 15:00:00',1,2,1),
 (3,'2015-01-03 13:00:00','2015-01-03 15:00:00',3,1,1),
 (4,'2015-01-04 13:00:00','2015-01-04 15:00:00',4,1,1),
 (5,'2015-01-05 13:00:00','2015-01-05 15:00:00',5,1,1),
 (6,'2015-01-06 13:00:00','2015-01-06 15:00:00',6,1,1),
 (7,'2015-01-07 13:00:00','2015-01-07 15:00:00',7,1,1),
 (8,'2015-01-08 13:00:00','2015-01-08 15:00:00',8,1,1),
 (9,'2015-01-09 13:00:00','2015-01-09 15:00:00',9,1,1),
 (10,'2015-01-10 13:00:00','2015-01-10 15:00:00',10,1,1),
 (11,'2015-01-11 13:00:00','2015-01-11 15:00:00',1,1,1);
/*!40000 ALTER TABLE `vuelo` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
