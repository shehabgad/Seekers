<?php
session_start();
if (!(isset($_SESSION['userID']) && $_SESSION['user_type'] == "EMPLOYER")) {
  header('Location: index.php');
}
