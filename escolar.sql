-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-11-2020 a las 16:37:02
-- Versión del servidor: 10.3.25-MariaDB-0ubuntu0.20.04.1
-- Versión de PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `escolar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` bigint(20) NOT NULL COMMENT 'cedula',
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

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombres`, `apellidos`, `nacionalidad`, `Lnaciomiento`, `fecha`, `edad`, `sexo`, `plantelAnterior`, `religion`, `correo`, `statud`) VALUES
(12532605110, 'noami', 'torres', 'null', 'caracas', '2010-09-17', 10, 1, 'N/A', 'N/A', 'admin@hidrocapital.com.ve', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `aula` (
  `id` int(11) NOT NULL,
  `aula` varchar(100) NOT NULL,
  `grado` int(11) NOT NULL,
  `seccion` int(11) NOT NULL,
  `cupos` int(11) NOT NULL,
  `disponibilidad` int(11) NOT NULL,
  `statud` tinyint(4) NOT NULL DEFAULT 1,
  `periodo_escolar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`id`, `aula`, `grado`, `seccion`, `cupos`, `disponibilidad`, `statud`, `periodo_escolar`) VALUES
(1, 'Negro primero', 4, 1, 20, 19, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bienestar_social`
--

CREATE TABLE `bienestar_social` (
  `id` int(11) NOT NULL,
  `alumno` bigint(11) NOT NULL,
  `descripcion_impedimento_físico` text NOT NULL,
  `descripcion_tratamiento` text NOT NULL,
  `descripcion_vacunas` text NOT NULL,
  `peso` int(11) NOT NULL,
  `estatura` int(11) NOT NULL,
  `canaima` varchar(100) NOT NULL,
  `Grupo_Sanguíneo` varchar(100) NOT NULL,
  `Control_Pediátrico` varchar(100) NOT NULL,
  `Control_Nutricional` varchar(100) NOT NULL,
  `enfermedades_virales` longtext NOT NULL,
  `enfermedades_cronicas` longtext NOT NULL,
  `enfermedad` varchar(100) NOT NULL,
  `tratamiento` varchar(100) NOT NULL,
  `impedimento_físico` varchar(100) NOT NULL,
  `tarjeta_vacunas` varchar(100) NOT NULL,
  `descripcion_enfermedad` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `bienestar_social`
--

INSERT INTO `bienestar_social` (`id`, `alumno`, `descripcion_impedimento_físico`, `descripcion_tratamiento`, `descripcion_vacunas`, `peso`, `estatura`, `canaima`, `Grupo_Sanguíneo`, `Control_Pediátrico`, `Control_Nutricional`, `enfermedades_virales`, `enfermedades_cronicas`, `enfermedad`, `tratamiento`, `impedimento_físico`, `tarjeta_vacunas`, `descripcion_enfermedad`) VALUES
(7, 12532605110, '', 'coñaza 3 veces al dia', 'a:9:{s:13:\"Antirotavirus\";s:2:\"si\";s:15:\"Antihepatitis_B\";s:2:\"si\";s:17:\"Triple_bacteriana\";s:2:\"si\";s:16:\"Trivalente_viral\";s:2:\"si\";s:13:\"Antiamerilica\";s:2:\"si\";s:11:\"Doble_viral\";s:2:\"si\";s:33:\"Antihaemophilus_influenzae_tipo_B\";s:2:\"si\";s:22:\"Antimeningococcica_B-C\";s:2:\"si\";s:16:\"Toxoide_tetanico\";s:2:\"si\";}', 12, 12, 'si', 'AB+', 'si', 'si', 'a:3:{s:7:\"Lechina\";s:2:\"si\";s:10:\"Sarampión\";s:2:\"si\";s:7:\"Rubeola\";s:2:\"si\";}', 'a:4:{s:11:\"Parotiditis\";s:2:\"si\";s:4:\"Asma\";s:2:\"si\";s:9:\"Epilepcia\";s:2:\"si\";s:8:\"Alergias\";s:2:\"si\";}', 'si', 'si', 'no', 'si', 'algo que ni el papa sabe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiares`
--

CREATE TABLE `familiares` (
  `id` int(11) NOT NULL COMMENT 'cedula',
  `nombre` varchar(150) NOT NULL,
  `apellido` varchar(150) NOT NULL,
  `ocupacion` varchar(100) NOT NULL,
  `Dtrabajo` varchar(100) NOT NULL COMMENT 'Direccion de trabajo',
  `Tlftrabajo` varchar(100) NOT NULL COMMENT 'Telefono de trabajo',
  `DHogar` varchar(100) NOT NULL COMMENT 'Direccion',
  `TlfHogar` varchar(100) NOT NULL COMMENT 'Telefono del hogar',
  `Parestesco` int(1) NOT NULL COMMENT '1 madre 2 padre 3 familiar a cargo',
  `nacionalidad` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `familiares`
--

INSERT INTO `familiares` (`id`, `nombre`, `apellido`, `ocupacion`, `Dtrabajo`, `Tlftrabajo`, `DHogar`, `TlfHogar`, `Parestesco`, `nacionalidad`) VALUES
(25326051, 'alexander pedro jose', 'torres apontes', 'informatico', 'Mariperez', '02127090000', 'caracas', '00000000000', 2, 'null');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id` int(11) NOT NULL,
  `grado` varchar(50) NOT NULL,
  `statud` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id`, `grado`, `statud`) VALUES
(1, '1° GRADO', 1),
(2, '2° GRADO', 1),
(3, '3° GRADO', 1),
(4, '4° GRADO', 1),
(5, '5° GRADO', 1),
(6, '6° GRADO', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historico`
--

CREATE TABLE `historico` (
  `id_his` int(11) NOT NULL,
  `accion` text NOT NULL,
  `type_his` tinyint(4) NOT NULL COMMENT '1 administracion 2 usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historico`
--

INSERT INTO `historico` (`id_his`, `accion`, `type_his`) VALUES
(1, 'el usuario admin a iniciado session el dia 2020-10-16 10:48:45', 1),
(2, 'el usuario admin a iniciado session el dia 2020-10-16 02:52:02', 1),
(3, 'el usuario admin a iniciado session el dia 2020-10-16 04:48:33', 1),
(4, 'el usuario admin a iniciado session el dia 2020-10-19 01:26:05', 1),
(5, 'el usuario admin a iniciado session el dia 2020-10-19 02:09:44', 1),
(6, 'el usuario admin a iniciado session el dia 2020-10-19 08:07:47', 1),
(7, 'el usuario admin a iniciado session el dia 2020-10-19 08:08:03', 1),
(8, 'el usuario admin a iniciado session el dia 2020-10-20 12:38:19', 1),
(9, 'el usuario admin a iniciado session el dia 2020-10-21 03:56:38', 1),
(10, 'el usuario admin a iniciado session el dia 2020-10-21 05:15:21', 1),
(11, 'el usuario admin a iniciado session el dia 2020-10-21 06:22:16', 1),
(12, 'el usuario admin a iniciado session el dia 2020-10-24 05:02:50', 1),
(13, 'el usuario admin a iniciado session el dia 2020-10-24 05:48:13', 1),
(14, 'el usuario admin a iniciado session el dia 2020-11-06 08:47:30', 1),
(15, 'el usuario admin a iniciado session el dia 2020-11-07 04:58:56', 1),
(16, 'el usuario admin a iniciado session el dia 2020-11-15 04:27:40', 1),
(17, 'el usuario admin a iniciado session el dia 2020-11-15 06:27:05', 1),
(18, 'el usuario admin a iniciado session el dia 2020-11-16 04:33:25', 1),
(19, 'el usuario admin a iniciado session el dia 2020-11-16 04:33:59', 1),
(20, 'el usuario admin a iniciado session el dia 2020-11-16 05:12:48', 1),
(21, 'el usuario admin a iniciado session el dia 2020-11-17 11:08:57', 1),
(22, 'el usuario admin a iniciado session el dia 2020-11-17 12:59:43', 1),
(23, 'el usuario admin a iniciado session el dia 2020-11-17 03:12:27', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incripcion`
--

CREATE TABLE `incripcion` (
  `id` int(11) NOT NULL,
  `alumno` bigint(11) NOT NULL,
  `periodo_escolar` int(11) NOT NULL,
  `representante` int(11) NOT NULL,
  `aula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `incripcion`
--

INSERT INTO `incripcion` (`id`, `alumno`, `periodo_escolar`, `representante`, `aula`) VALUES
(12, 12532605110, 1, 25326051, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo_escolar`
--

CREATE TABLE `periodo_escolar` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `fecha_inicial` date NOT NULL,
  `fecha_final` date NOT NULL,
  `statud` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `periodo_escolar`
--

INSERT INTO `periodo_escolar` (`id`, `titulo`, `fecha_inicial`, `fecha_final`, `statud`) VALUES
(1, 'Perido 1', '2020-01-01', '2020-12-01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `permiso` int(11) NOT NULL,
  `persona` int(11) NOT NULL,
  `ruta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo_documento` tinyint(1) DEFAULT NULL COMMENT '0 Venezolano 1 extrajero ',
  `num_documento` varchar(20) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `tipo_documento`, `num_documento`, `direccion`, `telefono`, `email`) VALUES
(1, 'alexander torres', 0, '25326051', 'caracas', '04123082432', 'alexander20012@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pre_incripcion`
--

CREATE TABLE `pre_incripcion` (
  `id` int(11) NOT NULL,
  `fecha` varchar(100) NOT NULL,
  `alumno` bigint(20) NOT NULL,
  `grado` int(11) NOT NULL,
  `representante` int(11) DEFAULT NULL,
  `statud` int(11) NOT NULL,
  `perido_escolar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pre_incripcion`
--

INSERT INTO `pre_incripcion` (`id`, `fecha`, `alumno`, `grado`, `representante`, `statud`, `perido_escolar`) VALUES
(1, '2020-11-13', 12532605110, 4, 25326051, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `persona` int(11) NOT NULL,
  `aula` int(11) DEFAULT NULL,
  `condicion` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'Administrador', 'Administrador del sistema', 1),
(2, 'Profesor', 'Profesor del sistema', 1),
(3, 'Alumno', 'Alumno del sistema', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ruta`
--

CREATE TABLE `ruta` (
  `ruta` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `modulo` varchar(45) NOT NULL,
  `Padre` int(11) DEFAULT NULL,
  `url` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ruta`
--

INSERT INTO `ruta` (`ruta`, `icon`, `modulo`, `Padre`, `url`) VALUES
(1, 'fa fa-tasks', 'Pre-inscripcion', 0, '#'),
(2, 'fa fa-tasks', 'Administrativo', 0, '#'),
(3, 'fa fa-tasks', 'Inscripcion', 0, '#'),
(4, 'fa fa-tasks', 'Gestion escolar', 0, '#'),
(5, 'fa fa-tasks', 'Formulario', 1, 'pre-inscripcion'),
(6, 'fa fa-th', 'lista', 1, 'lista-pre-inscripcion'),
(7, 'fa fa-tasks', 'Registro usuario', 2, 'registro-usuario'),
(8, 'fa fa-tasks', 'Registro profesor', 2, 'registro-profesor'),
(9, 'fa fa-th', 'lista profesor', 2, 'lista-profesor'),
(10, 'fa fa-th', 'lista usuario', 2, 'lista-usuario'),
(11, 'fa fa-th', 'Grados', 2, 'grados'),
(12, 'fa fa-th', 'Secciones', 2, 'secciones'),
(13, 'fa fa-th', 'Aulas', 2, 'aulas'),
(14, 'fa fa-th', 'Inscripcion', 3, 'inscripcion'),
(19, 'fa fa-tasks', 'Nuevo año escolar', 4, 'nuevo-periodo_escolar'),
(20, 'fa fa-tasks', 'Cierre de año escolar', 4, 'cierre-periodo_escolar'),
(21, 'fa fa-th', 'Lista de años escolar', 4, 'lista-periodo_escolar'),
(22, 'fa fa-file', 'Constancia de estudio', 3, 'constancia_estudio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secciones`
--

CREATE TABLE `secciones` (
  `id` int(11) NOT NULL,
  `seccion` varchar(50) NOT NULL,
  `statud` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `secciones`
--

INSERT INTO `secciones` (`id`, `seccion`, `statud`) VALUES
(1, 'A', 1),
(2, 'B', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `persona` int(11) NOT NULL,
  `rol` int(11) DEFAULT NULL,
  `nick` varchar(10) DEFAULT NULL,
  `clave` varchar(64) DEFAULT NULL,
  `forgot-pass` varchar(64) DEFAULT NULL,
  `condicion` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`persona`, `rol`, `nick`, `clave`, `forgot-pass`, `condicion`) VALUES
(1, 1, 'admin', '$2y$10$V52D/iyl4XMa2ZFrHQHL1.2.9gvuqfBgw3NzgNEDfYZGvYfCKzbke', 'admin', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aula_ibfk_1` (`grado`),
  ADD KEY `aula_ibfk_2` (`seccion`),
  ADD KEY `aula_ibfk_3` (`periodo_escolar`);

--
-- Indices de la tabla `bienestar_social`
--
ALTER TABLE `bienestar_social`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumno` (`alumno`),
  ADD KEY `alumno_2` (`alumno`);

--
-- Indices de la tabla `familiares`
--
ALTER TABLE `familiares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id_his`);

--
-- Indices de la tabla `incripcion`
--
ALTER TABLE `incripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incripcion_ibfk_1` (`alumno`),
  ADD KEY `incripcion_ibfk_2` (`aula`),
  ADD KEY `incripcion_ibfk_3` (`periodo_escolar`),
  ADD KEY `representante` (`representante`);

--
-- Indices de la tabla `periodo_escolar`
--
ALTER TABLE `periodo_escolar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`permiso`),
  ADD KEY `permiso_ibfk_1` (`persona`),
  ADD KEY `permiso_ibfk_2` (`ruta`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pre_incripcion`
--
ALTER TABLE `pre_incripcion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pre_incripcion_ibfk_2` (`grado`),
  ADD KEY `pre_incripcion_ibfk_3` (`perido_escolar`),
  ADD KEY `pre_incripcion_ibfk_4` (`representante`),
  ADD KEY `pre_incripcion_ibfk_1` (`alumno`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`persona`),
  ADD KEY `profesor_ibfk_2` (`aula`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol`);

--
-- Indices de la tabla `ruta`
--
ALTER TABLE `ruta`
  ADD PRIMARY KEY (`ruta`);

--
-- Indices de la tabla `secciones`
--
ALTER TABLE `secciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`persona`),
  ADD KEY `usuario_ibfk_2` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aula`
--
ALTER TABLE `aula`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `bienestar_social`
--
ALTER TABLE `bienestar_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `historico`
--
ALTER TABLE `historico`
  MODIFY `id_his` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `incripcion`
--
ALTER TABLE `incripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `periodo_escolar`
--
ALTER TABLE `periodo_escolar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `permiso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pre_incripcion`
--
ALTER TABLE `pre_incripcion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ruta`
--
ALTER TABLE `ruta`
  MODIFY `ruta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `secciones`
--
ALTER TABLE `secciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aula`
--
ALTER TABLE `aula`
  ADD CONSTRAINT `aula_ibfk_1` FOREIGN KEY (`grado`) REFERENCES `grados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `aula_ibfk_2` FOREIGN KEY (`seccion`) REFERENCES `secciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `aula_ibfk_3` FOREIGN KEY (`periodo_escolar`) REFERENCES `periodo_escolar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `bienestar_social`
--
ALTER TABLE `bienestar_social`
  ADD CONSTRAINT `alumno_FK` FOREIGN KEY (`alumno`) REFERENCES `alumnos` (`id`);

--
-- Filtros para la tabla `incripcion`
--
ALTER TABLE `incripcion`
  ADD CONSTRAINT `incripcion_ibfk_1` FOREIGN KEY (`alumno`) REFERENCES `alumnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `incripcion_ibfk_2` FOREIGN KEY (`aula`) REFERENCES `aula` (`id`),
  ADD CONSTRAINT `incripcion_ibfk_3` FOREIGN KEY (`periodo_escolar`) REFERENCES `periodo_escolar` (`id`),
  ADD CONSTRAINT `incripcion_ibfk_4` FOREIGN KEY (`representante`) REFERENCES `familiares` (`id`);

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permiso_ibfk_1` FOREIGN KEY (`persona`) REFERENCES `usuario` (`persona`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `permiso_ibfk_2` FOREIGN KEY (`ruta`) REFERENCES `ruta` (`ruta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pre_incripcion`
--
ALTER TABLE `pre_incripcion`
  ADD CONSTRAINT `pre_incripcion_ibfk_1` FOREIGN KEY (`alumno`) REFERENCES `alumnos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pre_incripcion_ibfk_2` FOREIGN KEY (`grado`) REFERENCES `grados` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pre_incripcion_ibfk_3` FOREIGN KEY (`perido_escolar`) REFERENCES `periodo_escolar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pre_incripcion_ibfk_4` FOREIGN KEY (`representante`) REFERENCES `familiares` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`persona`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `profesor_ibfk_2` FOREIGN KEY (`aula`) REFERENCES `aula` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`persona`) REFERENCES `persona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`rol`) REFERENCES `rol` (`rol`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
