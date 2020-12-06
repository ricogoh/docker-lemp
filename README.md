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

### Interact With App
*app stack service in .yml* 
```docker
docker-compose exec app composer install 
docker-compose exec app php artisan key:generate 
docker-compose exec app php artisan migrate 
docker-compose exec app php artisan config:cache 
docker-compose exec app php artisan tinker 
```
### Creating a User for MySQL
```
docker-compose exec db bash
```

*Below steps could be ignore, if set MYSQL_USER: user & MYSQL_PASSWORD: secret*
```sql
mysql -u root -p
GRANT ALL ON dlemp.* TO 'user'@'%' IDENTIFIED BY 'secret';
FLUSH PRIVILEGES;
```
