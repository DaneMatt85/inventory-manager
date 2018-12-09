FROM ubuntu:18.04

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Africa/Johannesburg
RUN apt-get update && apt-get install -y language-pack-en-base software-properties-common && LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php \
    && apt-get update && apt-get install -y apache2 php7.1 libapache2-mod-php7.1 \
    php7.1-xml php7.1-mbstring php7.1-intl php7.1-mysql php7.1-curl php7.1-gd php7.1-sqlite3 zip php7.1-soap curl \
    && a2enmod rewrite headers
    
ADD /docker/apache/site.conf /etc/apache2/sites-enabled/000-default.conf
ADD /app/ /var/www/html/

ADD /docker/apache/start.sh /start.sh
RUN chmod +x /start.sh
CMD ["/start.sh"]
