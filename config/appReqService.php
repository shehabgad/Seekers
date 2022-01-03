<?php


if (!defined('ROOT_PATH')) {
  define('ROOT_PATH', dirname(__DIR__) . '/');
}
require_once(ROOT_PATH . 'config/database_info.php');;

$appReqService = new AppReqService($server, $username, $password, $dbname);
