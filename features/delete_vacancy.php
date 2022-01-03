<?php
require_once("../config/emoloyer_auth.php");
require_once("../Services/UserService/UserService.php");
require_once("../config/userService.php");
require_once("../Services/VacancyService/VacancyService.php");
require_once("../config/vacancyService.php");
trim($_GET['vacancy_id'], "'");
trim($_GET['vacancy_id'], "'\"");

echo $_GET['vacancy_id'];
echo "<br>";
$vacID = intval($_GET['vacancy_id']);
echo $vacID;
echo "<br>";
require_once("../config/vacancy_employer_auth.php");

$vacancyService->deleteVacancy($vacID);
$userService->DeleteVacancyFromEmployer($_SESSION['userID'], $vacID);
$key = array_search($vacID, $_SESSION['user']['vacs']);
unset($_SESSION['user']['vacs'][$key]);
header("Location: ../employer-vacancies.php");
