
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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`material_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT;
  
-- Inserts de permisos 
INSERT INTO `usuario_rol_permiso` ( `usuario_rol_id`, `modulo`, `funcion`, `estado_permiso`) VALUES
(1, 'material', 'create', 1),
(1, 'material', 'view', 1),
(1, 'material', 'edit', 1),
(1, 'material', 'delete', 1),
(1, 'material', 'list', 1),
(2, 'material', 'create', 1),
(2, 'material', 'view', 1),
(2, 'material', 'edit', 1),
(2, 'material', 'delete', 1),
(2, 'material', 'list', 1),
(3, 'material', 'create', 0),
(3, 'material', 'view', 0),
(3, 'material', 'edit', 0),
(3, 'material', 'delete', 0),
(3, 'material', 'list', 0),
(4, 'material', 'create', 0),
(4, 'material', 'view', 0),
(4, 'material', 'edit', 0),
(4, 'material', 'delete', 0),
(4, 'material', 'list', 0);


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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `material_unidad`
--
ALTER TABLE `material_unidad`
  ADD PRIMARY KEY (`material_unidad_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `material_unidad`
--
ALTER TABLE `material_unidad`
  MODIFY `material_unidad_id` int(11) NOT NULL AUTO_INCREMENT;


  -- Inserts de permisos 
INSERT INTO `usuario_rol_permiso` ( `usuario_rol_id`, `modulo`, `funcion`, `estado_permiso`) VALUES
(1, 'material_unidad', 'create', 1),
(1, 'material_unidad', 'view', 1),
(1, 'material_unidad', 'edit', 1),
(1, 'material_unidad', 'delete', 1),
(1, 'material_unidad', 'list', 1),
(2, 'material_unidad', 'create', 1),
(2, 'material_unidad', 'view', 1),
(2, 'material_unidad', 'edit', 1),
(2, 'material_unidad', 'delete', 1),
(2, 'material_unidad', 'list', 1),
(3, 'material_unidad', 'create', 0),
(3, 'material_unidad', 'view', 0),
(3, 'material_unidad', 'edit', 0),
(3, 'material_unidad', 'delete', 0),
(3, 'material_unidad', 'list', 0),
(4, 'material_unidad', 'create', 0),
(4, 'material_unidad', 'view', 0),
(4, 'material_unidad', 'edit', 0),
(4, 'material_unidad', 'delete', 0),
(4, 'material_unidad', 'list', 0);




