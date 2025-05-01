# Pasos para ejecutar la aplicación

## Clonar el repositorio
```sh
git clone https://github.com/oscarock/test-fsg
```

## Ingresar a la carpeta del proyecto
```sh
cd test-fsg
```

## Configurar el backend
Ingresar a la carpeta y modificar el archivo `.env` en la sección de configuración de la base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=secret
```

## Levantar el proyecto con Docker
```sh
docker compose up -d
```

Se crearán tres contenedores: la aplicacion, un nginx para levantar la app y el de base de datos

## Verificar los contenedores
```sh
docker ps -a
```

## Ejecutar migraciones
```sh
docker exec -it ID_CONTENEDOR bash
php artisan migrate
```

## Ejecutar los seed
```sh
docker exec -it ID_CONTENEDOR bash
php artisan db:seed
```

## Acceder a la aplicación
Si no se cambiaron los puertos por defecto, las URLs serán:

- **app:** [localhost:85](http://localhost:85/)

## Ejecutar acciones de las HU
Una vez configurado todo, ya puede interactuar con la aplicación y validar las HUs

