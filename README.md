# zinobeTest
Prueba de php back end para zinobe por Fabian Espinosa
# 1. 
Ejecutar comando
composer install
# 2. 
crear un database MySQL llamada zinobeTest y configurar en el archivo .env las variables DATABASE
# 3.
Ejecutar el comando para correr migraciones.
.\bin\doctrine-migrations migrations:migrate --configuration=Migrations/migrations.php
# 4.
Comando para levantar el proyecto
php -S localhost:8080
