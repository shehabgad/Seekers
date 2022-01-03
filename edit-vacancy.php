<?php
require_once 'config/require_all.php';
require_once 'config/emoloyer_auth.php';
if (isset($_GET['vacancy_id'])) {
  $_SESSION['vac'] = $vacancyService->getVacancy(intval($_GET['vacancy_id']));
}
if (isset($_POST['submit'])) {
  $result = $vacancyService->updateVacancy(
    $_SESSION['vac']['vacancy_id'],
    $_POST['title'],
    $_POST['location'],
    $_POST['jobtype'],
    $_POST['explevel'],
    $_POST['companyName'],
    $_POST['companyLink'],
    $_POST['description']
  );
  if ($result) {
    echo "SUCCESS";
  } else {
    echo "FAIL";
  }
  unset($_SESSION['vac']);
  header('Location: employer-vacancies.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Edit vacancy</title>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <?php include 'templates/employer-nav.php' ?>
  <div class="container">
    <h4 class="display-4 text-center m-2">Edit vacancy</h4>
    <form action="edit-vacancy.php" method="POST">
      <div class="mb-2">
        <label for="title" class="form-label" name="title">Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $_SESSION['vac']['title'] ?>" required>
      </div>
      <div class="mb-2">
        <label for="location" class="form-label" name="location">Location</label>
        <input type="text" class="form-control" name="location" value="<?php echo $_SESSION['vac']['location'] ?>" required>
      </div>
      <div class="mb-2">
        <label for="jobtype" class="form-label" name="jobtype">Job type</label>
        <input type="text" class="form-control" name="jobtype" value="<?php echo $_SESSION['vac']['job_type'] ?>" required>
      </div>
      <div class="mb-2">
        <label for="explevel" class="form-label" name="explevel">Experience level</label>
        <input type="text" class="form-control" name="explevel" value="<?php echo $_SESSION['vac']['exp_level'] ?>" required>
      </div>
      <div class="mb-2">
        <label for="companyName" class="form-label" name="companyName">Company name</label>
        <input type="text" class="form-control" name="companyName" value="<?php echo $_SESSION['vac']['company_name'] ?>" required>
      </div>
      <div class="mb-2">
        <label for="companyLink" class="form-label" name="companyLink">Company Link <small class="text-muted">optional</small></label>
        <input type="text" class="form-control" name="companyLink" value="<?php echo $_SESSION['vac']['company_link'] ?>">
      </div>
      <div class="mb-2">
        <label for="description" class="form-label" name="description">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="6">
        <?php echo $_SESSION['vac']['description'] ?>
        </textarea>
      </div>
      <div class="mb-3 mt-3">
        <input type="submit" name="submit" value="edit" class="btn btn-light w-100">
      </div>
    </form>
  </div>
</body>

</html>