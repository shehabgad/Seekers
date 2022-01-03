<?php
require_once '../config/require_all_2.php';
require_once '../config/jobseeker_auth.php';


$vacancyID = intval($_GET['vacancy_id']);
if ($userService->isSaved($_SESSION['userID'], intval($_GET['vacancy_id']))) {
  header('Location: ../index.php');
}
$userService->toggleSaveVacancy($_SESSION['userID'], $vacancyID);
$_SESSION['user']['savedVacs'][] = $vacancyID;

header('Location: ../saved-vacancies.php');
