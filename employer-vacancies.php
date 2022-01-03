<?php
require_once("config/emoloyer_auth.php");
require_once("Services/VacancyService/VacancyService.php");
require_once("config/vacancyService.php");

$vacancies = [];
foreach ($_SESSION['user']['vacs'] as $vacancyID) {
  $vacancies[$vacancyID] = $vacancyService->getVacancy($vacancyID);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Employer vacancies</title>
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <?php include 'templates/employer-nav.php' ?>
  <div class="container mt-1">
    <h4 class="display-4 p-4">My vacancies</h4>
    <div class="accordion " id="vacancies-accordian">
      <?php $i = 1;
      foreach ($vacancies as $vacancy) { ?>
        <div class="accordion-item">
          <h2 class="accordion-header" id="<?php echo "heading$i" ?>">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="<?php echo "#collapse$i" ?>" aria-expanded="true" aria-controls="<?php echo "collapse$i" ?>">
              <!-- vacancy 1 title - jobtype - experience level - jobtype - companyname -->
              <?php echo "$vacancy[title] , $vacancy[job_type] , $vacancy[exp_level] , $vacancy[company_name]" ?>
            </button>
          </h2>
          <div id="<?php echo "collapse$i" ?>" aria-labelledby="<?php echo "heading$i" ?>" class="accordion-collapse collapse" data-bs-parent="#vacancies-accordian">
            <div class="accordion-body">
              <div class="card">
                <div class="card-body accordian">
                  <?php echo $vacancy['description'] ?>
                </div>
                <div class="card-footer">
                  <a href="<?php $vacID = array_search($vacancy, $vacancies);
                            echo "edit-vacancy.php?vacancy_id=$vacID" ?>" class="btn btn-dark me-2">Edit</a>
                  <a href="<?php
                            $vacID = array_search($vacancy, $vacancies);
                            echo "features/delete_vacancy.php?vacancy_id=$vacID" ?>" class="btn btn-danger">Delete</a>
                  <a href="" class="btn btn-warning">Hide</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php $i += 1;
      } ?>

    </div>

  </div>
</body>

</html>