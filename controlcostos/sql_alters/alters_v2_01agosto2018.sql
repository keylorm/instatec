-- Alter para agregar alias al colaborador
ALTER TABLE `colaborador` ADD `alias` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL AFTER `apellidos`;
ALTER TABLE `colaborador` ADD `comentario` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL AFTER `telefono`;

-- Para detalle de gasto
ALTER TABLE `proyecto_gasto_detalle` ADD `gasto_detalle` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL AFTER `numero_factura`;

-- Para clientes


--
-- Estructura de tabla para la tabla `cliente_calificacion`
--

CREATE TABLE `cliente_calificacion` (
  `cliente_calificacion_id` int(11) NOT NULL,
  `cliente_calificacion` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente_calificacion`
--
ALTER TABLE `cliente_calificacion`
  ADD PRIMARY KEY (`cliente_calificacion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente_calificacion`
--
ALTER TABLE `cliente_calificacion`
  MODIFY `cliente_calificacion_id` int(11) NOT NULL AUTO_INCREMENT;


ALTER TABLE `cliente` ADD `cliente_calificacion_id` INT(1) NOT NULL AFTER `cedula_cliente`;
ALTER TABLE `cliente` ADD `comentario` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL AFTER `cliente_calificacion_id`;




-- Inserts de permisos 
INSERT INTO `usuario_rol_permiso` ( `usuario_rol_id`, `modulo`, `funcion`, `estado_permiso`) VALUES
(1, 'colaborador_puestos', 'create', 1),
(1, 'colaborador_puestos', 'view', 1),
(1, 'colaborador_puestos', 'edit', 1),
(1, 'colaborador_puestos', 'delete', 1),
(1, 'colaborador_puestos', 'list', 1),
(2, 'colaborador_puestos', 'create', 1),
(2, 'colaborador_puestos', 'view', 1),
(2, 'colaborador_puestos', 'edit', 1),
(2, 'colaborador_puestos', 'delete', 1),
(2, 'colaborador_puestos', 'list', 1),
(3, 'colaborador_puestos', 'create', 0),
(3, 'colaborador_puestos', 'view', 0),
(3, 'colaborador_puestos', 'edit', 0),
(3, 'colaborador_puestos', 'delete', 0),
(3, 'colaborador_puestos', 'list', 0),
(4, 'colaborador_puestos', 'create', 0),
(4, 'colaborador_puestos', 'view', 0),
(4, 'colaborador_puestos', 'edit', 0),
(4, 'colaborador_puestos', 'delete', 0),
(4, 'colaborador_puestos', 'list', 0);


ALTER TABLE `colaborador_puesto` ADD `fecha_registro` DATETIME NOT NULL AFTER `puesto`;


INSERT INTO `usuario_rol_permiso` ( `usuario_rol_id`, `modulo`, `funcion`, `estado_permiso`) VALUES
(1, 'configuracion', 'list', 1),
(2, 'configuracion', 'list', 1),
(3, 'configuracion', 'list', 0),
(4, 'configuracion', 'list', 0);


INSERT INTO `usuario_rol_permiso` ( `usuario_rol_id`, `modulo`, `funcion`, `estado_permiso`) VALUES
(1, 'proyecto_tipos_orden_cambio', 'create', 1),
(1, 'proyecto_tipos_orden_cambio', 'view', 1),
(1, 'proyecto_tipos_orden_cambio', 'edit', 1),
(1, 'proyecto_tipos_orden_cambio', 'delete', 1),
(1, 'proyecto_tipos_orden_cambio', 'list', 1),
(2, 'proyecto_tipos_orden_cambio', 'create', 1),
(2, 'proyecto_tipos_orden_cambio', 'view', 1),
(2, 'proyecto_tipos_orden_cambio', 'edit', 1),
(2, 'proyecto_tipos_orden_cambio', 'delete', 1),
(2, 'proyecto_tipos_orden_cambio', 'list', 1),
(3, 'proyecto_tipos_orden_cambio', 'create', 0),
(3, 'proyecto_tipos_orden_cambio', 'view', 0),
(3, 'proyecto_tipos_orden_cambio', 'edit', 0),
(3, 'proyecto_tipos_orden_cambio', 'delete', 0),
(3, 'proyecto_tipos_orden_cambio', 'list', 0),
(4, 'proyecto_tipos_orden_cambio', 'create', 0),
(4, 'proyecto_tipos_orden_cambio', 'view', 0),
(4, 'proyecto_tipos_orden_cambio', 'edit', 0),
(4, 'proyecto_tipos_orden_cambio', 'delete', 0),
(4, 'proyecto_tipos_orden_cambio', 'list', 0);


ALTER TABLE `proyecto_valor_oferta_extension_tipo` ADD `fecha_registro` DATETIME NOT NULL AFTER `proyecto_valor_oferta_extension_tipo`;