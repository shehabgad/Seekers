<?php
require 'config/require_all.php';
require 'config/jobseeker_auth.php';

$vacancy = $vacancyService->getVacancy(intval($_GET['vacancy_id']));

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Vacancy</title>
</head>

<body>
  <script src="scripts/getVacancies.js" defer>
  </script>
  <?php include 'templates/jobseeker-nav.php' ?>
  <div class="container-fluid p-4">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title m-2"><?php echo $vacancy['title']; ?></h4>
        <hr>
        <p class="text-muted card-subtitle m-2"><?php echo $vacancy['location']; ?></p>
        <a href="" style="text-decoration: none;" class="text-muted card-subtitle m-2"><?php echo $vacancy['company_name']; ?></a>
        <p class="text-muted card-subtitle m-2"><?php echo $vacancy['job_type']; ?></p>
        <p class="text-muted card-subtitle m-2"><?php echo $vacancy['exp_level']; ?></p>
      </div>
      <div class="card-body">
        <p><?php echo $vacancy['description']; ?></p>
      </div>
      <div class="card-footer">
        <?php $appreqID = $userService->isApplied($_SESSION['userID'], $vacancy['vacancy_id']);
        if ($appreqID) { ?>
          <a href="<?php echo "features/undo_appreq.php?appreq_id=$appreqID" ?>" class="btn btn-dark me-2">Undo</a>
        <?php } else { ?>
          <a href="<?php echo "apply-vacancy.php?vacancy_id=$vacancy[vacancy_id]" ?>" class="btn btn-dark me-2">Apply</a>
        <?php } ?>
        <?php if ($userService->isSaved($_SESSION['userID'], $vacancy['vacancy_id'])) { ?>
          <a href="<?php echo "features/unsave_vacancy.php?vacancy_id=$vacancy[vacancy_id]" ?>" class="btn btn-primary">UnSave</a>
        <?php } else { ?>
          <a href="<?php echo "features/save_vacancy.php?vacancy_id=$vacancy[vacancy_id]" ?>" class="btn btn-primary">Save</a>
        <?php } ?>

      </div>
    </div>
  </div>

</body>

</html>