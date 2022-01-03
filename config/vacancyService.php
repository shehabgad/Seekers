<?php
if (!defined('ROOT_PATH')) {
  define('ROOT_PATH', dirname(__DIR__) . '/');
}
include(ROOT_PATH . 'config/database_info.php');

$vacancyService = new VacancyService($server, $username, $password, $dbname);
