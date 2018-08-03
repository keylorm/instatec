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
ALTER TABLE `cliente` ADD `comentario` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL AFTER `clasificación_cliente`;