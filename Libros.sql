-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-12-2019 a las 11:13:32
-- Versión del servidor: 10.1.43-MariaDB-0ubuntu0.18.04.1
-- Versión de PHP: 7.0.31-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Libros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BD_Formato`
--

CREATE TABLE `BD_Formato` (
  `IDFormato` int(11) NOT NULL,
  `Nombre` varchar(2) NOT NULL,
  `Tamaño` varchar(15) NOT NULL,
  `NumPaginas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BD_LibroFormato`
--

CREATE TABLE `BD_LibroFormato` (
  `CodigoLibro` int(11) NOT NULL,
  `IDFormato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `BD_Libros`
--

CREATE TABLE `BD_Libros` (
  `Codigo` int(11) NOT NULL,
  `Titulo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `BD_Formato`
--
ALTER TABLE `BD_Formato`
  ADD PRIMARY KEY (`IDFormato`);

--
-- Indices de la tabla `BD_LibroFormato`
--
ALTER TABLE `BD_LibroFormato`
  ADD PRIMARY KEY (`CodigoLibro`,`IDFormato`),
  ADD KEY `FK_Formatos` (`IDFormato`);

--
-- Indices de la tabla `BD_Libros`
--
ALTER TABLE `BD_Libros`
  ADD PRIMARY KEY (`Codigo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `BD_Formato`
--
ALTER TABLE `BD_Formato`
  MODIFY `IDFormato` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `BD_Libros`
--
ALTER TABLE `BD_Libros`
  MODIFY `Codigo` int(11) NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `BD_LibroFormato`
--
ALTER TABLE `BD_LibroFormato`
  ADD CONSTRAINT `FK_Formatos` FOREIGN KEY (`IDFormato`) REFERENCES `BD_Formato` (`IDFormato`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_Libros` FOREIGN KEY (`CodigoLibro`) REFERENCES `BD_Libros` (`Codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
