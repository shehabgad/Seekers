<?php
require_once 'Services/UserService/UserService.php';
require_once 'Core/Users/User.php';
require_once 'Core/Users/Employer.php';
require_once 'Core/Users/JobSeeker.php';
require_once 'config/is_loggedin.php';
require_once 'config/userService.php';

$emailExist = false;
$usernameExist = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $emailExist = $userService->isEmailExist($_POST["email"]);
  $usernameExist = $userService->isUsernameExist($_POST["username"]);
  if (!$emailExist && !$usernameExist) {
    $newJobSeeker = new JobSeeker(
      $_POST['username'],
      $_POST['name'],
      $_POST['email'],
      $_POST['password'],
      intval($_POST['age']),
      $_POST['address'],
      $_POST['wcompany'],
      array($_POST['skill1'], $_POST['skill2'], $_POST['skill3']),
      $_POST['industry'],
      $_POST['explevel']
    );

    $userID = $userService->addUser($newJobSeeker);
    $_SESSION['userID'] = $userID;
    $_SESSION['user'] = $newJobSeeker->getAssocArray();
    $_SESSION['user_type'] = "JOB_SEEKER";
    header('Location: jobseekerHome.php');
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
  <title>Seekers | Sign up job seeker</title>
</head>

<body>
  <script type="module" src="scripts/jobseeker_singup.js"></script>
  <?php include 'templates/header.php' ?>
  <div class="container w-25 p-4 border">
    <h3 class="text-center mb-3 p-2 border text-white rounded bg-dark">Job seeker Sign up</h3>
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
        <label for="industry" class="form-label" name="industry">Industry</label>
        <input type="text" class="form-control" placeholder="Enter industry:" name="industry" id="industry">
        <small class="text-danger" id="error-industry"></small>

      </div>
      <div class="mb-3 mt-3">
        <label for="Working company" class="form-label" name="Working company">Working company</label>
        <input type="text" class="form-control" placeholder="Enter Working company:" name="wcompany" id="wcompany">
        <small class="text-danger" id="error-wcompany"></small>

      </div>
      <div class="mb-3 mt-3">
        <label for="Experience Level" class="form-label" name="Experience Level">Experience Level</label>
        <input type="text" class="form-control" placeholder="Enter Experience Level:" name="explevel" id="explevel">
        <small class="text-danger" id="error-explevel"></small>

      </div>
      <div class="mb-3 mt-3">
        <label for="Skill" class="form-label" name="Skill">Skill 1</label>
        <input type="text" class="form-control" placeholder="Enter Skill 1:" name="skill1" id="skill1">
        <small class="text-danger" id="error-skill1"></small>

      </div>
      <div class="mb-3 mt-3">
        <label for="Skill" class="form-label" name="Skill">Skill 2</label>
        <input type="text" class="form-control" placeholder="Enter Skill 2:" name="skill2" id="skill2">
        <small class="text-danger" id="error-skill2"></small>

      </div>
      <div class="mb-3 mt-3">
        <label for="Skill" class="form-label" name="Skill">Skill 3</label>
        <input type="text" class="form-control" placeholder="Enter Skill 3:" name="skill3" id="skill3">
        <small class="text-danger" id="error-skill3"></small>

      </div>
      <!-- <div class="alert alert-danger">
        <strong>Error!</strong> username or password is incorrect.
      </div> -->
      <div class="mb-3 mt-3">
        <input type="button" name="btnSubmit" value="Signup" class="btn btn-dark w-100" id="submit_btn">
      </div>
    </form>
</body>

</html>