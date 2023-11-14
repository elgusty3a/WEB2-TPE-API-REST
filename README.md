
#
# <p align=center> WEB2-TPE-API-REST
## <p align=center> TERCERA ENTREGA:
### INTEGRANTES:


| NOMBRE  | e-mail  | Github |
| :------------: |:---------------:| :-------------------: |
| Arias Gustavo      | ariasgustavo3a@gmail.com | https://github.com/elgusty3a |
| Gonzalez Tomás     | tomasgonzalez429030@gmail.com | https://github.com/tomasgonzalez24 |

#
# <p align=center> TRES-A Neumaticos
### Sitio web dedicado a la venta de neumaticos.
#### Objetivos:
  - Desarrollar un sitio web para la compra de nuestros productos.
  - Ofrecer una interfaz amigable.
  - Conectar con una base de datos para control de stock.
  - Desarrollar una API para consumo externo.

##
## <p align=center> GRÁFICO DE ENTIDAD-RELACIÓN
<p align=center>
<img src="BBDDs/estructuraDDBB.jpg" alt="grafico-entidad-relacion">

- La tabla "usuarios" se utilizará a modo de LOGIN del administrador del sitio.
- En la tabla "productos" se guardarán los datos de los mismos y se detallará el producto que deseé adquirir.
- En la tabla "categorias" se encuentras las 3 categorias de productos ofrecidos en la tienda.
- Cada producto se relaciona por medio de una clave foranea con su respectiva categoria.
- En la tabla "comentarios" los usuarios pueden dejar una valoracion y una reseña sobre los productos.



## Herramientas para el consumo de la API

- Para las pruebas de la API se utilizó la extension oficial para Visual Studio Code de Postman, la cual tiene la siguiente apariencia.

<img src="BBDDs/POSTMAN-extension.jpg" alt="Postman-en-VSCODE">


### Método GET, y ejemplos de uso
- El metodo GET se utiliza para obtener datos desde la DDBB y la forma de uso se detalla con los ejemplos siguientes:

 1. LISTAR ARTICULOS: Escribiendo el comando:
 http://localhost/TUDAI-xampp/WEB2-TPE-API-REST/api/products
 se obtiene todos los articulos (o en su defecto un máximo de 50) de la lista de productos ordenados por defecto de forma ascendente de acuerdo a su precio.
 
 2. LISTAR ARTICULOS ORDENADOS: Escribiendo el comando:
 http://localhost/TUDAI-xampp/WEB2-TPE-API-REST/api/products?order=id_producto&sort=desc
  mostrará todos los productos (o en su defecto un máximo de 50) ordenados por su id correspondiente de forma descendente. Los parametros order y sort de la URL se pueden editar para hacer la busqueda que se desee.

 3. LISTAR UN PRODUCTO POR ID: Mediante la URL http://localhost/TUDAI-xampp/WEB2-TPE-API-REST/api/procuct/2 se puede, en este caso de ejemplo, mostarr el comentario Nº2.

 4. LISTAR COMENTARIOS: Escribiendo el comando:
 http://localhost/TUDAI-xampp/WEB2-TPE-API-REST/api/comments se obtiene todos los comentarios de la tabla de comentarios ordenados por defecto de forma ascendente de acuerdo a su id.

 5. LISTAR COMENTARIOS DE UN DETERMINADO ARTICULO: Con el comando:
 http://localhost/TUDAI-xampp/WEB2-TPE-API-REST/api/comments/product/8 se listan los comentarios pertenecientes al producto 8, siendo 8 el id del producto. Escribop de forma general sería ...api/comments/product/:ID

 6. LISTAR UN COMENTARIO POR ID: Mediante la URL http://localhost/TUDAI-xampp/WEB2-TPE-API-REST/api/comment/2 se puede, en este caso de ejemplo, mostarr el comentario Nº2.

 7. PAGINACION: LA paginacion se logra utilizando URLs de la siguiente manera: http://localhost/TUDAI-xampp/WEB2-TPE-API-REST/api/products?order=precio&sort=desc&pagina=1&cantidad=5 la cual muestra una lista de 5 productos comenzando por el primero (pagina 1) ordenados, en este caso, por el campo precio de forma descendente.

