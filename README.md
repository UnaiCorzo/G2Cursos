# G2Cursos

Aplicación web para acceder y crear cursos online y presenciales en el ámbito de la informática.

## Instalación

### Requisitos
G2Cursos requiere el siguiente software:

- PHP
- MySQL
- Composer
- Docker (opcional)
- docker-compose (opcional)

### Desplegar
Para poder desplegar la aplicación correctamente, ya sea localmente o a través de Docker, es necesario seguir estos pasos:

- Copiar el archivo `.env.example` y renombrarlo a `.env`
- Cambiar las variables referentes a las bases de datos (`DB_HOST_READ_1`, `DB_HOST_READ_2`, `DB_HOST_WRITE`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)
- Cambiar las variables referentes al email (`MAIL_DRIVER`, `MAIL_HOST`, `MAIL_PORT`, `MAIL_USERNAME`, `MAIL_PASSWORD`, `MAIL_ENCRYPTION`, `MAIL_FROM_ADDRESS`).
  Estos identifican el email que enviará los correos de verificación y recuperación de contraseña.

Después hay que ejecutar diferentes comandos dependiendo de la opción de despliegue.

#### Local
Para utilizar la aplicación localmente, es necesario ejecutar los siguientes comandos:

```
composer update
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

Finalmente, la aplicación estará disponible en `localhost:8000`


#### Docker
Para desplegar la aplicación con Docker, primero es necesario ejecutar los siguientes comandos:

```
docker-compose build app
docker-compose up -d
```

También es necesario cambiar la configuración del archivo `.env` y editar las variables relacionadas con las bases de datos:

- `DB_HOST_READ_1`: db2
- `DB_HOST_READ_2`: db3
- `DB_HOST_WRITE`: db

Para configurar correctamente la replicación entre las dos bases de datos es necesario introducir los siguientes comandos en los contenedores de base de datos:

- En el servidor de BD principal:

```
CREATE USER 'NOMBRE_DE_USUARIO_REPLICACIÓN'@'%' IDENTIFIED WITH mysql_native_password BY 'CONTRASEÑA';
GRANT REPLICATION SLAVE ON *.* TO 'NOMBRE_DE_USUARIO_REPLICACIÓN'@'%';
```

- En los servidores de BD secundarios:

```
CHANGE MASTER TO MASTER_HOST='NOMBRE_DEL_HOST', MASTER_USER='NOMBRE_DE_USUARIO_REPLICACIÓN', MASTER_PASSWORD='CONTRASEÑA', MASTER_LOG_FILE='87e8982d00d1-bin.000004', MASTER_LOG_POS=349;
reset slave;
start slave;
```

En estos comandos es recomendable reemplazar los campos `NOMBRE_DE_USUARIO_REPLICACIÓN`, `CONTRASEÑA` y `NOMBRE_DEL_HOST`.<br>
Se puede acceder a los contenedores de bases de datos con el comando `docker-compose exec [db/db2/db3] bash`, y posteriormente ejecutar `mysql -p` e introducir la contraseña y los anteriores comandos.

Por último, se deberán ejecutar los comandos para inicializar la aplicación:

```
docker-compose exec app composer update
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

Finalmente, la aplicación estará disponible en `localhost:80` y `localhost:443`

<br/>

_Copyright (C) 2022 Unai Corzo, Iosu Ibarguren, Adrián García_
