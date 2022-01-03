<?php


if (!defined('ROOT_PATH')) {
  define('ROOT_PATH', dirname(__DIR__) . '/');
}
include(ROOT_PATH . 'config/database_info.php');;

$appReqService = new AppReqService($server, $username, $password, $dbname);
