-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-06-2016 a las 20:38:40
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cobshop`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos`
--

CREATE TABLE `carritos` (
  `id_carrito` smallint(5) UNSIGNED NOT NULL,
  `id_usuario` smallint(5) UNSIGNED NOT NULL,
  `id_producto` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` tinyint(3) UNSIGNED NOT NULL,
  `categoria` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `categoria`) VALUES
(1, 'Placas Base'),
(2, 'Procesadores'),
(3, 'Tarjetas Gráficas'),
(4, 'Memoria RAM'),
(5, 'Discos Duros'),
(6, 'Sonido'),
(7, 'Ventilación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` smallint(5) UNSIGNED NOT NULL,
  `comentario` text CHARACTER SET latin1,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario` smallint(5) UNSIGNED NOT NULL,
  `id_producto` smallint(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `comentario`, `fecha`, `id_usuario`, `id_producto`) VALUES
(6, 'molan mil\r\n', '2016-06-01 14:48:51', 16, 120),
(7, 'to wapa', '2016-06-01 15:29:55', 16, 96);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` smallint(5) UNSIGNED NOT NULL,
  `id_usuario` smallint(5) UNSIGNED NOT NULL,
  `id_producto` smallint(5) UNSIGNED NOT NULL,
  `unidades` tinyint(3) UNSIGNED NOT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `coste_total` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `id_usuario`, `id_producto`, `unidades`, `fecha`, `coste_total`) VALUES
