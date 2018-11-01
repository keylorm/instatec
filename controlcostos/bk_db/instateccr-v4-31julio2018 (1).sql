-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-10-2018 a las 05:41:30
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `instateccr`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_material_solicitud_compra`
--

CREATE TABLE `proyecto_material_solicitud_compra` (
  `proyecto_material_solicitud_compra_id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `proyecto_material_solicitud_compra_estado_id` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_material_solicitud_compra_detalle`
--

CREATE TABLE `proyecto_material_solicitud_compra_detalle` (
  `proyecto_material_solicitud_compra_detalle_id` int(11) NOT NULL,
  `proyecto_material_solicitud_compra_id` int(11) NOT NULL,
  `proyecto_material_id` int(11) NOT NULL,
  `cantidad` float(20,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_material_solicitud_compra_estado`
--

CREATE TABLE `proyecto_material_solicitud_compra_estado` (
  `proyecto_material_solicitud_compra_estado_id` int(11) NOT NULL,
  `proyecto_material_solicitud_compra_estado` varchar(150) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_material_solicitud_compra_estado`
--

INSERT INTO `proyecto_material_solicitud_compra_estado` (`proyecto_material_solicitud_compra_estado_id`, `proyecto_material_solicitud_compra_estado`) VALUES
(1, 'Nueva solicitud'),
(2, 'Aprobada por administrador'),
(3, 'Proforma enviada'),
(4, 'Orden de compra enviada');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyecto_material_solicitud_compra`
--
ALTER TABLE `proyecto_material_solicitud_compra`
  ADD PRIMARY KEY (`proyecto_material_solicitud_compra_id`);

--
-- Indices de la tabla `proyecto_material_solicitud_compra_detalle`
--
ALTER TABLE `proyecto_material_solicitud_compra_detalle`
  ADD PRIMARY KEY (`proyecto_material_solicitud_compra_detalle_id`);

--
-- Indices de la tabla `proyecto_material_solicitud_compra_estado`
--
ALTER TABLE `proyecto_material_solicitud_compra_estado`
  ADD PRIMARY KEY (`proyecto_material_solicitud_compra_estado_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_compra`
--
ALTER TABLE `proyecto_material_solicitud_compra`
  MODIFY `proyecto_material_solicitud_compra_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_compra_detalle`
--
ALTER TABLE `proyecto_material_solicitud_compra_detalle`
  MODIFY `proyecto_material_solicitud_compra_detalle_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_compra_estado`
--
ALTER TABLE `proyecto_material_solicitud_compra_estado`
  MODIFY `proyecto_material_solicitud_compra_estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
