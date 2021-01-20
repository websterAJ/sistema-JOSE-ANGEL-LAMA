CREATE TABLE `alumnos` (
  `id` bigint(20) NOT NULL COMMENT 'cedula' PRIMARY KEY,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `nacionalidad` varchar(100) NOT NULL,
  `Lnaciomiento` varchar(100) NOT NULL COMMENT 'Lugar de nacimiento',
  `fecha` date NOT NULL,
  `edad` int(11) NOT NULL,
  `sexo` tinyint(4) NOT NULL COMMENT '0 MASCULINO 1 FEMENINO',
  `plantelAnterior` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `statud` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `aula` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `aula` varchar(100) NOT NULL,
  `grado` int(11) NOT NULL,
  `seccion` int(11) NOT NULL,
  `cupos` int(11) NOT NULL,
  `disponibilidad` int(11) NOT NULL,
  `statud` tinyint(4) NOT NULL DEFAULT 1,
  `periodo_escolar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `datos_emergencia` (
  `id` bigint(20) NOT NULL PRIMARY KEY,
  `enfermedad` tinyint(1) DEFAULT NULL,
  `detalle_enfermedad` text DEFAULT NULL,
  `terapia` tinyint(1) DEFAULT NULL,
  `detalle_terapia` varchar(100) NOT NULL,
  `alergia` tinyint(1) DEFAULT NULL,
  `detalle_alergia` text DEFAULT NULL,
  `tlfemerg` varchar(100) NOT NULL COMMENT 'Telefono de emergencia',
  `vacunas` tinyint(1) DEFAULT NULL,
  `detalle_vacunas` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `familiares` (
  `id` int(11) NOT NULL COMMENT 'cedula' PRIMARY KEY,
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `ocupacion` varchar(100) NOT NULL,
  `Dtrabajo` varchar(100) NOT NULL COMMENT 'Direccion de trabajo',
  `Tlftrabajo` varchar(100) NOT NULL COMMENT 'Telefono de trabajo',
  `DHogar` varchar(100) NOT NULL COMMENT 'Direccion',
  `TlfHogar` varchar(100) NOT NULL COMMENT 'Telefono del hogar',
  `Parestesco` int(1) NOT NULL COMMENT '1 madre 2 padre 3 familiar a cargo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `grados` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `grado` varchar(50) NOT NULL,
  `statud` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `historico` (
  `id_his` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `accion` text NOT NULL,
  `type_his` tinyint(4) NOT NULL COMMENT '1 administracion 2 usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `incripcion` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `alumno` bigint(11) NOT NULL,
  `periodo_escolar` int(11) NOT NULL,
  `aula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `periodo_escolar` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `fecha_inicial` date NOT NULL,
  `fecha_final` date NOT NULL,
  `statud` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
CREATE TABLE `permisos` (
  `permiso` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `persona` int(11) NOT NULL,
  `ruta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `persona` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo_documento` tinyint(1) DEFAULT NULL COMMENT '0 Venezolano 1 extrajero ',
  `num_documento` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `pre_incripcion` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `fecha` varchar(100) NOT NULL,
  `alumno` int(11) NOT NULL,
  `grado` int(11) NOT NULL,
  `representante` int(11) DEFAULT NULL,
  `statud` int(11) NOT NULL,
  `perido_escolar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `profesor` (
  `persona` int(11) NOT NULL PRIMARY KEY,
  `aula` int(11) DEFAULT NULL,
  `condicion` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `rol` (
  `rol` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nombre` varchar(30) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `rol` (`rol`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 'Administrador del sistema', 1),
(2, 'Profesor', 'Profesor del sistema', 1),
(3, 'Alumno', 'Alumno del sistema', 1);
CREATE TABLE `ruta` (
  `ruta` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `icon` varchar(50) NOT NULL,
  `modulo` varchar(45) NOT NULL,
  `Padre` int(11) DEFAULT NULL,
  `url` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `secciones` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `seccion` varchar(50) NOT NULL,
  `statud` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
CREATE TABLE `usuario` (
  `persona` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `rol` int(11) DEFAULT NULL,
  `nick` varchar(10) DEFAULT NULL,
  `clave` varchar(64) DEFAULT NULL,
  `avatar` varchar(25) NOT NULL,
  `forgot-pass` varchar(64) DEFAULT NULL,
  `condicion` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
INSERT INTO `usuario` (`persona`, `rol`, `nick`, `clave`, `avatar`, `forgot-pass`, `condicion`) VALUES
(1, 1, 'admin', '$2y$10$V52D/iyl4XMa2ZFrHQHL1.2.9gvuqfBgw3NzgNEDfYZGvYfCKzbke', '', 'admin', 1);