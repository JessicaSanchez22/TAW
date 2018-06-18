-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-06-2018 a las 15:38:29
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
-- Base de datos: `inventarioj`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(255) NOT NULL,
  `descripcion_categoria` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `id_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nombre_categoria`, `descripcion_categoria`, `date_added`, `id_tienda`) VALUES
(1, 'Linea blanca', 'Limpieza', '2018-05-08 00:00:00', 1),
(2, 'Linea blanca', 'Linea blanca y colchoneria', '2018-05-22 00:00:00', 2),
(3, 'Electrodomesticos', 'Electrodomesticos', '2018-05-15 00:00:00', 1),
(5, 'Cosmeticos', 'Cosmeteria', '0000-00-00 00:00:00', 1),
(6, 'Belleza', 'Belleza', '0000-00-00 00:00:00', 2),
(7, 'Ropa', 'Ropa variedad', '0000-00-00 00:00:00', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `date_added` datetime NOT NULL,
  `id_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `email`, `direccion`, `telefono`, `date_added`, `id_tienda`) VALUES
(1, 'lkjn', 'ljkblkj', 'bjkb@uhuh', 'bj', 'bkjhb', '2018-06-18 09:07:25', 0),
(2, 'jkbj', 'bkhjbkj', 'hhjbj@kjskj', 'hbjh', 'bkhjbkj', '2018-06-18 09:07:41', 0),
(4, 'jess', 'iuhi', 'uho@hu', 'uiho', 'ug', '2018-06-18 09:10:54', 0),
(5, 'ii', 'hiuh', 'uho@hu', 'iuh', 'uh', '2018-06-18 09:12:27', 0),
(6, 'Marco', 'Perez', 'marco@hotmail.com', 'Calle politecnico #210', '834567899', '2018-06-18 09:16:45', 1),
(7, 'Angel', 'Sanchez', '1530466@upv.edu.mx', 'Calle politecnico #110', '8645515143', '2018-06-18 09:40:09', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id_historial` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `nota` varchar(255) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `precio_producto` int(11) NOT NULL,
  `cantidad_stock` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo_producto`, `nombre`, `date_added`, `precio_producto`, `cantidad_stock`, `id_categoria`, `id_tienda`) VALUES
(1, 580, 'Labiales mate', '2018-06-06 07:26:25', 300, 11, 1, 1),
(2, 200, 'Sombras para ojos', '2018-06-18 04:50:52', 710, 1, 6, 2),
(4, 67854, 'pestaÃ±as postizas', '2018-06-06 09:08:18', 120, 15, 1, 1),
(5, 1453, 'Mascarilla biore', '2018-06-16 03:23:45', 158, 9, 1, 1),
(6, 1298, 'rubor', '2018-06-14 12:18:37', 180, 77, 5, 1),
(7, 102, 'Brochas para sombras', '2018-06-14 10:06:52', 350, 23, 5, 1),
(8, 2701, 'Licuadora', '2018-06-16 07:15:26', 1500, 13, 3, 1),
(9, 111, 'Refrigerador', '2018-06-17 07:30:06', 17000, 4, 3, 1),
(10, 555, 'Mascarilla', '2018-06-16 07:20:52', 120, 13, 5, 5),
(11, 1203, 'Mascarilla de miel', '2018-06-18 04:50:31', 50, 18, 6, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tienda`
--

CREATE TABLE `tienda` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tienda`
--

INSERT INTO `tienda` (`id`, `nombre`, `date_added`, `estado`) VALUES
(1, 'tiendaA1', '2018-06-11 07:19:48', 'activa'),
(2, 'tienda2', '2018-06-27 09:31:12', 'activa'),
(4, 'miTienda', '2018-06-18 04:48:46', 'activa'),
(5, 'GranD', '2018-06-18 04:48:58', 'desactiva'),
(10, 'Walmart', '2018-06-18 04:42:34', 'desactiva'),
(11, 'JessaBeauty', '2018-06-18 04:32:09', 'activa'),
(12, 'Sally', '2018-06-18 04:41:11', 'desactiva');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_email` varchar(64) NOT NULL,
  `date_added` datetime NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `superadmin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `usuario`, `password`, `user_email`, `date_added`, `id_tienda`, `superadmin`) VALUES
(2, 'Jessica', 'Sanchez Garcia', 'admin', 'admin', 'admin@gmail.com', '2018-06-27 09:31:12', 1, 1),
(3, 'Mario', 'Rodriguez', 'mario', 'mario', 'mario@gmail.com', '2018-06-28 05:17:13', 1, 0),
(4, 'Pedro', 'Perez', 'pedro', '0', 'pedro@gmail.com', '0000-00-00 00:00:00', 1, 0),
(6, 'JosÃ© Marco', 'Fuentes Escamilla', 'marco', 'marco', 'marco@gmail.com', '2018-06-16 07:34:53', 1, 1),
(7, 'Jessa', 'Saga', 'jessa', 'jessa', 'jessa@gmail.com', '2018-06-18 05:00:24', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `codigo_producto` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `id_producto`, `codigo_producto`, `nombre_producto`, `cantidad`, `total`) VALUES
(1, 1, 580, 'Labiales', 3, 0),
(1, 1, 580, 'Labiales mate', 2, 600),
(1, 1, 580, 'Labiales mate', 1, 300),
(1, 1, 580, 'Labiales mate', 5, 1500),
(1, 1, 580, 'Labiales mate', 1, 300),
(1, 1, 580, 'Labiales mate', 6, 1800),
(1, 1, 580, 'Labiales mate', 2, 600),
(1, 5, 1453, 'Mascarilla biore', 1, 158),
(1, 5, 1453, 'Mascarilla biore', 1, 158),
(1, 5, 1453, 'Mascarilla biore', 1, 158),
(1, 4, 67854, 'pestaÃ±as postizas', 1, 120),
(1, 4, 67854, 'pestaÃ±as postizas', 1, 120),
(1, 4, 67854, 'pestaÃ±as postizas', 1, 120),
(1, 4, 67854, 'pestaÃ±as postizas', 2, 240),
(1, 4, 67854, 'pestaÃ±as postizas', 2, 240),
(1, 4, 67854, 'pestaÃ±as postizas', 2, 240),
(1, 4, 67854, 'pestaÃ±as postizas', 2, 240),
(1, 4, 67854, 'pestaÃ±as postizas', 6, 720),
(1, 4, 67854, 'pestaÃ±as postizas', 6, 720),
(1, 4, 67854, 'pestaÃ±as postizas', 6, 720),
(1, 4, 67854, 'pestaÃ±as postizas', 6, 720),
(40, 6, 1298, 'rubor', 2, 360),
(41, 1, 580, 'Labiales mate', 1, 300),
(42, 1, 580, 'Labiales mate', 1, 300),
(43, 1, 580, 'Labiales mate', 11, 3300),
(44, 1, 580, 'Labiales mate', 8, 2400),
(45, 1, 580, 'Labiales mate', 9, 2700),
(46, 1, 580, 'Labiales mate', 6, 1800),
(47, 1, 580, 'Labiales mate', 8, 2400),
(48, 1, 580, 'Labiales mate', 8, 2400),
(49, 1, 580, 'Labiales mate', 6, 1800),
(50, 1, 580, 'Labiales mate', 1, 300),
(51, 5, 1453, 'Mascarilla biore', 2, 316),
(52, 1, 580, 'Labiales mate', 8, 2400),
(53, 1, 580, 'Labiales mate', 3, 900),
(1, 6, 1298, 'rubor', 4, 720),
(1, 6, 1298, 'rubor', 4, 720),
(2, 1, 580, 'Labiales mate', 8, 2400),
(0, 1, 580, 'Labiales mate', 1, 300),
(0, 1, 580, 'Labiales mate', 1, 300),
(0, 1, 580, 'Labiales mate', 1, 300),
(0, 1, 580, 'Labiales mate', 2, 600),
(0, 1, 580, 'Labiales mate', 2, 600),
(0, 6, 1298, 'rubor', 1, 180),
(0, 1, 580, 'Labiales mate', 1, 300),
(0, 1, 580, 'Labiales mate', 1, 300),
(0, 1, 580, 'Labiales mate', 1, 300),
(0, 1, 580, 'Labiales mate', 3, 900),
(0, 1, 580, 'Labiales mate', 3, 900),
(0, 1, 580, 'Labiales mate', 3, 900),
(0, 1, 580, 'Labiales mate', 1, 300),
(0, 5, 1453, 'Mascarilla biore', 1, 158),
(0, 5, 1453, 'Mascarilla biore', 1, 158),
(1, 1, 580, 'Labiales mate', 1, 300),
(1, 6, 1298, 'rubor', 1, 180),
(1, 5, 1453, 'Mascarilla biore', 2, 316),
(2, 6, 1298, 'rubor', 1, 180),
(33, 2, 200, 'Sombras para ojos', 2, 1420),
(34, 2, 200, 'Sombras para ojos', 3, 2130),
(36, 2, 200, 'Sombras para ojos', 5, 3550),
(36, 2, 200, 'Sombras para ojos', 5, 3550),
(6, 2, 200, 'Sombras para ojos', 2, 1420),
(10, 2, 200, 'Sombras para ojos', 2, 1420),
(6, 1, 580, 'Labiales mate', 8, 2400),
(8, 1, 580, 'Labiales mate', 8, 2400),
(9, 1, 580, 'Labiales mate', 2, 600),
(19, 9, 111, 'Refrigerador', 1, 17000),
(25, 8, 2701, 'Licuadora', 2, 3000),
(1, 7, 102, 'Brochas para sombras', 2, 700),
(2, 5, 1453, 'Mascarilla biore', 1, 158),
(3, 1, 580, 'Labiales mate', 1, 300),
(9, 1, 580, 'Labiales mate', 2, 600),
(10, 5, 1453, 'Mascarilla biore', 2, 316),
(42, 1, 580, 'Labiales mate', 3, 900),
(42, 1, 580, 'Labiales mate', 3, 900),
(42, 1, 580, 'Labiales mate', 3, 900),
(42, 1, 580, 'Labiales mate', 3, 900),
(42, 1, 580, 'Labiales mate', 2, 600),
(42, 1, 580, 'Labiales mate', 2, 600),
(42, 1, 580, 'Labiales mate', 2, 600),
(42, 1, 580, 'Labiales mate', 2, 600),
(42, 1, 580, 'Labiales mate', 3, 900),
(43, 1, 580, 'Labiales mate', 2, 600),
(43, 1, 580, 'Labiales mate', 2, 600),
(43, 1, 580, 'Labiales mate', 3, 900),
(43, 1, 580, 'Labiales mate', 3, 900),
(43, 6, 1298, 'rubor', 5, 900),
(43, 6, 1298, 'rubor', 5, 900),
(43, 1, 580, 'Labiales mate', 3, 900),
(43, 1, 580, 'Labiales mate', 2, 600);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `total_venta` int(11) NOT NULL,
  `id_tienda` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `date_added`, `total_venta`, `id_tienda`, `id_cliente`) VALUES
(1, '2018-06-13 07:17:16', 350, 1, 0),
(33, '0000-00-00 00:00:00', 2580, 1, 0),
(34, '2018-06-18 04:13:12', 1420, 2, 0),
(35, '2018-06-18 04:20:12', 2130, 2, 0),
(36, '2018-06-18 04:24:01', 7100, 2, 0),
(37, '2018-06-18 03:09:56', 3000, 1, 6),
(38, '2018-06-18 03:13:41', 12710, 1, 6),
(39, '2018-06-18 03:16:22', 2738, 1, 6),
(40, '2018-06-18 03:17:43', 300, 1, 6),
(41, '2018-06-18 03:18:12', 1200, 1, 6),
(42, '2018-06-18 03:19:40', 1736, 1, 6),
(43, '2018-06-18 03:32:03', 7200, 1, 6),
(44, '2018-06-18 03:36:51', 9600, 1, 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`id_historial`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tienda`
--
ALTER TABLE `tienda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tienda`
--
ALTER TABLE `tienda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
