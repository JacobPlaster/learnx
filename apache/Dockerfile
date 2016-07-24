FROM php:5.6-apache

COPY src/ /var/www/html/

ENV PHPREDIS_VERSION 2.2.8

# Fix docker-php-ext-install script error
RUN sed -i 's/docker-php-\(ext-$ext.ini\)/\1/' /usr/local/bin/docker-php-ext-install

# Install utilities used by TYPO3 CMS / Flow / Neos
#RUN apt-get update \
#	&& apt-get install -y \
#		imagemagick \
#		graphicsmagick \
#		zip \
#		unzip \
#		wget \
#		curl \
#		git \
#		mysql-client \
#		moreutils \
#		dnsutils \
#	&& rm -rf /var/lib/apt/lists/*

# pdo_mysql
RUN docker-php-ext-install pdo_mysql

# mysqli
RUN docker-php-ext-install mysqli

# mysql
RUN docker-php-ext-install mysql
