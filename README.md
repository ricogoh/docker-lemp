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
```docker
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

## Supervisor
apt-get install supervisor
service supervisor restart  
service supervisor start

### Test running
/usr/local/bin/long.sh
```
#!/bin/bash
while true
do 
	# Echo current date to stdout
	echo `date`
	# Echo 'error!' to stderr
	echo 'error!' >&2
	sleep 1
done
```

```chmod +x /usr/local/bin/long.sh```

*/etc/supervisor/conf.d/long_script.conf*
```
[program:long_script]
command=/usr/local/bin/long.sh
autostart=true
autorestart=true
stderr_logfile=/var/log/long.err.log
stdout_logfile=/var/log/long.out.log
```

```
touch /var/log/long.err.log
touch /var/log/long.out.log
```
```
sudo supervisorctl reread
sudo supervisorctl update

tail /var/log/long.out.log

supervisorctl
```

### Laravel Queue

*/etc/supervisor/conf.d/laravel-worker.conf*
```
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/artisan queue:work database --queue=case,kpi,po,dashboard --sleep=3 --tries=2 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www
numprocs=8
redirect_stderr=true
stdout_logfile=/var/www/storage/logs/worker.log
stopwaitsecs=3600
```
