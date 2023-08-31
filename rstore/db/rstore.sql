CREATE DATABASE IF NOT EXISTS `r-store`;
USE `r-store`;

CREATE TABLE IF NOT EXISTS `administradores` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(250) NOT NULL,
  `usuario` varchar(250) NOT NULL,
  `email_verificado` tinyint(1) NOT NULL,
  `password` varchar(250) DEFAULT NULL,
  `token` int(6) DEFAULT NULL,
  `fyh_creacion` date NOT NULL,
  `fyh_actualizacion` date DEFAULT NULL,
  `fyh_eliminacion` date DEFAULT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS `trabajadores` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `correo` varchar(250) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `dni` int(8) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `telefono` int(9)   NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dni` (`dni`),
  UNIQUE KEY `telefono` (`telefono`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS `detalles_trabajadores` (
  `id` int(7) NOT NULL AUTO_INCREMENT,
  `id_trabajador` int(7) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_trabajador` (`id_trabajador`),
  CONSTRAINT `detalles_trabajadores_ibfk_1` FOREIGN KEY (`id_trabajador`) REFERENCES `trabajadores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_documento` varchar(255) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `boletas_pago` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trabajador` int(7) NOT NULL,
  `id_tipo_documento` int(11),
  `fecha` date NOT NULL,
  `horas_trabajadas` decimal(5,2) NOT NULL,
  `monto_total` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id_trabajador`) REFERENCES `trabajadores` (`id`),
  FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipo_documento` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `administradores` (`id`, `nombres`, `usuario`, `email_verificado`, `password`, `token`, `fyh_creacion`, `fyh_actualizacion`, `fyh_eliminacion`, `estado`) VALUES
	(1, 'Josue Challa', 'josue@hotmail.com', 1, '21232f297a57a5a743894a0e4a801fc3', NULL, '2023-06-19', NULL, NULL, 1);
INSERT INTO `trabajadores` (`id`, `correo`, `direccion`, `dni`, `nombre`, `telefono`) VALUES
	(1, 'josue@hotmail.com', 'Av Perales 15', 33123456, 'Josue Abel', 987654321),
	(2, 'pedro@hotmail.com', 'Av. Dolores 220', 11223666, 'Pedro Quispe', 945857693),
	(3, 'mariluna.coyoche@ucsm.edu.pe', 'Calle Polar 45', 78945612, 'Mariluna Coyoche', 910048404),
	(4, 'milixd@nttdata.edu.pe', 'José Olaya 121', 62703963, 'Milagros Mathews', 971787189),
	(5, 'francogt8000@gmail.com', 'José Olaya 121', 72703963, 'Franco Gutierrez', 932035462);
INSERT INTO `detalles_trabajadores` (`id`, `id_trabajador`, `fecha_inicio`, `salario`) VALUES
	(1, 1, '2023-06-01', 1400.00),
	(2, 2, '2023-06-01', 1400.00),
	(3, 3, '2023-06-28', 1400.00),
	(4, 4, '2023-06-28', 1400.00),
	(5, 5, '2023-06-28', 1400.00);

