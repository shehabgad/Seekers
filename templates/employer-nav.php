<?php



if (isset($_POST['submit']) && $_POST['submit'] == "Upload") {
  require '../Core/Vacancy/IVacancy.php';
  require '../Core/Vacancy/Vacancy.php';
  require '../Services/VacancyService/VacancyService.php';
  require '../Services/UserService/UserService.php';
  require '../config/vacancyService.php';
  require '../config/userService.php';
  session_start();
  $newVacancy = new Vacancy(
    $_POST['title'],
    $_POST['description'],
    $_POST['location'],
    $_POST['jobtype'],
    $_POST['explevel'],
    $_POST['companyName'],
    $_POST['companyLink'],
    $_SESSION['userID']
  );
  $vacancyID = $vacancyService->addVacancy($newVacancy);
  $userService->addVacancyToEmployer($_SESSION['userID'], $vacancyID);
  $_SESSION['user']['vacs'][] = $vacancyID;
  header('Location: ../employer-vacancies.php');
}

?>

<nav class="navbar navbar-expand-sm bg-light navbar-light">
  <div class="container-fluid">
    <ul class="navbar-nav">
      <a href="index.php" class="navbar-brand">Seekers</a>
      <li class="nav-item me-2">
        <a href="employer-vacancies.php" class="nav-link btn btn-dark text-white">My Vacancies</a>
      </li>
      <li class="nav-item me-2">
        <button type="button" class="nav-link btn btn-dark text-white" data-bs-toggle="modal" data-bs-target="#vacancy-form">+ Upload vacancy</button>
      </li>
      <li class="nav-item me-2">
        <a href="applicationrequests-employer.php" class="nav-link btn btn-dark text-white">Application requests</a>
      </li>
    </ul>
    <form class="d-flex p-2 me-3" id="form-search">
      <input type="text" name="industry" id="industry" class="form-control me-2" placeholder="Industry" required>
      <input type="text" name="location" id="location" class="form-control me-2" placeholder="Location" required>
      <input type="text" name="explevel" id="explevel" class="form-control me-2" placeholder="Experience Level" required>
      <button class="btn btn-dark" id="search_jobseekers">Search</button>
    </form>
    <a href="config/logout.php" class="btn btn-danger">Logout</a>
  </div>
</nav>
<div class="modal fade bg-dark" tabindex="-1" id="vacancy-form" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Vacancy form</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <form action="templates/employer-nav.php" method="POST" id="up-vacancy-form">
          <div class="mb-2">
            <label for="title" class="form-label" name="title">Title</label>
            <input type="text" class="form-control" name="title" value="" required>
          </div>
          <div class="mb-2">
            <label for="location" class="form-label" name="location">Location</label>
            <input type="text" class="form-control" name="location" value="" required>
          </div>
          <div class="mb-2">
            <label for="jobtype" class="form-label" name="jobtype">Job type</label>
            <input type="text" class="form-control" name="jobtype" value="" required>
          </div>
          <div class="mb-2">
            <label for="explevel" class="form-label" name="explevel">Experience level</label>
            <input type="text" class="form-control" name="explevel" value="" required>
          </div>
          <div class="mb-2">
            <label for="companyName" class="form-label" name="companyName">Company name</label>
            <input type="text" class="form-control" name="companyName" value="" required>
          </div>
          <div class="mb-2">
            <label for="companyLink" class="form-label" name="companyLink">Company Link <small class="text-muted">optional</small></label>
            <input type="text" class="form-control" name="companyLink" value="" required>
          </div>
          <div class="mb-2">
            <label for="description" class="form-label" name="description">Description</label>
            <textarea class="form-control" name="description" id="up-vacancy-form" rows="6" required></textarea>
          </div>
          <div class="mb-3 mt-3">
            <input type="submit" name="submit" value="Upload" class="btn btn-light w-100">
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>