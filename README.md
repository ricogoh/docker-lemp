# Docker Laravel Example

Based on: https://www.digitalocean.com/community/tutorials/how-to-set-up-laravel-nginx-and-mysql-with-docker-compose

###
Composer run inside container.  
Yarn or NPM run on host.

### Image Repo
git@github.com:ricogoh/docker-lemp.git

### Local URL
http://localhost:2080

## Start up
```docker
docker-compose up -d
```

## Interact With App
*app stack service in .yml* 
```
docker exec -it docker-lemp_app_1 bash
docker exec -u 0 -it docker-lemp_app_1 bash

docker-compose build app

docker-compose exec app composer install 
docker-compose exec app php artisan key:generate 
docker-compose exec app php artisan migrate 
docker-compose exec app php artisan config:cache 
docker-compose exec app php artisan tinker 
```
## Creating a User for MySQL
```
docker-compose exec db bash
```

*Below steps could be ignore, if set MYSQL_USER: user & MYSQL_PASSWORD: secret*
```sql
mysql -u root -p
GRANT ALL ON dlemp.* TO 'user'@'%' IDENTIFIED BY 'secret';
FLUSH PRIVILEGES;
```

## Connecting To Host MySql
```
DB_CONNECTION=mysql
DB_HOST=host.docker.internal
DB_PORT=3306
DB_DATABASE=dbname
DB_USERNAME=user
DB_PASSWORD=secret
```
