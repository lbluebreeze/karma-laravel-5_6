Karma Landing Page
==================

Sitio WEB para el concurso de apertura de las nuevas sucursales Karma.

Instalar el sitio en un equipo local
------------------------------------
Si desea configurar este sitio WEB en un equipo local puede descargar o realizar un "pull" sobre este proyecto, que contendrá todo el código fuente además de la exportación de base de datos que se encuentra en el fichero sql "db-karma.sql", en la carpeta raíz del proyecto.

Una vez descargado el proyecto e importada la base de datos, copiar el fichero ".env.example", renombrar el nuevo fichero a ".env" y actualizar las credenciales de base de datos configuradas allí.

Al finalizar, actualizar las dependencias del proyecto descritas en el fichero "composer.json" usando el comando de composer "composer update".

Ingresar a la web
-----------------
Para ingresar pulsar en el siguiente enlace: [http://localhost/karma-laravel-5_6/public](http://localhost/karma-laravel-5_6/public).

Exportar datos
--------------
El sitio WEB cuenta con un módulo de exportación de datos al que se puede acceder a través del siguiente enlace: [http://localhost/karma-laravel-5_6/public/exportar](http://localhost/karma-laravel-5_6/public/exportar).