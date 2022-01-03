<?php
require_once 'config/jobseeker_auth.php';
require_once 'Services/UserService/UserService.php';
require_once 'Core/Users/User.php';
require_once 'Core/Users/Employer.php';
require_once 'Core/Users/JobSeeker.php';
require_once 'config/userService.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if ($_POST["name"] != $_SESSION['user']['name']) {
    $_SESSION['user']['name'] = $_POST["name"];
    $userService->updateJobSeekerName($_SESSION['userID'], $_POST['name']);
  }
  if ($_POST["email"] != $_SESSION['user']['email']) {
    $emailExist = $userService->isEmailExist($_POST['email']);
    if (!$emailExist) {
      $_SESSION['user']['email'] = $_POST["email"];
      $userService->updateJobSeekerEmail($_SESSION['userID'], $_POST['email']);
    }
  }
  if ($_POST["address"] != $_SESSION['user']['address']) {
    $_SESSION['user']['address'] = $_POST["address"];
    $userService->updateJobSeekerAddress($_SESSION['userID'], $_POST['address']);
  }
  if ($_POST["workingCompany"] != $_SESSION['user']['company']) {
    $_SESSION['user']['company'] = $_POST["workingCompany"];
    $userService->updateJobSeekerWcompany($_SESSION['userID'], $_POST['workingCompany']);
  }
  if ($_POST["explvl"] != $_SESSION['user']['expLevel']) {
    $_SESSION['user']['expLevel'] = $_POST["explvl"];
    $userService->updateJobSeekerExpLevel($_SESSION['userID'], $_POST['explvl']);
  }
  if ($_POST["industry"] != $_SESSION['user']['industry']) {
    $_SESSION['user']['industry'] = $_POST["industry"];
    $userService->updateJobSeekerIndustry($_SESSION['userID'], $_POST['industry']);
  }
  if (strlen($_POST['skill']) > 0) {
    $_SESSION['user']['skills'][] = $_POST["skill"];
    $userService->updateJobSeekerSkill($_SESSION['userID'], $_POST['skill']);
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
  <script src="scripts/getVacancies.js" defer>
  </script>

  <script type="module" src="scripts/edit_jobseeker.js"></script>
  <?php include("templates/jobseeker-nav.php") ?>
  <div class="row p-3">
    <div class="col-4 mt-5 me-3 border">
      <h4 class="text-center display-4"><?php echo $_SESSION['user']['username'] ?></h4>
      <form action="jobseekerhome.php" method="POST" id="edit-form">
        <div class="mb-2">
          <label for="name" class="form-label" name="name">Name</label>
          <input type="text" class="form-control" name="name" id="name" value="<?php echo $_SESSION['user']['name'] ?>">
          <small class="text-danger" id="error-name"></small>
        </div>
        <div class="mb-2">
          <label for="email" class="form-label" name="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['user']['email'] ?>">
          <small class="text-danger" id="error-email"></small>

        </div>
        <div class="mb-2">
          <label for="address" class="form-label" name="address">Address</label>
          <input type="text" class="form-control" name="address" id="address" value="<?php echo $_SESSION['user']['address'] ?>">
          <small class="text-danger" id="error-address"></small>

        </div>
        <div class="mb-2">
          <label for="explvl" class="form-label" name="explvl">Experience Level</label>
          <input type="text" class="form-control" name="explvl" id="explevel" value="<?php echo $_SESSION['user']['expLevel'] ?>">
          <small class="text-danger" id="error-explevel"></small>

        </div>
        <div class="mb-2">
          <label for="industry" class="form-label" name="industry">Industry</label>
          <input type="text" class="form-control" name="industry" id="industry" value="<?php echo $_SESSION['user']['industry'] ?>">
          <small class="text-danger" id="error-industry"></small>

        </div>
        <div class="mb-2">
          <label for="workingCompany" class="form-label" name="working Company">Working Company</label>
          <input type="text" class="form-control" id="wcompany" name="workingCompany" value="<?php echo $_SESSION['user']['company'] ?>">
          <small class="text-danger" id="error-wcompany"></small>

        </div>
        <div class="mb-3">
          <label for="" class="form-label" name="">Skills</label>
          <ul class="m-1">
            <?php foreach ($_SESSION['user']['skills'] as $skill) { ?>
              <li><?php echo $skill ?></li>
            <?php } ?>
          </ul>
        </div>
        <div class="mb-2">
          <label for="skill" class="form-label" name="skill">Add a skill</label>
          <input type="text" class="form-control" name="skill" id="skill">
          <small class="text-danger" id="error-skill"></small>

        </div>
        <div class="mb-3 mt-3">
          <input type="button" name="btnSubmit" id="submit_btn" value="Edit Profile" class="btn btn-dark w-100">
        </div>
      </form>
    </div>
    <div class="col mt-5 me-2 border p-3">
      <h4 class="p-4 display-4">Vacancies</h4>
      <ul style="list-style: none;" id="vacancies">
        <!-- <li>
          <div class="card mb-2 p-4 w-75">
            <h5 class="card-title">Software engineer front end</h5>
            <p class="card-subtitle text-muted mb-2">Location </p>
            <p class="card-subtitle text-muted mb-2">Company name</p>
            <p class="card-subtitle text-muted mb-2">Job type</p>
            <p class="card-subtitle text-muted mb-2">experience level</p>
            <a href="vacancy.php" class="btn btn-dark stretched-link">View Vacancy</a>
          </div>
        </li>
        <li>
          <div class="card mb-2 p-4 w-75">
            <h5 class="card-title">Software engineer front end</h5>
            <p class="card-subtitle text-muted mb-2">Location </p>
            <p class="card-subtitle text-muted mb-2">Company name</p>
            <p class="card-subtitle text-muted mb-2">Job type</p>
            <p class="card-subtitle text-muted mb-2">experience level</p>
            <a href="vacancy.php" class="btn btn-dark stretched-link">View Vacancy</a>
          </div>
        </li> -->

      </ul>
    </div>
  </div>

</body>

</html>