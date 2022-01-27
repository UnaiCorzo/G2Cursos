# G2Cursos

Aplicación web para acceder y crear cursos online y presenciales en el ámbito de la informática.

## Instalación

#### Requisitos
G2Cursos requiere el siguiente software:

- PHP
- MySQL
- Composer
- Docker (opcional)
- docker-compose (opcional)


Para utilizar la aplicación localmente, es necesario seguir los siguientes pasos:

- Copiar el archivo `.env.example` y renombrarlo a `.env`
- Cambiar las variables referentes a la base de datos (`DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)
- Cambiar las variables referentes al email (`MAIL_DRIVER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_ENCRYPTION`, `MAIL_FROM_ADDRESS`).
  Estos identifican el email que enviará los correos de verificación y recuperación de contraseña.

Después hay que ejecutar los siguientes comandos:

```
composer update
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

Finalmente, la aplicación estará disponible en `localhost:8000`


Para desplegar la aplicación con Docker, es necesario ejecutar los siguientes comandos:

Primero para configurar correctamente la replicación entre las dos bases de datos es necesario introducir los siguientes comandos en los contenedores de base de datos:

- En los siguientes comandos reemplazar los campos (`NOMBRE_DE_USUARIO_REPLICACIÓN`, `CONTRASEÑA`, `NOMBRE_DEL_HOST`)

En el servidor de BD principal:

```
CREATE USER 'NOMBRE_DE_USUARIO_REPLICACIÓN'@'%' IDENTIFIED WITH mysql_native_password BY 'CONTRASEÑA';
GRANT REPLICATION SLAVE ON *.* TO 'NOMBRE_DE_USUARIO_REPLICACIÓN'@'%';
```

En el servidor de BD secundario:

```
CHANGE MASTER TO
MASTER_HOST='NOMBRE_DEL_HOST',
MASTER_USER='NOMBRE_DE_USUARIO_REPLICACIÓN',
MASTER_PASSWORD='CONTRASEÑA',
MASTER_LOG_FILE='87e8982d00d1-bin.000004',
MASTER_LOG_POS=349;
reset slave;
start slave;
```

Ahora los siguientes comandos para desplegar y ejecutar la aplicación:

```
docker-compose build app
docker-compose up -d
docker-compose exec app composer update
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

Finalmente, la aplicación estará disponible en `localhost:80` y `localhost:443`

<br/>

_Copyright (C) 2022 Unai Corzo, Iosu Ibarguren, Adrián García_