-- Inserts de permisos 
INSERT INTO `usuario_rol_permiso` ( `usuario_rol_id`, `modulo`, `funcion`, `estado_permiso`) VALUES
(1, 'proyecto_materiales', 'create', 1),
(1, 'proyecto_materiales', 'view', 1),
(1, 'proyecto_materiales', 'edit', 1),
(1, 'proyecto_materiales', 'delete', 1),
(1, 'proyecto_materiales', 'list', 1),
(2, 'proyecto_materiales', 'create', 1),
(2, 'proyecto_materiales', 'view', 1),
(2, 'proyecto_materiales', 'edit', 1),
(2, 'proyecto_materiales', 'delete', 1),
(2, 'proyecto_materiales', 'list', 1),
(3, 'proyecto_materiales', 'create', 0),
(3, 'proyecto_materiales', 'view', 1),
(3, 'proyecto_materiales', 'edit', 0),
(3, 'proyecto_materiales', 'delete', 0),
(3, 'proyecto_materiales', 'list', 1),
(4, 'proyecto_materiales', 'create', 0),
(4, 'proyecto_materiales', 'view', 0),
(4, 'proyecto_materiales', 'edit', 0),
(4, 'proyecto_materiales', 'delete', 0),
(4, 'proyecto_materiales', 'list', 0),
(1, 'proyecto_materiales_cotizacion', 'list', 1),
(2, 'proyecto_materiales_cotizacion', 'list', 1),
(3, 'proyecto_materiales_cotizacion', 'list', 0),
(4, 'proyecto_materiales_cotizacion', 'list', 0),
(1, 'proyecto_materiales_cotizacion', 'create', 1),
(2, 'proyecto_materiales_cotizacion', 'create', 1),
(3, 'proyecto_materiales_cotizacion', 'create', 0),
(4, 'proyecto_materiales_cotizacion', 'create', 0),
(1, 'proyecto_materiales_proveedores', 'edit', 1),
(2, 'proyecto_materiales_proveedores', 'edit', 1),
(3, 'proyecto_materiales_proveedores', 'edit', 0),
(4, 'proyecto_materiales_proveedores', 'edit', 0),
(1, 'proyecto_materiales_solicitud_compra', 'list', 1),
(2, 'proyecto_materiales_solicitud_compra', 'list', 1),
(3, 'proyecto_materiales_solicitud_compra', 'list', 1),
(4, 'proyecto_materiales_solicitud_compra', 'list', 0),
(1, 'proyecto_materiales_solicitud_compra', 'view', 1),
(2, 'proyecto_materiales_solicitud_compra', 'view', 1),
(3, 'proyecto_materiales_solicitud_compra', 'view', 1),
(4, 'proyecto_materiales_solicitud_compra', 'view', 0),
(1, 'proyecto_materiales_solicitud_compra', 'create', 1),
(2, 'proyecto_materiales_solicitud_compra', 'create', 1),
(3, 'proyecto_materiales_solicitud_compra', 'create', 1),
(4, 'proyecto_materiales_solicitud_compra', 'create', 0),
(1, 'proyecto_materiales_solicitud_compra', 'edit', 1),
(2, 'proyecto_materiales_solicitud_compra', 'edit', 1),
(3, 'proyecto_materiales_solicitud_compra', 'edit', 0),
(4, 'proyecto_materiales_solicitud_compra', 'edit', 0),
(1, 'proyecto_materiales_solicitud_compra', 'delete', 1),
(2, 'proyecto_materiales_solicitud_compra', 'delete', 0),
(3, 'proyecto_materiales_solicitud_compra', 'delete', 0),
(4, 'proyecto_materiales_solicitud_compra', 'delete', 0),
(1, 'proyecto_materiales_solicitud_compra_proforma', 'list', 1),
(2, 'proyecto_materiales_solicitud_compra_proforma', 'list', 1),
(3, 'proyecto_materiales_solicitud_compra_proforma', 'list', 0),
(4, 'proyecto_materiales_solicitud_compra_proforma', 'list', 0),
(1, 'proyecto_materiales_solicitud_compra_proforma', 'view', 1),
(2, 'proyecto_materiales_solicitud_compra_proforma', 'view', 1),
(3, 'proyecto_materiales_solicitud_compra_proforma', 'view', 0),
(4, 'proyecto_materiales_solicitud_compra_proforma', 'view', 0),
(1, 'proyecto_materiales_solicitud_compra_proforma', 'create', 1),
(2, 'proyecto_materiales_solicitud_compra_proforma', 'create', 1),
(3, 'proyecto_materiales_solicitud_compra_proforma', 'create', 0),
(4, 'proyecto_materiales_solicitud_compra_proforma', 'create', 0),
(1, 'proyecto_materiales_solicitud_compra_proforma', 'edit', 1),
(2, 'proyecto_materiales_solicitud_compra_proforma', 'edit', 1),
(3, 'proyecto_materiales_solicitud_compra_proforma', 'edit', 0),
(4, 'proyecto_materiales_solicitud_compra_proforma', 'edit', 0),
(1, 'proyecto_materiales_solicitud_compra_proforma', 'delete', 1),
(2, 'proyecto_materiales_solicitud_compra_proforma', 'delete', 0),
(3, 'proyecto_materiales_solicitud_compra_proforma', 'delete', 0),
(4, 'proyecto_materiales_solicitud_compra_proforma', 'delete', 0),
(1, 'proyecto_materiales_solicitud_compra_orden_compra', 'list', 1),
(2, 'proyecto_materiales_solicitud_compra_orden_compra', 'list', 1),
(3, 'proyecto_materiales_solicitud_compra_orden_compra', 'list', 0),
(4, 'proyecto_materiales_solicitud_compra_orden_compra', 'list', 0),
(1, 'proyecto_materiales_solicitud_compra_orden_compra', 'view', 1),
(2, 'proyecto_materiales_solicitud_compra_orden_compra', 'view', 1),
(3, 'proyecto_materiales_solicitud_compra_orden_compra', 'view', 0),
(4, 'proyecto_materiales_solicitud_compra_orden_compra', 'view', 0),
(1, 'proyecto_materiales_solicitud_compra_orden_compra', 'create', 1),
(2, 'proyecto_materiales_solicitud_compra_orden_compra', 'create', 1),
(3, 'proyecto_materiales_solicitud_compra_orden_compra', 'create', 0),
(4, 'proyecto_materiales_solicitud_compra_orden_compra', 'create', 0),
(1, 'proyecto_materiales_solicitud_compra_orden_compra', 'edit', 1),
(2, 'proyecto_materiales_solicitud_compra_orden_compra', 'edit', 1),
(3, 'proyecto_materiales_solicitud_compra_orden_compra', 'edit', 0),
(4, 'proyecto_materiales_solicitud_compra_orden_compra', 'edit', 0),
(1, 'proyecto_materiales_solicitud_compra_orden_compra', 'delete', 1),
(2, 'proyecto_materiales_solicitud_compra_orden_compra', 'delete', 0),
(3, 'proyecto_materiales_solicitud_compra_orden_compra', 'delete', 0),
(4, 'proyecto_materiales_solicitud_compra_orden_compra', 'delete', 0);



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
  `estado_registro` INT(1) NOT NULL COMMENT '1 = activo, 0 = inactivo',
  `fecha_registro` DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyecto_material`
--
ALTER TABLE `proyecto_material`
  ADD PRIMARY KEY (`proyecto_material_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto_material`
--
ALTER TABLE `proyecto_material`
  MODIFY `proyecto_material_id` int(11) NOT NULL AUTO_INCREMENT;


--
-- Estructura de tabla para la tabla `proyecto_material_estado`
--

CREATE TABLE `proyecto_material_estado` (
  `proyecto_material_estado_id` int(11) NOT NULL,
  `proyecto_material_estado` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyecto_material_estado`
