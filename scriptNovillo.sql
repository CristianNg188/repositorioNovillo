-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2023 a las 17:49:22
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `polideportivo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineasreservas`
--

CREATE TABLE `lineasreservas` (
  `id` int(11) NOT NULL,
  `idReserva` int(11) NOT NULL,
  `idPista` int(11) NOT NULL,
  `hora` int(11) NOT NULL,
  `fecha` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lineasreservas`
--

INSERT INTO `lineasreservas` (`id`, `idReserva`, `idPista`, `hora`, `fecha`) VALUES
(1, 1, 3, 12, '2023-05-13'),
(5, 5, 1, 12, '2023-06-09'),
(6, 5, 5, 14, '2023-06-09'),
(7, 6, 1, 9, '2023-06-10'),
(22, 12, 1, 12, '2023-06-12'),
(23, 12, 1, 13, '2023-06-12'),
(24, 12, 6, 18, '2023-06-12'),
(25, 13, 1, 9, '2023-06-20'),
(26, 13, 1, 10, '2023-06-20'),
(27, 13, 1, 16, '2023-06-20'),
(28, 13, 1, 17, '2023-06-20'),
(29, 13, 3, 12, '2023-06-20'),
(30, 13, 3, 13, '2023-06-20'),
(31, 13, 3, 20, '2023-06-20'),
(32, 13, 3, 21, '2023-06-20'),
(33, 13, 4, 17, '2023-06-20'),
(34, 13, 4, 16, '2023-06-20'),
(35, 13, 4, 15, '2023-06-20'),
(36, 13, 5, 19, '2023-06-20'),
(37, 13, 5, 18, '2023-06-20'),
(38, 13, 5, 17, '2023-06-20'),
(39, 13, 6, 11, '2023-06-20'),
(40, 13, 6, 12, '2023-06-20'),
(41, 13, 6, 13, '2023-06-20'),
(42, 13, 5, 11, '2023-06-20'),
(44, 13, 1, 20, '2023-06-20'),
(45, 13, 6, 22, '2023-06-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pistas`
--

CREATE TABLE `pistas` (
  `id` int(11) NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `numero` int(11) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pistas`
--

INSERT INTO `pistas` (`id`, `tipo`, `numero`, `descripcion`, `precio`) VALUES
(1, 'Futbol', 1, 'Pista de futbol 11', 22),
(2, 'Futbol', 2, 'Pista de futbol 7', 14),
(3, 'Futbol', 3, 'Pista de futbol sala', 10),
(4, 'Baloncesto', 1, 'Cancha de baloncesto', 15),
(5, 'Baloncesto', 2, 'Cancha de baloncesto', 18),
(6, 'Tenis', 1, 'Pista de tenis', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id`, `idUsuario`, `fecha`, `precio`) VALUES
(1, 1, '2023-05-11 22:00:00', 18),
(5, 1, '2023-06-08 19:55:39', 40),
(6, 2, '2023-06-08 22:03:24', 22),
(12, 2, '2023-06-11 18:09:50', 52),
(13, 1, '2023-06-14 15:29:41', 299);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(1000) DEFAULT NULL,
  `nombre` varchar(300) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `telefono` varchar(9) NOT NULL,
  `poblacion` varchar(100) NOT NULL,
  `rol` varchar(5) NOT NULL,
  `estado` varchar(10) NOT NULL,
  `uid` varchar(1000) DEFAULT NULL,
  `foto` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `email`, `contrasena`, `nombre`, `dni`, `telefono`, `poblacion`, `rol`, `estado`, `uid`, `foto`) VALUES
(1, 'Cris', 'cris@gmail.com', '$2y$10$Z87YnXcs099j3OHJepAV6ukzuFj1xZvLEeDc0l0onShVXjpDzeyIe', 'Cristian Novillo Gomez', '06335281P', '123456789', 'Tomelloso', 'admin', 'activo', '587c1dabb75f8252a7d17eb0522fb2359fdd5706', '5c148241575f4d17e9ef194a916f3625.jpg'),
(2, 'Pepe', 'pepe@gmail.com', '$2y$10$Uy9GEKRbQrsZR7PElMJB7.bFYscwkxAyjWQHNRS9GnljCOpKeCc.a', 'Pedro Moreno Caro', '06331872T', '987654321', 'Tomelloso', 'user', 'activo', 'd3a0b831400c2c92a61f354cda53cf0d4f527523', 'c8b185b02698f3224924f0fd3ada746e.png'),
(5, 'Mig', 'migue@gmail.com', '$2y$10$qotjegkKH4ZeKokdHyBTZ.I8FPSjbWTqgy1W.EzoddTG9K2kiS4D6', 'Miguel cobo', '06339864H', '12344445', 'Cuenca', 'admin', 'inactivo', 'b1c719f40c5a053ef0c711ae5cdbc59a08f1041b', '247476b1c1de8e5f1343dd71ec3146c4.jpg'),
(13, '', 'prueba@gmail.com', '', 'prueba nombre', '06335281Y', '323454322', 'Alcazar', 'user', 'activo', 'c38450bc8956aaef85756f30c37a6ae90da36c2d', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `lineasreservas`
--
ALTER TABLE `lineasreservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idReserva` (`idReserva`),
  ADD KEY `idPista` (`idPista`);

--
-- Indices de la tabla `pistas`
--
ALTER TABLE `pistas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `lineasreservas`
--
ALTER TABLE `lineasreservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `pistas`
--
ALTER TABLE `pistas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineasreservas`
--
ALTER TABLE `lineasreservas`
  ADD CONSTRAINT `lineasreservas_ibfk_1` FOREIGN KEY (`idReserva`) REFERENCES `reservas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lineasreservas_ibfk_2` FOREIGN KEY (`idPista`) REFERENCES `pistas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
