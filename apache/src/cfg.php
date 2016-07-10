<?php

  // URLS //
  $SERVER_CFG['HOST'] = "localhost";
  $SERVER_CFG['PORT'] = "80";
  // Databse
  $SERVER_CFG['MYSQL_HOST'] = "localhost"; // $SERVER_CFG['DB_HOST'] = "db";
  $SERVER_CFG['MYSQL_PORT'] = "8889"; //$SERVER_CFG['DB_PORT'] = "3306";
  $SERVER_CFG['MYSQL_USER'] = "root";
  $SERVER_CFG['MYSQL_PWD'] = "root";
  $SERVER_CFG['MYSQL_DATABSE_NAME'] = "learnx";

  $MEDIA_SERVER["HOST"] = "localhost";
  $MEDIA_SERVER["PORT"] = "5000";

  // ********* PATHS ********* //
  // Libs folder
  $SERVER_PATH['libs'] = '/libs';
  $SERVER_PATH['libs-javascript'] = $SERVER_PATH['libs'].'/js';
  $SERVER_PATH['libs-img'] = $SERVER_PATH['libs'].'/img';
  $SERVER_PATH['libs-doc'] = $SERVER_PATH['libs'].'/doc';
  $SERVER_PATH['libs-css'] = $SERVER_PATH['libs'].'/css';
  $SERVER_PATH['libs-php'] = $_SERVER['DOCUMENT_ROOT'].$SERVER_PATH['libs'].'/php';
  // Inserts
  $SERVER_PATH['inserts'] = $SERVER_PATH['libs-php'].'/inserts';
  $SERVER_PATH['inserts-404'] = $SERVER_PATH['inserts'].'/404.html';
  $SERVER_PATH['inserts-chat'] = $SERVER_PATH['inserts'].'/chat.php';
  $SERVER_PATH['inserts-error'] = $SERVER_PATH['inserts'].'/error.php';
  $SERVER_PATH['inserts-google-analytics'] = $SERVER_PATH['inserts'].'/google_analytics.php';
  $SERVER_PATH['inserts-header-libs'] = $SERVER_PATH['inserts'].'/header_libs.php';
  $SERVER_PATH['inserts-footer-libs'] = $SERVER_PATH['inserts'].'/footer_libs.php';
 ?>
