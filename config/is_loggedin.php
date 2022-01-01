<?php
session_start();
if (isset($_SESSION['userID'])) {
  if ($_SESSION['user_type'] == "JOB_SEEKER") {
    header('Location: jobseekerhome.php');
  } else if ($_SESSION['user_type'] == "EMPLOYER") {
    header('Location: employerhome.php');
  }
}
