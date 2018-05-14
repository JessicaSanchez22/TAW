-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2018 a las 05:27:44
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `deportes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `basquetbolistas`
--

CREATE TABLE `basquetbolistas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `posicion` varchar(50) NOT NULL,
  `carrera` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `basquetbolistas`
--

INSERT INTO `basquetbolistas` (`id`, `nombre`, `posicion`, `carrera`, `email`) VALUES
(1, 'Jessica Sanchez Garcia', 'Portero', 'tec de la informacion', 'jessica@gmail.com'),
(2, 'Julieta Barrios', 'Centro', 'Meca', 'Ju@gmail.com'),
(4, 'Panchito Canelas', 'Defensa', 'PyMES', 'pansh@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `futbolistas`
--

CREATE TABLE `futbolistas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `posicion` varchar(50) NOT NULL,
  `carrera` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `futbolistas`
--

INSERT INTO `futbolistas` (`id`, `nombre`, `posicion`, `carrera`, `email`) VALUES
(1, 'Jose Marco Fuentes', 'Delantero', 'Tec de la informacion', 'marqo.fe@gmail.com'),
(2, 'Jose Morales', 'Defensa', 'ISA', 'jo@gmail.com'),
(3, 'Jaime Lopez', 'central', 'ITI', 'jaime@gmail.com'),
(4, 'Mateo Ligas', 'Central izquierdo', 'ITI', 'teto@gmail'),
(7, 'Angel Sanchez', 'Portero', 'Meca', 'ange_innl@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `basquetbolistas`
--
ALTER TABLE `basquetbolistas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `futbolistas`
--
ALTER TABLE `futbolistas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `basquetbolistas`
--
ALTER TABLE `basquetbolistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `futbolistas`
--
ALTER TABLE `futbolistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
