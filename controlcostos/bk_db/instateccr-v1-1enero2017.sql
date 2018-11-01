-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-01-2018 a las 05:40:09
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

--
-- Volcado de datos para la tabla `proyecto_estado`
--

INSERT INTO `proyecto_estado` (`proyecto_estado_id`, `proyecto_estado`) VALUES
(1, 'En presupuesto'),
(2, 'En ejecución'),
(3, 'Entregado'),
(4, 'Archivado');

--
-- Volcado de datos para la tabla `proyecto_gasto_estado`
--

INSERT INTO `proyecto_gasto_estado` (`proyecto_gasto_estado_id`, `proyecto_gasto_estado`) VALUES
(1, 'Pendiente'),
(2, 'Cancelado');

--
-- Volcado de datos para la tabla `proyecto_gasto_tipo`
--

INSERT INTO `proyecto_gasto_tipo` (`proyecto_gasto_tipo_id`, `proyecto_gasto_tipo`) VALUES
(1, 'Gasto en Materiales'),
(2, 'Gasto en Mano de Obra'),
(3, 'Gasto de Operación'),
(4, 'Gasto Administrativo');

--
-- Volcado de datos para la tabla `proyecto_valor_oferta_extension_tipo`
--

INSERT INTO `proyecto_valor_oferta_extension_tipo` (`proyecto_valor_oferta_extension_tipo_id`, `proyecto_valor_oferta_extension_tipo`, `estado_registro`) VALUES
(1, 'Paredes', 1),
(2, 'Cielo', 1),
(3, 'Pisos', 1);

--
-- Volcado de datos para la tabla `proyecto_valor_oferta_tipo`
--

INSERT INTO `proyecto_valor_oferta_tipo` (`proyecto_valor_oferta_tipo_id`, `proyecto_valor_oferta_tipo`) VALUES
(1, 'Valor de Materiales'),
(2, 'Valor de Mano de Obra'),
(3, 'Valor de Gastos de Operación'),
(4, 'Valor de Gastos Administrativos'),
(5, 'Valor de Utilidad'),
(6, 'Valor de Extensiones');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
