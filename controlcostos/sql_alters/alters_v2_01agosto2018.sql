-- Alter para agregar alias al colaborador
ALTER TABLE `colaborador` ADD `alias` VARCHAR(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL AFTER `apellidos`;
ALTER TABLE `colaborador` ADD `comentario` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL AFTER `telefono`;

-- Para detalle de gasto
ALTER TABLE `proyecto_gasto_detalle` ADD `gasto_detalle` TEXT CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL AFTER `numero_factura`;