<?php
session_start();
if (!in_array(intval($vacID), $_SESSION['user']['vacs'])) {
  header('Location: ../index.php');
}
