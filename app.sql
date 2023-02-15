-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2023 a las 13:21:18
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `app`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id` int(4) NOT NULL,
  `primerNombre` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `segundoNombre` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `primerApellido` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `segundoApellido` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `foto` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `cv` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `idPuesto` int(11) NOT NULL,
  `fechaRegistro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id`, `primerNombre`, `segundoNombre`, `primerApellido`, `segundoApellido`, `foto`, `cv`, `idPuesto`, `fechaRegistro`) VALUES
(1, 'Maria', '', 'Fernandez', 'Fernandez', '1676459779_images (3).jpg', '1676459779_CVDaniela.pdf', 1, '2020-02-02'),
(2, 'Carmen', '', 'Conde', 'Prieto', '1676459924_images (5).jpg', '1676459924_CVDaniela.pdf', 4, '2021-09-23'),
(3, 'Juan', '', 'Rodriguez', 'Blanco', '1676460570_images.jpg', '1676460040_CVDaniela.pdf', 10, '2021-07-06'),
(4, 'Jose', '', 'Moreno', 'Gallego', '1676460119_images (1).jpg', '1676460119_CVDaniela.pdf', 7, '2019-11-18'),
(5, 'Ana', '', 'Rubio', 'Marquez', '1676460648_images (2).jpg', '1676460198_CVDaniela.pdf', 9, '2020-10-14'),
(6, 'Manuel', '', 'Fuentes', 'Marquez', '1676460681_images (5).jpg', '1676460317_CVDaniela.pdf', 2, '2021-12-12'),
(7, 'Vicente', '', 'Moreno', 'Fernandez', '1676460385_images (5).jpg', '1676460385_CVDaniela.pdf', 12, '2019-05-03'),
(8, 'Maria', '', 'Fernandez', 'Marquez', '1676460449_images (3).jpg', '1676460449_CVDaniela.pdf', 11, '2018-08-15'),
(9, 'Carmen', '', 'Rubio', 'Rubio', '1676460538_images.jpg', '1676460538_CVDaniela.pdf', 8, '2019-04-11'),
(10, 'Jose', '', 'Conde', 'Fernandez', '1676460754_images (2).jpg', '1676460754_CVDaniela.pdf', 6, '2020-06-06'),
(11, 'Silvia', '', 'Rubio', 'Gallego', '1676460838_images (3).jpg', '1676460838_CVDaniela.pdf', 3, '2021-12-19'),
(12, 'Manuel', '', 'Fuentes', 'Prieto', '1676460930_images (5).jpg', '1676460930_CVDaniela.pdf', 2, '2019-01-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestos`
--

CREATE TABLE `puestos` (
  `id` int(4) NOT NULL,
  `nombrePuesto` varchar(255) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `puestos`
--

INSERT INTO `puestos` (`id`, `nombrePuesto`) VALUES
(1, 'Programador/a Jr.'),
(2, 'Programador/a Sr.'),
(3, 'Tester'),
(4, 'Desarrollador/a front end'),
(5, 'Desarrollador/a back end'),
(6, 'Lider de proyecto'),
(7, 'Programador/a PHP'),
(8, 'Maquetador/a web'),
(9, 'DiseÃ±ador/a web'),
(10, 'Analista de datos'),
(11, 'Administrador/a BBDD'),
(12, 'Administrador/a Linux');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(4) NOT NULL,
  `usuario` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `contrasena` varchar(255) COLLATE latin1_spanish_ci NOT NULL,
  `email` varchar(255) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasena`, `email`) VALUES
(1, 'Daniela', '1234', 'daniela@gmail.com'),
(2, 'Maria', '1234', 'maria@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPuesto` (`idPuesto`);

--
-- Indices de la tabla `puestos`
--
ALTER TABLE `puestos`
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
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `puestos`
--
ALTER TABLE `puestos`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`idPuesto`) REFERENCES `puestos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
