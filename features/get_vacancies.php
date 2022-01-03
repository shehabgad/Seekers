<?php
require_once '../Core/Vacancy/IVacancy.php';
require_once '../Core/Vacancy/Vacancy.php';
require_once '../Services/VacancyService/VacancyService.php';
require_once '../config/vacancyService.php';

$vacancies = $vacancyService->getVacancies($_GET['searchTitle']);
if ($vacancies) {
  foreach ($vacancies as $vacancy) {
    echo "
    <li>
    <div class='card mb-2 p-4 w-75'>
      <h5 class='card-title'>$vacancy[title]</h5>
      <p class='card-subtitle text-muted mb-2'>$vacancy[location] </p>
      <p class='card-subtitle text-muted mb-2'>$vacancy[company_name]</p>
      <p class='card-subtitle text-muted mb-2'>$vacancy[job_type]</p>
      <p class='card-subtitle text-muted mb-2'>$vacancy[exp_level]</p>
      <a href='vacancy.php?vacancy_id=$vacancy[vacancy_id]' class='btn btn-dark stretched-link'>View Vacancy</a>
    </div>
  </li>
  ";
  }
} else {
  echo "";
}
