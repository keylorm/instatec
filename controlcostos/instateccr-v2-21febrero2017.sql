-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2018 a las 07:23:07
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

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `usuario_id`, `fecha_registro`, `nombre_cliente`, `cedula_cliente`, `estado_cliente`) VALUES
(1, 1, '2017-12-07 07:33:46', 'Cliente 1', '123456890', 1),
(2, 1, '2017-12-07 07:33:59', 'Cliente 2', '321654987', 0),
(3, 1, '2017-12-07 07:34:33', 'Cliente 3', '987654321', 1),
(4, 1, '2017-12-07 07:34:54', 'Cliente 4', '654987312', 1),
(5, 1, '2017-12-09 03:18:47', 'Cliente 5', '65498761654', 1),
(6, 1, '2017-12-09 08:24:07', 'Cliente 6', '23432', 0),
(7, 1, '2017-12-09 08:24:12', 'Cliente 7', '', 1),
(8, 1, '2017-12-09 08:24:17', 'Cliente 8', '', 1),
(9, 1, '2017-12-09 08:24:25', 'Cliente 9', '', 0),
(10, 1, '2017-12-09 08:24:31', 'Cliente 10', '', 1),
(11, 1, '2017-12-09 08:24:36', 'Cliente 11', '', 1),
(12, 1, '2017-12-09 08:24:42', 'Cliente 12', '', 0),
(13, 1, '2017-12-17 06:02:59', 'Cliente 13', '568798654', 1),
(14, 1, '2017-12-29 00:58:24', 'Cliente 14', '65465461', 1),
(15, 1, '2018-01-12 03:30:09', 'Proycon', '921929992', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_correo`
--

CREATE TABLE `cliente_correo` (
  `cliente_correo_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `correo_cliente` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente_correo`
--

INSERT INTO `cliente_correo` (`cliente_correo_id`, `cliente_id`, `correo_cliente`) VALUES
(1, 2, 'keylor@orbelink.com'),
(4, 5, 'prueba@cliente.com'),
(11, 3, 'khmg13@gmail.com'),
(12, 3, 'khmg13@hotmail.es'),
(13, 4, 'cliente4@cliente.net'),
(16, 1, 'cliente1@cliente.com'),
(17, 1, 'cliente3@cliente.com'),
(18, 13, 'cliente13@gmail.com'),
(19, 13, 'cliente13@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_telefono`
--

CREATE TABLE `cliente_telefono` (
  `cliente_telefono_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `telefono_cliente` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente_telefono`
--

INSERT INTO `cliente_telefono` (`cliente_telefono_id`, `cliente_id`, `telefono_cliente`) VALUES
(4, 5, '3054369224'),
(9, 3, '22345360'),
(10, 3, '22539150'),
(11, 4, '69325841'),
(12, 4, '95658788'),
(15, 1, '1654616984'),
(16, 1, '2222222223'),
(17, 13, '88888888'),
(18, 13, '99999999');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador`
--

CREATE TABLE `colaborador` (
  `colaborador_id` int(11) NOT NULL,
  `colaborador_puesto_id` int(11) NOT NULL,
  `estado` int(11) NOT NULL COMMENT '1 = activo, 0 = inactivo',
  `fecha_registro` datetime NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo_electronico` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cedula` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `seguro_social` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `identificador_interno` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `estado_row` int(11) NOT NULL COMMENT 'Para marcar cuando se elimina un registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `colaborador`
--

INSERT INTO `colaborador` (`colaborador_id`, `colaborador_puesto_id`, `estado`, `fecha_registro`, `nombre`, `apellidos`, `correo_electronico`, `cedula`, `seguro_social`, `identificador_interno`, `telefono`, `estado_row`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', 'Fabiola', 'Chaves', 'fabiola@instateccr.com', '', '', '', '', 1),
(2, 1, 1, '0000-00-00 00:00:00', 'Asistente', 'Instatec', 'asistente1@instateccr.com', '', '', '', '', 0),
(3, 1, 1, '0000-00-00 00:00:00', 'Asistente 2', 'Instatec', 'asistente2@instateccr.com', '', '', '', '', 0),
(4, 1, 1, '0000-00-00 00:00:00', 'Asistente 3', 'Instatec', 'asistente34@instateccr.com', '', '', '', '', 0),
(5, 1, 1, '0000-00-00 00:00:00', 'Keylor Humberto', 'Mora Garro', 'keylor@orbelink.com', '', '', '', '', 0),
(6, 2, 1, '2018-02-06 06:08:30', 'Carlos', 'Mora', 'carlos@instateccr.com', '302550556', '75345345', '10', '6516516', 1),
(7, 3, 1, '2018-02-06 06:10:21', 'Rosa', 'Mora', 'rosa@instateccr.com', '265498465', '546546', '23', '6516516', 1),
(10, 1, 1, '2018-02-06 06:45:59', 'Yerson', 'Mora', 'yerson@instateccr.com', '651651651', '45345', '45', '5465484', 0),
(11, 1, 1, '2018-02-06 07:06:40', 'Milady', 'Garro', 'milady@instateccr.com', '5465498', '2131654', '32', '561321654', 0),
(12, 1, 1, '2018-02-07 07:43:17', 'Milady', 'Garro', 'milady@instateccr.com', '329515', '2126', '3656', '6546516', 0),
(13, 1, 1, '2018-02-07 07:48:17', 'Milady', 'Garro', 'milady@instateccr.com', '', '', '', '', 0),
(14, 1, 1, '2018-02-10 18:53:07', 'Meilyn', 'Garro', 'mgarro@instateccr.com', '151616556', '65165', '15', '', 1),
(15, 3, 1, '2018-02-12 02:03:30', 'David', 'Araya', 'david@correo.com', '8979849', '15351654', '564988498', '6549848', 1),
(16, 2, 1, '2018-02-12 02:09:21', 'David', 'Araya', 'david@correo.com', '645456', '123', '125', '65465467', 1),
(17, 1, 1, '2018-02-13 06:51:11', 'Luis', 'Vargas', 'luis.vargas@instatec.com', '64651659', '45615651', '2156', '51651659', 1),
(18, 1, 1, '2018-02-16 20:30:53', 'Jose', 'Campos', 'josec@instatec.com', '15616516', '123165496', '123', '1565648979', 1),
(19, 2, 1, '2018-02-16 20:35:16', 'Pablo ', 'Perez', 'pablo@instatec.com', '4654689', '5987654', '5566', '65468974', 1);

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

--
-- Volcado de datos para la tabla `colaborador_costo_hora`
--

INSERT INTO `colaborador_costo_hora` (`colaborador_costo_hora_id`, `colaborador_id`, `moneda_id`, `fecha_registro`, `costo_hora`, `estado_costo`) VALUES
(1, 6, 0, '2018-02-06 06:08:30', 1.00, 0),
(2, 7, 0, '2018-02-06 06:10:21', 800.00, 1),
(5, 10, 0, '2018-02-06 06:45:59', 2500.00, 1),
(6, 11, 0, '2018-02-06 07:06:40', 2800.00, 1),
(7, 12, 0, '2018-02-07 07:43:17', 2000.00, 1),
(8, 15, 0, '2018-02-12 02:03:30', 1500.00, 0),
(9, 15, 0, '2018-02-12 02:05:59', 1500.00, 0),
(10, 15, 0, '2018-02-12 02:07:35', 1500.00, 0),
(11, 15, 0, '2018-02-12 02:07:40', 1500.00, 0),
(12, 16, 0, '2018-02-12 02:09:21', 1500.00, 0),
(13, 16, 0, '2018-02-12 02:11:17', 1500.00, 0),
(14, 16, 0, '2018-02-12 02:12:38', 1500.00, 0),
(15, 16, 0, '2018-02-12 02:13:24', 1500.00, 0),
(16, 16, 0, '2018-02-12 02:13:27', 1500.00, 0),
(17, 16, 2, '2018-02-12 02:19:20', 1500.00, 0),
(18, 15, 2, '2018-02-13 06:49:26', 1500.00, 1),
(19, 17, 2, '2018-02-13 06:51:11', 2500.00, 1),
(20, 16, 2, '2018-02-16 00:53:04', 1.00, 0),
(21, 16, 2, '2018-02-16 00:53:25', 1.00, 0),
(22, 16, 2, '2018-02-16 00:56:11', 1750.00, 1),
(23, 6, 2, '2018-02-16 12:23:40', 1000.00, 1),
(24, 14, 2, '2018-02-16 12:39:33', 2500.00, 1),
(25, 18, 2, '2018-02-16 20:33:43', 2000.00, 1),
(26, 19, 2, '2018-02-16 20:35:16', 1200.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador_puesto`
--

CREATE TABLE `colaborador_puesto` (
  `colaborador_puesto_id` int(11) NOT NULL,
  `puesto` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `colaborador_puesto`
--

INSERT INTO `colaborador_puesto` (`colaborador_puesto_id`, `puesto`) VALUES
(1, 'Jefe de proyecto'),
(2, 'Operario'),
(3, 'Operante');

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

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`proveedor_id`, `usuario_id`, `fecha_registro`, `nombre_proveedor`, `cedula_proveedor`, `estado_proveedor`) VALUES
(1, 1, '2017-12-07 07:42:18', 'Ferreteria 1', '933366696-2-3', 1),
(2, 1, '2017-12-11 07:03:30', 'Ferreteria 2', '65498998', 1),
(3, 1, '2017-12-11 07:04:09', 'Proveedor 3', '89798798', 1),
(4, 1, '2017-12-17 06:03:47', 'Ferreteria 4', '6565989', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_correo`
--

CREATE TABLE `proveedor_correo` (
  `proveedor_correo_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `correo_proveedor` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor_correo`
--

INSERT INTO `proveedor_correo` (`proveedor_correo_id`, `proveedor_id`, `correo_proveedor`) VALUES
(8, 2, 'ferreteria2@proveedor.com'),
(13, 1, 'proveedor1@gmail.com'),
(14, 1, 'proveedor2@gmail.com'),
(15, 3, 'proveedor3@ferreteria.com'),
(16, 3, 'proveedor3@proveedor.com'),
(17, 4, 'ferreteria4@proveedor.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor_telefono`
--

CREATE TABLE `proveedor_telefono` (
  `proveedor_telefono_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `telefono_proveedor` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proveedor_telefono`
--

INSERT INTO `proveedor_telefono` (`proveedor_telefono_id`, `proveedor_id`, `telefono_proveedor`) VALUES
(14, 1, '54878877'),
(15, 1, '22336699'),
(16, 3, '498798465'),
(17, 4, '26546513');

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

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`proyecto_id`, `usuario_id`, `cliente_id`, `jefe_proyecto_id`, `proyecto_estado_id`, `distrito_id`, `moneda_id`, `nombre_proyecto`, `fecha_registro`, `fecha_firma_contrato`, `fecha_inicio`, `fecha_entrega_estimada`, `numero_contrato`, `orden_compra`, `direccion_exacta`, `observaciones`) VALUES
(1, 1, 3, 14, 2, 38, 1, 'Proyecto 1', '2017-12-16 04:53:04', '2017-12-01', '2017-12-25', '2018-02-28', '11111', '222223', 'Frente a la iglesia', 'Prueba de observaciones nueva'),
(2, 1, 10, 14, 1, 122, 1, 'Proyecto 2', '2017-12-16 05:40:24', '2017-12-14', '2017-12-18', '2017-12-22', '123456', '654321', 'Casa naranja', 'Prueba 2 de proyecto'),
(3, 1, 8, 18, 1, 261, 1, 'Proyecto 3', '2017-12-16 05:47:57', '2017-12-14', '2017-12-18', '2017-12-22', '369258', '147258', 'Casa verde', 'Prueba 3 de proyecto'),
(4, 1, 7, 0, 2, 363, 1, 'Proyecto 4', '2017-12-16 05:50:10', '2017-12-15', '2017-12-20', '2017-12-29', '789456', '6549871', 'Casa azul', 'Prueba 4 de proyecto'),
(5, 1, 4, 17, 2, 1, 1, 'Proyecto 5', '2017-12-16 07:32:27', '2019-02-13', '2019-02-15', '2020-12-01', '12345', '123156498', 'En el estadio', 'Prueba 5'),
(6, 1, 8, 0, 3, 140, 1, 'Proyecto 6', '2017-12-17 01:43:36', '1970-01-01', '1970-01-01', '1970-01-01', '1122', '3566', 'Frente a la iglesia', ''),
(7, 1, 13, 0, 3, 351, 1, 'Proyecto 7', '2017-12-17 01:46:09', '2019-01-01', '2019-02-13', '2020-12-23', '75888', '96478', 'En la llanura', 'Proyecto 7 observaciones'),
(15, 1, 8, 14, 1, 316, 1, 'Proyecto 15', '2017-12-30 05:29:56', '2018-01-01', '2018-01-02', '2018-06-09', '234234', '234211', '', ''),
(16, 1, 15, 14, 1, 181, 1, 'Aling', '2018-01-12 03:54:26', '2018-01-31', '2018-02-01', '2018-02-28', '54ef65r', 'kbkjniui87878787', 'Frente a la iglesia. ', '');

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

--
-- Volcado de datos para la tabla `proyecto_colaborador`
--

INSERT INTO `proyecto_colaborador` (`proyecto_colaborador_id`, `proyecto_id`, `colaborador_id`, `tipo_relacion`, `fecha_registro`, `estado_registro`) VALUES
(1, 1, 6, 2, '2018-02-12 01:42:18', 1),
(2, 16, 1, 1, '2018-02-12 07:16:54', 0),
(3, 16, 16, 2, '2018-02-12 07:20:44', 1),
(4, 16, 7, 2, '2018-02-12 07:21:00', 1),
(6, 15, 6, 2, '2018-02-13 06:43:22', 0),
(7, 15, 7, 2, '2018-02-13 06:43:55', 0),
(8, 15, 15, 2, '2018-02-13 06:44:29', 1),
(9, 5, 17, 1, '2018-02-13 06:51:53', 1),
(10, 5, 16, 2, '2018-02-13 07:02:31', 1),
(14, 15, 1, 1, '2018-02-13 08:53:03', 1),
(17, 16, 14, 1, '2018-02-15 06:12:23', 1),
(18, 16, 17, 1, '2018-02-15 06:12:44', 0),
(19, 16, 6, 2, '2018-02-15 06:13:37', 1),
(20, 2, 6, 2, '2018-02-14 23:56:48', 1),
(21, 1, 14, 1, '2018-02-15 23:51:17', 1),
(22, 3, 18, 1, '2018-02-16 20:37:29', 1),
(23, 3, 19, 2, '2018-02-16 20:38:36', 1),
(24, 3, 6, 2, '2018-02-16 20:38:49', 1),
(25, 1, 15, 2, '2018-02-16 21:37:43', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_estado`
--

CREATE TABLE `proyecto_estado` (
  `proyecto_estado_id` int(11) NOT NULL,
  `proyecto_estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_estado`
--

INSERT INTO `proyecto_estado` (`proyecto_estado_id`, `proyecto_estado`) VALUES
(1, 'En presupuesto'),
(2, 'En ejecución'),
(3, 'Entregado'),
(4, 'Archivado');

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
  `fecha_gasto` date NOT NULL,
  `tiene_desgloce` int(11) NOT NULL COMMENT '0 para indicar que no tiene, 1 para indicar que si tiene'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_gasto`
--

INSERT INTO `proyecto_gasto` (`proyecto_gasto_id`, `proyecto_id`, `usuario_id`, `proyecto_gasto_tipo_id`, `fecha_registro`, `fecha_gasto`, `tiene_desgloce`) VALUES
(2, 1, 1, 3, '2017-12-28 07:11:00', '2017-12-30', 0),
(3, 1, 1, 3, '2017-12-28 07:11:52', '2018-01-26', 0),
(4, 1, 1, 1, '2017-12-28 07:22:51', '2018-01-05', 0),
(5, 1, 1, 2, '2017-12-29 01:47:09', '2018-01-01', 0),
(6, 1, 1, 1, '2017-12-29 03:57:26', '2018-01-02', 0),
(7, 1, 1, 1, '2017-12-29 03:58:13', '2018-01-05', 0),
(9, 1, 1, 4, '2017-12-29 05:47:30', '2017-12-29', 0),
(10, 2, 1, 4, '2017-12-29 05:48:15', '2017-12-29', 0),
(11, 3, 1, 4, '2017-12-29 05:48:18', '2017-12-29', 0),
(12, 4, 1, 4, '2017-12-29 05:48:23', '2017-12-29', 0),
(13, 5, 1, 4, '2017-12-29 05:48:26', '2017-12-29', 0),
(14, 6, 1, 4, '2017-12-29 05:48:29', '2017-12-29', 0),
(15, 7, 1, 4, '2017-12-29 05:48:32', '2017-12-29', 0),
(20, 15, 1, 4, '2017-12-30 05:29:57', '2017-12-30', 0),
(21, 15, 1, 1, '2017-12-30 05:30:28', '2018-01-03', 0),
(22, 16, 1, 4, '2018-01-12 03:54:27', '2018-01-12', 0),
(23, 16, 1, 1, '2018-01-12 04:03:49', '2018-02-02', 0),
(24, 16, 1, 3, '2018-01-12 04:08:39', '2018-02-03', 0),
(38, 1, 1, 2, '2018-02-16 19:49:28', '2018-02-16', 1),
(39, 1, 1, 2, '2018-02-16 19:49:40', '2018-02-15', 1),
(40, 1, 1, 2, '2018-02-16 19:50:40', '2018-02-14', 1),
(41, 1, 1, 2, '2018-02-16 19:53:45', '2018-02-13', 1),
(42, 3, 1, 2, '2018-02-16 20:42:51', '2018-02-16', 1),
(43, 1, 1, 2, '2018-02-18 18:41:40', '2018-02-18', 1),
(44, 1, 1, 2, '2018-02-18 18:52:28', '2018-02-18', 0),
(45, 16, 14, 2, '2018-02-18 19:49:51', '2018-02-18', 1);

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

--
-- Volcado de datos para la tabla `proyecto_gasto_detalle`
--

INSERT INTO `proyecto_gasto_detalle` (`proyecto_gasto_detalle_id`, `proyecto_gasto_id`, `proveedor_id`, `proyecto_gasto_estado_id`, `numero_factura`) VALUES
(2, 2, 1, 1, 123546),
(3, 4, 4, 1, 98165),
(4, 3, 1, 2, 34534),
(5, 6, 1, 2, 76788),
(6, 7, 2, 2, 7867878),
(9, 21, 1, 1, 34234),
(10, 23, 1, 1, 765767),
(11, 24, 1, 2, 9879798);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_gasto_estado`
--

CREATE TABLE `proyecto_gasto_estado` (
  `proyecto_gasto_estado_id` int(11) NOT NULL,
  `proyecto_gasto_estado` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_gasto_estado`
--

INSERT INTO `proyecto_gasto_estado` (`proyecto_gasto_estado_id`, `proyecto_gasto_estado`) VALUES
(1, 'Pendiente'),
(2, 'Cancelado');

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

--
-- Volcado de datos para la tabla `proyecto_gasto_mano_obra`
--

INSERT INTO `proyecto_gasto_mano_obra` (`proyecto_gasto_mano_obra_id`, `proyecto_gasto_id`, `proyecto_colaborador_id`, `usuario_id`, `fecha_registro`, `cantidad_horas`, `costo_hora_mano_obra`, `estado_registro`) VALUES
(25, 38, 17, 1, '2018-02-16 00:00:00', 6.00, 2500.00, 0),
(26, 38, 1, 1, '2018-02-16 00:00:00', 8.00, 1000.00, 0),
(27, 39, 17, 1, '2018-02-16 00:00:00', 10.00, 2500.00, 1),
(28, 39, 1, 1, '2018-02-16 00:00:00', 12.00, 1000.00, 1),
(29, 40, 17, 1, '2018-02-16 00:00:00', 8.00, 2500.00, 1),
(30, 40, 1, 1, '2018-02-16 00:00:00', 8.00, 1000.00, 1),
(31, 38, 17, 1, '2018-02-16 00:00:00', 7.00, 2500.00, 0),
(32, 38, 1, 1, '2018-02-16 00:00:00', 8.00, 1000.00, 0),
(33, 38, 17, 1, '2018-02-16 00:00:00', 7.00, 2500.00, 0),
(34, 38, 1, 1, '2018-02-16 00:00:00', 8.00, 1000.00, 0),
(35, 38, 17, 1, '2018-02-16 00:00:00', 10.00, 2500.00, 0),
(36, 38, 1, 1, '2018-02-16 00:00:00', 8.00, 1000.00, 0),
(37, 41, 17, 1, '2018-02-16 19:53:45', 3.00, 2500.00, 1),
(38, 41, 1, 1, '2018-02-16 19:53:45', 2.00, 1000.00, 1),
(39, 42, 22, 1, '2018-02-16 20:42:52', 8.00, 2000.00, 1),
(40, 42, 23, 1, '2018-02-16 20:42:52', 7.00, 1200.00, 1),
(41, 42, 1, 1, '2018-02-16 20:42:52', 9.00, 1000.00, 1),
(42, 38, 17, 1, '2018-02-16 20:43:32', 16.00, 2500.00, 1),
(43, 38, 1, 1, '2018-02-16 20:43:33', 12.00, 1000.00, 1),
(44, 43, 17, 1, '2018-02-18 18:41:40', 8.00, 2500.00, 1),
(45, 43, 1, 1, '2018-02-18 18:41:40', 6.00, 1000.00, 1),
(46, 43, 8, 1, '2018-02-18 18:41:40', 6.00, 1500.00, 1),
(47, 45, 17, 14, '2018-02-18 19:49:51', 8.00, 2500.00, 1),
(48, 45, 3, 14, '2018-02-18 19:49:51', 6.00, 1750.00, 1),
(49, 45, 1, 14, '2018-02-18 19:49:51', 7.00, 1000.00, 1),
(50, 45, 4, 14, '2018-02-18 19:49:51', 6.00, 800.00, 1);

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

--
-- Volcado de datos para la tabla `proyecto_gasto_monto`
--

INSERT INTO `proyecto_gasto_monto` (`proyecto_gasto_monto_id`, `proyecto_gasto_id`, `moneda_id`, `proyecto_gasto_monto`, `estado_registro`, `fecha_registro`) VALUES
(2, 2, 2, 20000.00, 0, '2017-12-28 07:11:00'),
(3, 3, 1, 1000.00, 0, '2017-12-28 07:11:52'),
(4, 4, 1, 250.00, 0, '2017-12-28 07:22:51'),
(5, 5, 2, 200000.00, 1, '2017-12-29 01:47:09'),
(8, 2, 2, 20200.00, 1, '2017-12-29 02:12:53'),
(9, 3, 1, 1000.00, 0, '2017-12-29 02:13:25'),
(10, 3, 2, 1000.00, 0, '2017-12-29 02:15:27'),
(14, 3, 1, 1000.00, 0, '2017-12-29 02:55:21'),
(15, 6, 1, 2500.00, 1, '2017-12-29 03:57:26'),
(16, 7, 2, 50000.00, 1, '2017-12-29 03:58:13'),
(18, 9, 1, 650.00, 0, '2017-12-29 05:47:30'),
(19, 10, 1, 1200.00, 1, '2017-12-29 05:48:15'),
(20, 11, 1, 5000.00, 1, '2017-12-29 05:48:18'),
(21, 12, 1, 16546.54, 1, '2017-12-29 05:48:23'),
(22, 13, 1, 1500.00, 1, '2017-12-29 05:48:26'),
(23, 14, 1, 6555.55, 1, '2017-12-29 05:48:29'),
(24, 15, 1, 3698.85, 1, '2017-12-29 05:48:32'),
(25, 9, 1, 675.00, 1, '2017-12-29 05:51:59'),
(26, 3, 1, 500.00, 0, '2017-12-29 06:09:39'),
(27, 3, 1, 700.00, 1, '2017-12-29 06:49:37'),
(28, 4, 1, 12500.00, 0, '2017-12-29 07:12:58'),
(29, 4, 1, 8500.00, 0, '2017-12-29 07:13:53'),
(30, 4, 1, 10500.00, 0, '2017-12-29 07:14:17'),
(31, 4, 1, 3000.00, 0, '2017-12-29 07:15:01'),
(32, 4, 1, 1000.00, 1, '2017-12-29 07:15:21'),
(37, 20, 1, 0.00, 0, '2017-12-30 05:29:57'),
(38, 21, 1, 1000.00, 1, '2017-12-30 05:30:28'),
(39, 20, 1, 250.00, 1, '2017-12-30 05:31:01'),
(40, 22, 1, 250.00, 1, '2018-01-12 03:54:27'),
(41, 23, 2, 20000.00, 1, '2018-01-12 04:03:49'),
(42, 24, 1, 20.00, 1, '2018-01-12 04:08:39'),
(59, 38, 2, 23000.00, 0, '2018-02-16 19:49:28'),
(60, 39, 2, 37000.00, 1, '2018-02-16 19:49:40'),
(61, 40, 2, 28000.00, 1, '2018-02-16 19:50:41'),
(63, 38, 2, 25500.00, 0, '2018-02-16 19:51:52'),
(64, 38, 2, 33000.00, 0, '2018-02-16 19:52:22'),
(65, 41, 2, 9500.00, 1, '2018-02-16 19:53:45'),
(66, 42, 2, 33400.00, 1, '2018-02-16 20:42:52'),
(67, 38, 2, 52000.00, 1, '2018-02-16 20:43:33'),
(68, 43, 2, 35000.00, 1, '2018-02-18 18:41:40'),
(69, 44, 2, 230000.00, 1, '2018-02-18 18:52:29'),
(70, 45, 2, 42300.00, 1, '2018-02-18 19:49:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_gasto_tipo`
--

CREATE TABLE `proyecto_gasto_tipo` (
  `proyecto_gasto_tipo_id` int(11) NOT NULL,
  `proyecto_gasto_tipo` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_gasto_tipo`
--

INSERT INTO `proyecto_gasto_tipo` (`proyecto_gasto_tipo_id`, `proyecto_gasto_tipo`) VALUES
(1, 'Gasto en Materiales'),
(2, 'Gasto en Mano de Obra'),
(3, 'Gasto de Operación'),
(4, 'Gasto Administrativo');

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

--
-- Volcado de datos para la tabla `proyecto_tipo_cambio`
--

INSERT INTO `proyecto_tipo_cambio` (`proyecto_tipo_cambio_id`, `proyecto_id`, `moneda_base_id`, `moneda_destino_id`, `valor_compra`, `valor_venta`, `fecha_registro`) VALUES
(1, 5, 1, 2, 568.00, 572.00, '2017-12-16 07:32:28'),
(2, 6, 1, 2, 558.00, 568.00, '2017-12-17 01:43:36'),
(3, 7, 1, 2, 569.00, 575.00, '2017-12-17 01:46:09'),
(4, 1, 1, 2, 568.75, 571.45, '2017-12-17 21:20:16'),
(11, 2, 1, 2, 0.00, 0.00, '2017-12-29 05:48:15'),
(12, 3, 1, 2, 534.00, 574.00, '2017-12-29 05:48:18'),
(13, 4, 1, 2, 0.00, 0.00, '2017-12-29 05:48:23'),
(15, 15, 1, 2, 562.00, 570.00, '2017-12-30 05:29:57'),
(16, 16, 1, 2, 564.00, 572.00, '2018-01-12 03:54:27');

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

--
-- Volcado de datos para la tabla `proyecto_valor_oferta`
--

INSERT INTO `proyecto_valor_oferta` (`proyecto_valor_oferta_id`, `proyecto_valor_oferta_tipo_id`, `proyecto_id`, `moneda_id`, `valor_oferta`, `fecha_registro`, `estado_registro`) VALUES
(1, 5, 1, 1, 2000.00, '2017-12-16 04:53:04', 1),
(2, 1, 1, 1, 5000.00, '2017-12-16 04:53:04', 1),
(3, 2, 1, 1, 5000.00, '2017-12-16 04:53:04', 1),
(4, 3, 1, 1, 600.00, '2017-12-16 04:53:04', 1),
(5, 4, 1, 1, 675.00, '2017-12-16 04:53:04', 1),
(6, 5, 2, 1, 200.00, '2017-12-16 05:40:24', 1),
(7, 1, 2, 1, 580.00, '2017-12-16 05:40:24', 1),
(8, 2, 2, 1, 200.00, '2017-12-16 05:40:24', 1),
(9, 3, 2, 1, 360.00, '2017-12-16 05:40:24', 1),
(10, 4, 2, 1, 1200.00, '2017-12-16 05:40:24', 1),
(11, 5, 3, 1, 1000.00, '2017-12-16 05:47:57', 1),
(12, 1, 3, 1, 2000.00, '2017-12-16 05:47:57', 1),
(13, 2, 3, 1, 3000.00, '2017-12-16 05:47:57', 1),
(14, 3, 3, 1, 4000.00, '2017-12-16 05:47:57', 1),
(15, 4, 3, 1, 5000.00, '2017-12-16 05:47:57', 1),
(16, 5, 4, 1, 506.66, '2017-12-16 05:50:10', 1),
(17, 1, 4, 1, 365.55, '2017-12-16 05:50:10', 1),
(18, 2, 4, 1, 3656.65, '2017-12-16 05:50:10', 1),
(19, 3, 4, 1, 21.65, '2017-12-16 05:50:10', 1),
(20, 4, 4, 1, 16546.54, '2017-12-16 05:50:10', 1),
(21, 5, 5, 1, 1010.10, '2017-12-16 07:32:28', 1),
(22, 1, 5, 1, 350.00, '2017-12-16 07:32:28', 1),
(23, 2, 5, 1, 2000.00, '2017-12-16 07:32:28', 1),
(24, 3, 5, 1, 1010.10, '2017-12-16 07:32:28', 1),
(25, 4, 5, 1, 1500.00, '2017-12-16 07:32:28', 1),
(26, 5, 6, 1, 2000.00, '2017-12-17 01:43:36', 1),
(27, 1, 6, 1, 125.22, '2017-12-17 01:43:36', 1),
(28, 2, 6, 1, 356.66, '2017-12-17 01:43:36', 1),
(29, 3, 6, 1, 544.44, '2017-12-17 01:43:36', 1),
(30, 4, 6, 1, 6555.55, '2017-12-17 01:43:36', 1),
(31, 5, 7, 1, 20000.00, '2017-12-17 01:46:09', 1),
(32, 1, 7, 1, 15000.00, '2017-12-17 01:46:09', 1),
(33, 2, 7, 1, 3655.00, '2017-12-17 01:46:09', 1),
(34, 3, 7, 1, 1215.50, '2017-12-17 01:46:09', 1),
(35, 4, 7, 1, 3698.85, '2017-12-17 01:46:09', 1),
(39, 6, 5, 1, 2770.00, '2017-12-27 01:36:43', 1),
(41, 6, 5, 1, 1700.00, '2017-12-27 01:38:42', 1),
(43, 6, 5, 1, 500.00, '2017-12-27 01:39:06', 1),
(44, 6, 1, 1, 1200.00, '2017-12-26 01:40:47', 1),
(45, 6, 1, 1, 1300.00, '2017-12-27 01:41:06', 1),
(46, 6, 1, 1, 600.00, '2017-12-28 01:41:39', 1),
(49, 6, 2, 1, 2500.00, '2017-12-27 03:27:26', 1),
(50, 6, 2, 1, 1200.00, '2017-12-27 03:27:40', 1),
(88, 6, 1, 1, 150.00, '2017-12-28 07:37:49', 1),
(95, 1, 15, 1, 0.00, '2017-12-30 05:29:57', 1),
(96, 2, 15, 1, 0.00, '2017-12-30 05:29:57', 1),
(97, 3, 15, 1, 0.00, '2017-12-30 05:29:57', 1),
(98, 4, 15, 1, 250.00, '2017-12-30 05:29:57', 1),
(99, 5, 15, 1, 0.00, '2017-12-30 05:29:57', 1),
(100, 1, 16, 1, 1000.00, '2018-01-12 03:54:27', 1),
(101, 2, 16, 1, 2500.00, '2018-01-12 03:54:27', 1),
(102, 3, 16, 1, 500.00, '2018-01-12 03:54:27', 1),
(103, 4, 16, 1, 250.00, '2018-01-12 03:54:27', 1),
(104, 5, 16, 1, 3000.00, '2018-01-12 03:54:27', 1),
(105, 6, 16, 1, 550.00, '2018-01-12 03:56:59', 1);

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

--
-- Volcado de datos para la tabla `proyecto_valor_oferta_extension_detalle`
--

INSERT INTO `proyecto_valor_oferta_extension_detalle` (`proyecto_valor_oferta_extension_detalle_id`, `proyecto_valor_oferta_id`, `proyecto_valor_oferta_extension_tipo_id`, `proyecto_valor_oferta_extension_descripcion`) VALUES
(4, 39, 1, ''),
(6, 41, 2, ''),
(8, 43, 3, ''),
(9, 44, 1, 'Cambio de color de paredes'),
(10, 45, 2, 'Cambio de cielorazo'),
(11, 46, 3, 'Camibio de ceramica\r\n'),
(14, 49, 1, '2 paredes adicionales'),
(15, 50, 2, 'Cambio de color'),
(23, 88, 3, ''),
(24, 105, 1, 'Cambio de color ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_valor_oferta_extension_tipo`
--

CREATE TABLE `proyecto_valor_oferta_extension_tipo` (
  `proyecto_valor_oferta_extension_tipo_id` int(11) NOT NULL,
  `proyecto_valor_oferta_extension_tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `estado_registro` int(11) NOT NULL COMMENT '0 = Inactivo, 1 = activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_valor_oferta_extension_tipo`
--

INSERT INTO `proyecto_valor_oferta_extension_tipo` (`proyecto_valor_oferta_extension_tipo_id`, `proyecto_valor_oferta_extension_tipo`, `estado_registro`) VALUES
(1, 'Paredes', 1),
(2, 'Cielo', 1),
(3, 'Pisos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_valor_oferta_tipo`
--

CREATE TABLE `proyecto_valor_oferta_tipo` (
  `proyecto_valor_oferta_tipo_id` int(11) NOT NULL,
  `proyecto_valor_oferta_tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_valor_oferta_tipo`
--

INSERT INTO `proyecto_valor_oferta_tipo` (`proyecto_valor_oferta_tipo_id`, `proyecto_valor_oferta_tipo`) VALUES
(1, 'Valor de Materiales'),
(2, 'Valor de Mano de Obra'),
(3, 'Valor de Gastos de Operación'),
(4, 'Valor de Gastos Administrativos'),
(5, 'Valor de Utilidad'),
(6, 'Valor de Ordenes de cambio');

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
  `password` char(255) COLLATE utf8_spanish_ci NOT NULL,
  `estado_row` int(11) NOT NULL COMMENT '0 para inactivo, 1 para activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`usuario_id`, `fecha_registro`, `rol_id`, `estado_id`, `usuario`, `password`, `estado_row`) VALUES
(1, '2017-12-01 06:19:38', 1, 1, 'instatec_admin', '$2y$10$UDJh9W7b0YR5.yNPEmNyLO6j8ZSN.f/7WXt136JrAEumTXbVfbdQC', 1),
(2, '2017-12-01 06:21:48', 1, 1, 'keylormg', '$2y$10$H/zVeP80TCO1oY1Qo6ZzbOMUUphGPyCdVDD43IZFaQ24dISqo5s9y', 1),
(3, '2018-01-24 07:19:12', 2, 1, 'khmg13', '$2y$10$wyh.bCmPXplwqMik2kRJp..YHSgbRs5.JryDRZzSTqeMxS1l7lrbW', 0),
(5, '2018-01-24 07:42:53', 2, 1, 'fchaves', '$2y$10$zhjNTy3UEDBhkQnN.nzpAOu8Upd909Ou28P.pU9wwYqjG70l2E.6G', 1),
(6, '2018-01-26 06:49:25', 3, 1, 'asistente1', '$2y$10$Pypj8f/kQyV0PlBA7.7b4e5USykgBsVrsa1R2dgcD2UXQt33jC0ma', 0),
(7, '2018-01-24 07:50:50', 3, 0, 'asistente2', '$2y$10$8KoLzaRD.nT7shMXvbF4TeeEWKtfSJOHqbktnMfhq.b./KJYW3EEi', 0),
(8, '2018-01-24 07:53:20', 2, 1, 'asistente3', '$2y$10$IRq7ELlAKw355nnliCX5p.cmFo7.r16eCPPpvgytb5GdT/f/GYZEi', 0),
(10, '2018-02-06 06:46:00', 3, 1, 'yersonmgm', '$2y$10$cw7571QJUsokKXWlH9mMleiM2E8k8wKVejggQ4kaBSAUcwX//HOhK', 0),
(11, '2018-02-06 07:06:41', 3, 1, 'miladygv', '$2y$10$sOuwckfqyjJPVzE6I4A8hugaFMU4wHSOx1sKxS5SVQ6jOm2c4ql3m', 0),
(12, '2018-02-07 07:43:17', 3, 1, 'miladygv', '$2y$10$6KBu0JTbydkOqmQI/AbqUO5YshakgTltHiaF35OOBbYKIC1ZXP2zO', 0),
(13, '2018-02-07 07:48:17', 3, 1, 'miladygv', '$2y$10$qTUdJxrDLtuQJ9f84ohwFuOIgXDGXyflt2nQoBgYgG9oQXWiRiMUu', 0),
(14, '2018-02-10 18:53:07', 3, 1, 'mgarro', '$2y$10$XhOxNUPYY9IQtikCsr7Cuug9cDbHwe4FuqbC5lckYLCOo7b6/sADW', 1),
(15, '2018-02-13 06:51:11', 3, 1, 'lvargas', '$2y$10$ehGxrvdV6kNLlBPAyglfe.63RSD8VMpaEPR6xnrtMRU1qD5ulRfxa', 1),
(16, '2018-02-16 20:30:27', 3, 1, 'jcampos', '$2y$10$cwOy6BjrmnbB0hQ12NeXK.ui9e2TIMKaHBVIQl.5.2pW7zgMq9Lzu', 1);

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

--
-- Volcado de datos para la tabla `usuario_bitacora_cambios`
--

INSERT INTO `usuario_bitacora_cambios` (`usuario_bitacora_cambio_id`, `usuario_id`, `fecha_cambio`, `tipo`, `tabla`, `id_fila`) VALUES
(1, 1, '2017-12-11 07:32:10', 'edicion', 'cliente', 1),
(2, 1, '2017-12-11 07:32:38', 'edicion', 'cliente', 1),
(3, 1, '2017-12-11 07:33:19', 'edicion', 'proveedor', 1),
(4, 1, '2017-12-11 07:33:42', 'edicion', 'proveedor', 3),
(5, 1, '2017-12-17 21:11:29', 'edicion', '', 1),
(6, 1, '2017-12-17 21:20:17', 'edicion', '', 1),
(7, 1, '2017-12-17 21:23:51', 'edicion', '', 1),
(8, 1, '2017-12-17 21:27:08', 'edicion', '', 7),
(9, 1, '2017-12-22 19:48:56', 'edicion', '', 5),
(10, 1, '2017-12-23 01:54:22', 'edicion', '', 5),
(11, 1, '2017-12-29 05:43:43', 'edicion', '', 1),
(12, 1, '2017-12-29 05:46:04', 'edicion', '', 1),
(13, 1, '2017-12-29 05:47:30', 'edicion', '', 1),
(14, 1, '2017-12-29 05:48:15', 'edicion', '', 2),
(15, 1, '2017-12-29 05:48:18', 'edicion', '', 3),
(16, 1, '2017-12-29 05:48:23', 'edicion', '', 4),
(17, 1, '2017-12-29 05:48:27', 'edicion', '', 5),
(18, 1, '2017-12-29 05:48:29', 'edicion', '', 6),
(19, 1, '2017-12-29 05:48:32', 'edicion', '', 7),
(20, 1, '2017-12-29 05:51:19', 'edicion', '', 1),
(21, 1, '2017-12-29 05:51:42', 'edicion', '', 1),
(22, 1, '2017-12-29 05:51:59', 'edicion', '', 1),
(23, 1, '2017-12-29 06:09:56', 'edicion', '', 1),
(24, 1, '2017-12-29 06:10:18', 'edicion', '', 1),
(25, 1, '2017-12-29 06:10:46', 'edicion', '', 1),
(26, 1, '2017-12-29 06:11:10', 'edicion', '', 1),
(27, 1, '2017-12-29 07:38:01', 'edicion', '', 1),
(28, 1, '2017-12-29 07:49:45', 'edicion', '', 1),
(29, 1, '2017-12-29 07:52:37', 'edicion', '', 1),
(30, 1, '2017-12-30 05:31:01', 'edicion', '', 15),
(31, 1, '2017-12-31 20:01:53', 'edicion', '', 1),
(32, 1, '2018-02-10 20:31:20', 'edicion', '', 1),
(33, 1, '2018-02-10 20:33:48', 'edicion', '', 2),
(34, 1, '2018-02-12 02:07:35', 'edicion', '', 15),
(35, 1, '2018-02-12 02:07:40', 'edicion', '', 15),
(36, 1, '2018-02-12 02:11:17', 'edicion', '', 16),
(37, 1, '2018-02-12 02:12:38', 'edicion', '', 16),
(38, 1, '2018-02-12 02:13:24', 'edicion', '', 16),
(39, 1, '2018-02-12 02:13:27', 'edicion', '', 16),
(40, 1, '2018-02-12 02:19:20', 'edicion', '', 16),
(41, 1, '2018-02-12 02:19:54', 'edicion', '', 16),
(42, 1, '2018-02-12 02:21:59', 'edicion', '', 16),
(43, 1, '2018-02-12 02:21:59', 'edicion', '', 16),
(44, 1, '2018-02-12 07:16:54', 'edicion', '', 16),
(45, 1, '2018-02-12 07:22:36', 'edicion', '', 16),
(46, 1, '2018-02-12 07:22:42', 'edicion', '', 16),
(47, 1, '2018-02-12 07:25:21', 'edicion', '', 16),
(48, 1, '2018-02-12 07:25:23', 'edicion', '', 16),
(49, 1, '2018-02-12 07:26:02', 'edicion', '', 16),
(50, 1, '2018-02-12 07:26:36', 'edicion', '', 16),
(51, 1, '2018-02-12 07:26:44', 'edicion', '', 16),
(52, 1, '2018-02-12 07:27:41', 'edicion', '', 16),
(53, 1, '2018-02-12 07:28:30', 'edicion', '', 16),
(54, 1, '2018-02-12 07:28:31', 'edicion', '', 16),
(55, 1, '2018-02-12 07:28:32', 'edicion', '', 16),
(56, 1, '2018-02-12 07:30:12', 'edicion', '', 16),
(57, 1, '2018-02-12 07:30:18', 'edicion', '', 16),
(58, 1, '2018-02-13 06:42:35', 'edicion', '', 15),
(59, 1, '2018-02-13 06:49:26', 'edicion', '', 15),
(60, 1, '2018-02-13 06:51:53', 'edicion', '', 5),
(61, 1, '2018-02-13 08:43:54', 'edicion', '', 15),
(62, 1, '2018-02-13 08:47:43', 'edicion', '', 15),
(63, 1, '2018-02-13 08:51:22', 'edicion', '', 15),
(64, 1, '2018-02-13 08:53:03', 'edicion', '', 15),
(65, 1, '2018-02-15 06:04:11', 'edicion', '', 16),
(66, 1, '2018-02-15 06:04:39', 'edicion', '', 16),
(67, 1, '2018-02-15 06:05:38', 'edicion', '', 16),
(68, 1, '2018-02-15 06:12:24', 'edicion', '', 16),
(69, 1, '2018-02-15 06:12:45', 'edicion', '', 16),
(70, 1, '2018-02-15 06:12:58', 'edicion', '', 16),
(71, 1, '2018-02-15 06:13:22', 'edicion', '', 16),
(72, 1, '2018-02-15 23:51:18', 'edicion', '', 1),
(73, 1, '2018-02-16 00:53:04', 'edicion', '', 16),
(74, 1, '2018-02-16 00:53:25', 'edicion', '', 16),
(75, 1, '2018-02-16 00:56:11', 'edicion', '', 16),
(76, 1, '2018-02-16 12:23:40', 'edicion', '', 6),
(77, 1, '2018-02-16 12:39:33', 'edicion', '', 14),
(78, 1, '2018-02-16 20:33:43', 'edicion', '', 18),
(79, 1, '2018-02-16 20:37:29', 'edicion', '', 3),
(80, 1, '2018-02-18 17:52:31', 'edicion', '', 3);

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

--
-- Volcado de datos para la tabla `usuario_bitacora_ingreso`
--

INSERT INTO `usuario_bitacora_ingreso` (`usuario_bitacora_id`, `usuario_id`, `fecha_ingreso`, `ip`, `agente_usuario`) VALUES
(1, 1, '2017-12-01 08:05:13', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(2, 2, '2017-12-01 08:07:13', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(3, 1, '2017-12-01 08:07:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(4, 1, '2017-12-01 08:11:01', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1'),
(5, 1, '2017-12-04 00:11:51', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(6, 1, '2017-12-07 02:12:29', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(7, 1, '2017-12-07 02:27:51', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(8, 1, '2017-12-08 06:21:24', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(9, 1, '2017-12-09 02:45:54', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(10, 1, '2017-12-11 01:32:28', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(11, 1, '2017-12-11 05:14:48', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(12, 1, '2017-12-12 06:32:04', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(13, 1, '2017-12-13 04:13:52', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(14, 1, '2017-12-13 07:01:19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(15, 1, '2017-12-14 04:52:16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(16, 1, '2017-12-16 01:07:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36'),
(17, 1, '2017-12-16 19:09:48', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(18, 1, '2017-12-17 19:50:05', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(19, 1, '2017-12-17 19:50:10', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(20, 1, '2017-12-17 21:34:11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(21, 1, '2017-12-17 21:34:28', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(22, 1, '2017-12-18 06:45:45', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(23, 1, '2017-12-19 03:38:06', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(24, 1, '2017-12-19 06:34:58', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(25, 1, '2017-12-20 03:16:04', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(26, 1, '2017-12-22 03:27:48', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(27, 1, '2017-12-22 05:30:50', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(28, 1, '2017-12-22 19:41:20', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(29, 1, '2017-12-24 18:51:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(30, 1, '2017-12-26 20:08:00', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(31, 1, '2017-12-26 20:08:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(32, 1, '2017-12-27 01:26:54', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(33, 1, '2017-12-28 01:23:12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(34, 1, '2017-12-28 04:22:09', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(35, 1, '2017-12-28 19:14:02', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(36, 1, '2017-12-29 00:53:12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(37, 1, '2017-12-29 23:32:27', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(38, 1, '2017-12-31 19:42:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(39, 1, '2018-01-02 06:05:48', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(40, 1, '2018-01-03 07:27:06', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(41, 1, '2018-01-09 20:09:50', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(42, 1, '2018-01-10 00:08:05', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(43, 1, '2018-01-10 05:44:41', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(44, 1, '2018-01-12 03:27:28', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(45, 1, '2018-01-12 05:07:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.84 Safari/537.36'),
(46, 1, '2018-01-19 05:28:59', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(47, 2, '2018-01-22 06:13:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0'),
(48, 2, '2018-01-22 07:21:30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0'),
(49, 2, '2018-01-23 07:11:50', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0'),
(50, 2, '2018-01-23 07:14:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0'),
(51, 2, '2018-01-24 06:40:37', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0'),
(52, 2, '2018-01-25 05:31:09', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0'),
(53, 6, '2018-01-25 05:31:23', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0'),
(54, 2, '2018-01-25 05:31:43', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0'),
(55, 2, '2018-01-26 05:06:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:57.0) Gecko/20100101 Firefox/57.0'),
(56, 1, '2018-02-02 04:22:42', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(57, 1, '2018-02-02 05:17:52', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(58, 5, '2018-02-02 05:18:54', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(59, 1, '2018-02-02 07:01:35', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(60, 5, '2018-02-02 07:01:51', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(61, 5, '2018-02-02 07:08:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(62, 1, '2018-02-04 04:33:31', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(63, 1, '2018-02-04 21:32:17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(64, 1, '2018-02-06 06:05:30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(65, 1, '2018-02-07 07:31:25', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(66, 5, '2018-02-07 08:19:24', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(67, 5, '2018-02-10 18:48:16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(68, 14, '2018-02-10 18:54:29', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(69, 1, '2018-02-10 20:06:35', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(70, 1, '2018-02-11 00:11:31', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(71, 1, '2018-02-11 20:46:40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(72, 1, '2018-02-12 00:13:38', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(73, 1, '2018-02-12 07:10:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(74, 1, '2018-02-13 06:41:11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(75, 15, '2018-02-13 06:51:23', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(76, 1, '2018-02-13 06:51:28', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(77, 1, '2018-02-15 05:48:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(78, 1, '2018-02-15 23:26:50', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(79, 1, '2018-02-16 12:15:48', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(80, 1, '2018-02-16 19:31:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(81, 5, '2018-02-16 20:26:17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(82, 1, '2018-02-16 20:27:05', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(83, 14, '2018-02-16 20:27:25', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(84, 1, '2018-02-16 20:28:33', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(85, 1, '2018-02-18 17:49:58', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(86, 14, '2018-02-18 19:48:24', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(87, 5, '2018-02-20 23:17:30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(88, 14, '2018-02-21 00:13:50', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(89, 14, '2018-02-21 00:13:50', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_colaborador`
--

CREATE TABLE `usuario_colaborador` (
  `usuario_colaborador_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `colaborador_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_colaborador`
--

INSERT INTO `usuario_colaborador` (`usuario_colaborador_id`, `usuario_id`, `colaborador_id`) VALUES
(1, 5, 1),
(2, 6, 2),
(3, 7, 3),
(4, 8, 4),
(5, 3, 5),
(6, 10, 10),
(7, 11, 11),
(8, 12, 12),
(9, 13, 13),
(10, 14, 14),
(11, 15, 17),
(12, 16, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_detalle`
--

CREATE TABLE `usuario_detalle` (
  `usuario_detalle_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo_electronico` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `usuario_detalle`
--

INSERT INTO `usuario_detalle` (`usuario_detalle_id`, `usuario_id`, `nombre`, `apellidos`, `correo_electronico`) VALUES
(1, 1, 'Arlen', 'Loaiza', 'info@instateccr.com'),
(2, 2, 'Keylor', 'Mora', 'khmg13@gmail.com'),
(3, 3, 'Keylor Humberto', 'Mora Garro', 'keylor@orbelink.com'),
(5, 5, 'Fabiola', 'Chaves', 'fabiola@instateccr.com'),
(6, 6, 'Asistente', 'Instatec', 'asistente1@instateccr.com'),
(7, 7, 'Asistente 2', 'Instatec', 'asistente2@instateccr.com'),
(8, 8, 'Asistente 3', 'Instatec', 'asistente34@instateccr.com'),
(10, 10, 'Yerson', 'Mora', 'yerson@instateccr.com'),
(11, 11, 'Milady', 'Garro', 'milady@instateccr.com'),
(12, 12, 'Milady', 'Garro', 'milady@instateccr.com'),
(13, 13, 'Milady', 'Garro', 'milady@instateccr.com'),
(14, 14, 'Meilyn', 'Garro', 'mgarro@instateccr.com'),
(15, 15, 'Luis', 'Vargas', 'luis.vargas@instatec.com'),
(16, 16, 'Jose', 'Campos', 'josec@instatec.com');

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
  `rol` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `rol_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`rol_id`, `rol`, `rol_name`) VALUES
(1, 'administrador', 'Administrador'),
(2, 'asistente', 'Asistente'),
(3, 'jefe_proyecto', 'Jefe de proyecto'),
(4, 'colaborador', 'Colaborador');

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
(27, 1, 'reporte_proyecto_especifico', 'view', 1),
(28, 1, 'usuario', 'create', 1),
(29, 1, 'usuario', 'view', 1),
(30, 1, 'usuario', 'edit', 1),
(31, 1, 'usuario', 'delete', 1),
(32, 1, 'usuario', 'list', 1),
(33, 2, 'proyecto', 'create', 0),
(34, 2, 'proyecto', 'view', 1),
(35, 2, 'proyecto', 'edit', 0),
(36, 2, 'proyecto', 'delete', 0),
(37, 2, 'proyecto', 'list', 1),
(38, 2, 'cliente', 'create', 0),
(39, 2, 'cliente', 'view', 1),
(40, 2, 'cliente', 'edit', 0),
(41, 2, 'cliente', 'delete', 0),
(42, 2, 'cliente', 'list', 1),
(43, 2, 'proveedor', 'create', 0),
(44, 2, 'proveedor', 'view', 1),
(45, 2, 'proveedor', 'edit', 0),
(46, 2, 'proveedor', 'delete', 0),
(47, 2, 'proveedor', 'list', 1),
(48, 2, 'proyecto_extensiones', 'create', 0),
(49, 2, 'proyecto_extensiones', 'view', 0),
(50, 2, 'proyecto_extensiones', 'edit', 0),
(51, 2, 'proyecto_extensiones', 'list', 0),
(52, 2, 'proyecto_extensiones', 'delete', 0),
(53, 2, 'proyecto_gastos', 'create', 1),
(54, 2, 'proyecto_gastos', 'view', 1),
(55, 2, 'proyecto_gastos', 'edit', 1),
(56, 2, 'proyecto_gastos', 'delete', 0),
(57, 2, 'proyecto_gastos', 'list', 1),
(58, 2, 'reporte', 'list', 1),
(59, 2, 'reporte_proyecto_especifico', 'view', 0),
(60, 2, 'usuario', 'create', 1),
(61, 2, 'usuario', 'view', 1),
(62, 2, 'usuario', 'edit', 1),
(63, 2, 'usuario', 'delete', 0),
(64, 2, 'usuario', 'list', 1),
(65, 2, 'proyecto', 'create', 0),
(66, 3, 'proyecto', 'view', 1),
(67, 3, 'proyecto', 'edit', 0),
(68, 3, 'proyecto', 'delete', 0),
(69, 3, 'proyecto', 'list', 1),
(70, 3, 'cliente', 'create', 0),
(71, 3, 'cliente', 'view', 0),
(72, 3, 'cliente', 'edit', 0),
(73, 3, 'cliente', 'delete', 0),
(74, 3, 'cliente', 'list', 0),
(75, 3, 'proveedor', 'create', 0),
(76, 3, 'proveedor', 'view', 0),
(77, 3, 'proveedor', 'edit', 0),
(78, 3, 'proveedor', 'delete', 0),
(79, 3, 'proveedor', 'list', 0),
(80, 3, 'proyecto_extensiones', 'create', 0),
(81, 3, 'proyecto_extensiones', 'view', 0),
(82, 3, 'proyecto_extensiones', 'edit', 0),
(83, 3, 'proyecto_extensiones', 'list', 0),
(84, 3, 'proyecto_extensiones', 'delete', 0),
(85, 3, 'proyecto_gastos', 'create', 0),
(86, 3, 'proyecto_gastos', 'view', 0),
(87, 3, 'proyecto_gastos', 'edit', 0),
(88, 3, 'proyecto_gastos', 'delete', 0),
(89, 3, 'proyecto_gastos', 'list', 0),
(90, 3, 'reporte', 'list', 0),
(91, 3, 'reporte_proyecto_especifico', 'view', 0),
(92, 3, 'usuario', 'create', 0),
(93, 3, 'usuario', 'view', 0),
(94, 3, 'usuario', 'edit', 0),
(95, 3, 'usuario', 'delete', 0),
(96, 3, 'usuario', 'list', 0),
(97, 4, 'proyecto', 'create', 0),
(98, 4, 'proyecto', 'view', 0),
(99, 4, 'proyecto', 'edit', 0),
(100, 4, 'proyecto', 'delete', 0),
(101, 4, 'proyecto', 'list', 0),
(102, 4, 'cliente', 'create', 0),
(103, 4, 'cliente', 'view', 0),
(104, 4, 'cliente', 'edit', 0),
(105, 4, 'cliente', 'delete', 0),
(106, 4, 'cliente', 'list', 0),
(107, 4, 'proveedor', 'create', 0),
(108, 4, 'proveedor', 'view', 0),
(109, 4, 'proveedor', 'edit', 0),
(110, 4, 'proveedor', 'delete', 0),
(111, 4, 'proveedor', 'list', 0),
(112, 4, 'proyecto_extensiones', 'create', 0),
(113, 4, 'proyecto_extensiones', 'view', 0),
(114, 4, 'proyecto_extensiones', 'edit', 0),
(115, 4, 'proyecto_extensiones', 'list', 0),
(116, 4, 'proyecto_extensiones', 'delete', 0),
(117, 4, 'proyecto_gastos', 'create', 0),
(118, 4, 'proyecto_gastos', 'view', 0),
(119, 4, 'proyecto_gastos', 'edit', 0),
(120, 4, 'proyecto_gastos', 'delete', 0),
(121, 4, 'proyecto_gastos', 'list', 0),
(122, 4, 'reporte', 'list', 0),
(123, 4, 'reporte_proyecto_especifico', 'view', 0),
(124, 4, 'usuario', 'create', 0),
(125, 4, 'usuario', 'view', 0),
(126, 4, 'usuario', 'edit', 0),
(127, 4, 'usuario', 'delete', 0),
(128, 4, 'usuario', 'list', 0),
(129, 1, 'colaborador', 'create', 1),
(130, 1, 'colaborador', 'view', 1),
(131, 1, 'colaborador', 'edit', 1),
(132, 1, 'colaborador', 'delete', 1),
(133, 1, 'colaborador', 'list', 1),
(134, 2, 'colaborador', 'create', 1),
(135, 2, 'colaborador', 'view', 1),
(136, 2, 'colaborador', 'edit', 1),
(137, 2, 'colaborador', 'delete', 0),
(138, 2, 'colaborador', 'list', 1),
(139, 3, 'colaborador', 'create', 0),
(140, 3, 'colaborador', 'view', 0),
(141, 3, 'colaborador', 'edit', 0),
(142, 3, 'colaborador', 'delete', 0),
(143, 3, 'colaborador', 'list', 0),
(144, 4, 'colaborador', 'create', 0),
(145, 4, 'colaborador', 'view', 0),
(146, 4, 'colaborador', 'edit', 0),
(147, 4, 'colaborador', 'delete', 0),
(148, 4, 'colaborador', 'list', 0),
(149, 1, 'proyecto_colaboradores', 'view', 1),
(150, 1, 'proyecto_colaboradores', 'edit', 1),
(151, 1, 'proyecto_colaboradores_tiempo', 'edit', 1),
(152, 2, 'proyecto_colaboradores', 'view', 1),
(153, 2, 'proyecto_colaboradores', 'edit', 1),
(154, 2, 'proyecto_colaboradores_tiempo', 'edit', 1),
(155, 3, 'proyecto_colaboradores', 'view', 1),
(156, 3, 'proyecto_colaboradores', 'edit', 0),
(157, 3, 'proyecto_colaboradores_tiempo', 'edit', 1);

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
  MODIFY `colaborador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `colaborador_costo_hora`
--
ALTER TABLE `colaborador_costo_hora`
  MODIFY `colaborador_costo_hora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
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
  MODIFY `proyecto_colaborador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `proyecto_estado`
--
ALTER TABLE `proyecto_estado`
  MODIFY `proyecto_estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto`
--
ALTER TABLE `proyecto_gasto`
  MODIFY `proyecto_gasto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
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
  MODIFY `proyecto_gasto_mano_obra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto_monto`
--
ALTER TABLE `proyecto_gasto_monto`
  MODIFY `proyecto_gasto_monto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
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
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `usuario_bitacora_cambios`
--
ALTER TABLE `usuario_bitacora_cambios`
  MODIFY `usuario_bitacora_cambio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT de la tabla `usuario_bitacora_ingreso`
--
ALTER TABLE `usuario_bitacora_ingreso`
  MODIFY `usuario_bitacora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT de la tabla `usuario_colaborador`
--
ALTER TABLE `usuario_colaborador`
  MODIFY `usuario_colaborador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `usuario_detalle`
--
ALTER TABLE `usuario_detalle`
  MODIFY `usuario_detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
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
  MODIFY `usuario_rol_permiso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
