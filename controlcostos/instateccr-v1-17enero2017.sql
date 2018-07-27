-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-01-2018 a las 05:09:55
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
-- Estructura de tabla para la tabla `canton`
--

CREATE TABLE `canton` (
  `canton_id` int(11) NOT NULL,
  `provincia_id` int(11) NOT NULL,
  `canton_id_provincia` int(11) NOT NULL,
  `canton` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `canton`
--

INSERT INTO `canton` (`canton_id`, `provincia_id`, `canton_id_provincia`, `canton`) VALUES
(1, 1, 1, 'San José'),
(2, 1, 2, 'Escazú'),
(3, 1, 3, 'Desamparados'),
(4, 1, 4, 'Puriscal'),
(5, 1, 5, 'Tarrazú'),
(6, 1, 6, 'Aserrí'),
(7, 1, 7, 'Mora'),
(8, 1, 8, 'Goicoechea'),
(9, 1, 9, 'Santa Ana'),
(10, 1, 10, 'Alajuelita'),
(11, 1, 11, 'Vásquez de Coronado'),
(12, 1, 12, 'Acosta'),
(13, 1, 13, 'Tibás'),
(14, 1, 14, 'Moravia'),
(15, 1, 15, 'Montes de Oca'),
(16, 1, 16, 'Turrubares'),
(17, 1, 17, 'Dota'),
(18, 1, 18, 'Curridabat'),
(19, 1, 19, 'Pérez Zeledón'),
(20, 1, 20, 'León Cortés'),
(21, 2, 1, 'Alajuela'),
(22, 2, 2, 'San Ramón'),
(23, 2, 3, 'Grecia'),
(24, 2, 4, 'San Mateo'),
(25, 2, 5, 'Atenas'),
(26, 2, 6, 'Naranjo'),
(27, 2, 7, 'Palmares'),
(28, 2, 8, 'Poás'),
(29, 2, 9, 'Orotina'),
(30, 2, 10, 'San Carlos'),
(31, 2, 11, 'Zarcero'),
(32, 2, 12, 'Valverde Vega'),
(33, 2, 13, 'Upala'),
(34, 2, 14, 'Los Chiles'),
(35, 2, 15, 'Guatuso'),
(36, 2, 16, 'Río Cuarto'),
(37, 3, 1, 'Cartago'),
(38, 3, 2, 'Paraíso'),
(39, 3, 3, 'La Unión'),
(40, 3, 4, 'Jiménez'),
(41, 3, 5, 'Turrialba'),
(42, 3, 6, 'Alvarado'),
(43, 3, 7, 'Oreamuno'),
(44, 3, 8, 'El Guarco'),
(45, 4, 1, 'Heredia'),
(46, 4, 2, 'Barva'),
(47, 4, 3, 'Santo Domingo'),
(48, 4, 4, 'Santa Bárbara'),
(49, 4, 5, 'San Rafael'),
(50, 4, 6, 'San Isidro'),
(51, 4, 7, 'Belén'),
(52, 4, 8, 'Flores'),
(53, 4, 9, 'San Pablo'),
(54, 4, 10, 'Sarapiquí'),
(55, 5, 1, 'Liberia'),
(56, 5, 2, 'Nicoya'),
(57, 5, 3, 'Santa Cruz'),
(58, 5, 4, 'Bagaces'),
(59, 5, 5, 'Carrillo'),
(60, 5, 6, 'Cañas'),
(61, 5, 7, 'Abangares'),
(62, 5, 8, 'Tilarán'),
(63, 5, 9, 'Nandayure'),
(64, 5, 10, 'La Cruz'),
(65, 5, 11, 'Hojancha'),
(66, 6, 1, 'Puntarenas'),
(67, 6, 2, 'Esparza'),
(68, 6, 3, 'Buenos Aires'),
(69, 6, 4, 'Montes de Oro'),
(70, 6, 5, 'Osa'),
(71, 6, 6, 'Quepos'),
(72, 6, 7, 'Golfito'),
(73, 6, 8, 'Coto Brus'),
(74, 6, 9, 'Parrita'),
(75, 6, 10, 'Corredores'),
(76, 6, 11, 'Garabito'),
(77, 7, 1, 'Limón'),
(78, 7, 2, 'Pococí'),
(79, 7, 3, 'Siquirres'),
(80, 7, 4, 'Talamanca'),
(81, 7, 5, 'Matina'),
(82, 7, 6, 'Guácimo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `nombre_cliente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cedula_cliente` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado_cliente` int(11) NOT NULL COMMENT '0 para inactivo, 1 para activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_correo`
--

CREATE TABLE `cliente_correo` (
  `cliente_correo_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `correo_cliente` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_telefono`
--

CREATE TABLE `cliente_telefono` (
  `cliente_telefono_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `telefono_cliente` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador`
--

CREATE TABLE `colaborador` (
  `colaborador_id` int(11) NOT NULL,
  `colaborador_puesto_id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo_electronico` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cedula` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `seguro_social` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `identificador_interno` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador_costo_hora`
--

CREATE TABLE `colaborador_costo_hora` (
  `colaborador_costo_hora_id` int(11) NOT NULL,
  `colaborador_id` int(11) NOT NULL,
  `moneda_id` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `costo_hora` float(10,2) NOT NULL,
  `estado_costo` int(11) NOT NULL COMMENT '0 es inactivo, 1 es activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador_puesto`
--

CREATE TABLE `colaborador_puesto` (
  `colaborador_puesto_id` int(11) NOT NULL,
  `puesto` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `distrito`
--

CREATE TABLE `distrito` (
  `distrito_id` int(11) NOT NULL,
  `canton_id` int(11) NOT NULL,
  `distrito_id_provincia` int(11) NOT NULL,
  `distrito` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `distrito`
--

INSERT INTO `distrito` (`distrito_id`, `canton_id`, `distrito_id_provincia`, `distrito`) VALUES
(1, 1, 1, 'Carmen'),
(2, 1, 2, 'Merced'),
(3, 1, 3, 'Hospital'),
(4, 1, 4, 'Catedral'),
(5, 1, 5, 'Zapote'),
(6, 1, 6, 'San Francisco de Dos Ríos'),
(7, 1, 7, 'Uruca'),
(8, 1, 8, 'Mata Redonda'),
(9, 1, 9, 'Pavas'),
(10, 1, 10, 'Hatillo'),
(11, 1, 11, 'San Sebastián'),
(12, 2, 12, 'Escazu'),
(13, 2, 13, 'San Antonio'),
(14, 2, 14, 'San Rafael'),
(15, 3, 15, 'Desamparados'),
(16, 3, 16, 'San Miguel'),
(17, 3, 17, 'San Juan de Dios'),
(18, 3, 18, 'San Rafael Arriba'),
(19, 3, 19, 'San Antonio'),
(20, 3, 20, 'Frailes'),
(21, 3, 21, 'Patarrá'),
(22, 3, 22, 'San Cristóbal'),
(23, 3, 23, 'Rosario'),
(24, 3, 24, 'Damas'),
(25, 3, 25, 'San Rafael Abajo'),
(26, 3, 26, 'Gravillas'),
(27, 3, 27, 'Los Guido'),
(28, 4, 28, 'Santiago'),
(29, 4, 29, 'Mercedes Sur'),
(30, 4, 30, 'Barbacoas'),
(31, 4, 31, 'Grito Alto'),
(32, 4, 32, 'San Rafael'),
(33, 4, 33, 'Candelarita'),
(34, 4, 34, 'Desamparaditos'),
(35, 4, 35, 'San Antonio'),
(36, 4, 36, 'Chires'),
(37, 4, 37, 'La Cangreja'),
(38, 5, 38, 'San Marcos'),
(39, 5, 39, 'San Lorenzo'),
(40, 5, 40, 'San Carlos'),
(41, 6, 41, 'Aserrí'),
(42, 6, 42, 'Tarbaca'),
(43, 6, 43, 'Vuelta de Jorco'),
(44, 6, 44, 'San Gabriel'),
(45, 6, 45, 'Legua'),
(46, 6, 46, 'Monterrey'),
(47, 6, 47, 'Salitrillos'),
(48, 7, 48, 'Ciudad Colón'),
(49, 7, 49, 'Guayabo'),
(50, 7, 50, 'Tabarcia'),
(51, 7, 51, 'Piedras Negras'),
(52, 7, 52, 'Picagres'),
(53, 7, 53, 'Jaris'),
(54, 7, 54, 'Quitirrisí'),
(55, 8, 55, 'Guadalupe'),
(56, 8, 56, 'San Francisco'),
(57, 8, 57, 'Calle Blancos'),
(58, 8, 58, 'Mata de Plátano'),
(59, 8, 59, 'Ipís'),
(60, 8, 60, 'Rancho Redondo'),
(61, 8, 61, 'Purral'),
(62, 9, 62, 'Santa Ana'),
(63, 9, 63, 'Salitral'),
(64, 9, 64, 'Pozos'),
(65, 9, 65, 'Uruca'),
(66, 9, 66, 'Piedades'),
(67, 9, 67, 'Brasil'),
(68, 10, 68, 'Alajuelita'),
(69, 10, 69, 'San Josecito'),
(70, 10, 70, 'San Antonio'),
(71, 10, 71, 'Concepción'),
(72, 10, 72, 'San Felipe'),
(73, 11, 73, 'San Isidro'),
(74, 11, 74, 'San Rafael'),
(75, 11, 78, 'Dulce Nombre de Jesús'),
(76, 11, 76, 'Patalillo'),
(77, 11, 77, 'Cascajal'),
(78, 12, 78, 'San Ignacio'),
(79, 12, 79, 'Guaitil'),
(80, 12, 80, 'Palmichal'),
(81, 12, 81, 'Cangrejal'),
(82, 12, 82, 'Sabanillas'),
(83, 13, 83, 'San Juan'),
(84, 13, 84, 'Cinco Esquinas'),
(85, 13, 85, 'Anselmo Llorente'),
(86, 13, 86, 'León XIII'),
(87, 13, 87, 'Colima'),
(88, 14, 88, 'San Vicente'),
(89, 14, 89, 'San Jerónimo'),
(90, 14, 90, 'Trinidad'),
(91, 15, 91, 'San Pedro'),
(92, 15, 92, 'Sabanilla'),
(93, 15, 93, 'Mercedes'),
(94, 15, 94, 'San Rafael'),
(95, 16, 95, 'San Pablo'),
(96, 16, 96, 'San Pedro'),
(97, 16, 97, 'San Juan de Mata'),
(98, 16, 98, 'San Luis'),
(99, 16, 99, 'Carara'),
(100, 17, 100, 'Santa María'),
(101, 17, 101, 'Jardín'),
(102, 17, 102, 'Copey'),
(103, 18, 103, 'Curridabat'),
(104, 18, 104, 'Granadilla'),
(105, 18, 105, 'Sánchez'),
(106, 18, 106, 'Tirrases'),
(107, 19, 107, 'San Isidro de El General'),
(108, 19, 108, 'El General'),
(109, 19, 109, 'Daniel Flores'),
(110, 19, 110, 'Rivas'),
(111, 19, 111, 'San Pedro'),
(112, 19, 112, 'Platanares'),
(113, 19, 113, 'Pejibaye'),
(114, 19, 114, 'Cajón'),
(115, 19, 115, 'Barú'),
(116, 19, 116, 'Río Nuevo'),
(117, 19, 117, 'Páramo'),
(118, 19, 118, 'La Amistad'),
(119, 20, 119, 'San Pablo'),
(120, 20, 120, 'San Andrés'),
(121, 20, 121, 'Llano Bonito'),
(122, 20, 122, 'San Isidro'),
(123, 20, 123, 'Santa Cruz'),
(124, 20, 124, 'San Antonio'),
(125, 21, 1, 'Alajuela'),
(126, 21, 2, 'San José'),
(127, 21, 3, 'Carrizal'),
(128, 21, 4, 'San Antonio'),
(129, 21, 5, 'Guácima'),
(130, 21, 6, 'San Isidro'),
(131, 21, 7, 'Sabanilla'),
(132, 21, 8, 'San Rafael'),
(133, 21, 9, 'Río Segundo'),
(134, 21, 10, 'Desamparados'),
(135, 21, 11, 'Turrícares'),
(136, 21, 12, 'Tambor'),
(137, 21, 13, 'Garita'),
(138, 21, 14, 'Sarapiquí'),
(139, 22, 15, 'San Ramón'),
(140, 22, 16, 'Santiago'),
(141, 22, 17, 'San Juan'),
(142, 22, 18, 'Piedades Norte'),
(143, 22, 19, 'Piedades Sur'),
(144, 22, 20, 'San Rafael'),
(145, 22, 21, 'San Isidro'),
(146, 22, 22, 'Ángeles'),
(147, 22, 23, 'Alfaro'),
(148, 22, 24, 'Volio'),
(149, 22, 25, 'Concepción'),
(150, 22, 26, 'Zapotal'),
(151, 22, 27, 'Peñas Blancas'),
(152, 22, 28, 'San Lorenzo'),
(153, 23, 29, 'Grecia'),
(154, 23, 30, 'San Isidro'),
(155, 23, 31, 'San José'),
(156, 23, 32, 'San Roque'),
(157, 23, 33, 'Tacares'),
(158, 23, 34, 'Puente de Piedra'),
(159, 23, 35, 'Bolívar'),
(160, 24, 36, 'San Mateo'),
(161, 24, 37, 'Desmonte'),
(162, 24, 38, 'Jesús María'),
(163, 24, 39, 'Labrador'),
(164, 25, 40, 'Atenas'),
(165, 25, 41, 'Jesús'),
(166, 25, 42, 'Mercedes'),
(167, 25, 43, 'San Isidro'),
(168, 25, 44, 'Concepción'),
(169, 25, 45, 'San José'),
(170, 25, 46, 'Santa Eulalia'),
(171, 25, 47, 'Escobal'),
(172, 26, 48, 'Naranjo'),
(173, 26, 49, 'San Miguel'),
(174, 26, 50, 'San José'),
(175, 26, 51, 'Cirrí'),
(176, 26, 52, 'San Jerónimo'),
(177, 26, 53, 'San Juan'),
(178, 26, 54, 'El Rosario'),
(179, 26, 55, 'Palmitos'),
(180, 27, 56, 'Palmares'),
(181, 27, 57, 'Zaragoza'),
(182, 27, 58, 'Buenos Aires'),
(183, 27, 59, 'Santiago'),
(184, 27, 60, 'Candelaria'),
(185, 27, 61, 'Esquipulas'),
(186, 27, 62, 'La Granja'),
(187, 28, 63, 'San Pedro'),
(188, 28, 64, 'San Juan'),
(189, 28, 65, 'San Rafael'),
(190, 28, 66, 'Carrillos'),
(191, 28, 67, 'Sabana Redonda'),
(192, 29, 68, 'Orotina'),
(193, 29, 69, 'Mastate'),
(194, 29, 70, 'Hacienda Vieja'),
(195, 29, 71, 'Coyolar'),
(196, 29, 72, 'La Ceiba'),
(197, 30, 73, 'Quesada'),
(198, 30, 74, 'Florencia'),
(199, 30, 75, 'Buenavista'),
(200, 30, 76, 'Aguas Zarcas'),
(201, 30, 77, 'Venecia'),
(202, 30, 78, 'Pital'),
(203, 30, 79, 'La Fortuna'),
(204, 30, 80, 'La Tigra'),
(205, 30, 81, 'La Palmera'),
(206, 30, 82, 'Venado'),
(207, 30, 83, 'Cutris'),
(208, 30, 84, 'Monterrey'),
(209, 30, 85, 'Pocosol'),
(210, 31, 86, 'Zarcero'),
(211, 31, 87, 'Laguna'),
(212, 31, 88, 'Tapezco'),
(213, 31, 89, 'Guadalupe'),
(214, 31, 90, 'Palmira'),
(215, 31, 91, 'Zapote'),
(216, 31, 92, 'Brisas'),
(217, 32, 93, 'Sarchí Norte'),
(218, 32, 94, 'Sarchí Sur'),
(219, 32, 95, 'Toro Amarillo'),
(220, 32, 96, 'San Pedro'),
(221, 32, 97, 'Rodríguez'),
(222, 33, 98, 'Upala'),
(223, 33, 99, 'Aguas Claras'),
(224, 33, 100, 'San José'),
(225, 33, 101, 'Bijagua'),
(226, 33, 102, 'Delicias'),
(227, 33, 103, 'Dos Ríos'),
(228, 33, 104, 'Yolillal'),
(229, 33, 105, 'Canalete'),
(230, 34, 106, 'Los Chiles'),
(231, 34, 107, 'Caño Negro'),
(232, 34, 108, 'El Amparo'),
(233, 34, 109, 'San Jorge'),
(234, 35, 110, 'San Rafael'),
(235, 35, 111, 'Buena Vista'),
(236, 35, 112, 'Cote'),
(237, 35, 113, 'Katira'),
(238, 36, 114, 'Río Cuarto'),
(239, 37, 1, 'Oriental'),
(240, 37, 2, 'Occidental'),
(241, 37, 3, 'Carmen'),
(242, 37, 4, 'San Nicolás'),
(243, 37, 5, 'Aguacaliente (San Francisco)'),
(244, 37, 6, 'Guadalupe (Arenilla)'),
(245, 37, 7, 'Corralillo'),
(246, 37, 8, 'Tierra Blanca'),
(247, 37, 9, 'Dulce Nombre'),
(248, 37, 10, 'Llano Grande'),
(249, 37, 11, 'Quebradilla'),
(250, 38, 12, 'Paraíso'),
(251, 38, 13, 'Santiago de Paraíso'),
(252, 38, 14, 'Orosi'),
(253, 38, 15, 'Cachí'),
(254, 38, 16, 'Llanos de Santa Lucía'),
(255, 39, 17, 'Tres Ríos'),
(256, 39, 18, 'San Diego'),
(257, 39, 19, 'San Juan'),
(258, 39, 20, 'San Rafael'),
(259, 39, 21, 'Concepción'),
(260, 39, 22, 'Dulce Nombre'),
(261, 39, 23, 'San Ramón'),
(262, 39, 24, 'Río Azul'),
(263, 40, 25, 'Juan Viñas'),
(264, 40, 26, 'Tucurrique'),
(265, 40, 27, 'Pejibaye'),
(266, 41, 28, 'Turrialba'),
(267, 41, 29, 'La Suiza'),
(268, 41, 30, 'Peralta'),
(269, 41, 31, 'Santa cruz'),
(270, 41, 32, 'Santa Teresita'),
(271, 41, 33, 'Pavones'),
(272, 41, 34, 'Tuis'),
(273, 41, 35, 'Tayutic'),
(274, 41, 36, 'Santa Rosa'),
(275, 41, 37, 'Tres Equis'),
(276, 41, 38, 'La Isabel'),
(277, 41, 39, 'Chirripó'),
(278, 42, 40, 'Pacayas'),
(279, 42, 41, 'Cervantes'),
(280, 42, 42, 'Capellades'),
(281, 43, 43, 'San Rafael'),
(282, 43, 44, 'Cot'),
(283, 43, 45, 'Potrero Cerrado'),
(284, 43, 46, 'Cipreses'),
(285, 43, 47, 'Santa Rosa'),
(286, 44, 48, 'Tejar'),
(287, 44, 49, 'San Isidro'),
(288, 44, 50, 'Tobosi'),
(289, 44, 51, 'Patio de Agua'),
(290, 45, 1, 'Heredia'),
(291, 45, 2, 'Mercedes'),
(292, 45, 3, 'San Francisco'),
(293, 45, 4, 'Ulloa'),
(294, 45, 5, 'Vara Blanca'),
(295, 46, 6, 'Barva'),
(296, 46, 7, 'San Pedro'),
(297, 46, 8, 'San Pablo'),
(298, 46, 9, 'San Roque'),
(299, 46, 10, 'Santa Lucía'),
(300, 46, 11, 'San José de la Montaña'),
(301, 47, 12, 'Santo Domingo'),
(302, 47, 13, 'San Vicente'),
(303, 47, 14, 'San Miguel'),
(304, 47, 15, 'Paracito'),
(305, 47, 16, 'Santo Tomás'),
(306, 47, 17, 'Santa Rosa'),
(307, 47, 18, 'Tures'),
(308, 47, 19, 'Pará'),
(309, 48, 20, 'Santa Bárbara'),
(310, 48, 21, 'San Pedro'),
(311, 48, 22, 'San Juan'),
(312, 48, 23, 'Jesús'),
(313, 48, 24, 'Santo Domingo'),
(314, 48, 25, 'Purabá'),
(315, 49, 26, 'San Rafael'),
(316, 49, 27, 'San Josecito'),
(317, 49, 28, 'Santiago'),
(318, 49, 29, 'Ángeles'),
(319, 49, 30, 'Concepción'),
(320, 50, 31, 'San Isidro'),
(321, 50, 32, 'San José'),
(322, 50, 33, 'Concepción'),
(323, 50, 34, 'San Francisco'),
(324, 51, 35, 'San Antonio'),
(325, 51, 36, 'La Ribera'),
(326, 51, 37, 'La Asunción'),
(327, 52, 38, 'San Joaquín'),
(328, 52, 39, 'Barrantes'),
(329, 52, 40, 'Llorente'),
(330, 53, 41, 'San Pablo'),
(331, 53, 42, 'Rincón de Sabanilla'),
(332, 54, 43, 'Puerto Viejo'),
(333, 54, 44, 'La Virgen'),
(334, 54, 45, 'Horquetas'),
(335, 54, 46, 'Llanuras del Gaspar'),
(336, 54, 47, 'Cureña'),
(337, 55, 1, 'Liberia'),
(338, 55, 2, 'Cañas Dulces'),
(339, 55, 3, 'Mayorga'),
(340, 55, 4, 'Nacascolo'),
(341, 55, 5, 'Curubandé'),
(342, 56, 6, 'Nicoya'),
(343, 56, 7, 'Mansión'),
(344, 56, 8, 'San Antonio'),
(345, 56, 9, 'Quebrada Honda'),
(346, 56, 10, 'Sámara'),
(347, 56, 11, 'Nosara'),
(348, 56, 12, 'Belén de Nosarita'),
(349, 57, 13, 'Santa Cruz'),
(350, 57, 14, 'Bolsón'),
(351, 57, 15, 'Veintisiete de Abril'),
(352, 57, 16, 'Tempate'),
(353, 57, 17, 'Cartagena'),
(354, 57, 18, 'Cuajiniquil'),
(355, 57, 19, 'Diriá'),
(356, 57, 20, 'Cabo Velas'),
(357, 57, 21, 'Tamarindo'),
(358, 58, 22, 'Bagaces'),
(359, 58, 23, 'La Fortuna'),
(360, 58, 24, 'Mogote'),
(361, 58, 25, 'Río Naranjo'),
(362, 59, 26, 'Filadelfia'),
(363, 59, 27, 'Palmira'),
(364, 59, 28, 'Sardinal'),
(365, 59, 29, 'Belén'),
(366, 60, 30, 'Cañas'),
(367, 60, 31, 'Palmira'),
(368, 60, 32, 'San Miguel'),
(369, 60, 33, 'Bebedero'),
(370, 60, 34, 'Porozal'),
(371, 61, 35, 'Las Juntas'),
(372, 61, 36, 'Sierra'),
(373, 61, 37, 'San Juan'),
(374, 61, 38, 'Colorado'),
(375, 62, 39, 'Tilarán'),
(376, 62, 40, 'Quebrada Grande'),
(377, 62, 41, 'Tronadora'),
(378, 62, 42, 'Santa Rosa'),
(379, 62, 43, 'Líbano'),
(380, 62, 44, 'Tierras Morenas'),
(381, 62, 45, 'Arenal'),
(382, 63, 46, 'Carmona'),
(383, 63, 47, 'Santa Rita'),
(384, 63, 48, 'Zapotal'),
(385, 63, 49, 'San Pablo'),
(386, 63, 50, 'Porvenir'),
(387, 63, 51, 'Bejuco'),
(388, 64, 52, 'La Cruz'),
(389, 64, 53, 'Santa Cecilia'),
(390, 64, 54, 'La Garita'),
(391, 64, 55, 'Santa Elena'),
(392, 65, 56, 'Hojancha'),
(393, 65, 57, 'Monte Romo'),
(394, 65, 58, 'Puerto Carrillo'),
(395, 65, 59, 'Huacas'),
(396, 65, 60, 'Matambú'),
(397, 66, 1, 'Puntarenas'),
(398, 66, 2, 'Pitahaya'),
(399, 66, 3, 'Chomes'),
(400, 66, 4, 'Lepanto'),
(401, 66, 5, 'Paquera'),
(402, 66, 6, 'Manzanillo'),
(403, 66, 7, 'Guacimal'),
(404, 66, 8, 'Barranca'),
(405, 66, 9, 'Monte Verde'),
(406, 66, 10, 'Isla del Coco'),
(407, 66, 11, 'Cóbano'),
(408, 66, 12, 'Chacarita'),
(409, 66, 13, 'Chira'),
(410, 66, 14, 'Acapulco'),
(411, 66, 15, 'El Roble'),
(412, 66, 16, 'Arancibia'),
(413, 67, 17, 'Espíritu Santo'),
(414, 67, 18, 'San Juan Grande'),
(415, 67, 19, 'Macacona'),
(416, 67, 20, 'San Rafael'),
(417, 67, 21, 'San Jerónimo'),
(418, 67, 22, 'Caldera'),
(419, 68, 23, 'Buenos Aires'),
(420, 68, 24, 'Volcán'),
(421, 68, 25, 'Potrero Grande'),
(422, 68, 26, 'Boruca'),
(423, 68, 27, 'Pilas'),
(424, 68, 28, 'Colinas'),
(425, 68, 29, 'Chánguena'),
(426, 68, 30, 'Biolley'),
(427, 68, 31, 'Brunka'),
(428, 69, 32, 'Miramar'),
(429, 69, 33, 'La Unión'),
(430, 69, 34, 'San Isidro'),
(431, 70, 35, 'Cortés'),
(432, 70, 36, 'Palmar'),
(433, 70, 37, 'Sierpe'),
(434, 70, 38, 'Bahía Ballena'),
(435, 70, 39, 'Piedras Blancas'),
(436, 70, 40, 'Bahía Drake'),
(437, 71, 41, 'Quepos'),
(438, 71, 42, 'Savegre'),
(439, 71, 43, 'Naranjito'),
(440, 72, 44, 'Golfito'),
(441, 72, 45, 'Puerto Jiménez'),
(442, 72, 46, 'Guaycará'),
(443, 72, 47, 'Pavón'),
(444, 73, 48, 'San Vito'),
(445, 73, 49, 'Sabalito'),
(446, 73, 50, 'Aguabuena'),
(447, 73, 51, 'Limoncito'),
(448, 73, 52, 'Pittier'),
(449, 73, 53, 'Gutiérrez Brown'),
(450, 74, 54, 'Parrita'),
(451, 75, 55, 'Corredor'),
(452, 75, 56, 'La Cuesta'),
(453, 75, 57, 'Paso Canoas'),
(454, 75, 58, 'Laurel'),
(455, 76, 59, 'Jacó'),
(456, 76, 60, 'Tárcoles'),
(457, 77, 1, 'Limón'),
(458, 77, 2, 'Valle la Estrella'),
(459, 77, 3, 'Río Blanco'),
(460, 77, 4, 'Matama'),
(461, 78, 5, 'Guápiles'),
(462, 78, 6, 'Jiménez'),
(463, 78, 7, 'La Rita'),
(464, 78, 8, 'Roxana'),
(465, 78, 9, 'Cariari'),
(466, 78, 10, 'Colorado'),
(467, 78, 11, 'La Colonia'),
(468, 79, 12, 'Siquirres'),
(469, 79, 13, 'Pacuarito'),
(470, 79, 14, 'Florida'),
(471, 79, 15, 'Germania'),
(472, 79, 16, 'Cairo'),
(473, 79, 17, 'Alegría'),
(474, 80, 18, 'Bratsi'),
(475, 80, 19, 'Sixaola'),
(476, 80, 20, 'Cahuita'),
(477, 80, 21, 'Telire'),
(478, 81, 22, 'Matina'),
(479, 81, 23, 'Batan'),
(480, 81, 24, 'Carrandi'),
(481, 82, 25, 'Guácimo'),
(482, 82, 26, 'Mercedes'),
(483, 82, 27, 'Pocora'),
(484, 82, 28, 'Río Jiménez'),
(485, 82, 29, 'Duacarí');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `moneda`
--

CREATE TABLE `moneda` (
  `moneda_id` int(11) NOT NULL,
  `moneda` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `simbolo` varchar(6) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `moneda`
--

INSERT INTO `moneda` (`moneda_id`, `moneda`, `simbolo`) VALUES
(1, 'Dolar (USD)', '$'),
(2, 'Colón (CRC)', '₡');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `proveedor_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `nombre_proveedor` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cedula_proveedor` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `estado_proveedor` int(11) NOT NULL COMMENT '0 para inactivo, 1 para activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_correo`
--

CREATE TABLE `proveedor_correo` (
  `proveedor_correo_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `correo_proveedor` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_telefono`
--

CREATE TABLE `proveedor_telefono` (
  `proveedor_telefono_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `telefono_proveedor` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `provincia_id` int(11) NOT NULL,
  `provincia` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`provincia_id`, `provincia`) VALUES
(1, 'San José'),
(2, 'Alajuela'),
(3, 'Cartago'),
(4, 'Heredia'),
(5, 'Guanacaste'),
(6, 'Puntarenas'),
(7, 'Limón');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `proyecto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `jefe_proyecto_id` int(11) NOT NULL COMMENT 'Jefe de Proyecto',
  `proyecto_estado_id` int(11) NOT NULL,
  `distrito_id` int(11) NOT NULL,
  `moneda_id` int(11) NOT NULL,
  `nombre_proyecto` varchar(400) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_firma_contrato` date DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_entrega_estimada` date DEFAULT NULL,
  `numero_contrato` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `orden_compra` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `direccion_exacta` text COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_colaborador`
--

CREATE TABLE `proyecto_colaborador` (
  `proyecto_colaborador_id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `colaborador_id` int(11) NOT NULL,
  `tipo_relacion` int(2) NOT NULL COMMENT '1 = Jefe de proyecto, 2 = colaborador',
  `fecha_registro` datetime NOT NULL,
  `estado_registro` int(2) NOT NULL COMMENT '0 = inactivo, 1 = activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_estado`
--

CREATE TABLE `proyecto_estado` (
  `proyecto_estado_id` int(11) NOT NULL,
  `proyecto_estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_gasto`
--

CREATE TABLE `proyecto_gasto` (
  `proyecto_gasto_id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `proyecto_gasto_tipo_id` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `fecha_gasto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_gasto_detalle`
--

CREATE TABLE `proyecto_gasto_detalle` (
  `proyecto_gasto_detalle_id` int(11) NOT NULL,
  `proyecto_gasto_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `proyecto_gasto_estado_id` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_gasto_estado`
--

CREATE TABLE `proyecto_gasto_estado` (
  `proyecto_gasto_estado_id` int(11) NOT NULL,
  `proyecto_gasto_estado` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_gasto_mano_obra`
--

CREATE TABLE `proyecto_gasto_mano_obra` (
  `proyecto_gasto_mano_obra_id` int(11) NOT NULL,
  `proyecto_gasto_id` int(11) NOT NULL,
  `proyecto_colaborador_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `cantidad_horas` float(6,2) NOT NULL,
  `costo_hora_mano_obra` float(10,2) NOT NULL,
  `estado_registro` int(2) NOT NULL COMMENT '0 = inactivo, 1 = activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_gasto_monto`
--

CREATE TABLE `proyecto_gasto_monto` (
  `proyecto_gasto_monto_id` int(11) NOT NULL,
  `proyecto_gasto_id` int(11) NOT NULL,
  `moneda_id` int(11) NOT NULL,
  `proyecto_gasto_monto` float(20,2) NOT NULL,
  `estado_registro` int(11) NOT NULL COMMENT '0 = inactivo, 1 = activo',
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_gasto_tipo`
--

CREATE TABLE `proyecto_gasto_tipo` (
  `proyecto_gasto_tipo_id` int(11) NOT NULL,
  `proyecto_gasto_tipo` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_tipo_cambio`
--

CREATE TABLE `proyecto_tipo_cambio` (
  `proyecto_tipo_cambio_id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `moneda_base_id` int(11) NOT NULL,
  `moneda_destino_id` int(11) NOT NULL,
  `valor_compra` float(10,2) NOT NULL,
  `valor_venta` float(10,2) NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_valor_oferta`
--

CREATE TABLE `proyecto_valor_oferta` (
  `proyecto_valor_oferta_id` int(11) NOT NULL,
  `proyecto_valor_oferta_tipo_id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `moneda_id` int(11) NOT NULL,
  `valor_oferta` float(20,2) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado_registro` int(1) NOT NULL COMMENT '0 = inactivo, 1 = activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_valor_oferta_extension_detalle`
--

CREATE TABLE `proyecto_valor_oferta_extension_detalle` (
  `proyecto_valor_oferta_extension_detalle_id` int(11) NOT NULL,
  `proyecto_valor_oferta_id` int(11) NOT NULL,
  `proyecto_valor_oferta_extension_tipo_id` int(11) NOT NULL,
  `proyecto_valor_oferta_extension_descripcion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_valor_oferta_extension_tipo`
--

CREATE TABLE `proyecto_valor_oferta_extension_tipo` (
  `proyecto_valor_oferta_extension_tipo_id` int(11) NOT NULL,
  `proyecto_valor_oferta_extension_tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado_registro` int(11) NOT NULL COMMENT '0 = Inactivo, 1 = activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_valor_oferta_tipo`
--

CREATE TABLE `proyecto_valor_oferta_tipo` (
  `proyecto_valor_oferta_tipo_id` int(11) NOT NULL,
  `proyecto_valor_oferta_tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `usuario_id` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `rol_id` int(11) NOT NULL,
  `estado_id` int(11) NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` char(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `fecha_registro`, `rol_id`, `estado_id`, `usuario`, `password`) VALUES
(1, '2017-12-01 06:19:38', 1, 1, 'instatec_admin', '$2y$10$UDJh9W7b0YR5.yNPEmNyLO6j8ZSN.f/7WXt136JrAEumTXbVfbdQC'),
(2, '2017-12-01 06:21:48', 1, 1, 'keylormg', '$2y$10$H/zVeP80TCO1oY1Qo6ZzbOMUUphGPyCdVDD43IZFaQ24dISqo5s9y');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_bitacora_cambios`
--

CREATE TABLE `usuario_bitacora_cambios` (
  `usuario_bitacora_cambio_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_cambio` datetime NOT NULL,
  `tipo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `tabla` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `id_fila` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_bitacora_ingreso`
--

CREATE TABLE `usuario_bitacora_ingreso` (
  `usuario_bitacora_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha_ingreso` datetime NOT NULL,
  `ip` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `agente_usuario` varchar(300) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_colaborador`
--

CREATE TABLE `usuario_colaborador` (
  `usuario_colaborador_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `colaborador_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_detalle`
--

CREATE TABLE `usuario_detalle` (
  `usuario_detalle_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `usuario_detalle`
--

INSERT INTO `usuario_detalle` (`usuario_detalle_id`, `usuario_id`, `nombre`, `apellidos`, `correo`) VALUES
(1, 1, 'Arlen', 'Loaiza', 'info@instateccr.com'),
(2, 2, 'Keylor', 'Mora', 'khmg13@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_estado`
--

CREATE TABLE `usuario_estado` (
  `estado_id` int(11) NOT NULL,
  `estado` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_estado`
--

INSERT INTO `usuario_estado` (`estado_id`, `estado`) VALUES
(1, 'activo'),
(2, 'inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `rol_id` int(11) NOT NULL,
  `rol` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`rol_id`, `rol`) VALUES
(1, 'administrador'),
(2, 'asistente'),
(3, 'jefe_proyecto'),
(4, 'colaborador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol_permiso`
--

CREATE TABLE `usuario_rol_permiso` (
  `usuario_rol_permiso_id` int(11) NOT NULL,
  `usuario_rol_id` int(11) NOT NULL,
  `modulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `funcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado_permiso` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_rol_permiso`
--

INSERT INTO `usuario_rol_permiso` (`usuario_rol_permiso_id`, `usuario_rol_id`, `modulo`, `funcion`, `estado_permiso`) VALUES
(1, 1, 'proyecto', 'create', 1),
(2, 1, 'proyecto', 'view', 1),
(3, 1, 'proyecto', 'edit', 1),
(4, 1, 'proyecto', 'delete', 1),
(5, 1, 'proyecto', 'list', 1),
(6, 1, 'cliente', 'create', 1),
(7, 1, 'cliente', 'view', 1),
(8, 1, 'cliente', 'edit', 1),
(9, 1, 'cliente', 'delete', 1),
(10, 1, 'cliente', 'list', 1),
(11, 1, 'proveedor', 'create', 1),
(12, 1, 'proveedor', 'view', 1),
(13, 1, 'proveedor', 'edit', 1),
(14, 1, 'proveedor', 'delete', 1),
(15, 1, 'proveedor', 'list', 1),
(16, 1, 'proyecto_extensiones', 'create', 1),
(17, 1, 'proyecto_extensiones', 'view', 1),
(18, 1, 'proyecto_extensiones', 'edit', 1),
(19, 1, 'proyecto_extensiones', 'list', 1),
(20, 1, 'proyecto_extensiones', 'delete', 1),
(21, 1, 'proyecto_gastos', 'create', 1),
(22, 1, 'proyecto_gastos', 'view', 1),
(23, 1, 'proyecto_gastos', 'edit', 1),
(24, 1, 'proyecto_gastos', 'delete', 1),
(25, 1, 'proyecto_gastos', 'list', 1),
(26, 1, 'reporte', 'list', 1),
(27, 1, 'reporte_proyecto_especifico', 'view', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `canton`
--
ALTER TABLE `canton`
  ADD PRIMARY KEY (`canton_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `cliente_correo`
--
ALTER TABLE `cliente_correo`
  ADD PRIMARY KEY (`cliente_correo_id`);

--
-- Indices de la tabla `cliente_telefono`
--
ALTER TABLE `cliente_telefono`
  ADD PRIMARY KEY (`cliente_telefono_id`);

--
-- Indices de la tabla `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`colaborador_id`);

--
-- Indices de la tabla `colaborador_costo_hora`
--
ALTER TABLE `colaborador_costo_hora`
  ADD PRIMARY KEY (`colaborador_costo_hora_id`);

--
-- Indices de la tabla `colaborador_puesto`
--
ALTER TABLE `colaborador_puesto`
  ADD PRIMARY KEY (`colaborador_puesto_id`);

--
-- Indices de la tabla `distrito`
--
ALTER TABLE `distrito`
  ADD PRIMARY KEY (`distrito_id`);

--
-- Indices de la tabla `moneda`
--
ALTER TABLE `moneda`
  ADD PRIMARY KEY (`moneda_id`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`proveedor_id`);

--
-- Indices de la tabla `proveedor_correo`
--
ALTER TABLE `proveedor_correo`
  ADD PRIMARY KEY (`proveedor_correo_id`);

--
-- Indices de la tabla `proveedor_telefono`
--
ALTER TABLE `proveedor_telefono`
  ADD PRIMARY KEY (`proveedor_telefono_id`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`provincia_id`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`proyecto_id`);

--
-- Indices de la tabla `proyecto_colaborador`
--
ALTER TABLE `proyecto_colaborador`
  ADD PRIMARY KEY (`proyecto_colaborador_id`);

--
-- Indices de la tabla `proyecto_estado`
--
ALTER TABLE `proyecto_estado`
  ADD PRIMARY KEY (`proyecto_estado_id`);

--
-- Indices de la tabla `proyecto_gasto`
--
ALTER TABLE `proyecto_gasto`
  ADD PRIMARY KEY (`proyecto_gasto_id`);

--
-- Indices de la tabla `proyecto_gasto_detalle`
--
ALTER TABLE `proyecto_gasto_detalle`
  ADD PRIMARY KEY (`proyecto_gasto_detalle_id`);

--
-- Indices de la tabla `proyecto_gasto_estado`
--
ALTER TABLE `proyecto_gasto_estado`
  ADD PRIMARY KEY (`proyecto_gasto_estado_id`);

--
-- Indices de la tabla `proyecto_gasto_mano_obra`
--
ALTER TABLE `proyecto_gasto_mano_obra`
  ADD PRIMARY KEY (`proyecto_gasto_mano_obra_id`);

--
-- Indices de la tabla `proyecto_gasto_monto`
--
ALTER TABLE `proyecto_gasto_monto`
  ADD PRIMARY KEY (`proyecto_gasto_monto_id`);

--
-- Indices de la tabla `proyecto_gasto_tipo`
--
ALTER TABLE `proyecto_gasto_tipo`
  ADD PRIMARY KEY (`proyecto_gasto_tipo_id`);

--
-- Indices de la tabla `proyecto_tipo_cambio`
--
ALTER TABLE `proyecto_tipo_cambio`
  ADD PRIMARY KEY (`proyecto_tipo_cambio_id`);

--
-- Indices de la tabla `proyecto_valor_oferta`
--
ALTER TABLE `proyecto_valor_oferta`
  ADD PRIMARY KEY (`proyecto_valor_oferta_id`);

--
-- Indices de la tabla `proyecto_valor_oferta_extension_detalle`
--
ALTER TABLE `proyecto_valor_oferta_extension_detalle`
  ADD PRIMARY KEY (`proyecto_valor_oferta_extension_detalle_id`);

--
-- Indices de la tabla `proyecto_valor_oferta_extension_tipo`
--
ALTER TABLE `proyecto_valor_oferta_extension_tipo`
  ADD PRIMARY KEY (`proyecto_valor_oferta_extension_tipo_id`);

--
-- Indices de la tabla `proyecto_valor_oferta_tipo`
--
ALTER TABLE `proyecto_valor_oferta_tipo`
  ADD PRIMARY KEY (`proyecto_valor_oferta_tipo_id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`usuario_id`);

--
-- Indices de la tabla `usuario_bitacora_cambios`
--
ALTER TABLE `usuario_bitacora_cambios`
  ADD PRIMARY KEY (`usuario_bitacora_cambio_id`);

--
-- Indices de la tabla `usuario_bitacora_ingreso`
--
ALTER TABLE `usuario_bitacora_ingreso`
  ADD PRIMARY KEY (`usuario_bitacora_id`);

--
-- Indices de la tabla `usuario_colaborador`
--
ALTER TABLE `usuario_colaborador`
  ADD PRIMARY KEY (`usuario_colaborador_id`);

--
-- Indices de la tabla `usuario_detalle`
--
ALTER TABLE `usuario_detalle`
  ADD PRIMARY KEY (`usuario_detalle_id`);

--
-- Indices de la tabla `usuario_estado`
--
ALTER TABLE `usuario_estado`
  ADD PRIMARY KEY (`estado_id`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `usuario_rol_permiso`
--
ALTER TABLE `usuario_rol_permiso`
  ADD PRIMARY KEY (`usuario_rol_permiso_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `canton`
--
ALTER TABLE `canton`
  MODIFY `canton_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `cliente_correo`
--
ALTER TABLE `cliente_correo`
  MODIFY `cliente_correo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `cliente_telefono`
--
ALTER TABLE `cliente_telefono`
  MODIFY `cliente_telefono_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `colaborador`
--
ALTER TABLE `colaborador`
  MODIFY `colaborador_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `colaborador_costo_hora`
--
ALTER TABLE `colaborador_costo_hora`
  MODIFY `colaborador_costo_hora_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `colaborador_puesto`
--
ALTER TABLE `colaborador_puesto`
  MODIFY `colaborador_puesto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `distrito`
--
ALTER TABLE `distrito`
  MODIFY `distrito_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=486;
--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `moneda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `proveedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proveedor_correo`
--
ALTER TABLE `proveedor_correo`
  MODIFY `proveedor_correo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `proveedor_telefono`
--
ALTER TABLE `proveedor_telefono`
  MODIFY `proveedor_telefono_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `provincia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `proyecto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `proyecto_colaborador`
--
ALTER TABLE `proyecto_colaborador`
  MODIFY `proyecto_colaborador_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proyecto_estado`
--
ALTER TABLE `proyecto_estado`
  MODIFY `proyecto_estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto`
--
ALTER TABLE `proyecto_gasto`
  MODIFY `proyecto_gasto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto_detalle`
--
ALTER TABLE `proyecto_gasto_detalle`
  MODIFY `proyecto_gasto_detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto_estado`
--
ALTER TABLE `proyecto_gasto_estado`
  MODIFY `proyecto_gasto_estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto_mano_obra`
--
ALTER TABLE `proyecto_gasto_mano_obra`
  MODIFY `proyecto_gasto_mano_obra_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto_monto`
--
ALTER TABLE `proyecto_gasto_monto`
  MODIFY `proyecto_gasto_monto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto_tipo`
--
ALTER TABLE `proyecto_gasto_tipo`
  MODIFY `proyecto_gasto_tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proyecto_tipo_cambio`
--
ALTER TABLE `proyecto_tipo_cambio`
  MODIFY `proyecto_tipo_cambio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `proyecto_valor_oferta`
--
ALTER TABLE `proyecto_valor_oferta`
  MODIFY `proyecto_valor_oferta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT de la tabla `proyecto_valor_oferta_extension_detalle`
--
ALTER TABLE `proyecto_valor_oferta_extension_detalle`
  MODIFY `proyecto_valor_oferta_extension_detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `proyecto_valor_oferta_extension_tipo`
--
ALTER TABLE `proyecto_valor_oferta_extension_tipo`
  MODIFY `proyecto_valor_oferta_extension_tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `proyecto_valor_oferta_tipo`
--
ALTER TABLE `proyecto_valor_oferta_tipo`
  MODIFY `proyecto_valor_oferta_tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario_bitacora_cambios`
--
ALTER TABLE `usuario_bitacora_cambios`
  MODIFY `usuario_bitacora_cambio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT de la tabla `usuario_bitacora_ingreso`
--
ALTER TABLE `usuario_bitacora_ingreso`
  MODIFY `usuario_bitacora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `usuario_colaborador`
--
ALTER TABLE `usuario_colaborador`
  MODIFY `usuario_colaborador_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario_detalle`
--
ALTER TABLE `usuario_detalle`
  MODIFY `usuario_detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario_estado`
--
ALTER TABLE `usuario_estado`
  MODIFY `estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `usuario_rol_permiso`
--
ALTER TABLE `usuario_rol_permiso`
  MODIFY `usuario_rol_permiso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
