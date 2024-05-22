-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-05-2024 a las 09:29:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `time_bank_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `advertisement`
--

CREATE TABLE `advertisement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `type` enum('offer','request','workshop') NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`tags`)),
  `duration` time NOT NULL,
  `availability` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`availability`)),
  `location` varchar(50) NOT NULL,
  `loc_latitude` varchar(50) NOT NULL,
  `loc_longitude` varchar(50) NOT NULL,
  `collaborators` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`collaborators`)),
  `max_subscribers` int(11) NOT NULL,
  `publishing_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `advertisement`
--

INSERT INTO `advertisement` (`id`, `owner_id`, `title`, `image`, `description`, `type`, `category_id`, `tags`, `duration`, `availability`, `location`, `loc_latitude`, `loc_longitude`, `collaborators`, `max_subscribers`, `publishing_date`) VALUES
(1, 1, 'Clases de Matemáticas', 'math.jpg', 'Ofrezco clases de matemáticas para secundaria', 'offer', 1, '[\"Online\", \"Gratis\"]', '01:00:00', '[\"Lunes 10:00-12:00\", \"Miércoles 14:00-16:00\"]', 'Madrid', '40.416775', '-3.703790', '[]', 3, '2024-05-22 07:24:12'),
(2, 2, 'Taller de Programación', 'programming.jpg', 'Taller intensivo de programación en Python', 'workshop', 2, '[\"Presencial\", \"Pago\"]', '02:00:00', '[\"Viernes 18:00-20:00\"]', 'Barcelona', '41.385064', '2.173404', '[1, 3]', 20, '2024-05-21 23:59:12'),
(3, 3, 'Ayuda con clases de inglés', 'english_help.jpg', 'Busco alguien que me ayude con clases de inglés conversacional', 'request', 1, '[\"Online\", \"Pago\"]', '01:30:00', '[\"Martes 17:00-18:30\", \"Jueves 17:00-18:30\"]', 'Valencia', '39.469907', '-0.376288', '[]', 1, '2024-05-22 00:03:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `booking`
--

CREATE TABLE `booking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `advert_id` bigint(20) UNSIGNED NOT NULL,
  `publisher_id` bigint(20) UNSIGNED NOT NULL,
  `enrolled_id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `booking`
--

INSERT INTO `booking` (`id`, `advert_id`, `publisher_id`, `enrolled_id`, `date`, `time`) VALUES
(1, 1, 1, 2, '2024-05-25', '10:00:00'),
(2, 2, 2, 3, '2024-05-26', '18:00:00'),
(3, 3, 3, 1, '2024-05-27', '17:00:00'),
(4, 1, 1, 3, '2024-05-28', '10:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Educación'),
(2, 'Tecnología'),
(3, 'Salud');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `history`
--

CREATE TABLE `history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `publisher_id` bigint(20) UNSIGNED NOT NULL,
  `enrolled_id` bigint(20) UNSIGNED NOT NULL,
  `advert` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`advert`)),
  `booking` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`booking`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `history`
--

INSERT INTO `history` (`id`, `publisher_id`, `enrolled_id`, `advert`, `booking`) VALUES
(1, 1, 2, '{\"id\": 1, \"title\": \"Clases de Matemáticas\", \"type\": \"offer\", \"category\": \"Educación\"}', '{\"id\": 1, \"advert_id\": 1, \"date\": \"2024-05-25\", \"time\": \"10:00:00\"}'),
(2, 2, 3, '{\"id\": 2, \"title\": \"Taller de Programación\", \"type\": \"workshop\", \"category\": \"Tecnología\"}', '{\"id\": 2, \"advert_id\": 2, \"date\": \"2024-05-26\", \"time\": \"18:00:00\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tag`
--

CREATE TABLE `tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'Online'),
(2, 'Presencial'),
(3, 'Gratis'),
(4, 'Pago');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(35) NOT NULL,
  `balance` bigint(20) NOT NULL,
  `auth_level` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `phone`, `password`, `balance`, `auth_level`) VALUES
(1, 'Juan', 'Pérez', 'juan.perez@example.com', '123456789', 'password123', 100, 'user'),
(2, 'María', 'Gómez', 'maria.gomez@example.com', '987654321', 'password456', 200, 'user'),
(3, 'Carlos', 'López', 'carlos.lopez@example.com', '456789123', 'password789', 150, 'admin'),
(4, 'Ana', 'Martínez', 'ana.martinez@example.com', '111222333', 'password101', 120, 'user'),
(5, 'Luis', 'García', 'luis.garcia@example.com', '444555666', 'password202', 80, 'user');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoration`
--

CREATE TABLE `valoration` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `valorated_member_id` bigint(20) UNSIGNED NOT NULL,
  `score` int(11) NOT NULL,
  `comment` text NOT NULL,
  `publishing_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valoration`
--

INSERT INTO `valoration` (`id`, `owner_id`, `valorated_member_id`, `score`, `comment`, `publishing_date`) VALUES
(1, 2, 1, 5, 'Excelente profesor de matemáticas', '2024-05-21 23:59:12'),
(2, 3, 2, 4, 'Muy buen taller de programación', '2024-05-21 23:59:12'),
(3, 1, 3, 5, 'Carlos es un administrador excelente', '2024-05-22 06:36:39'),
(4, 2, 3, 4, 'Muy buen trabajo organizando talleres', '2024-05-22 06:36:39');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indices de la tabla `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advert_id` (`advert_id`),
  ADD KEY `publisher_id` (`publisher_id`),
  ADD KEY `enrolled_id` (`enrolled_id`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publisher_id` (`publisher_id`),
  ADD KEY `enrolled_id` (`enrolled_id`);

--
-- Indices de la tabla `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `valoration`
--
ALTER TABLE `valoration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `valorated_member_id` (`valorated_member_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `booking`
--
ALTER TABLE `booking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `history`
--
ALTER TABLE `history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tag`
--
ALTER TABLE `tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `valoration`
--
ALTER TABLE `valoration`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `advertisement`
--
ALTER TABLE `advertisement`
  ADD CONSTRAINT `advertisement_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `advertisement_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`advert_id`) REFERENCES `advertisement` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`enrolled_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`publisher_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`enrolled_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `valoration`
--
ALTER TABLE `valoration`
  ADD CONSTRAINT `valoration_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `valoration_ibfk_2` FOREIGN KEY (`valorated_member_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
