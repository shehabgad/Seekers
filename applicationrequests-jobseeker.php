<?php

require_once 'config/jobseeker_auth.php';
require_once 'config/require_all.php';
$appreqIds = $_SESSION['user']['applicationRequests'];

$applicationRequests = [];
foreach ($appreqIds as $appreqId) {
  $appRequest =  $appReqService->getAppReq($appreqId);
  $appRequest['vacancy'] = $vacancyService->getVacancy($appRequest['vacancy_id']);
  unset($appRequest['vacancy_id']);
  $applicationRequests[] = $appRequest;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Job seeker applications</title>
</head>

<body>
  <script src="scripts/getVacancies.js" defer>
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <?php include 'templates/jobseeker-nav.php' ?>
  <div class="container mt-1">
    <h4 class="display-4 p-4">My application requests</h4>
    <div class="accordion " id="applications-accordian">
      <?php $i = 1;
      foreach ($applicationRequests as $application) {
        $vacancy = $application['vacancy']; ?>
        <div class="accordion-item">
          <h2 class="accordion-header" id=<?php echo "heading$i" ?>>
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="<?php echo "#collapse$i" ?>" aria-controls="<?php echo "collapse$i" ?>">
              <!-- vacancy 1 title - jobtype - experience level - jobtype - companyname -->
              <?php echo "$vacancy[title], $vacancy[job_type], $vacancy[exp_level], $vacancy[company_name]" ?>
            </button>
          </h2>
          <div id="<?php echo "collapse$i" ?>" aria-labelledby=<?php echo "heading$i" ?> class="accordion-collapse collapse" data-bs-parent="#applications-accordian">
            <div class="accordion-body">
              <div class="card accordian">
                <div class="card-body">
                  <div class="mb-3">
                    <h4 class="card-subtitle mb-2">Cover letter</h4>
                    <p class="card-text"><?php echo $application['cover_letter'] ?></p>
                  </div>
                </div>
                <div class="card-footer">
                  <a href="" class="btn btn-danger me-2">Undo</a>
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