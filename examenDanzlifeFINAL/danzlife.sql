-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2018 a las 06:01:39
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
-- Base de datos: `danzlife`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnas`
--

CREATE TABLE `alumnas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `edad` int(11) NOT NULL,
  `nombre_mama` varchar(255) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnas`
--

INSERT INTO `alumnas` (`id`, `nombre`, `edad`, `nombre_mama`, `id_grupo`) VALUES
(1, 'Julissa Morales Perez', 8, 'Julissa Perez Juarez', 3),
(2, 'Joanna Mora Lopez', 6, 'Juanita Mora Mendez', 2),
(3, 'Melissa Puente Escobar', 10, 'Magda Puente Flores', 3),
(4, 'Rosa Vazquez Chavez', 11, 'Rosa Vazquez Moreno', 3),
(6, 'Jessica Sanchez Garcia', 12, 'Beatriz Garcia Ortiz', 5),
(7, 'Fernanda Lizeth Rojas Porras', 7, 'Nancy Porras Ochoa', 6),
(8, 'Martha Baez Solis', 8, 'Laura Solis Espinoza', 6),
(9, 'Maria Jose', 8, 'Maria Juana', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`) VALUES
(1, 'Basico 2'),
(2, 'Basico'),
(3, 'Intermedio'),
(4, 'Basico 3'),
(5, 'Avanzado'),
(6, 'Infantil 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `id_alumna` int(11) NOT NULL,
  `nombre_mama` varchar(255) NOT NULL,
  `fecha_pago` date NOT NULL,
  `fecha_envio` datetime NOT NULL,
  `folio_autorizacion` int(11) NOT NULL,
  `ruta_imagen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `id_grupo`, `id_alumna`, `nombre_mama`, `fecha_pago`, `fecha_envio`, `folio_autorizacion`, `ruta_imagen`) VALUES
(35, 2, 2, 'Maria Puente Saldivar', '2018-06-26', '2018-06-25 12:30:34', 222, '_pregunta2.png'),
(36, 2, 2, 'ljl Vazquez Montiel', '2018-06-24', '2018-06-25 12:36:59', 555, '_pregunta9.png'),
(38, 2, 2, 'Maria Vazquez Montiel', '2018-06-27', '2018-06-25 12:42:58', 111, '37_codigo3.png'),
(39, 2, 2, 'Liliana Mora Sanchez', '2018-06-28', '2018-06-25 12:45:22', 333, '_pregunta21.png'),
(40, 3, 3, 'Juanita Puente Saldivar', '2018-06-24', '2018-06-25 12:48:33', 333, '40_codigo4.png'),
(43, 5, 6, 'Beatriz Garcia Ortiz', '2018-06-24', '2018-06-25 12:54:38', 222, '43_pregunta9_2.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`) VALUES
(1, 'Jessica Sanchez', 'admin', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnas`
--
ALTER TABLE `alumnas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnas`
--
ALTER TABLE `alumnas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
