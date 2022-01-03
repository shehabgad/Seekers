<?php
require_once 'Core/Vacancy/IVacancy.php';
require_once 'Core/Vacancy/Vacancy.php';
require_once 'Core/ApplicationRequest/IApplicationRequest.php';
require_once 'Core/ApplicationRequest/ApplicationRequest.php';
require_once 'Core/Users/User.php';
require_once 'Core/Users/Employer.php';
require_once 'Core/Users/JobSeeker.php';
require_once 'Services/VacancyService/VacancyService.php';
require_once 'Services/ApplicationRequestService/AppReqService.php';
require_once 'Services/UserService/UserService.php';
require_once 'config/vacancyService.php';
require_once 'config/appReqService.php';
require_once 'config/userService.php';

require_once 'config/jobseeker_auth.php';
if (isset($_GET['vacancy_id'])) {
  $_SESSION['vacancy'] = $vacancyService->getVacancy(intval($_GET['vacancy_id']));
  if ($userService->isApplied($_SESSION['userID'], intval($_GET['vacancy_id']))) {
    header('Location: index.php');
  }
}
if (isset($_POST['submit'])) {
  $newAppRequest = new ApplicationRequest(
    $_SESSION['userID'],
    $_SESSION['vacancy']['vacancy_id'],
    $_POST['coverLetter'],
    $_SESSION['vacancy']['employer_id']
  );
  $appReqID = $appReqService->addAppReq($newAppRequest);
  $userService->addAppReqEmployer($_SESSION['vacancy']['employer_id'], $appReqID);
  $userService->addAppReqJobSeeker($_SESSION['userID'], $appReqID);
  $_SESSION['user']['applicationRequests'][] = $appReqID;
  header("location: applicationrequests-jobseeker.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Apply vacancy</title>
</head>

<body>
  <script src="scripts/getVacancies.js" defer>
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <?php include 'templates/jobseeker-nav.php' ?>
  <div class="container">
    <h4 class="display-4 text-center mt-5">Apply | <?php echo $_SESSION['vacancy']['title'] ?></h4>
    <form action="apply-vacancy.php" method="POST">
      <div class="mb-2">
        <label for="description" class="form-label" name="description">Cover letter</label>
        <textarea class="form-control" name="coverLetter" id="exampleFormControlTextarea1" rows="8"></textarea>
      </div>
      <div class="mb-3 mt-3">
        <input type="submit" name="submit" value="Upload" class="btn btn-light w-100">
      </div>
    </form>
  </div>
</body>

</html>