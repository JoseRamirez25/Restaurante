-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-04-2022 a las 17:08:20
-- Versión del servidor: 8.0.21
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurante`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administracion`
--

DROP TABLE IF EXISTS `administracion`;
CREATE TABLE IF NOT EXISTS `administracion` (
  `nombre` varchar(155) NOT NULL,
  `pass` varchar(155) NOT NULL,
  `documento` bigint NOT NULL,
  `email` varchar(155) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administracion`
--

INSERT INTO `administracion` (`nombre`, `pass`, `documento`, `email`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 123, 'admin@admin.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

DROP TABLE IF EXISTS `ingredientes`;
CREATE TABLE IF NOT EXISTS `ingredientes` (
  `Ingrediente` varchar(155) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Precio` int NOT NULL,
  `Imagen` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `Cantidad` int NOT NULL,
  `ID_ingrediente` int NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`Ingrediente`, `Precio`, `Imagen`, `Cantidad`, `ID_ingrediente`) VALUES
('Salsa de tomate', 2500, 'Clientes/Imagenes/imgsr.png', 96, 1),
('Salsa rosada', 3500, 'Clientes/Imagenes/imgsrs.png', 64, 2),
('Mayonesa', 4500, 'Clientes/Imagenes/imgsm.png', 66, 3),
('Papitas', 4000, 'Clientes/Imagenes/pa.png', 68, 4),
('Tocineta', 1500, 'Clientes/Imagenes/toci.png', 77, 5),
('Salsa de piÃ±a', 2000, 'Clientes/Imagenes/imgsp.png', 83, 6),
('Salsa de ajo', 3000, 'Clientes/Imagenes/imgsa.png', 92, 7),
('Salsa showy', 3500, 'Clientes/Imagenes/imgss.png', 91, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `Num_Pedido` int NOT NULL AUTO_INCREMENT,
  `ID_ingrediente` varchar(155) NOT NULL,
  `CantPorIngrediente` varchar(155) NOT NULL,
  `Total` int NOT NULL,
  `Estado` varchar(155) NOT NULL,
  `Fecha_Pedido` date DEFAULT NULL,
  PRIMARY KEY (`Num_Pedido`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`Num_Pedido`, `ID_ingrediente`, `CantPorIngrediente`, `Total`, `Estado`, `Fecha_Pedido`) VALUES
(1, '1,2,3,5', '2,1,1,0,1,0,0,0', 16500, 'Pagado', '2019-11-11'),
(2, '1,3,5', '1,0,1,0,1,0,0,0', 11000, 'Pagado', '2019-11-11'),
(3, '1,2,4,6', '1,1,0,1,0,2,0,0', 16500, 'Pagado', '2019-11-11'),
(4, '2,3,4,5', '0,1,1,2,2,0,0,0', 22000, 'Pagado', '2019-11-11'),
(5, '3,4,6', '0,0,1,2,0,1,0,0', 17500, 'Pagado', '2019-11-11'),
(6, '1,2,3', '2,2,2,0,0,0,0,0', 23000, 'Pagado', '2019-11-10'),
(7, '1,2,5,8', '2,1,0,0,1,0,0,2', 19000, 'Pagado', '2019-11-10'),
(8, '2,4,6,7', '0,2,0,1,0,1,1,0', 19000, 'Pagado', '2019-11-10'),
(9, '3,5,7', '0,0,2,0,2,0,2,0', 21000, 'Pagado', '2019-11-10'),
(10, '1,2,3,4,5,6,7,8', '1,1,1,1,2,1,1,1', 28500, 'Pagado', '2019-11-11'),
(11, '1,2,3,4', '1,1,1,1,0,0,0,0', 17000, 'Pagado', '2019-11-12'),
(12, '1,3,4', '2,0,1,1,0,0,0,0', 15500, 'Pagado', '2019-11-12'),
(13, '4', '0,0,0,2,0,0,0,0', 11000, 'Pagado', '2019-10-12'),
(14, '1,2,3,4', '2,1,1,1,0,0,0,0', 19000, 'Pagado', '2019-11-13'),
(15, '1,2,3,4', '1,2,1,1,0,0,0,0', 20500, 'Pagado', '2019-11-13'),
(16, '1,2,3,5', '1,1,1,0,2,0,0,0', 16000, 'Pagado', '2019-11-13'),
(17, '1', '2,0,0,0,0,0,0,0', 7000, 'Pagado', '2019-11-13'),
(18, '4', '0,0,0,1,0,0,0,0', 7000, 'Pagado', '2019-11-13'),
(19, '1,2', '1,1,0,0,0,0,0,0', 8500, 'Pagado', '2019-11-13'),
(20, '1,2,3,4,5,6,7,8', '1,1,1,1,1,1,1,1', 27500, 'Despachado', '2019-11-23'),
(21, '1,3,4', '1,0,1,1,0,0,0,0', 14000, 'Despachado', '2021-03-19'),
(22, '1,2,3,4', '2,2,1,1,0,0,0,0', 23500, 'Despachado', '2021-11-18'),
(23, '2,4,5,6', '0,1,0,1,1,1,0,0', 14000, 'Pendiente', '2022-04-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `Producto` varchar(155) NOT NULL,
  `PrecioP` int NOT NULL,
  `ImagenP` varchar(500) NOT NULL,
  `CantidadP` int NOT NULL,
  `ID_producto` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`Producto`, `PrecioP`, `ImagenP`, `CantidadP`, `ID_producto`) VALUES
('Perro', 3000, 'Clientes/Imagenes/perro-base.png', 31, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
