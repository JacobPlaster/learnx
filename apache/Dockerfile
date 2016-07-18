FROM php:5.6-apache

COPY src/ /var/www/html/

ENV PHPREDIS_VERSION 2.2.8

# Fix docker-php-ext-install script error
RUN sed -i 's/docker-php-\(ext-$ext.ini\)/\1/' /usr/local/bin/docker-php-ext-install

# Install utilities used by TYPO3 CMS / Flow / Neos
RUN apt-get update \
	&& apt-get install -y \
		imagemagick \
		graphicsmagick \
		zip \
		unzip \
		wget \
		curl \
		git \
		mysql-client \
		moreutils \
		dnsutils \
	&& rm -rf /var/lib/apt/lists/*

# pdo_mysql
RUN docker-php-ext-install pdo_mysql

# mysqli
RUN docker-php-ext-install mysqli

# mysql
RUN docker-php-ext-install mysql

# redis
RUN wget -O /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/2.2.7.tar.gz \
	&& mkdir -p /tmp/redis \
	&& tar xzf /tmp/redis.tar.gz -C /tmp/redis --strip-components=1 \
	&& cd /tmp/redis \
	&& phpize \
	&& ./configure \
	&& make \
	&& make install \
	&& echo "extension=redis.so" > /usr/local/etc/php/conf.d/ext-redis.ini \
	&& rm -rf /tmp/redis.tar.gz /tmp/redis

# add redis variables to ini
RUN { \
		echo 'session.save_handler = redis'; \
		echo 'session.save_path = tcp://redis:6379'; \
	} >> /usr/local/etc/php/conf.d/docker-php-ext-redis.ini
