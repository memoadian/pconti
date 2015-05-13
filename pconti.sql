-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-05-2015 a las 20:19:15
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pconti`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `slug` char(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permits`
--

CREATE TABLE IF NOT EXISTS `permits` (
  `id` int(11) NOT NULL,
  `permit_key` int(11) NOT NULL,
  `name` char(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permits`
--

INSERT INTO `permits` (`id`, `permit_key`, `name`) VALUES
(1, 1, 'Crear'),
(2, 2, 'Editar'),
(3, 3, 'Borrar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL,
  `name` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `md5` char(32) COLLATE utf8_spanish_ci NOT NULL,
  `ext` char(3) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pictures`
--

INSERT INTO `pictures` (`id`, `name`, `md5`, `ext`) VALUES
(1, 'chamarra-d', '0eacf07b7b76ec8bdaba2ccb24bc53a0', 'jpg'),
(2, 'botas-yuyi', '1dfc8e03b685258f5ff92016876aa2c4', 'jpg'),
(3, 'chamarras-', 'dd89bdeddf42bbe45c693ef7e7453172', 'jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `picture_product`
--

CREATE TABLE IF NOT EXISTS `picture_product` (
  `picture_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `picture_product`
--

INSERT INTO `picture_product` (`picture_id`, `product_id`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 2),
(4, 2),
(2, 3),
(3, 3),
(4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `name` char(255) COLLATE utf8_spanish_ci NOT NULL,
  `slug` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `description` text COLLATE utf8_spanish_ci NOT NULL,
  `image` varchar(48) COLLATE utf8_spanish_ci NOT NULL,
  `sku` char(100) COLLATE utf8_spanish_ci NOT NULL,
  `price` float NOT NULL,
  `category` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `quantity` smallint(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `image`, `sku`, `price`, `category`, `stock`, `quantity`) VALUES
(1, 'Chamarra', 'chamarra', 'Chamarra de cuero', '', '29876', 580, 1, 1, 20),
(2, 'Cafecita jeje XD', 'cafecita-jeje-xd', 'Esta es una descripción con etiquetas html <a href="hola"></a> a ver que pex con las eñes y los acentos', 'chamarras--dd89bdeddf42bbe45c693ef7e7453172.jpg', '123456', 340, 0, 1, 30),
(3, 'Botas Matavivoras', 'botas-matavivoras', 'descripcion', 'botas-yuyi-1dfc8e03b685258f5ff92016876aa2c4.jpg', 'KU-123', 400, 0, 1, 400);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `name` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `username` char(20) COLLATE utf8_spanish_ci NOT NULL,
  `email` char(50) COLLATE utf8_spanish_ci NOT NULL,
  `password` char(60) COLLATE utf8_spanish_ci NOT NULL,
  `remember_token` char(60) COLLATE utf8_spanish_ci NOT NULL,
  `rol` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `remember_token`, `rol`, `created_at`, `updated_at`) VALUES
(1, 'Prueba', 'prueba', 'prueba@mail.com', '$2y$10$iGL7SdDbAYik2bbhYMNh4uUDaWG6Abl26FKFg.9J2Dgk2Ue7.ovzu', 'Y2rPC5g1OBRJABQ5YQR9D6kF7GDP4EKnliXDFx2pjrfVRWmiqNgk0kNvmGR0', 1, '2015-05-06', '2015-05-11');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permits`
--
ALTER TABLE `permits`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `permits`
--
ALTER TABLE `permits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
