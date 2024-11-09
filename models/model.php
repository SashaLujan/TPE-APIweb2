<?php
require_once('config/config.php');

class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST .
                ";dbname=" . MYSQL_DB . ";charset=utf8",
            MYSQL_USER,
            MYSQL_PASS
        );

        $this->_deploy();
    }

    private function _deploy()
    {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<'END'
            -- phpMyAdmin SQL Dump
            -- version 5.2.1
            -- https://www.phpmyadmin.net/
            --
            -- Servidor: 127.0.0.1
            -- Tiempo de generación: 15-10-2024 a las 17:11:29
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
            -- Base de datos: `db_tuletra`
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
            (2, 'Metallica', 'https://image-cdn-ak.spotifycdn.com/image/ab67706c0000da8481d620645973fe11fe5b2782');

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
            (1, 'Nothing Else Matters', 'So close, no matter how far\r\nCouldn\'t be much more from the heart\r\nForever trusting who we are\r\nAnd nothing else matters\r\nNever opened myself this way\r\nLife is ours, we live it our way\r\nAll these words, I don\'t just say\r\nAnd nothing else matters\r\nTrust I seek and I find in you\r\nEvery day for us something new\r\nOpen mind for a different view\r\nAnd nothing else matters\r\nNever cared for what they do\r\nNever cared for what they know\r\nBut I know\r\nSo close, no matter how far\r\nIt couldn\'t be much more from the heart\r\nForever trusting who we are\r\nAnd nothing else matters\r\nNever cared for what they do\r\nNever cared for what they know\r\nBut I know\r\nI never opened myself this way\r\nLife is ours, we live it our way\r\nAll these words, I don\'t just say\r\nAnd nothing else matters\r\nTrust I seek and I find in you\r\nEvery day for us something new\r\nOpen mind for a different view\r\nAnd nothing else matters\r\nNever cared for what they say\r\nNever cared for games they play\r\nNever cared for what they do\r\nNever cared for what they know\r\nAnd I know, yeah, yeah\r\nSo close, no matter how far\r\nCouldn\'t be much more from the heart\r\nForever trusting who we are\r\nNo, nothing else matters', 'Heavy metal', 2);

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
            MODIFY `id_banda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

            --
            -- AUTO_INCREMENT de la tabla `canciones`
            --
            ALTER TABLE `canciones`
            MODIFY `id_cancion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
            COMMIT;

            /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
            /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
            /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

            END;
            $this->db->query($sql);
        }
    }
}
