FROM ubuntu:latest

# Adding Tz information
ENV TZ=America/Sao_Paulo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Removing interaction
ENV DEBIAN_FRONTEND=noninteractive

# Installing necessary initial packages
RUN apt update -y 
RUN apt upgrade -y
RUN apt-get install software-properties-common -y
RUN apt update -y 

# adding keys

RUN add-apt-repository ppa:ondrej/php \
    && apt-get update -y --fix-missing
RUN add-apt-repository ppa:ondrej/apache2 \
    && apt-get update -y --fix-missing\
    && apt update -y --fix-missing

RUN apt-get update && apt-get install -y apache2 php libapache2-mod-php php-mysql php-cli php-curl php-xml php-intl php-mbstring git vim composer curl

COPY www /var/www/
# COPY vhost.conf /etc/apache2/sites-available/example.conf

RUN a2enmod ssl

RUN chown -R www-data:www-data /var/www/html 

EXPOSE 80
EXPOSE 443

CMD apachectl -D FOREGROUND