<?php
require_once '../config/require_all_2.php';
require_once '../config/jobseeker_auth.php';
$userID = $_SESSION['userID'];
$appReqID = intval($_GET['appreq_id']);
$appReq = $appReqService->getAppReq($appReqID);
$employerID = intval($appReq['employer_id']);
if (!$userService->isApplied($userID, $appReq['vacancy_id'])) {
  header('Location: ../index.php');
} else {
  $userService->removeApplicationRequest($userID, $employerID, $appReqID);
  $appReqService->removeAppReq($appReqID);
  $key = array_search($appReqID, $_SESSION['user']['applicationRequests']);
  if ($_SESSION['user']['applicationRequests']->length > 1) {
    unset($_SESSION['user']['applicationRequests'][$key]);
  } else {
    $_SESSION['user']['applicationRequests'] = [];
  }
  header('Location: ../applicationrequests-jobseeker.php');
}
