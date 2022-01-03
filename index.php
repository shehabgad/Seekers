<?php
require_once 'config/is_loggedin.php';
require_once 'Services/UserService/UserService.php';
require_once 'Core/Users/User.php';
require_once 'Core/Users/Employer.php';
require_once 'Core/Users/JobSeeker.php';
require_once 'config/userService.php';

$AccountNotFound = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $Account = $userService->getUser($_POST['username'], $_POST['password']);
  if ($Account == false) {
    $AccountNotFound = true;
  } else {
    $_SESSION['userID'] = $Account['userID'];
    $_SESSION['user'] = $Account['user']->getAssocArray();
    $_SESSION['user_type'] = $Account['user_type'];
    if ($Account['user_type'] == "EMPLOYER") {
      header("Location: employerHome.php");
    } else if ($Account['user_type'] == "JOB_SEEKER") {
      header("Location: jobseekerHome.php");
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Seekers | Login</title>
</head>

<body>
  <script type="module" src="scripts/login.js"></script>
  <?php include 'templates/header.php' ?>
  <div class="container w-25 p-4 border">
    <form action="index.php" method="POST" id="login-form" class="mb-5">
      <div class="mb-3 mt-3">
        <label for="username" class="form-label" name="username">Username</label>
        <input type="text" class="form-control" placeholder="Enter username:" name="username" id="username">
        <small class="text-danger" id="error-username"></small>
      </div>
      <div class="mb-3 mt-3">
        <label for="password" class="form-label" name="password">Password</label>
        <input type="password" class="form-control" placeholder="Enter password:" name="password" id="password">
        <small class="text-danger" id="error-password"></small>
      </div>
      <?php if ($AccountNotFound) { ?>
        <div class=" alert alert-danger">
          <strong>Error!</strong> username or password is incorrect.
        </div>
      <?php } ?>
      <div class="mb-3 mt-3">
        <input type="button" name="submitBtn" id="submit_btn" value="Login" class="btn btn-primary w-100">
      </div>
    </form>
    <hr>
    <div class="mb-3 mt-3">
      <a href="jobseekerSignup.php" class="btn btn-dark w-100">Sign up - Job seeker</a>
    </div>
    <div class="mb-3 mt-3">
      <a href="employerSignup.php" class="btn btn-light w-100">Sign up - Employer</a>
    </div>
  </div>
</body>

</html>