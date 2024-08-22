-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-08-2024 a las 23:17:56
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `task_calendar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `days`
--

CREATE TABLE `days` (
  `id` int(11) NOT NULL,
  `dayCalendar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `days`
--

INSERT INTO `days` (`id`, `dayCalendar`) VALUES
(3, '2024-08-20'),
(4, '2024-08-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `task` varchar(250) DEFAULT NULL,
  `duration` varchar(250) DEFAULT NULL,
  `day` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`id`, `task`, `duration`, `day`) VALUES
(1, 'Programacion', '3', '[\"Martes\"]'),
(3, 'Base de datos', '1', '[\"Jueves\",\"Viernes\"]'),
(7, 'Programacion', '3', '[\"Sabado\"]'),
(8, 'Nociones de derecho', '2', '[\"Sabado\"]');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `task_calendar`
--

CREATE TABLE `task_calendar` (
  `id` int(11) NOT NULL,
  `id_day` int(11) DEFAULT NULL,
  `id_task` int(11) DEFAULT NULL,
  `state` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `task_calendar`
--

INSERT INTO `task_calendar` (`id`, `id_day`, `id_task`, `state`) VALUES
(1, 4, 7, 0),
(2, 4, 8, 0),
(3, 3, 8, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `task_calendar`
--
ALTER TABLE `task_calendar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_day` (`id_day`),
  ADD KEY `id_task` (`id_task`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `days`
--
ALTER TABLE `days`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `task_calendar`
--
ALTER TABLE `task_calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `task_calendar`
--
ALTER TABLE `task_calendar`
  ADD CONSTRAINT `task_calendar_ibfk_1` FOREIGN KEY (`id_day`) REFERENCES `days` (`id`),
  ADD CONSTRAINT `task_calendar_ibfk_2` FOREIGN KEY (`id_task`) REFERENCES `tasks` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