### Método POST, y ejemplo de uso
- El metodo POST se utiliza para crear datos desde un recurso especifico y los inserta en la DDBB y la forma de uso se detalla con lo ejemplo siguiente:

1. Con la URL http://localhost/TUDAI-xampp/WEB2-TPE-API-REST/api/comments puedo agregar un comentario al registro de comentarios de la DDBBs cuando mando por el body de la request los datos en el orden especifico en el que se encuentran los campos de la DDBBs. Por ejemplo:
```json
[
{
"id_producto": 3,
"autor": "Tomas",
"titulo": "Precio elevado",
"comentario": "El precio es muy elevado para lo que brinda el producto",
"valoracion": 3
}
]
```
### Método DELETE, y ejemplo de uso
- El metodo DELETE se utiliza para eliminar datos de la DDBB y la forma de uso se detalla con lo ejemplo siguiente:

1. Escribiendo la URL de la forma http://localhost/TUDAI-xampp/WEB2-TPE-API-REST/api/comment/1 se borra el comentario con el id = 1.
De forma general se puede escribir .../api/comment/:ID para eliminar cualquier comentario existente.

### Método PUT, y ejemplo de uso
- El metodo PUT se utiliza para editar o modificar datos de la DDBB y la forma de uso se detalla con lo ejemplo siguiente:

1. Para editar datos de un registro existente en la base de datos lo que hay que hacer es formar un JSON en el body de la request, como si fueramos a crear un dato nuevo, pero en lugar de utilizar el metodo POST se utiliza el PUT.
La URL es de la forma http://localhost/TUDAI-xampp/WEB2-TPE-API-REST/api/comment y el JSON sería:
```JSON
{
    "id": 1,
    "id_producto": 3,
    "autor": "Juan",
    "titulo": "Confort",
    "comentario": "Firestone resulto una cubierta mas dura de lo esperado, se nota en el andar del coche, no recomiendo.",
    "valoracion": 2,
    "fecha": "2023-11-12 15:49:44"
}
```
siendo id el numero identificador del comentario a editar.
#
# <p align=center>Tabla de ruteo y endpoints

| Endpoint             | Método  | Controlador        | Función                 |
|:-------------------: |:-------:| :-----------------:| :----------------------:|
| products             | GET     | tyresApiController | getAllProducts          |
| product/:I           | GET     | tyresApiController | getProduct              |
| comments             | GET     | tyresApiController | getAllComments          |
| comment/:ID          | GET     | tyresApiController | getComment              |
| comments/product/:ID | GET     | tyresApiController | getAllCommentsByProduct |
| comments             | POST    | tyresApiController | sendComment             |
| comment/:ID          | DELETE  | tyresApiController | deleteComment           |
| comment              | PUT     | tyresApiController | updateComment           |


#
# <p align=center>Código SQL que genera la base de datos (exportado desde phpMyAdmin)
```SQL
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2023 a las 19:54:34
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
-- Base de datos: `tresa_neumaticos`
--
CREATE DATABASE IF NOT EXISTS `tresa_neumaticos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tresa_neumaticos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `categoria`) VALUES
(1, 'Cubierta'),
(2, 'Camara'),
(3, 'Llanta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `comentario` varchar(250) NOT NULL,
  `valoracion` int(5) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `id_producto`, `autor`, `titulo`, `comentario`, `valoracion`, `fecha`) VALUES
