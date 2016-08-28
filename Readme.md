Basic Docker Commands:
  - docker run <image>
  - docker start <name|id>
  - docker stop <name|id>
  - docker ps [-a include stopped containers]
  - docker rm <name|id>

  ## Build and run mysql server
  - docker build -t learnx-mysql .
  - docker run --name learnx-mysql -e MYSQL_ROOT_PASSWORD=root -d -p 8889:3306 -t learnx-mysql

  ## Build and run phpmyadmin server
  - docker build -t learnx-phpmyadmin .
  - docker run --name learnx-phpmyadmin -d --link learnx-mysql:db -p 8080:80 phpmyadmin/phpmyadmin

  ## Built and run php server
  - docker build -t learn-php .
  - docker run --name learnx-php -d --link learnx-mysql:db -p 80:80 learnx/php-server



 ## TODO
  - session does not destory in redis
  - Improve communication between RED5 and PHP
  - Create UI for stream generation


## Next
  - Add auth and encryption to login system
  - Add mysql to red5


use https://education.github.com/pack/offers for free stuff (including ssl certificate, payment processing and email infrastructure)