--
ALTER TABLE `proyecto_material_estado`
  ADD PRIMARY KEY (`proyecto_material_estado_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto_material_estado`
--
ALTER TABLE `proyecto_material_estado`
  MODIFY `proyecto_material_estado_id` int(11) NOT NULL AUTO_INCREMENT;


INSERT INTO `proyecto_material_estado` (`proyecto_material_estado_id`, `proyecto_material_estado`) VALUES (NULL, 'Sin cotizar'), (NULL, 'Cotizado'), (NULL, 'Parcialmente Consumido'), (NULL, 'Consumido');


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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyecto_material_detalle`
--
ALTER TABLE `proyecto_material_detalle`
  ADD PRIMARY KEY (`proyecto_material_detalle_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto_material_detalle`
--
ALTER TABLE `proyecto_material_detalle`
  MODIFY `proyecto_material_detalle_id` int(11) NOT NULL AUTO_INCREMENT;


  --
-- Estructura de tabla para la tabla `impuesto`
--

CREATE TABLE `impuesto` (
  `impuesto_id` int(11) NOT NULL,
  `impuesto` float(10,2) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `estado_registro` int(1) NOT NULL COMMENT '1 = Activo, 2 = Inactivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `impuesto`
--
ALTER TABLE `impuesto`
  ADD PRIMARY KEY (`impuesto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `impuesto`
--
ALTER TABLE `impuesto`
  MODIFY `impuesto_id` int(11) NOT NULL AUTO_INCREMENT;



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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyecto_material_solicitud_cotizacion`
--
ALTER TABLE `proyecto_material_solicitud_cotizacion`
  ADD PRIMARY KEY (`proyecto_material_solicitud_cotizacion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_cotizacion`
--
ALTER TABLE `proyecto_material_solicitud_cotizacion`
  MODIFY `proyecto_material_solicitud_cotizacion_id` int(11) NOT NULL AUTO_INCREMENT;



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
  `cantidad` float(20,2) NOT NULL,
  `estado_registro` int(1) NOT NULL
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
-- Indices de la tabla `proyecto_material_solicitud_compra_proforma`
--
ALTER TABLE `proyecto_material_solicitud_compra_proforma`
  ADD PRIMARY KEY (`proyecto_material_solicitud_compra_proforma_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_compra_proforma`
--
ALTER TABLE `proyecto_material_solicitud_compra_proforma`
  MODIFY `proyecto_material_solicitud_compra_proforma_id` int(11) NOT NULL AUTO_INCREMENT;


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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyecto_material_solicitud_compra_proforma_estado`
--
ALTER TABLE `proyecto_material_solicitud_compra_proforma_estado`
  ADD PRIMARY KEY (`proyecto_material_solicitud_compra_proforma_estado_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_compra_proforma_estado`
--
ALTER TABLE `proyecto_material_solicitud_compra_proforma_estado`
  MODIFY `proyecto_material_solicitud_compra_proforma_estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;








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
-- Indices de la tabla `proyecto_material_solicitud_compra_orden_compra`
--
ALTER TABLE `proyecto_material_solicitud_compra_orden_compra`
  ADD PRIMARY KEY (`proyecto_material_solicitud_compra_orden_compra_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_compra_orden_compra`
--
ALTER TABLE `proyecto_material_solicitud_compra_orden_compra`
  MODIFY `proyecto_material_solicitud_compra_orden_compra_id` int(11) NOT NULL AUTO_INCREMENT;


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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyecto_material_solicitud_compra_orden_compra_estado`
--
ALTER TABLE `proyecto_material_solicitud_compra_orden_compra_estado`
  ADD PRIMARY KEY (`proyecto_material_solicitud_compra_orden_compra_estado_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto_material_solicitud_compra_orden_compra_estado`
--
ALTER TABLE `proyecto_material_solicitud_compra_orden_compra_estado`
  MODIFY `proyecto_material_solicitud_compra_orden_compra_estado_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;




--
-- Estructura de tabla para la tabla `proyecto_gasto_material`
--

CREATE TABLE `proyecto_gasto_material` (
  `proyecto_gasto_material_id` int(11) NOT NULL,
  `proyecto_gasto_id` int(11) NOT NULL,
  `proyecto_material_solicitud_compra_orden_compra_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `proyecto_gasto_material`
--
ALTER TABLE `proyecto_gasto_material`
  ADD PRIMARY KEY (`proyecto_gasto_material_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `proyecto_gasto_material`
--
ALTER TABLE `proyecto_gasto_material`
  MODIFY `proyecto_gasto_material_id` int(11) NOT NULL AUTO_INCREMENT;