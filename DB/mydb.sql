-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-01-2021 a las 22:49:26
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mydb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agrupamiento`
--

CREATE TABLE `agrupamiento` (
  `idAgrupamiento` int(11) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `Grupo_idGrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `agrupamiento`
--

INSERT INTO `agrupamiento` (`idAgrupamiento`, `Usuario_idUsuario`, `Grupo_idGrupo`) VALUES
(63, 44, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `idGrupo` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`idGrupo`, `nombre`, `descripcion`) VALUES
(22, 'Becas', 'Para becas'),
(23, 'Credenciales', 'Para nuevo ingreso'),
(24, 'BEIFI', 'Para becas BEIFI'),
(25, 'Delfín', 'Grupo Delfín ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificacion`
--

CREATE TABLE `notificacion` (
  `idNotificacion` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `Grupo_idGrupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `notificacion`
--

INSERT INTO `notificacion` (`idNotificacion`, `titulo`, `descripcion`, `fecha`, `Grupo_idGrupo`) VALUES
(34, 'Becas', 'Descripción de ejemplo', '2021-01-19 15:41:35', 22),
(35, 'Credenciales', 'Descripción de ejemplo para credenciales', '2021-01-19 15:44:25', 23),
(36, 'BEIFI', 'Ejemplo de descripción para BEIFI', '2021-01-19 15:45:07', 24),
(37, 'Delfín ', 'Ejemplo de descripción para los delfines', '2021-01-19 15:45:56', 25),
(39, 'EJEMPLO', 'ddddddddddddddddd', '2021-01-20 10:11:21', 22),
(40, 'aaaaaaaaaaaaaaa', 'oeuoeu', '2021-01-20 10:11:51', 23),
(41, 'bbbbbbbbbbb', 'IEUIEUI', '2021-01-20 10:11:59', 23),
(42, 'EUIEUI', 'IEUIUEI', '2021-01-20 10:12:04', 25),
(43, 'UIEUI', 'EUIEUI', '2021-01-20 10:12:10', 22),
(44, 'IHDIUID', 'IEUIUEIUE', '2021-01-20 10:12:18', 23),
(45, 'EUIEUI', 'UEIEUIEUI', '2021-01-20 10:12:27', 23),
(46, 'Test app', 'Nel', '2021-01-25 15:58:02', 22),
(47, 'Test2', 'TT', '2021-01-25 16:00:04', 23),
(48, 'CCCCCCCCCCC', '................', '2021-01-26 08:18:53', 22),
(49, 'ce1', 'rotuoa', '2021-01-26 08:26:31', 22),
(50, 'jjjjjjjj', '................', '2021-01-26 08:27:28', 22),
(51, 'a8', '................', '2021-01-26 08:28:20', 23),
(52, 'a8', '................', '2021-01-26 08:28:26', 23),
(53, 'a1', 'a1', '2021-01-26 08:30:28', 23),
(54, 'jjjjjjjj', '................', '2021-01-26 08:31:14', 22),
(55, 'a3', 'aaaaaaaaaaaaaaaa', '2021-01-26 08:35:17', 23),
(56, 'a9', '................', '2021-01-26 08:36:14', 24),
(57, 'a8', '................', '2021-01-26 08:36:50', 23),
(58, 'a3', '................', '2021-01-26 08:42:19', 23),
(59, 'a3', '................', '2021-01-26 08:45:09', 24),
(60, 'Nuevo', '................', '2021-01-26 08:46:25', 22),
(61, 'Nuevo', '................', '2021-01-26 08:46:26', 22),
(62, ',.p,', 'uaoeu', '2021-01-26 08:47:12', 22),
(63, 'a10', 'oeuoeu', '2021-01-26 08:48:09', 23),
(64, 'ouoeu', 'aoeuao', '2021-01-26 08:49:45', 24),
(65, 'ouoeu', 'aoeuao', '2021-01-26 08:52:55', 24),
(66, 'aoe', 'aoeu', '2021-01-26 08:58:47', 23),
(67, 'aoe', 'aoeu', '2021-01-26 09:01:12', 23),
(68, 'Nuevo', '................', '2021-01-26 09:22:14', 23),
(69, 'ueou', '................', '2021-01-26 09:30:33', 23),
(70, 'ueou', '................', '2021-01-26 09:37:55', 23),
(71, 'ueou', '................', '2021-01-26 09:38:00', 23),
(72, 'ueou', '................', '2021-01-26 09:51:27', 23),
(73, 'ueou', '................', '2021-01-26 10:10:44', 23),
(74, 'ueou', '................', '2021-01-26 10:12:00', 23),
(75, 'ueou', '................', '2021-01-26 10:15:06', 23),
(76, 'ueou', '................', '2021-01-26 10:15:18', 23),
(77, 'ueou', '................', '2021-01-26 10:15:49', 23),
(78, 'jjjjjjjj', '................', '2021-01-26 10:21:47', 23),
(79, 'jjjjjjjj', '................', '2021-01-26 10:22:08', 23),
(80, 'jjjjjjjj', '................', '2021-01-26 10:36:53', 23),
(81, 'jjjjjjjj', '................', '2021-01-26 10:37:36', 23),
(82, 'jjjjjjjj', '................', '2021-01-26 10:42:15', 23),
(83, 'jjjjjjjj', '................', '2021-01-26 10:43:14', 23),
(84, 'jjjjjjjj', '................', '2021-01-26 10:43:35', 23),
(85, 'jjjjjjjj', '................', '2021-01-26 10:43:49', 23),
(86, 'jjjjjjjj', '................', '2021-01-26 10:44:08', 23),
(87, 'jjjjjjjj', '................', '2021-01-26 10:44:14', 23),
(88, 'jjjjjjjj', '................', '2021-01-26 10:44:57', 23),
(89, 'jjjjjjjj', '................', '2021-01-26 10:46:10', 23),
(90, 'jjjjjjjj', '................', '2021-01-26 11:03:08', 23),
(91, 'jjjjjjjj', '................', '2021-01-26 11:03:20', 23),
(92, 'jjjjjjjj', '................', '2021-01-26 11:06:42', 23),
(93, 'jjjjjjjj', '................', '2021-01-26 11:07:39', 23),
(94, 'jjjjjjjj', '................', '2021-01-26 11:07:40', 23),
(95, 'jjjjjjjj', '................', '2021-01-26 11:08:57', 23),
(96, 'jjjjjjjj', '................', '2021-01-26 11:12:58', 23),
(97, 'jjjjjjjj', '................', '2021-01-26 11:13:12', 23),
(98, 'jjjjjjjj', '................', '2021-01-26 11:14:08', 23),
(99, 'jjjjjjjj', '................', '2021-01-26 11:14:39', 23),
(100, 'jjjjjjjj', '................', '2021-01-26 11:15:01', 23),
(101, 'jjjjjjjj', 'aaaaaaaaaaaaaaaa', '2021-01-26 11:15:33', 22),
(102, 'jjjjjjjj', 'aaaaaaaaaaaaaaaa', '2021-01-26 11:18:37', 22),
(103, 'jjjjjjjj', 'aaaaaaaaaaaaaaaa', '2021-01-26 11:21:26', 22),
(104, 'jjjjjjjj', 'aaaaaaaaaaaaaaaa', '2021-01-26 11:21:37', 22),
(105, 'jjjjjjjj', 'aaaaaaaaaaaaaaaa', '2021-01-26 11:21:46', 22),
(106, 'jjjjjjjj', 'aaaaaaaaaaaaaaaa', '2021-01-26 11:21:50', 22),
(107, 'jjjjjjjj', 'aaaaaaaaaaaaaaaa', '2021-01-26 11:22:27', 22),
(108, 'jjjjjjjj', 'aaaaaaaaaaaaaaaa', '2021-01-26 11:22:34', 22),
(109, 'jjjjjjjj', 'aaaaaaaaaaaaaaaa', '2021-01-26 11:22:40', 22),
(110, 'jjjjjjjj', 'aaaaaaaaaaaaaaaa', '2021-01-26 11:22:49', 22),
(111, 'ueou', '................', '2021-01-26 14:16:09', 22),
(112, 'ueou', '................', '2021-01-26 14:16:52', 22),
(113, 'ueou', '................', '2021-01-26 14:17:13', 22),
(114, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:17:51', 23),
(115, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:19:23', 23),
(116, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:28:31', 23),
(117, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:28:32', 23),
(118, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:28:43', 23),
(119, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:33:10', 23),
(120, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:38:10', 23),
(121, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:38:25', 23),
(122, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:38:43', 23),
(123, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:38:44', 23),
(124, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:39:07', 23),
(125, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:44:10', 23),
(126, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:44:19', 23),
(127, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:45:27', 23),
(128, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:46:15', 23),
(129, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:46:55', 23),
(130, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:48:43', 23),
(131, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:48:59', 23),
(132, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:50:06', 23),
(133, 'jjjjjjjj', 'oeuoeu', '2021-01-26 14:50:21', 23),
(134, 'chido', 'vamos', '2021-01-26 14:53:51', 23),
(135, '11111', '777777777', '2021-01-26 14:56:31', 22),
(136, '11111', '777777777', '2021-01-26 14:56:34', 22),
(137, 'h', 'h', '2021-01-26 14:57:00', 23),
(138, 'Hola', 'como estas', '2021-01-26 15:09:19', 22),
(139, 'Hola', 'como estas', '2021-01-26 15:09:25', 22),
(140, 'Hola', 'como estas', '2021-01-26 15:09:39', 23),
(141, 'Hola', 'como estas', '2021-01-26 15:09:44', 24),
(142, 'Hola', 'como estas', '2021-01-26 15:09:47', 25),
(143, 'ui', 'eoui', '2021-01-26 15:10:21', 22),
(144, 'ui', 'eoui', '2021-01-26 15:10:35', 23),
(145, 'ui', 'eoui', '2021-01-26 15:11:05', 23),
(146, 'ui', 'eoui', '2021-01-26 15:11:22', 23),
(147, 'ui', 'eoui', '2021-01-26 15:11:39', 23),
(148, 'ui', 'eoui', '2021-01-26 15:12:09', 23),
(149, 'aoeu', 'aoeu', '2021-01-26 15:12:21', 22),
(150, 'aoeu', 'aoeu', '2021-01-26 15:12:29', 23),
(151, 'oeuo', 'euoeu', '2021-01-26 15:13:21', 24),
(152, 'aoeu', 'oeuoeu', '2021-01-26 15:13:42', 24),
(153, 'oeuao', 'oaeu', '2021-01-26 15:14:11', 22),
(154, 'Becas', 'ya jala', '2021-01-26 15:14:51', 22),
(155, 'aouao', 'aoeuaoeu', '2021-01-26 15:15:39', 22),
(156, '&', '&', '2021-01-26 15:16:05', 22),
(157, '4444444', '4444444444444444', '2021-01-26 15:16:29', 22),
(158, '3333333', '3333333333333', '2021-01-26 15:16:55', 22),
(159, '222222', '222222222', '2021-01-26 15:17:31', 22),
(160, 'hhhhh', 'aaaaaaaaaaaaaaaa', '2021-01-26 15:18:26', 24),
(161, 'Haber', '................', '2021-01-26 15:34:43', 24),
(162, 'oaeu', 'aoeu', '2021-01-26 15:34:56', 24),
(163, 'cuanto tarda', 'haber', '2021-01-26 15:35:42', 24),
(164, 'jjjjjjjj', '................', '2021-01-26 15:36:14', 24),
(165, 'a3', '................', '2021-01-26 15:36:35', 24),
(166, 'a3', 'oeuoeu', '2021-01-26 15:44:43', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa`
--

CREATE TABLE `programa` (
  `idPrograma` int(11) NOT NULL,
  `Nombre` varchar(45) DEFAULT NULL,
  `Descripcion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `programa`
--

INSERT INTO `programa` (`idPrograma`, `Nombre`, `Descripcion`) VALUES
(2, 'Bioingeniería', 'Cosas de Bioingeniería'),
(3, 'Ciencias de la Computación', 'Cosas de Ciencias de la Computación'),
(4, 'Físico-Matemáticas', 'Cosas de Físico-Matemáticas'),
(5, 'Metalúrgica', 'Cosas de Metalúrgica'),
(6, 'Químico Biológicas', 'Cosas de Químico Biológicas'),
(7, 'Sociales e Inglés', 'Cosas de Sociales e Inglés'),
(8, 'Mecatrónica', 'Cosas de Mecatrónica'),
(9, 'aaa', 'aaa'),
(10, 'bbb', NULL),
(11, 'hdouth', NULL),
(12, 'Meca', NULL),
(13, 'Docente', NULL),
(14, 'Alimentos', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombrecompleto` varchar(70) DEFAULT NULL,
  `boleta` varchar(10) DEFAULT NULL,
  `token` varchar(300) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `Programa_idPrograma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombrecompleto`, `boleta`, `token`, `tipo`, `Programa_idPrograma`) VALUES
(44, 'CARLOS ZAPATA', '444', 'e12P7T-_Rry9g225RpUhET:APA91bGd-9fk5NqSmQ7XbIdTdhythWoSLin5f71iQPtl-rRR7QpXa5xN9P6GgYPpyGt8QdeJFhcAHmV9OEOOmJSj56GB8ZfmdJNWI5m_NSd8l7qR_2-J3_vgxUnqP3OYQyh2q48o6kPR', 'Alumno', 14);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `agrupamiento`
--
ALTER TABLE `agrupamiento`
  ADD PRIMARY KEY (`idAgrupamiento`),
  ADD KEY `fk_Agrupamiento_Usuario1_idx` (`Usuario_idUsuario`),
  ADD KEY `fk_Agrupamiento_Grupo1_idx` (`Grupo_idGrupo`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`idGrupo`);

--
-- Indices de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD PRIMARY KEY (`idNotificacion`),
  ADD KEY `fk_Notificacion_Grupo_idx` (`Grupo_idGrupo`);

--
-- Indices de la tabla `programa`
--
ALTER TABLE `programa`
  ADD PRIMARY KEY (`idPrograma`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`,`Programa_idPrograma`),
  ADD KEY `fk_Usuario_Programa1_idx` (`Programa_idPrograma`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `agrupamiento`
--
ALTER TABLE `agrupamiento`
  MODIFY `idAgrupamiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `idGrupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `notificacion`
--
ALTER TABLE `notificacion`
  MODIFY `idNotificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT de la tabla `programa`
--
ALTER TABLE `programa`
  MODIFY `idPrograma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `agrupamiento`
--
ALTER TABLE `agrupamiento`
  ADD CONSTRAINT `fk_Agrupamiento_Grupo1` FOREIGN KEY (`Grupo_idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Agrupamiento_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `notificacion`
--
ALTER TABLE `notificacion`
  ADD CONSTRAINT `fk_Notificacion_Grupo` FOREIGN KEY (`Grupo_idGrupo`) REFERENCES `grupo` (`idGrupo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_Usuario_Programa1` FOREIGN KEY (`Programa_idPrograma`) REFERENCES `programa` (`idPrograma`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
