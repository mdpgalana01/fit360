-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-05-2026 a las 01:42:19
-- Versión del servidor: 11.8.1-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fit360`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `id_clase` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `horario` datetime DEFAULT NULL,
  `aforo_max` int(11) DEFAULT NULL,
  `id_gimnasio` int(11) DEFAULT NULL,
  `id_entrenador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

CREATE TABLE `ejercicio` (
  `id_ejercicio` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `grupo_muscular` varchar(100) DEFAULT NULL,
  `equipamiento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenamiento`
--

CREATE TABLE `entrenamiento` (
  `id_entrenamiento` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_rutina` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gimnasio`
--

CREATE TABLE `gimnasio` (
  `id_gimnasio` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `email_contacto` varchar(150) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gimnasio`
--

INSERT INTO `gimnasio` (`id_gimnasio`, `nombre`, `direccion`, `email_contacto`, `telefono`, `fecha_alta`, `activo`) VALUES
(1, 'Gimnasio Prueba', 'Calle Ejemplo 123', 'info@gimnasio.com', '600000000', '2026-03-03', 1),
(2, 'Gimnasio2 Prueba2', 'La calle del gimnasio', 'gim2@test.com', '876543210', '2026-05-01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nutricion`
--

CREATE TABLE `nutricion` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `calorias` int(11) DEFAULT 0,
  `proteinas` int(11) DEFAULT 0,
  `carbohidratos` int(11) DEFAULT 0,
  `grasas` int(11) DEFAULT 0,
  `notas` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `nutricion`
--

INSERT INTO `nutricion` (`id`, `usuario_id`, `fecha`, `calorias`, `proteinas`, `carbohidratos`, `grasas`, `notas`) VALUES
(1, 1, '2026-04-22', 420, 18, 65, 8, 'Desayuno:\r\n\r\nAvena 50 g\r\nLeche desnatada 200 ml\r\nPlátano 1 ud\r\nCafé solo'),
(2, 1, '2026-04-22', 610, 45, 55, 18, 'Almuerzo:\r\n\r\nPechuga de pollo 150 g\r\nArroz integral 80 g\r\nBrócoli al vapor 120 g\r\nAceite de oliva 1 cucharada'),
(3, 1, '2026-04-22', 310, 12, 28, 14, 'Merienda:\r\n\r\nYogur natural 1 ud\r\nNueces 20 g\r\nManzana 1 ud'),
(4, 1, '2026-04-22', 680, 40, 22, 42, 'Cena:\r\n\r\nSalmón a la plancha 180 g\r\nEnsalada verde con tomate\r\nAceite de oliva 1 cucharada\r\nPan integral 1 rebanada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pauta_nutricional`
--

CREATE TABLE `pauta_nutricional` (
  `id_pauta` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_nutricionista` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `progreso`
--

CREATE TABLE `progreso` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `peso` decimal(5,2) NOT NULL,
  `fecha_registro` date NOT NULL,
  `grasa` decimal(5,2) DEFAULT NULL,
  `pecho` decimal(5,2) DEFAULT NULL,
  `cintura` decimal(5,2) DEFAULT NULL,
  `cadera` decimal(5,2) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `progreso`
--

INSERT INTO `progreso` (`id`, `usuario_id`, `peso`, `fecha_registro`, `grasa`, `pecho`, `cintura`, `cadera`, `foto`) VALUES
(1, 1, 80.00, '2026-03-25', 52.00, 92.00, 78.00, 98.00, NULL),
(3, 1, 68.90, '2026-04-09', 25.00, 91.00, 77.00, 97.50, NULL),
(4, 1, 75.40, '2026-04-09', 27.50, 91.50, 77.50, 97.80, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva_clase`
--

CREATE TABLE `reserva_clase` (
  `id_reserva` int(11) NOT NULL,
  `fecha_reserva` datetime DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_clase` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutina`
--

CREATE TABLE `rutina` (
  `id_rutina` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `nivel` varchar(50) DEFAULT NULL,
  `objetivo` varchar(100) DEFAULT NULL,
  `fecha_creacion` date DEFAULT NULL,
  `id_entrenador` int(11) DEFAULT NULL,
  `id_gimnasio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutinas`
--

CREATE TABLE `rutinas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `dia_semana` varchar(20) DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL,
  `ejercicios` text DEFAULT NULL,
  `fecha_creacion` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutinas`
--

INSERT INTO `rutinas` (`id`, `usuario_id`, `nombre`, `descripcion`, `dia_semana`, `duracion`, `ejercicios`, `fecha_creacion`) VALUES
(2, 1, 'Piernas – Nivel básico', 'Rutina enfocada en fuerza de tren inferior.', 'Lunes', 45, 'Sentadillas, Zancadas, Prensa de piernas, Elevación de talones, Peso muerto rumano\r\n', '2026-04-20 22:59:18'),
(3, 1, 'Espalda y bíceps', 'Rutina de fuerza para la parte superior.', 'Miércoles', 50, 'Dominadas, Remo con barra, Jalón al pecho, Curl de bíceps, Curl martillo\r\n', '2026-04-20 22:59:48'),
(4, 1, 'HIIT 20 minutos', 'Entrenamiento de alta intensidad por intervalos.', 'Viernes', 20, 'Burpees, Jumping jacks, Mountain climbers, Sprint en cinta, Saltos laterales\r\n', '2026-04-20 23:00:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutina_ejercicio`
--

CREATE TABLE `rutina_ejercicio` (
  `id_rutina` int(11) NOT NULL,
  `id_ejercicio` int(11) NOT NULL,
  `series` int(11) DEFAULT NULL,
  `repeticiones` int(11) DEFAULT NULL,
  `descanso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento_fisico`
--

CREATE TABLE `seguimiento_fisico` (
  `id_seguimiento` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `porcentaje_grasa` decimal(5,2) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `apellidos` varchar(150) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'default-avatar.png',
  `contrasena` varchar(255) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `rol` enum('admin','socio','entrenador','dietista') NOT NULL DEFAULT 'socio',
  `id_gimnasio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellidos`, `email`, `avatar`, `contrasena`, `fecha_registro`, `rol`, `id_gimnasio`) VALUES
(1, 'Julia', 'Oltra', 'julia@test.com', 'avatar_1_1777751882.jpg', '$2y$10$8j53eh0PVHFKZ8BpBRec1ujxPvzNWZleFOGORTQkCbC4sbW52EssK', '2026-03-02', 'socio', 1),
(3, 'Clara', 'Oltra', 'clara@test.com', 'avatar_3_1777751849.jpg', '$2y$10$8j53eh0PVHFKZ8BpBRec1ujxPvzNWZleFOGORTQkCbC4sbW52EssK', '2026-03-17', 'admin', 1),
(9, 'Julia2', 'Oltra Oltra', 'julia2@test.com', 'avatar_9_1777937697.jpg', '$2y$10$KfyNfkWlAN60dIT3NTszzunIFDBGfatQBeFuAlPAxKjjt2/zUss1e', '2026-04-29', 'entrenador', 1),
(10, 'Julia3', 'Oltra3', 'julia3@test.com', 'avatar_10_1777938054.jpg', '$2y$10$s6THysVfawn1MxfGXBv1nuY1huuU.0EMqqYXn9RPLyiXlmk73UKAy', '2026-04-30', 'dietista', 1),
(11, 'prueba', 'prueba', 'prueba@prueba.com', 'default-avatar.png', '$2y$10$xJ9cGvQHHjfcPb76br7PqOhfVm75xa6Nhbd/CDPQKVx8LeRzAytKG', '2026-05-02', 'socio', 1),
(12, 'prueba2', 'prueba2', 'prueba2@prueba2.com', 'default-avatar.png', '$2y$10$gvUI4jJCZxWtD7kUojJyhuNzdtp5xTi3Yze0UKr3CdV8x6u0Z4M42', '2026-05-02', 'socio', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`id_clase`),
  ADD KEY `id_gimnasio` (`id_gimnasio`),
  ADD KEY `id_entrenador` (`id_entrenador`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD PRIMARY KEY (`id_ejercicio`);

--
-- Indices de la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  ADD PRIMARY KEY (`id_entrenamiento`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_rutina` (`id_rutina`);

--
-- Indices de la tabla `gimnasio`
--
ALTER TABLE `gimnasio`
  ADD PRIMARY KEY (`id_gimnasio`);

--
-- Indices de la tabla `nutricion`
--
ALTER TABLE `nutricion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `pauta_nutricional`
--
ALTER TABLE `pauta_nutricional`
  ADD PRIMARY KEY (`id_pauta`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_nutricionista` (`id_nutricionista`);

--
-- Indices de la tabla `progreso`
--
ALTER TABLE `progreso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `reserva_clase`
--
ALTER TABLE `reserva_clase`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_clase` (`id_clase`);

--
-- Indices de la tabla `rutina`
--
ALTER TABLE `rutina`
  ADD PRIMARY KEY (`id_rutina`),
  ADD KEY `id_entrenador` (`id_entrenador`),
  ADD KEY `id_gimnasio` (`id_gimnasio`);

--
-- Indices de la tabla `rutinas`
--
ALTER TABLE `rutinas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `rutina_ejercicio`
--
ALTER TABLE `rutina_ejercicio`
  ADD PRIMARY KEY (`id_rutina`,`id_ejercicio`),
  ADD KEY `id_ejercicio` (`id_ejercicio`);

--
-- Indices de la tabla `seguimiento_fisico`
--
ALTER TABLE `seguimiento_fisico`
  ADD PRIMARY KEY (`id_seguimiento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_usuario_gimnasio` (`id_gimnasio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `id_clase` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  MODIFY `id_ejercicio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  MODIFY `id_entrenamiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `gimnasio`
--
ALTER TABLE `gimnasio`
  MODIFY `id_gimnasio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `nutricion`
--
ALTER TABLE `nutricion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pauta_nutricional`
--
ALTER TABLE `pauta_nutricional`
  MODIFY `id_pauta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `progreso`
--
ALTER TABLE `progreso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `reserva_clase`
--
ALTER TABLE `reserva_clase`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rutina`
--
ALTER TABLE `rutina`
  MODIFY `id_rutina` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rutinas`
--
ALTER TABLE `rutinas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `seguimiento_fisico`
--
ALTER TABLE `seguimiento_fisico`
  MODIFY `id_seguimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `clase_ibfk_1` FOREIGN KEY (`id_gimnasio`) REFERENCES `gimnasio` (`id_gimnasio`),
  ADD CONSTRAINT `clase_ibfk_2` FOREIGN KEY (`id_entrenador`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `entrenamiento`
--
ALTER TABLE `entrenamiento`
  ADD CONSTRAINT `entrenamiento_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `entrenamiento_ibfk_2` FOREIGN KEY (`id_rutina`) REFERENCES `rutina` (`id_rutina`);

--
-- Filtros para la tabla `nutricion`
--
ALTER TABLE `nutricion`
  ADD CONSTRAINT `nutricion_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `pauta_nutricional`
--
ALTER TABLE `pauta_nutricional`
  ADD CONSTRAINT `pauta_nutricional_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `pauta_nutricional_ibfk_2` FOREIGN KEY (`id_nutricionista`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `progreso`
--
ALTER TABLE `progreso`
  ADD CONSTRAINT `progreso_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `reserva_clase`
--
ALTER TABLE `reserva_clase`
  ADD CONSTRAINT `reserva_clase_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `reserva_clase_ibfk_2` FOREIGN KEY (`id_clase`) REFERENCES `clase` (`id_clase`);

--
-- Filtros para la tabla `rutina`
--
ALTER TABLE `rutina`
  ADD CONSTRAINT `rutina_ibfk_1` FOREIGN KEY (`id_entrenador`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `rutina_ibfk_2` FOREIGN KEY (`id_gimnasio`) REFERENCES `gimnasio` (`id_gimnasio`);

--
-- Filtros para la tabla `rutinas`
--
ALTER TABLE `rutinas`
  ADD CONSTRAINT `rutinas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `rutina_ejercicio`
--
ALTER TABLE `rutina_ejercicio`
  ADD CONSTRAINT `rutina_ejercicio_ibfk_1` FOREIGN KEY (`id_rutina`) REFERENCES `rutina` (`id_rutina`),
  ADD CONSTRAINT `rutina_ejercicio_ibfk_2` FOREIGN KEY (`id_ejercicio`) REFERENCES `ejercicio` (`id_ejercicio`);

--
-- Filtros para la tabla `seguimiento_fisico`
--
ALTER TABLE `seguimiento_fisico`
  ADD CONSTRAINT `seguimiento_fisico_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_gimnasio` FOREIGN KEY (`id_gimnasio`) REFERENCES `gimnasio` (`id_gimnasio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