(1, 16, 45, 1, '2016-05-30 08:22:47', 50),
(2, 16, 45, 1, '2016-05-30 08:38:14', 10),
(3, 16, 45, 1, '2016-05-30 08:41:57', 10),
(4, 16, 45, 1, '2016-05-30 08:43:28', 10),
(5, 16, 45, 1, '2016-05-30 09:06:25', 10),
(6, 16, 45, 1, '2016-05-30 09:07:15', 10),
(7, 16, 45, 1, '2016-05-30 09:08:59', 10),
(8, 16, 45, 1, '2016-05-30 09:10:37', 10),
(9, 16, 45, 1, '2016-05-30 09:16:25', 10),
(10, 16, 45, 1, '2016-05-30 09:17:32', 10),
(11, 16, 45, 1, '2016-05-30 09:19:16', 10),
(12, 16, 45, 1, '2016-05-30 09:20:19', 10),
(13, 16, 45, 1, '2016-05-30 09:23:42', 10),
(14, 16, 45, 1, '2016-05-30 09:24:57', 10),
(15, 16, 45, 1, '2016-05-30 09:27:49', 10),
(16, 16, 45, 1, '2016-05-30 09:30:02', 10),
(17, 16, 45, 1, '2016-05-30 09:30:34', 10),
(18, 16, 45, 1, '2016-05-30 09:32:36', 10),
(19, 16, 45, 1, '2016-05-30 09:34:42', 10),
(20, 16, 46, 1, '2016-05-30 09:35:43', 41),
(21, 16, 45, 1, '2016-05-30 09:41:49', 10),
(22, 16, 46, 1, '2016-05-30 09:46:36', 41),
(23, 16, 120, 2, '2016-05-30 09:47:16', 68),
(24, 16, 117, 1, '2016-05-30 09:49:27', 136),
(25, 16, 117, 3, '2016-05-30 09:51:55', 408),
(26, 16, 120, 1, '2016-05-30 09:56:41', 34),
(27, 16, 107, 1, '2016-05-30 09:59:34', 50),
(28, 16, 120, 1, '2016-05-30 10:00:35', 34),
(29, 16, 117, 1, '2016-05-30 10:08:32', 136),
(30, 16, 120, 1, '2016-05-30 10:09:22', 34),
(31, 16, 106, 1, '2016-05-30 10:10:55', 5),
(32, 16, 117, 1, '2016-05-30 10:11:39', 136),
(33, 16, 120, 4, '2016-05-30 10:12:52', 137),
(34, 16, 117, 1, '2016-05-30 10:13:40', 136),
(35, 16, 106, 3, '2016-05-30 10:14:25', 15),
(36, 16, 107, 1, '2016-05-30 14:13:11', 50),
(37, 16, 120, 1, '2016-05-30 14:13:54', 34),
(38, 16, 120, 1, '2016-05-30 14:15:57', 34),
(39, 16, 120, 1, '2016-05-30 14:17:53', 34),
(40, 16, 120, 1, '2016-06-01 14:49:00', 34),
(41, 16, 117, 3, '2016-06-01 15:29:18', 408);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` smallint(5) UNSIGNED NOT NULL,
  `producto` varchar(255) CHARACTER SET latin1 NOT NULL,
  `caracteristicas` text CHARACTER SET latin1,
  `precio` smallint(6) DEFAULT NULL,
  `stock` smallint(6) DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET latin1 DEFAULT 'nophoto.jpg',
  `descuento` int(11) DEFAULT NULL,
  `id_categoria` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `producto`, `caracteristicas`, `precio`, `stock`, `foto`, `descuento`, `id_categoria`) VALUES
(45, 'wd elements 1tb 2.5', 'máxima velocidad de transferencia\r\nla conexión usb 3.0 proporciona el máximo rendimiento para transferir archivos al disco o desde el disco.\r\ngran capacidad en un diseño elegante\r\ncon hasta 2 tb de capacidad en un diseño ligero, este disco es el compañero ideal para los usuarios que viajan.\r\n\r\n', 10, 8, 'wd_elements_1tb_2_5__usb_3_0_290_290.jpg', 0, 5),
(46, 'gigabyte ga-h81m-s2h', 'un conjunto de características y de componentes que proporcionan un rendimiento récord, un funcionamiento eficiente a temperaturas bajas y una mayor vida útil de la placa.\r\n', 55, 3, 'gigabyte_h81m_s2h_290_290.jpg', 25, 1),
(86, 'Gigabyte GeForce GTX 970 Gaming', 'Graficazos hiperrealistas a precio de escándalo. La GTX 970 es la piedra filosofal, el corazón de tu ordenador, porque sí, lo sabes, al final vas a llevarte una GeForce GTX 970 de Gigabyte para disfrutar de tus videojuegos como nunca antes en resolución Ultra HD o 4K para entendernos. ¡No te arrepentirás! Prometido.\r\n', 359, 20, 'gigabyte_geforce_gtx_970_windforce_oc_4gb_gddr5_290_290.jpg', 0, 3),
(87, 'Tacens Anima AF12 120X120', 'Ventilador auxiliar ', 5, 50, 'tacens_anima_af12_290_290.jpg', 0, 7),
(88, 'Creative Sound Blaster Z 5.1 PCIe', 'El sistema de audio completo para tu escritorio: Sound Blaster Z\r\n\r\nSound Blaster Z, que forma parte de las tarjeta de sonido de alto rendimiento de la serie Z de Sound Blaster® PCI-Express, es una solución para juegos y entretenimiento global que incorpora las funciones de la tarjeta Sound Blaster Zx e incluye un conjunto de micrófono de formación de haces de calidad. \r\n\r\n', 69, 10, 'creative_sound_blaster_z_290_290.jpg', 0, 6),
(89, 'Intel i7-6700K 4.0Ghz Box', 'La nueva hornada de procesadores Intel estrena socket o zócalo, pasando de los 1150 pines de la generación Haswell a los 1151 de este i7 6700K de la generación Skylake.\n\n', 329, 3, 'intel_i7_6700k_4_0ghz_box_290_290.jpg', 5, 2),
(90, 'Asus Z170 PRO GAMING ', 'Disfruta de múltiples configuraciones con la placa base Asus Z170 Pro Gaming, una de las placas base de Asus orientadas al usuario gamer.\r\n\r\nLa motherboard es compatible con socket 1151 para la sexta generación de procesadores Intel Core i7 e i5 fabricados en 14 y 22 nanómetros y soporta la tecnología Intel Turbo Boost Technology 2.0.\r\n\r\n\r\n', 149, 8, 'asus_z170_pro_gaming_290_290.jpg', 0, 1),
(91, 'Asus H81M-P PLUS', 'Placa madre Intel® H81 con LAN, cuatro USB 3.0 puertos y BIOS UEFI fácil de usar.\r\n\r\n', 51, 3, 'asus_h81m__p_plus_290_290.jpg', 0, 1),
(94, 'Asus AM1M-A ', 'Te presetamos la Asus AM1M-A un placa base cpon socket AMD AM1.\r\n', 37, 10, 'asus_am1m_a_290_290.jpg', 0, 1),
(96, 'MSI 970 Gaming', 'Placas base MSI GAMING ® están diseñados para proporcionar a los jugadores con las características y la mejor tecnología en su clase. Con el respaldo de las miradas imponentes de dragón de MSI, cada placa base es una obra maestra de la ingeniería a la medida de la perfección de juego. \r\n\r\n', 96, 8, 'msi_970_gaming_290_290.jpg', 0, 1),
(97, 'msi_970_gaming_290_290.jpg', 'Te presentamos la Gigabyte GA-Z97P-D3, una maravilla de placa base con chiset Z97 y soporte para la 4ª y 5ª generacion de procesadores Intel.\r\n', 92, 4, 'gygabite_ga_z97p_d3_290_290.jpg', 0, 3),
(98, 'Intel Core i5-4460 3.2Ghz Box', 'Intel nos presenta el i5 4460, un procesador potente que hace de la eficiencia su máxima premisa sobre la cuál edifica una solución perfecta para los usuarios más exigentes.\n\n\n', 169, 15, 'intel_core_i5_4460_3_2ghz_box_290_290.jpg', 0, 2),
(99, 'Intel Core i7-6700 3.4GHz Box', 'Intel Core i7-6700 3.4GHz Box', 289, 30, 'intel_i7_6700k_4_0ghz_box_290_290.jpg', 0, 2),
(100, 'Asus GeForce Strix GTX 960', 'Asus GeForce Strix GTX 960', 214, 3, 'asus_geforce_strix_gtx_960_directcu_ii_oc_4gb_gddr5_290_290.jpg', 0, 3),
(101, 'Gigabyte GeForce GTX 960 OC WindForce 4GB DDR5', 'Con overclocking de seriey 4GB GDDR5, la GTX 960 de Gigabyte viene preparada para darle caña ¡Y le gusta! Deja a todos alucinados con tu aim en el Counter Strike o el Battlefront ahora que juegas sin tirones. Eso sí, ya no tienes excusa para no ser el mejor en tus partidas.\r\n\r\n', 222, 4, 'gigabyte_geforce_gtx_960_oc_4gb_ddr5_290_290.jpg', 0, 3),
(102, 'G.Skill Ripjaws X DDR3', 'G.Skill Ripjaws X DDR3 1600 PC3-12800 8GB 2x4GB CL9 - Memoria DDR3\r\n\r\n', 38, 12, 'g_skill_ripjaws_x_ddr3_1600_pc3_12800_8gb_2x4gb_cl9_290_290.jpg', 0, 4),
(103, 'G.Skill Aegis DDR3', 'G.Skill Aegis DDR3 1333 PC3-10666 4GB CL9 - Memoria DDR3\r\n', 19, 4, 'g_skill_aegis_ddr3_1333_pc3_10666_4gb_1x4gb_cl9_290_290.jpg', 0, 4),
(104, 'seagate barracuda 7200.14 1tb sata3', 'las unidades barracuda® le ofrecen todas las novedades en almacenamiento que le ayudan a reducir costes e incrementar el rendimiento.\r\n', 47, 6, 'seagate_barracuda_7200_14_1tb_sata3_290_290.jpg', 0, 5),
(105, 'Toshiba Canvio Basics 2.5" 1TB USB 3.0', 'Si tienes problemas de espacio, los discos duros externos son la solución a todos ellos. Olvídate de la falta de espacio con un disco duro externo Toshiba Canvio Basics de 1TB y continúa almacenando todos tus documentos sin preocuparte por los gigabytes.\r\n\r\n', 53, 8, 'toshiba_canvio_basics_500gb_usb_3_0_negro_290_290.jpg', 0, 5),
(106, 'Tarjeta de Sonido 5.1 USB', 'El adaptador de Sonido USB 5.1 expande su ordenador permitiendo una Tarjeta de Sonido adicional. Simplemente enchufe el adaptador a un puerto USB libre de su portátil o PC y conecte en él sus auriculares o altavoz. El uso de auriculares es especialmente adecuado para aplicaciones como Skype\r\n\r\n', 5, 25, 'tarjeta_de_sonido_usb_5_1_290_290.jpg', 0, 6),
(107, 'Creative Sound Blaster Audigy RX', 'Disfruta de las maravillas del podcast de alta calidad y del sonido envolvente multicanal! ¡Los efectos EAX acelerados por hardware permiten incorporar muchos tipos de efectos de sonido de forma sencilla! Además, incorpora una relación de señal-ruido (SNR) de 106 dB, un amplificador de auriculares de 600 ohmios para una supervisión de excelente calidad y paquetes de software que permiten la personalización completa del audio.\r\n', 50, 4, 'creative_sound_blaster_audigy_rx_290_290.jpg', 0, 6),
(117, 'samsung 850 evo ssd series 500gb sata3', 'samsung 850 evo ssd series 500gb sata3', 136, 4, 'intel_i7_6700k_4_0ghz_box_290_290.jpg', 0, 1),
(120, 'kingston hyperx fury blue ddr3', 'máxima potencia y rendimiento asegurado.', 38, 1, 'kingston_hyperx_fury_blue_ddr3_1866mhz_16gb_2x4gb_cl10_290_290.jpg', 10, 4);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `propag`
--
CREATE TABLE `propag` (
`id_producto` smallint(5) unsigned
,`producto` varchar(255)
,`caracteristicas` text
,`precio` smallint(6)
,`stock` smallint(6)
,`foto` varchar(255)
,`descuento` int(11)
,`id_categoria` tinyint(3) unsigned
,`categoria` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE `tipos` (
  `id_tipo` tinyint(3) UNSIGNED NOT NULL,
  `tipo` varchar(25) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id_tipo`, `tipo`) VALUES
