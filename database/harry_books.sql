-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-07-2018 a las 06:41:06
-- Versión del servidor: 10.1.10-MariaDB
-- Versión de PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `harry_books`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id_libro` int(11) NOT NULL,
  `nombre_libro` varchar(200) NOT NULL,
  `cantidad_libro` int(11) NOT NULL,
  `precio_libro` float NOT NULL,
  `imagen_libro` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id_libro`, `nombre_libro`, `cantidad_libro`, `precio_libro`, `imagen_libro`) VALUES
(1, 'Harry Potter y la piedra filosofal', 4, 50000, 'libro_01.jpg'),
(2, 'Harry Potter y la cámara secreta', 7, 58000, 'libro_02.jpg'),
(3, 'Harry Potter y el prisionero de Azkaban', 11, 60000, 'libro_03.jpg'),
(4, 'Harry Potter y el cáliz de fuego', 2, 45000, 'libro_04.jpg'),
(5, 'Harry Potter y la Orden del Fénix', 15, 38000, 'libro_05.jpg'),
(6, 'Harry Potter y el misterio del príncipe', 5, 50000, 'libro_06.jpg'),
(7, 'Harry Potter y las Reliquias de la Muerte', 2, 45000, 'libro_07.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro_venta`
--

CREATE TABLE `libro_venta` (
  `id_venta` int(11) NOT NULL,
  `id_resumen_venta` int(11) NOT NULL,
  `id_libro` int(11) NOT NULL,
  `cantidad_libro` int(11) NOT NULL,
  `precio_libro` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `libro_venta`
--

INSERT INTO `libro_venta` (`id_venta`, `id_resumen_venta`, `id_libro`, `cantidad_libro`, `precio_libro`) VALUES
(15, 11, 1, 2, 50000),
(16, 11, 2, 1, 58000),
(17, 11, 3, 1, 60000),
(18, 11, 4, 1, 45000),
(19, 12, 2, 2, 58000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resumen_venta`
--

CREATE TABLE `resumen_venta` (
  `id_resumen` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_venta` datetime NOT NULL,
  `total_venta` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `resumen_venta`
--

INSERT INTO `resumen_venta` (`id_resumen`, `id_usuario`, `fecha_venta`, `total_venta`) VALUES
(11, 2, '2018-07-05 00:00:00', 263000),
(12, 3, '2018-07-05 00:00:00', 116000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(200) NOT NULL,
  `user_usuario` varchar(200) NOT NULL,
  `password_usuario` varchar(300) NOT NULL,
  `rol_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `user_usuario`, `password_usuario`, `rol_usuario`) VALUES
(1, 'Administrador', 'admin', '$2y$10$L5tDlpY2CitxitdQIImdsOsQBO2GyNdfEXlghJfm5To7AHK1O2XIC', 100001),
(2, 'Sebastian', 'cliente', '$2y$10$B0yPtuD.4sNBhCdkoLw5xuSodXLBf8uueJEHOpaw8pASieKoc8HUO', 100002),
(3, 'Johan', 'cliente2', '$2y$10$YMGLtKte6Vl9OCKiFjZQruw92wI4WfiE31sdZqSNyAq2oF2iZWwza', 100002);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id_libro`);

--
-- Indices de la tabla `libro_venta`
--
ALTER TABLE `libro_venta`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_libro` (`id_libro`),
  ADD KEY `id_resumen_venta` (`id_resumen_venta`);

--
-- Indices de la tabla `resumen_venta`
--
ALTER TABLE `resumen_venta`
  ADD PRIMARY KEY (`id_resumen`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id_libro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `libro_venta`
--
ALTER TABLE `libro_venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `resumen_venta`
--
ALTER TABLE `resumen_venta`
  MODIFY `id_resumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libro_venta`
--
ALTER TABLE `libro_venta`
  ADD CONSTRAINT `libro_venta_ibfk_1` FOREIGN KEY (`id_libro`) REFERENCES `libros` (`id_libro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `libro_venta_ibfk_2` FOREIGN KEY (`id_resumen_venta`) REFERENCES `resumen_venta` (`id_resumen`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `resumen_venta`
--
ALTER TABLE `resumen_venta`
  ADD CONSTRAINT `resumen_venta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
