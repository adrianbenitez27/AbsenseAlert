-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-01-2024 a las 17:59:13
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `absensealertcom`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_justificante`
--

CREATE TABLE `datos_justificante` (
  `id` int(11) NOT NULL,
  `boleta` varchar(10) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_pat` varchar(50) NOT NULL,
  `apellido_mat` varchar(50) NOT NULL,
  `fecha_nac` varchar(15) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `curp` varchar(20) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `colonia` varchar(100) NOT NULL,
  `estado_proce` varchar(40) NOT NULL,
  `codigo_postal` varchar(5) NOT NULL,
  `telefono` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL,
  `escuela_proce` varchar(40) NOT NULL,
  `fecha_ini` varchar(15) NOT NULL,
  `fecha_fin` varchar(15) NOT NULL,
  `razon_ausen` varchar(200) NOT NULL,
  `archivo_com_med` varchar(200) NOT NULL,
  `status` varchar(10) NOT NULL,
  `fecha_jus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `boleta` varchar(10) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `boleta`, `usuario`, `email`, `contrasena`) VALUES
(0, '0000000000', 'Administrador', 'administrador@ipn.mx', '099f661a1a6c901146ed8e12ee060fe98aa2334d841255684618f90219621d6e'),
(1, '2021630122', 'adrianben', 'adriankoala7@gmail.com', '099f661a1a6c901146ed8e12ee060fe98aa2334d841255684618f90219621d6e');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