(1, 3, 'Juan', 'Confort', 'Firestone resulto una cubierta mas dura de lo esperado, se nota en el andar del coche, no recomiendo.', 2, '2023-11-12 15:49:44'),
(2, 8, 'Mateo', 'Opinion durabilidad', 'Impecable, super recomendable, pero tener en cuenta respetar los kms para hacer rotacion y balanceo', 4, '2023-11-12 15:51:01'),
(3, 5, 'Federico', 'Deformacion', 'Compré dos y una de las cuañes se deformo a los 2000 kms. un desastre, muy duras y tienden a deformarse. Uno paga la marca al final de cuentas', 1, '2023-11-12 15:52:02'),
(4, 2, 'Taylor Paladini', 'Sin problemas', 'Recibi el producto en tiempo y forma, ni un problema. La cubierta tiene buen andar, buena relacion precio calidad.', 5, '2023-11-12 15:53:26'),
(5, 7, 'Miguel', 'Demora', 'La cubierta cumple lo que promete, sin embargo el envio tardó un mes, no se si es problema de la empresa de transporte o del vendedor que demoró el despacho.', 3, '2023-11-12 15:55:06'),
(6, 32, 'Patty Swift', 'Impecabe', 'Buena atencion al cliente y predisposicion para reclamos, tuve un inconveniente con mi tarjeta de credito y lo solucionaron al instante. El producto muy bueno.', 4, '2023-11-12 15:56:26'),
(8, 3, 'Maximiliano War', 'Fire Stone', 'Como su nombre lo indica, una piedra', 2, '2023-11-12 19:17:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `medidas` varchar(50) NOT NULL,
  `indice_carga` int(11) DEFAULT NULL,
  `indice_velocidad` char(10) DEFAULT NULL,
  `precio` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `marca`, `medidas`, `indice_carga`, `indice_velocidad`, `precio`, `id_categoria`) VALUES
(1, 'Michelin', '165/70 R13', 79, 'T', 11500, 1),
(2, 'Michelin', '185/60 R14', 82, 'H', 117000, 1),
(3, 'Firestone', '165/70 R13', 79, 'T', 112000, 1),
(4, 'Firestone', '185/60 R14', 82, 'H', 114500, 1),
(5, 'Pirelli', '165/70 R13', 79, 'T', 113500, 1),
(6, 'Pirelli', '185/60 R14', 82, 'H', 114300, 1),
(7, 'Bridgestone', '165/70 R13', 79, 'T', 113200, 1),
(8, 'Bridgestone', '185/60 R14', 82, 'H', 111300, 1),
(9, 'Pirelli', '195/60 R15', 88, 'V', 98400, 1),
(10, 'Pirelli', '215/55 R16', 93, 'W', 106150, 1),
(11, 'Firestone', '195/60 R15', 88, 'V', 99420, 1),
(12, 'Bridgestone', '215/55 R16', 93, 'W', 102000, 1),
(13, 'Michelin', '205/55 R16', 91, 'V', 155000, 1),
(14, 'Bridgestone', '205/55 R16', 91, 'V', 124000, 1),
(15, 'Firestone', '205/55 R16', 91, 'V', 113050, 1),
(16, 'HORNG FORTUNE', 'E – 10 TR 87', 0, '', 5000, 2),
(17, 'ZAR', 'F – 13 TR 13', 0, '', 5500, 2),
(18, 'HORNG FORTUNE', 'G – 13 TR 13', 0, '', 5650, 2),
(19, 'MERC IMPERIAL', 'K – 16 TR 15', 0, '', 7580, 2),
(20, 'HORNG FORTUNE', 'K – 16 TR 15', 0, '', 7400, 2),
(21, 'MOTOR SPORT', '16X7 5-108', 0, '', 45000, 3),
(22, 'MSA WHEELS', '16X7 4-137', 0, '', 54000, 3),
(23, 'PRW', '16X7.5 5-100', 0, '', 32055, 3),
(24, 'MSA WHEELS', '16X7 4-137', 0, '', 41000, 3),
(25, 'R1 SPORT', '15X8 6-114.3', 0, '', 28800, 3),
(26, 'MSA WHEELS ', '14X7 4-110', 0, '', 32450, 3),
(27, 'BLANK- CLASIC', '15X7', 0, '', 36650, 3),
(28, 'PRW', '13X5 4-100', 0, '', 25800, 3),
(32, 'Goodyear', '215/50 R17', 91, 'V', 210650, 1),
(38, 'Drook', '80/100 - 14', 0, '', 5530, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombreUsuario`, `email`, `pass`) VALUES
(1, 'Gustavo Arias', 'gustavoarias3a@gmail.com', '$2y$10$i9WiWDC.gqusSMLWVeP96u0PrgTyhyicR1SSRGeOcBucHBFPzoL5K'),
(2, 'webadmin', 'webadmin@unicen.com', '$2y$10$u4heaCRCcQt014uAUpW6KuUz.WxxVZOVIAYhxdf9VUCmh6ju5XPDG');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_producto` (`id_producto`) USING BTREE;

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombreUsuario` (`nombreUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

```