-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-03-2022 a las 18:20:01
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_examenes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

CREATE TABLE `asignatura` (
  `ID_asignatura` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `ID_grado` int(11) DEFAULT NULL,
  `ID_coordinador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura-alumno`
--

CREATE TABLE `asignatura-alumno` (
  `ID_asignatura` int(11) NOT NULL,
  `ID_estudiante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `ID_estudiante` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante-pregunta`
--

CREATE TABLE `estudiante-pregunta` (
  `ID_estudiante` int(11) NOT NULL,
  `ID_pregunta` int(11) NOT NULL,
  `respuesta_alumno` varchar(300) NOT NULL,
  `correcta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante_tema`
--

CREATE TABLE `estudiante_tema` (
  `ID_estudiante` int(11) NOT NULL,
  `ID_tema` int(11) NOT NULL,
  `Nota` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `ID_grado` int(11) NOT NULL,
  `GRADO_NOMBRE` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `ID_pregunta` int(11) NOT NULL,
  `ID_tema` int(11) NOT NULL,
  `pregunta` varchar(300) NOT NULL,
  `solucion` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `ID_profesor` int(11) NOT NULL,
  `PROFESOR_NOMBRE` varchar(50) NOT NULL,
  `DNI` varchar(9) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pass` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor-asignatura`
--

CREATE TABLE `profesor-asignatura` (
  `ID_asignatura` int(11) NOT NULL,
  `ID_profesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor_coordinador`
--

CREATE TABLE `profesor_coordinador` (
  `ID_coordinador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tema`
--

CREATE TABLE `tema` (
  `ID_tema` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `ID_asignatura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD PRIMARY KEY (`ID_asignatura`),
  ADD KEY `ID_grado` (`ID_grado`),
  ADD KEY `ID_coordinador` (`ID_coordinador`),
  ADD KEY `ID_coordinador_2` (`ID_coordinador`);

--
-- Indices de la tabla `asignatura-alumno`
--
ALTER TABLE `asignatura-alumno`
  ADD KEY `fk_asignatura` (`ID_asignatura`),
  ADD KEY `fk_estudiante` (`ID_estudiante`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`ID_estudiante`);

--
-- Indices de la tabla `estudiante-pregunta`
--
ALTER TABLE `estudiante-pregunta`
  ADD KEY `ID_estudiante` (`ID_estudiante`),
  ADD KEY `ID_pregunta` (`ID_pregunta`);

--
-- Indices de la tabla `estudiante_tema`
--
ALTER TABLE `estudiante_tema`
  ADD KEY `ID_estudiante` (`ID_estudiante`),
  ADD KEY `ID_tema` (`ID_tema`);

--
-- Indices de la tabla `grado`
--
ALTER TABLE `grado`
  ADD PRIMARY KEY (`ID_grado`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`ID_pregunta`),
  ADD KEY `ID_tema` (`ID_tema`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`ID_profesor`);

--
-- Indices de la tabla `profesor-asignatura`
--
ALTER TABLE `profesor-asignatura`
  ADD KEY `impartir` (`ID_asignatura`,`ID_profesor`),
  ADD KEY `ID_profesor` (`ID_profesor`);

--
-- Indices de la tabla `profesor_coordinador`
--
ALTER TABLE `profesor_coordinador`
  ADD KEY `ID_coordinador` (`ID_coordinador`);

--
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`ID_tema`),
  ADD KEY `ID_asignatura` (`ID_asignatura`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `ID_asignatura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `ID_estudiante` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `ID_grado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `ID_profesor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
  MODIFY `ID_tema` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `asignatura_ibfk_1` FOREIGN KEY (`ID_grado`) REFERENCES `grado` (`ID_grado`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `asignatura-alumno`
--
ALTER TABLE `asignatura-alumno`
  ADD CONSTRAINT `r-alumno` FOREIGN KEY (`ID_estudiante`) REFERENCES `estudiante` (`ID_estudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `r-asignatura` FOREIGN KEY (`ID_asignatura`) REFERENCES `asignatura` (`ID_asignatura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiante-pregunta`
--
ALTER TABLE `estudiante-pregunta`
  ADD CONSTRAINT `estudiante-pregunta_ibfk_1` FOREIGN KEY (`ID_estudiante`) REFERENCES `estudiante` (`ID_estudiante`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `estudiante-pregunta_ibfk_2` FOREIGN KEY (`ID_pregunta`) REFERENCES `preguntas` (`ID_pregunta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `estudiante_tema`
--
ALTER TABLE `estudiante_tema`
  ADD CONSTRAINT `estudiante_tema_ibfk_1` FOREIGN KEY (`ID_estudiante`) REFERENCES `estudiante` (`ID_estudiante`),
  ADD CONSTRAINT `estudiante_tema_ibfk_2` FOREIGN KEY (`ID_tema`) REFERENCES `tema` (`ID_tema`);

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`ID_tema`) REFERENCES `tema` (`ID_tema`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesor-asignatura`
--
ALTER TABLE `profesor-asignatura`
  ADD CONSTRAINT `profesor-asignatura_ibfk_1` FOREIGN KEY (`ID_profesor`) REFERENCES `profesor` (`ID_profesor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesor-asignatura_ibfk_2` FOREIGN KEY (`ID_asignatura`) REFERENCES `asignatura` (`ID_asignatura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesor_coordinador`
--
ALTER TABLE `profesor_coordinador`
  ADD CONSTRAINT `profesor_coordinador_ibfk_1` FOREIGN KEY (`ID_coordinador`) REFERENCES `profesor` (`ID_profesor`),
  ADD CONSTRAINT `profesor_coordinador_ibfk_2` FOREIGN KEY (`ID_coordinador`) REFERENCES `asignatura` (`ID_coordinador`);

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `tema_ibfk_1` FOREIGN KEY (`ID_asignatura`) REFERENCES `asignatura` (`ID_asignatura`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
