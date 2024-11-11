-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2024 a las 21:19:02
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
-- Base de datos: `db_tuletra_api`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bandas`
--

CREATE TABLE `bandas` (
  `id_banda` int(11) NOT NULL,
  `nombre_banda` varchar(50) NOT NULL,
  `img_banda` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bandas`
--

INSERT INTO `bandas` (`id_banda`, `nombre_banda`, `img_banda`) VALUES
(1, 'The Beach Boys', 'https://upload.wikimedia.org/wikipedia/commons/a/a8/The_Beach_Boys_%281965%29.png'),
(2, 'Metallicas', 'https://image-cdn-ak.spotifycdn.com/image/ab67706c0000da8481d620645973fe11fe5b2782'),
(3, 'Divididos', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTbBpxeLUCV9Xre68tTMm8-G2b7tBOc60ZWQ&s'),
(4, 'Los tipitos', 'https://fmrockandpop.com/media/k2/items/cache/88d9a0cb55d81b8a3601ff79f8d5c68d_L.webp?t=20220523_191449'),
(5, 'Damas gratis', 'https://mir-s3-cdn-cf.behance.net/projects/404/e6880d133149385.Y3JvcCw4MDgsNjMyLDAsMA.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `canciones`
--

CREATE TABLE `canciones` (
  `id_cancion` int(11) NOT NULL,
  `nombre_cancion` varchar(50) NOT NULL,
  `letra` text NOT NULL,
  `genero` varchar(50) NOT NULL,
  `id_banda_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `canciones`
--

INSERT INTO `canciones` (`id_cancion`, `nombre_cancion`, `letra`, `genero`, `id_banda_fk`) VALUES
(1, 'Nothing Else Matters', 'So close, no matter how far\r\nCouldn\'t be much more from the heart\r\nForever trusting who we are\r\nAnd nothing else matters\r\nNever opened myself this way\r\nLife is ours, we live it our way\r\nAll these words, I don\'t just say\r\nAnd nothing else matters\r\nTrust I seek and I find in you\r\nEvery day for us something new\r\nOpen mind for a different view\r\nAnd nothing else matters\r\nNever cared for what they do\r\nNever cared for what they know\r\nBut I know\r\nSo close, no matter how far\r\nIt couldn\'t be much more from the heart\r\nForever trusting who we are\r\nAnd nothing else matters\r\nNever cared for what they do\r\nNever cared for what they know\r\nBut I know\r\nI never opened myself this way\r\nLife is ours, we live it our way\r\nAll these words, I don\'t just say\r\nAnd nothing else matters\r\nTrust I seek and I find in you\r\nEvery day for us something new\r\nOpen mind for a different view\r\nAnd nothing else matters\r\nNever cared for what they say\r\nNever cared for games they play\r\nNever cared for what they do\r\nNever cared for what they know\r\nAnd I know, yeah, yeah\r\nSo close, no matter how far\r\nCouldn\'t be much more from the heart\r\nForever trusting who we are\r\nNo, nothing else matters', 'Heavy metal', 2),
(2, 'wouldn’t it be nice', 'I know perfectly well\r\nI\'m not where I should be\r\nI\'ve been very aware\r\nYou\'ve been patient with me\r\nEvery time we break up\r\nYou bring back your love to me\r\nAnd after all I\'ve done to you\r\nHow can it be?\r\nYou still believe in me\r\nI try hard to be more\r\nWhat you want me to be\r\nBut I can\'t help how I act\r\nWhen you\'re not here with me\r\nI try hard to be strong\r\nBut sometimes I fail myself\r\nAnd after all I\'ve promised you\r\nSo faithfully', 'Pop', 1),
(3, 'Don’t Worry Baby', 'Well it\'s been building up inside of me\r\nFor oh I don\'t know how long\r\nI don\'t know why\r\nBut I keep thinking\r\nSomething\'s bound to go wrong\r\nBut she looks in my eyes\r\nAnd makes me realize\r\nAnd she says \"don\'t worry, baby\"\r\nDon\'t worry, baby\r\nDon\'t worry, baby\r\nEverything will turn out alright\r\nDon\'t worry, baby\r\nDon\'t worry, baby\r\nDon\'t worry, baby', 'Pop', 1),
(4, 'Enter Sandman', 'Say your prayers, little one\r\nDon\'t forget, my son\r\nTo include everyone\r\nI tuck you in, warm within\r\nKeep you free from sin\r\n\'Til the sandman, he comes\r\nSleep with one eye open\r\nGripping your pillow tight\r\nExit light\r\nEnter night\r\nTake my hand\r\nWe\'re off to never-never land\r\nSomething\'s wrong, shut the light\r\nHeavy thoughts tonight\r\nAnd they aren\'t of Snow White\r\nDreams of war, dreams of liars\r\nDreams of dragon\'s fire\r\nAnd of things that will bite, yeah', 'Heavy metal', 2),
(5, '¿Qué Ves?', 'El wah, wah de troilo no quiere arrancar\r\nFalta envido y truco\r\nChiste nacional\r\nEstamos en vena, grita el mayoral\r\nY pagas el vale un día después\r\n\r\n¿Qué ves?\r\n¿Qué ves cuando me ves?\r\nCuando la mentira es la verdad\r\n\r\n¿Qué ves?\r\n¿Qué ves cuando me ves?\r\nCuando la mentira es la verdad', 'Rock Nacional', 3),
(6, 'Pepe Lui', 'Va Pepe Lui\r\npor la estacion Eduardo VI\r\nVa Pepe Lui\r\ncon bocho de radio grabador\r\nla suspencion\r\nque el pelo pide al caminar\r\nresortes de un andar\r\nclavado en los setenta\r\nDos de cristal enla bolsa\r\nmas rapido que un rayo\r\nun mundo en miniaturas\r\nrevistas de rock\r\npero de rock nacional\r\nRey del ping-pong\r\npero mas rey es del pom pom\r\nel sapo ahi en su latita de nesquik\r\nun artesano\r\nhasta en su manera de mirar', 'Rock Nacional', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `autor` varchar(255) DEFAULT NULL,
  `positivo` tinyint(1) NOT NULL,
  `comentario` text NOT NULL,
  `id_cancion_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `autor`, `positivo`, `comentario`, `id_cancion_fk`) VALUES
(1, 'Joaquin', 1, 'Muy buena cancion, me encanta la letra', 2),
(2, 'Maria', 0, 'La letra esta mal redactada y le faltan los signos de punteria', 1),
(3, NULL, 0, 'Muy mala', 1),
(4, NULL, 0, 'mala letra', 3),
(5, 'pedro', 1, 'la mejor cancion que escuche en mi vida', 6),
(6, 'jose', 1, 'muy buena letra', 5),
(7, 'Laura', 1, 'me encanta esta cancion', 2),
(8, 'Alvaro', 1, 'La mejor cancion lejos', 5),
(9, 'Hugo', 0, 'Las canciones de mi epoca eran mejores', 1),
(10, NULL, 1, 'Me encanta!!!', 6),
(11, 'Luis', 0, 'Le falta swing y splush XD', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `email_usuario` varchar(50) NOT NULL,
  `contraseña` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `nombre_usuario`, `email_usuario`, `contraseña`) VALUES
(1, 'webadmin', 'webadmin', 'admin@admin.com', '$2y$10$cBkiHQiPPdSSQMUGLXME.OepkSREB9Uutvo7HyXR2fYm/8RiNFbtS');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bandas`
--
ALTER TABLE `bandas`
  ADD PRIMARY KEY (`id_banda`);

--
-- Indices de la tabla `canciones`
--
ALTER TABLE `canciones`
  ADD PRIMARY KEY (`id_cancion`),
  ADD KEY `id_banda_fk` (`id_banda_fk`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_cancion_fk` (`id_cancion_fk`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD UNIQUE KEY `email_usuario` (`email_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bandas`
--
ALTER TABLE `bandas`
  MODIFY `id_banda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `canciones`
--
ALTER TABLE `canciones`
  MODIFY `id_cancion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `canciones`
--
ALTER TABLE `canciones`
  ADD CONSTRAINT `canciones_ibfk_1` FOREIGN KEY (`id_banda_fk`) REFERENCES `bandas` (`id_banda`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_cancion_fk`) REFERENCES `canciones` (`id_cancion`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
