ALTER TABLE `usuario_detalle` CHANGE `correo` `correo_electronico` VARCHAR(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL;

ALTER TABLE `usuario` ADD `estado_row` INT NOT NULL COMMENT '0 para inactivo, 1 para activo' AFTER `password`;