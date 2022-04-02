-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-04-2022 a las 18:51:53
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
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `ID_admin` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Volcado de datos para la tabla `asignatura`
--

INSERT INTO `asignatura` (`ID_asignatura`, `nombre`, `ID_grado`, `ID_coordinador`) VALUES
(1, 'matemáticas', 1, NULL),
(2, 'Programación Web', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura-alumno`
--

CREATE TABLE `asignatura-alumno` (
  `ID_asignatura` int(11) NOT NULL,
  `ID_estudiante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asignatura-alumno`
--

INSERT INTO `asignatura-alumno` (`ID_asignatura`, `ID_estudiante`) VALUES
(2, 1);

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

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`ID_estudiante`, `nombre`, `DNI`, `email`, `pass`) VALUES
(1, 'Estudiante Informatica', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante_examen`
--

CREATE TABLE `estudiante_examen` (
  `ID_examen` int(11) NOT NULL,
  `ID_estudiante` int(11) NOT NULL,
  `Nota` float(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiante_examen`
--

INSERT INTO `estudiante_examen` (`ID_examen`, `ID_estudiante`, `Nota`) VALUES
(14, 1, 7.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante_pregunta`
--

CREATE TABLE `estudiante_pregunta` (
  `ID_estudiante` int(11) NOT NULL,
  `ID_pregunta` int(11) NOT NULL,
  `respuesta_alumno` varchar(10) NOT NULL,
  `correcta` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiante_pregunta`
--

INSERT INTO `estudiante_pregunta` (`ID_estudiante`, `ID_pregunta`, `respuesta_alumno`, `correcta`) VALUES
(1, 4, 'Falso', 1),
(1, 2, 'Verdadero', 1),
(1, 3, 'Falso', 0),
(1, 1, 'Falso', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE `examen` (
  `ID_examen` int(11) NOT NULL,
  `ID_tema` int(11) NOT NULL,
  `num_preguntas` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `examen`
--

INSERT INTO `examen` (`ID_examen`, `ID_tema`, `num_preguntas`, `fecha`) VALUES
(14, 2, 4, '2022-04-02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE `grado` (
  `ID_grado` int(11) NOT NULL,
  `GRADO_NOMBRE` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`ID_grado`, `GRADO_NOMBRE`) VALUES
(1, 'grado prueba'),
(2, 'Ingeniería Informática');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `ID_pregunta` int(11) NOT NULL,
  `ID_tema` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  `solucion` varchar(9) NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`ID_pregunta`, `ID_tema`, `pregunta`, `solucion`, `fecha_creacion`) VALUES
(1, 2, 'El código PHP se ejecuta en el Cliente', 'Falso', '2022-04-02 15:51:06'),
(2, 2, 'Las marcas de inserción del código PHP en las páginas HTML son < ? y ? >', 'Verdadero', '2022-04-02 15:52:11'),
(3, 2, 'En el atributo action especificamos la página a la que se van a enviar los datos', 'Verdadero', '2022-04-02 15:53:05'),
(4, 2, 'La forma de pasar los parámetros entre páginas PHP son Into e Include', 'Falso', '2022-04-02 15:54:54'),
(5, 2, 'Para realizar consulta a una Base de Datos MySQL se usa mysql_access', 'Falso', '2022-04-02 15:55:35');

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

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`ID_profesor`, `PROFESOR_NOMBRE`, `DNI`, `email`, `pass`) VALUES
(1, 'Profesor Informatica', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor-asignatura`
--

CREATE TABLE `profesor-asignatura` (
  `ID_asignatura` int(11) NOT NULL,
  `ID_profesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `profesor-asignatura`
--

INSERT INTO `profesor-asignatura` (`ID_asignatura`, `ID_profesor`) VALUES
(2, 1);

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
-- Volcado de datos para la tabla `tema`
--

INSERT INTO `tema` (`ID_tema`, `nombre`, `ID_asignatura`) VALUES
(1, 'derivadas', 1),
(2, 'PHP', 2),
(3, 'Framework', 2),
(4, 'Javascript', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ID_admin`);

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
-- Indices de la tabla `estudiante_examen`
--
ALTER TABLE `estudiante_examen`
  ADD PRIMARY KEY (`ID_examen`,`ID_estudiante`),
  ADD KEY `ID_estudiante` (`ID_estudiante`);

--
-- Indices de la tabla `estudiante_pregunta`
--
ALTER TABLE `estudiante_pregunta`
  ADD KEY `ID_estudiante` (`ID_estudiante`),
  ADD KEY `ID_pregunta` (`ID_pregunta`);

--
-- Indices de la tabla `examen`
--
ALTER TABLE `examen`
  ADD PRIMARY KEY (`ID_examen`),
  ADD KEY `examen-tema` (`ID_tema`);

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
-- Indices de la tabla `tema`
--
ALTER TABLE `tema`
  ADD PRIMARY KEY (`ID_tema`,`ID_asignatura`) USING BTREE,
  ADD KEY `ID_asignatura` (`ID_asignatura`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignatura`
--
ALTER TABLE `asignatura`
  MODIFY `ID_asignatura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `ID_estudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `examen`
--
ALTER TABLE `examen`
  MODIFY `ID_examen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `grado`
--
ALTER TABLE `grado`
  MODIFY `ID_grado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `ID_profesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tema`
--
ALTER TABLE `tema`
  MODIFY `ID_tema` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Filtros para la tabla `estudiante_examen`
--
ALTER TABLE `estudiante_examen`
  ADD CONSTRAINT `estudiante_examen_ibfk_1` FOREIGN KEY (`ID_estudiante`) REFERENCES `estudiante` (`ID_estudiante`),
  ADD CONSTRAINT `estudiante_examen_ibfk_2` FOREIGN KEY (`ID_examen`) REFERENCES `examen` (`ID_examen`);

--
-- Filtros para la tabla `examen`
--
ALTER TABLE `examen`
  ADD CONSTRAINT `examen-tema` FOREIGN KEY (`ID_tema`) REFERENCES `tema` (`ID_tema`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`ID_tema`) REFERENCES `tema` (`ID_tema`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `profesor-asignatura`
--
ALTER TABLE `profesor-asignatura`
  ADD CONSTRAINT `profesor-asignatura_ibfk_1` FOREIGN KEY (`ID_profesor`) REFERENCES `profesor` (`ID_profesor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profesor-asignatura_ibfk_2` FOREIGN KEY (`ID_asignatura`) REFERENCES `asignatura` (`ID_asignatura`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tema`
--
ALTER TABLE `tema`
  ADD CONSTRAINT `tema_ibfk_1` FOREIGN KEY (`ID_asignatura`) REFERENCES `asignatura` (`ID_asignatura`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
