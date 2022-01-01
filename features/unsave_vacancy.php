<?php
include '../config/require_all_2.php';
include '../config/jobseeker_auth.php';


$vacancyID = intval($_GET['vacancy_id']);
$userService->toggleSaveVacancy($_SESSION['userID'], $vacancyID, false);
$key = array_search($vacancyID, $_SESSION['user']['savedVacs']);
if ($_SESSION['user']['savedVacs']->length > 1) {
  unset($_SESSION['user']['savedVacs'][$key]);
} else {
  $_SESSION['user']['savedVacs'] = [];
}
header('Location: ../saved-vacancies.php');
