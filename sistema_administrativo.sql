-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-07-2022 a las 17:01:11
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_administrativo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `Nombres` varchar(30) NOT NULL,
  `Apellidos` varchar(30) NOT NULL,
  `FechaDeNacimiento` date NOT NULL,
  `CiudadDeNacimiento` varchar(30) NOT NULL,
  `Id_Cedula` int(30) NOT NULL,
  `Genero` varchar(30) NOT NULL,
  `Grado` int(30) NOT NULL,
  `Institucion` varchar(30) NOT NULL,
  `Correo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`Nombres`, `Apellidos`, `FechaDeNacimiento`, `CiudadDeNacimiento`, `Id_Cedula`, `Genero`, `Grado`, `Institucion`, `Correo`) VALUES
('Luis Daniel', 'Leal Garcia ', '2000-10-21', 'san cristobal', 27989167, 'masculino', 2, 'iut', 'hohohoho@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `id_cursos`
--

CREATE TABLE `id_cursos` (
  `Id_cursos` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `id_cursos`
--

INSERT INTO `id_cursos` (`Id_cursos`) VALUES
(1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `participantes_curso`
--

CREATE TABLE `participantes_curso` (
  `Id_Cedulaprof` int(30) NOT NULL,
  `Id_cedulaEstudiante` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `Nombre` varchar(30) NOT NULL,
  `Apellido` varchar(30) NOT NULL,
  `Id_Cedula` int(30) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `NumTelefono` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_inscripcion`
--

CREATE TABLE `registro_inscripcion` (
  `Id_Cedulaprof` int(30) NOT NULL,
  `fechaInicioCurso` date NOT NULL,
  `fechaFinalCurso` date NOT NULL,
  `materiales` varchar(30) NOT NULL,
  `aulas` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representantes`
--

CREATE TABLE `representantes` (
  `Nombre` varchar(30) NOT NULL,
  `Apellido` varchar(30) NOT NULL,
  `Id_Cedula` int(30) NOT NULL,
  `Direccion` varchar(30) NOT NULL,
  `NumTelefono` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representante_estudiante`
--

CREATE TABLE `representante_estudiante` (
  `Id_cedulaRepresentante` int(30) NOT NULL,
  `Id_cedulaEstudiante` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_de_cursos`
--

CREATE TABLE `tipos_de_cursos` (
  `curso_pintura` varchar(30) NOT NULL,
  `curso_literatura` varchar(30) NOT NULL,
  `curso_dibujo` varchar(30) NOT NULL,
  `Id_curso` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_CedulaEstudiantes` int(30) NOT NULL,
  `contraseña` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`Id_Cedula`),
  ADD KEY `Id_Cedula` (`Id_Cedula`);

--
-- Indices de la tabla `id_cursos`
--
ALTER TABLE `id_cursos`
  ADD PRIMARY KEY (`Id_cursos`);

--
-- Indices de la tabla `participantes_curso`
--
ALTER TABLE `participantes_curso`
  ADD PRIMARY KEY (`Id_cedulaEstudiante`),
  ADD KEY `Id_cedulaEstudiante` (`Id_cedulaEstudiante`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`Id_Cedula`);

--
-- Indices de la tabla `registro_inscripcion`
--
ALTER TABLE `registro_inscripcion`
  ADD PRIMARY KEY (`Id_Cedulaprof`);

--
-- Indices de la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD PRIMARY KEY (`Id_Cedula`);

--
-- Indices de la tabla `representante_estudiante`
--
ALTER TABLE `representante_estudiante`
  ADD PRIMARY KEY (`Id_cedulaEstudiante`);

--
-- Indices de la tabla `tipos_de_cursos`
--
ALTER TABLE `tipos_de_cursos`
  ADD PRIMARY KEY (`Id_curso`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_CedulaEstudiantes`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `Id_Cedula` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27989168;

--
-- AUTO_INCREMENT de la tabla `id_cursos`
--
ALTER TABLE `id_cursos`
  MODIFY `Id_cursos` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `Id_Cedula` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro_inscripcion`
--
ALTER TABLE `registro_inscripcion`
  MODIFY `Id_Cedulaprof` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `Id_Cedula` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `representante_estudiante`
--
ALTER TABLE `representante_estudiante`
  MODIFY `Id_cedulaEstudiante` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_de_cursos`
--
ALTER TABLE `tipos_de_cursos`
  MODIFY `Id_curso` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_CedulaEstudiantes` int(30) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `participantes_curso`
--
ALTER TABLE `participantes_curso`
  ADD CONSTRAINT `participantes_curso_ibfk_1` FOREIGN KEY (`Id_cedulaEstudiante`) REFERENCES `estudiantes` (`Id_Cedula`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `registro_inscripcion`
--
ALTER TABLE `registro_inscripcion`
  ADD CONSTRAINT `registro_inscripcion_ibfk_1` FOREIGN KEY (`Id_Cedulaprof`) REFERENCES `profesor` (`Id_Cedula`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Id_CedulaEstudiantes`) REFERENCES `estudiantes` (`Id_Cedula`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
