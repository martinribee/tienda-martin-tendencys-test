# tienda-martin-tendencys-test
prueba tecnica Martin Rivera Bernal

-ARQUITECTURA:
 El proyecto está realizado en LARAVEL 5.1 y se basa en la estructura de Laravel para crear APIS, las cuales podemos encontrar en el directorio routes/api.php.
 
 el controlador donde estará la logica de los end-points para las acciones restfull (GET,POST,PUT,PATCH,DELETE), se encuentra en el directorio 
 app/http/Controllers/tiendaApiController.php

 cada eendpoint ya están preparados para consumirse dependiendo del verbo http: 
 
 http://localhost/api/products

-SEGURIDAD:
 Los endpoints están protegidos por JWT (Json web tokens), para crear un json web token basta con ir a http://localhost/api/generate-token, el token tendrá una hora 
 de caducidad despues de esto hay que generar otro.

-INSTALACION DE LA APLICACION:
 Al descargar el proyecto e instalarlo desde Apache o Ngix, hay que instalar antes Composer, para poder correr los comandos artisan de Laravel: 
 https://getcomposer.org/download/

-una vez instalado el proyecto en ambiente local y apuntando como proyecto principal y tengamos instalado composer, ejecutamos composer update para instalar todas 
 las dependencias y con esto ya debemos de tener el proyecto funcionando.


-INSTALACION DE LA BASE DE DATOS:
ejecute los siguientes secripts:

create database tienda_martin_db

CREATE TABLE `catalog_products` (
  `id_product` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
SELECT * FROM tienda_martin_db.catalog_products;

INSERT INTO `tienda_martin_db`.`catalog_products` (`id_product`, `name`, `description`, `height`, `length`, `width`) VALUES ('1', 'celular a2', 'gama de entrada 2', '1', '2', '3');
INSERT INTO `tienda_martin_db`.`catalog_products` (`id_product`, `name`, `description`, `height`, `length`, `width`) VALUES ('2', 'CELULAR KIWI A1', 'Celular gama de entrada , camara de 5 megapixeles y pantalla de 4.5 pulgadas', '15', '5', '10');
INSERT INTO `tienda_martin_db`.`catalog_products` (`id_product`, `name`, `description`, `height`, `length`, `width`) VALUES ('3', 'CARGADOR CAT POWER', 'Cargador de alta velicidad, gama de entrada y con led de colores', '5', '5', '5');
INSERT INTO `tienda_martin_db`.`catalog_products` (`id_product`, `name`, `description`, `height`, `length`, `width`) VALUES ('4', 'LAPTOP CAT POWER', 'Gama media pero con pantalla de 17 pulgadas y procesador doble nucleo y decoracion de gatos', '5', '50', '25');
INSERT INTO `tienda_martin_db`.`catalog_products` (`id_product`, `name`, `description`, `height`, `length`, `width`) VALUES ('6', 'Funda celular PARA KIWI A1', 'Funda color roja con olor a fresa', '0', '0', '0');
INSERT INTO `tienda_martin_db`.`catalog_products` (`id_product`, `name`, `description`, `height`, `length`, `width`) VALUES ('7', 'celular cat C1', 'smarphone de gama baja con pantalla de muy baja resolucion', '2', '3', '4');

CREATE TABLE `access_tokens` (
  `id_access_tokens` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `token` longtext,
  PRIMARY KEY (`id_access_tokens`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO `tienda_martin_db`.`access_tokens` (`id_access_tokens`, `user_id`, `token`) VALUES ('1', '1', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJtYXJ0aW4iLCJhdWQiOiJyaXZlcmEiLCJpYXQiOjE3MjIxMTAyNTcsImV4cCI6MTcyMjExMzg1N30.2q73xUM3cMVQLW2SedzfkPwA7WjU5Sx1J8y26VG1Bxo');

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img_profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `tienda_martin_db`.`users` (`id`, `name`, `phone`, `img_profile`) VALUES ('1', 'Martin Rivera', '1111111111', 'images/picture.jpg');




LIBRERIAS O DEPENDENCIAS UTILIZADAS:
-Libreria utilizada para el funcionamiento de la seguridad JWT:  firebase/php-jwt

 
 

 
