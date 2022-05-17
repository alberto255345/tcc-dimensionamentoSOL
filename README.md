# tcc-dimensionamentoSOL
Projeto de TCC para página web com dimensionamento solar

<!-- docker run -it -p 80:80 --network bridge -v /home/alberto/tcc-dimensionamentoSOL/www:/app -d --restart on-failure --name php php -->
<!-- docker run -d -p 4500:80 --name php -v /home/alberto/tcc-dimensionamentoSOL/www:/var/www/html php:7.2-apache -->

docker run -it -p 4500:80 --network tcc_default -v /home/alberto/tcc-dimensionamentoSOL/www:/var/www/html -d --restart on-failure --name php-2 php-2

docker pull mysql
docker run -v /home/alberto/tcc-dimensionamentoSOL/data:/var/lib/mysql --network tcc_default --name mysql-2 -e MYSQL_ROOT_PASSWORD=root mysql:1
docker exec -i mysql-2 sh -c 'exec mysql -uroot -proot' < backup.sql

o backup precisa ter :
DROP DATABASE IF EXISTS `sundata`;
CREATE DATABASE IF NOT EXISTS `sundata` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `sundata`;