-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2018 a las 05:09:49
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
  `cliente_calificacion_id` int(1) NOT NULL,
  `comentario` text COLLATE utf8_spanish_ci NOT NULL,
  `estado_cliente` int(11) NOT NULL COMMENT '0 para inactivo, 1 para activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `usuario_id`, `fecha_registro`, `nombre_cliente`, `cedula_cliente`, `cliente_calificacion_id`, `comentario`, `estado_cliente`) VALUES
(1, 1, '2017-12-07 07:33:46', 'Edica Ltda', '3101005810', 3, 'Es un cliente normal', 1),
(2, 1, '2017-12-07 07:33:59', 'Cliente 2', '321654987', 0, '', 0),
(3, 1, '2017-12-07 07:34:33', 'Cliente 3', '987654321', 0, '', 0),
(4, 1, '2017-12-07 07:34:54', 'BILCO COSTA RICA ', '3-101-595426', 0, '', 1),
(5, 1, '2017-12-09 03:18:47', 'ALUMIMUNDO SA', '3-101-086859', 1, '', 1),
(6, 1, '2017-12-09 08:24:07', 'Cliente 6', '23432', 0, '', 0),
(7, 1, '2017-12-09 08:24:12', 'ARISTA DE CR', '3-101-129926', 0, '', 0),
(8, 1, '2017-12-09 08:24:17', 'BT CONSULTING AND SERVICES SA', '3-101-277443', 0, '', 0),
(9, 1, '2017-12-09 08:24:25', 'Cliente 9', '', 0, '', 0),
(10, 1, '2017-12-09 08:24:31', 'ESCALA', '', 0, '', 1),
(11, 1, '2017-12-09 08:24:36', 'Edificar S.A', '', 5, '', 1),
(12, 1, '2017-12-09 08:24:42', 'Cliente 12', '', 0, '', 0),
(13, 1, '2017-12-17 06:02:59', 'Cliente 13', '568798654', 0, '', 1),
(14, 1, '2017-12-29 00:58:24', 'Cliente 14', '65465461', 0, '', 1),
(15, 1, '2018-01-12 03:30:09', 'Proycon', '3-101 2', 0, '', 1),
(16, 1, '2018-08-02 18:37:38', 'Cliente Prueba 1', '56879654', 5, 'Es un cliente que paga siempre a tiempo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente_calificacion`
--

CREATE TABLE `cliente_calificacion` (
  `cliente_calificacion_id` int(11) NOT NULL,
  `cliente_calificacion` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cliente_calificacion`
--

INSERT INTO `cliente_calificacion` (`cliente_calificacion_id`, `cliente_calificacion`) VALUES
(1, 'Muy malo'),
(2, 'Malo'),
(3, 'Regular'),
(4, 'Bueno'),
(5, 'Excelente');

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
(18, 13, 'cliente13@gmail.com'),
(19, 13, 'cliente13@hotmail.com'),
(25, 15, 'info@proycon.com'),
(26, 3, 'khmg13@gmail.com'),
(27, 3, 'khmg13@hotmail.es'),
(29, 4, 'cliente4@cliente.net'),
(35, 16, 'contacto@cliente1.com'),
(36, 16, 'contacto2@cliente1.com'),
(39, 1, 'contactus@edica.co.cr'),
(40, 5, 'prueba@cliente.com'),
(41, 11, 'edificaronline@.com');

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
(17, 13, '88888888'),
(18, 13, '99999999'),
(25, 15, '25431600'),
(26, 3, '22345360'),
(27, 3, '22539150'),
(30, 4, '2288-5150'),
(34, 7, '2288-1304'),
(36, 8, '2508-3208'),
(37, 16, '22335566'),
(38, 16, '22558899'),
(39, 16, '55889988'),
(44, 1, '2222-4511'),
(45, 1, '20107000'),
(46, 5, '2232-8666');

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
  `alias` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `correo_electronico` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `cedula` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `seguro_social` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `identificador_interno` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `comentario` text COLLATE utf8_spanish_ci NOT NULL,
  `estado_row` int(11) NOT NULL COMMENT 'Para marcar cuando se elimina un registro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `colaborador`
--

INSERT INTO `colaborador` (`colaborador_id`, `colaborador_puesto_id`, `estado`, `fecha_registro`, `nombre`, `apellidos`, `alias`, `correo_electronico`, `cedula`, `seguro_social`, `identificador_interno`, `telefono`, `comentario`, `estado_row`) VALUES
(1, 1, 1, '0000-00-00 00:00:00', 'Fabiola', 'Chaves', '', 'fabiola@instateccr.com', '356695566', '4564', '2155', '', '', 0),
(2, 1, 1, '0000-00-00 00:00:00', 'Asistente', 'Instatec', '', 'asistente1@instateccr.com', '', '', '', '', '', 0),
(3, 1, 1, '0000-00-00 00:00:00', 'Asistente 2', 'Instatec', '', 'asistente2@instateccr.com', '', '', '', '', '', 0),
(4, 1, 1, '0000-00-00 00:00:00', 'Asistente 3', 'Instatec', '', 'asistente34@instateccr.com', '', '', '', '', '', 0),
(5, 1, 1, '0000-00-00 00:00:00', 'Keylor Humberto', 'Mora Garro', '', 'keylor@orbelink.com', '', '', '', '', '', 0),
(6, 2, 1, '2018-02-06 06:08:30', 'Carlos', 'Mora', '', 'carlos@instateccr.com', '302550556', '75345345', '10', '6516516', '', 0),
(7, 3, 1, '2018-02-06 06:10:21', 'Rosa', 'Mora', '', 'rosa@instateccr.com', '265498465', '546546', '23', '6516516', '', 0),
(10, 1, 1, '2018-02-06 06:45:59', 'Yerson', 'Mora', '', 'yerson@instateccr.com', '651651651', '45345', '45', '5465484', '', 0),
(11, 1, 1, '2018-02-06 07:06:40', 'Milady', 'Garro', '', 'milady@instateccr.com', '5465498', '2131654', '32', '561321654', '', 0),
(12, 1, 1, '2018-02-07 07:43:17', 'Milady', 'Garro', '', 'milady@instateccr.com', '329515', '2126', '3656', '6546516', '', 0),
(13, 1, 1, '2018-02-07 07:48:17', 'Milady', 'Garro', '', 'milady@instateccr.com', '', '', '', '', '', 0),
(14, 1, 1, '2018-02-10 18:53:07', 'Meilyn', 'Garro', '', 'mgarro@instateccr.com', '151616556', '65165', '15', '', '', 0),
(15, 3, 1, '2018-02-12 02:03:30', 'David', 'Araya', '', 'david@correo.com', '8979849', '15351654', '564988498', '6549848', '', 0),
(16, 2, 1, '2018-02-12 02:09:21', 'David', 'Araya', '', 'david@correo.com', '645456', '123', '125', '65465467', '', 0),
(17, 1, 1, '2018-02-13 06:51:11', 'Luis', 'Vargas', '', 'luis.vargas@instatec.com', '64651659', '45615651', '2156', '51651659', '', 0),
(18, 1, 1, '2018-02-16 20:30:53', 'Jose', 'Campos', '', 'josec@instatec.com', '15616516', '123165496', '123', '1565648979', '', 0),
(19, 2, 1, '2018-02-16 20:35:16', 'Pablo ', 'Perez', '', 'pablo@instatec.com', '4654689', '5987654', '5566', '65468974', '', 0),
(20, 1, 1, '2018-04-05 18:54:41', 'Jose', 'Perez', '', 'josep@instateccr.com', '22312231', '12312321', '121', '', '', 0),
(21, 2, 0, '2018-04-05 18:57:55', 'Carlos', 'Chanto', '', 'cchanto@instateccr.com', '3098093280|', '23131654', '3216548', '546546654', '', 1),
(22, 1, 1, '2018-04-07 17:18:39', 'Auxiliadora ', 'Cervantes Calderón ', '', 'auxiliadora@instateccr.com', '304160478', '000001', '2000', '88896060', '', 0),
(23, 1, 1, '2018-04-13 12:48:43', 'MÓNICA', 'QUESADA VARGAS', '', 'moni_q25@hotmail.com', '115290615', '0003', 'Moni', '83447226', '', 1),
(24, 1, 1, '2018-04-13 14:55:52', 'EDWARD', 'LOAIZA SOTO', '', 'loaizasotoe@gmail.com', '3-01010101', '23232323', 'CUAJI', '', '', 1),
(25, 1, 1, '2018-04-13 18:04:02', 'ROLANDO ', 'LOAIZA SOTO', '', 'rolando@instateccr.com', '3-000-0000', '22222', 'ROLO', '85106565', '', 1),
(26, 2, 1, '2018-04-13 18:48:03', 'David', 'Robleto Martinez', '', '', '125566884666', '2563', 'Robleto', '', '', 1),
(27, 2, 1, '2018-04-16 10:40:07', 'ALEJANDRO ANTONIO ', 'LOPEZ', '', '', 'MARIN', '000', 'C01626932', '', '', 0),
(28, 2, 1, '2018-04-16 10:49:37', 'CARLOS HUMBERTO ', 'VINDAS VALVERDE', '', '', '111050957', '111050957', 'O.02', '', '', 1),
(29, 2, 1, '2018-04-16 10:55:58', 'DAVID ALEXANDER', 'SUAREZ', '', '', '155821409016', '1910103480', 'O.01', '', '', 1),
(30, 2, 1, '2018-04-16 10:57:29', 'DOMINGO ', 'PORRAS GARCIA', '', '', '15582334223', '1940095134', 'O.03', '', '', 1),
(31, 2, 1, '2018-04-16 11:01:06', 'JORGE LISSANDRO ', 'MUNGIA MACHADO', '', '', '155821371911', '19210872', 'O.04', '', '', 1),
(32, 2, 1, '2018-04-16 11:03:21', 'JOSE ADAM ', 'MINGIA MACHADO', '', '', 'C01134264', '000', 'O.05', '', '', 1),
(33, 2, 1, '2018-04-16 11:04:56', 'LUIS NAPOLEON ', 'CROVETTO CRUZ', '', '', 'C02167650', '000', 'O.06', '', '', 1),
(34, 2, 1, '2018-07-30 23:52:55', 'John', 'Doe', 'JD', 'jd@instatec.com', '105980789', '54654655', '46', '5646897', 'Es un mal colaborador', 1),
(35, 3, 1, '2018-08-02 11:04:54', 'Kevin', 'Barrantes', 'Macho', 'kevin@instatec.cr', '114540051', '11002255', '22556', '66559988', 'Es un excelente colaborador y muy responsable', 1),
(36, 6, 1, '2018-08-15 15:17:15', 'Carlos Roberto', 'Mora Garro', 'Cali', 'cali@instatec.com', '449955005', '333444', '49', '566998845', '', 1),
(37, 6, 1, '2018-08-29 20:15:02', 'Yerson', 'Garro', 'Rata', 'yersongarro@instatec.com', '994888388', '32323223', '323', '993888773', 'excelente colaborador', 1),
(38, 1, 1, '2018-10-05 15:06:14', 'Fabiola', 'Chaves', '', 'fchaves@instateccr.com', '101110555', '123458888', '38', '', '', 1);

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
(26, 19, 2, '2018-02-16 20:35:16', 1200.00, 1),
(27, 1, 2, '2018-03-18 15:27:41', 1750.00, 1),
(28, 21, 2, '2018-04-05 18:57:56', 1000.00, 1),
(29, 20, 2, '2018-04-05 19:00:54', 2000.00, 1),
(30, 22, 2, '2018-04-07 17:18:39', 100.00, 1),
(31, 23, 2, '2018-04-13 12:48:43', 2000.00, 1),
(32, 25, 2, '2018-04-13 18:08:08', 3000.00, 1),
(33, 24, 2, '2018-04-13 18:27:29', 3000.00, 1),
(34, 26, 2, '2018-04-13 18:48:03', 2000.00, 1),
(35, 27, 2, '2018-04-16 10:40:07', 0.00, 1),
(36, 28, 2, '2018-04-16 10:49:37', 0.00, 0),
(37, 28, 2, '2018-04-16 10:52:24', 1650.00, 1),
(38, 29, 2, '2018-04-16 10:55:58', 1850.00, 1),
(39, 30, 2, '2018-04-16 10:57:29', 2100.00, 1),
(40, 31, 2, '2018-04-16 11:01:06', 1950.00, 1),
(41, 32, 2, '2018-04-16 11:03:21', 1700.00, 0),
(42, 33, 2, '2018-04-16 11:04:56', 1900.00, 1),
(43, 32, 2, '2018-04-24 22:37:46', 1700.00, 1),
(44, 34, 2, '2018-07-30 23:52:55', 1000.00, 1),
(45, 35, 2, '2018-08-02 11:04:55', 1200.00, 1),
(46, 36, 2, '2018-08-15 15:17:15', 1100.00, 1),
(47, 37, 2, '2018-08-29 20:15:02', 1000.00, 1),
(48, 38, 2, '2018-10-05 15:08:32', 2000.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador_puesto`
--

CREATE TABLE `colaborador_puesto` (
  `colaborador_puesto_id` int(11) NOT NULL,
  `puesto` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

--
-- Volcado de datos para la tabla `colaborador_puesto`
--

INSERT INTO `colaborador_puesto` (`colaborador_puesto_id`, `puesto`, `fecha_registro`) VALUES
(1, 'Jefe de proyecto', '0000-00-00 00:00:00'),
(2, 'Operario', '0000-00-00 00:00:00'),
(3, 'Operante', '0000-00-00 00:00:00'),
(6, 'Carpintero', '2018-08-07 00:08:26'),
(7, 'Soldador', '2018-08-29 20:25:37');

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
-- Estructura de tabla para la tabla `impuesto`
--

CREATE TABLE `impuesto` (
  `impuesto_id` int(11) NOT NULL,
  `impuesto` float(10,2) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado_registro` int(1) NOT NULL COMMENT '1 = Activo, 2 = Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `material_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `material` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `material_codigo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado_registro` int(1) NOT NULL COMMENT '0 = desactivado, 1 = activado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `material`
--

INSERT INTO `material` (`material_id`, `usuario_id`, `material`, `material_codigo`, `fecha_registro`, `estado_registro`) VALUES
(1, 1, 'Cemento', 'M001', '2018-08-21 00:01:17', 1),
(2, 1, 'Arena', 'M002', '2018-08-21 00:02:45', 1),
(3, 1, 'Block', 'M003', '2018-08-21 00:02:52', 1),
(4, 1, 'Zinc', 'M004', '2018-08-21 00:03:01', 1),
(5, 1, 'Pintura', 'M005', '2018-08-21 00:03:08', 1),
(6, 1, 'Clavos', 'M006', '2018-08-21 00:03:32', 1),
(7, 1, 'Rodillos', 'M007', '2018-08-21 00:03:41', 1),
(8, 1, 'Martillo', 'M008', '2018-09-04 22:59:50', 1),
(9, 1, 'Piedra', 'M009', '2018-09-04 23:02:13', 1),
(10, 1, 'Palas', 'M010', '2018-09-06 00:19:18', 1),
(11, 1, 'Gypsum', 'M101', '2018-10-19 18:20:41', 1),
(12, 1, 'Pasta', 'M102', '2018-10-19 18:26:07', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material_unidad`
--

CREATE TABLE `material_unidad` (
  `material_unidad_id` int(11) NOT NULL,
  `material_unidad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `estado_registro` int(1) NOT NULL COMMENT 'Para registrar si esta activo o inactivo. 1=activo 0=inactivo',
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `material_unidad`
--

INSERT INTO `material_unidad` (`material_unidad_id`, `material_unidad`, `usuario_id`, `estado_registro`, `fecha_registro`) VALUES
(1, 'Caja (s)', 1, 1, '2018-08-18 19:52:44'),
(2, 'Saco (s)', 1, 1, '2018-08-18 19:54:03'),
(3, 'Unidad', 1, 1, '2018-08-18 19:54:10'),
(4, 'Metro cúbico', 1, 1, '2018-08-18 19:54:21'),
(5, 'Metro', 1, 1, '2018-09-13 23:10:58');

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
(1, 1, '2017-12-07 07:42:18', 'MACOPA', '3-101-098885', 1),
(2, 1, '2017-12-11 07:03:30', 'ALUMIMUNDO SA', '3-101-086859-28', 1),
(3, 1, '2017-12-11 07:04:09', 'TECNIGYPSUM SA', '89798798', 1),
(4, 1, '2017-12-17 06:03:47', 'Ferreteria 4', '6565989', 1),
(5, 1, '2018-09-25 21:02:12', 'Proveedor 5', '', 1),
(6, 1, '2018-09-25 21:02:19', 'Proveedor 6', '', 1),
(7, 1, '2018-09-25 21:02:26', 'Proveedor 7', '', 1),
(8, 1, '2018-09-25 21:02:32', 'Proveedor 8', '', 1),
(9, 1, '2018-09-25 21:02:39', 'Proveedor 9', '', 1),
(10, 1, '2018-09-25 21:02:44', 'Proveedor 10', '', 1),
(11, 1, '2018-09-25 21:02:48', 'Proveedor 11', '', 1),
(12, 1, '2018-09-25 21:02:51', 'Proveedor 12', '', 1);

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
(17, 4, 'ferreteria4@proveedor.com'),
(24, 1, 'otalavera@macopa.com '),
(25, 1, 'ebarahona@macopa.com'),
(28, 2, 'cmontero@alumimundo.com'),
(29, 3, 'proveedor3@ferreteria.com'),
(30, 3, 'proveedor3@proveedor.com');

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
(17, 4, '26546513'),
(24, 1, '2010-7332'),
(25, 1, '83918175'),
(28, 2, '41018600'),
(29, 3, '498798465');

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
(7, 1, 10, 23, 3, 324, 1, 'DHL', '2017-12-17 01:46:09', '2019-01-01', '2019-02-13', '2020-12-23', '75888', '96478', 'Centro Corporativo Cafetal', 'Proyecto 7 observaciones'),
(17, 1, 15, 23, 2, 324, 1, 'ALIGN', '2018-04-13 14:24:28', '2017-12-26', '2018-04-14', '2018-04-20', '', '', 'ZONA FRANCA BELEN BUSINES CENTER', 'Falta Cargar Datos de valor contractual '),
(18, 1, 4, 23, 2, 290, 1, 'SAPB TORRE 2', '2018-04-13 15:12:55', '2018-03-30', '2018-03-31', '2018-06-30', '', '', 'BELEN BUSSINES CENTER', ''),
(19, 1, 4, 23, 2, 324, 1, 'SAPB SOTANOS', '2018-04-13 15:19:39', '2018-03-30', '2018-04-02', '2018-04-30', '', '', 'CENTRO CORPORATIVO BELEN BUSSINES CENTER', 'FALTA AGREGAR DESGLOSE DE COSTOS Y UTILIDADES '),
(20, 1, 13, 24, 2, 0, 1, 'APM TERMINALS', '2018-04-16 19:45:10', '2017-12-14', '2017-12-14', '2018-06-30', '', '', '', ''),
(21, 1, 15, 38, 2, 12, 1, '203 Guachipelin ', '2018-04-24 15:13:35', '2017-11-15', '2017-11-16', '2018-05-12', 'Paredes y Cielos Livianos', '', 'Guachipelin de Escazú ', 'Falta verificar materiales y mano de Obra');

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
(14, 15, 1, 1, '2018-02-13 08:53:03', 0),
(17, 16, 14, 1, '2018-02-15 06:12:23', 0),
(18, 16, 17, 1, '2018-02-15 06:12:44', 0),
(19, 16, 6, 2, '2018-02-15 06:13:37', 1),
(20, 2, 6, 2, '2018-02-14 23:56:48', 1),
(21, 1, 14, 1, '2018-02-15 23:51:17', 1),
(22, 3, 18, 1, '2018-02-16 20:37:29', 1),
(23, 3, 19, 2, '2018-02-16 20:38:36', 1),
(24, 3, 6, 2, '2018-02-16 20:38:49', 1),
(25, 1, 15, 2, '2018-02-16 21:37:43', 1),
(26, 15, 14, 1, '2018-03-04 17:10:33', 1),
(27, 4, 1, 1, '2018-03-18 14:52:53', 1),
(28, 1, 16, 2, '2018-04-05 18:45:13', 1),
(29, 1, 21, 2, '2018-04-05 18:58:54', 1),
(30, 16, 20, 1, '2018-04-05 18:59:57', 1),
(31, 7, 23, 1, '2018-04-13 12:50:55', 1),
(32, 17, 23, 1, '2018-04-13 14:24:28', 1),
(33, 18, 23, 1, '2018-04-13 15:12:55', 1),
(34, 19, 23, 1, '2018-04-13 15:19:39', 1),
(35, 17, 26, 2, '2018-04-16 10:16:04', 1),
(36, 20, 24, 1, '2018-04-16 19:45:10', 1),
(37, 21, 24, 1, '2018-04-24 15:13:35', 0),
(38, 21, 28, 2, '2018-04-25 22:01:54', 1),
(39, 21, 29, 2, '2018-04-25 22:15:22', 1),
(40, 21, 30, 2, '2018-04-25 22:30:18', 1),
(41, 21, 31, 2, '2018-04-25 22:30:45', 1),
(42, 21, 32, 2, '2018-04-25 22:30:56', 1),
(43, 21, 33, 2, '2018-04-25 22:42:06', 1),
(44, 21, 26, 2, '2018-04-25 22:42:17', 1),
(45, 7, 28, 2, '2018-04-25 22:42:40', 0),
(46, 7, 29, 2, '2018-04-25 22:42:50', 1),
(47, 7, 31, 2, '2018-08-02 13:07:34', 1),
(48, 7, 33, 2, '2018-08-02 13:07:42', 1),
(49, 17, 30, 2, '2018-08-02 22:10:32', 1),
(50, 17, 31, 2, '2018-08-02 22:17:48', 1),
(51, 21, 36, 2, '2018-08-15 15:17:15', 1),
(52, 7, 37, 2, '2018-08-29 20:15:03', 1),
(53, 21, 38, 1, '2018-10-05 15:09:16', 1);

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
(15, 7, 1, 4, '2017-12-29 05:48:32', '2017-12-29', 0),
(61, 17, 1, 4, '2018-04-13 14:24:28', '2018-04-13', 0),
(62, 17, 1, 1, '2018-04-13 14:46:11', '2018-04-13', 0),
(63, 18, 1, 4, '2018-04-13 15:12:55', '2018-04-13', 0),
(64, 19, 1, 4, '2018-04-13 15:19:39', '2018-04-13', 0),
(66, 18, 19, 1, '2018-04-16 08:49:18', '2018-04-13', 0),
(67, 18, 19, 1, '2018-04-16 08:50:42', '2018-04-13', 0),
(68, 18, 19, 1, '2018-04-16 08:51:34', '2018-04-12', 0),
(69, 18, 19, 1, '2018-04-16 08:52:25', '2018-04-09', 0),
(70, 18, 19, 1, '2018-04-16 08:53:35', '2018-04-09', 0),
(71, 18, 19, 1, '2018-04-16 08:54:23', '2018-04-07', 0),
(72, 18, 19, 1, '2018-04-16 08:55:07', '2018-04-06', 0),
(73, 18, 19, 1, '2018-04-16 08:55:49', '2018-04-04', 0),
(74, 18, 19, 1, '2018-04-16 08:57:14', '2018-04-05', 0),
(75, 20, 1, 4, '2018-04-16 19:45:10', '2018-04-16', 0),
(76, 18, 19, 1, '2018-04-17 14:56:28', '2018-04-17', 0),
(77, 18, 19, 1, '2018-04-17 14:57:28', '2018-04-17', 0),
(78, 18, 19, 1, '2018-04-23 10:38:10', '2018-04-20', 0),
(79, 18, 19, 1, '2018-04-23 10:39:35', '2018-04-20', 0),
(80, 18, 19, 1, '2018-04-23 10:40:22', '2018-04-20', 0),
(81, 18, 19, 1, '2018-04-23 10:41:52', '2018-04-20', 0),
(82, 18, 19, 1, '2018-04-23 10:42:53', '2018-04-20', 0),
(83, 21, 1, 4, '2018-04-24 15:13:35', '2018-04-24', 0),
(84, 21, 1, 2, '2018-07-26 23:13:24', '2018-07-26', 1),
(85, 7, 1, 1, '2018-08-02 12:54:39', '2018-08-02', 0),
(86, 7, 1, 2, '2018-08-02 13:08:20', '2018-08-02', 1),
(87, 7, 1, 2, '2018-08-02 13:08:53', '2018-08-01', 1),
(88, 17, 1, 2, '2018-08-02 21:18:00', '2018-08-01', 1),
(89, 17, 1, 2, '2018-08-02 22:26:15', '2018-07-31', 1),
(90, 17, 1, 2, '2018-08-02 22:27:20', '2018-08-02', 1),
(91, 7, 1, 2, '2018-08-29 20:18:37', '2018-08-29', 1),
(97, 7, 1, 1, '2018-10-19 18:57:41', '2018-10-19', 1),
(98, 7, 1, 1, '2018-10-19 19:02:48', '2018-10-19', 1),
(99, 20, 1, 1, '2018-10-23 01:30:08', '2018-10-23', 1),
(100, 20, 1, 1, '2018-10-23 01:33:58', '2018-10-23', 1),
(101, 20, 1, 1, '2018-10-23 01:34:01', '2018-10-23', 1),
(102, 20, 1, 1, '2018-10-23 01:34:07', '2018-10-23', 1),
(103, 20, 1, 1, '2018-10-23 01:34:10', '2018-10-23', 1),
(104, 21, 1, 1, '2018-10-23 19:43:53', '2018-10-23', 1),
(105, 21, 1, 1, '2018-10-23 19:44:02', '2018-10-23', 1),
(106, 21, 1, 1, '2018-10-23 19:44:30', '2018-10-23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_gasto_detalle`
--

CREATE TABLE `proyecto_gasto_detalle` (
  `proyecto_gasto_detalle_id` int(11) NOT NULL,
  `proyecto_gasto_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `proyecto_gasto_estado_id` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `gasto_detalle` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_gasto_detalle`
--

INSERT INTO `proyecto_gasto_detalle` (`proyecto_gasto_detalle_id`, `proyecto_gasto_id`, `proveedor_id`, `proyecto_gasto_estado_id`, `numero_factura`, `gasto_detalle`) VALUES
(13, 62, 1, 1, 0, ''),
(15, 66, 1, 1, 936387, ''),
(16, 67, 1, 1, 936389, ''),
(17, 68, 1, 1, 936046, ''),
(18, 69, 1, 1, 935553, ''),
(19, 70, 1, 1, 935546, ''),
(20, 71, 1, 1, 935380, ''),
(21, 72, 1, 1, 935170, ''),
(22, 73, 1, 1, 934798, ''),
(23, 74, 3, 2, 549447, ''),
(24, 76, 1, 1, 936807, ''),
(25, 77, 1, 1, 936808, ''),
(26, 78, 1, 1, 937596, ''),
(27, 79, 1, 1, 937595, ''),
(28, 80, 1, 1, 937535, ''),
(29, 81, 3, 2, 552058, ''),
(30, 82, 1, 1, 937594, ''),
(31, 85, 1, 2, 125896, 'Se compró herramienta para carpintería como Martillos, Clavos y sinceles. También pintura blanca.'),
(37, 97, 3, 2, 0, 'Gasto registrado por orden de compra de materiales # 7. El link para descargar el archivo es http://instatec.net/controlcostos/instatec_pub/files/proyectos/7/ordenes_compra/Orden_Compra_7_TECNIGYPSUM_SA_2018_10_19.pdf'),
(38, 98, 3, 2, 0, 'Gasto registrado por orden de compra de materiales # 8. El link para descargar el archivo es http://instatec.net/controlcostos/instatec_pub/files/proyectos/7/ordenes_compra/Orden_Compra_8_TECNIGYPSUM_SA_2018_10_19.pdf'),
(39, 99, 5, 2, 0, 'Gasto registrado por orden de compra de materiales # 9. El link para descargar el archivo es http://instatec.net/controlcostos/instatec_pub/files/proyectos/20/ordenes_compra/Orden_Compra_9_Proveedor_5_2018_10_23.pdf'),
(40, 100, 1, 2, 0, 'Gasto registrado por orden de compra de materiales # 15. El link para descargar el archivo es http://instatec.net/controlcostos/instatec_pub/files/proyectos/20/ordenes_compra/Orden_Compra_15_MACOPA_2018_10_23.pdf'),
(41, 101, 2, 2, 0, 'Gasto registrado por orden de compra de materiales # 11. El link para descargar el archivo es http://instatec.net/controlcostos/instatec_pub/files/proyectos/20/ordenes_compra/Orden_Compra_11_ALUMIMUNDO_SA_2018_10_23.pdf'),
(42, 102, 3, 2, 0, 'Gasto registrado por orden de compra de materiales # 12. El link para descargar el archivo es http://instatec.net/controlcostos/instatec_pub/files/proyectos/20/ordenes_compra/Orden_Compra_12_TECNIGYPSUM_SA_2018_10_23.pdf'),
(43, 103, 4, 2, 0, 'Gasto registrado por orden de compra de materiales # 14. El link para descargar el archivo es http://instatec.net/controlcostos/instatec_pub/files/proyectos/20/ordenes_compra/Orden_Compra_14_Ferreteria_4_2018_10_23.pdf'),
(44, 104, 4, 2, 0, 'Gasto registrado por orden de compra de materiales # 4. El link para descargar el archivo es http://instatec.net/controlcostos/instatec_pub/files/proyectos/21/ordenes_compra/Orden_Compra_4_Ferreteria_4_2018_10_15.pdf'),
(45, 105, 5, 2, 0, 'Gasto registrado por orden de compra de materiales # 3. El link para descargar el archivo es http://instatec.net/controlcostos/instatec_pub/files/proyectos/21/ordenes_compra/Orden_Compra_3_Proveedor_5_2018_10_15.pdf'),
(46, 106, 4, 2, 0, 'Gasto registrado por orden de compra de materiales # 5. El link para descargar el archivo es http://instatec.net/controlcostos/instatec_pub/files/proyectos/21/ordenes_compra/Orden_Compra_5_Ferreteria_4_2018_10_17.pdf');

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
  `cantidad_horas_extra` float(6,2) NOT NULL,
  `costo_hora_mano_obra` float(10,2) NOT NULL,
  `estado_registro` int(2) NOT NULL COMMENT '0 = inactivo, 1 = activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_gasto_mano_obra`
--

INSERT INTO `proyecto_gasto_mano_obra` (`proyecto_gasto_mano_obra_id`, `proyecto_gasto_id`, `proyecto_colaborador_id`, `usuario_id`, `fecha_registro`, `cantidad_horas`, `cantidad_horas_extra`, `costo_hora_mano_obra`, `estado_registro`) VALUES
(1, 84, 36, 1, '2018-07-26 23:13:24', 1.50, 0.00, 3000.00, 0),
(2, 84, 41, 1, '2018-07-26 23:13:24', 0.00, 0.00, 1950.00, 0),
(3, 84, 43, 1, '2018-07-26 23:13:24', 0.00, 0.00, 1900.00, 0),
(4, 84, 42, 1, '2018-07-26 23:13:24', 0.00, 0.00, 1700.00, 0),
(5, 84, 35, 1, '2018-07-26 23:13:24', 0.00, 0.00, 2000.00, 0),
(6, 84, 38, 1, '2018-07-26 23:13:25', 0.00, 0.00, 1650.00, 0),
(7, 84, 39, 1, '2018-07-26 23:13:25', 0.00, 0.00, 1850.00, 0),
(8, 84, 40, 1, '2018-07-26 23:13:25', 0.00, 0.00, 2100.00, 0),
(9, 84, 36, 1, '2018-07-26 23:14:50', 2.50, 0.00, 3000.00, 0),
(10, 84, 42, 1, '2018-07-26 23:14:50', 0.00, 0.00, 1700.00, 0),
(11, 84, 40, 1, '2018-07-26 23:14:50', 0.00, 0.00, 2100.00, 0),
(12, 84, 35, 1, '2018-07-26 23:14:51', 0.00, 0.00, 2000.00, 0),
(13, 84, 41, 1, '2018-07-26 23:14:51', 0.00, 0.00, 1950.00, 0),
(14, 84, 38, 1, '2018-07-26 23:14:51', 0.00, 0.00, 1650.00, 0),
(15, 84, 43, 1, '2018-07-26 23:14:51', 0.00, 0.00, 1900.00, 0),
(16, 84, 39, 1, '2018-07-26 23:14:51', 0.00, 0.00, 1850.00, 0),
(17, 84, 36, 1, '2018-07-27 00:27:40', 2.50, 1.50, 3000.00, 0),
(18, 84, 41, 1, '2018-07-27 00:27:40', 0.00, 0.00, 1950.00, 0),
(19, 84, 42, 1, '2018-07-27 00:27:40', 0.00, 0.00, 1700.00, 0),
(20, 84, 38, 1, '2018-07-27 00:27:40', 0.00, 0.00, 1650.00, 0),
(21, 84, 40, 1, '2018-07-27 00:27:40', 0.00, 0.00, 2100.00, 0),
(22, 84, 43, 1, '2018-07-27 00:27:40', 0.00, 0.00, 1900.00, 0),
(23, 84, 35, 1, '2018-07-27 00:27:40', 0.00, 0.00, 2000.00, 0),
(24, 84, 39, 1, '2018-07-27 00:27:40', 0.00, 0.00, 1850.00, 0),
(25, 84, 36, 1, '2018-07-27 00:34:41', 2.50, 1.50, 3000.00, 1),
(26, 84, 41, 1, '2018-07-27 00:34:41', 0.00, 0.00, 1950.00, 1),
(27, 84, 42, 1, '2018-07-27 00:34:41', 0.00, 0.00, 1700.00, 1),
(28, 84, 38, 1, '2018-07-27 00:34:42', 0.00, 0.00, 1650.00, 1),
(29, 84, 40, 1, '2018-07-27 00:34:42', 0.00, 0.00, 2100.00, 1),
(30, 84, 43, 1, '2018-07-27 00:34:42', 0.00, 0.00, 1900.00, 1),
(31, 84, 35, 1, '2018-07-27 00:34:42', 0.00, 0.00, 2000.00, 1),
(32, 84, 39, 1, '2018-07-27 00:34:42', 0.00, 0.00, 1850.00, 1),
(33, 86, 31, 1, '2018-08-02 13:08:20', 0.00, 0.00, 2000.00, 0),
(34, 86, 38, 1, '2018-08-02 13:08:20', 8.00, 1.50, 1650.00, 0),
(35, 86, 39, 1, '2018-08-02 13:08:20', 9.00, 0.00, 1850.00, 0),
(36, 86, 41, 1, '2018-08-02 13:08:20', 8.00, 0.00, 1950.00, 0),
(37, 86, 43, 1, '2018-08-02 13:08:20', 8.00, 0.00, 1900.00, 0),
(38, 87, 31, 1, '2018-08-02 13:08:53', 8.00, 0.00, 2000.00, 1),
(39, 87, 38, 1, '2018-08-02 13:08:53', 8.00, 0.00, 1650.00, 1),
(40, 87, 39, 1, '2018-08-02 13:08:53', 8.00, 0.00, 1850.00, 1),
(41, 87, 41, 1, '2018-08-02 13:08:53', 7.00, 0.00, 1950.00, 1),
(42, 87, 43, 1, '2018-08-02 13:08:53', 6.50, 0.00, 1900.00, 1),
(43, 86, 31, 1, '2018-08-02 13:09:02', 4.50, 0.00, 2000.00, 0),
(44, 86, 38, 1, '2018-08-02 13:09:02', 8.00, 1.50, 1650.00, 0),
(45, 86, 39, 1, '2018-08-02 13:09:02', 9.00, 0.00, 1850.00, 0),
(46, 86, 41, 1, '2018-08-02 13:09:02', 8.00, 0.00, 1950.00, 0),
(47, 86, 43, 1, '2018-08-02 13:09:02', 8.00, 0.00, 1900.00, 0),
(48, 86, 31, 1, '2018-08-02 13:21:16', 4.50, 0.00, 2000.00, 0),
(49, 86, 38, 1, '2018-08-02 13:21:16', 8.00, 1.50, 1650.00, 0),
(50, 86, 39, 1, '2018-08-02 13:21:16', 9.00, 0.00, 1850.00, 0),
(51, 86, 41, 1, '2018-08-02 13:21:16', 8.00, 0.00, 1950.00, 0),
(52, 86, 43, 1, '2018-08-02 13:21:16', 8.00, 0.00, 1900.00, 0),
(53, 86, 31, 1, '2018-08-02 13:22:30', 4.50, 0.00, 2000.00, 0),
(54, 86, 38, 1, '2018-08-02 13:22:30', 8.00, 1.50, 1650.00, 0),
(55, 86, 39, 1, '2018-08-02 13:22:30', 9.00, 0.00, 1850.00, 0),
(56, 86, 41, 1, '2018-08-02 13:22:30', 8.00, 0.00, 1950.00, 0),
(57, 86, 43, 1, '2018-08-02 13:22:30', 8.00, 0.00, 1900.00, 0),
(58, 86, 31, 1, '2018-08-02 13:32:21', 4.50, 0.00, 2000.00, 0),
(59, 86, 38, 1, '2018-08-02 13:32:21', 8.00, 1.50, 1650.00, 0),
(60, 86, 39, 1, '2018-08-02 13:32:21', 9.00, 0.00, 1850.00, 0),
(61, 86, 41, 1, '2018-08-02 13:32:21', 8.00, 0.00, 1950.00, 0),
(62, 86, 43, 1, '2018-08-02 13:32:21', 8.00, 0.00, 1900.00, 0),
(63, 86, 31, 1, '2018-08-02 13:38:11', 4.50, 0.00, 2000.00, 0),
(64, 86, 38, 1, '2018-08-02 13:38:11', 8.50, 1.50, 1650.00, 0),
(65, 86, 39, 1, '2018-08-02 13:38:11', 9.00, 0.00, 1850.00, 0),
(66, 86, 41, 1, '2018-08-02 13:38:11', 8.00, 0.00, 1950.00, 0),
(67, 86, 43, 1, '2018-08-02 13:38:11', 8.00, 0.00, 1900.00, 0),
(68, 86, 31, 1, '2018-08-02 13:51:41', 4.50, 0.00, 2000.00, 0),
(69, 86, 38, 1, '2018-08-02 13:51:41', 8.65, 1.50, 1650.00, 0),
(70, 86, 39, 1, '2018-08-02 13:51:41', 9.00, 0.00, 1850.00, 0),
(71, 86, 41, 1, '2018-08-02 13:51:41', 8.00, 0.00, 1950.00, 0),
(72, 86, 43, 1, '2018-08-02 13:51:41', 8.00, 0.00, 1900.00, 0),
(73, 86, 31, 1, '2018-08-02 15:42:04', 4.50, 0.00, 2000.00, 1),
(74, 86, 38, 1, '2018-08-02 15:42:04', 8.65, 1.50, 1650.00, 1),
(75, 86, 39, 1, '2018-08-02 15:42:04', 9.25, 0.00, 1850.00, 1),
(76, 86, 41, 1, '2018-08-02 15:42:04', 8.00, 0.00, 1950.00, 1),
(77, 86, 43, 1, '2018-08-02 15:42:04', 8.00, 0.00, 1900.00, 1),
(78, 88, 31, 1, '2018-08-02 21:18:00', 8.00, 0.00, 2000.00, 1),
(79, 88, 35, 1, '2018-08-02 21:18:00', 8.00, 0.00, 2000.00, 1),
(80, 89, 31, 1, '2018-08-02 22:26:16', 6.00, 2.00, 2000.00, 1),
(81, 89, 35, 1, '2018-08-02 22:26:16', 8.00, 1.00, 2000.00, 1),
(82, 89, 41, 1, '2018-08-02 22:26:16', 9.00, 0.50, 1950.00, 1),
(83, 90, 31, 1, '2018-08-02 22:27:21', 6.00, 1.00, 2000.00, 1),
(84, 90, 35, 1, '2018-08-02 22:27:21', 8.00, 0.00, 2000.00, 1),
(85, 90, 40, 1, '2018-08-02 22:27:21', 7.00, 2.50, 2100.00, 1),
(86, 90, 41, 1, '2018-08-02 22:27:21', 7.00, 1.50, 1950.00, 1),
(87, 91, 31, 1, '2018-08-29 20:18:37', 1.50, 0.00, 2000.00, 1),
(88, 91, 39, 1, '2018-08-29 20:18:38', 0.00, 0.00, 1850.00, 1),
(89, 91, 41, 1, '2018-08-29 20:18:38', 0.00, 0.00, 1950.00, 1),
(90, 91, 43, 1, '2018-08-29 20:18:38', 0.00, 0.00, 1900.00, 1),
(91, 91, 52, 1, '2018-08-29 20:18:38', 0.00, 0.00, 1000.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_gasto_material`
--

CREATE TABLE `proyecto_gasto_material` (
  `proyecto_gasto_material_id` int(11) NOT NULL,
  `proyecto_gasto_id` int(11) NOT NULL,
  `proyecto_material_solicitud_compra_orden_compra_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_gasto_material`
--

INSERT INTO `proyecto_gasto_material` (`proyecto_gasto_material_id`, `proyecto_gasto_id`, `proyecto_material_solicitud_compra_orden_compra_id`) VALUES
(5, 97, 7),
(6, 98, 8),
(7, 99, 9),
(8, 100, 15),
(9, 101, 11),
(10, 102, 12),
(11, 103, 14),
(12, 104, 4),
(13, 105, 3),
(14, 106, 5);

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
(24, 15, 1, 3698.85, 1, '2017-12-29 05:48:32'),
(91, 61, 1, 3000.00, 1, '2018-04-13 14:24:28'),
(92, 62, 1, 100000.00, 1, '2018-04-13 14:46:11'),
(93, 63, 1, 0.00, 0, '2018-04-13 15:12:55'),
(94, 64, 1, 0.00, 1, '2018-04-13 15:19:39'),
(96, 63, 1, 3500.00, 1, '2018-04-13 18:39:03'),
(97, 66, 1, 357.57, 1, '2018-04-16 08:49:18'),
(98, 67, 1, 6750.67, 1, '2018-04-16 08:50:42'),
(99, 68, 1, 12.53, 1, '2018-04-16 08:51:34'),
(100, 69, 1, 9309.48, 1, '2018-04-16 08:52:25'),
(101, 70, 1, 771.77, 1, '2018-04-16 08:53:35'),
(102, 71, 1, 95.80, 1, '2018-04-16 08:54:23'),
(103, 72, 1, 612.68, 1, '2018-04-16 08:55:07'),
(104, 73, 1, 170.21, 1, '2018-04-16 08:55:49'),
(105, 74, 1, 4432.81, 1, '2018-04-16 08:57:14'),
(106, 75, 1, 4000.00, 1, '2018-04-16 19:45:10'),
(107, 76, 1, 7914.53, 1, '2018-04-17 14:56:28'),
(108, 77, 1, 823.06, 1, '2018-04-17 14:57:28'),
(109, 78, 1, 1038.29, 1, '2018-04-23 10:38:10'),
(110, 79, 1, 2062.96, 1, '2018-04-23 10:39:35'),
(111, 80, 1, 612.68, 1, '2018-04-23 10:40:22'),
(112, 81, 1, 3858.00, 1, '2018-04-23 10:41:52'),
(113, 82, 1, 13068.67, 1, '2018-04-23 10:42:53'),
(114, 83, 1, 3000.00, 1, '2018-04-24 15:13:35'),
(115, 84, 2, 4500.00, 0, '2018-07-26 23:13:25'),
(116, 84, 2, 7500.00, 0, '2018-07-26 23:14:51'),
(117, 84, 2, 14250.00, 1, '2018-07-27 00:27:41'),
(118, 85, 2, 150000.00, 1, '2018-08-02 12:54:39'),
(119, 86, 2, 64362.50, 0, '2018-08-02 13:08:20'),
(120, 87, 2, 70000.00, 1, '2018-08-02 13:08:53'),
(121, 86, 2, 73362.50, 0, '2018-08-02 13:09:02'),
(122, 86, 2, 74187.50, 0, '2018-08-02 13:38:11'),
(123, 86, 2, 74435.00, 0, '2018-08-02 13:51:41'),
(124, 86, 2, 74897.50, 1, '2018-08-02 15:42:04'),
(125, 88, 2, 32000.00, 1, '2018-08-02 21:18:00'),
(126, 89, 2, 56012.50, 1, '2018-08-02 22:26:16'),
(127, 90, 2, 71612.50, 1, '2018-08-02 22:27:21'),
(128, 91, 2, 3000.00, 1, '2018-08-29 20:18:38'),
(134, 97, 2, 12000.00, 1, '2018-10-19 18:57:41'),
(135, 98, 2, 18000.00, 1, '2018-10-19 19:02:48'),
(136, 99, 1, 5000.00, 1, '2018-10-23 01:30:08'),
(137, 100, 1, 1000.00, 1, '2018-10-23 01:33:58'),
(138, 101, 1, 4000.00, 1, '2018-10-23 01:34:02'),
(139, 102, 2, 30000.00, 1, '2018-10-23 01:34:07'),
(140, 103, 1, 400.00, 1, '2018-10-23 01:34:10'),
(141, 104, 2, 37466.67, 1, '2018-10-23 19:43:53'),
(142, 105, 2, 909.09, 1, '2018-10-23 19:44:02'),
(143, 106, 2, 18666.67, 1, '2018-10-23 19:44:30');

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
-- Estructura de tabla para la tabla `proyecto_material`
--

CREATE TABLE `proyecto_material` (
  `proyecto_material_id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `material_unidad_id` int(11) NOT NULL,
  `proyecto_material_estado_id` int(11) NOT NULL,
  `proyecto_material_tipo` int(11) NOT NULL,
  `cantidad` float(20,2) NOT NULL,
  `comentario` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `estado_registro` int(1) NOT NULL COMMENT '1 = activo, 0 = inactivo',
  `fecha_registro` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_material`
--

INSERT INTO `proyecto_material` (`proyecto_material_id`, `proyecto_id`, `material_id`, `usuario_id`, `material_unidad_id`, `proyecto_material_estado_id`, `proyecto_material_tipo`, `cantidad`, `comentario`, `estado_registro`, `fecha_registro`) VALUES
(7, 21, 4, 1, 3, 2, 1, 20.50, 'Teja', 1, '2018-09-06 00:17:32'),
(8, 21, 1, 1, 2, 2, 1, 12.00, 'Holcim', 1, '2018-09-06 00:18:35'),
(9, 21, 10, 1, 3, 3, 1, 15.00, 'Truper', 1, '2018-09-06 00:19:18'),
(10, 21, 1, 1, 2, 2, 2, 5.00, 'Cemex', 1, '2018-09-06 00:37:50'),
(11, 21, 10, 1, 3, 4, 2, 1.00, 'Truper', 1, '2018-09-06 00:40:08'),
(12, 21, 1, 1, 2, 2, 2, 8.00, 'Holcim', 1, '2018-09-06 00:40:26'),
(13, 21, 8, 1, 3, 1, 2, 2.00, '', 0, '2018-09-09 22:38:39'),
(14, 21, 8, 1, 3, 3, 1, 11.00, 'Marca Thor 3', 1, '2018-09-09 22:39:05'),
(15, 21, 6, 1, 1, 2, 1, 5.00, 'Clavos de 1.5\"', 1, '2018-09-10 01:16:26'),
(16, 21, 6, 1, 1, 2, 2, 10.00, 'Clavos de 1.5\"', 1, '2018-09-10 01:16:44'),
(17, 7, 1, 1, 2, 1, 1, 20.00, '', 0, '2018-09-26 22:52:14'),
(18, 7, 11, 1, 5, 2, 1, 15.00, 'Blanco', 1, '2018-10-19 18:23:36'),
(19, 7, 11, 1, 5, 2, 2, 5.00, 'Negro', 1, '2018-10-19 18:24:36'),
(20, 7, 12, 1, 3, 4, 1, 5.00, 'Blanca', 1, '2018-10-19 18:26:08'),
(21, 20, 1, 1, 2, 3, 1, 10.00, 'Holcim', 1, '2018-10-22 23:36:47'),
(22, 20, 2, 1, 4, 3, 1, 10.00, '', 1, '2018-10-22 23:36:57'),
(23, 20, 3, 1, 3, 3, 1, 10.00, '', 1, '2018-10-22 23:37:06'),
(24, 20, 4, 1, 3, 3, 1, 10.00, '', 1, '2018-10-22 23:37:17'),
(25, 20, 1, 1, 2, 3, 2, 10.00, '', 1, '2018-10-22 23:37:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_material_detalle`
--

CREATE TABLE `proyecto_material_detalle` (
  `proyecto_material_detalle_id` int(11) NOT NULL,
  `proyecto_material_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `moneda_id` int(11) NOT NULL,
  `precio` float(20,2) NOT NULL,
  `tiene_impuesto` int(1) NOT NULL COMMENT '1 = Si, 0 = No',
  `impuesto` float(10,2) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado_registro` int(1) NOT NULL COMMENT '1 = Si, 0 = No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_material_detalle`
--

INSERT INTO `proyecto_material_detalle` (`proyecto_material_detalle_id`, `proyecto_material_id`, `usuario_id`, `proveedor_id`, `moneda_id`, `precio`, `tiene_impuesto`, `impuesto`, `fecha_registro`, `estado_registro`) VALUES
(1, 7, 1, 1, 1, 15000.00, 1, 13.00, '2018-09-27 00:09:46', 1),
(2, 8, 1, 2, 1, 20000.00, 0, 0.00, '2018-09-27 00:10:03', 0),
(3, 9, 1, 4, 2, 50000.00, 0, 0.00, '2018-09-27 00:10:14', 0),
(4, 14, 1, 5, 2, 10000.00, 0, 0.00, '2018-09-27 00:10:25', 0),
(5, 15, 1, 4, 2, 15000.00, 0, 0.00, '2018-09-27 00:10:39', 0),
(6, 10, 1, 7, 1, 1500.00, 0, 0.00, '2018-09-27 00:13:08', 0),
(7, 11, 1, 4, 2, 30000.00, 0, 0.00, '2018-09-27 00:13:16', 1),
(8, 12, 1, 7, 1, 3000.00, 0, 0.00, '2018-09-27 00:13:27', 0),
(9, 16, 1, 4, 2, 1500.00, 0, 0.00, '2018-09-27 00:13:35', 1),
(10, 8, 1, 2, 1, 20000.00, 1, 14.00, '2018-09-28 19:38:38', 1),
(11, 14, 1, 5, 2, 10000.00, 1, 13.30, '2018-09-28 19:47:31', 0),
(12, 9, 1, 4, 2, 50000.00, 1, 12.00, '2018-09-28 19:47:43', 1),
(13, 14, 1, 5, 2, 10000.00, 0, 0.00, '2018-09-28 19:47:56', 1),
(14, 15, 1, 4, 2, 150000.00, 1, 10.00, '2018-10-04 00:28:39', 0),
(15, 15, 1, 4, 2, 150000.00, 1, 11.00, '2018-10-04 00:29:24', 0),
(16, 15, 1, 4, 2, 150000.00, 1, 12.00, '2018-10-04 00:29:40', 0),
(17, 15, 1, 4, 2, 150000.00, 1, 12.00, '2018-10-04 00:31:06', 0),
(18, 15, 1, 4, 2, 150000.00, 1, 12.00, '2018-10-04 00:32:02', 0),
(19, 15, 1, 4, 2, 150000.00, 1, 12.00, '2018-10-04 00:32:57', 0),
(20, 15, 1, 4, 2, 150000.00, 1, 11.00, '2018-10-04 00:33:09', 0),
(21, 15, 1, 6, 2, 15000.00, 1, 11.00, '2018-10-04 00:34:03', 1),
(22, 10, 1, 7, 1, 1550.00, 1, 1.00, '2018-10-04 00:34:25', 1),
(23, 12, 1, 7, 1, 3200.00, 1, 10.00, '2018-10-04 00:50:37', 1),
(24, 18, 0, 0, 0, 0.00, 0, 0.00, '2018-10-19 18:23:36', 0),
(25, 19, 0, 0, 0, 0.00, 0, 0.00, '2018-10-19 18:24:36', 1),
(26, 20, 0, 0, 0, 0.00, 0, 0.00, '2018-10-19 18:26:08', 0),
(27, 18, 1, 12, 1, 2500.00, 1, 14.00, '2018-10-19 18:44:25', 0),
(28, 18, 1, 12, 1, 2500.00, 1, 14.00, '2018-10-19 18:44:27', 0),
(29, 18, 1, 12, 1, 2500.00, 1, 14.00, '2018-10-19 18:44:29', 0),
(30, 18, 1, 12, 1, 2500.00, 1, 14.00, '2018-10-19 18:44:45', 0),
(31, 18, 1, 12, 1, 2500.00, 1, 14.00, '2018-10-19 18:45:19', 1),
(32, 20, 1, 3, 2, 30000.00, 0, 0.00, '2018-10-19 18:45:46', 1),
(33, 21, 0, 0, 0, 0.00, 0, 0.00, '2018-10-22 23:36:47', 0),
(34, 22, 0, 0, 0, 0.00, 0, 0.00, '2018-10-22 23:36:57', 0),
(35, 23, 0, 0, 0, 0.00, 0, 0.00, '2018-10-22 23:37:06', 0),
(36, 24, 0, 0, 0, 0.00, 0, 0.00, '2018-10-22 23:37:17', 0),
(37, 25, 0, 0, 0, 0.00, 0, 0.00, '2018-10-22 23:37:37', 0),
(38, 21, 1, 1, 1, 10000.00, 0, 0.00, '2018-10-23 00:49:04', 0),
(39, 22, 1, 2, 1, 20000.00, 0, 0.00, '2018-10-23 00:49:19', 0),
(40, 23, 1, 3, 2, 100000.00, 0, 0.00, '2018-10-23 00:49:30', 0),
(41, 24, 1, 4, 1, 1000.00, 0, 0.00, '2018-10-23 00:49:42', 0),
(42, 25, 1, 5, 1, 10000.00, 0, 0.00, '2018-10-23 01:04:12', 0),
(43, 25, 1, 5, 1, 10000.00, 0, 0.00, '2018-10-23 01:05:57', 0),
(44, 25, 1, 5, 1, 10000.00, 0, 0.00, '2018-10-23 01:07:15', 0),
(45, 25, 1, 5, 1, 10000.00, 0, 0.00, '2018-10-23 01:10:43', 1),
(46, 21, 1, 1, 1, 10000.00, 0, 0.00, '2018-10-23 01:13:36', 1),
(47, 22, 1, 2, 1, 20000.00, 0, 0.00, '2018-10-23 01:13:42', 1),
(48, 23, 1, 3, 2, 100000.00, 0, 0.00, '2018-10-23 01:13:44', 1),
(49, 24, 1, 4, 1, 1000.00, 0, 0.00, '2018-10-23 01:13:46', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_material_estado`
--

CREATE TABLE `proyecto_material_estado` (
  `proyecto_material_estado_id` int(11) NOT NULL,
  `proyecto_material_estado` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_material_estado`
--

INSERT INTO `proyecto_material_estado` (`proyecto_material_estado_id`, `proyecto_material_estado`) VALUES
(1, 'Sin cotizar'),
(2, 'Cotizado'),
(3, 'Parcialmente Consumido'),
(4, 'Consumido');

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

--
-- Volcado de datos para la tabla `proyecto_material_solicitud_compra`
--

INSERT INTO `proyecto_material_solicitud_compra` (`proyecto_material_solicitud_compra_id`, `proyecto_id`, `usuario_id`, `proyecto_material_solicitud_compra_estado_id`, `fecha_registro`) VALUES
(1, 21, 1, 4, '2018-10-04 23:05:10'),
(2, 21, 25, 4, '2018-10-05 15:37:57'),
(3, 7, 1, 2, '2018-10-19 18:47:00'),
(4, 7, 1, 2, '2018-10-19 19:00:52'),
(5, 21, 25, 2, '2018-10-19 19:05:42'),
(6, 20, 1, 2, '2018-10-23 01:15:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_material_solicitud_compra_detalle`
--

CREATE TABLE `proyecto_material_solicitud_compra_detalle` (
  `proyecto_material_solicitud_compra_detalle_id` int(11) NOT NULL,
  `proyecto_material_solicitud_compra_id` int(11) NOT NULL,
  `proyecto_material_id` int(11) NOT NULL,
  `cantidad` float(20,2) NOT NULL,
  `estado_registro` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_material_solicitud_compra_detalle`
--

INSERT INTO `proyecto_material_solicitud_compra_detalle` (`proyecto_material_solicitud_compra_detalle_id`, `proyecto_material_solicitud_compra_id`, `proyecto_material_id`, `cantidad`, `estado_registro`) VALUES
(1, 1, 7, 12.50, 1),
(3, 1, 15, 3.00, 1),
(4, 2, 7, 6.00, 1),
(5, 2, 9, 2.00, 1),
(11, 2, 8, 4.00, 0),
(12, 2, 14, 1.00, 1),
(13, 2, 10, 2.00, 1),
(14, 2, 11, 1.00, 1),
(15, 1, 9, 5.00, 1),
(16, 3, 18, 10.00, 1),
(17, 3, 20, 2.00, 1),
(18, 4, 20, 3.00, 1),
(19, 5, 14, 1.00, 1),
(20, 6, 21, 1.00, 1),
(21, 6, 22, 2.00, 1),
(22, 6, 23, 3.00, 1),
(23, 6, 24, 4.00, 1),
(24, 6, 25, 5.00, 1);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_material_solicitud_compra_orden_compra`
--

CREATE TABLE `proyecto_material_solicitud_compra_orden_compra` (
  `proyecto_material_solicitud_compra_orden_compra_id` int(11) NOT NULL,
  `proyecto_material_solicitud_compra_id` int(11) NOT NULL,
  `proyecto_material_solicitud_compra_orden_compra_estado_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `filename` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `url_archivo` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_material_solicitud_compra_orden_compra`
--

INSERT INTO `proyecto_material_solicitud_compra_orden_compra` (`proyecto_material_solicitud_compra_orden_compra_id`, `proyecto_material_solicitud_compra_id`, `proyecto_material_solicitud_compra_orden_compra_estado_id`, `usuario_id`, `proveedor_id`, `fecha_registro`, `filename`, `url_archivo`) VALUES
(1, 2, 2, 1, 4, '2018-10-14 23:33:42', 'Orden_Compra_1_Ferreteria_4_2018_10_14.pdf', 'instatec_pub/files/proyectos/21/ordenes_compra/Orden_Compra_1_Ferreteria_4_2018_10_14.pdf'),
(2, 2, 2, 1, 1, '2018-10-15 00:31:00', 'Orden_Compra_2_MACOPA_2018_10_15.pdf', 'instatec_pub/files/proyectos/21/ordenes_compra/Orden_Compra_2_MACOPA_2018_10_15.pdf'),
(3, 2, 3, 1, 5, '2018-10-15 00:35:30', 'Orden_Compra_3_Proveedor_5_2018_10_15.pdf', 'instatec_pub/files/proyectos/21/ordenes_compra/Orden_Compra_3_Proveedor_5_2018_10_15.pdf'),
(4, 2, 3, 1, 4, '2018-10-15 23:13:04', 'Orden_Compra_4_Ferreteria_4_2018_10_15.pdf', 'instatec_pub/files/proyectos/21/ordenes_compra/Orden_Compra_4_Ferreteria_4_2018_10_15.pdf'),
(5, 1, 3, 1, 4, '2018-10-17 00:16:24', 'Orden_Compra_5_Ferreteria_4_2018_10_17.pdf', 'instatec_pub/files/proyectos/21/ordenes_compra/Orden_Compra_5_Ferreteria_4_2018_10_17.pdf'),
(6, 3, 1, 1, 3, '2018-10-19 18:52:17', 'Orden_Compra_6_TECNIGYPSUM_SA_2018_10_19.pdf', 'instatec_pub/files/proyectos/7/ordenes_compra/Orden_Compra_6_TECNIGYPSUM_SA_2018_10_19.pdf'),
(7, 3, 3, 1, 3, '2018-10-19 18:56:14', 'Orden_Compra_7_TECNIGYPSUM_SA_2018_10_19.pdf', 'instatec_pub/files/proyectos/7/ordenes_compra/Orden_Compra_7_TECNIGYPSUM_SA_2018_10_19.pdf'),
(8, 4, 3, 1, 3, '2018-10-19 19:02:37', 'Orden_Compra_8_TECNIGYPSUM_SA_2018_10_19.pdf', 'instatec_pub/files/proyectos/7/ordenes_compra/Orden_Compra_8_TECNIGYPSUM_SA_2018_10_19.pdf'),
(9, 6, 3, 1, 5, '2018-10-23 01:29:42', 'Orden_Compra_9_Proveedor_5_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/ordenes_compra/Orden_Compra_9_Proveedor_5_2018_10_23.pdf'),
(10, 6, 1, 1, 1, '2018-10-23 01:30:56', 'Orden_Compra_10_MACOPA_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/ordenes_compra/Orden_Compra_10_MACOPA_2018_10_23.pdf'),
(11, 6, 3, 1, 2, '2018-10-23 01:31:00', 'Orden_Compra_11_ALUMIMUNDO_SA_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/ordenes_compra/Orden_Compra_11_ALUMIMUNDO_SA_2018_10_23.pdf'),
(12, 6, 3, 1, 3, '2018-10-23 01:31:03', 'Orden_Compra_12_TECNIGYPSUM_SA_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/ordenes_compra/Orden_Compra_12_TECNIGYPSUM_SA_2018_10_23.pdf'),
(13, 6, 1, 1, 4, '2018-10-23 01:31:06', 'Orden_Compra_13_Ferreteria_4_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/ordenes_compra/Orden_Compra_13_Ferreteria_4_2018_10_23.pdf'),
(14, 6, 3, 1, 4, '2018-10-23 01:33:02', 'Orden_Compra_14_Ferreteria_4_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/ordenes_compra/Orden_Compra_14_Ferreteria_4_2018_10_23.pdf'),
(15, 6, 3, 1, 1, '2018-10-23 01:33:14', 'Orden_Compra_15_MACOPA_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/ordenes_compra/Orden_Compra_15_MACOPA_2018_10_23.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_material_solicitud_compra_orden_compra_estado`
--

CREATE TABLE `proyecto_material_solicitud_compra_orden_compra_estado` (
  `proyecto_material_solicitud_compra_orden_compra_estado_id` int(11) NOT NULL,
  `proyecto_material_solicitud_compra_orden_compra_estado` varchar(150) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_material_solicitud_compra_orden_compra_estado`
--

INSERT INTO `proyecto_material_solicitud_compra_orden_compra_estado` (`proyecto_material_solicitud_compra_orden_compra_estado_id`, `proyecto_material_solicitud_compra_orden_compra_estado`) VALUES
(1, 'Nueva orden'),
(2, 'Orden enviada'),
(3, 'Orden aceptada'),
(4, 'Orden rechazada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_material_solicitud_compra_proforma`
--

CREATE TABLE `proyecto_material_solicitud_compra_proforma` (
  `proyecto_material_solicitud_compra_proforma_id` int(11) NOT NULL,
  `proyecto_material_solicitud_compra_id` int(11) NOT NULL,
  `proyecto_material_solicitud_compra_proforma_estado_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `proveedor_id` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `filename` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `url_archivo` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_material_solicitud_compra_proforma`
--

INSERT INTO `proyecto_material_solicitud_compra_proforma` (`proyecto_material_solicitud_compra_proforma_id`, `proyecto_material_solicitud_compra_id`, `proyecto_material_solicitud_compra_proforma_estado_id`, `usuario_id`, `proveedor_id`, `fecha_registro`, `filename`, `url_archivo`) VALUES
(1, 2, 2, 1, 1, '2018-10-11 23:29:49', 'Proforma_1_2018_10_11.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_1_2018_10_11.pdf'),
(2, 2, 2, 1, 1, '2018-10-11 23:30:34', 'Proforma_2_2018_10_11.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_2_2018_10_11.pdf'),
(3, 2, 1, 1, 1, '2018-10-11 23:33:53', 'Proforma_3_2018_10_11.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_3_2018_10_11.pdf'),
(4, 2, 4, 1, 1, '2018-10-11 23:34:23', 'Proforma_4_2018_10_11.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_4_2018_10_11.pdf'),
(5, 2, 2, 1, 1, '2018-10-11 23:35:14', 'Proforma_5_2018_10_11.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_5_2018_10_11.pdf'),
(6, 2, 1, 1, 4, '2018-10-11 23:35:46', 'Proforma_6_2018_10_11.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_6_2018_10_11.pdf'),
(7, 2, 1, 1, 1, '2018-10-11 23:36:15', 'Proforma_7_2018_10_11.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_7_2018_10_11.pdf'),
(8, 2, 1, 1, 4, '2018-10-11 23:36:24', 'Proforma_8_2018_10_11.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_8_2018_10_11.pdf'),
(9, 2, 1, 1, 4, '2018-10-11 23:37:43', 'Proforma_9_2018_10_11.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_9_2018_10_11.pdf'),
(10, 2, 1, 1, 4, '2018-10-11 23:38:13', 'Proforma_10_2018_10_11.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_10_2018_10_11.pdf'),
(11, 2, 1, 1, 4, '2018-10-11 23:39:10', 'Proforma_11_Ferreteria_4_2018_10_11.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_11_Ferreteria_4_2018_10_11.pdf'),
(12, 2, 1, 1, 1, '2018-10-11 23:39:25', 'Proforma_12_MACOPA_2018_10_11.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_12_MACOPA_2018_10_11.pdf'),
(13, 2, 1, 1, 4, '2018-10-14 23:47:12', 'Proforma_13_Ferreteria_4_2018_10_14.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_13_Ferreteria_4_2018_10_14.pdf'),
(14, 2, 1, 1, 4, '2018-10-14 23:53:00', '', ''),
(15, 2, 1, 1, 4, '2018-10-14 23:53:56', '', ''),
(16, 2, 3, 1, 1, '2018-10-15 23:08:38', 'Proforma_16_MACOPA_2018_10_15.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_16_MACOPA_2018_10_15.pdf'),
(17, 2, 1, 1, 4, '2018-10-15 23:26:42', '', ''),
(18, 2, 1, 1, 4, '2018-10-15 23:27:32', 'Proforma_18_Ferreteria_4_2018_10_15.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_18_Ferreteria_4_2018_10_15.pdf'),
(19, 2, 3, 1, 4, '2018-10-15 23:28:51', 'Proforma_19_Ferreteria_4_2018_10_15.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_19_Ferreteria_4_2018_10_15.pdf'),
(20, 2, 1, 1, 5, '2018-10-19 00:25:43', 'Proforma_20_Proveedor_5_2018_10_19.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_20_Proveedor_5_2018_10_19.pdf'),
(21, 2, 1, 1, 5, '2018-10-19 00:25:49', 'Proforma_21_Proveedor_5_2018_10_19.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_21_Proveedor_5_2018_10_19.pdf'),
(22, 2, 3, 1, 5, '2018-10-19 00:25:56', 'Proforma_22_Proveedor_5_2018_10_19.pdf', 'instatec_pub/files/proyectos/21/proformas/Proforma_22_Proveedor_5_2018_10_19.pdf'),
(23, 3, 1, 1, 12, '2018-10-19 18:48:43', 'Proforma_23_Proveedor_12_2018_10_19.pdf', 'instatec_pub/files/proyectos/7/proformas/Proforma_23_Proveedor_12_2018_10_19.pdf'),
(24, 3, 1, 1, 3, '2018-10-19 18:49:43', 'Proforma_24_TECNIGYPSUM_SA_2018_10_19.pdf', 'instatec_pub/files/proyectos/7/proformas/Proforma_24_TECNIGYPSUM_SA_2018_10_19.pdf'),
(25, 3, 1, 1, 3, '2018-10-19 18:51:01', 'Proforma_25_TECNIGYPSUM_SA_2018_10_19.pdf', 'instatec_pub/files/proyectos/7/proformas/Proforma_25_TECNIGYPSUM_SA_2018_10_19.pdf'),
(26, 6, 1, 1, 5, '2018-10-23 01:26:00', 'Proforma_26_Proveedor_5_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/proformas/Proforma_26_Proveedor_5_2018_10_23.pdf'),
(27, 6, 1, 1, 5, '2018-10-23 01:27:05', 'Proforma_27_Proveedor_5_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/proformas/Proforma_27_Proveedor_5_2018_10_23.pdf'),
(28, 6, 1, 1, 5, '2018-10-23 01:27:31', 'Proforma_28_Proveedor_5_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/proformas/Proforma_28_Proveedor_5_2018_10_23.pdf'),
(29, 6, 1, 1, 5, '2018-10-23 01:28:13', 'Proforma_29_Proveedor_5_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/proformas/Proforma_29_Proveedor_5_2018_10_23.pdf'),
(30, 6, 1, 1, 5, '2018-10-23 01:28:29', 'Proforma_30_Proveedor_5_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/proformas/Proforma_30_Proveedor_5_2018_10_23.pdf'),
(31, 6, 1, 1, 5, '2018-10-23 01:28:48', 'Proforma_31_Proveedor_5_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/proformas/Proforma_31_Proveedor_5_2018_10_23.pdf'),
(32, 6, 1, 1, 5, '2018-10-23 01:28:57', 'Proforma_32_Proveedor_5_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/proformas/Proforma_32_Proveedor_5_2018_10_23.pdf'),
(33, 6, 1, 1, 5, '2018-10-23 01:29:07', 'Proforma_33_Proveedor_5_2018_10_23.pdf', 'instatec_pub/files/proyectos/20/proformas/Proforma_33_Proveedor_5_2018_10_23.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_material_solicitud_compra_proforma_estado`
--

CREATE TABLE `proyecto_material_solicitud_compra_proforma_estado` (
  `proyecto_material_solicitud_compra_proforma_estado_id` int(11) NOT NULL,
  `proyecto_material_solicitud_compra_proforma_estado` varchar(150) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_material_solicitud_compra_proforma_estado`
--

INSERT INTO `proyecto_material_solicitud_compra_proforma_estado` (`proyecto_material_solicitud_compra_proforma_estado_id`, `proyecto_material_solicitud_compra_proforma_estado`) VALUES
(1, 'Nueva proforma'),
(2, 'Proforma enviada'),
(3, 'Proforma aceptada'),
(4, 'Proforma rechazada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_material_solicitud_cotizacion`
--

CREATE TABLE `proyecto_material_solicitud_cotizacion` (
  `proyecto_material_solicitud_cotizacion_id` int(11) NOT NULL,
  `proyecto_id` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `filename` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `url_archivo` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_material_solicitud_cotizacion`
--

INSERT INTO `proyecto_material_solicitud_cotizacion` (`proyecto_material_solicitud_cotizacion_id`, `proyecto_id`, `fecha_registro`, `filename`, `url_archivo`) VALUES
(1, 21, '2018-09-23 13:23:56', 'Solicitud_Cotizacion_Materiales_Proyecto_21_1_2018_09_23.xlsx', 'instatec_pub/files/proyectos/21/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_21_1_2018_09_23.xlsx'),
(2, 21, '2018-09-23 15:03:23', 'Solicitud_Cotizacion_Materiales_Proyecto_21_2_2018_09_23.xlsx', 'instatec_pub/files/proyectos/21/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_21_2_2018_09_23.xlsx'),
(3, 21, '2018-09-23 15:05:44', 'Solicitud_Cotizacion_Materiales_Proyecto_21_3_2018_09_23.xlsx', 'instatec_pub/files/proyectos/21/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_21_3_2018_09_23.xlsx'),
(4, 7, '2018-09-26 22:52:33', 'Solicitud_Cotizacion_Materiales_Proyecto_7_4_2018_09_26.xlsx', 'instatec_pub/files/proyectos/7/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_7_4_2018_09_26.xlsx'),
(5, 21, '2018-10-04 00:49:05', 'Solicitud_Cotizacion_Materiales_Proyecto_21_5_2018_10_04.xlsx', 'instatec_pub/files/proyectos/21/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_21_5_2018_10_04.xlsx'),
(6, 21, '2018-10-04 00:49:55', 'Solicitud_Cotizacion_Materiales_Proyecto_21_6_2018_10_04.xlsx', 'instatec_pub/files/proyectos/21/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_21_6_2018_10_04.xlsx'),
(7, 21, '2018-10-07 00:55:59', 'Solicitud_Cotizacion_Materiales_Proyecto_21_7_2018_10_07.xlsx', 'instatec_pub/files/proyectos/21/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_21_7_2018_10_07.xlsx'),
(8, 7, '2018-10-19 18:28:45', 'Solicitud_Cotizacion_Materiales_Proyecto_7_8_2018_10_19.xlsx', 'instatec_pub/files/proyectos/7/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_7_8_2018_10_19.xlsx'),
(9, 7, '2018-10-19 18:31:11', 'Solicitud_Cotizacion_Materiales_Proyecto_7_9_2018_10_19.xlsx', 'instatec_pub/files/proyectos/7/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_7_9_2018_10_19.xlsx'),
(10, 7, '2018-10-19 18:31:33', 'Solicitud_Cotizacion_Materiales_Proyecto_7_10_2018_10_19.xlsx', 'instatec_pub/files/proyectos/7/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_7_10_2018_10_19.xlsx'),
(11, 7, '2018-10-19 18:31:51', 'Solicitud_Cotizacion_Materiales_Proyecto_7_11_2018_10_19.xlsx', 'instatec_pub/files/proyectos/7/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_7_11_2018_10_19.xlsx'),
(12, 20, '2018-10-23 00:12:02', 'Solicitud_Cotizacion_Materiales_Proyecto_20_12_2018_10_23.xlsx', 'instatec_pub/files/proyectos/20/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_20_12_2018_10_23.xlsx'),
(13, 20, '2018-10-23 00:13:43', 'Solicitud_Cotizacion_Materiales_Proyecto_20_13_2018_10_23.xlsx', 'instatec_pub/files/proyectos/20/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_20_13_2018_10_23.xlsx'),
(14, 20, '2018-10-23 00:22:59', 'Solicitud_Cotizacion_Materiales_Proyecto_20_14_2018_10_23.xlsx', 'instatec_pub/files/proyectos/20/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_20_14_2018_10_23.xlsx'),
(15, 20, '2018-10-23 00:31:21', 'Solicitud_Cotizacion_Materiales_Proyecto_20_15_2018_10_23.xlsx', 'instatec_pub/files/proyectos/20/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_20_15_2018_10_23.xlsx'),
(16, 20, '2018-10-23 00:31:39', 'Solicitud_Cotizacion_Materiales_Proyecto_20_16_2018_10_23.xlsx', 'instatec_pub/files/proyectos/20/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_20_16_2018_10_23.xlsx'),
(17, 20, '2018-10-23 00:33:26', 'Solicitud_Cotizacion_Materiales_Proyecto_20_17_2018_10_23.xlsx', 'instatec_pub/files/proyectos/20/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_20_17_2018_10_23.xlsx'),
(18, 20, '2018-10-23 00:41:28', 'Solicitud_Cotizacion_Materiales_Proyecto_20_18_2018_10_23.xlsx', 'instatec_pub/files/proyectos/20/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_20_18_2018_10_23.xlsx'),
(19, 20, '2018-10-23 00:42:15', 'Solicitud_Cotizacion_Materiales_Proyecto_20_19_2018_10_23.xlsx', 'instatec_pub/files/proyectos/20/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_20_19_2018_10_23.xlsx'),
(20, 20, '2018-10-23 00:42:59', 'Solicitud_Cotizacion_Materiales_Proyecto_20_20_2018_10_23.xlsx', 'instatec_pub/files/proyectos/20/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_20_20_2018_10_23.xlsx'),
(21, 20, '2018-10-23 00:44:50', 'Solicitud_Cotizacion_Materiales_Proyecto_20_21_2018_10_23.xlsx', 'instatec_pub/files/proyectos/20/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_20_21_2018_10_23.xlsx'),
(22, 20, '2018-10-23 00:45:29', 'Solicitud_Cotizacion_Materiales_Proyecto_20_22_2018_10_23.xlsx', 'instatec_pub/files/proyectos/20/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_20_22_2018_10_23.xlsx'),
(23, 20, '2018-10-23 00:46:50', 'Solicitud_Cotizacion_Materiales_Proyecto_20_23_2018_10_23.xlsx', 'instatec_pub/files/proyectos/20/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_20_23_2018_10_23.xlsx'),
(24, 20, '2018-10-23 00:46:59', 'Solicitud_Cotizacion_Materiales_Proyecto_20_24_2018_10_23.xlsx', 'instatec_pub/files/proyectos/20/solicitud_cotizacion/Solicitud_Cotizacion_Materiales_Proyecto_20_24_2018_10_23.xlsx');

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
(3, 7, 1, 2, 569.00, 575.00, '2017-12-17 01:46:09'),
(17, 17, 1, 2, 567.00, 577.00, '2018-04-13 14:24:28'),
(18, 18, 1, 2, 567.00, 5.77, '2018-04-13 15:12:55'),
(19, 19, 1, 2, 567.00, 577.00, '2018-04-13 15:19:39'),
(20, 20, 1, 2, 562.00, 567.00, '2018-04-16 19:45:10'),
(21, 21, 1, 2, 563.00, 567.00, '2018-04-24 15:13:35');

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
(31, 5, 7, 1, 20000.00, '2017-12-17 01:46:09', 1),
(32, 1, 7, 1, 2902.17, '2017-12-17 01:46:09', 1),
(33, 2, 7, 1, 3655.00, '2017-12-17 01:46:09', 1),
(34, 3, 7, 1, 1215.50, '2017-12-17 01:46:09', 1),
(35, 4, 7, 1, 3698.85, '2017-12-17 01:46:09', 1),
(106, 1, 17, 1, 200000.00, '2018-04-13 14:24:28', 1),
(107, 2, 17, 1, 230000.00, '2018-04-13 14:24:28', 1),
(108, 3, 17, 1, 20000.00, '2018-04-13 14:24:28', 1),
(109, 4, 17, 1, 3000.00, '2018-04-13 14:24:28', 1),
(110, 5, 17, 1, 47000.00, '2018-04-13 14:24:28', 1),
(111, 1, 18, 1, 175000.00, '2018-04-13 15:12:55', 1),
(112, 2, 18, 1, 100000.00, '2018-04-13 15:12:55', 1),
(113, 3, 18, 1, 20000.00, '2018-04-13 15:12:55', 1),
(114, 4, 18, 1, 3500.00, '2018-04-13 15:12:55', 1),
(115, 5, 18, 1, 30000.00, '2018-04-13 15:12:55', 1),
(116, 1, 19, 1, 0.00, '2018-04-13 15:19:39', 1),
(117, 2, 19, 1, 0.00, '2018-04-13 15:19:39', 1),
(118, 3, 19, 1, 0.00, '2018-04-13 15:19:39', 1),
(119, 4, 19, 1, 0.00, '2018-04-13 15:19:39', 1),
(120, 5, 19, 1, 0.00, '2018-04-13 15:19:39', 1),
(121, 1, 20, 1, 41176.37, '2018-04-16 19:45:10', 1),
(122, 2, 20, 1, 100000.00, '2018-04-16 19:45:10', 1),
(123, 3, 20, 1, 1500.00, '2018-04-16 19:45:10', 1),
(124, 4, 20, 1, 4000.00, '2018-04-16 19:45:10', 1),
(125, 5, 20, 1, 40000.00, '2018-04-16 19:45:10', 1),
(126, 1, 21, 1, 45036.82, '2018-04-24 15:13:35', 1),
(127, 2, 21, 1, 215000.00, '2018-04-24 15:13:35', 1),
(128, 3, 21, 1, 6000.00, '2018-04-24 15:13:35', 1),
(129, 4, 21, 1, 3000.00, '2018-04-24 15:13:35', 1),
(130, 5, 21, 1, 50000.00, '2018-04-24 15:13:35', 1),
(131, 6, 7, 1, 1000.00, '2018-08-09 00:35:14', 1),
(132, 6, 7, 1, 1500.00, '2018-08-29 20:28:14', 1);

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
(1, 131, 5, 'Se cambio el material de madera a PVC'),
(2, 132, 5, 'OC Edificio A 2901');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_valor_oferta_extension_tipo`
--

CREATE TABLE `proyecto_valor_oferta_extension_tipo` (
  `proyecto_valor_oferta_extension_tipo_id` int(11) NOT NULL,
  `proyecto_valor_oferta_extension_tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado_registro` int(11) NOT NULL COMMENT '0 = Inactivo, 1 = activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_valor_oferta_extension_tipo`
--

INSERT INTO `proyecto_valor_oferta_extension_tipo` (`proyecto_valor_oferta_extension_tipo_id`, `proyecto_valor_oferta_extension_tipo`, `fecha_registro`, `estado_registro`) VALUES
(1, 'Paredes', '0000-00-00 00:00:00', 1),
(2, 'Cielo', '0000-00-00 00:00:00', 1),
(3, 'Pisos', '0000-00-00 00:00:00', 1),
(5, 'Rodapie', '2018-08-09 00:34:33', 1);

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
(1, '2017-12-01 06:19:38', 1, 1, 'instatec_admin', '$2y$10$VCUcwt0x25xkvcIpnz5wU.41qnEFaoPrbUgXKB.kKSR0lM0JNUDC2', 1),
(2, '2017-12-01 06:21:48', 1, 1, 'keylormg', '$2y$10$H/zVeP80TCO1oY1Qo6ZzbOMUUphGPyCdVDD43IZFaQ24dISqo5s9y', 1),
(3, '2018-01-24 07:19:12', 2, 1, 'khmg13', '$2y$10$wyh.bCmPXplwqMik2kRJp..YHSgbRs5.JryDRZzSTqeMxS1l7lrbW', 0),
(5, '2018-01-24 07:42:53', 2, 1, 'fchaves', '$2y$10$zhjNTy3UEDBhkQnN.nzpAOu8Upd909Ou28P.pU9wwYqjG70l2E.6G', 0),
(6, '2018-01-26 06:49:25', 3, 1, 'asistente1', '$2y$10$Pypj8f/kQyV0PlBA7.7b4e5USykgBsVrsa1R2dgcD2UXQt33jC0ma', 0),
(7, '2018-01-24 07:50:50', 3, 0, 'asistente2', '$2y$10$8KoLzaRD.nT7shMXvbF4TeeEWKtfSJOHqbktnMfhq.b./KJYW3EEi', 0),
(8, '2018-01-24 07:53:20', 2, 1, 'asistente3', '$2y$10$IRq7ELlAKw355nnliCX5p.cmFo7.r16eCPPpvgytb5GdT/f/GYZEi', 0),
(10, '2018-02-06 06:46:00', 3, 1, 'yersonmgm', '$2y$10$cw7571QJUsokKXWlH9mMleiM2E8k8wKVejggQ4kaBSAUcwX//HOhK', 0),
(11, '2018-02-06 07:06:41', 3, 1, 'miladygv', '$2y$10$sOuwckfqyjJPVzE6I4A8hugaFMU4wHSOx1sKxS5SVQ6jOm2c4ql3m', 0),
(12, '2018-02-07 07:43:17', 3, 1, 'miladygv', '$2y$10$6KBu0JTbydkOqmQI/AbqUO5YshakgTltHiaF35OOBbYKIC1ZXP2zO', 0),
(13, '2018-02-07 07:48:17', 3, 1, 'miladygv', '$2y$10$qTUdJxrDLtuQJ9f84ohwFuOIgXDGXyflt2nQoBgYgG9oQXWiRiMUu', 0),
(14, '2018-02-10 18:53:07', 3, 1, 'mgarro', '$2y$10$XhOxNUPYY9IQtikCsr7Cuug9cDbHwe4FuqbC5lckYLCOo7b6/sADW', 0),
(15, '2018-02-13 06:51:11', 3, 1, 'lvargas', '$2y$10$ehGxrvdV6kNLlBPAyglfe.63RSD8VMpaEPR6xnrtMRU1qD5ulRfxa', 0),
(16, '2018-02-16 20:30:27', 3, 1, 'jcampos', '$2y$10$cwOy6BjrmnbB0hQ12NeXK.ui9e2TIMKaHBVIQl.5.2pW7zgMq9Lzu', 0),
(17, '2018-04-05 18:54:41', 3, 1, 'jperez', '$2y$10$RylVFJ7M87w6NQpWI0m8Yem5xXtjaxoAGk7xCq1lfshBsK43xkPk6', 0),
(18, '2018-04-07 17:18:40', 2, 1, 'Auxiliadora ', '$2y$10$bop2Px0hxKjxgnjIgR3.UOOh52ZYo1M6xSWhr1j6P7DOpm2VZgFiC', 0),
(19, '2018-04-13 11:55:34', 2, 1, 'ERICK', '$2y$10$zeDlO4jD7DHYnTHQVbxWLOAgqJcAowp8448xCwxz2XjZttVnD8vc2', 1),
(20, '2018-04-13 12:48:43', 3, 1, 'monicaquesada', '$2y$10$B.th1HppH18Ginc43dsumOQljFX2n2.wYpPJltK1qlp0giuwUYEDu', 1),
(21, '2018-04-13 14:55:52', 3, 1, 'cuaji', '$2y$10$6Vo8s0Kr51WEl00FcQUIduHFS7Dn3XIrpgXSfGQvJvgfUd4PEREDW', 1),
(22, '2018-04-13 15:31:12', 2, 1, 'nel', '$2y$10$QL0TCOjGDrMYC8VRHROXpeBYHWRjCvYy7yd8JsNw7LHhiR7ul4qye', 1),
(23, '2018-04-13 18:04:02', 3, 1, 'rolo', '$2y$10$sadUmOQ9aVASi2kDs6nZmuQ03r1Dqy.VSW43EqmSo9TGGb/o4bB6e', 1),
(24, '2018-04-16 10:09:39', 2, 1, 'Auxiliadora ', '$2y$10$KMdJ/F62I0PIwMpsEQCNlunzmNik7pleBekt1R19lPtKFRiHOYUWm', 1),
(25, '2018-10-05 15:06:14', 3, 1, 'fchaves', '$2y$10$SONUw1fXumSfp.qe.RpMie50JiSOK/qmpvRmQHxdKve9euPpjeOya', 1);

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
(80, 1, '2018-02-18 17:52:31', 'edicion', '', 3),
(81, 1, '2018-03-04 17:10:34', 'edicion', '', 15),
(82, 1, '2018-03-18 14:52:53', 'edicion', '', 4),
(83, 1, '2018-03-18 14:54:10', 'edicion', '', 4),
(84, 1, '2018-03-18 15:27:41', 'edicion', '', 1),
(85, 1, '2018-04-05 18:59:57', 'edicion', '', 16),
(86, 1, '2018-04-05 19:00:55', 'edicion', '', 20),
(87, 1, '2018-04-05 22:46:31', 'edicion', '', 21),
(88, 1, '2018-04-07 17:36:10', 'edicion', '', 16),
(89, 1, '2018-04-13 12:15:08', 'edicion', 'cliente', 1),
(90, 1, '2018-04-13 12:15:40', 'edicion', 'cliente', 1),
(91, 1, '2018-04-13 12:17:50', 'edicion', 'cliente', 1),
(92, 1, '2018-04-13 12:20:38', 'edicion', 'cliente', 15),
(93, 1, '2018-04-13 12:21:28', 'edicion', 'cliente', 3),
(94, 1, '2018-04-13 12:30:22', 'edicion', 'cliente', 1),
(95, 1, '2018-04-13 12:33:45', 'edicion', 'cliente', 4),
(96, 1, '2018-04-13 12:35:06', 'edicion', 'cliente', 5),
(97, 1, '2018-04-13 12:35:12', 'edicion', 'cliente', 5),
(98, 1, '2018-04-13 12:36:05', 'edicion', 'cliente', 7),
(99, 1, '2018-04-13 12:36:09', 'edicion', 'cliente', 7),
(100, 1, '2018-04-13 12:36:38', 'edicion', 'cliente', 5),
(101, 1, '2018-04-13 12:39:36', 'edicion', 'cliente', 8),
(102, 1, '2018-04-13 12:49:41', 'edicion', 'cliente', 10),
(103, 1, '2018-04-13 12:50:55', 'edicion', '', 7),
(104, 1, '2018-04-13 14:17:31', 'edicion', 'cliente', 11),
(105, 1, '2018-04-13 14:17:37', 'edicion', 'cliente', 11),
(106, 1, '2018-04-13 14:29:33', 'edicion', 'proveedor', 1),
(107, 1, '2018-04-13 14:30:00', 'edicion', 'proveedor', 1),
(108, 1, '2018-04-13 14:30:04', 'edicion', 'proveedor', 1),
(109, 1, '2018-04-13 14:30:13', 'edicion', 'proveedor', 1),
(110, 1, '2018-04-13 14:31:57', 'edicion', 'proveedor', 2),
(111, 1, '2018-04-13 14:32:33', 'edicion', 'proveedor', 2),
(112, 1, '2018-04-13 14:32:37', 'edicion', 'proveedor', 2),
(113, 1, '2018-04-13 14:34:20', 'edicion', 'proveedor', 3),
(114, 1, '2018-04-13 15:42:04', 'edicion', '', 18),
(115, 1, '2018-04-13 18:08:08', 'edicion', '', 25),
(116, 1, '2018-04-13 18:08:42', 'edicion', '', 23),
(117, 1, '2018-04-13 18:09:41', 'edicion', '', 23),
(118, 1, '2018-04-13 18:12:16', 'edicion', '', 23),
(119, 1, '2018-04-13 18:19:31', 'edicion', '', 23),
(120, 1, '2018-04-13 18:27:29', 'edicion', '', 24),
(121, 1, '2018-04-13 18:39:03', 'edicion', '', 18),
(122, 1, '2018-04-13 18:39:43', 'edicion', '', 18),
(123, 1, '2018-04-13 18:40:25', 'edicion', '', 18),
(124, 1, '2018-04-13 18:40:48', 'edicion', '', 18),
(125, 24, '2018-04-16 10:52:24', 'edicion', '', 28),
(126, 24, '2018-04-16 11:16:31', 'edicion', '', 33),
(127, 24, '2018-04-16 11:16:37', 'edicion', '', 33),
(128, 24, '2018-04-16 11:18:19', 'edicion', '', 32),
(129, 24, '2018-04-16 11:19:04', 'edicion', '', 31),
(130, 24, '2018-04-16 11:19:34', 'edicion', '', 30),
(131, 24, '2018-04-16 11:19:59', 'edicion', '', 29),
(132, 24, '2018-04-16 11:20:13', 'edicion', '', 29),
(133, 24, '2018-04-16 11:20:32', 'edicion', '', 28),
(134, 1, '2018-04-24 22:37:46', 'edicion', '', 32),
(135, 1, '2018-07-27 00:44:50', 'edicion', '', 23),
(136, 1, '2018-07-27 00:45:07', 'edicion', '', 23),
(137, 1, '2018-07-27 00:46:01', 'edicion', '', 23),
(138, 1, '2018-07-27 00:46:04', 'edicion', '', 23),
(139, 1, '2018-07-27 00:46:16', 'edicion', '', 23),
(140, 1, '2018-07-27 00:46:19', 'edicion', '', 23),
(141, 1, '2018-07-31 00:08:25', 'edicion', '', 26),
(142, 1, '2018-07-31 00:08:29', 'edicion', '', 26),
(143, 1, '2018-07-31 00:08:34', 'edicion', '', 26),
(144, 1, '2018-07-31 00:08:38', 'edicion', '', 26),
(145, 1, '2018-07-31 00:10:04', 'edicion', '', 26),
(146, 1, '2018-07-31 00:10:09', 'edicion', '', 26),
(147, 1, '2018-07-31 00:10:17', 'edicion', '', 26),
(148, 1, '2018-08-02 11:15:43', 'edicion', '', 35),
(149, 1, '2018-08-02 11:24:45', 'edicion', '', 34),
(150, 1, '2018-08-02 19:02:00', 'edicion', 'cliente', 1),
(151, 1, '2018-08-02 19:02:11', 'edicion', 'cliente', 1),
(152, 1, '2018-08-02 19:06:37', 'edicion', 'cliente', 1),
(153, 1, '2018-08-02 19:36:24', 'edicion', 'cliente', 5),
(154, 1, '2018-08-02 19:36:40', 'edicion', 'cliente', 11),
(156, 1, '2018-08-06 23:43:47', 'edicion', 'colaborador_puesto', 4),
(157, 1, '2018-08-06 23:47:35', 'edicion', 'colaborador_puesto', 4),
(158, 1, '2018-08-06 23:48:01', 'edicion', 'colaborador_puesto', 4),
(159, 1, '2018-08-07 00:02:39', 'edicion', 'colaborador', 35),
(160, 1, '2018-08-07 00:06:41', 'edicion', 'colaborador', 35),
(161, 1, '2018-08-07 00:08:00', 'edicion', 'colaborador', 35),
(162, 1, '2018-08-07 00:08:09', 'edicion', 'colaborador', 35),
(163, 1, '2018-08-21 22:49:34', 'edicion', 'material', 2),
(164, 1, '2018-08-21 22:49:40', 'edicion', 'material', 2),
(165, 1, '2018-08-21 22:50:00', 'edicion', 'material', 1),
(166, 1, '2018-08-21 22:50:09', 'edicion', 'material', 1),
(167, 1, '2018-10-05 15:08:32', 'edicion', 'colaborador', 38),
(168, 1, '2018-10-05 15:09:16', 'edicion', 'proyecto', 21);

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
(89, 14, '2018-02-21 00:13:50', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3239.132 Safari/537.36'),
(90, 14, '2018-03-04 16:23:56', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(91, 5, '2018-03-04 16:35:13', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(92, 1, '2018-03-04 16:52:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(93, 5, '2018-03-04 17:34:35', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(94, 1, '2018-03-04 17:37:57', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(95, 1, '2018-03-05 23:18:00', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(96, 1, '2018-03-07 23:25:42', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(97, 1, '2018-03-08 23:41:17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(98, 1, '2018-03-11 16:53:21', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(99, 1, '2018-03-11 23:19:29', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(100, 1, '2018-03-13 22:18:50', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(101, 1, '2018-03-14 23:19:20', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(102, 1, '2018-03-15 23:33:06', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(103, 1, '2018-03-17 12:45:28', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(104, 1, '2018-03-18 14:28:11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(105, 1, '2018-03-18 18:38:28', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(106, 1, '2018-03-18 21:45:49', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(107, 1, '2018-03-20 23:36:29', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(108, 1, '2018-03-21 08:02:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(109, 1, '2018-03-21 22:09:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(110, 1, '2018-03-22 20:50:04', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(111, 1, '2018-03-22 21:46:15', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(112, 5, '2018-03-22 21:46:19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(113, 14, '2018-03-22 21:46:30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(114, 1, '2018-03-22 21:50:36', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(115, 1, '2018-03-23 23:27:08', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(116, 1, '2018-03-26 22:52:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(117, 1, '2018-03-31 19:14:29', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(118, 1, '2018-03-31 23:34:45', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(119, 1, '2018-04-01 17:14:48', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(120, 1, '2018-04-01 23:33:42', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(121, 1, '2018-04-03 21:55:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/64.0.3282.186 Safari/537.36'),
(122, 1, '2018-04-04 22:46:48', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(123, 1, '2018-04-05 18:42:30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(124, 5, '2018-04-05 18:51:28', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(125, 1, '2018-04-05 18:59:42', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(126, 14, '2018-04-05 19:41:57', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(127, 1, '2018-04-05 19:47:58', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(128, 1, '2018-04-05 19:50:26', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(129, 1, '2018-04-05 22:37:21', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(130, 1, '2018-04-05 23:54:29', '186.176.248.61', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(131, 1, '2018-04-07 17:09:15', '201.191.195.97', 'Mozilla/5.0 (Linux; Android 7.0; SAMSUNG SM-G950F Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/6.4 Chrome/56.0.2924.87 Mobile Safari/537.36'),
(132, 18, '2018-04-09 05:42:44', '201.203.100.112', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(133, 18, '2018-04-09 05:45:27', '201.203.100.112', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(134, 18, '2018-04-09 10:34:24', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(135, 18, '2018-04-09 10:38:51', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(136, 1, '2018-04-13 11:24:54', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(137, 1, '2018-04-13 11:28:14', '186.176.249.136', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(138, 5, '2018-04-13 11:28:26', '186.176.249.136', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(139, 18, '2018-04-13 11:51:12', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(140, 1, '2018-04-13 12:23:12', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(141, 1, '2018-04-13 12:24:52', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(142, 1, '2018-04-13 12:53:35', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(143, 19, '2018-04-13 15:03:03', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(144, 19, '2018-04-13 15:42:05', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(145, 20, '2018-04-13 15:47:12', '138.94.59.225', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko'),
(146, 1, '2018-04-13 15:57:23', '186.176.249.136', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(147, 20, '2018-04-13 16:00:19', '186.176.249.136', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(148, 22, '2018-04-13 16:03:48', '186.176.249.136', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(149, 19, '2018-04-16 08:25:03', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(150, 1, '2018-04-16 10:06:52', '201.191.255.113', 'Mozilla/5.0 (Linux; Android 7.0; SAMSUNG SM-G950F Build/NRD90M) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/6.4 Chrome/56.0.2924.87 Mobile Safari/537.36'),
(151, 24, '2018-04-16 10:11:17', '200.91.175.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(152, 1, '2018-04-16 19:34:47', '186.177.155.150', 'Mozilla/5.0 (iPad; CPU OS 11_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/11.0 Mobile/15E148 Safari/604.1'),
(153, 1, '2018-04-16 19:41:33', '186.177.155.150', 'Mozilla/5.0 (iPad; CPU OS 11_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/11.0 Mobile/15E148 Safari/604.1'),
(154, 19, '2018-04-17 14:55:31', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(155, 24, '2018-04-19 11:08:43', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(156, 19, '2018-04-20 09:24:27', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(157, 19, '2018-04-23 10:36:34', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(158, 19, '2018-04-23 14:34:13', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(159, 24, '2018-04-24 12:47:48', '201.201.215.48', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(160, 1, '2018-04-24 14:55:31', '186.177.155.150', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(161, 19, '2018-04-24 17:02:37', '138.94.59.225', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/65.0.3325.181 Safari/537.36'),
(162, 1, '2018-04-24 22:35:58', '186.177.155.150', 'Mozilla/5.0 (iPad; CPU OS 11_3 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/11.0 Mobile/15E148 Safari/604.1'),
(163, 1, '2018-04-25 20:50:39', '186.176.250.93', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36'),
(164, 1, '2018-04-25 21:06:08', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.117 Safari/537.36'),
(165, 1, '2018-07-18 22:00:19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(166, 1, '2018-07-26 23:08:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(167, 1, '2018-07-30 22:48:41', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(168, 1, '2018-07-31 18:30:43', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(169, 1, '2018-08-02 10:42:29', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(170, 1, '2018-08-02 18:20:30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36'),
(171, 1, '2018-08-06 21:58:42', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.84 Safari/537.36'),
(172, 1, '2018-08-07 21:27:36', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.84 Safari/537.36'),
(173, 1, '2018-08-08 21:00:37', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.84 Safari/537.36'),
(174, 1, '2018-08-14 19:11:28', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(175, 1, '2018-08-15 15:00:24', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(176, 1, '2018-08-15 19:05:00', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(177, 1, '2018-08-16 22:32:00', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(178, 1, '2018-08-18 14:25:45', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(179, 1, '2018-08-18 19:38:52', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(180, 1, '2018-08-19 15:49:57', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(181, 1, '2018-08-20 23:20:44', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(182, 1, '2018-08-21 19:39:30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(183, 1, '2018-08-22 22:29:31', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(184, 1, '2018-08-24 20:02:54', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(185, 1, '2018-08-26 23:21:11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(186, 1, '2018-08-27 21:55:59', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(187, 1, '2018-08-29 20:01:22', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(188, 1, '2018-08-30 22:26:16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(189, 1, '2018-09-02 23:50:38', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(190, 1, '2018-09-04 19:57:23', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(191, 1, '2018-09-05 23:53:47', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(192, 1, '2018-09-09 22:33:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(193, 1, '2018-09-11 20:41:30', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36'),
(194, 1, '2018-09-13 22:03:47', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(195, 1, '2018-09-15 17:14:47', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(196, 1, '2018-09-16 10:59:55', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(197, 1, '2018-09-16 17:20:55', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(198, 1, '2018-09-16 22:53:38', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(199, 1, '2018-09-17 22:26:08', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(200, 1, '2018-09-18 18:28:40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(201, 1, '2018-09-22 17:01:10', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(202, 1, '2018-09-22 18:37:23', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(203, 1, '2018-09-22 18:37:47', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(204, 1, '2018-09-22 18:40:40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(205, 1, '2018-09-22 18:51:06', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(206, 1, '2018-09-22 18:53:04', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(207, 1, '2018-09-22 19:04:20', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(208, 1, '2018-09-22 19:06:12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(209, 1, '2018-09-22 19:07:33', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(210, 1, '2018-09-23 13:07:21', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(211, 1, '2018-09-23 19:56:07', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(212, 1, '2018-09-24 21:37:39', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(213, 1, '2018-09-25 20:15:57', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(214, 1, '2018-09-26 19:25:22', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(215, 1, '2018-09-28 19:33:40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(216, 1, '2018-09-30 16:29:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(217, 1, '2018-10-03 19:18:11', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(218, 1, '2018-10-04 20:48:06', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(219, 1, '2018-10-05 15:01:00', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(220, 1, '2018-10-05 15:04:35', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(221, 25, '2018-10-05 15:09:32', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(222, 1, '2018-10-05 15:15:16', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(223, 1, '2018-10-05 15:40:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(224, 1, '2018-10-06 21:44:59', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.92 Safari/537.36'),
(225, 1, '2018-10-07 19:39:44', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(226, 1, '2018-10-07 23:26:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(227, 1, '2018-10-09 00:27:14', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(228, 1, '2018-10-09 19:27:37', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(229, 1, '2018-10-10 21:12:18', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(230, 1, '2018-10-11 22:49:46', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(231, 1, '2018-10-14 15:30:40', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(232, 1, '2018-10-14 23:14:00', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(233, 1, '2018-10-15 10:16:50', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(234, 1, '2018-10-15 23:07:55', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(235, 1, '2018-10-16 19:35:05', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(236, 1, '2018-10-17 19:17:14', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(237, 1, '2018-10-18 21:37:42', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(238, 1, '2018-10-19 00:09:08', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(239, 1, '2018-10-19 18:18:39', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(240, 25, '2018-10-19 19:04:51', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(241, 1, '2018-10-19 19:06:09', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(242, 25, '2018-10-20 14:17:24', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(243, 25, '2018-10-21 23:35:03', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(244, 1, '2018-10-21 23:40:20', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(245, 1, '2018-10-22 23:13:29', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(246, 1, '2018-10-23 19:41:12', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36'),
(247, 1, '2018-10-26 12:30:14', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36');

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
(12, 16, 18),
(13, 17, 20),
(14, 18, 22),
(15, 20, 23),
(16, 21, 24),
(17, 23, 25),
(18, 25, 38);

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
(16, 16, 'Jose', 'Campos', 'josec@instatec.com'),
(17, 17, 'Jose', 'Perez', 'josep@instateccr.com'),
(18, 18, 'Auxiliadora ', 'Cervantes Calderón ', 'auxiliadora@instateccr.com'),
(19, 19, 'Erick', 'Loaiza Soto', 'erick@instateccr.com'),
(20, 20, 'Mónica  ', 'Quesada Vargas', 'moni_q25@hotmail.com'),
(21, 21, 'EDWARD', 'LOAIZA SOTO', 'loaizasotoe@gmail.com'),
(22, 22, 'NELSON', 'ARGUELLO RAMIREZ', 'nelson@instateccr.com'),
(23, 23, 'ROLANDO ', 'LOAIZA SOTO', 'rolando@instateccr.com'),
(24, 24, 'Auxiliadora ', 'Cervantes Calderón ', 'auxiliadora@instateccr.com'),
(25, 25, 'Fabiola', 'Chaves', 'fchaves@instateccr.com');

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
(137, 2, 'colaborador', 'delete', 1),
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
(157, 3, 'proyecto_colaboradores_tiempo', 'edit', 1),
(158, 1, 'reporte_horas_por_trabajador', 'list', 1),
(159, 2, 'reporte_horas_por_trabajador', 'list', 1),
(160, 3, 'reporte_horas_por_trabajador', 'list', 0),
(161, 4, 'reporte_horas_por_trabajador', 'list', 0),
(162, 1, 'reporte_horas_por_trabajador', 'view', 1),
(163, 2, 'reporte_horas_por_trabajador', 'view', 1),
(164, 3, 'reporte_horas_por_trabajador', 'view', 0),
(165, 4, 'reporte_horas_por_trabajador', 'view', 0),
(166, 1, 'reporte_horas_por_proyecto', 'list', 1),
(167, 2, 'reporte_horas_por_proyecto', 'list', 1),
(168, 3, 'reporte_horas_por_proyecto', 'list', 0),
(169, 4, 'reporte_horas_por_proyecto', 'list', 0),
(170, 1, 'reporte_horas_por_proyecto', 'view', 1),
(171, 2, 'reporte_horas_por_proyecto', 'view', 1),
(172, 3, 'reporte_horas_por_proyecto', 'view', 0),
(173, 4, 'reporte_horas_por_proyecto', 'view', 0),
(174, 1, 'reporte_proyecto_general', 'list', 1),
(175, 2, 'reporte_proyecto_general', 'list', 0),
(176, 3, 'reporte_proyecto_general', 'list', 0),
(177, 4, 'reporte_proyecto_general', 'list', 0),
(178, 1, 'reporte_proyecto_general', 'view', 1),
(179, 2, 'reporte_proyecto_general', 'view', 0),
(180, 3, 'reporte_proyecto_general', 'view', 0),
(181, 4, 'reporte_proyecto_general', 'view', 0),
(182, 1, 'reporte_gastos_materiales_proyectos', 'list', 1),
(183, 2, 'reporte_gastos_materiales_proyectos', 'list', 1),
(184, 3, 'reporte_gastos_materiales_proyectos', 'list', 0),
(185, 4, 'reporte_gastos_materiales_proyectos', 'list', 0),
(186, 1, 'reporte_gastos_materiales_proyectos', 'view', 1),
(187, 2, 'reporte_gastos_materiales_proyectos', 'view', 1),
(188, 3, 'reporte_gastos_materiales_proyectos', 'view', 0),
(189, 4, 'reporte_gastos_materiales_proyectos', 'view', 0),
(190, 1, 'colaborador_puestos', 'create', 1),
(191, 1, 'colaborador_puestos', 'view', 1),
(192, 1, 'colaborador_puestos', 'edit', 1),
(193, 1, 'colaborador_puestos', 'delete', 1),
(194, 1, 'colaborador_puestos', 'list', 1),
(195, 2, 'colaborador_puestos', 'create', 1),
(196, 2, 'colaborador_puestos', 'view', 1),
(197, 2, 'colaborador_puestos', 'edit', 1),
(198, 2, 'colaborador_puestos', 'delete', 1),
(199, 2, 'colaborador_puestos', 'list', 1),
(200, 3, 'colaborador_puestos', 'create', 0),
(201, 3, 'colaborador_puestos', 'view', 0),
(202, 3, 'colaborador_puestos', 'edit', 0),
(203, 3, 'colaborador_puestos', 'delete', 0),
(204, 3, 'colaborador_puestos', 'list', 0),
(205, 4, 'colaborador_puestos', 'create', 0),
(206, 4, 'colaborador_puestos', 'view', 0),
(207, 4, 'colaborador_puestos', 'edit', 0),
(208, 4, 'colaborador_puestos', 'delete', 0),
(209, 4, 'colaborador_puestos', 'list', 0),
(210, 1, 'configuracion', 'list', 1),
(211, 2, 'configuracion', 'list', 1),
(212, 3, 'configuracion', 'list', 0),
(213, 4, 'configuracion', 'list', 0),
(214, 1, 'proyecto_tipos_orden_cambio', 'create', 1),
(215, 1, 'proyecto_tipos_orden_cambio', 'view', 1),
(216, 1, 'proyecto_tipos_orden_cambio', 'edit', 1),
(217, 1, 'proyecto_tipos_orden_cambio', 'delete', 1),
(218, 1, 'proyecto_tipos_orden_cambio', 'list', 1),
(219, 2, 'proyecto_tipos_orden_cambio', 'create', 1),
(220, 2, 'proyecto_tipos_orden_cambio', 'view', 1),
(221, 2, 'proyecto_tipos_orden_cambio', 'edit', 1),
(222, 2, 'proyecto_tipos_orden_cambio', 'delete', 1),
(223, 2, 'proyecto_tipos_orden_cambio', 'list', 1),
(224, 3, 'proyecto_tipos_orden_cambio', 'create', 0),
(225, 3, 'proyecto_tipos_orden_cambio', 'view', 0),
(226, 3, 'proyecto_tipos_orden_cambio', 'edit', 0),
(227, 3, 'proyecto_tipos_orden_cambio', 'delete', 0),
(228, 3, 'proyecto_tipos_orden_cambio', 'list', 0),
(229, 4, 'proyecto_tipos_orden_cambio', 'create', 0),
(230, 4, 'proyecto_tipos_orden_cambio', 'view', 0),
(231, 4, 'proyecto_tipos_orden_cambio', 'edit', 0),
(232, 4, 'proyecto_tipos_orden_cambio', 'delete', 0),
(233, 4, 'proyecto_tipos_orden_cambio', 'list', 0),
(234, 1, 'material', 'create', 1),
(235, 1, 'material', 'view', 1),
(236, 1, 'material', 'edit', 1),
(237, 1, 'material', 'delete', 1),
(238, 1, 'material', 'list', 1),
(239, 2, 'material', 'create', 1),
(240, 2, 'material', 'view', 1),
(241, 2, 'material', 'edit', 1),
(242, 2, 'material', 'delete', 1),
(243, 2, 'material', 'list', 1),
(244, 3, 'material', 'create', 0),
(245, 3, 'material', 'view', 0),
(246, 3, 'material', 'edit', 0),
(247, 3, 'material', 'delete', 0),
(248, 3, 'material', 'list', 0),
(249, 4, 'material', 'create', 0),
(250, 4, 'material', 'view', 0),
(251, 4, 'material', 'edit', 0),
(252, 4, 'material', 'delete', 0),
(253, 4, 'material', 'list', 0),
(254, 1, 'material_unidad', 'create', 1),
(255, 1, 'material_unidad', 'view', 1),
(256, 1, 'material_unidad', 'edit', 1),
(257, 1, 'material_unidad', 'delete', 1),
(258, 1, 'material_unidad', 'list', 1),
(259, 2, 'material_unidad', 'create', 1),
(260, 2, 'material_unidad', 'view', 1),
(261, 2, 'material_unidad', 'edit', 1),
(262, 2, 'material_unidad', 'delete', 1),
(263, 2, 'material_unidad', 'list', 1),
(264, 3, 'material_unidad', 'create', 0),
(265, 3, 'material_unidad', 'view', 0),
(266, 3, 'material_unidad', 'edit', 0),
(267, 3, 'material_unidad', 'delete', 0),
(268, 3, 'material_unidad', 'list', 0),
(269, 4, 'material_unidad', 'create', 0),
(270, 4, 'material_unidad', 'view', 0),
(271, 4, 'material_unidad', 'edit', 0),
(272, 4, 'material_unidad', 'delete', 0),
(273, 4, 'material_unidad', 'list', 0),
(274, 1, 'proyecto_materiales', 'create', 1),
(275, 1, 'proyecto_materiales', 'view', 1),
(276, 1, 'proyecto_materiales', 'edit', 1),
(277, 1, 'proyecto_materiales', 'delete', 1),
(278, 1, 'proyecto_materiales', 'list', 1),
(279, 2, 'proyecto_materiales', 'create', 1),
(280, 2, 'proyecto_materiales', 'view', 1),
(281, 2, 'proyecto_materiales', 'edit', 1),
(282, 2, 'proyecto_materiales', 'delete', 1),
(283, 2, 'proyecto_materiales', 'list', 1),
(284, 3, 'proyecto_materiales', 'create', 0),
(285, 3, 'proyecto_materiales', 'view', 1),
(286, 3, 'proyecto_materiales', 'edit', 0),
(287, 3, 'proyecto_materiales', 'delete', 0),
(288, 3, 'proyecto_materiales', 'list', 1),
(289, 4, 'proyecto_materiales', 'create', 0),
(290, 4, 'proyecto_materiales', 'view', 0),
(291, 4, 'proyecto_materiales', 'edit', 0),
(292, 4, 'proyecto_materiales', 'delete', 0),
(293, 4, 'proyecto_materiales', 'list', 0),
(294, 1, 'proyecto_materiales_cotizacion', 'list', 1),
(295, 2, 'proyecto_materiales_cotizacion', 'list', 1),
(296, 3, 'proyecto_materiales_cotizacion', 'list', 0),
(297, 4, 'proyecto_materiales_cotizacion', 'list', 0),
(298, 1, 'proyecto_materiales_proveedores', 'edit', 1),
(299, 2, 'proyecto_materiales_proveedores', 'edit', 1),
(300, 3, 'proyecto_materiales_proveedores', 'edit', 0),
(301, 4, 'proyecto_materiales_proveedores', 'edit', 0),
(302, 1, 'proyecto_materiales_cotizacion', 'create', 1),
(303, 2, 'proyecto_materiales_cotizacion', 'create', 1),
(304, 3, 'proyecto_materiales_cotizacion', 'create', 0),
(305, 4, 'proyecto_materiales_cotizacion', 'create', 0),
(306, 1, 'proyecto_materiales_solicitud_compra', 'list', 1),
(307, 2, 'proyecto_materiales_solicitud_compra', 'list', 1),
(308, 3, 'proyecto_materiales_solicitud_compra', 'list', 1),
(309, 4, 'proyecto_materiales_solicitud_compra', 'list', 0),
(310, 1, 'proyecto_materiales_solicitud_compra', 'view', 1),
(311, 2, 'proyecto_materiales_solicitud_compra', 'view', 1),
(312, 3, 'proyecto_materiales_solicitud_compra', 'view', 1),
(313, 4, 'proyecto_materiales_solicitud_compra', 'view', 0),
(314, 1, 'proyecto_materiales_solicitud_compra', 'create', 1),
(315, 2, 'proyecto_materiales_solicitud_compra', 'create', 1),
(316, 3, 'proyecto_materiales_solicitud_compra', 'create', 1),
(317, 4, 'proyecto_materiales_solicitud_compra', 'create', 0),
(318, 1, 'proyecto_materiales_solicitud_compra', 'edit', 1),
(319, 2, 'proyecto_materiales_solicitud_compra', 'edit', 1),
(320, 3, 'proyecto_materiales_solicitud_compra', 'edit', 0),
(321, 4, 'proyecto_materiales_solicitud_compra', 'edit', 0),
(322, 1, 'proyecto_materiales_solicitud_compra', 'delete', 1),
(323, 2, 'proyecto_materiales_solicitud_compra', 'delete', 0),
(324, 3, 'proyecto_materiales_solicitud_compra', 'delete', 0),
(325, 4, 'proyecto_materiales_solicitud_compra', 'delete', 0),
(326, 1, 'proyecto_materiales_solicitud_compra_proforma', 'list', 1),
(327, 2, 'proyecto_materiales_solicitud_compra_proforma', 'list', 1),
(328, 3, 'proyecto_materiales_solicitud_compra_proforma', 'list', 0),
(329, 4, 'proyecto_materiales_solicitud_compra_proforma', 'list', 0),
(330, 1, 'proyecto_materiales_solicitud_compra_proforma', 'view', 1),
(331, 2, 'proyecto_materiales_solicitud_compra_proforma', 'view', 1),
(332, 3, 'proyecto_materiales_solicitud_compra_proforma', 'view', 0),
(333, 4, 'proyecto_materiales_solicitud_compra_proforma', 'view', 0),
(334, 1, 'proyecto_materiales_solicitud_compra_proforma', 'create', 1),
(335, 2, 'proyecto_materiales_solicitud_compra_proforma', 'create', 1),
(336, 3, 'proyecto_materiales_solicitud_compra_proforma', 'create', 0),
(337, 4, 'proyecto_materiales_solicitud_compra_proforma', 'create', 0),
(338, 1, 'proyecto_materiales_solicitud_compra_proforma', 'edit', 1),
(339, 2, 'proyecto_materiales_solicitud_compra_proforma', 'edit', 1),
(340, 3, 'proyecto_materiales_solicitud_compra_proforma', 'edit', 0),
(341, 4, 'proyecto_materiales_solicitud_compra_proforma', 'edit', 0),
(342, 1, 'proyecto_materiales_solicitud_compra_proforma', 'delete', 1),
(343, 2, 'proyecto_materiales_solicitud_compra_proforma', 'delete', 0),
(344, 3, 'proyecto_materiales_solicitud_compra_proforma', 'delete', 0),
(345, 4, 'proyecto_materiales_solicitud_compra_proforma', 'delete', 0),
(346, 1, 'proyecto_materiales_solicitud_compra_orden_compra', 'list', 1),
(347, 2, 'proyecto_materiales_solicitud_compra_orden_compra', 'list', 1),
(348, 3, 'proyecto_materiales_solicitud_compra_orden_compra', 'list', 0),
(349, 4, 'proyecto_materiales_solicitud_compra_orden_compra', 'list', 0),
(350, 1, 'proyecto_materiales_solicitud_compra_orden_compra', 'view', 1),
(351, 2, 'proyecto_materiales_solicitud_compra_orden_compra', 'view', 1),
(352, 3, 'proyecto_materiales_solicitud_compra_orden_compra', 'view', 0),
(353, 4, 'proyecto_materiales_solicitud_compra_orden_compra', 'view', 0),
(354, 1, 'proyecto_materiales_solicitud_compra_orden_compra', 'create', 1),
(355, 2, 'proyecto_materiales_solicitud_compra_orden_compra', 'create', 1),
(356, 3, 'proyecto_materiales_solicitud_compra_orden_compra', 'create', 0),
(357, 4, 'proyecto_materiales_solicitud_compra_orden_compra', 'create', 0),
(358, 1, 'proyecto_materiales_solicitud_compra_orden_compra', 'edit', 1),
(359, 2, 'proyecto_materiales_solicitud_compra_orden_compra', 'edit', 1),
(360, 3, 'proyecto_materiales_solicitud_compra_orden_compra', 'edit', 0),
(361, 4, 'proyecto_materiales_solicitud_compra_orden_compra', 'edit', 0),
(362, 1, 'proyecto_materiales_solicitud_compra_orden_compra', 'delete', 1),
(363, 2, 'proyecto_materiales_solicitud_compra_orden_compra', 'delete', 0),
(364, 3, 'proyecto_materiales_solicitud_compra_orden_compra', 'delete', 0),
(365, 4, 'proyecto_materiales_solicitud_compra_orden_compra', 'delete', 0);

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
-- Indices de la tabla `cliente_calificacion`
--
ALTER TABLE `cliente_calificacion`
  ADD PRIMARY KEY (`cliente_calificacion_id`);

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
-- Indices de la tabla `impuesto`
--
ALTER TABLE `impuesto`
  ADD PRIMARY KEY (`impuesto_id`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`);

--
-- Indices de la tabla `material_unidad`
--
ALTER TABLE `material_unidad`
  ADD PRIMARY KEY (`material_unidad_id`);

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
-- Indices de la tabla `proyecto_gasto_material`
--
ALTER TABLE `proyecto_gasto_material`
  ADD PRIMARY KEY (`proyecto_gasto_material_id`);

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
-- Indices de la tabla `proyecto_material`
--
ALTER TABLE `proyecto_material`
  ADD PRIMARY KEY (`proyecto_material_id`);

--
-- Indices de la tabla `proyecto_material_detalle`
--
ALTER TABLE `proyecto_material_detalle`
  ADD PRIMARY KEY (`proyecto_material_detalle_id`);

--
-- Indices de la tabla `proyecto_material_estado`
--
ALTER TABLE `proyecto_material_estado`
  ADD PRIMARY KEY (`proyecto_material_estado_id`);

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
-- Indices de la tabla `proyecto_material_solicitud_compra_orden_compra`
--
ALTER TABLE `proyecto_material_solicitud_compra_orden_compra`
  ADD PRIMARY KEY (`proyecto_material_solicitud_compra_orden_compra_id`);

--
-- Indices de la tabla `proyecto_material_solicitud_compra_orden_compra_estado`
--
ALTER TABLE `proyecto_material_solicitud_compra_orden_compra_estado`
  ADD PRIMARY KEY (`proyecto_material_solicitud_compra_orden_compra_estado_id`);

--
-- Indices de la tabla `proyecto_material_solicitud_compra_proforma`
--
ALTER TABLE `proyecto_material_solicitud_compra_proforma`
  ADD PRIMARY KEY (`proyecto_material_solicitud_compra_proforma_id`);

--
-- Indices de la tabla `proyecto_material_solicitud_compra_proforma_estado`
--
ALTER TABLE `proyecto_material_solicitud_compra_proforma_estado`
  ADD PRIMARY KEY (`proyecto_material_solicitud_compra_proforma_estado_id`);

--
-- Indices de la tabla `proyecto_material_solicitud_cotizacion`
--
ALTER TABLE `proyecto_material_solicitud_cotizacion`
  ADD PRIMARY KEY (`proyecto_material_solicitud_cotizacion_id`);

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
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `cliente_calificacion`
--
ALTER TABLE `cliente_calificacion`
  MODIFY `cliente_calificacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `cliente_correo`
--
ALTER TABLE `cliente_correo`
  MODIFY `cliente_correo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `cliente_telefono`
--
ALTER TABLE `cliente_telefono`
  MODIFY `cliente_telefono_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT de la tabla `colaborador`
--
ALTER TABLE `colaborador`
  MODIFY `colaborador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `colaborador_costo_hora`
--
ALTER TABLE `colaborador_costo_hora`
  MODIFY `colaborador_costo_hora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT de la tabla `colaborador_puesto`
--
ALTER TABLE `colaborador_puesto`
  MODIFY `colaborador_puesto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `distrito`
--
ALTER TABLE `distrito`
  MODIFY `distrito_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=486;
--
-- AUTO_INCREMENT de la tabla `impuesto`
--
ALTER TABLE `impuesto`
  MODIFY `impuesto_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `material_unidad`
--
ALTER TABLE `material_unidad`
  MODIFY `material_unidad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `moneda`
--
ALTER TABLE `moneda`
  MODIFY `moneda_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `proveedor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `proveedor_correo`
--
ALTER TABLE `proveedor_correo`
  MODIFY `proveedor_correo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `proveedor_telefono`
--
ALTER TABLE `proveedor_telefono`
  MODIFY `proveedor_telefono_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `provincia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `proyecto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `proyecto_colaborador`
--
ALTER TABLE `proyecto_colaborador`
  MODIFY `proyecto_colaborador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT de la tabla `proyecto_estado`
--
ALTER TABLE `proyecto_estado`
  MODIFY `proyecto_estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto`
--
ALTER TABLE `proyecto_gasto`
  MODIFY `proyecto_gasto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto_detalle`
--
ALTER TABLE `proyecto_gasto_detalle`
  MODIFY `proyecto_gasto_detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto_estado`
--
ALTER TABLE `proyecto_gasto_estado`
  MODIFY `proyecto_gasto_estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto_mano_obra`
--
ALTER TABLE `proyecto_gasto_mano_obra`
  MODIFY `proyecto_gasto_mano_obra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto_material`
--
ALTER TABLE `proyecto_gasto_material`
  MODIFY `proyecto_gasto_material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto_monto`
--
ALTER TABLE `proyecto_gasto_monto`
  MODIFY `proyecto_gasto_monto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;
--
-- AUTO_INCREMENT de la tabla `proyecto_gasto_tipo`
--
ALTER TABLE `proyecto_gasto_tipo`
  MODIFY `proyecto_gasto_tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proyecto_material`
--
ALTER TABLE `proyecto_material`
  MODIFY `proyecto_material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `proyecto_material_detalle`
--
ALTER TABLE `proyecto_material_detalle`
  MODIFY `proyecto_material_detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `proyecto_material_estado`
--
ALTER TABLE `proyecto_material_estado`
  MODIFY `proyecto_material_estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_compra`
--
ALTER TABLE `proyecto_material_solicitud_compra`
  MODIFY `proyecto_material_solicitud_compra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_compra_detalle`
--
ALTER TABLE `proyecto_material_solicitud_compra_detalle`
  MODIFY `proyecto_material_solicitud_compra_detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_compra_estado`
--
ALTER TABLE `proyecto_material_solicitud_compra_estado`
  MODIFY `proyecto_material_solicitud_compra_estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_compra_orden_compra`
--
ALTER TABLE `proyecto_material_solicitud_compra_orden_compra`
  MODIFY `proyecto_material_solicitud_compra_orden_compra_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_compra_orden_compra_estado`
--
ALTER TABLE `proyecto_material_solicitud_compra_orden_compra_estado`
  MODIFY `proyecto_material_solicitud_compra_orden_compra_estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_compra_proforma`
--
ALTER TABLE `proyecto_material_solicitud_compra_proforma`
  MODIFY `proyecto_material_solicitud_compra_proforma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_compra_proforma_estado`
--
ALTER TABLE `proyecto_material_solicitud_compra_proforma_estado`
  MODIFY `proyecto_material_solicitud_compra_proforma_estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_cotizacion`
--
ALTER TABLE `proyecto_material_solicitud_cotizacion`
  MODIFY `proyecto_material_solicitud_cotizacion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `proyecto_tipo_cambio`
--
ALTER TABLE `proyecto_tipo_cambio`
  MODIFY `proyecto_tipo_cambio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `proyecto_valor_oferta`
--
ALTER TABLE `proyecto_valor_oferta`
  MODIFY `proyecto_valor_oferta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;
--
-- AUTO_INCREMENT de la tabla `proyecto_valor_oferta_extension_detalle`
--
ALTER TABLE `proyecto_valor_oferta_extension_detalle`
  MODIFY `proyecto_valor_oferta_extension_detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `proyecto_valor_oferta_extension_tipo`
--
ALTER TABLE `proyecto_valor_oferta_extension_tipo`
  MODIFY `proyecto_valor_oferta_extension_tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `proyecto_valor_oferta_tipo`
--
ALTER TABLE `proyecto_valor_oferta_tipo`
  MODIFY `proyecto_valor_oferta_tipo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `usuario_bitacora_cambios`
--
ALTER TABLE `usuario_bitacora_cambios`
  MODIFY `usuario_bitacora_cambio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT de la tabla `usuario_bitacora_ingreso`
--
ALTER TABLE `usuario_bitacora_ingreso`
  MODIFY `usuario_bitacora_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;
--
-- AUTO_INCREMENT de la tabla `usuario_colaborador`
--
ALTER TABLE `usuario_colaborador`
  MODIFY `usuario_colaborador_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `usuario_detalle`
--
ALTER TABLE `usuario_detalle`
  MODIFY `usuario_detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
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
  MODIFY `usuario_rol_permiso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=366;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
