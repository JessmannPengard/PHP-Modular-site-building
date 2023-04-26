-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-04-2023 a las 12:33:22
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sample`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sample_users`
--

CREATE TABLE `sample_users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile_picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `sample_users`
--

INSERT INTO `sample_users` (`id`, `email`, `password`, `profile_picture`) VALUES
(1, 'contacto@jessmann.com', '81dc9bdb52d04dc20036dbd8313ed055', 'upload/profiles/qwerty12345.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sample_users_recovery_tokens`
--

CREATE TABLE `sample_users_recovery_tokens` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `date_expire` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `sample_users_recovery_tokens`
--

INSERT INTO `sample_users_recovery_tokens` (`id`, `email`, `token`, `date_expire`) VALUES
(5, 'contacto@jessmann.com', '934630b673e79550bb2dd97bb65b8a9315573805', '2023-04-23 22:34:30'),
(6, 'contacto@jessmann.com', '8fbaaf335d3c9090894beb19d57c3d107b4966f5', '2023-04-23 22:36:01'),
(7, 'contacto@jessmann.com', 'c5592d4a04a36a3928ad35f175f5592103845699', '2023-04-23 22:36:20'),
(8, 'contacto@jessmann.com', '9d4b95a2be5668d0f551ca3ccf14041b05703158', '2023-04-23 22:36:20'),
(9, 'contacto@jessmann.com', '2d4e568459be007e40ba24d2f2492065a8d46e44', '2023-04-23 22:36:21'),
(10, 'contacto@jessmann.com', 'd5bfed0def4717d3c79ef078fb21d91a9171f999', '2023-04-23 22:36:50'),
(11, 'contacto@jessmann.com', 'e7f8cf45fa4e17564219870a3dabca71334d2ae3', '2023-04-23 22:36:50'),
(12, 'contacto@jessmann.com', '8ced4dd44067c416b0995762c64728b46de8b8ef', '2023-04-23 22:36:52'),
(13, 'contacto@jessmann.com', '4424dba0be98447b6cec3b28e1db3d8f0490ea2c', '2023-04-23 22:36:52'),
(14, 'contacto@jessmann.com', '2553b21df21dca0f7fa03f7ed10de946fbd9655d', '2023-04-23 22:36:53'),
(15, 'contacto@jessmann.com', '64a7510ad53bb998f7fa095b2b2cf34884dc797a', '2023-04-23 22:37:29'),
(16, 'contacto@jessmann.com', '8debea25d298c5792059c01607b01f7828adade1', '2023-04-23 22:37:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sample_users_settings`
--

CREATE TABLE `sample_users_settings` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `language` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `sample_users_settings`
--

INSERT INTO `sample_users_settings` (`id`, `id_user`, `language`) VALUES
(1, 1, 'es');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sample_users`
--
ALTER TABLE `sample_users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sample_users_recovery_tokens`
--
ALTER TABLE `sample_users_recovery_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sample_users_settings`
--
ALTER TABLE `sample_users_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sample_users`
--
ALTER TABLE `sample_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sample_users_recovery_tokens`
--
ALTER TABLE `sample_users_recovery_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `sample_users_settings`
--
ALTER TABLE `sample_users_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
