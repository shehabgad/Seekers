<?php
require("../config/emoloyer_auth.php");
require("../Services/UserService/UserService.php");
require("../config/userService.php");
require("../Services/VacancyService/VacancyService.php");
require("../config/vacancyService.php");
trim($_GET['vacancy_id'], "'");
trim($_GET['vacancy_id'], "'\"");

echo $_GET['vacancy_id'];
echo "<br>";
$vacID = intval($_GET['vacancy_id']);
echo $vacID;
echo "<br>";
require("../config/vacancy_employer_auth.php");

$vacancyService->deleteVacancy($vacID);
$userService->DeleteVacancyFromEmployer($_SESSION['userID'], $vacID);
$key = array_search($vacID, $_SESSION['user']['vacs']);
unset($_SESSION['user']['vacs'][$key]);
header("Location: ../employer-vacancies.php");
