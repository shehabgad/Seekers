<?php
if (!defined('ROOT_PATH')) {
  define('ROOT_PATH', dirname(__DIR__) . '/');
}
require_once(ROOT_PATH . 'config/database_info.php');

$vacancyService = new VacancyService($server, $username, $password, $dbname);
