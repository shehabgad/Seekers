<?php
require_once 'config/emoloyer_auth.php';

require_once 'Services/UserService/UserService.php';
require_once 'Services/VacancyService/VacancyService.php';

require_once 'Core/Users/User.php';
require_once 'Core/Users/Employer.php';
require_once 'Core/Users/JobSeeker.php';

require_once 'config/userService.php';
$emailExist = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["name"] != $_SESSION['user']['name']) {
    $_SESSION['user']['name'] = $_POST["name"];
    $userService->updateEmployerName($_SESSION['userID'], $_POST['name']);
  }
  if ($_POST["email"] != $_SESSION['user']['email']) {
    $emailExist = $userService->isEmailExist($_POST['email']);
    if (!$emailExist) {
      $_SESSION['user']['email'] = $_POST["email"];
      $userService->updateEmployerEmail($_SESSION['userID'], $_POST['email']);
    }
  }
  if ($_POST["address"] != $_SESSION['user']['address']) {
    $_SESSION['user']['address'] = $_POST["address"];
    $userService->updateEmployerAddress($_SESSION['userID'], $_POST['address']);
  }
  if ($_POST["company"] != $_SESSION['user']['company']) {
    $_SESSION['user']['company'] = $_POST["company"];
    $userService->updateEmployerWcompany($_SESSION['userID'], $_POST['company']);
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
  <title>Home</title>
</head>

<body>
  <script type="text/javascript" src="scripts/getJobSeekers.js" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <script type="module" src="scripts/edit_employer.js"></script>
  <?php include 'templates/employer-nav.php' ?>
  <div class="row p-3">
    <div class="col-4 mt-5 me-3 border">
      <h4 class="text-center display-4"><?php echo $_SESSION['user']['username'] ?></h4>
      <form action="employerhome.php" method="POST" id="edit_form">
        <div class="mb-2">
          <label for="name" class="form-label" name="name">Name</label>
          <input type="text" id="name" class="form-control" name="name" value="<?php echo $_SESSION['user']['name'] ?>">
          <small class="text-danger" id="error-name"></small>
        </div>
        <div class="mb-2">
          <label for="email" class="form-label" name="email">Email</label>
          <input type="email" id="email" class="form-control" name="email" value="<?php echo $_SESSION['user']['email'] ?>">
          <small class="text-danger" id="error-email"><?php if ($emailExist) echo "email already exist" ?></small>
        </div>
        <div class="mb-2">
          <label for="address" class="form-label" name="address">Address</label>
          <input type="text" id="address" class="form-control" name="address" value="<?php echo $_SESSION['user']['address'] ?>">
          <small class="text-danger" id="error-address"></small>
        </div>

        <div class="mb-2">
          <label for="workingCompany" class="form-label" name="working Company">Working Company</label>
          <input type="text" id="wcompany" class="form-control" name="company" value="<?php echo $_SESSION['user']['company'] ?>">
          <small class="text-danger" id="error-wcompany"></small>

        </div>
        <div class="mb-3 mt-3">
          <input type="button" name="btnSubmit" id="submit_btn" value="Edit Profile" class="btn btn-dark w-100">
        </div>
      </form>
    </div>
    <div class="col mt-5 me-2 border p-3">
      <h4 class="p-4 display-4">Job seekers</h4>
      <ul style="list-style: none;" id="jobseekers">

      </ul>
    </div>
  </div>

</body>


</html>