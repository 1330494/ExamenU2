-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-05-2018 a las 20:55:07
-- Versión del servidor: 5.6.38
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `examu2`
--

CREATE DATABASE examu2;

USE examu2;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuarios`
--
CREATE TABLE usuarios
(
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(35) NOT NULL,
	password VARCHAR(16) NOT NULL
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `grupos`
--
CREATE TABLE grupos
(
	id INT PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(50) NOT NULL
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `alumnas`
--
CREATE TABLE alumnas
(
	id INT PRIMARY KEY AUTO_INCREMENT,
	nombre VARCHAR(30) NOT NULL,
	apellidos VARCHAR(30) NOT NULL,
	fecha_nac DATE NOT NULL,
	id_grupo INT NOT NULL
);

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `pagos`
--
CREATE TABLE pagos
(
	id INT(11) PRIMARY KEY AUTO_INCREMENT,
	id_alumna INT(11) REFERENCES alumnas(id),
	id_grupo INT(11) REFERENCES grupos(id),
	nombre_mama VARCHAR(32) NOT NULL,
	apellidos_mama VARCHAR(32) NOT NULL,
	fecha_pago DATE NOT NULL,
	fecha_envio DATE NOT NULL,
	comprobante VARCHAR(128) NOT NULL,
	folio INT(11) NOT NULL
);

--
-- Volcado de datos para la tabla `grupos`
--
INSERT INTO  usuarios(username password)
VALUES ('admin', 'admin'), ('gomez','12345');

--
-- Volcado de datos para la tabla `grupos`
--
INSERT INTO  grupos(nombre)
VALUES ('1-A'), ('1-B'),('2-A'), ('2-B');

--
-- Volcado de datos para la tabla `grupos`
--
INSERT INTO  alumnas (id, nombre, apellidos, fecha_nac, id_grupo)
VALUES ( 'Maria Daniela',  'Castro Moran',  '2014-02-13',  1), 
('Cristina ',  'Aguilera',  '2013-12-18',  2);

/*
usuarios
	id
	username
	password

Grupos
	id
	nombre

ALumnas
	nombre 
	apellidos 
	fecha nac
	grupo

Pagos
	id
	id alumna
	id grupo
	nombre mama
	apellidos mama
	fecha pago
	fecha envio
	comprobante (.png y .jpg)
	folio

orden
	id
	id grupo
	id alumna
	nombre mama
	apellidos mama
	fecha pago
	comprobante
	folio
*/

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


