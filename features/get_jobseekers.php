<?php
require '../config/require_all_2.php';

$jobseekers = $userService->getJobseekers($_GET['industry'], $_GET['location'], $_GET['explevel']);
if ($jobseekers) {
  foreach ($jobseekers as $jobseeker) {
    $skills = "";
    foreach ($jobseeker['skills'] as $skill) {
      $skills = $skills .  "<li>$skill</li>";
    }
    echo "
    <li>
    <div class='card mb-2 p-4 w-75'>
      <h5 class='card-title mb-4'>$jobseeker[name]</h5>
      <p class='card-subtitle text-muted mb-2'>$jobseeker[address]</p>
      <p class='card-subtitle text-muted mb-2'>$jobseeker[industry]</p>
      <p class='card-subtitle text-muted mb-2'>$jobseeker[explevel]</p>
      <p class='card-subtitle mb-2'>$jobseeker[email]</p>
      <p class='card-subtitle mb-2'>age: $jobseeker[age] years old</p>
      <p class='card-subtitle mb-2'>working company: $jobseeker[wcompany]</p>

      <ul>
        $skills
      </ul>
    </div>
  </li>
  ";
  }
} else {
  echo "FALSE";
}
