-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2019 a las 01:58:06
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ventas`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_stock` (`_cantidad` INT, `_id` INT)  UPDATE productos SET cantidad = cantidad - _cantidad WHERE id = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `editar_productos` (IN `_id` INT(5), IN `_codigo` VARCHAR(255), IN `_descripcion` VARCHAR(255), IN `_precioVenta` INT(5), IN `_precioCompra` INT(5), IN `_cantidad` INT(5))  BEGIN 
	UPDATE productos SET codigo = _codigo, descripcion = _descripcion, precioCompra = _precioCompra, precioVenta = _precioVenta, cantidad = _cantidad WHERE _id = id;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_productos` (IN `_id` INT(5))  BEGIN
    DELETE FROM productos WHERE id = _id;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_ventas` (IN `_id` INT)  DELETE FROM ventas WHERE id = _id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_fecha_total` (`_fecha` DATE, `_total` INT)  INSERT INTO ventas(fecha, total) VALUES (_fecha, _total)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_productos` (IN `_codigo` VARCHAR(255), IN `_descripcion` VARCHAR(255), IN `_precioVenta` INT(5), IN `_precioCompra` INT(5), IN `_cantidad` INT(5))  BEGIN
    INSERT INTO productos(codigo, descripcion, precioVenta, precioCompra, cantidad) VALUES (_codigo, _descripcion, _precioVenta, _precioCompra, _cantidad);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_productos_vendidos` (`_id_producto` INT, `_id_venta` INT, `_cantidad` INT)  INSERT INTO productos_vendidos(id_producto, id_venta, cantidad) VALUES (_id_producto, _id_venta, _cantidad)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `seleccionar_productos` ()  SELECT * FROM productos$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `seleccionar_productos_carrito` (IN `_codigo` INT)  BEGIN
SELECT * FROM productos where codigo = _codigo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `seleccionar_productos_por_id` (IN `_id` INT)  BEGIN 
select * from productos where id = _id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `seleccionar_ventas` ()  BEGIN
SELECT ventas.total, ventas.fecha, ventas.id, GROUP_CONCAT(	productos.codigo, '..',  productos.descripcion, '..', productos_vendidos.cantidad SEPARATOR '__') AS productos 
FROM ventas 
INNER JOIN productos_vendidos ON productos_vendidos.id_venta = ventas.id 
INNER JOIN productos ON productos.id = productos_vendidos.id_producto 
GROUP BY ventas.id 
ORDER BY ventas.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `seleccionar_ventas_por_id` ()  SELECT id FROM ventas ORDER BY id DESC LIMIT 1$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precioVenta` int(5) NOT NULL,
  `precioCompra` int(5) NOT NULL,
  `cantidad` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `descripcion`, `precioVenta`, `precioCompra`, `cantidad`) VALUES
(2, '301', 'pozo', 30, 18, 1),
(3, '302', 'Hola', 18, 15, 0),
(6, '1', 'Alfajor', 18, 10, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_vendidos`
--

CREATE TABLE `productos_vendidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_producto` bigint(20) UNSIGNED NOT NULL,
  `cantidad` bigint(20) UNSIGNED NOT NULL,
  `id_venta` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos_vendidos`
--

INSERT INTO `productos_vendidos` (`id`, `id_producto`, `cantidad`, `id_venta`) VALUES
(2, 2, 9, 2),
(3, 2, 4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fecha` datetime NOT NULL,
  `total` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `fecha`, `total`) VALUES
(2, '2019-11-13 02:17:30', '270.00'),
(3, '2019-11-25 05:24:01', '120.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_vendidos`
--
ALTER TABLE `productos_vendidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos_vendidos`
--
ALTER TABLE `productos_vendidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos_vendidos`
--
ALTER TABLE `productos_vendidos`
  ADD CONSTRAINT `productos_vendidos_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `productos_vendidos_ibfk_2` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
