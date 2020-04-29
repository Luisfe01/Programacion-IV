-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2020 a las 07:34:36
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_app_hotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idCliente` int(10) NOT NULL,
  `nombre` char(50) NOT NULL,
  `apellido` char(50) NOT NULL,
  `direccion` char(250) NOT NULL,
  `telefono` char(9) NOT NULL,
  `dui` char(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idEmpleado` int(10) NOT NULL,
  `idTipoempleado` int(10) NOT NULL,
  `nombre` char(50) NOT NULL,
  `apellido` char(50) NOT NULL,
  `direccion` char(250) NOT NULL,
  `telefono` char(9) NOT NULL,
  `dui` char(10) NOT NULL,
  `fechanacimiento` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleado`, `idTipoempleado`, `nombre`, `apellido`, `direccion`, `telefono`, `dui`, `fechanacimiento`) VALUES
(8, 3, 'Juan', 'Gomez', 'San Miguel', '2345-2345', '02345678-1', '2020-04-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitaciones`
--

CREATE TABLE `habitaciones` (
  `idHabitacion` int(10) NOT NULL,
  `idPiso` int(10) NOT NULL,
  `idTipohabitacion` int(10) NOT NULL,
  `numhabitacion` int(10) NOT NULL,
  `numcamas` int(10) NOT NULL,
  `disponibilidad` char(10) NOT NULL,
  `precio` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `habitaciones`
--

INSERT INTO `habitaciones` (`idHabitacion`, `idPiso`, `idTipohabitacion`, `numhabitacion`, `numcamas`, `disponibilidad`, `precio`) VALUES
(8, 0, 1, 1, 2, 'Disponible', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pisos`
--

CREATE TABLE `pisos` (
  `idPiso` int(10) NOT NULL,
  `piso` int(10) NOT NULL,
  `nombre` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pisos`
--

INSERT INTO `pisos` (`idPiso`, `piso`, `nombre`) VALUES
(4, 2, 'SEGUNDO PISO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `idServicio` int(10) NOT NULL,
  `nombre` char(100) NOT NULL,
  `precio` char(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoempleados`
--

CREATE TABLE `tipoempleados` (
  `idTipoempleado` int(10) NOT NULL,
  `tipo` char(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipoempleados`
--

INSERT INTO `tipoempleados` (`idTipoempleado`, `tipo`) VALUES
(2, 'Recepcionista'),
(3, 'Botones'),
(4, 'Camarera de Piso'),
(5, 'Barman'),
(6, 'Cocinero'),
(7, 'Personal de Seguridad'),
(8, 'Personal de spa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipohabitaciones`
--

CREATE TABLE `tipohabitaciones` (
  `idTipohabitacion` int(10) NOT NULL,
  `categoria` char(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipohabitaciones`
--

INSERT INTO `tipohabitaciones` (`idTipohabitacion`, `categoria`) VALUES
(1, 'Triple'),
(2, 'Matrimonial');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idCliente`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idEmpleado`),
  ADD KEY `idTipoempleado` (`idTipoempleado`);

--
-- Indices de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  ADD PRIMARY KEY (`idHabitacion`),
  ADD KEY `idPiso` (`idPiso`),
  ADD KEY `idTipohabitacion` (`idTipohabitacion`);

--
-- Indices de la tabla `pisos`
--
ALTER TABLE `pisos`
  ADD PRIMARY KEY (`idPiso`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idServicio`);

--
-- Indices de la tabla `tipoempleados`
--
ALTER TABLE `tipoempleados`
  ADD PRIMARY KEY (`idTipoempleado`);

--
-- Indices de la tabla `tipohabitaciones`
--
ALTER TABLE `tipohabitaciones`
  ADD PRIMARY KEY (`idTipohabitacion`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idCliente` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `habitaciones`
--
ALTER TABLE `habitaciones`
  MODIFY `idHabitacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pisos`
--
ALTER TABLE `pisos`
  MODIFY `idPiso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `idServicio` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipoempleados`
--
ALTER TABLE `tipoempleados`
  MODIFY `idTipoempleado` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tipohabitaciones`
--
ALTER TABLE `tipohabitaciones`
  MODIFY `idTipohabitacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
