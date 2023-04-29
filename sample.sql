-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 29-04-2023 a las 03:20:14
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
-- Estructura de tabla para la tabla `sample_gallery`
--

CREATE TABLE `sample_gallery` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `url_picture` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

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
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sample_gallery`
--
ALTER TABLE `sample_gallery`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de la tabla `sample_gallery`
--
ALTER TABLE `sample_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sample_users`
--
ALTER TABLE `sample_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sample_users_recovery_tokens`
--
ALTER TABLE `sample_users_recovery_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sample_users_settings`
--
ALTER TABLE `sample_users_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