(1, 'admin'),
(2, 'normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` smallint(5) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(255) NOT NULL,
  `direccion` varchar(255) CHARACTER SET latin1 NOT NULL,
  `provincia` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ciudad` varchar(255) CHARACTER SET latin1 NOT NULL,
  `codigo_postal` varchar(25) CHARACTER SET latin1 NOT NULL,
  `telefono` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `id_tipo` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `password`, `direccion`, `provincia`, `ciudad`, `codigo_postal`, `telefono`, `id_tipo`) VALUES
(11, 'admin', 'cobshop.compraonline@gmail.com', 'b13fde1811009957cd250d4bebbb074edaf9ec052e7d440007e2c571a80d4b056818cecb02a689bbd218029cc6675cd8949404ef3f424f29e1f20af9a3685980', '--', 'las palmas', 'las palmas', '35012', '928-888888', 1),
(16, 'cobo', 'coblion@gmail.com', 'b13fde1811009957cd250d4bebbb074edaf9ec052e7d440007e2c571a80d4b056818cecb02a689bbd218029cc6675cd8949404ef3f424f29e1f20af9a3685980', 'federico viera 20, piso 2, puerta derecha', 'las palmas', 'las palmas de g. c.', '35012', NULL, 1),
(17, 'jon snow', 'jsnow@winterfell.no', 'b13fde1811009957cd250d4bebbb074edaf9ec052e7d440007e2c571a80d4b056818cecb02a689bbd218029cc6675cd8949404ef3f424f29e1f20af9a3685980', 'castle black', 'winterfell', 'winterfell', '88888', NULL, 2),
(27, 'usuarioocho', 'usu8@mail.com', '98f63e47c6aef71f0e76782bee9e43061a7890b6a67bdcb971b18f69ea391a21e9c66fda14f61f7603473a19c0cc8e0ba89a805a44df0f560385b74b70767a33', 'las palmas', 'las palmas', 'las palmas', '35012', '', 2),
(28, 'ranger rojo', 'ranger@mail.com', '98f63e47c6aef71f0e76782bee9e43061a7890b6a67bdcb971b18f69ea391a21e9c66fda14f61f7603473a19c0cc8e0ba89a805a44df0f560385b74b70767a33', 'las palmas', ' las palmas', 'las palmas', '35012', '', 2);

-- --------------------------------------------------------

--
-- Estructura para la vista `propag`
--
DROP TABLE IF EXISTS `propag`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `propag`  AS  (select `productos`.`id_producto` AS `id_producto`,`productos`.`producto` AS `producto`,`productos`.`caracteristicas` AS `caracteristicas`,`productos`.`precio` AS `precio`,`productos`.`stock` AS `stock`,`productos`.`foto` AS `foto`,`productos`.`descuento` AS `descuento`,`categorias`.`id_categoria` AS `id_categoria`,`categorias`.`categoria` AS `categoria` from (`productos` join `categorias` on((`productos`.`id_categoria` = `categorias`.`id_categoria`)))) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD PRIMARY KEY (`id_carrito`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`),
  ADD KEY `id_categoria_2` (`id_categoria`);

--
-- Indices de la tabla `tipos`
--
ALTER TABLE `tipos`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_tipo` (`id_tipo`),
  ADD KEY `id_tipo_2` (`id_tipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carritos`
--
ALTER TABLE `carritos`
  MODIFY `id_carrito` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;
--
-- AUTO_INCREMENT de la tabla `tipos`
--
ALTER TABLE `tipos`
  MODIFY `id_tipo` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carritos`
--
ALTER TABLE `carritos`
  ADD CONSTRAINT `carritos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `carritos_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_4` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipos` (`id_tipo`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
