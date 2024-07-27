# tienda-martin-tendencys-test
prueba tecnica Martin Rivera Bernal

-Arquitectura de la aplicación:
 El proyecto está realizado en LARAVEL 5.1 y se basa en la estructura de Laravel para crear APIS, las cuales podemos encontrar en el directorio routes/api.php.
 
 el controlador donde estará la logica de los end-points para las acciones restfull (GET,POST,PUT,PATCH,DELETE), se encuentra en el directorio 
 app/http/Controllers/tiendaApiController.php

-Seguridad de la aplicación:
 Los endpoints están protegidos por JWT (Json web tokens), para crear un json wen token basta con ir a http://localhost/api/generate-token, el token tendrá una ora 
 de caducidad despues de esto hay que generar otro.

-Instalación de la aplicación:
 Al descargar el proyecto e instalarlo desde Apache o Ngix, hay que instalar antes Composer, para poder correr los comnandos artisan de Laravel: 
 https://getcomposer.org/download/

-una vez instalado el proyecto en ambiente local y apuntando como proyecto principal y tengamos instalado composer, ejecutamos composer update para instalar todas 
 las dependencias y con esto ya debemos de tener el proyecto funcionando.

-Libreria utilizada para el funcionamiento de la seguridad JWT:  firebase/php-jwt
 
 

 
