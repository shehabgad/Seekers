<?php
session_start();



if (!(isset($_SESSION['userID']) && $_SESSION['user_type'] == "JOB_SEEKER")) {
  header('Location: index.php');
}
