
DROP TABLE IF EXISTS `proyecto_valor_oferta_extension_estado`;
CREATE TABLE IF NOT EXISTS `proyecto_valor_oferta_extension_estado` (
  `proyecto_valor_oferta_extension_estado_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID de estado de extension',
  `proyecto_valor_oferta_extension_estado` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`proyecto_valor_oferta_extension_estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_valor_oferta_extension_estado`
--

INSERT INTO `proyecto_valor_oferta_extension_estado` (`proyecto_valor_oferta_extension_estado_id`, `proyecto_valor_oferta_extension_estado`) VALUES
(1, 'Pendiente'),
(2, 'Aprobado'),
(3, 'Rechazado por cliente');
COMMIT;


--
-- Estructura de tabla para la tabla `proyecto_valor_oferta_extension`
--

DROP TABLE IF EXISTS `proyecto_valor_oferta_extension`;
CREATE TABLE IF NOT EXISTS `proyecto_valor_oferta_extension` (
  `proyecto_valor_oferta_extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_valor_oferta_id` int(11) NOT NULL,
  `proyecto_valor_oferta_extension_estado_id` int(11) NOT NULL,
  `proyecto_valor_oferta_extension_codigo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `tiene_impuesto` int(1) NOT NULL,
  `impuesto` float(10,2) NOT NULL,
  PRIMARY KEY (`proyecto_valor_oferta_extension_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
COMMIT;


--
-- Estructura de tabla para la tabla `proyecto_valor_oferta_extension_cambio`
--

DROP TABLE IF EXISTS `proyecto_valor_oferta_extension_cambio`;
CREATE TABLE IF NOT EXISTS `proyecto_valor_oferta_extension_cambio` (
  `proyecto_valor_oferta_extension_cambio_id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_valor_oferta_id` int(11) NOT NULL,
  `proyecto_valor_oferta_extension_tipo_id` int(11) NOT NULL,
  `tipo_operacion` int(11) NOT NULL COMMENT '1 = Extra, 2 = Nota de Credito',
  `lamina_arquitectonica` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` float(20,2) NOT NULL,
  `proyecto_valor_oferta_extension_unidad_id` int(11) NOT NULL,
  `moneda_id` int(11) NOT NULL,
  `precio_unitario` float(20,2) NOT NULL,
  `total` float(20,2) NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`proyecto_valor_oferta_extension_cambio_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `proyecto_valor_oferta_extension_unidad`
--

INSERT INTO `proyecto_valor_oferta_extension_unidad` (`proyecto_valor_oferta_extension_unidad_id`, `proyecto_valor_oferta_extension_unidad`, `proyecto_valor_oferta_extension_unidad_plural`, `proyecto_valor_oferta_extension_unidad_simbolo`) VALUES
(1, 'Metro cuadrado', 'Metros cuadrados', 'm2'),
(2, 'Metro lineal', 'Metros lineales', 'm'),
(3, 'Global', 'Globales', 'g'),
(4, 'Unidad', 'Unidades', 'u');
COMMIT;



DROP TABLE IF EXISTS `proyecto_valor_oferta_extension_rechazo`;
CREATE TABLE IF NOT EXISTS `proyecto_valor_oferta_extension_rechazo` (
  `proyecto_valor_oferta_extension_rechazo_id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_valor_oferta_id` int(11) NOT NULL,
  `comentarios` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`proyecto_valor_oferta_extension_rechazo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
COMMIT;



--
-- Estructura de tabla para la tabla `contacto`
--

DROP TABLE IF EXISTS `contacto`;
CREATE TABLE IF NOT EXISTS `contacto` (
  `contacto_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_contacto` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `correo_contacto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_contacto_1` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `telefono_contacto_2` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`contacto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_contacto`
--

DROP TABLE IF EXISTS `proyecto_contacto`;
CREATE TABLE IF NOT EXISTS `proyecto_contacto` (
  `proyecto_contacto_id` int(11) NOT NULL AUTO_INCREMENT,
  `proyecto_id` int(11) NOT NULL,
  `contacto_id` int(11) NOT NULL,
  PRIMARY KEY (`proyecto_contacto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;




-- Inserts de permisos 
INSERT INTO `usuario_rol_permiso` ( `usuario_rol_id`,`modulo`, `funcion`, `estado_permiso`) VALUES
(1, 'proyecto_extensiones_cambios', 'create', 1),
(1, 'proyecto_extensiones_cambios', 'view', 1),
(1, 'proyecto_extensiones_cambios', 'edit', 1),
(1, 'proyecto_extensiones_cambios', 'delete', 1),
(1, 'proyecto_extensiones_cambios', 'list', 1),
(2, 'proyecto_extensiones_cambios', 'create', 1),
(2, 'proyecto_extensiones_cambios', 'view', 1),
(2, 'proyecto_extensiones_cambios', 'edit', 1),
(2, 'proyecto_extensiones_cambios', 'delete', 1),
(2, 'proyecto_extensiones_cambios', 'list', 1),
(3, 'proyecto_extensiones_cambios', 'create', 1),
(3, 'proyecto_extensiones_cambios', 'view', 1),
(3, 'proyecto_extensiones_cambios', 'edit', 1),
(3, 'proyecto_extensiones_cambios', 'delete', 1),
(3, 'proyecto_extensiones_cambios', 'list', 1),
(4, 'proyecto_extensiones_cambios', 'create', 0),
(4, 'proyecto_extensiones_cambios', 'view', 0),
(4, 'proyecto_extensiones_cambios', 'edit', 0),
(4, 'proyecto_extensiones_cambios', 'delete', 0),
(4, 'proyecto_extensiones_cambios', 'list', 0),
(1, 'proyecto_contactos', 'create', 1),
(1, 'proyecto_contactos', 'view', 1),
(1, 'proyecto_contactos', 'edit', 1),
(1, 'proyecto_contactos', 'delete', 1),
(1, 'proyecto_contactos', 'list', 1),
(2, 'proyecto_contactos', 'create', 1),
(2, 'proyecto_contactos', 'view', 1),
(2, 'proyecto_contactos', 'edit', 1),
(2, 'proyecto_contactos', 'delete', 1),
(2, 'proyecto_contactos', 'list', 1),
(3, 'proyecto_contactos', 'create', 1),
(3, 'proyecto_contactos', 'view', 1),
(3, 'proyecto_contactos', 'edit', 1),
(3, 'proyecto_contactos', 'delete', 1),
(3, 'proyecto_contactos', 'list', 1),
(4, 'proyecto_contactos', 'create', 0),
(4, 'proyecto_contactos', 'view', 0),
(4, 'proyecto_contactos', 'edit', 0),
(4, 'proyecto_contactos', 'delete', 0),
(4, 'proyecto_contactos', 'list', 0);