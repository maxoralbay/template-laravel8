
Quick start
=====

After you clone the project, you need to download the following images and paste them into the appropriate paths:

Path: /backend/public

Path: /frontend/src/assets

Copy the config files:

```shell
cp backend/.env.example backend/.env
cp frontend/src/assets/js/config.js.example frontend/src/assets/js/config.js
```

Up all the services:

```shell
docker-compose --env-file ./backend/.env up -d
```

Run migrations:
```shell
docker exec lv-php php artisan migrate --seed
```

Backend service host:
```shell
http://localhost:8000
```

Frontend service host:
```shell
http://localhost:8001
```