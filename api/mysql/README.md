# Official phpMyAdmin Docker image

Run phpMyAdmin with Alpine and PHP built in web server.

[![Build Status](https://travis-ci.org/phpmyadmin/docker.svg?branch=master)](https://travis-ci.org/phpmyadmin/docker)
[![Docker Pulls](https://img.shields.io/docker/pulls/phpmyadmin/phpmyadmin.svg)][hub]
[![Docker Stars](https://img.shields.io/docker/stars/phpmyadmin/phpmyadmin.svg)][hub]


All following examples will bring you phpMyAdmin on `http://localhost:8080`
where you can enjoy your happy MySQL administration.


## Usage with linked server

First you need to run MySQL or MariaDB server in Docker, and this image need
link a running mysql instance container:

```
docker run --name myadmin -d --link mysql_db_server:db -p 8080:80 phpmyadmin/phpmyadmin
```

## Usage with external server

You can specify MySQL host in the `PMA_HOST` environment variable. You can also
use `PMA_PORT` to specify port of the server in case it's not the default one:

```
docker run --name myadmin -d -e PMA_HOST=dbhost -p 8080:80 phpmyadmin/phpmyadmin
```

## Usage with arbitrary server

You can use arbitrary servers by adding ENV variable `PMA_ARBITRARY=1` to the startup command:

```
docker run --name myadmin -d --link mysql_db_server:db -p 8080:80 -e PMA_ARBITRARY=1 phpmyadmin/phpmyadmin
```

## Usage with docker-compose and arbitrary server

This will run phpMyAdmin with arbitrary server - allowing you to specify MySQL/MariaDB
server on login page.

Using the docker-compose.yml from https://github.com/phpmyadmin/docker

```
docker-compose up -d
```

## Environment variables summary

* ``PMA_ARBITRARY`` - when set to 1 connection to the arbitrary server will be allowed
* ``PMA_HOST`` - define address/host name of the MySQL server
* ``PMA_PORT`` - define port of the MySQL server
* ``PMA_HOSTS`` - define comma separated list of address/host names of the MySQL servers
* ``PMA_USER`` and ``PMA_PASSWORD`` - define username to use for config authentication method
* ``PHP_UPLOAD_MAX_FILESIZE`` - define upload_max_filesize and post_max_size PHP settings
* ``PHP_MAX_INPUT_VARS`` - define max_input_vars PHP setting

For more detailed documentation see http://docs.phpmyadmin.net/en/latest/setup.html#installing-using-docker

[hub]: https://hub.docker.com/r/phpmyadmin/phpmyadmin/





CREATE TABLE `streams` (
 `user_id` int(11) NOT NULL,
 `title` varchar(32) NOT NULL,
 `description` varchar(400) NOT NULL,
 `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1


CREATE TABLE `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(24) NOT NULL,
 `password` varchar(64) NOT NULL,
 `stream_key` varchar(64) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1

INSERT INTO `users` (`id`, `username`, `password`, `stream_key`) VALUES (NULL, 'testUser', 'test', 'testuser1');
