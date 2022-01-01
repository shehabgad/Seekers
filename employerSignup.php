<?php
include 'Services/UserService/UserService.php';
include 'Core/Users/User.php';
include 'Core/Users/Employer.php';
include 'Core/Users/JobSeeker.php';
include 'config/is_loggedin.php';
include 'config/userService.php';
$emailExist = false;
$usernameExist = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $emailExist = $userService->isEmailExist($_POST["email"]);
  $usernameExist = $userService->isUsernameExist($_POST["username"]);
  if (!$emailExist && !$usernameExist) {
    $newEmployer = new Employer(
      $_POST['username'],
      $_POST['name'],
      $_POST['email'],
      $_POST['password'],
      $_POST['age'],
      $_POST['address'],
      $_POST['wcompany'],
    );

    $userID = $userService->addUser($newEmployer);
    session_start();
    $_SESSION['userID'] = $userID;
    $_SESSION['user'] = $newEmployer->getAssocArray();
    $_SESSION['user_type'] = "EMPLOYER";
    header('Location: employerHome.php');
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
  <title>Seekers | Sign up employer</title>
</head>

<body>
  <script type="module" src="scripts/employer_signup.js"></script>
  <?php include 'templates/header.php' ?>
  <div class="container w-25 p-4 border">
    <h3 class="text-center mb-3 p-2 border bg-light rounded">Employer Sign up</h3>
    <form action="" method="POST" id="signup-form" class="mb-5">
      <div class="mb-3 mt-3">
        <label for="username" class="form-label" name="username">Username</label>
        <input type="text" class="form-control" placeholder="Enter username:" name="username" id="username">
        <small class="text-danger" id="error-username"><?php if ($usernameExist) echo "username already exists" ?></small>
      </div>
      <div class="mb-3 mt-3">
        <label for="name" class="form-label" name="name">Name</label>
        <input type="text" class="form-control" placeholder="Enter your name:" name="name" id="name">
        <small class="text-danger" id="error-name"></small>
      </div>
      <div class="mb-3 mt-3">
        <label for="email" class="form-label" name="email">Email</label>
        <input type="email" class="form-control" placeholder="Enter email:" name="email" id="email">
        <small class="text-danger" id="error-email"><?php if ($emailExist) echo "email already exists" ?></small>
      </div>
      <div class="mb-3 mt-3">
        <label for="password" class="form-label" name="password">Password</label>
        <input type="password" class="form-control" placeholder="Enter password:" name="password" id="password">
        <small class="text-danger" id="error-password"></small>

      </div>
      <div class="mb-3 mt-3">
        <label for="password2" class="form-label" name="password2">Re-enter password</label>
        <input type="password" class="form-control" placeholder="Re-enter password:" name="password2" id="password2">
        <small class="text-danger" id="error-password2"></small>

      </div>
      <div class="mb-3 mt-3">
        <label for="age" class="form-label" name="age">age</label>
        <input type="number" class="form-control" placeholder="Enter age:" name="age" min="18" max="65" id="age">
        <small class="text-danger" id="error-age"></small>
      </div>
      <div class="mb-3 mt-3">
        <label for="address" class="form-label" name="address">Address</label>
        <input type="text" class="form-control" placeholder="Enter address:" name="address" id="address">
        <small class="text-danger" id="error-address"></small>

      </div>
      <div class="mb-3 mt-3">
        <label for="Working company" class="form-label" name="Working company">Working company</label>
        <input type="text" class="form-control" placeholder="Enter Working company:" name="wcompany" id="wcompany">
        <small class="text-danger" id="error-wcompany"></small>

      </div>
      <!-- <div class="alert alert-danger">
        <strong>Error!</strong> username or password is incorrect.
      </div> -->
      <div class="mb-3 mt-3">
        <input type="button" name="btnSubmit" value="Signup" class="btn btn-light w-100" id="submit_btn">
      </div>
    </form>
</body>

</html>