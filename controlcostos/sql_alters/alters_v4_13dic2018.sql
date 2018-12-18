
DROP TABLE IF EXISTS `proyecto_valor_oferta_extension_estado`;
CREATE TABLE IF NOT EXISTS `proyecto_valor_oferta_extension_estado` (
  `proyecto_valor_oferta_extension_estado_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de estado de extension',
  `proyecto_valor_oferta_extension_estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`proyecto_valor_oferta_extension_estado_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_valor_oferta_extension_estado`
--

INSERT INTO `proyecto_valor_oferta_extension_estado` (`proyecto_valor_oferta_extension_estado_id`, `proyecto_valor_oferta_extension_estado`) VALUES
(1, 'Pendiente'),
(2, 'Aprobado');
COMMIT;


--
-- Estructura de tabla para la tabla `proyecto_valor_oferta_extension`
--

DROP TABLE IF EXISTS `proyecto_valor_oferta_extension`;
CREATE TABLE IF NOT EXISTS `proyecto_valor_oferta_extension` (
  `proyecto_valor_oferta_extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_valor_oferta_id` int(11) NOT NULL,
  `proyecto_valor_oferta_extension_estado_id` int(11) NOT NULL,
  `tiene_impuesto` int(1) NOT NULL,
  `impuesto` float(10,2) NOT NULL,
  PRIMARY KEY (`proyecto_valor_oferta_extension_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
COMMIT;


--
-- Estructura de tabla para la tabla `proyecto_valor_oferta_extension_cambio`
--

DROP TABLE IF EXISTS `proyecto_valor_oferta_extension_cambio`;
CREATE TABLE IF NOT EXISTS `proyecto_valor_oferta_extension_cambio` (
  `proyecto_valor_oferta_extension_cambio_id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_valor_oferta_extension_id` int(11) NOT NULL,
  `proyecto_valor_oferta_extension_tipo_id` int(11) NOT NULL,
  `tipo_cambio` int(11) NOT NULL COMMENT '1 = Extra, 2 = Nota de Credito',
  `lamina_arquitectonica` int(11) NOT NULL,
  `cantidad` float(20,2) NOT NULL,
  `proyecto_valor_oferta_extension_unidad_id` int(11) NOT NULL,
  `moneda_id` int(11) NOT NULL,
  `precio_unitario` float(20,2) NOT NULL,
  `total` float(20,2) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`proyecto_valor_oferta_extension_cambio_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
COMMIT;


--
-- Estructura de tabla para la tabla `proyecto_valor_oferta_extension_unidad`
--

DROP TABLE IF EXISTS `proyecto_valor_oferta_extension_unidad`;
CREATE TABLE IF NOT EXISTS `proyecto_valor_oferta_extension_unidad` (
  `proyecto_valor_oferta_extension_unidad_id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_valor_oferta_extension_unidad` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `proyecto_valor_oferta_extension_unidad_plural` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `proyecto_valor_oferta_extension_unidad_simbolo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`proyecto_valor_oferta_extension_unidad_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_valor_oferta_extension_unidad`
--

INSERT INTO `proyecto_valor_oferta_extension_unidad` (`proyecto_valor_oferta_extension_unidad_id`, `proyecto_valor_oferta_extension_unidad`, `proyecto_valor_oferta_extension_unidad_plural`, `proyecto_valor_oferta_extension_unidad_simbolo`) VALUES
(1, 'Metro cuadrado', 'Metros cuadrados', 'm2'),
(2, 'Metro lineal', 'Metros lineales', 'm'),
(3, 'Global', 'Globales', 'g'),
(4, 'Unidad', 'Unidades', 'u');
COMMIT;