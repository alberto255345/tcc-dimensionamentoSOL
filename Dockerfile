FROM ubuntu:18.04
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

# Installing php and apache2
RUN apt install -y php \
    && apt update -y --fix-missing \
    && apt install -y php-mysql \
    && apt install -y php-mbstring \
    && apt install -y curl \
    && apt install -y php-curl \
    && apt install -y apache2 \
    && apt update -y

RUN apt-get -y install php-zip

# Installing zip
RUN apt install zip -y

# Copying databook files to image
COPY conf_apache.zip /root/conf_apache.zip
COPY php.ini /etc/php/5.6/apache2/php.ini
RUN yes | unzip /root/conf_apache.zip

# Installing sendmail 
RUN apt-get update --fix-missing -y \
    && apt-get -y install php-xml php5.6-xml \
    && apt-get -y install php-pear \
    && apt-get update -y

RUN pear install mail 
RUN pear install Net_SMTP 



RUN a2enmod ssl

    

EXPOSE 80
EXPOSE 443

CMD apachectl -D FOREGROUND